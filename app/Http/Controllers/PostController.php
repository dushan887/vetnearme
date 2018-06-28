<?php

namespace App\Http\Controllers;

use App\Post;
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

        if($model->store($data, $request)){
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

        if($model->updatePost($data, $request, $id)){

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
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $data = $request->validated();
    }
}
