<?php
error_reporting(0);
//Composer Autoloader
require './vendor/autoload.php';
//Configuration Files
require 'class/config.php';
require 'class/db.php';

$blog = new ITBLOG\Blogging($dataBase);

//Setting the values for this page
//The URL
$URL = $_REQUEST['url'];

//Calling the method which holds data
$post = $blog->showPost($dataBase->quote($URL));

//Creating list of values
$id = $post['id'];
$title = $post['title'];
$image = $post['image'];
$content = $post['content'];
$author = $post['author'];
$day = $post['day'];
$month = $post['month'];
$date = date("D d M", mktime(0, 0, 0, $post['month'], $post['day'], $post['year']));
$year = $post['year'];
$views = $post['views'];
$tags = $post['tags'];
$category_id = $post['category_id'];
$category_name = $post['category_name'];
$category_icon = $post['category_icon'];
$category_title = $post['category_title'];

$description = $post['description'];

$pageTitle = $title;

//Creating CSS links
$css = array(APP_ADD . 'stylesheet/postview.css');
//Creating Javascript
$js = array('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58374847180619fd');
//Creating Meta Tags
$meta = array('');

require 'header.php';
?>
    <!-- Body section of the page. -->
    <div class="body-section">
        <div class="advert"></div>
        <div class="main-section panel">
            <div class="post single-post">
                <div class="pagemovement">
                    <a href="<?= APP_ADD; ?>">Home</a>&nbsp;>&nbsp;<a
                            href="<?= APP_ADD . strtolower($category_name) . '/'; ?>"><?= $category_name; ?></a>&nbsp;>&nbsp;<a
                            href="<?= $URL; ?>"><?= $title; ?></a>
                </div>
                <div class="posthead">
                    <img class="postimage mobile" src="<?= $image; ?>"/>
                    <div class="postimage otherdevices">
                        <img src="<?= $image; ?>"/>
                    </div>
                    <h3 class="posttitle"><?php echo $title; ?></h3>
                    <div class="postinfo">
                        <a href="<?php // $month . "/" . $day;    ?>"><i class="fi-calendar"></i> <?= $date; ?></a>&nbsp;|&nbsp;<i
                                class="<?= $category_icon; ?>"></i>
                        <a href="<?= APP_ADD . strtolower($category_name); ?>/"><?= $category_name; ?></a>&nbsp;|&nbsp;
                        <i class="fi-eye"></i> <?= $views; ?> views <br/>
                    </div>
                    <div class="socialsharing">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox_3hyo"></div>
                    </div>
                </div>

                <div class="post_content">
                    <!--Contents will be displayed here-->
                    <?php
                    //Adding 1 to the views of this particular post by calling the onView method
                    //with the parameter of the post id
                    $blog->onView($id);

                    //Display the post content
                    echo $content;
                    ?>
                    <!--                Showing the post share buttons again at the bottom of the page-->
                    <div class="socialsharing">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox_3hyo"></div>
                    </div>
                </div>

                <style>
                    .post-tag a {
                        font-size: 80%;
                    }
                </style>
                <div class="post-tag"><!-- Post's Tag -->
                    <div class="float-left" style="font-weight: bold;">Tags:</div>
                    <?php
                    //displaying the list of tags for the post
                    $tags = explode(",", $tags);
                    foreach ($tags as $tag) {
                        echo "<a href='" . APP_ADD . "tag/" . $tag . "' class='fi-price-tag'>" . $tag . "</a>&nbsp;";
                    }
                    ?>
                </div>
                
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_relatedposts_inline"></div>
            </div>
            <div class="advert">
            </div>

            <!-- Content to be shown after the post -->
            <div class="other-contents">
                <div class="content">
                    <div class="comments" id='comments'>
                        <div id="disqus_thread"></div>
                        <script>
                            /**
                             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                            /*
                             var disqus_config = function () {
                             this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                             this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                             };
                             */
                            (function () { // DON'T EDIT BELOW THIS LINE
                                var d = document, s = d.createElement('script');
                                s.src = '//itblog-2.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                                powered by Disqus.</a></noscript>
                    </div>

                    <div class="clear-float"></div>

                </div>
            </div>

        </div>

        <?php
        require_once 'left_panel.php';
        ?>
        <div class="clear-float"></div>
    </div>


<?php
require_once 'footer.php';
?>