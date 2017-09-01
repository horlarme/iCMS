@extends('layout.app')
@section('title') Dashboard @stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('post.new')}}" method="POST">
                <div class="form-group">
                    <label for="blogtitle">Qucik Post</label>
                    <input type="text" name="blogtitle" class="form-control"
                           placeholder="Enter post title here...">
                    <p class="help-block">Enter the post title into the above input box and click on "Create
                        Post" to start a new post with the title filled.</p>
                </div>
                <div class="form-group">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-success" value="Create Post" name="new-post">
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Top 5 Viewed Posts</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Views</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>201</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>201</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>201</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>201</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>201</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12">
            <h5>Scheduled Posts</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Schedule To</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Tue 11 Mar, 2017</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i
                                        class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Tue 11 Mar, 2017</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i
                                        class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Tue 11 Mar, 2017</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i
                                        class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Tue 11 Mar, 2017</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i
                                        class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Tue 11 Mar, 2017</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i
                                        class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Tue 11 Mar, 2017</td>
                        <td>This Is A Simple Post</td>
                        <td>Programming</td>
                        <td>
                            <a href="post-edit.html" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="post-delete.html" class="btn btn-danger"><i
                                        class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop