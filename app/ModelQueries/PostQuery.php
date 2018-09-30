<?php

namespace App\ModelQueries;

use Illuminate\Database\Eloquent\Model;

use App\Post;
use App\Helpers\Strings;
use App\Helpers\DateHelper;

class PostQuery extends Post
{
    protected $table = 'posts';

    private $_coverDirectory;
    private $_coverDirectoryThumbs;

    public function __construct()
    {
        $this->_coverDirectory       = public_path('/postsCover/');
        $this->_coverDirectoryThumbs = $this->_coverDirectory . "/thumbs";

        \File::makeDirectory($this->_coverDirectoryThumbs, 0755, true, true);
    }

    public function store($data, $request)
    {

        if($request->hasFile('cover_image'))
            $data['cover_image'] = $this->uploadCover($request->file('cover_image'), $data['title']);

        $data['user_id'] = \Auth::id();

        $data['body']    = clean($data['body']);

        $model = (new Post())->create($data);

        if($model->id)
            return $model->id;

        return false;
    }

    public function updatePost($data, $request, $postID)
    {
        $post = Post::find($postID);

        if($request->hasFile('cover_image')){

            if($postID->cover_image)
                $this->deleteOldLogo($postID->cover_image);

            $data['cover_image'] = $this->uploadCover($request->file('cover_image'), $data['title']);

        }

        $data['body'] = clean($data['body']);

        if($post->update($data))
            return $post->id;

        return false;

    }

    static public function get($request)
    {
        $name   = $request->get('name');
        $status = $request->get('status');
        $userID = $request->get('author');
        $date   = $request->get('date');

        $posts = Post::with(['user']);

        if($name && strlen($name) >= 3)
            $posts->whereRaw('LOWER(`name`) LIKE ? ', ['%'. trim(strtolower($name)). '%']);

        if(is_int($status))
            $posts->where('status', '=', (int) $status);

        if(is_int($userID))
            $posts->where('user_id', '=', (int) $userID);

        $limit = $request->get('limit') ?? 10;

        if($date && DateHelper::isValidDate($date))
            $posts->whereDate('created_at', $date);

        $posts->orderBy('created_at', 'desc');

        return $posts->paginate((int) $limit);
    }

    public function uploadCover($cover, $postTitle)
    {

        $name = strtolower(str_replace(' ', '_', $postTitle)) . '.' . $cover->getClientOriginalExtension();

        $cover->move($this->_coverDirectory, $name);

        $img = \Image::make($this->_coverDirectory . $name);

        // Make thumbs
        $img->resize(256, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($this->_coverDirectoryThumbs  . "/" . $name);

        return $name;
    }

    private function deleteOldCover($cover)
    {
        \File::delete($this->_coverDirectory . $cover);

        if(\File::exists($this->_coverDirectory . "/thumbs/" . $cover))
            \File::delete($this->_coverDirectory . "/thumbs/" . $cover  );

    }
}
