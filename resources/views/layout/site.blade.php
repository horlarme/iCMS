<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('pageTitle', (getApp('name') . " - " . getApp('tagline')))</title>
    <meta name="viewport" content="width=device-width, initial-scale= 1.0"/>
    <meta name="canonical" href=""/>
    <meta charset="UTF-8"/>
    <meta name="description" content="@yield('pageDescription', getApp('description'))"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/frame.css')}}"/><!-- Framework -->
    <!-- Foundation Icons -->
    <!--    <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">-->
    <link href="{{asset('public/css/foundation-icons.css')}}" rel="stylesheet">
    <!-- Main Web-site's Style Sheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/mainstyle.css')}}"/>
    <!-- Post Page's Style Sheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/Animate.css')}}"/>
    <!-- Fancy Box -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/jquery.fancybox.min.css')}}"/>
    <link rel="icon" href="{{asset('public/storage/favicon.png')}}"><!-- ITBlog's Favicon/Icon -->
    <!-- JQuery -->
    <!--<script type="text/javascript" src='//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>-->
    <script type="text/javascript" src="{asset('public/js/jquery-1.10.2.js')}}"></script>
    <!-- Fancy Box -->
    <script src="{{asset('public/js/jquery.fancybox.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/mainscript.js')}}"></script><!-- Main Script -->
    <!-- Automatic Margining Script -->
    <script type="text/javascript" src="{{asset('public/js/autoMargin.js')}}"></script>
    <!-- Extra Style Sheets -->
</head>
<body>

<div class="body" style="background-color: rgba(0, 0, 0, 0.04);">
    <!-- Here is where all the necessary files for the web-site's head content will be put. -->
    <div class="head-section">
        <div class="logo size-sd-12">
            <img src="{{asset('public/storage/' . getApp('logo'))}}" alt="{{getApp('name')}}" width="65%"/>
        </div>
        <div class="navigation-container">
            <div class="navigation-button animated">
                <span class="closeButton"><i class="fi-x"></i><br/>Close</span>
                <span class="openButton"><i class="fi-list"></i><br/>Menu</span>
            </div>

            <div class="navigation size-td-8 size-ld-8 size-md-10 animated">
                <a href="{{route('home')}}" title="" class=""><span class="icon fi-home"></span> Home</a>
                @foreach(categories() as $category)
                    <a href="{{route('category', $category->name)}}" title="{{$category->title}}">
                        <span class="icon {{$category->icon}}"></span> {{ucwords($category->name)}}</a>
                @endforeach
            </div>
            <div class="navigation-background"></div>
            <div class="searchPanel size-td-4 size-ld-4">
                <form action="search.php" method="get">
                    <div class="formBox center">
                        <input type="text" name="search" required class="size-sd-8 search-box">
                        <input type="submit" value="Search" class='size-sd-4 search-button button'>
                        <div class="clear-float"></div>
                    </div>
                </form>
            </div>
            <div class="clear-float"></div>
        </div>
    </div>
    <!-- Body section of the page. -->
    <div class="body-section">
        <div class="main-section panel">
        @yield('pageContent')
        <!-- Content to be shown after the most recent contents -->
            <div class="other-contents">
                <div class="content">
                    @yield('pageOtherContent')
                </div>
            </div>

        </div>

        <div class="right-section panel">
            <div class="advert content">
                @yield('pageRightAdvertContent')
            </div>
            <div class="social content">
                <div class="content">
                    <div style="width: 100%; overflow: hidden;" class="fb-page"
                         data-href="https://www.facebook.com/itblogpage/" data-small-header="true"
                         data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/itblogpage/" class="fb-xfbml-parse-ignore"><a
                                    href="https://www.facebook.com/itblogpage/">ITBlog</a></blockquote>
                    </div>
                </div>
            </div>

            <div class="advert content"></div>

            <div class="recentPosts content">
                <h1 class="header">The Recent Posts</h1>
                <div class="content">
                    @foreach(posts(10) as $post)
                        <a href="{{route('post',$post->url)}}" class="rPost">{{$post->title}}
                            <span>&nbsp;{{$post->category->name}} {{$post->created_at->format('M d, Y')}}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="advert content"></div>

            <div class="clear-float"></div>

            {{--<div class="content newsletter">--}}
            {{--<h1 class="header">Newsletter Subscription</h1>--}}
            {{--<div class="content">--}}
            {{--<p>Be the first to get the latest post and news from our website through an e-mail by subscribing to--}}
            {{--our newsletter below.</p>--}}
            {{--<div class="formBox">--}}
            {{--<input type="email" name="newsletterEmail" placeholder="Enter Your E-Mail Here..."--}}
            {{--class="inputBOX">--}}
            {{--</div>--}}
            {{--<div class="newsletterResultBox"></div>--}}
            {{--<div class="formBox">--}}
            {{--<input type="submit" value="Subscribe" class="inputBOX button" name="newsletterButton">--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}

            <div class="advert content"></div>

            <div class="tags content">
                <!--<h1 class="header">Common Tags</h1>-->
                <!--<div class="content">-->
                <!--<a href="">internet</a>-->
                <!--</div>-->
            </div>

        </div>
        <div class="clear-float"></div>
    </div>
    <footer class="foot-section">
        <div class="content">
            <div class=" size-sd-12 copywrites">
                <p>The icons used in this website is provided by <a
                            href="http://zurb.com/playground/foundation-icon-fonts-3" target="_blank"><em><strong>Foundation
                                Icon.</strong></em></a></p>
            </div>

            <div class="links">
                <h6>Join us on:</h6>
                <a href="https://www.facebook.com/itblogpage" class="footer_facebook"><span class="fi-social-facebook">&nbsp;</span>Facebook</a>
                <a href="http://www.twitter.com/ITBlogPage" class="footer_twitter"><span class="fi-social-twitter">&nbsp;</span>Twitter</a>
                <div class="clear-float"></div>
            </div>


            <div class="size-sd-12 foot">
                <a href="{{route('page', page('About Us')->title)}}" title="Get to Know what ITBlog means and is." class=""><span
                            class="fi-page-csv">&nbsp;</span>About ITBlog</a>
                <a href="{{route('page', page('Contact Us')->title)}}" onclick="showContactForm()"
                   title="Let us be there for you!" class=""><span
                            class="fi-address-book">&nbsp;</span>Contact ITBlog</a>
                <a href="advertise.php" title="Let us be there for you!" class=""><span
                            class="fi-paperclip">&nbsp;</span>Advertise</a>
                <a href="copyright.php" title="All credits given back to the rightful owners."><span
                            class="fi-social-github">&nbsp;</span>Copyrights</a>
                <p>&copy; 2016&nbsp;Lawal Oladipupo's ITBlog</p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>