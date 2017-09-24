<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function deleted(){
        $posts = Posts::onlyTrashed()
        ->with('author')
        ->paginate(15);
        return view('post.deleted', compact('posts'));
    }

    public function delete($postID){
        $delete = Posts::where('id', $postID)->delete();

        if($delete){
            if ($this->request->ajax()) {
                return json_encode([
                    'response' => 'true',
                    'message' => "Post deleted successfully."
                ]);
            }
            //Normal Request
            return response()
                ->redirectToRoute('post')
                ->with([
                    'message.type' => 'text-success',
                    'message.content' => 'Post deleted successfully.'
                ]);
        }
    }

    public function deleteDeleted($postID){
        $delete = Posts::where('id', $postID)->forceDelete();

        if($delete){
            if ($this->request->ajax()) {
                return json_encode([
                    'response' => 'true',
                    'message' => "Post permanently deleted."
                ]);
            }
            //Normal Request
            return response()
                ->redirectToRoute('post')
                ->with([
                    'message.type' => 'text-success',
                    'message.content' => 'Post permanently deleted.'
                ]);
        }
    }

    public function restore($postID){
        Posts::where('id', $postID)->restore();
        return redirect()
            ->route('post.deleted')
            ->with([
                'message.type' => 'text-success',
                'message.content' => 'Post has been successfully restored'
            ]);
    }

    public function index()
    {
        $posts = Posts::with('author')->paginate(15);
        return view('post.index', compact('posts'));
    }

    public function edit($id){
        $post = Posts::where('id', $id)->first();
        return view('post.edit', compact('post'));
    }

    public function newPost()
    {
        $request = $this->request;
        $title = $request->get('title') ? $request->get('title') : "";
        return view('post.new', compact('title'));
    }

    public function create()
    {
        //Storing the request values
        $this->request = $this->request;
        //Validate the post
        $this->validatePost($this->request);

        /**
         * Processing the post from the user
         */

        $post = Posts::create([
            'user_id' => auth()->user()->id,
            'title' => $this->title(),
            'content' => $this->content(),
            'description' => $this->description(),
            'image' => $this->image(),
            'tags' => $this->tags(),
            'category_id' => $this->category_id(),
            'url' => $this->url(),
        ]);
        if ($post) {
            session()->flash('message.content', 'Your post has been created successfully at <a href="' . $this->url() . '">' . $this->url() . '</a>');
            session()->flash('message.type', 'text-success');
            return response()->redirectToRoute('post.new');
        } else {
            session()->flash('message.content', 'There is an issue creating your post, please try again');
            session()->flash('message.type', 'text-danger');
            return response()
                ->redirectToRoute('post.new');
        }
    }

    public function validatePost()
    {
        return $this->validate($this->request, [
            'title' => 'required|min:10|max:60',
            'description' => 'required|min:10|max:250'
        ], [
            'title.required' => 'The title field is required to create a new post!',
            'title.min' => 'The title field needs minimum characters of 10!',
            'title.max' => 'The title field needs not more than 60 characters!',
            'description.required' => 'The description field is required to create a new post!',
            'description.min' => 'The description field needs minimum of 10 characters to make a post!',
            'description.max' => 'The description field takes only maximum characters of 60!',
        ]);
    }

    /**
     * Get the title of the current post
     */
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

    public function image()
    {
        return is_null($this->request->get('image')) ? '' : url($this->request->get('image'));
    }

    public function tags()
    {
        return is_null($this->request->get('tag')) ? 'iCMS' : $this->request->get('tag');
    }

    public function category_id()
    {
        return is_null($this->request->get('category')) ? '1' : $this->request->get('category');
    }

    public function url()
    {
        return strtolower(camel_case(url($this->title())));
    }
}