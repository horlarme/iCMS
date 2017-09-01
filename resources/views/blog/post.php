<?php
//Composer Autoloader
require './vendor/autoload.php';
//Configuration Files
require 'class/config.php';

$dataBase = new PDO(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS);

//Connecting to the pagination class with the parameter of $dataBase
//which holds the database connection
$blog = new ITBLOG\Pagination($dataBase);

//Configuration
$category = $_REQUEST['category'];
$searchQuery = $_REQUEST['search'];
$tagSearch = $_REQUEST['tag'];

//The default search query to be used incase there's no need to use another query
$pq = "SELECT * FROM `postlist` P, `categories` C WHERE P.`type` = 'published' AND C.category_id = P.category_id ORDER BY `id` DESC";
//If the page is being viewed as a category only
if ($category != "") {
    $d = $blog->category("", $category);
    $pq = "SELECT * FROM `postlist` P, `categories` C WHERE P.`type` = 'published' AND P.`category_id` = " . $d['id'] . " AND C.category_id = P.category_id ORDER BY `id` DESC";
}
//If the page is being viewed as a search
if ($searchQuery) {
    $pq = "SELECT * FROM `postlist` POST, `categories` CAT WHERE POST.`title` LIKE '%$searchQuery%' AND CAT.`category_id` = POST.`category_id` AND POST.`type` = 'published' OR POST.`content` LIKE '%$searchQuery%' AND CAT.`category_id` = POST.`category_id` AND POST.`type` = 'published' ORDER BY `id` DESC";
}
//If the page is been viewed as a tag
if ($tagSearch) {
    $pq = "SELECT * FROM `postlist` POST, `categories` CAT WHERE POST.`tags` LIKE '%$tagSearch%' AND CAT.`category_id` = POST.`category_id` AND POST.`type` = 'published' ORDER BY `id` DESC";
}

//Configuring the values for pagination
/* @var $ppp int The number of posts to be showed per page */
$ppp = 10;
/* @var $cp int The current page number */
$cp = $blog->currentPage();

//Making an array for the setup which is used in configuring the pagination class
$setUp = array("postPerPage" => $ppp, "postQuery" => $pq, "linkClass" => "button");

//Setting up the pagination configuration with the array 
//set into the variable setup
$blog->setUp($setUp);

//Collecting the posts from the pagination class
$posts = $blog->show($cp);

//looping through the data sent from the pagination class
//and outputing them on the page for the users to see and interact with
foreach ($posts as $post) {
    ?>
    <div class="post">
        <div class="grid">
            <a href="<?= $post['URL']; ?>" title="<?= $post['title']; ?>" class="postImage"><img style="width: 90%;"
                                                                                                 src="<?= $post['image']; ?>"
                                                                                                 alt="<?= $post['title']; ?>"/></a>
            <a href="<?= $post['URL']; ?>" title="<?= $post['title']; ?>" class="blogTitle"><?= $post['title']; ?></a>
        </div>
        <div class="list">
            <a href="<?= $post['URL']; ?>" title="<?= $post['title']; ?>" class='blogImage'>
                <img style="width: 100%;" src="<?= $post['image']; ?>">
            </a>
            <div class='content'>
                <div class="content">
                    <a href="<?= $post['URL']; ?>" title="<?= $post['title']; ?>"
                       class='blogTitle'><?= $post['title']; ?></a>
                    <p class="blogDescription"><?= substr($post['content'], 0, 250); ?>...</p>
                </div>
                <div class="info">
                    <!-- CATEGORY LINK -->
                    <a href="<?= APP_ADD . strtolower($post['category_name']) . "/"; ?>" class="text category"><i
                                class='fi-social-designer-news'></i> <?= $post['category_name']; ?></a>
                    <!-- DATE -->
                    <a href="<?= $post['URL']; ?>" class="text date"><i class='fi-calendar'></i> <?= $post['date']; ?>
                    </a>
                    <!-- POST VIEWS -->
                    <p class="text views"><i class='fi-eye'></i> <?= $post['views']; ?>Views</p>
                    <div class="clear-float"></div>
                </div>
            </div>
            <div class="clear-float"></div>
        </div>
        <div class="clear-float"></div>
    </div>

    <?php
// Closing loop
}
if ($blog->totalPage > 1) {
    ?>
    <!--//Opening the pagination division tag-->
    <div class="pagination size-sd-12">
        <?php
        //Showing the prev button only if the current page is not the first page
        if (!$blog->isFirstPage()) {
            ?>
            <a href="?page=<?= ($blog->currentPage - 1); ?>" class="button"><</a>&nbsp;
            <?php
        }
        ?>
        <?php
        //If the pages are more than five
        if ($blog->totalPage > 5) {
            for ($pageNumber = $blog->currentPage; $pageNumber <= $blog->currentPage + 5; $pageNumber++) {
                //Checking if the user is getting pages more than the total pages
                //dew to the current page
                if ($pageNumber > $blog->totalPage) {
                    break;
                }
                ?>
                <a href="?page=<?= $pageNumber; ?>" class="button"><?= $pageNumber; ?></a>
                <?php
            }

        } else {

            for ($pageNumber = $blog->currentPage; $pageNumber <= $blog->totalPage; $pageNumber++) {
                ?>
                <a href="?page=<?= $pageNumber; ?>" class="button"><?= $pageNumber; ?></a>
                <?php
            }

        }

        //Show the next button if the current page is not the last page
        if ($blog->isLastPage()) {
            ?>
            &nbsp;<a href="?page=<?= ($blog->currentPage + 1); ?>" class="button"> > </a>
            <?php
        }
        ?>
        <div class="clear-float"></div>
        <!--        //Closing the pagination division tag-->
    </div>
    <?php
}
?>