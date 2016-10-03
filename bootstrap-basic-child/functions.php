<?php 

// require get_template_directory() . '/inc/customizer.php';

// require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails', array( 'post', 'page', 'vehicule' ) );
}

// Menu du Footer
register_nav_menus( array(
        'footer' => 'Navigation Footer',
    ) );

 // Logo dans le Header
// function lambda_customize_register( $wp_customize ) {
//     $wp_customize->add_setting( 'lambda_logo' ); // Add setting for logo uploader
         
//     // Add control for logo uploader (actual uploader)
//     $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lambda_logo', array(
//         'label'    => __( 'Logo', 'lambda' ),
//         'section'  => 'title_tagline',
//         'settings' => 'lambda_logo',
//     ) ) );
// }

// add_action( 'customize_register', 'lambda_customize_register' );
// Logo dans le Header
$parametresCustomHeader = array(
    'default-image' => get_template_directory_uri() . '/images/header.jpg',
    'random-default'         => false,
    'flex-height'            => false,
    'flex-width'             => false,
    'default-text-color'     => '',
    'header-text'            => true,
    'uploads'                => true,
    'wp-head-callback'       => '',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
);

add_theme_support( 'custom-header', $parametresCustomHeader);


// Fonction tri liste vehicules

	function switcher_session() {
        if (isset($_POST['orderby']) && !empty($_POST['orderby'])) {
            $current_orderby = $_POST['orderby'];
        }
        else {
            $current_orderby = $_SESSION[ 'orderby' ];
        }

        if (isset($_POST['post-order']) && !empty($_POST['post-order'])) {
            $current_post_order = $_POST['post-order'];
        }
        else {
            $current_post_order = $_SESSION[ 'post-order' ];
        }
	  	?>

	  	<form method="post" class="switcher col-xs-12">
	     	<p><label for="orderby">Trier par :</label>
	        	<select id="orderby" name="orderby" onchange="this.form.submit()">
	            	<option value="date_mise_en_circulation" <?php selected( $current_orderby, 'date_mise_en_circulation' ); ?>>Date</option>
	            	<option value="prix"<?php selected( $current_orderby, 'prix' ); ?>>Prix</option>
	       		</select>
                <button 
               <?php if ($current_post_order == 'DESC') {
                    echo 'class="btn-tri"';
                }
                else {
                    echo 'class="btn-tri-active"';
                }
                ?>
                 type="" name="post-order" value="ASC"><i class="fa fa-chevron-up"></i></button>
                <button 
                <?php if ($current_post_order == 'DESC') {
                    echo 'class="btn-tri-active"';
                }
                else {
                    echo 'class="btn-tri"';
                }
                ?> type="" name="post-order" value="DESC"><i class="fa fa-chevron-down"></i></button>
	       	</p>
	  	</form>
	  	<?php
	}

	add_action( 'init', 'switch_session' );
	function switch_session() {
	    // J'initialize la session
	    if( ! session_id() )
	        session_start();

	    // Si le switcher à été utilisé, on change la valeur
	    if( isset( $_POST[ 'post-order' ] ) ) {
	        $_SESSION[ 'post-order' ] = $_POST['post-order'] ;
	    }

	    // S'il n'y a pas d'ordre de défini, on en met un par défaut
	    if( ! isset( $_SESSION[ 'post-order' ] ) )
	        $_SESSION[ 'post-order' ] = 'ASC';
	        
	}


	function pagination($query) {
    $baseURL="http://".$_SERVER['HTTP_HOST'];
        if($_SERVER['REQUEST_URI'] != "/")
        $baseURL = $baseURL.$_SERVER['REQUEST_URI'];


        // Suppression de '/page' de l'URL
        $sep = strrpos($baseURL, '/page/');
        if($sep != FALSE)
        $baseURL = substr($baseURL, 0, $sep);


    // Suppression des paramètres de l'URL
        $sep = strrpos($baseURL, '?');
        if($sep != FALSE){
            // On supprime le caractère avant qui est un '/'
            $baseURL = substr($baseURL, 0, ($sep-1));
        }
        $page = $query->query_vars["paged"];
        if ( !$page ) $page = 1;
            $qs = $_SERVER["QUERY_STRING"] ? "?".$_SERVER["QUERY_STRING"] : "";
        // Nécessaire uniquement si on a plus de posts que de posts par page admis
        if ( $query->found_posts > $query->query_vars["posts_per_page"] ) {
            echo '<nav class="list-pagination">';
            echo '<ul class="pagination">';
            // lien précédent si besoin
            if ( $page > 1 ) {
                echo '<li class="next_prev prev"><a title="Revenir à la page précédente (vous êtes à la page '.$page.')" href="'.$baseURL.'/page/'.($page-1).'/'.$qs.'">« </a></li>';
            }
            // la boucle pour les pages
            for ( $i=1; $i <= $query->max_num_pages; $i++ ) {
                // ajout de la classe active pour la page en cours de visualisation
                if ( $i == $page ) 
                        echo '<li class="active"><a href="#pagination" title="Vous êtes sur cette page '.$i.'">'.$i.'</a></li>';
                else 
                        echo '<li><a title="Rejoindre la page '.$i.'" href="'.$baseURL.'/page/'.$i.'/'.$qs.'">'.$i.'</a></li>';
            }
            // le lien next si besoin
            if ( $page < $query->max_num_pages ) 
                echo '<li class="next_prev next"><a title="Passer à la page suivante (vous êtes à la page '.$page.')" href="'.$baseURL.'/page/'.($page+1).'/'.$qs.'">»</a></li>';
            echo '</ul>';
            echo '</nav>';
        }
}


