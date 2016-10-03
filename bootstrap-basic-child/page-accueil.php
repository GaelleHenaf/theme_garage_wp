<?php
/**
 * Template for displaying acceuil / home
 * 
 * @package bootstrap-basic
 */

get_header();

unset($_SESSION['screen_width']);

if(isset($_SESSION['screen_width'])){
echo "je fais ce que je veux !";
} 
else if(isset($_REQUEST['width'])) {
$_SESSION['screen_width'] = $_REQUEST['width'];
} 
else {
echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+document.body.clientWidth;</script>';
}




?><div id="haut-page"><div  class="hidden-xs"><?php
   echo do_shortcode("[URIS id=176]"); 
?></div></div><?php
/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();





?> 
<div id="test-flex">
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column"> 
	<h1 class="title">
		Accueil
	</h1>
	<?php
	while (have_posts()) {
				the_post();
				
				?>
				<div class="contenu-home col-md-12">
				<?php
					
					if ( has_post_thumbnail() ) { // dans la boucle
the_post_thumbnail();
}
the_content();
				?>
				</div>
				<?php

			} //endwhile; ?>

</div>


<div class="space-sb col-md-3 col-xs-12">
<?php get_sidebar('right'); ?> 
</div></div>

<div id="liste-vehicules-home" class='col-xs-12'>

	<img id="img-car-93"  src="<?php bloginfo('stylesheet_directory'); ?>/img/car93.png" />
	<h3 id="titre-nos-vehicules-home"> NOS VEHICULES </h3> <div id="trait-home"></div>

	<?php


if ((int)$_SESSION['screen_width'] < 750) {
	$posts_per_page = 3;
}
elseif ((int)$_SESSION['screen_width'] > 992) {
	$posts_per_page = 8;
}
else {
	$posts_per_page = 6;
}
	$args=array(
		'paged'=> $paged,
		'post_type' => 'vehicule',
		'post_status' => 'publish',
		'posts_per_page' => $posts_per_page,
		'ignore_sticky_posts'=> 1);

	$my_query = new WP_Query($args);
	if( $my_query->have_posts()) :
		while ($my_query->have_posts()) : $my_query->the_post(); 
	?>
	<div class="col-md-3 col-sm-4 liste-vehicule">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
		

			<?php
			$vehicule = get_post_custom();
			$image = get_field('galerie_photos');
			?> 
			<div class="background-image-liste-vehicule"><i class="fa fa-eye fa-3x"></i>
			<img class="image-liste-vehicule" src="<?php echo $image[0]->guid;  ?>" alt="<?php echo $image[0]->post_title;  ?>" /></div>
			<div class="champs-liste-vehicule">
				<h2 class="titre-liste-vehicule-home"><?php echo mb_substr(get_the_title(),0, 24); if (strlen(get_the_title())>25) { echo '...'; }?></h2>
				<strong class="champ-liste-vehicule"> <?php the_field('prix'); ?> €</strong><br>
			</div>
		
	</a>
</div>
<?php
endwhile;
?>

<div class="col-md-12 text-center">

</div>
<?php

endif;
?>
</div>
<a href="<?php bloginfo('url'); ?>/vehicules-a-vendre/vehicules-neufs/">
<button class="text-center col-xs-8 col-xs-offset-2 col-sm-3 col-sm-offset-2 btn-lien-home">
	Voir nos véhicules neufs
</button>
</a>
<a href="<?php bloginfo('url'); ?>/vehicules-a-vendre/vehicules-doccasions/">
<button class="text-center col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-2 btn-lien-home">
	Voir nos véhicules d'occasions 
</button>
</a>
<?php get_footer(); ?> 

