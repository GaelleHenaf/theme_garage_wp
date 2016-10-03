<?php
/**
 * The theme footer
 * 
 * @package bootstrap-basic
 */
?>

			</div><!--.site-content-->
			
			
			<footer id="site-footer" role="contentinfo">
				<div class="container footer-navigation">
					<div class="col-md-12">
						<nav class="" role="navigation">
							<div class="">
								<?php wp_nav_menu(array('theme_location' => 'footer', 'container' => false, 'menu_class' => 'nav navbar-nav col-sm-12 text-center', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?> 
							</div><!--.navbar-collapse-->
						</nav>
					</div>
				</div><!--.footer-navigation-->
			</footer>
		</div><!--.container page-container-->
		
		<!--wordpress footer-->
		<?php wp_footer(); ?> 

		<script type="text/javascript">
			document.getElementById("text-3").className = "col-xs-12 col-sm-4 col-md-12 widget widget_text";
			document.getElementById("menu-item-44").className = "col-xs-12 col-sm-3  col-md-2 col-md-offset-3 menu-item menu-item-type-post_type menu-item-object-page menu-item-44";
			document.getElementById("menu-item-45").className = "col-xs-12 col-sm-3 col-md-2 menu-item menu-item-type-post_type menu-item-object-page menu-item-45";
			document.getElementById("menu-item-46").className = "col-xs-12 col-sm-3 col-md-2 menu-item menu-item-type-post_type menu-item-object-page menu-item-46";		
		</script>


		
	</body>
</html>