<?php
/**
 * Template for displaying vehicule
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
<div class="row" id="infos-entreprise">
	<div class="col-xs-12 col-sm-6"><i class="fa fa-map-marker"></i> Quelque part</div>
	<div class="pull-right col-xs-12 col-sm-6"><i class="fa fa-phone"></i> 01.23.45.67.89</div>
</div>
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column"> 

	<main id="main-vehicule" class="site-main" role="main">
		<?php the_title( '<h1 class="title">', '</h1>' ); ?>
		<div class="contenu-vehicule">
			<?php 
			
			$vehicule = get_post_custom();
			$image = get_field('galerie_photos');
			$nbImages = count($image);
			?>

			
			<div id="carousel-vehicule" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img class="image-carrousel-vehicule" src="<?php echo $image[0]->guid;  ?>" alt="<?php echo $image[0]->post_title;  ?>" />
					</div>
					<?php for($i=1; $i < count($image); $i++) {?>
					<div class="item">
						<img class="image-carrousel-vehicule" src="<?php echo $image[$i]->guid;  ?>" alt="<?php echo $image[$i]->post_title;  ?>" />
					</div>
					<?php } ?>

				</div>
				
			</div>
			<div class="carousel-controls-indicators">
				<!-- Controls -->
				<a class="" href="#carousel-vehicule" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="" href="#carousel-vehicule" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>

				<!-- Indicators -->
				<ol class="carousel-indicators pull-right">
					<?php for($j=0; $j < count($image); $j++) {?>
					<li data-target="#carousel-vehicule" data-slide-to="<?php echo $j ?>">  </li>
					<?php } ?>
				</ol>
			</div>



			<!-- Nav tabs -->
			<div id="tabsVehicule">
			<ul class="tabs">
				<li class="active"  rel='ficheTechnique'>Fiche Technique</li>
				<li rel='equipements' >Equipements</i></li>
				<li rel='divers' >Divers</i></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab_container">
				<h3 class="d_active tab_drawer_heading" rel="ficheTechnique">Fiche Technique<i class="fa fa-chevron-down chevron-accordeon" aria-hidden="true"></i></h3>
				<div id="ficheTechnique" class="tab_content">
					Marque : <?php the_field('marque');?> <br>
					Energie : <?php the_field('energie');?> <br>
					Genre : <?php the_field('genre');?> <br>
					Boite de Vitesse : <?php the_field('boite_vitesse');?> <br>
					Puissance du Moteur : <?php the_field('puissance_moteur');?> <br>
					Puissance Fiscale : <?php the_field('puissance_fiscale');?> <br>
					Type de Carrosserie : <?php the_field('type_carrosserie');?> <br>
					Nombre de Portes : <?php the_field('nombre_portes');?> <br>
					Nombre de Places : <?php the_field('nombre_places');?> <br>
					Kilométrage : <?php the_field('km');?> km<br>
					<?php $dateMiseCirculation = date_create(get_field('date_mise_en_circulation')); ?>
					Date de 1ère Mise en circulation : <?php echo date_format($dateMiseCirculation,"d/m/Y");?> <br>
					<br>
					Prix : <?php the_field('prix');?> €<br>
				</div>
				<h3 class="d_active tab_drawer_heading" rel="equipements">Equipements<i class="fa fa-chevron-left chevron-accordeon" aria-hidden="true"></i></h3>
				<div id="equipements" class="tab_content">
					<?php 
					$equipements = get_field_object('equipements');
					$value = $equipements['value'];
					$choices = $equipements['choices'];

					if( $value ): ?>
					<ul>
						<?php foreach( $value as $v ): ?>
							<li>
								<?php echo $choices[ $v ]; ?>
							</li>
						<?php endforeach; ?>
					</ul>
					<?php endif;?>
				</div>
				<h3 class="d_active tab_drawer_heading" rel="divers">Divers <i class="fa fa-chevron-left chevron-accordeon" aria-hidden="true"></i></h3>
				<div id="divers" class="tab_content">
					<?php
					if( get_field('divers') ) {
						the_field('divers');
					}
					else {
						echo 'Il n\'a pas plus d\'informce véhicule';
					}
					?>
				</div>
		</div>	
		



		<div class="info-besoin-aide"><i class="fa fa-question-circle"></i> Besoin d'informations ou de conseils ? N'hésitez pas à nous contacter :</div>
		<div class="info-tel"><i class="fa fa-phone"></i> 01.23.45.67.89</div>
	</div>
</main>
</div>
<div class="hidden-xs hidden-sm col-md-3 space-sb">
<?php get_sidebar('right'); ?> 
</div>
<?php get_footer(); ?> 
<script type="text/javascript">
	jQuery(document).ready(function($){
    $(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.tabs li").click(function() {
		
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();		
		
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
	  
    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
	  
	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
	  
	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");

	  $('.chevron-accordeon').removeClass('fa-chevron-down');
	  $('.chevron-accordeon').addClass('fa-chevron-left');
	  $("h3[rel^='"+d_activeTab+"'] i").addClass("fa-chevron-down");
    });

	
	/* Extra class "tab_last" 
	   to add border to right side
	   of last tab */
	$('ul.tabs li').last().addClass("tab_last");
	});
</script>