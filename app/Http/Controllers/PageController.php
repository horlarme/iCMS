<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
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

}
