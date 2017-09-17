@extends('layout.app')
@section('title') All Published Posts @stop
@section('pageHeader') All Published Posts @stop
@section('pageAction')
    <a href="{{route('post.new')}}" class="btn btn-primary col-xs-12"><i class="fa fa-edit"></i> Create New Post</a>
@stop
@section('pageText')
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
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
                                <a href="{{url($post->title)}}">{{ ucwords($post->title) }}</a>
                            </td>
                            <td>
                                {{ ucwords($post->author->first_name . " " . $post->author->last_name) }}
                            </td>
                            <td>{{ substr($post->description, 0, 120) }}</td>
                            <td>
                                <a href="{{route('post.edit', $post->id)}}" class="btn btn-primary"><i
                                            class="fa fa-edit"></i>Edit</a>
                                <a href="{{route('post.view', $post->name)}}" class="btn btn-danger"><i
                                            class="fa fa-trash-o"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $posts->links()}}
            </div>
        </div>
    </div>
@stop