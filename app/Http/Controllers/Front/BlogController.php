<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\PostCategory;

use App\Helpers\XSS;

class BlogController extends Controller
{
    /**
     * Show the application Blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Front.blog.index', [
            'posts' => Post::paginate(20),
        ]);
    }

    /**
     * Show the single blog
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        return view('Front.blog.show',[
            'post'        => Post::where('permalink', XSS::clean($slug))->first(),
            'categories'  => PostCategory::all(),
            'recentPosts' => Post::orderBy('created_at', 'desc')->limit(8)->get(),
        ]);
    }

    /**
     * Show the Blog Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        return view('Front.blog.category');
    }

     /**
     * Show the Blog Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function category2()
    {
        return view('Front.blog.category2');
    }

     /**
     * Show the Blog Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function category3()
    {
        return view('Front.blog.category3');
    }

    /**
     * Show the Blog Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post()
    {
        return view('Front.blog.post');
    }
    /**
     * Show the Blog Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post2()
    {
        return view('Front.blog.post2');
    }
    /**
     * Show the Blog Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post3()
    {
        return view('Front.blog.post3');
    }
    /**
     * Show the Blog Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post4()
    {
        return view('Front.blog.post4');
    }
    /**
     * Show the Blog Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post5()
    {
        return view('Front.blog.post5');
    }
    /**
     * Show the Blog Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post6()
    {
        return view('Front.blog.post6');
    }
    /**
     * Show the Blog Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post7()
    {
        return view('Front.blog.post7');
    }
    /**
     * Show the Blog Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post8()
    {
        return view('Front.blog.post8');
    }
    /**
     * Show the Blog Post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post9()
    {
        return view('Front.blog.post9');
    }
}
