<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title('|', true, 'right'); ?></title>
		<meta name="viewport" content="width=device-width">
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!--wordpress head-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!--[if lt IE 8]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->
		
		
	<!-- 	<div class="rose hidden-sm hidden-lg hidden-md visible-xs-12 text-center">XS</div>
		<div class="bleu hidden-xs hidden-lg hidden-md visible-sm-12 text-center">SM</div>
		<div class="jaune hidden-xs hidden-sm hidden-lg visible-md-12 text-center">MD</div>
		<div class="vert hidden-xs hidden-sm hidden-md visible-lg-12 text-center">LG</div> -->
		
		
		<div>
			<?php do_action('before'); ?> 
			<header class="container-fluid" role="banner" id="header">
				<div class="container">
					<div  class="row">
						
							<h1 class="site-title-heading col-xs-8" id="site-branding">
								<?php 
									echo strtoupper(get_bloginfo('name')); 
								?>
							</h1>
						
						
							<img src="<?php bloginfo('stylesheet_directory'); ?>/img/header.png" alt="logo marque" class="pull-right"/>
						
					</div>
					<div class="row main-navigation">
						<div id="menu-nav" class="col-md-12">
							<nav class="menuHeader" role="navigation">
								<div class="navbar-header">
									<button  type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-primary-collapse">
										<span class="sr-only"><?php _e('Toggle navigation', 'bootstrap-basic'); ?></span>
										<span class="menu-blanc col-xs-2">Menu</span>
										<div class="icon-bars pull-right">
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</div>
									</button>
								</div>
								
								<div class="collapse navbar-collapse navbar-primary-collapse">
									<?php wp_nav_menu(array(
										'theme_location' => 'primary', 
										'container' => false, 
										'menu_class' => 'nav navbar-nav col-xs-12', 
										'walker' => new BootstrapBasicMyWalkerNavMenu()
										)); ?> 
								</div><!--.navbar-collapse-->
							</nav>
						</div>
					</div><!--.main-navigation-->
				</div>
			</header>
			
			<div id="content" class="site-content container">