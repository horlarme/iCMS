@extends('layout.app')
@section('title') Create New Page @stop
@section('others')
    <link rel='stylesheet' href="{{ asset('fancybox/dist/jquery.fancybox.min.css')}}">
    <!-- Tags Input -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <!-- Tags Input -->
    <!-- Date Picker-->
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <!-- Date Picker-->
    <script type="text/javascript" src="{{ asset('tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{ asset('fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <script>
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
    </script>
@stop
@section('pageHeader') {{ucwords($page->title)}} @stop
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
            <form action="{{route('page.update', $page->id)}}" class="new-post" method="post" enctype="multipart/form-data">
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
                                   placeholder="Enter post title"
                                   value="{{ !is_null(old('title')) ? old('title') : $page->title }}"/>
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
                                      placeholder="Describe your post in a few lines...">{{ !is_null(old('description')) ? old('description') : $page->description}}</textarea>
                            <p class="help-block clearfix blogdescrip"></p>
                        </div>
                    </div>
                    <!--Form Input/Box-->
                    <!--Form Input/Box-->
                    <div class="col-xs-12 nopadding">
                        <textarea class="editor" name="content">{{ !is_null(old('content')) ? old('content') : $page->content}}</textarea>
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
                        <div class="panel-heading">Update</div>
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="col-xs-12">
                                    <input type="submit" name="action" class="form-control btn btn-success publish"
                                           value="Update"/>
                                    <hr/>
                                </div>
                                <div class="col-xs-6">
                                    <input type="submit" name="action" class="form-control btn-block btn btn-primary"
                                           value="Preview"/>
                                </div>
                                <div class="col-xs-6">
                                    <input type="submit" name="action" class="form-control btn btn-danger btn-block"
                                           value="Trash"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>

                    <div class="clearfix"></div>
            </form>
        </div>
    </div>
@stop