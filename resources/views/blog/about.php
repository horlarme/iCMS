<?php
error_reporting(0);
//Composer Autoloader
require './vendor/autoload.php';
//Configuration Files
require 'class/config.php';
$dataBase = new PDO(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS);

$blog = new ITBLOG\Blogging($dataBase);

require 'header.php';
?>
<!-- Body section of the page. -->
<div class="body-section">
    <div class="advert"></div>
    <div class="main-section panel size-sd-12" style="width: 100%;">
        <div class="content">
            <div class="mostRecentPost">

                <div class="posts about-us align-left" style="min-height: 400px;">
                    <h1 style="text-align: center;">You Are Welcome To</h1>
                    <h1 style="text-align: center;"><?= APP_NAME; ?></h1>
                    <hr />
                    <h2><strong>About US</strong></h2>
                    <p>ITBlog is an Information Technology Website (blog), our purpose is to bring about the news and information about the technologies we use in our day to day activities or other purposes.</p>
                    <p>ITBlog is created by <a title="Lawal Oladipupo on Facebook" href="http://facebook.com/blessedhorlar" target="_blank"><strong>Lawal Oladipupo</strong></a> using PHP (Hypertext Pre Processor) and Javascript.</p>
                    <p>&nbsp;</p>
                    <h1 id="disclaimer"><strong>Disclamer</strong></h1>
                    <ul>
                        <li>
                            <p>On ITBlog, everything posted are written by the person whose name is written as the author and not by ITBlog itself.</p>
                        </li>
                    </ul>
                    <p>&nbsp;</p>
                    <div class="clear-float"></div>
                </div>
            </div>
        </div>

        <div class="advert">

        </div>

        <!-- Content to be shown after the most recent contents -->
        <div class="other-contents">
            <div class="content">
            </div>
        </div>

    </div>

    <div class="clear-float"></div>
</div>
<?php
require 'footer.php';
