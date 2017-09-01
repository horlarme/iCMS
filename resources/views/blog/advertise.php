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

                    <div class="posts about-us align-justify" style="min-height: 400px;">
                        <h2>Advertise</h2>
                        <hr/>
                        <p>Do you have a service you want to advertise on our blog? If yes, then fill the form below to
                            start the processs.</p>
                        <form method="GET" action="javascript://" name="advertForm">
                            <div class="formBox">
                                <div class="formBox">
                                    <label for="fullname"><strong>Full Name:</strong></label>
                                </div>
                                <input type="name" required name="fullname" placeholder="Full Name"/>
                            </div>
                            <div class="formBox">
                                <div class="formBox">
                                    <label for="email"><strong>E-Mail:</strong></label>
                                </div>
                                <input type="email" required name="email" placeholder="E-Mail Address"/>
                            </div>
                            <div class="formBox">
                                <div class="formBox">
                                    <label for="mobile"><strong>Mobile Number:</strong></label>
                                </div>
                                <input type="tel" required name="mobile" placeholder="Mobile Number"/>
                            </div>
                            <div class="formBox">
                                <div class="formBox">
                                    <label for="website"><strong>WebSite:</strong></label>
                                </div>
                                <input type="url" name="website" placeholder="Website Address"/>
                            </div>
                            <div class="formBox">
                                <div class="formBox">
                                    <label for="message"><strong>Message:</strong></label>
                                </div>
                                <textarea rows="10" type="name" required name="messages" placeholder="Enter additional messages here..."></textarea>
                            </div>
                            <div class="formBox">
                                <input type="submit" name="action" value="Send Message" class="inputBox btn button" />
                            </div>
                        </form>
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
