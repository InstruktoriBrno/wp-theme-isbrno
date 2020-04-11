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
        echo '<p><strong>'.__('Jak se dozvěděli o Fondu 2').':</strong> ' . get_post_meta( $order->id, 'PR feedback', true ) . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'admin_order_meta_display_pr_feedback', 10, 1 );

?>
