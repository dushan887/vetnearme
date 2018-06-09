<?php

namespace App\Http\Controllers;

use App\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
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
        return view('postCategories/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()
            ->json(view('postCategories/partials/_createForm')->render());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:post_categories|min:3|max:255',
        ]);

        $category = PostCategory::create($data);

        return response()->json([
            'category'     => $category,
            'messageTitle' => 'Post Category Created',
            'messageText'  => 'The post category has been created',
            'class'        => 'success'
        ]);
    }

    public function all()
    {
        return response()
            ->json(PostCategory::orderBy('name', 'desc')->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return response()
            ->json(view('postCategories/partials/_editForm', [
                'category' => PostCategory::find($id),
            ])->render());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = PostCategory::find($id);

        $data = $request->validate([
            'name' => 'required|min:3|max:255|unique:post_categories,name,' . $category->id,
        ]);

        $category->update($data);

        return response()->json([
            'category'      => $category,
            'messageTitle' => 'Service Updated',
            'messageText'  => 'The service has been updated',
            'class'        => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if(PostCategory::destroy($id))
            return response()->json([
                'messageTitle' => 'Service Deleted',
                'messageText'  => 'The service has been deleted',
                'class'        => 'success'
            ]);

         return response()->json([
                'messageTitle' => 'Alert',
                'messageText'  => '',
                'class'        => 'error'
            ]);
    }
}
