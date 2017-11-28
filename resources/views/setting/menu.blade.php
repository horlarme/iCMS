@extends('layout.app')
@section('title') Setting | {{ucwords($setting->name) }} @stop
@section('others')
    <link rel='stylesheet' href="{{ asset('public/fancybox/dist/jquery.fancybox.min.css')}}">
    <script type="text/javascript" src="{{ asset('public/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/js/main.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/js/settings.js')}}"></script>
@stop
@section('pageHeader') {{ ucwords($setting->value) }} @stop
@section('pageText')
    <span class="text-info">Every Setting of this page is updated automatically when the user leave the box.</span>
@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">

            <form action="{{route('save.setting', $setting->name)}}" class="setting">

                <div class="form-group">
                    <h4>
                        <strong>Web Site Information</strong>
                    </h4>
                    <hr/>

                    <div class="form-group">
                        <label class="col-md-2">Add Post to Menu</label>
                        <div class="col-md-10">
                            <select multiple class="form-control">
                                @foreach(posts()->get() as $post)
                                    <option value="{{$post->id}}">{{$post->title}}</option>
                                @endforeach
                            </select>
                            <p class="help-block">This will be the name the website displays.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Description:</label>
                        <div class="col-md-10">
                            <textarea name="description" class="update form-control"
                                      rows="3" maxlength="250">{{ getApp('description') }}</textarea>
                            <p class="help-block">This describe the website for search engines. It is advised to be kept
                                at maximum of 250 characters.</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2">Keywords:</label>
                        <div class="col-md-10">
                            <input type="text" name="keywords" class="update form-control"
                                   value="{{ getApp('keywords') }}"/>
                            <p class="help-block">Each keyword should be comma separated and should.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Tag Line:</label>
                        <div class="col-md-10">
                            <input type="text" name="tagline" class="update form-control" maxlength="50"
                                   value="{{ getApp('tagline') }}"/>
                            <p class="help-block">This will be the text that serves as the motto of your website and
                                will be by your site name.</p>
                        </div>
                    </div>

                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
@stop