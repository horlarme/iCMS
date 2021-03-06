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
        <div class="main-section panel">
            <div class="content">
                <div class="mostRecentPost">
                    <div class="postDisplayControl">
                        <div class='fi-list-bullet size-sd-2 list-button active'
                             title="Change the post's view to List-View"></div>
                        <div class='fi-thumbnails size-sd-2 grid-button'
                             title="Change the post's view to Grid-View"></div>
                        <div class="clear-float"></div>
                    </div>

                    <!-- Displaying the post for the page -->

                    <div class="posts" style="min-height: 400px;">
                        <?php include_once 'post.php'; ?>
                        <div class="clear-float"></div>
                    </div>
                </div>


            </div>

            <!-- Content to be shown after the most recent contents -->
            <div class="other-contents">
                <div class="content">
                </div>
            </div>

        </div>

        <?php require "left_panel.php"; ?>
        <div class="clear-float"></div>
    </div>
<?php
require 'footer.php';
