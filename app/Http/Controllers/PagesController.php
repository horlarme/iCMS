<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $allPages = Pages::paginate('15');
        return view('pages.index', compact('allPages'));
    }
}
