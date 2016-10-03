<?php
/**
 * Template for displaying vehicules neufs
 * 
 * @package bootstrap-basic
 */

get_header();
?><div id="haut-page"><?php
   echo do_shortcode("[URIS id=176]"); 
?></div><?php
/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();

?> 
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column"> 
	<h1 class="title">
		Mes véhicules neufs
	</h1>
	<div id="contenu-page-vehicules" class="row">
	<div class="col-md-3 space-sb hidden-md hidden-lg">

<aside class=" col-xs-12 sidebar-right widget widget-filtre">
<form action="" method="post">
	<h1 class="widget-title">Rechercher</h1>
	<select class="select-filtre col-md-12" name="marque">
		<option value="">Marque</option>
		<?php foreach  ($marque['choices'] as $key => $value) {
			echo '<option value="'.$key.'"';
			if (isset($_POST['marque']) && $_POST['marque']==$value) {
				echo ' selected ';
			}
			echo '>'.$value.'</option>';
		}
		?>
	</select>
	<select class="select-filtre col-md-12" name="prix">
	<option value="">Prix</option>
		<?php for  ($i=2500; $i < 50001; $i+=2500) {
			echo '<option value="'.$i.'"';
			if (isset($_POST['prix']) && $_POST['prix']==$i) {
				echo ' selected ';
			}
			echo '> < '.$i.' €</option>';
		}
		?>
		<option value="50001"
		<?php if (isset($_POST['prix']) && $_POST['prix']==50001) {
				echo ' selected ';
			} 
		?>
		> > 50000 €</option>
	</select>
	
	<select class="select-filtre col-md-12" name="energie">
		<option value="">Energie</option>
		<?php foreach  ($energie['choices'] as $key => $value) {
			echo '<option value="'.$key.'" ';
			if (isset($_POST['energie']) && $_POST['energie']==$value) {
				echo ' selected ';
			}
			echo '>'.$value.'</option>';
		}
		?>
	</select>
	 <button type="submit" id="btn-filtre" class="btn btn-default pull-right">Voir les résultats <i class="fa fa-search"></i></button>
	</form>
</aside>
</div>
	<?php
	if (isset($_POST['post-order']) && $_POST['post-order']!='' ) {
		$tri = $_POST['post-order'];
		$_SESSION['post-order'] = $_POST['post-order'];
	}
	elseif (isset($_SESSION['post-order']) && $_SESSION['post-order']!='' ) {
		$tri = $_SESSION['post-order'];
	}
	else {
		$tri = 'ASC';
	}

	if (isset($_POST['orderby']) && $_POST['orderby']!='' ) {
		$orderby = $_POST['orderby'];
		$_SESSION['orderby'] = $_POST['orderby'];
	}
	// elseif (isset($_SESSION['orderby']) && $_SESSION['orderby']!='' ) {
	// 	$orderby = $_SESSION['orderby'];
	// }
	else {
		$orderby = 'prix';
	}

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if ($_POST['energie']!='' && isset($_POST['energie'])) {
		$filtreEnergie = $_POST['energie'];
		$compareEnergie = '=';
	}
	else {
		$filtreEnergie = "default";	
		$compareEnergie = 'NOT LIKE';
	}
	if ($_POST['marque']!='' && isset($_POST['marque'])) {
		$filtreMarque = $_POST['marque'];
		$compareMarque = '=';
	}
	else {
		$filtreMarque = "default";
		$compareMarque = 'NOT LIKE';
	}
	if ($_POST['prix']!='' && isset($_POST['prix'])) {
		$filtrePrix = $_POST['prix'];
		$comparePrix = '<';

		if ($_POST['prix']==50001) {
			$comparePrix = '>';
		}
	}
	else {
		$filtrePrix = "0";
		$comparePrix = '>';
	}
	$args=array(
		'paged'=> $paged,
		'meta_key' => $orderby,	
		'orderby' => 'meta_value_num',
		'order' => $tri,
		'post_type' => 'vehicule',
		'post_status' => 'publish',
		'meta_query' => array(
		array(
			'key' => 'type_vente',
			'value' => 'neuf',
		),
		array(
			'key'     => 'energie',
			'value'   => $filtreEnergie,
			'compare'	=> $compareEnergie
		),
		array(
			'key'     => 'marque',
			'value'   => $filtreMarque,
			'compare'	=> $compareMarque
		),
		array(
			'key'     => 'prix',
			'value'   => $filtrePrix,
			'type'    => 'numeric',
			'compare' => $comparePrix
		)),
		'posts_per_page' => 6,
		'ignore_sticky_posts'=> 1);

	$my_query = new WP_Query($args);
	if( $my_query->have_posts()) :
		switcher_session();
		while ($my_query->have_posts()) : $my_query->the_post(); 
		?>
		<div class="col-md-4 col-sm-6 col-xs-12 liste-vehicules"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
		<div class="col-md-12 liste-vehicule">
		<h2 class="titre-liste-vehicule"><?php the_title(); ?></h2>

		<?php
		$vehicule = get_post_custom();
		$image = get_field('galerie_photos');
		?> 
		<div class="background-image-liste-vehicule"><i class="fa fa-eye fa-3x"></i>
		<img class="image-liste-vehicule" src="<?php echo $image[0]->guid;  ?>" alt="<?php echo $image[0]->post_title;  ?>" /> </div>
		<div class="champs-liste-vehicule">
		<strong class="legende-liste-vehicule">Prix :</strong> <strong class="champ-liste-vehicule"> <?php the_field('prix'); ?> €</strong><br>
		<strong class="legende-liste-vehicule">Energie :</strong> <strong class="champ-liste-vehicule"> <?php the_field('energie');?> </strong><br>
		<?php $dateMiseCirculation = date_create(get_field('date_mise_en_circulation')); ?>
		<strong class="legende-liste-vehicule">Année :</strong> <strong class="champ-liste-vehicule"> <?php echo date_format($dateMiseCirculation,"Y");?> </strong><br>
		</div>
		</div>
		</a>
		</div>
		<?php
		endwhile;
		?>
		<div class="col-md-12 text-center">
		<?php
		echo pagination($my_query);
		?>
		</div>
  <?php
