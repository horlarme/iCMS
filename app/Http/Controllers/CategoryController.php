<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(15);
        return view('category.index', compact('categories'));
    }

    public function view($name, Request $request)
    {
        //Using the Category Model
        $category = new Category;
        //Getting the category using the method category()
        //with a parameter of $name which contains the name of the
        //Category
        $category = $category->category($name);

        //Getting the posts associated with the specified category id
        return $posts = Category::find($category->id)->load('posts');
        //Return the category/view page
        return view('category.view', compact('posts', 'category'));
    }

    public function edit($name, Request $request)
    {

    }

    public function delete($name, Request $request)
    {

    }
}
