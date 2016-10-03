<?php
/**
 * Template for displaying promotion
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
<div class="col-md-12" id="infos-entreprise">
	<span><i class="fa fa-map-marker"></i> Quelque part</span>
	<span class="pull-right"><i class="fa fa-phone"></i> 01.23.45.67.89</span>
</div>
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column"> 

	<div id="main-promotion" class="col-md-12">
		<?php the_title( '<h1 class="title">', '</h1>' ); ?>
		<div class="contenu-promotion col-md-12">
			<?php $image = get_field('image_promotion'); 
			while (have_posts()) {
				the_post();
				$now = date(Ymd);
				$date_debut  = get_field('date_debut');
				$date_fin =  get_field('date_fin');

				if ($date_debut < $now && $now < $date_fin) :
				?>
				<div class="text-center">
					<img class="image-liste-promotion" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" >
				</div>
				<h2 class="col-md-4" id="titre-description"> Description </h2>
				<div id="description" class="col-md-12">

					<?php
					the_content();
					?>
				</div>
				<div class="col-md-12">
				<div class="info-besoin-aide "><i class="fa fa-question-circle"></i> Besoin d'informations ou de conseils ? N'hésitez pas à nous contacter :</div>
				<div class="info-tel"><i class="fa fa-phone"></i> 01.23.45.67.89</div>
			</div>
				<?php
				else:?>
				<div class="text-center">
					<img class="img-responsive col-md-6 col-md-offset-3" src="<?php bloginfo('stylesheet_directory'); ?>/img/sold-out.jpg" />
				</div>
				<h2 class="text-center col-md-12">
					Désolé, cette promotion n'est plus en cours de validité.
				</h2>

				<?php
				endif;

			} //endwhile; ?>

			
		</div>

	</div>
</div>

<div class="hidden-xs hidden-sm col-md-3 space-sb">
<?php get_sidebar('right'); ?> 
</div>
<?php get_footer(); ?> 
