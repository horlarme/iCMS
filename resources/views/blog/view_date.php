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

$blog = new blogging($dataBase);
?>

<?php
//Checking if there is already a title set for this page
//$pageTitle = "Category: " . $_REQUEST['category'];
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
                    <div class='size-sd-8'>Category: <?php echo strtoupper($_REQUEST['category']); ?></div>
                    <div class="clear-float"></div>
                </div>
                <div class="posts">
                    <?php include_once 'post.php'; ?>
                    <div class="clear-float"></div>
                </div>
                <div class="pagination size-sd-12">
                    <a href='#' class='button prevButton size-sd-6'>Prev. Posts</a>
                    <a href='#' class='button nextButton size-sd-6'>Next Posts</a>
                    <div class='clear-float'></div>
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
    <?php
    require "left_panel.php";
    ?>
    <div class="clear-float"></div>
</div>
<?php
require 'footer.php';
