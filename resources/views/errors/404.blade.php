@extends('layout.site')
@section('pageTitle') Not Found @stop
@section('pageContent')
    <div class="posts about-us align-justify" style="min-height: 400px;">
        <h1 style="text-align: center;">404 Error Page.</h1><hr />
        <p>You are directed here because of the one of the following reasons:</p>
            <ul>
            <li>Broken Link</li>
            <li>Deleted Post</li>
            <li>Mistakenly Typed Address</li>
        </ul>
        <p>Please cross-check the link provided to you or <a href="{{route('home')}}">click here</a> to go to the home page and check for other posts.</p>

        <div class="clear-float"></div>
    </div>
@stop