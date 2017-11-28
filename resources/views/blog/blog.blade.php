@extends('layout.site')
@section('pageTitle') {{getApp('name') . " - " . $post->title}} @stop
@section('pageDescription'){{$post->description}} @stop
@section('pageContent')
    <div class="post single-post">
        <div class="pagemovement">
            <a href="{{route('home')}}">Home</a>&nbsp;&raquo;&nbsp;<a
                    href="{{route('category', $post->category->name)}}">{{$post->category->name}}</a>&nbsp;&raquo;&nbsp;<a
                    href="{{route('post', $post->url)}}">{{ucwords($post->title)}}</a>
        </div>
        <div class="posthead">
            <img class="postimage mobile" src="{{$post->image}}"/>
            <div class="postimage otherdevices">
                <img src="{{$post->image}}"/>
            </div>
            <h3 class="posttitle">{{$post->title}}</h3>
            <div class="postinfo">
                <a href="">
                    <i class="fi-calendar"></i> {{$post->created_at->format('D d M, Y')}}
                </a>&nbsp;|&nbsp;<a href="{{route('category', $post->category->name)}}">
                    <i class="{{$post->category->icon}}"> </i>{{$post->category->name}}</a>&nbsp;|&nbsp;
                <i class="fi-eye"></i> {{$post->views}} views <br/>
            </div>
            <div class="socialsharing">
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox_3hyo"></div>
            </div>
        </div>

        <div class="post_content">
            <!--Contents will be displayed here-->
        {!! $post->content !!}
        <!-- Showing the post share buttons again at the bottom of the page-->
            <div class="socialsharing">
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox_3hyo"></div>
            </div>
        </div>

        <style>
            .post-tag a {
                font-size: 80%;
            }
        </style>
        <div class="post-tag"><!-- Post's Tag -->
            <div class="float-left" style="font-weight: bold;">Tags:</div>
            {{--displaying the list of tags for the post--}}
            @foreach (explode(",", $post->tags) as $tag)
                <a href='{{route('tag',$tag)}}' class='fi-price-tag'>{{$tag}}</a>&nbsp;
            @endforeach
        </div>

        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div class="addthis_relatedposts_inline"></div>
    </div>
    <div class="advert">
    </div>
@stop

@section('pageOtherContent')
    <div class="content">
        <div class="comments" id='comments'>
            {!! getApp('disqus')!!}
        </div>
        <div class="clear-float"></div>
    </div>
@stop