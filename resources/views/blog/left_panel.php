
<div class="right-section panel">
    <div class="advert content"></div>

    <div class="social content">
        <div class="content">
            <div style="width: 100%; overflow: hidden;" class="fb-page" data-href="https://www.facebook.com/itblogpage/" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/itblogpage/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/itblogpage/">ITBlog</a></blockquote></div>
        </div>
    </div>

    <div class="advert content"></div>

    <div class="recentPosts content">
        <h1 class="header">The Recent Posts</h1>
        <div class="content">
            <?php
            $recent = $blog->recentPosts();

            foreach ($recent as $post) {
                $title = $post['title'];
                $category_name = $post['category_name'];
                $URL = $post['URL'];
                $date = $post['month'] . " " . $post['day'];
                ?>
                <a href="<?php echo $URL; ?>" class="rPost"><?php echo $title; ?><span> &nbsp;<?php echo $category_name; ?> <?php echo $date; ?></span></a>
            <?php } ?>
        </div>
    </div>

    <div class="advert content"></div>

    <div class="clear-float"></div>

    <div class="content newsletter">
        <h1 class="header">Newsletter Subscription</h1>
        <div class="content">
            <p>Be the first to get the latest post and news from our website through an e-mail by subscribing to our newsletter below.</p>
            <div class="formBox">
                <input type="email" name="newsletterEmail" placeholder="Enter Your E-Mail Here..." class="inputBOX">
            </div>
            <div class="newsletterResultBox"></div>
            <div class="formBox">
                <input type="submit" value="Subscribe" class="inputBOX button" name="newsletterButton">
            </div>
<!--            And you can also subscribe to our WhatsApp broadcast list by sending "Add-to-List" without quotes to <strong>+2348149108989</strong>-->
        </div>
    </div>

    <div class="advert content"></div>

    <div class="tags content">
        <!--<h1 class="header">Common Tags</h1>-->
        <!--<div class="content">-->
        <!--<a href="">internet</a>-->
        <!--</div>-->
    </div>

</div>