@extends('layout.app')
@section('title') Deleted Pages @stop
@section('pageHeader') Deleted Pages  @stop
@section('pageText')
    <span class="text-danger">The pages displayed here are deleted pages and will remained deleted until permanently deleted.</span>
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
                                <a href="{{route('page.restore', $page->id)}}" class="btn btn-info"><i
                                            class="fa fa-archive"></i>Restore</a>
                                <a href="" data-delete="{{route('page.deleteDeleted', $page->id)}}" class="btn btn-danger"><i
                                            class="fa fa-trash-o"></i>Permanently Delete</a>
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