<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sgdc
 */

?>

	<footer class="text-center">
		<h3>SUKAGITU</h3>
		<p>© Copyright 2019 - All rights reserved.</p>

		<ul class="social-list">
			<li>
				<a href="/kontak">Kontak</a>
			</li>
			<li>
				<a href="/tentang">Cerita Sukagitu</a>
			</li>
			<li>
				<a href="/privacy-policy">Privacy Policy</a>
			</li>
			<li>
				<a href="/disclaimer">Disclaimer</a>
			</li>
		</ul>
	</footer>

<?php wp_footer(); ?>

    <!--<script src="<?php //echo get_template_directory_uri(); ?>/js/all.min.js"></script>-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-77707785-2"></script>

	<script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-77707785-2');

	    function humbMenu() {
            var e = document.getElementById("myTopnav");
            "topnav" === e.className ? e.className += " responsive" : e.className = "topnav"
        }

        function openSearch() {
            var e = document.getElementById("search");
            "form-search" === e.className ? e.className += " open" : e.className = "form-search"
        }

        document.addEventListener("DOMContentLoaded", function() {
            var lazyloadImages = document.querySelectorAll("img");
            var lazyloadThrottleTimeout;

            function lazyload() {
                if (lazyloadThrottleTimeout) {
                    clearTimeout(lazyloadThrottleTimeout)
                }
                lazyloadThrottleTimeout = setTimeout(function() {
                    var scrollTop = window.pageYOffset;
                    lazyloadImages.forEach(function(img) {
                        if (img.offsetTop < (window.innerHeight + scrollTop)) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy')
                        }
                    });
                    if (lazyloadImages.length == 0) {
                        document.removeEventListener("scroll", lazyload);
                        window.removeEventListener("resize", lazyload);
                        window.removeEventListener("orientationChange", lazyload);
                    }
                }, 10)
            }
            document.addEventListener("scroll", lazyload);
            window.addEventListener("resize", lazyload);
            window.addEventListener("orientationChange", lazyload);
        })
	</script>

</body>
</html>
