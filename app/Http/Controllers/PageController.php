<?php

namespace App\Http\Controllers;

use App\Pages;
use App\Posts;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return view('user.dashboard');
    }

    public function storage()
    {
        return view('storage');
    }

    public function home()
    {
        return view('blog.index');
    }

    public function viewPost($postURL)
    {
        $post = $this->thisPost($postURL);
        $this->increaseViews($post);
        return view('blog.blog', compact('post'));
    }

    public function viewPage($pageTitle)
    {
        /**
         * Do not want to convince 'advance' with a post
         */
        if(strtolower($pageTitle) == 'advance'){
            return response()
                ->redirectToRoute('dashboard');
        }
        
        $page = $this->thisPage($pageTitle);
        return view('blog.page', compact('page'));
    }

    public function thisPost($postURL)
    {
        return Posts::with('author', 'category')
            ->where('url', $postURL)
            ->firstOrFail();
    }

    public function thisPage($pageTitle)
    {
        return Pages::where('title', $pageTitle)
            ->firstOrFail();
    }

    public function increaseViews($post)
    {
        $post->views = $post->views + 1;
        $post->save();
    }

    public function byCategory($categoryName)
    {
        return view('blog.category', compact('categoryName'));
    }

    public function byTag($tag)
    {
        return view('blog.tag', compact('tag'));
    }

}
