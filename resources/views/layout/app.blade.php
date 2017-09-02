<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf_token" content="{{csrf_token()}}" />
    <title>{{config('app.name')}} | @yield('title')</title>
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
<div id="wrapper">
    {{--The top most of the page--}}
    @include('layout.topbar')
    {{--The navigation of the site--}}
    @if(!Auth::guest())
        @include('layout.navbar')
    @endif

    <div id="page-wrapper"
    @if(Auth::guest())
        style="margin: 0;"
        @endif >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    {{--The header of the page--}}
                    <h2>@yield('pageTitle')</h2>
                </div>
            </div>
            {{--The content of the page--}}
            @yield('content')
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
