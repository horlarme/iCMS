@extends('layout.app')
@section('title') Category List @stop
@section('pageHeader') All Categories @stop
@section('pageAction')
    <a href="{{route('category.new')}}" class="col-xs-12 btn btn-success">
        <i class="fi-clipboard-pencil"></i> Create Category</a>
@stop
@section('pageText') This page list all the categories available on the site both the deleted and the published. @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-inverse">
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Icon</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- {{dd($categories)}} --}}
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ ucwords($category->name) }}</td>
                        <td>{{ ucwords($category->title) }}</td>
                        <td>{{ strtolower($category->icon) }}</td>
                        <td>
                            <a href="{{route('category.edit', $category->name)}}" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                            <a href="{{route('category.delete', $category->name)}}" class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</a>
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