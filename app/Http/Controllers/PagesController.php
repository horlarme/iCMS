<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $allPages = Pages::paginate('15');
        return view('pages.index', compact('allPages'));
    }

    public function deleted()
    {
        $allPages = Pages::onlyTrashed()->paginate('15');
        return view('pages.deleted', compact('allPages'));
    }

    public function create(){
        return "";
    }

}
