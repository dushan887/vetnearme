<?php

namespace App\ModelQueries;

use Illuminate\Database\Eloquent\Model;

use App\Post;
use App\Helpers\Strings;

class PostQuery extends Post
{
    protected $table = 'posts';

    private $_coverDirectory;

    public function __construct()
    {
        $this->_coverDirectory = public_path('/postsCover/');
    }

    public function store($data, $request)
    {

        if($request->hasFile('cover_image'))
            $data['cover_image'] = $this->uploadCover($request->file('cover_image'), $data['title']);

        $data['user_id'] = \Auth::id();

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

        if($post->update($data))
            return $post->id;

        return false;

    }

    public function uploadCover($cover, $postTitle)
    {

        $name = strtolower(str_replace(' ', '_', $postTitle)) . '.' . $cover->getClientOriginalExtension();

        $cover->move($this->_coverDirectory, $name);

        return $name;
    }

    private function deleteOldCover($cover)
    {
        File::delete($this->_coverDirectory . $cover);
    }
}
