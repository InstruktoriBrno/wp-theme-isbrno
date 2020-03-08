<?php
/**
 * instruktori Sports functions and definitions
 *
 * @package Instruktori
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}
if ( ! function_exists( 'instruktori_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function instruktori_setup() {

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on instruktori Sports, use a find and replace
		 * to change 'instruktori' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'instruktori', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Remove comments from admin menu
		 */
		add_action( 'admin_menu', 'my_remove_menu_pages' );

		function my_remove_menu_pages() {
			remove_menu_page( 'edit-comments.php' );
		}

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary'   => __( 'Hlavní menu', 'instruktori' ),
			'secondary' => __( 'Menu o nás', 'instruktori' ),
		) );

	}
endif; // instruktori_setup
add_action( 'after_setup_theme', 'instruktori_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function instruktori_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'O instruktorech', 'instruktori' ),
		'id'            => 'front-page-is',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="red-area">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'O IS Brno v patičce', 'instruktori' ),
		'id'            => 'footer-is',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sociální sítě', 'instruktori' ),
		'id'            => 'footer-social',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'instruktori_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function instruktori_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://code.jquery.com/jquery-1.9.1.min.js' ); 
	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.css' );
	wp_enqueue_style( 'codrops-sidebar-style', get_template_directory_uri() . '/inc/component.css' );
	wp_enqueue_style( 'instruktori-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'respond-js', get_template_directory_uri() . '/js/respond.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) );
	// Commented out by mukrop on 2017-07-28 as it got 404 on page load.
	// wp_enqueue_script( 'codrops-sidebar-script', get_template_directory_uri() . '/inc/sidebarEffects.js', array(), '20120206', true );
	// wp_enqueue_script( 'codrops-ie-script', get_template_directory_uri() . '/inc/classie.js', array(), '20120206', true );
	wp_enqueue_script( 'instruktori-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'instruktori-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'instruktori_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom post types definition.
 */
require get_template_directory() . '/inc/custom-post-type-config.php';



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* REGISTER BOOTSTRAP NAVBAR WALKER */
require_once 'wp_navwalker.php';

function remove_menus() {
	remove_menu_page( 'edit.php' );                   // Posts
}
add_action( 'admin_menu', 'remove_menus' );

// Include WooCommerce customizations
require_once 'woocommerce/functions.php';

/* POVOLENÍ PSEUDOHTML ELEMENTŮ V WIDGET TITLE */

function html_widget_title( $title ) {
	// HTML tag opening/closing brackets
	$title = str_replace( '[', '<', $title );
	$title = str_replace( '[/', '</', $title );

	// <strong></strong>
	$title = str_replace( 's]', 'strong>', $title );
	// <em></em>
	$title = str_replace( 'e]', 'em>', $title );

	return $title;
}
add_filter( 'widget_title', 'html_widget_title' );


/** Vrácení českého názvu měsíce
 *
 * @param int 1-12
 * @return string
 * @copyright Jakub Vrána, http://php.vrana.cz/
 */
function cesky_mesic( $mesic ) {
	static $nazvy = array(
		1 => 'leden',
		'únor',
		'březen',
		'duben',
		'květen',
		'červen',
		'červenec',
		'srpen',
		'září',
		'říjen',
		'listopad',
		'prosinec',
	);
	return $nazvy[ $mesic ];
}
	

	/** Vrácení českého názvu dne v týdnu
	 *
	 * @param int 0-6, 0 neděle
	 * @return string
	 * @copyright Jakub Vrána, http://php.vrana.cz/
	 */
function cesky_den( $den ) {
	static $nazvy = array( 'neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota' );
	return $nazvy[ $den ];
}

	/** Pagination */

function pagination( $pages = '', $range = 4 ) { 
	 $showitems = ( $range * 2 ) + 1; 
	 
	 global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}
	 
	if ( $pages == '' ) {
		   global $wp_query;
		   $pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}  
	 
	if ( 1 != $pages ) {
			echo '<ul class="pagination">'; // <span>Stránka ".$paged." / ".$pages."</span>
			// if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
		if ( $paged > 1 ) {
			echo "<li><a class=\"without-box prev\" href='" . get_pagenum_link( $paged - 1 ) . "'>&lt; &nbsp; novější</a></li>";
		} else {
			echo "<li class=\"disabled\"><a class=\"without-box prev\" href='" . get_pagenum_link( $paged - 1 ) . "'>&lt; &nbsp; novější</a></li>";   
		}
	 
		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? '<li class="active"><span class="current">' . $i . '</span></li>' : "<li><a href='" . get_pagenum_link( $i ) . "' class=\"inactive\">" . $i . '</a></li>';
			}
		}
	 
		if ( $paged < $pages ) {
			echo '<li><a class="without-box next" href="' . get_pagenum_link( $paged + 1 ) . '">starší &nbsp; &gt;</a></li>';  // && $showitems < $pages
		} else {
			echo '<li class="disabled"><a class="without-box next" href="' . get_pagenum_link( $paged + 1 ) . '">starší &nbsp; &gt;</a></li>';  // && $showitems < $pages
		}
			echo "</ul>\n";
	}
}




