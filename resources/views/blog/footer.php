<footer class="foot-section">
    <div class="content">
        <div class=" size-sd-12 copywrites">
            <p>The icons used in this website is provided by <a href="http://zurb.com/playground/foundation-icon-fonts-3" target="_blank"><em><strong>Foundation Icon.</strong></em></a></p>
        </div>

        <div class="links">
            <h6>Join us on:</h6>
            <a href="https://www.facebook.com/itblogpage" class="footer_facebook"><span class="fi-social-facebook">&nbsp;</span>Facebook</a>
            <a href="http://www.twitter.com/ITBlogPage" class="footer_twitter"><span class="fi-social-twitter">&nbsp;</span>Twitter</a>
            <div class="clear-float"></div>
        </div>


        <div class="size-sd-12 foot">
            <a href="<?= APP_ADD; ?>about.php" title="Get to Know what ITBlog means and is." class=""><span class="fi-page-csv">&nbsp;</span>About ITBlog</a>
            <a href="javascript://" onclick="showContactForm()" title="Let us be there for you!" class=""><span class="fi-address-book">&nbsp;</span>Contact ITBlog</a>
            <a href="<?= APP_ADD; ?>advertise.php" title="Let us be there for you!" class=""><span class="fi-paperclip">&nbsp;</span>Advertise</a>
            <a href="<?= APP_ADD; ?>copyright.php" title="All credits given back to the rightful owners." class=""><span class="fi-social-github">&nbsp;</span>Copyrights</a>
            <a href="<?= APP_ADD; ?>sitemap.php" class=""><span class="fi-map">&nbsp;</span>Site Map</a>
            <p>&copy; 2016&nbsp;<a href="http://iamlawal.com" target="_blank">Lawal Oladipupo's ITBlog</a>
            </p>
        </div>
    </div>
</footer>
</div>

<!-- Dark Background for Popups -->
<div class="dark_background" onclick="hidePopUp();"></div>

<!-- Contact Form -->
<div class="contactBackground" style="display: none;"></div>
<div class="contactForm autoMargin animated slideInUp" style="display: none;">
    <div class="content">
        <div class="closeButton fi-x"></div>
        <h1>Contact Form</h1>
        <hr />
        <p>Contact us through the following channels and we will be very glad to receive and reply you.</p>
        <p><strong>Address:</strong> 226, Awolowo Road, Opposite Nnavy School of Music, Ota</p>
        <p><strong>Tel:</strong> +2348149108989</p>
        <p><strong>E-Mail:</strong> <a href="mailto:<?php echo APP_ADMIN_MAIL; ?>"><?php echo APP_ADMIN_MAIL; ?></a></p>
    </div>
</div>


<!-- Money Making Script -->
<script type="text/javascript">//<![CDATA[ 
(function() {
    var configuration = {
    "token": "6425959a7587ec6f8a7352839694572d",
    "excludeDomains": [
        "itblog.com.ng"
    ],
    "capping": {
        "limit": 5,
        "timeout": 24
    },
    "exitScript": {
        "enabled": true
    },
    "popUnder": {
        "enabled": true
    }
};
    var script = document.createElement('script');
    script.async = true;
    script.src = '//cdn.shorte.st/link-converter.min.js';
    script.onload = script.onreadystatechange = function () {var rs = this.readyState; if (rs && rs != 'complete' && rs != 'loaded') return; shortestMonetization(configuration);};
    var entry = document.getElementsByTagName('script')[0];
    entry.parentNode.insertBefore(script, entry);
})();
//]]></script>                               
</body>

</html>