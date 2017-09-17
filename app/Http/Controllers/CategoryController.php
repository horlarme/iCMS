<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $request;

    public function index()
    {
        $categories = Category::paginate(15);
        return view('category.index', compact('categories'));
    }

    public function create(Request $request)
    {
        return view('category.new');
    }

    public function edit($name, Request $request)
    {
        if (strtolower($name) === 'undefined') {
            return response()
                ->redirectToRoute('categories')
                ->with('message.content', 'Undefined cannot be edited.')
                ->with('message.type', 'text-danger');
        }
        $category = category($name);
        $name = $category->name;
        $icon = $category->icon;
        $title = $category->title;

        return view('category.edit', compact('name', 'title', 'icon'));
    }

    public function process(Request $request)
    {
        $this->request = $request;

        $this->validateForm();

        //Todo: Send the information to the database
        $create = Category::create([
            'name' => $this->name(),
            'title' => $this->title(),
            'icon' => $this->icon()
        ]);

        if ($create) {
            return response()
                ->redirectToRoute('category.create')
                ->withInput()
                ->with('message.content', 'Category created successfully')
                ->with('message.type', 'text-success');
        } else {
            return back()
                ->withInput()
                ->with('message.content', 'There was an error creating your category! Try Agan')
                ->with('message.type', 'text-danger');
        }
    }

    public function validateForm($unique = '')
    {
        if ($unique != '' || null) {
            $unique = ',' . $unique;
        } else {
            $unique = '';
        }
        return $this->validate($this->request, [
            'name' => 'required|min:3|max:20|unique:categories,name' . $unique,
            'description' => 'required|min:5|max:100'
        ], [
            'name.required' => 'The title field is required to create a new category!',
            'description.required' => 'The description field is required to create a new category!',
        ]);
    }

    public function name()
    {
        //Todo: Get category name
        return $this->request->get('name');
    }

    public function title()
    {
        //Todo: Get category title
        return $this->request->get('description');
    }

    public function icon()
    {
        //Todo: Get category icon
        return is_null($this->request->get('icon')) ? '' : $this->request->get('icon');
    }

    public function delete($name, Request $request)
    {
        $this->request = $request;
        if (strtolower($name) === 'undefined') {
            return response()
                ->redirectToRoute('categories')
                ->with('message.content', 'Undefined cannot be edited.')
                ->with('message.type', 'text-danger');
        }

        category($name)->delete();
        /**
         * Each category can be deleted through ajax, which will make use
         * test if the request is ajax to determine the response we send back.
         */
        //AJAX / XMLHttpRequest
        if ($this->request->ajax()) {
            return json_encode([
                'response' => 'true',
                'message' => ucwords($name) . " was deleted successfully."
            ]);
        }
        //Normal Request
        return response()
            ->redirectToRoute('categories')
            ->with([
                'message.type' => 'text-success',
                'message.content' => ucwords($name) . ' was deleted successfully.'
            ]);
    }

    public function update($name, Request $request)
    {
        //Saving Request Object to be used across class
        $this->request = $request;

        /**
         * Getting the information from the database
         */
        $category = category($name);

        /**
         * Validating form and specifying a parameter of String which corresponds to the name of the old name value
         * This tells the method we are updating and not creating new database value
         * The idea is it ignore the name of the column in the database if the name already exist
         */
        $this->validateForm($category->id);

        /**
         * Updating the verified data
         */
        $category->name = $this->name();
        $category->title = $this->title();
        $category->icon = $this->icon();
        $category->save();

        return response()
            ->redirectToRoute('category.update', $category->name)
            ->with([
                'message.type' => 'text-success',
                'message.content' => 'Category updated successfully.'
            ]);
    }

    /**
     * This method check if the
     * @return bool
     */
    protected function isDefault()
    {
        $name = strtolower($this->request->get('name'));
        if ($name === 'undefined') {
            return responce()
                ->redirectToRoute('categories')
                ->with('message.content', 'Undefined cannot be edited.')
                ->with('message.type', 'text-danger');
        }
    }
}
