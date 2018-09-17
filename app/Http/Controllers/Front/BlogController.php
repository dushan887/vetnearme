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
            'posts' => Post::where('status', 1)->with(['category'])->paginate(20),
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
        $post = Post::where([
            ['permalink', '=', XSS::clean($slug)],
            ['status', '=', 1],
        ])->first();

        if(!$post)
            return redirect('/blog');

        return view('Front.blog.show',[
            'post'         => $post,
            'categories'   => PostCategory::orderBy('name', 'desc')->get(),
            'posts'        => Post::orderBy('created_at', 'desc')->limit(6)->get(),
            'relatedPosts' => Post::where([
                'category_id' => $post->category_id,
                ['id', '!=', $post->id],
            ])->orderBy('created_at', 'desc')->limit(3)->get()
        ]);
    }

    /**
     * Show the Blog Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function category(string $name)
    {
        return view('Front.blog.category', [
            'categoryName' => $name,
            'posts'        => Post::whereHas('category', function ($query) use ($name) {
                $query->whereRaw("LOWER(name) = ?", strtolower(XSS::clean($name)));
            })->get()
        ]);
    }

}
