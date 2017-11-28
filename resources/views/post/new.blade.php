@extends('layout.app')
@section('title') Create New Post @stop
@section('others')
    <link rel='stylesheet' href="{{ asset('public/fancybox/dist/jquery.fancybox.min.css')}}">
    <!-- Tags Input -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <!-- Tags Input -->
    <!-- Date Picker-->
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <!-- Date Picker-->
    <script type="text/javascript" src="{{ asset('public/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/js/main.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <script>
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
    </script>
@stop
@section('pageHeader') Create A New Post Content @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
                <h4 class="{{session()->get('message.type')}}">{!! session()->get('message.content') !!}</h4>
            @endif
            @if($errors->any())
                <ul class="alert alert-danger">
                    <h4>Please go through the following errors:</h4>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{route('post.create')}}" class="new-post" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-xs-12 col-md-8 form-group form-horizontal">
                    <!-- Post Title-->
                    <div class="col-xs-12 nopadding <?php echo ($errors->has('title')) ? 'has-error' : ""?>">
                        <div class="col-xs-3 nopadding">
                            <input type="button" value="Title:" disabled="" class="btn btntotext align-right"/>
                        </div>
                        <div class="col-xs-9 nopadding">
                            <input type="text" id="blogtitle" name="title"
                                   class="blogtitle form-control"
                                   placeholder="Enter post title" value="{{ old('title') }}"/>
                            <p class="help-block suggestedURL clearfix"></p>
                        </div>
                    </div>
                    <!-- Post Description-->
                    <div class="col-xs-12 nopadding <?php echo ($errors->has('description')) ? 'has-error' : ""?>">
                        <div class="col-xs-3 nopadding">
                            <input type="button" value="Description:" disabled="" class="btn btntotext align-right"/>
                        </div>
                        <div class="col-xs-9 nopadding">
                            <textarea name="description" rows='6' maxlength="250" onkeyup="checkDescription()"
                                      class="form-control blogdescription"
                                      placeholder="Describe your post in a few lines...">{{old('description')}}</textarea>
                            <p class="help-block clearfix blogdescrip"></p>
                        </div>
                    </div>
                    <!--Form Input/Box-->
                    <!--Form Input/Box-->
                    <div class="col-xs-12 nopadding">
                        <textarea class="editor" name="content">{{old('content')}}</textarea>
                    </div>
                    <script type="text/javascript">
                        //Configuration for the editor
                        var height = window.innerHeight - 30;

                        tinymce.init({
                            selector: '.editor',
                            inline: false,
                            plugins: 'fullscreen fullpage hr image layer link lists media paste preview save spellchecker table textcolor emoticons autolink wordcount anchor autolink code colorpicker imagetools visualchars contextmenu responsivefilemanager',
                            theme: 'modern',
                            toolbar: 'undo redo | hr bold italic underline superscript subscript textcolor link | alignleft aligncenter alignright alignjustify | paragraph blockquote pre div | code save | lists table link media image imagetools | fullscreen spellchecker',
                            file_browser_callback: function (field_name, url, type, win) {
                                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                                var cmsURL = '{{ url(config('lfm.prefix')) }}?field_name=' + field_name;
                                if (type == 'image') {
                                    cmsURL = cmsURL + "&type=Images";
                                } else {
                                    cmsURL = cmsURL + "&type=Files";
                                }

                                tinyMCE.activeEditor.windowManager.open({
                                    file: cmsURL,
                                    title: 'Filemanager',
                                    width: x * 0.8,
                                    height: y * 0.8,
                                    resizable: "yes",
                                    close_previous: "no"
                                });
                            },
                            menubar: true,
                            height: height
                        });
                    </script>
                    <!--Form Input/Box-->
                </div>
                <!--The Left Panel Option-->
                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Blog Image</div>
                        <div class="panel-body">
                            <img class="blogImageUpload img img-responsive thumbnail" src="{{old('image')}}"
                                 id="blogImageUpload" style="margin-bottom: 15px;width: 100%;"/>
                            <input id="thumbnail" type="hidden" name="image" value="{{old('image')}}">
                            <div class="form-group col-xs-offset-1 col-xs-5">
                                <a data-preview="blogImageUpload" data-input="thumbnail"
                                   class="form-control uploadImage btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </div>
                            <div class="form-group col-xs-5">
                                <a class="form-control removeUploadImage btn btn-danger">
                                    <i class="fa fa-ban"></i> Remove
                                </a>
                            </div>
                            <script>
                                $('.uploadImage').filemanager('image', {prefix: '{{ url(config('lfm.prefix')) }}'});
                            </script>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">Category</div>
                        <div class="panel-body <?php echo ($errors->has('title')) ? 'has-error' : ""?>">
                            @php($categories = \App\Category::all())
                            @foreach($categories as $c)
                                <input type="radio" name="category" value="{{ $c['id'] }}"/> {{ strtoupper($c['name'])}}
                                <br/>
                            @endforeach
                            <p class="help-block text-warning">If none is selected, then UNDEFINED will be used
                                instead.</p>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">Tags</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" name="tag" data-role="tagsinput"
                                       placeholder="Separate Tags with comma ',' or Command (Enter) key"
                                       class="blogTag form-control">
                            </div>
                            <style>
                                .bootstrap-tagsinput {
                                    width: 100%;
                                }
                            </style>
                            <script>
                                $(document).ready(function () {
                                    $('.bootstrap-tagsinput input').addClass('form-control');
                                })
                            </script>
                        </div>
                        <div class="panel-footer">
                            Don't leave spaces after each comma and don't leave a comma as the last character...
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">Publish</div>
                        <div class="panel-body">
                            {{--<input type="checkbox" name="schedule" value="no" checked class="postnow"> Toggle this box--}}
                            {{--to switch between posting and scheduling.--}}
                            <input type="submit" name="action" class="form-control btn btn-success publish"
                                   value="Publish"/>
                            {{--<div class="schedulePost" style="display: none;">--}}
                                {{--<p>Publish this post on the following information.</p>--}}
                                {{--<label for="scheduleDate" class="col-xs-3">Date:</label>--}}
                                {{--<input type="date" name="scheduleDate" class="col-xs-9"/>--}}
                                {{--<div class="clearfix"></div>--}}
                                {{--<label for="scheduleTime" class="col-xs-3">Time:</label>--}}
                                {{--<input type="time" name="scheduleTime" class="col-xs-9"/>--}}

                                {{--<input type="submit" class="col-xs-12 schedulePostButton btn btn-primary"--}}
                                       {{--value="Schedule" name="action"/>--}}
                            {{--</div>--}}
                            {{--<input type="submit" name="action" class="form-control btn-block col-xs-6"--}}
                                   {{--value="Preview" style="color: blue;"/>--}}
                            {{--<input type="submit" name="action" class="form-control col-xs-6 btn-block"--}}
                                   {{--value="Draft" style="color: blue;"/>--}}
                        {{--</div>--}}
                        <div class="clearfix"></div>
                    </div>

                </div>

                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@stop