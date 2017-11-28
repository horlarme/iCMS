@extends('layout.app')
@section('title') Storage @stop
@section('others')
    <link rel='stylesheet' href="{{ asset('public/fancybox/dist/jquery.fancybox.min.css')}}">
    <script type="text/javascript" src="{{ asset('public/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/js/main.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <script>
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
    </script>
@stop
@section('pageText')
    <span class="text-danger">The contents of the website (posts, pages and users) can be edited, removed or manipulated from this page. Proceed with cautions!</span>
    @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <iframe class="col-xs-12 storgaeFrame" src="{{url('filemanager')}}"></iframe>
            <script>
                $('iframe.storgaeFrame').css('height', window.innerHeight - 30 +'px');
            </script>
        </div>
        <div class="clearfix"></div>
    </div>
    </div>
@stop