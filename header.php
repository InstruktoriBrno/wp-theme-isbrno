<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package instruktori Sports
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,400italic,300,300italic,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1GS6LXEJ1Z"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-1GS6LXEJ1Z');
</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/cs_CZ/sdk.js#xfbml=1&appId=178338348887615&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



<?php
if(is_home()){
?>
	<script type="text/javascript">
		$(document).ready(function () {
    		$('.carousel').carousel({
        	interval: 4000
    		});
	    $('.carousel').carousel('cycle');
		});
	</script>  
<?php
}
?>

<nav id="mainmenu" class="navbar navbar-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
      	<h1 class="site-title visible-lg"><img src="<?php echo get_template_directory_uri(); ?>/images/sova.png" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/> &nbsp;Instruktoři Brno</h1>
      	<h1 class="site-title hidden-lg"><img src="<?php echo get_template_directory_uri(); ?>/images/sova.png" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/> &nbsp;IS Brno</h1>
      </a>
    </div>

	<?php
    wp_nav_menu( array(
        'menu'              => 'primary',
		'theme_location'    => 'primary',
		'depth'             => 2,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse',
		'container_id'      => 'bs-example-navbar-collapse-1',
		'menu_class'        => 'nav navbar-nav navbar-right',
		'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		'walker'            => new wp_bootstrap_navwalker())
    );
	?>
    <!-- Collect the nav links, forms, and other content for toggling -->

  </div><!-- /.container-fluid -->
</nav>


	<?php
	if(is_home()):
	?>
	<header id="masthead" class="site-header hidden-xs" role="banner">
		<div id="banner-area">
			<div id="front-page-carousel-container" class="carousel-container">
				<div id="front-page-carousel" class="carousel slide bs-docs-carousel-example">
					<div id="front-page-carousel-footer"></div>
			        <ol class="carousel-indicators">
				        <?php
							$args = array(
				    			'post_type'  => 'slider',
								'numberposts' => '-1',
				    			'orderby' => 'menu_order', 
				    			'order' => 'ASC',
							  );

							$lastposts = get_posts( $args );	
							$count_akci = count($lastposts);

							for ($i = 0; $i < $count_akci; $i++) {
	 						   if ($i == 0){
	 						   	echo '<li data-target="#front-page-carousel" data-slide-to="0" class="active"></li>';
	 						   }
	 						   else{
	 						   	echo '<li data-target="#front-page-carousel" data-slide-to="'.$i.'"></li>';
	 						   }
							}
						?>
			        </ol>
			        <div class="carousel-inner">
				        <?php
					        $i=0;
					        foreach($lastposts as $post) : setup_postdata($post); 

					        	$slider_url = get_post_meta($post->ID, 'slider_url', true);

					        	if ($i==0){
					        		echo '<div class="item active">';
					        	}
					        	else{
					            	echo '<div class="item">';	
					            }
					            $i++;

					            if ( has_post_thumbnail() ) {
									$custom = get_post_custom();
									$custom = get_post_meta($custom["_thumbnail_id"][0], '_wp_attached_file',true);
									$uploads = wp_upload_dir();
									
									echo '<div class="post-archive-thumbnail post-thumbnail thumbnail-type-'.get_post_type( $post->ID ).' hidden-xs"><a href="'.$slider_url.'" title="'.get_the_title().'">';
										echo '<img src="'.$uploads['baseurl'].'/'.$custom.'" alt="'. get_the_title().'"/>';			
									echo '</a></div>'; //.post-archive-thumbnail apod.
								}
							
							echo '<div class="text-area">';
								echo '<div class="text-area-centered">';
									echo '<a class="left carousel-control" href="#front-page-carousel" data-slide="prev">';
						          		echo '<span class="front-page-icon-prev"><img src="'.get_template_directory_uri().'/images/slider-prev.png" alt="Předchozí"/></span>';
						        	echo '</a>';
						        	echo '<a class="right carousel-control" href="#front-page-carousel" data-slide="next">';
						          		echo '<span class="front-page-icon-next"><img src="'.get_template_directory_uri().'/images/slider-next.png" alt="Další"/></span>';
						        	echo '</a>';
									the_title('<h3><a href="'.$slider_url.'">','</a></h3>');
									echo '<div class="excerpt">';
										the_excerpt();
									echo '</div>'; // .excerpt
								echo '</div>'; // .text-area-centered
							echo '</div>'; // .text-area
							echo '<a class="blue-more" href="'.$slider_url.'">více informací &gt;&gt;&gt;</a>';
							echo '<div class="clear"></div>';

								echo '</div>';
					        endforeach;
				        ?>
			        </div>
			    </div>

			</div>
		</div><!-- #banner-area -->
		<div id="cta-area">
			<div class="container">
				<?php 
				if ( function_exists( 'ot_get_option' ) ) {
					echo ot_get_option( 'header_teaser', 'Vše, co můžeme udělat, je lidi inspirovat...' );
				}
				?>
			</div><!-- .container -->
		</div><!-- #cta-area -->




		<?php
		endif;
		if(!is_home()):
		?>
		<header id="masthead" class="site-header" role="banner">
			<div id="small-banner-area">
			</div>
		</header>
		
		<?php
		endif;
		?>
	</header><!-- #masthead -->

	<?php
	 if(is_home()){
	 	echo '<div class="red-area">';
	 }
	?>
	
	<div id="content" class="site-content container">
		<?php
		if(!is_home() AND function_exists('yoast_breadcrumb')){
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
		?>
