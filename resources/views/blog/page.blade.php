@extends('layout.site')
@section('pageTitle') {{ getApp('name') . " - " . $page->title}} @stop
@section('pageDescription'){{$page->description}} @stop
@section('pageContent')
    <div class="posts" style="padding: 10px;">
        <div class="">
            <!--Contents will be displayed here-->
            {!! $page->content !!}
        </div>
    </div>
    <div class="advert">
    </div>
@stop

@section('pageOtherContent')
    <div class="content">
        <div class="comments" id='comments'>

        </div>
        <div class="clear-float"></div>
    </div>
@stop