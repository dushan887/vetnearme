<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:super_admin');
    }

    /**
     * Show the dashboard Blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('blog/index');
    }

    /**
     * Show the dashboard New Blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('blog/create');
    }

    
}
