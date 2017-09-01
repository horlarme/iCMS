@extends('layout.app')
@section('title') Category - {{$name}} @stop
@section('pageTitle') Posts in {{strtolower($name)}} (Total: <small>{{count($posts)}}</small>)<hr /> @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-inverse">
                    <tr>
                        <th>TITLE</th>
                        <th>AUTHOR</th>
                        <th>VIEWS</th>
                        <th>CREATED</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ ucwords($post->title) }}</td>
                        <td>{{ ucwords($post->name) }}</td>
                        <td>{{ ucwords($post->title) }}</td>
                        <td>{{ strtolower($post->icon) }}</td>
                        <td>
                            <a href="{{route('post.edit', $post->name)}}" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="{{route('post.delete', $post->name)}}" class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                    {{ $categories->links()}}
            </div>
        </div>
    </div>
@stop