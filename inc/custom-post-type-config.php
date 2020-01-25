<?php
// Register Custom Post Type
function custom_post_types_init() {

	$labels = array(
		'name'                => _x( 'Kalendář akcí', 'Post Type General Name', 'instruktori' ),
		'singular_name'       => _x( 'Akce', 'Post Type Singular Name', 'instruktori' ),
		'menu_name'           => __( 'Akce', 'instruktori' ),
		'parent_item_colon'   => __( 'Nadřazená akce', 'instruktori' ),
		'all_items'           => __( 'Všechny akce', 'instruktori' ),
		'view_item'           => __( 'Zobrazit akci', 'instruktori' ),
		'add_new_item'        => __( 'Přidat novou akci', 'instruktori' ),
		'add_new'             => __( 'Nová akce', 'instruktori' ),
		'edit_item'           => __( 'Upravit akci', 'instruktori' ),
		'update_item'         => __( 'Upravit akci', 'instruktori' ),
		'search_items'        => __( 'Prohledat akce', 'instruktori' ),
		'not_found'           => __( 'Nenalezeno', 'instruktori' ),
		'not_found_in_trash'  => __( 'V koši nebyly nalezeny žádné akce', 'instruktori' ),
	);
	$args = array(
		'label'               => __( 'akce', 'instruktori' ),
		'description'         => __( 'Akce', 'instruktori' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'          => array( 'typ_akce' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-universal-access',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'akce', $args );

	$labels = array(
		'name'                => _x( 'Slider', 'Post Type General Name', 'instruktori' ),
		'singular_name'       => _x( 'Slider', 'Post Type Singular Name', 'instruktori' ),
		'menu_name'           => __( 'Slider', 'instruktori' ),
		'parent_item_colon'   => __( 'Nadřazený příspěvek', 'instruktori' ),
		'all_items'           => __( 'Všechny příspěvky', 'instruktori' ),
		'view_item'           => __( 'Zobrazit příspěvky', 'instruktori' ),
		'add_new_item'        => __( 'Přidat nový příspěvek', 'instruktori' ),
		'add_new'             => __( 'Nový příspěvek', 'instruktori' ),
		'edit_item'           => __( 'Upravit příspěvek', 'instruktori' ),
		'update_item'         => __( 'Upravit příspěvek', 'instruktori' ),
		'search_items'        => __( 'Vyhledat příspěvek', 'instruktori' ),
		'not_found'           => __( 'Nenalezeno', 'instruktori' ),
		'not_found_in_trash'  => __( 'V koši nebyly nalezeny žádné příspěvky', 'instruktori' ),
	);
	$args = array(
		'label'               => __( 'slider', 'instruktori' ),
		'description'         => __( 'Slider', 'instruktori' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'page-attributes'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => false,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-images-alt',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'slider', $args );

	$labels = array(
		'name'                => _x( 'Galerie', 'Post Type General Name', 'instruktori' ),
		'singular_name'       => _x( 'Galerie', 'Post Type Singular Name', 'instruktori' ),
		'menu_name'           => __( 'Galerie', 'instruktori' ),
		'parent_item_colon'   => __( 'Nadřazený příspěvek', 'instruktori' ),
		'all_items'           => __( 'Všechny příspěvky', 'instruktori' ),
		'view_item'           => __( 'Zobrazit příspěvky', 'instruktori' ),
		'add_new_item'        => __( 'Přidat nový příspěvek', 'instruktori' ),
		'add_new'             => __( 'Nový příspěvek', 'instruktori' ),
		'edit_item'           => __( 'Upravit příspěvek', 'instruktori' ),
		'update_item'         => __( 'Upravit příspěvek', 'instruktori' ),
		'search_items'        => __( 'Vyhledat příspěvek', 'instruktori' ),
		'not_found'           => __( 'Nenalezeno', 'instruktori' ),
		'not_found_in_trash'  => __( 'V koši nebyly nalezeny žádné příspěvky', 'instruktori' ),
	);
	$args = array(
		'label'               => __( 'galerie', 'instruktori' ),
		'description'         => __( 'Foto a Videogalerie', 'instruktori' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'          => array( 'typ_galerie' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	//register_post_type( 'galerie', $args );

$labels = array(
		'name'                => _x( 'Tradiční akce', 'Post Type General Name', 'instruktori' ),
		'singular_name'       => _x( 'Tradiční akce', 'Post Type Singular Name', 'instruktori' ),
		'menu_name'           => __( 'Tradiční akce', 'instruktori' ),
		'parent_item_colon'   => __( 'Nadřazený příspěvek', 'instruktori' ),
		'all_items'           => __( 'Všechny příspěvky', 'instruktori' ),
		'view_item'           => __( 'Zobrazit příspěvky', 'instruktori' ),
		'add_new_item'        => __( 'Přidat nový příspěvek', 'instruktori' ),
		'add_new'             => __( 'Nový příspěvek', 'instruktori' ),
		'edit_item'           => __( 'Upravit příspěvek', 'instruktori' ),
		'update_item'         => __( 'Upravit příspěvek', 'instruktori' ),
		'search_items'        => __( 'Vyhledat příspěvek', 'instruktori' ),
		'not_found'           => __( 'Nenalezeno', 'instruktori' ),
		'not_found_in_trash'  => __( 'V koši nebyly nalezeny žádné příspěvky', 'instruktori' ),
	);
	$args = array(
		'label'               => __( 'tradice', 'instruktori' ),
		'description'         => __( 'Tradiční akce Instruktorů Brno', 'instruktori' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-universal-access-alt',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'tradice', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_types_init', 0 );





// Register Custom Taxonomy
function add_custom_taxonomies()  {

	$labels = array(
		'name'                       => _x( 'Typy galerií', 'Taxonomy General Name', 'instruktori' ),
		'singular_name'              => _x( 'Typ galerie', 'Taxonomy Singular Name', 'instruktori' ),
		'menu_name'                  => __( 'Typ galerie', 'instruktori' ),
		'all_items'                  => __( 'Všechny typy galerií', 'instruktori' ),
		'parent_item'                => __( 'Nadřazený typ', 'instruktori' ),
		'parent_item_colon'          => __( 'Nadřazený typ', 'instruktori' ),
		'new_item_name'              => __( 'Nový typ', 'instruktori' ),
		'add_new_item'               => __( 'Přidat nový typ', 'instruktori' ),
		'edit_item'                  => __( 'Upravit typ', 'instruktori' ),
		'update_item'                => __( 'Upravit typ', 'instruktori' ),
		'separate_items_with_commas' => __( 'Oddělte kategorie čárkou', 'instruktori' ),
		'search_items'               => __( 'Prohledej kategorie', 'instruktori' ),
		'add_or_remove_items'        => __( 'Přidej nebo uprav kategorie', 'instruktori' ),
		'choose_from_most_used'      => __( 'Vyberte z nejčastěji používaných', 'instruktori' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'typ_galerie', 'galerie', $args );


	$labels = array(
		'name'                       => _x( 'Typy akcí', 'Taxonomy General Name', 'instruktori' ),
		'singular_name'              => _x( 'Typ akce', 'Taxonomy Singular Name', 'instruktori' ),
		'menu_name'                  => __( 'Typ akce', 'instruktori' ),
		'all_items'                  => __( 'Všechny typy akcí', 'instruktori' ),
		'parent_item'                => __( 'Nadřazený typ', 'instruktori' ),
		'parent_item_colon'          => __( 'Nadřazený typ', 'instruktori' ),
		'new_item_name'              => __( 'Nový typ', 'instruktori' ),
		'add_new_item'               => __( 'Přidat nový typ', 'instruktori' ),
		'edit_item'                  => __( 'Upravit typ', 'instruktori' ),
		'update_item'                => __( 'Upravit typ', 'instruktori' ),
		'separate_items_with_commas' => __( 'Oddělte kategorie čárkou', 'instruktori' ),
		'search_items'               => __( 'Prohledej kategorie', 'instruktori' ),
		'add_or_remove_items'        => __( 'Přidej nebo uprav kategorie', 'instruktori' ),
		'choose_from_most_used'      => __( 'Vyberte z nejčastěji používaných', 'instruktori' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'typ_akce', 'akce', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_custom_taxonomies', 0 );


/* Přidání custom metafields pro typ akce a jejich ukládání */

add_action( 'add_meta_boxes', 'akce_datum_box' );
function akce_datum_box() {
    add_meta_box( 
        'akce_datum_box',
        __( 'Detaily akce', 'instruktori' ),
        'akce_datum_box_content',
        'akce',
        'advanced',
        'core'
    );
}

function akce_datum_box_content( $post ) {
	//wp_nonce_field( plugin_basename( __FILE__ ), 'akce_datum_box_content_nonce' );
	
	$akce_from_timestamp = get_post_meta($post->ID, 'akce_from', TRUE); 
	$akce_to_timestamp = get_post_meta($post->ID, 'akce_to', TRUE); 
	
	if (!empty($akce_from_timestamp)){
		$akce_from = date('d.m.Y', $akce_from_timestamp);
	}
	else{
		$akce_from='';
	}

	if (!empty($akce_to_timestamp)){
		$akce_to = date('d.m.Y', $akce_to_timestamp);
	}
	else{
		$akce_to='';
	}
	
	$akce_from_time = get_post_meta($post->ID, 'akce_from_time', TRUE); 
	$akce_place = get_post_meta($post->ID, 'akce_place', TRUE); 
	$akce_map = get_post_meta($post->ID, 'akce_map', TRUE); 
	$akce_url = get_post_meta($post->ID, 'akce_url', TRUE); 
	
	
	echo '<label for="akce_from">Datum začátku akce:</label><br/>';
	echo '<input id="akce_from" name="akce_from" placeholder="dd.mm.yyyy" type="text" value="'.$akce_from.'"><br/>';
	echo '<br/>';
	echo '<label for="akce_from_time">Čas začátku akce:</label><br/>';
	echo '<input id="akce_from_time" name="akce_from_time" placeholder="hh:mm" type="text" value="'.$akce_from_time.'"><br/>';
	echo '<br/>';
	echo '<label for="akce_to">Datum konce akce (pouze pokud je vícedenní):</label><br/>';
	echo '<input id="akce_to" name="akce_to" placeholder="dd.mm.yyyy" type="text" value="'.$akce_to.'"><br/>';
	echo '<br/>';
	echo '<label for="akce_place">Místo konání (slovně):</label><br/>';
	echo '<input id="akce_place" name="akce_place" type="text" value="'.$akce_place.'" placeholder="Skautská základna Kaprálův mlýn" size="30">';
	echo '<br/>';
	echo '<label for="akce_map">Místo konání akce (adresa kvůli mapám):</label><br/>';
	echo '<input id="akce_map" name="akce_map" type="text" value="'.$akce_map.'" placeholder="Ochoz u Brna, Česká republika" size="30"><br/>';
	echo '<br/>';
	echo '<label for="akce_url">Má akce vlastní web?:</label><br/>';
	echo '<input id="akce_url" name="akce_url" type="text" value="'.$akce_url.'" placeholder="https://" size="40"><br/>';
	
}

add_action( 'save_post', 'akce_datum_box_save' );
function akce_datum_box_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	return;

	//if ( !wp_verify_nonce( $_POST['akce_datum_box_content_nonce'], plugin_basename( __FILE__ ) ) )
	//return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}
	
	if (!empty($_POST['akce_from'])){
		// 2017-12-20 @mukrop: Add 8 hrs to date to prevent CFDB update bug that subtracts 1 hour and underflows into previous day
		// $akce_from_timestamp = strtotime($_POST[akce_from]);
		$akce_from_timestamp = strtotime($_POST[akce_from]) + 28800;
		update_post_meta( $post_id, 'akce_from', $akce_from_timestamp );
	}
	if (!empty($_POST['akce_to'])){
		$akce_to_timestamp = strtotime($_POST[akce_to]);
		update_post_meta( $post_id, 'akce_to', $akce_to_timestamp );
	}
	$akce_from_time = $_POST['akce_from_time'];
	update_post_meta( $post_id, 'akce_from_time', $akce_from_time );
	
	$akce_place = $_POST['akce_place'];
	update_post_meta( $post_id, 'akce_place', $akce_place );

	$akce_map = $_POST['akce_map'];
	update_post_meta( $post_id, 'akce_map', $akce_map );

	$akce_url = $_POST['akce_url'];
	update_post_meta( $post_id, 'akce_url', $akce_url );

}



add_action( 'add_meta_boxes', 'slider_url_box' );
function slider_url_box() {
    add_meta_box( 
        'slider_url_box',
        __( 'Kam vede odkaz', 'persona' ),
        'slider_url_box_content',
        'slider',
        'advanced',
        'low'
    );
}

function slider_url_box_content( $post ) {
	//wp_nonce_field( plugin_basename( __FILE__ ), 'akce_datum_box_content_nonce' );
	
	$slider_url = get_post_meta($post->ID, 'slider_url', TRUE); 
	
	echo '<label for="slider_url">Kam vede odkaz po prokliku na banner?</label><br/>';
	echo '<input id="slider_url" name="slider_url" placeholder="https://" type="text" value="'.$slider_url.'" size="40"><br/>';
}

add_action( 'save_post', 'slider_url_box_save' );
function slider_url_box_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}
	
	$slider_url = $_POST['slider_url'];
	update_post_meta( $post_id, 'slider_url', $slider_url );

}

add_action( 'add_meta_boxes', 'tradice_url_box' );
function tradice_url_box() {
    add_meta_box( 
        'tradice_url_box',
        __( 'Kam vede odkaz', 'persona' ),
        'tradice_url_box_content',
        'tradice',
        'advanced',
        'low'
    );
}

function tradice_url_box_content( $post ) {
	//wp_nonce_field( plugin_basename( __FILE__ ), 'akce_datum_box_content_nonce' );
	
	$tradice_url = get_post_meta($post->ID, 'tradice_url', TRUE); 
	
	echo '<label for="tradice_url">Kam vede odkaz po prokliku na banner?</label><br/>';
	echo '<input id="tradice_url" name="tradice_url" placeholder="https://" type="text" value="'.$tradice_url.'" size="40"><br/>';
}

add_action( 'save_post', 'tradice_url_box_save' );
function tradice_url_box_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}
	
	$tradice_url = $_POST['tradice_url'];
	update_post_meta( $post_id, 'tradice_url', $tradice_url );

}


?>
