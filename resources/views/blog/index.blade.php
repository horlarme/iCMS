@extends('layout.site')
@section('pageContent')
    <div class="content">
        <div class="mostRecentPost">
            <div class="postDisplayControl">
                <div class='fi-list-bullet size-sd-2 list-button active'
                     title="Change the post's view to List-View"></div>
                <div class='fi-thumbnails size-sd-2 grid-button'
                     title="Change the post's view to Grid-View"></div>
                <div class="clear-float"></div>
            </div>

            <!-- Displaying the post for the page -->
            <div class="posts" style="min-height: 400px;">
                @php($posts = posts()->paginate(10))
                @foreach($posts as $post)
                    <div class="post">
                        <div class="grid">
                            <a href="{{route('post', $post->url)}}" title="{{ucwords($post->title)}}"
                               class="postImage">
                                <img style="width: 90%;" src="{{$post->image}}" alt="{{$post->title}}"/>
                            </a>
                            <a href="{{route('post', $post->url)}}" title="{{ucwords($post->title)}}"
                               class="blogTitle">{{ucwords($post->title)}}</a>
                        </div>
                        <div class="list">
                            <a href="{{route('post', $post->url)}}" title="" class='blogImage'>
                                <img style="width: 100%;" src="{{$post->image}}" alt="{{$post->title}}">
                            </a>
                            <div class='content'>
                                <div class="content">
                                    <a href="{{route('post', $post->url)}}" title="{{ucwords($post->title)}}"
                                       class='blogTitle'>{{ucwords($post->title)}}</a>
                                    <p class="blogDescription">{!! substr($post->description, 0,250)!!}...</p>
                                </div>
                                <div class="info">
                                    <!-- CATEGORY LINK -->
                                    <a href="{{route('category', $post->category->name)}}" class="text category">
                                        <i class='fi-social-designer-news'></i> {{$post->category->name}}</a>
                                    <!-- DATE -->
                                    <a href="" class="text date"><i class='fi-calendar'></i> {{$post->created_at->format('D d M, Y')}}
                                    </a>
                                    <!-- POST VIEWS -->
                                    <p class="text views"><i class='fi-eye'></i> {{$post->views}} Views</p>
                                    <div class="clear-float"></div>
                                </div>
                            </div>
                            <div class="clear-float"></div>
                        </div>
                        <div class="clear-float"></div>
                    </div>
                @endforeach
                <div class="clear-float"></div>
                <!--//Opening the pagination division tag-->
                {{$posts->links('vendor.pagination.frame')}}
            </div>
        </div>
    </div>
@stop