<?php
/**
 * Custom IS Brno theme functions for WooCommerce 
 */

/**
 * Add support for WooCommerce to enable customizations
 */
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

/**
 * Remove WooCommerce breadcrumbs 
 */
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'woo_remove_wc_breadcrumbs' );

/**
 * Add Bootstrap CSS classes to WooCommerce fields
 */
function add_bootstrap_to_checkout_fields($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            // Add the form-group class around the label and the input
            $field['class'][] = 'form-group'; 
            // Add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'add_bootstrap_to_checkout_fields' );

/**
 * Add PR feedback field to the checkout page
 */
function checkout_add_pr_feedback($checkout) {
    echo '<h3 id="after_customer_details">Dodatečné informace</h3>';
    woocommerce_form_field('pr_feedback', array(
        'type' => 'text',
        'required' => true,
        'class' => array('form-group form-row-wide'),
        'input_class' => array('form-control'),
        'label' => __('Jak jste se dozvěděli o Fondu her 2?'),
        'placeholder' => __('Z Facebooku, z časopisu Gymnasion, ve škole, ...'),
        ),
    $checkout->get_value('pr_feedback'));
}
add_action('woocommerce_before_order_notes', 'checkout_add_pr_feedback');

/**
 * Check for PR feedback to be filled in
 */
function checkout_check_pr_feedback() {
    if ( ! $_POST['pr_feedback'] ) {
        wc_add_notice( __( 'Prosím napište, jak jste se dozvěděli o Fondu her 2.' ), 'error' );
    }
}
add_action('woocommerce_checkout_process', 'checkout_check_pr_feedback');

/**
 * Update the value given in PR feedback field
 */
function checkout_update_order_meta_pr_feedback($order_id) {
    if (!empty($_POST['pr_feedback'])) {
        update_post_meta($order_id, 'PR feedback',sanitize_text_field($_POST['pr_feedback']));
    }
}
add_action('woocommerce_checkout_update_order_meta', 'checkout_update_order_meta_pr_feedback');

/**
 * Display PR feedback field value on the order edit page
 */
function admin_order_meta_display_pr_feedback($order){
        echo '<p><strong>'.__('Jak se dozvěděli o Fondu 2').':</strong><br/>' . get_post_meta( $order->id, 'PR feedback', true ) . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'admin_order_meta_display_pr_feedback', 10, 1 );


function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "To view this protected post, enter the password below:" ) . '
    <label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
    return $o;
}

/**
 * Adjust the password text for game materials
 */
function change_password_protected_text($output) {
    if ( is_page( 'materialy-ke-hram' ) ) {
        global $post;
        $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
        $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
        ' . "<p>Tato stránka je určena pouze pro držitele Fondu her 2.</p><p>Heslo k materálům je poslední slovo na stránce 132 v knižím vydání Fondu her 2 (malými písmeny, bez diakritiky).</p>" . '
        <label for="' . $label . '">' . __( "Heslo:" ) . ' </label><input class="form-control" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input class="btn" type="submit" name="Submit" value="' . esc_attr__( "Odemknout" ) . '" />
        </form>
        ';
    }
    return $output;
}
add_filter( 'the_password_form', 'change_password_protected_text');

/**
 * Remove links to product pages
 */
function product_invisible() {
    return false;
}
add_filter( 'woocommerce_product_is_visible','product_invisible');

/**
 * Remove single product pages
 */
function hide_product_pages() {
    if ( is_product() ) {
        wp_redirect( home_url() );
        exit;
    }
}
add_action( 'template_redirect', 'hide_product_pages' );

?>