else: 
	?>

<div id="no-resultat" class="col-xs-12">
<img class="img-responsive col-md-4 col-md-offset-4" src="<?php bloginfo('stylesheet_directory'); ?>/img/fumeevoiture.png" />

	<h3 class="col-md-12 text-center"> Il n'y a pas de véhicules correspondants à vos critères.</h3>
	
	
	

</div>

<?php
endif;
?>
</div>

</div>
<?php wp_reset_query(); ?>
<?php
	$args2=array(
		'paged'=> $paged,
		'post_type' => 'vehicule');

	$my_query2 = new WP_Query($args2);
	while ($my_query2->have_posts()) : $my_query2->the_post(); 
	endwhile;
$marque = get_field_object('marque');
$energie = get_field_object('energie');
?>
<div class="col-md-3 space-sb hidden-xs hidden-sm">

<aside class="sidebar-right col-xs-12 widget widget-filtre">
<form action="" method="post">
	<h1 class="widget-title">Rechercher</h1>
	<select class="select-filtre col-md-12" name="marque">
		<option value="">Marque</option>
		<?php foreach  ($marque['choices'] as $key => $value) {
			echo '<option value="'.$key.'"';
			if (isset($_POST['marque']) && $_POST['marque']==$value) {
				echo ' selected ';
			}
			echo '>'.$value.'</option>';
		}
		?>
	</select>
	<select class="select-filtre col-md-12" name="prix">
	<option value="">Prix</option>
		<?php for  ($i=2500; $i < 50001; $i+=2500) {
			echo '<option value="'.$i.'"';
			if (isset($_POST['prix']) && $_POST['prix']==$i) {
				echo ' selected ';
			}
			echo '> < '.$i.' €</option>';
		}
		?>
		<option value="50001"
		<?php if (isset($_POST['prix']) && $_POST['prix']==50001) {
				echo ' selected ';
			} 
		?>
		> > 50000 €</option>
	</select>
	
	<select class="select-filtre col-md-12" name="energie">
		<option value="">Energie</option>
		<?php foreach  ($energie['choices'] as $key => $value) {
			echo '<option value="'.$key.'" ';
			if (isset($_POST['energie']) && $_POST['energie']==$value) {
				echo ' selected ';
			}
			echo '>'.$value.'</option>';
		}
		?>
	</select>
	 <button type="submit" id="btn-filtre" class="btn btn-default pull-right">Voir les résultats <i class="fa fa-search"></i></button>
	</form>
</aside>
</div>

<div class="hidden-xs hidden-sm col-md-3 space-sb">
<?php get_sidebar('right'); ?> 
</div>
<?php get_footer(); ?> 

<!-- <pre>
	<?php print_r($args);
	print_r($_POST);  ?>
</pre> -->
