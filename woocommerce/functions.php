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
 * Set orders to "on hold" after payment.
 */
function set_on_hold_status( $order_status, $order_id ) {
    return 'on-hold';
}
add_filter( 'woocommerce_payment_complete_order_status', 'set_on_hold_status', 10, 2 );

/**
 * Adjust eshop to send subtotal to Zasilkovna (solves the free deliveries)
 */
function extend_zasilkovna_ticket_value( $price, $order, $zasilkovna_option, $zasilkovna_id){
    return $order->get_subtotal();
}
add_filter( 'zasilkovna_ticket_value', 'extend_zasilkovna_ticket_value', 10, 4 );

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
 * Add custom validation to the phone number
 */
add_action('woocommerce_checkout_process', 'custom_validate_billing_phone');
function custom_validate_billing_phone() {
    $phone_no_whitespace = preg_replace('/\s/', '', $_POST['billing_phone']);
    $is_correct = preg_match('/^\+[0-9]{10,12}$/', $phone_no_whitespace);
    if ( !$is_correct) {
        wc_add_notice( __( 'Zadejte prosím platné <strong>telefonní číslo</strong> i s předvolbou (např. +420 776 123 456).' ), 'error' );
    }
}

/**
 * Reorder billing fields (company name first)
 */
function billing_company_first( $checkout_fields ) {
	$checkout_fields['billing']['billing_company']['priority'] = 5;
	return $checkout_fields;
}
add_filter( 'woocommerce_checkout_fields', 'billing_company_first' );

/**
 * Add optional ICO field to the checkout page
 */
function checkout_add_ico($checkout) {
    woocommerce_form_field('ico', array(
        'type' => 'text',
        'required' => false,
        'class' => array('form-group form-row-wide'),
        'input_class' => array('form-control'),
        'label' => __('IČO organizace'),
        ),
    $checkout->get_value('ico'));
}
add_action('woocommerce_before_checkout_billing_form', 'checkout_add_ico');

/**
 * Add custom validation to ICO field
 */
function custom_validate_ico() {
    $phone_no_whitespace = preg_replace('/\s/', '', $_POST['ico']);
    $is_correct = preg_match('/^[0-9]{8}$/', $_POST['ico']);
    if ( !empty($_POST['ico']) && !$is_correct) {
        wc_add_notice( __( '<strong>Zadané IČO</strong> není platné (nemá osm číslic).' ), 'error' );
    }
}
add_action('woocommerce_checkout_process', 'custom_validate_ico');

/**
 * Update the value given in ICO field
 */
function checkout_update_order_meta_ico($order_id) {
    if (!empty($_POST['ico'])) {
        update_post_meta($order_id, 'ICO', sanitize_text_field($_POST['ico']));
    }
}
add_action('woocommerce_checkout_update_order_meta', 'checkout_update_order_meta_ico');

/**
 * Display ICO field value on the order edit page
 */
function admin_order_meta_display_ico($order){
        echo '<p><strong>'.__('IČO organizace').':</strong><br/>' . get_post_meta( $order->id, 'ICO', true ) . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'admin_order_meta_display_ico', 10, 1 );

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
        wc_add_notice( __( 'Prosím napište, <strong>jak jste se dozvěděli o Fondu her 2</strong>.' ), 'error' );
    }
}
add_action('woocommerce_checkout_process', 'checkout_check_pr_feedback');

/**
 * Update the value given in PR feedback field
 */
function checkout_update_order_meta_pr_feedback($order_id) {
    if (!empty($_POST['pr_feedback'])) {
        update_post_meta($order_id, 'PR feedback', sanitize_text_field($_POST['pr_feedback']));
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
