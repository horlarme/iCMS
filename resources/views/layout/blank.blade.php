<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{setting('name', settingParent('app'))}} | @yield('title')</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{asset('css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{asset('img/favicon.png') }}" rel="icon"/>
    <!-- FONTAWESOME STYLES-->
    <link href="{{asset('css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{asset('css/foundation-icons.css') }}" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="{{asset('css/custom.css') }}" rel="stylesheet"/>
    <!-- GOOGLE FONTS-->
    <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
    <!-- JQUERY SCRIPTS -->
    <script src="{{asset('js/jquery-1.10.2.js')}}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    @yield('others')
</head>
<body>
<div id="wrapper" style="margin: 0;">
    {{--The top most of the page--}}
    {{--@include('layout.topbar')--}}

    <div id="page-wrapper" style="margin: 0; padding: 0;">
        <div id="page-inner" style="height: 100%;">
            {{--The content of the page--}}
            @yield('content')
            <div class="clearfix"></div>
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>

<!-- METISMENU SCRIPTS -->
<script src="{{asset('js/jquery.metisMenu.js')}}"></script>
<!-- CUSTOM SCRIPTS -->
<script src="{{asset('js/custom.js')}}"></script>

</body>
</html>
