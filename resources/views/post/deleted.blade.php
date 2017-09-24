@extends('layout.app')
@section('title') Deleted Posts @stop
@section('pageHeader') All Deleted Posts @stop
@section('pageAction')
    <a href="{{route('post.new')}}" class="btn btn-primary col-xs-12"><i class="fa fa-edit"></i> Create New Post</a>
@stop
@section('pageText')
    <span class="text-danger">All post displayed here are deleted and are temporary, when deleted from here again they become permanently deleted</span>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
                <h4 class="{{session()->get('message.type')}}">{{session()->get('message.content')}}</h4>
            @endif
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
                                <a href="{{route('post.restore', $post->id)}}" class="btn btn-primary"><i
                                            class="fa fa-archive"></i>Restore</a>
                                <a href="" data-delete="{{route('post.deleteDeleted', $post->id)}}" class="btn btn-danger"><i
                                            class="fa fa-trash-o"></i>Permanently Delete</a>
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