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

    public function delete($pageID)
    {
        $delete = Pages::where('id', $pageID)->delete();

        if ($delete) {
            if ($this->request->ajax()) {
                return json_encode([
                    'response' => 'true',
                    'message' => "Page deleted successfully."
                ]);
            }
            //Normal Request
            return response()
                ->redirectToRoute('post')
                ->with([
                    'message.type' => 'text-success',
                    'message.content' => 'Page deleted successfully.'
                ]);
        }
    }

    public function deleteDeleted($pageID)
    {
        $delete = Pages::where('id', $pageID)->forceDelete();

        if ($delete) {
            if ($this->request->ajax()) {
                return json_encode([
                    'response' => 'true',
                    'message' => "Page permanently deleted."
                ]);
            }
            //Normal Request
            return response()
                ->redirectToRoute('pages')
                ->with([
                    'message.type' => 'text-success',
                    'message.content' => 'Page permanently deleted.'
                ]);
        }
    }

    public function restore($pageID)
    {
        Pages::where('id', $pageID)->restore();
        return redirect()
            ->route('pages.deleted')
            ->with([
                'message.type' => 'text-success',
                'message.content' => 'Page has been successfully restored'
            ]);
    }

    public function deleted()
    {
        $allPages = Pages::onlyTrashed()->paginate('15');
        return view('pages.deleted', compact('allPages'));
    }

    public function newPage()
    {
        $request = $this->request;
        $title = $request->has('title') ? $request->get('title') : "";
        return view('pages.new', compact('title'));
    }

    public function validatePage($unique = '')
    {
        if ($unique != '' || null) {
            $unique = ',' . $unique;
        } else {
            $unique = '';
        }

        return $this->validate($this->request, [
            'title' => 'required|min:4|max:60|unique:pages,title' . $unique,
            'description' => 'required|min:10|max:250'
        ], [
            'title.required' => 'The title field is required to create a new page!',
            'title.min' => 'The title field needs minimum characters of 10!',
            'title.max' => 'The title field needs not more than 60 characters!',
            'description.required' => 'The description field is required to create a new page!',
            'description.min' => 'The description field needs minimum of 10 characters to make a page!',
            'description.max' => 'The description field takes only maximum characters of 60!',
        ]);
    }



    public function create()
    {
        //Storing the request values
        $this->request = $this->request;
        //Validate the post
        $this->validatePage();

        /**
         * Processing the page
         */

        $page = Pages::create([
            'author' => auth()->user()->id,
            'title' => $this->title(),
            'content' => $this->content(),
            'description' => $this->description()
        ]);

        if ($page) {
            session()->flash('message.content', 'Page created successfully');
            session()->flash('message.type', 'text-success');
            return response()->redirectToRoute('page.edit', $page->id);
        } else {
            session()->flash('message.content', 'There is an issue creating your page, please try again');
            session()->flash('message.type', 'text-danger');
            return response()
                ->withInput()
                ->redirectToRoute('page.new');
        }
    }

    public function title()
    {
        return $this->request->get('title');
    }

    public function content()
    {
        $content = $this->request->get('content');
        return str_replace(["<!DOCTYPE html>\r\n", "<html>\r\n", "\r\n</html>", "<head>\r\n", "</head>\r\n", "<body>\r\n", "</body>"], "", $content);
    }

    public function description()
    {
        return $this->request->get('description');
    }


    public function edit($id)
    {
        $page = Pages::where('id', $id)->first();
        return view('pages.edit', compact('page'));
    }

    public function update($pageID)
    {
        $this->validatePage($pageID);

        /**
         * Processing the post from the user
         */

        $page = Pages::where('id', $pageID)->first();
        $page->update([
            'author' => auth()->user()->id,
            'title' => $this->title(),
            'content' => $this->content(),
            'description' => $this->description()
        ]);

        if ($page) {
            session()->flash('message.content', 'Page updated');
            session()->flash('message.type', 'text-success');
            return response()->redirectToRoute('page.edit', $pageID);
        } else {
            session()->flash('message.content', 'There is an issue creating your post, please try again');
            session()->flash('message.type', 'text-danger');
            return response()
                ->redirectToRoute('post.edit', $pageID);
        }
    }


}
