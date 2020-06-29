<?php
/**
 * Use this file for all your template filters and actions.
 * Requires WooCommerce PDF Invoices & Packing Slips 1.4.13 or higher
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Display ICO field above billing address
 */
function wpo_wcpdf_ico ($template_type, $order) {
    if ($template_type == 'invoice') {
        $ico = get_post_meta( $order->id, 'ICO', true );
        if (!empty($ico)) {
            echo '<p>IČO ' . $ico . '</p>';
        }
    }
}
add_action( 'wpo_wcpdf_before_billing_address', 'wpo_wcpdf_ico', 10, 2 );

?>
