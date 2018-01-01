@extends('layout.app')
@section('title') Dashboard @stop
@section('pageHeader') My Dashboard @stop
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
            <h5>Top 10 Viewed Posts</h5>
            @php($posts = posts(10, 'views', 'DESC'))
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-inverse">
                    <tr>
                        <th><i class="fa fa-eye"></i> Views</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($posts) < 1){?>
                        <tr>
                            <td colspan="5">There is currently no page created</td>
                        </tr>
                    <?php } ?>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->views}}</td>
                            <td>
                                <a href="{{route('post', $post->url)}}">{{ ucwords($post->title) }}</a>
                            </td>
                            <td>
                                {{ ucwords($post->author->first_name . " " . $post->author->last_name) }}
                            </td>
                            <td>{{ substr($post->description, 0, 120) }}</td>
                            <td>
                                <a href="{{route('post.edit', $post->id)}}" class="btn btn-primary"><i
                                            class="fa fa-edit"></i>Edit</a>
                                <a href="" data-delete="{{route('post.delete', $post->id)}}" class="btn btn-danger"><i
                                            class="fa fa-trash-o"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop