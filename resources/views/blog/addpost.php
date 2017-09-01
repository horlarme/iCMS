<?php
error_reporting(0);
//Composer Autoloader
require './vendor/autoload.php';
//Configuration Files
require 'class/config.php';
$dataBase = new PDO(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS);
$blog = new ITBLOG\Blogging($dataBase);

//Checking if the viewer is authorized to use this page
if (!isset($_REQUEST['author']) && strtolower($_REQUEST['author']) != strtolower('Oladipupo')) {
    die();
}
//The Required JavaSrcipt Files
$js = [
        APP_ADD . "thirdparty/tinymce/tinymce.min.js",
        APP_ADD . "thirdparty/tinymce/jquery.tinymce.min.js",
        APP_ADD . "thirdparty/fancybox/dist/jquery.fancybox.js"
];
//The Required JavaSrcipt Files
$css = [
        APP_ADD . "stylesheet/poststyle.css",
        APP_ADD . "thirdparty/fancybox/dist/jquery.fancybox.min.css"
];

require 'header.php';
?>
    <!-- Body section of the page. -->
    <div class="body-section postcontent">
        <form action="savepost.php" method="POST" enctype="multipart/form-data">
            <div class="main-section panel">
                <div class="formBox"><!-- Blog Title -->
                    <div class="size-sd-3">
                        <input type="button" value="Title:" disabled="" class="btntotext align-right"/>
                    </div>
                    <div class="size-sd-9">
                        <input type="text" name="blogtitle" class="inputBOX blogTitle"
                               placeholder="Enter post title"/>
                        <p class="suggestedURL"></p>
                    </div>
                    <div class="clear-float"></div>
                </div>

                <div class="formBox"><!-- Blog Description-->
                    <div class="size-sd-3">
                        <input type="button" value="Description:" disabled="" class="btntotext align-right"/>
                    </div>
                    <div class="size-sd-9">
                        <textarea name="blogdescription" class="inputBOX blogdescription" onkeyup="checkDescription()"
                                  placeholder="Describe this post in a few words!"></textarea>
                        <p class="blogdescrip"></p>
                    </div>
                    <div class="clear-float"></div>
                </div>

                <textarea class="editor" name="blogcontent"></textarea>
                <script type="text/javascript">
                    //Configuration for the editor
                    var height = window.innerHeight - 30;

                    tinymce.init({
                        selector: '.editor',
                        inline: false,
                        plugins: 'fullscreen fullpage hr image layer link lists media paste preview save spellchecker table textcolor emoticons autolink wordcount anchor autolink code colorpicker imagetools visualchars contextmenu responsivefilemanager',
                        theme: 'modern',
                        toolbar: 'undo redo | hr bold italic underline superscript subscript textcolor link emoticons | alignleft aligncenter alignright alignjustify | paragraph blockquote pre div | code paste save | lists table link media image imagetools | fullscreen spellchecker | responsivefilemanager',
                        menubar: true,
                        external_filemanager_path:"/plugins/filemanager/",
                        filemanager_title:"Responsive Filemanager",
                        external_plugins: { "filemanager" : "/plugins/filemanager/plugin.min.js"},
                        height: height
                    });
                </script>

                <!-- Content to be shown after the post -->
                <div class="other-contents">
                    <div class="content">
                    </div>
                </div>
            </div>

            <div class="right-section panel">

            <style type="text/css">
                .fancybox-inner{
                    min-height: 500px !important;
                }
            </style>
                <div class="social content blogimage">
                    <h3 class="header">Blog Image</h3>
                    <div class="content formBox">
                        <img class="blogImageUpload" style="width: 100%;"/>
                        <input type="hidden" name="blogimage" id="bimage"/>
                        <a href="/plugins/filemanager/dialog.php?type=1&field_id=bimage" data-fancybox-type='iframe' class="inputBox size-sd-6 button button_success fancy">Select Image</a>
                        <button class="inputBox button size-sd-6">Remove</button>
                        <input type="file" onchange="uploadImage(this.files[0])"/>
                    </div>
                </div>

                <div class="advert content"></div>

                <div class="clear-float"></div>

                <div class="content newsletter">
                    <h1 class="header">Category</h1>
                    <div class="content">
                        <?php
                        $categories = $blog->categories();
                        foreach ($categories as $c) {
                            ?>
                            <input type="radio" name="category"
                                   value="<?= $c['id']; ?>"/> <?= strtoupper($c['name']); ?><br/>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="tags content">
                    <h1 class="header">Tags</h1>
                    <input type="text" name="tag" placeholder="Separate Tags with comma ','" class="blogTag">
                    <div class="clear-float"></div>
                    <div class="content">
                    </div>
                </div>

                <div class="social content blogimage">
                    <h3 class="header">Publish</h3>
                    <div class="content formBox">
                        <p><input type="checkbox" name="postLink" value="yes"> Share directly to facebook page.</p>
                        <p style="text-align: left;">
                            <input type="checkbox" name="schedule" value="no" checked class="postnow"> Check this box to
                            post to the internet immediately, un-check to set schedule date and time.</p>
                        <input type="submit" name="action" class="inputBox button publish" value="Publish"/>
                        <div class="schedulePost" style="display: none;">
                            <p>Publish this post on the following information.</p>

                            <label for="scheduleDate" class="size-sd-3">Date:</label>
                            <input type="date" name="scheduleDate" class="size-sd-9"/>

                            <div class="clear-float"></div>

                            <label for="scheduleTime" class="size-sd-3">Time:</label>
                            <input type="time" name="scheduleTime" class="size-sd-9"/>

                            <input type="submit" class="size-sd-12 schedulePostButton button button_success"
                                   value="Schedule" name="action"/>
                        </div>
                        <input type="submit" name="action" class="inputBox button size-sd-6 button_underlined"
                               value="Preview" style="color: blue;"/>
                        <input type="submit" name="action" class="inputBox button size-sd-6 button_underlined"
                               value="Draft" style="color: blue;"/>
                    </div>
                    <div class="clear-float"></div>
                </div>
            </div>
            <div class="clear-float"></div>
        </form>
    </div>
<?php
require 'footer.php';
