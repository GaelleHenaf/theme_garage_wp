<?php
/**
 * Template fordiplaying sitemapping
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
<div class=" col-xs-12 col-md-<?php echo $main_column_size; ?> content-area" id="main-column"> 
	<h1 class="title">
		Nos Services
	</h1>
	<div id="contenu-page">
	<div class="row">
		<?php 


		$services = get_field_object('service-checkbox');
		$value = $services['value'];
		$choices = $services['choices'];
		$img = ['amortisseur', 'batterie', 'carosserie', 'climatisation', 'direction', 'echappement', 'immatriculation', 'pneumatique', 'toutes-marques'];

		end($value);       
		$nb_services = key($value); 

		$chemin = get_bloginfo('stylesheet_directory');

		$i = 0;
		$services_sans_image = array();

		foreach ($value as  $v) {
			if (in_array($v, $img) && $i<8) {
				echo '<div class="col-sm-6 col-xs-12"><img class="image-service" src="'.$chemin.'/img/'.$v.'.png" alt="'.$choices[$v].'">'.$choices[$v].'</div>';
				$i++;
			}
			else {
				array_push($services_sans_image, $v);
			}
		}

		

		end($services_sans_image);       
		$nb_services_sans_image = key($services_sans_image); 
		$moitie = ceil($nb_services_sans_image/2);
		if ($nb_services_sans_image > 0) { 
			if ($i > 0) {
				?> <div id="mais-aussi" class="col-xs-12"> Mais aussi : </div> <?php
			}
			if ($nb_services_sans_image > 1) { ?>
				<div  class="col-sm-5">
					<ul>
					<?php
					for ($j=0; $j<=$moitie; $j++){
					echo '<li class="col-xs-12">'.$choices[$services_sans_image[$j]].'</li>'; 
					}
					?>
					</ul>
				</div>
				<div id="services_sans_image" class="col-sm-1 hidden-xs" style='height: <?php echo $j*25 ?>px;'>
				</div>
				<div class="col-sm-6">
					<ul>
					<?php
					for ($k=$moitie+1; $k<=$nb_services_sans_image; $k++){
					echo '<li class="col-xs-12">'.$choices[$services_sans_image[$k]].'</li>'; 
					}
					?>
					</ul>
				</div>
			<?php }
			else { ?>
				<div class="service_sans_image col-sm-6">
					<?php echo $choices[$service]; ?>
				</div>
			<?php }
		}
		
		
?>

<div id="mais-aussi" class="col-xs-12"> Autres Services : </div>
<div class="col-xs-12">
<?php the_field('autre_service'); ?>
</div>
</div></div></div>

<div class="hidden-xs hidden-sm col-md-3 space-sb">
<?php get_sidebar('right'); ?> 
</div>
<?php get_footer(); ?> 
<!-- 
<pre>
	<?php print_r($services_sans_image);?>
	<?php print_r($service);?>
</pre> -->
