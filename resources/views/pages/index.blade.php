@extends('layout.app')
@section('title') Pages List @stop
@section('pageHeader') Pages List @stop
@section('pageAction')
    <a href="{{route('page.new')}}" class="btn btn-primary col-xs-12">Create New Page</a>
@stop
@section('pageText')
    The pages are what will be shown in / among the list of menu in the page for visitors.
    @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-inverse">
                    <tr>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($allPages) < 1){?>
                        <tr>
                            <td colspan="5">There is currently no page created</td>
                        </tr>
                    <?php } ?>
                    @foreach($allPages as $page)
                        <tr>
                            <td>
                                <a href="{{url($page->title)}}">{{ ucwords($page->title) }}</a>
                            </td>
                            <td>
                                <a href="{{url($page->title)}}">{{ url($page->title) }}</a>
                            </td>
                            <td>
                                {{ ucwords($page->user->first_name . " " . $page->user->last_name) }}
                            </td>
                            <td>{{ substr($page->description, 0, 120) }}</td>
                            <td>
                                <a href="{{route('page.edit', $page->id)}}" class="btn btn-primary"><i
                                            class="fa fa-edit"></i>Edit</a>
                                <a href="" data-delete="{{route('page.delete', $page->id)}}" class="btn btn-danger"><i
                                            class="fa fa-trash-o"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $allPages->links()}}
            </div>
        </div>
    </div>
@stop