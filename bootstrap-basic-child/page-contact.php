<?php
/**
 * Template for contact
 * 
 * @package bootstrap-basic
 */

get_header();
?><div id="haut-page" class="row"><div class="hidden-xs col-sm-12"><?php
   echo do_shortcode("[URIS id=176]"); 
?></div></div><?php

unset($_SESSION['screen_width']);

if(isset($_SESSION['screen_width'])){
echo "je fais ce que je veux !";
} 
else if(isset($_REQUEST['width'])) {
$_SESSION['screen_width'] = $_REQUEST['width'];
} 
else {
echo '<script type="text/javascript">window.location = "' . $_SERVER['REDIRECT_URL'] . '?width="+document.body.clientWidth;</script>';
}



/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();

?> 
<div id="test-flex" <?php if ((int)$_SESSION['screen_width'] < 750): ?>
	style="flex-wrap: wrap;"
<?php endif ?>>
<div class="col-xs-12 col-md-<?php echo $main_column_size; ?> content-area" id="main-column"> 
	<h1 class="title">
		Contactez-nous
	</h1>
	<div id="contact-form">
	<div class="row">
	<?php echo do_shortcode( '[contact-form-7 id="146" title="Formulaire de contact"]' ); ?>
	</div>
</div>
</div>
<div class="space-sb col-md-3 col-xs-12">
<?php get_sidebar('right'); ?> 
</div>
</div>
<?php get_footer(); ?> 

