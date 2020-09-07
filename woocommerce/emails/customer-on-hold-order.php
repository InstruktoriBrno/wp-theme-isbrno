<?php
/**
 * Customer on-hold order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-on-hold-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<p>Děkujeme za Vaši objednávku. Přehled objednávky naleznete níže, fakturu v příloze.</p>
<h2>Jak to bude probíhat dál?</h2>
<?php if ( in_array($order->get_shipping_method(), array("Zásilkovna", "Doručení na adresu", "Zásielkovňa (Slovensko)", "Doručení na adresu (Slovensko)")) ) {
	echo '<p>Pokud jste zvolili platbu převodem, nejprve prosím odešlete platbu za objednávku (detaily viz níže). Po přijetí Vaší platby objednávku zabalíme a odešleme. Pokud jste zvolili dobírku, platíte samozřejmě až při převzetí.</p>';
	echo '<p>Jakmile knížku odešleme na Zásilkovnu, přijde Vám email s informací o odeslání. Balíčky odesíláme 1&ndash;2x týdně.</p>';
} else {
	echo '<ol>';
	echo '<li>Nejprve prosím odešlete platbu za objednávku (detaily viz níže).</li>';
	echo '<li>Po zaplacení objednávky kontaktujte Alču Pikulovou emailem na <a href="alena.pikulova@gmail.com">alena.pikulova@gmail.com</a> a domluvte se s ní na termínu vyzvednutí knihy. Preferovaný čas, kdy se pro knihu po domluvě můžete zastavit je pondělí 10&ndash;11h nebo čtvrtek 17&ndash;18h.';
	echo '<li>Vyzvedněte si knížku dle domluvy. Adresa osobního vyzvednutí je <a href="https://mapy.cz/s/fagesetoga" target="_blank">Všetičkova 13, Brno</a>.</li>';
	echo '</ol>';
} ?>
<h2>Informace o platbě</h2>

<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
