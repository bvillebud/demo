<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package webco
 */
?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<section class="footer-links">
			<section class="container">	
			<div>
				<h3>Webco Corporate<br>Headquarters</h3>
				
9101 W. 21st Street S<br>
P.O. Box 100<br>
Sand Springs, OK 74063<br><br>
				
				<b>24-hr Service Contacts</b>:<br class='break'> Phone: 918-245-2211<br><br>
				
	<b>Heat exchanger/pressure/<br class="break">distribution support</b>:<br class="break"> Phone: 918-246-2440
			</div>
			
			<div>
			<h3>TUBING PRODUCTS</h3>
			<?php
			wp_nav_menu( array(
				'menu'        => 'bottommenu-tubing-products',
				'container'		 => '',
				'link_after'			=> ' &raquo;'
			) );
			?>
			</div>
			
			<div>
				<h3>Solution+Resources</h3>
				<?php
			wp_nav_menu( array(
				'menu'        => 'bottommenu-solutions-resources',
				'container'		 => '',
				'link_after'			=> ' &raquo;'
			) );
			?>	
			</div>
			
			<div>
				<h3>Industries</h3>
				<?php
				wp_nav_menu( array(
					'menu'        => 'bottommenu-industries',
					'container'		 => '',
					'link_after'			=> ' &raquo;'
				) );
				?>	
			</div>
			
			<div>
				<h3>About Webco</h3>
				<?php
				wp_nav_menu( array(
					'menu'        => 'bottommenu-about-webco',
					'container'		 => '',
					'link_after'			=> ' &raquo;'
				) );
				?>
			</div>
			
			<div class="social">
				<a target="_blank" href="https://www.facebook.com/webcotube" class="fa fa-facebook"></a>
					<a target="_blank" href="https://www.linkedin.com/company/webco-industries/" class="fa fa-linkedin"></a>
					<a target="_blank" href="https://twitter.com/webcotube" class="fa fa-twitter"></a>
					<a target="_blank" href="https://www.instagram.com/webcotube/" class="fa fa-instagram"></a>
<!-- 					<a href="https://plus.google.com/u/0/+Webcotube" class="fa fa-google"></a> -->
			</div>
		</section>
		</section>
		<div class="site-info">
			<section class="container">
				<div class="div-term-footer">
					<a class="term-footer" href="/terms-and-conditions/">Terms &amp; Conditions &raquo;</a>
				</div>
				<div class="div-copy-footer">
					<small class="copy-footer">&copy; <?php echo date("Y"); ?> Webco Industries, Inc. All rights reserved.</small>
				</div>
			</section>
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript">
 update_submit.addEventListener("click", makeChangestoSite);

function makeChangestoSite() {
    var page = document.getElementById("update_page");
    var field = document.getElementById("update_field");
    var name = document.getElementById("update_name");
    var link = document.getElementById("update_link");
    //alert(page + " " + field + " " + name + " " + link);
}
</script>
</body>
</html>
