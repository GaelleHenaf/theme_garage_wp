<?php
/**
 * Template fordiplaying sitemapping
 * 
 * @package bootstrap-basic
 */

get_header();
?><div id="haut-page"><?php

?></div><?php
/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();

?> 
<div class="col-xs-12 col-md-<?php echo $main_column_size; ?> content-area" id="main-column"> 
	<h1 class="title">
		<?php the_title();?>
	</h1>
	<div id="contenu-page" class="row">
<?php 
						while (have_posts()) {
							the_post();

							the_content();



						} //endwhile;
						?> 
	

</div></div>



<div class="hidden-xs hidden-sm col-md-3 space-sb">
<?php get_sidebar('right'); ?> 
</div>
<?php get_footer(); ?> 

<!-- <pre>
	<?php print_r($args);
	print_r($_POST);  ?>
</pre> -->
