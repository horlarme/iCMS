<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;
use \App\Post;

class PostController extends Controller
{
    public function create(Request $request){
        $title = $request->get('title') ? $request->get('title') : "";
    	return view('post.new', compact('title'));
    }
}