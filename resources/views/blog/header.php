<!DOCTYPE html>
<html lang="en">
<head>

    <title><?php echo isset($pageTitle) ? $pageTitle : PAGE_TITLE; ?></title>
    <link rel="manifest" href="/manifest.json">
    <meta name='Author' content="Lawal Oladipupo"/>
    <meta name="viewport" content="width=device-width, initial-scale= 1.0"/>
    <meta name="canonical" href="<?php echo $blog->get_pageURL(); ?>"/>
    <meta charset="UTF-8"/>
    <meta name="description" content="<?= PAGE_DESCRIPTION; ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo APP_ADD; ?>stylesheet/frame.css"/><!-- Framework -->
    <!-- Foundation Icons -->
    <!--    <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">-->
    <link href="<?= APP_ADD; ?>stylesheet/foundation-icons.css" rel="stylesheet">
    <!-- Main Web-site's Style Sheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo APP_ADD; ?>stylesheet/mainstyle.css"/>
    <!-- Post Page's Style Sheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo APP_ADD; ?>stylesheet/Animate.css"/>
    <link rel="icon" href="<?php echo APP_ADD; ?>images/favicon.png"><!-- ITBlog's Favicon/Icon -->
    <script type="text/javascript" src='//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script><!-- JQuery -->
    <script type="text/javascript" src='<?php echo APP_ADD; ?>script/mainscript.js'></script><!-- Main Script -->
    <script type="text/javascript" src='<?php echo APP_ADD; ?>script/autoMargin.js'></script>
    <!-- Automatic Margining Script -->

    <!-- Extra Style Sheets -->
    <?php
    //CSS include code
    if (isset($css)) {
        foreach ($css as $style) {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $style . "\"/>";
        }
    }
    ?>
    <!-- Extra Javascript Codes-->
    <?php
    //Javascript include code
    if (isset($js)) {
        foreach ($js as $script) {
            echo "<script type=\"text/javascript\" src=\"" . $script . "\"></script>";
        }
    }
    ?>

    <!-- Google  Code -->
    <meta name="google-site-verification" content="jWZOtCJkCGgKyw2mgZit5hEzq6aU-PoMztGur0H1ciw"/>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-1259989652061886",
            enable_page_level_ads: true
        });
    </script>
    <!-- Google Analytic Code -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-90904178-1', 'auto');ga('send', 'pageview');
    </script>
    <!-- Google Analytic Code -->
    
    <!-- OneSignal Notification -->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(["init", {
            appId: "504da950-0508-41b6-a15c-c60907b67e4c",
            autoRegister: true,
            subdomainName: 'itblogcomng',
            safari_web_id: 'web.onesignal.auto.5f4f9ed9-fb2e-4d6a-935d-81aa46fccce0',
            notifyButton: {
                enable: true
            },
            httpPermissionRequest: {
                enabled: true,
                modalTitle: 'Thanks for subscribing',
                modalMessage: "You're now subscribed to notifications. You can unsubscribe at any time.",
                modalButtonText: 'Close'
            },
            promptOptions: {
                autoAcceptTitle: 'Click Allow'
            }
        }]);
    </script>
    <!-- OneSignal Notification -->

    <!-- Facebook Open Graph Meta -->
    <meta property="fb:pages" content="1606181876320944" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?= $blog->get_pageURL(); ?>" />
    <meta property="og:title" content="<?= $blog->get_pageTitle($title); ?>" />
    <meta property="og:description" content="<?= $blog->get_pageDescription($description); ?>" />
    <meta property="og:image" content="<?= $blog->get_pageImage($image); ?>" />
    <!-- Twitter Open Graph Meta Tags -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@ITBlogPage" />
    <meta name="twitter:title" content="<?= $blog->get_pageTitle($title); ?>" />
    <meta name="twitter:description" content="<?= $blog->get_pageDescription($description); ?>" />
    <meta name="twitter:image" content="<?= $blog->get_pageImage($image); ?>" />
</head>

<body>
<!-- Google Tag Manager -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TVQPDTG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="fb-root"></div>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1887696564820120',
            xfbml      : true,
            version    : 'v2.9'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<div class="body" style="background-color: rgba(0, 0, 0, 0.04);">
    <!-- Here is where all the necessary files for the web-site's head content will be put. -->
    <div class="head-section">
        <div class="logo size-sd-12">
            <img src="<?= APP_ADD; ?>images/logo.png" alt="ITBlog" width="65%"/>
        </div>
        <div class="navigation-container">

            <div class="navigation-button animated">
                <span class="closeButton"><i class="fi-x"></i><br/>Close</span>
                <span class="openButton"><i class="fi-list"></i><br/>Menu</span>
            </div>

            <div class="navigation size-td-8 size-ld-8 size-md-10 animated">
                <a href="<?= APP_ADD; ?>index.php" title="" class=""><span class="icon fi-home"></span> Home</a>
                <?php
                $fromClass = $blog->categories();
                foreach ($fromClass as $category) {
                    echo "<a href=\"" . APP_ADD . strtolower($category['name']) . "/\" title=\"" . $category['title'] . "\"><span class=\"icon " . $category['icon'] . "\"></span> " . $category['name'] . "</a>";
                }
                ?>
            </div>
            <div class="navigation-background"></div>
            <div class="searchPanel size-td-4 size-ld-4">
                <form action="<?= APP_ADD; ?>search.php" method="get">
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

