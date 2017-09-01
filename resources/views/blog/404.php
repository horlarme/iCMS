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

                <div class="posts about-us align-justify" style="min-height: 400px;">
                    <?php // $blog->showAboutUs(); ?>
                    <h1 style="text-align: center;">404 Error Page.</h1><hr />
                    <p>You are directed here because of the one of the following reasons:</p>
                        <ul>
                        <li>Broken Link</li>
                        <li>Deleted Post</li>
                        <li>Mistakenly Typed Address</li>
                    </ul>
                    <p>Please cross-check the link provided to you or <a href="<?= APP_ADD; ?>">click here</a> to go to the home page and check for other posts.</p>

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
