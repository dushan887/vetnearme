<?php

namespace App\Http\Controllers;

use App\Helpers\XSS;

use App\Post;
use App\User;
use App\ModelQueries\PostQuery;
use App\PostCategory;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:super_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Requests\PostStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $data = $request->validated();

        $model = new PostQuery;

        if($model->store(XSS::clean($data, ['cover_image', 'body']), $request)){
            if($request->ajax()){
                $request->session()->flash('alert', [
                    'message' => 'Post successfully created',
                    'type'    => 'success'
                ]);
            } else {
                return response()->json([
                    'messageTitle' => 'Creating post failed!',
                    'messageText'  => 'Something went wrong. Please try again.',
                    'class'        => 'danger'
                ], 400);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('post/edit', [
            'id' => $id
        ]);
    }

    /**
     * Get the post data via ajax request.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function get(int $id)
    {
        return response()->json([
            'post' => Post::find($id)
        ], 200);
    }

    public function getAll(Request $request)
    {
        $posts = PostQuery::get($request);

        return response()
            ->json([
                'posts'   => $posts,
                'authors' => User::find(array_unique($posts->pluck('user_id')->all())),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Requests\App\Requests\PostStoreRequest  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, int $id)
    {
        $data = $request->validated();

        $model = new PostQuery;

        if($model->updatePost(XSS::clean($data, ['cover_image', 'body']), $request, $id)){

            if($request->ajax()){
                $request->session()->flash('alert', [
                    'message' => 'Post updated successfuly',
                    'type'    => 'success'
                ]);
            } else {
                return response()->json([
                    'messageTitle' => 'Updating post failed!',
                    'messageText'  => 'Something went wrong. Please try again.',
                    'class'        => 'danger'
                ], 400);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @integer/array $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(strpos($id, ','))
            $id = explode(',', $id);

        if( is_array($id) ){
            array_filter($id, function ($k) {
                     return is_numeric($k);
                },
            ARRAY_FILTER_USE_KEY
            );
        } else {
            $id = (int) $id;
        }

        $deleted = Post::destroy($id) ?
            $message = [
                'messageTitle' => 'Post(s) Deleted',
                'messageText'  => 'The post(s) has been deleted',
                'class'        => 'success'
            ] :
            $message = [
                'messageTitle' => 'Alert',
                'messageText'  => '',
                'class'        => 'error'
            ];

        return response()->json($message, $deleted ? 200 : 500);
    }
}
