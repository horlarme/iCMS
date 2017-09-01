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
    <div class="main-section panel size-sd-12" style="width: 100%;">
        <div class="content">
            <div class="mostRecentPost">

                <div class="posts align-left about-us" style="min-height: 400px;">
                    <h2>Copyrights</h2>
                    <hr />
                    <p>All credits are given to their respective owners according to the name of their app being used on my project.</p>
                    <h4>PHP Libraries</h4>
                    <hr />
                    <ul>
                        <li>gregwar: Image Processor</li>
                        <li>uriman: URI Manager</li>
                        <li>phpmailer: Mailer</li>
                        <li>intervention_image: Image Processor</li>
                        <li>vakata/random/generator: A random data generator class</li>
                    </ul>
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

    <div class="clear-float"></div>
</div>
<?php
require 'footer.php';
