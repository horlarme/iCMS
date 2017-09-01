@extends('layout.app')
@section('title') Create New Post @stop
@section('others')
    <link rel='stylesheet' href="{{ asset('fancybox/dist/jquery.fancybox.min.css')}}">
    <script type="text/javascript" src="{{ asset('tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{ asset('fancybox/dist/jquery.fancybox.min.js')}}"></script>
@stop
@section('pageTitle') New Post
<hr/> @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="post-create.html" class="new-post" method="POST" enctype="multipart/form-data">

                <div class="col-xs-12 col-md-8 form-group form-horizontal">
                    <!-- Post Title-->
                    <div class="col-xs-12 nopadding">
                        <div class="col-xs-3 nopadding">
                            <input type="button" value="Title:" disabled="" class="btn btntotext align-right" />
                        </div>
                        <div class="col-xs-9 nopadding">
                            <input type="text" id="blogtitle" name="blogtitle" class="blogtitle form-control"
                                   placeholder="Enter post title" value="{{ $title }}" />
                            <p class="help-block suggestedURL clearfix"></p>
                        </div>
                    </div>
                    <!-- Post Description-->
                    <div class="col-xs-12 nopadding">
                        <div class="col-xs-3 nopadding">
                            <input type="button" value="Description:" disabled="" class="btn btntotext align-right"/>
                        </div>
                        <div class="col-xs-9 nopadding">
                            <textarea name="blogdescription" rows='6' onkeyup="checkDescription()"
                                      class="form-control blogdescription"
                                      placeholder="Describe your post in a few lines..."></textarea>
                            <p class="help-block clearfix blogdescrip"></p>
                        </div>
                    </div>
                    <!--Form Input/Box-->
                    <!--Form Input/Box-->
                    <div class="col-xs-12 nopadding">
                        <textarea class="editor" name="blogcontent"></textarea>
                    </div>
                    <script type="text/javascript">
                        //Configuration for the editor
                        var height = window.innerHeight - 30;

                        tinymce.init({
                            selector: '.editor',
                            inline: false,
                            plugins: 'fullscreen fullpage hr image layer link lists media paste preview save spellchecker table textcolor emoticons autolink wordcount anchor autolink code colorpicker imagetools visualchars contextmenu responsivefilemanager',
                            theme: 'modern',
                            toolbar: 'undo | hr bold italic underline superscript subscript textcolor link | alignleft aligncenter alignright alignjustify | paragraph blockquote pre div | code save | lists table link media image imagetools | fullscreen spellchecker| responsivefilemanager',
                            external_filemanager_path: "{{ asset('/filemanager/resources/filemanager/')}}",
                            filemanager_title: "File Manager",
                            external_plugins: {"filemanager": "{{ asset('/filemanager/resources/filemanager/plugin.min.js')}}"},
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
                            <img class="blogImageUpload" style="width: 100%;"/>
                            <input type="hidden" name="blogimage" value=""/>
                            <input type="file" onchange="uploadImage(this.files[0])"/>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">Category</div>
                        <div class="panel-body">

                            @php($categories = \App\Category::all())
                            @foreach($categories as $c)
                                <input type="radio" name="category" value="{{ $c['id'] }}"/> {{ strtoupper($c['name'])}}
                                <br/>
                            @endforeach
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">Tags</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" name="tag" placeholder="Separate Tags with comma ','"
                                       class="blogTag form-control">
                            </div>
                        </div>
                        <div class="panel-footer">
                            Don't leave spaces after each comma and don't leave a comma as the last character...
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">Publish</div>
                        <div class="panel-body">
                            <input type="checkbox" name="schedule" value="no" checked class="postnow"> Toggle this box
                            to switch between posting and scheduling.
                            <input type="submit" name="action" class="form-control btn btn-success publish"
                                   value="Publish"/>
                            <div class="schedulePost" style="display: none;">
                                <p>Publish this post on the following information.</p>
                                <label for="scheduleDate" class="col-xs-3">Date:</label>
                                <input type="date" name="scheduleDate" class="col-xs-9"/>
                                <div class="clearfix"></div>
                                <label for="scheduleTime" class="col-xs-3">Time:</label>
                                <input type="time" name="scheduleTime" class="col-xs-9"/>

                                <input type="submit" class="col-xs-12 schedulePostButton btn btn-primary"
                                       value="Schedule" name="action"/>
                            </div>
                            <input type="submit" name="action" class="form-control btn-block col-xs-6"
                                   value="Preview" style="color: blue;"/>
                            <input type="submit" name="action" class="form-control col-xs-6 btn-block"
                                   value="Draft" style="color: blue;"/>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>

                <div class="clearfix"></div>
        </div>


        <div class="clearfix"></div>
        </form>
    </div>
    </div>
@stop