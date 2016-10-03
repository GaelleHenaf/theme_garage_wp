<?php
/**
 * Template for displaying promotions d'occasions
 * 
 * @package bootstrap-basic
 */

get_header();
?><div id="haut-page" class="row"><div class="hidden-xs col-sm-12"><?php
   echo do_shortcode("[URIS id=176]"); 
?></div></div><?php
/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?> 

<div class="col-md-<?php echo $main_column_size; ?> content-area promotions" id="main-column"> 
	<h1 class="title">
		Promotions du Moment
	</h1>
	<div class="row">

	<?php
	

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args=array(
		'paged'=>$paged,
		'post_type' => 'promotion',
		'post_status' => 'publish',
		'posts_per_page' => 12,
		'ignore_sticky_posts'=> 1);

	$my_query = new WP_Query($args);
	if( $my_query->have_posts()) {

		while ($my_query->have_posts()) : $my_query->the_post(); 
		?>

		<?php
		$promotion = get_post_custom();
		$image = get_field('image_promotion');
		$now = date(Ymd);
		$date_debut  = get_field('date_debut');
		$date_fin =  get_field('date_fin');

		if ($date_debut < $now && $now < $date_fin) :
			
				?> 
			<div class="liste-promotions">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<div class="col-xs-12 liste-promotion">
						<h2 class="titre-liste-promotion text-center"><?php the_title(); ?></h2>
						<?php if( !empty($image) ): ?>
							<div class="text-center">
								<img class="image-liste-promotion" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							</div>
							
						
							
						<?php endif; ?>
						<div class="col-md-12 texte-promotion">
								<?php echo mb_substr(get_the_excerpt(),0, 300); if (strlen(get_the_excerpt())>301) { echo '...'; } ?>
							</div>

					</div>
				</a>
			</div>
			
		<?php 
		endif; ?>
		
		<?php
		endwhile;
		?>
<div class="col-md-12 text-center">
		<?php
		echo pagination($my_query);
		?>
		</div>
		<?php
	}
	?>

</div></div>

<div class="hidden-xs hidden-sm col-md-3 space-sb">
<?php get_sidebar('right'); ?> 
</div>
<?php get_footer(); ?> 

<!-- <pre>
	<?php print_r($image);?>
</pre> -->