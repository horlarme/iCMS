<?php
error_reporting(0);
require 'class/config.php';
require 'class/db.php';

function __autoload($class) {
    if (file_exists($class . ".php")) {
        include_once $class . ".php";
    } elseif (file_exists("class/" . $class . ".php")) {
        include_once "class/" . $class . ".php";
    } else {
        Throw New Exception("Can't load the class: " . $class);
    }
}

//require_once "class/blogscript.php";
$blog = new Blogging($dataBase);

require 'header.php';
?>
<!-- Body section of the page. -->
<div class="body-section">
    <div class="advert"></div>
    <div class="main-section panel">
        <div class="content">
            <div class="mostRecentPost">
                <div class="postDisplayControl">
                    <div class='fi-list-bullet size-sd-2 list-button active' title="Change the post's view to List-View"> </div>
                    <div class='fi-thumbnails size-sd-2 grid-button' title="Change the post's view to Grid-View"> </div>
                    <div class="clear-float"></div>
                </div>

                <!-- Displaying the post for the page -->

                <div class="posts" style="min-height: 400px;">
                    <?php include_once 'post.php'; ?>
                    <script type="text/javascript">
                        /**
                         * Shows the list of post
                         */
                        function showPost(show = "main") {
                            var ajaxData, post;
                            switch (show) {
                                case 'main':
                                    ajaxData = "";
                                    break;
                                case 'prev':
                                    ajaxData = "?show=prev";
                                    break;
                                case 'next':
                                    ajaxData = "?show=next";
                                    break;
                            }
                            $.ajax({
                                url: 'post.php',
                                data: ajaxData,
                                type: 'POST',
//                                dataType: 'HTML',
                                success: function (e) {
                                    $('posts').html(e);
                                }
                            });
                        }
                        ;
                        $('document').ready(function () {
                            showPost();
                        });
                    </script>
                    <div class="clear-float"></div>
                </div>

                <div class="pagination size-sd-12">
                    <button class="button prevButton size-sd-6" onclick="showPost('prev')">Prev. Posts</button>
                    <button class='button nextButton size-sd-6' onclick="showPost('next')">Next Posts </button>
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

    <?php require "left_panel.php"; ?>
    <div class="clear-float"></div>
</div>
<?php
require 'footer.php';
