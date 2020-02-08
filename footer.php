<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package IS Brno
 */
?>


	</div><!-- #content -->

	<footer id="colophon" class="site-footer hidden-print" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-md-6 footer-is">
					<?php dynamic_sidebar( 'footer-is' ); ?>
					<form action="//instruktori.us8.list-manage.com/subscribe/post?u=a0d30eb97b6e9afe755e0ffbb&amp;id=1fd8b6c5af" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<input type="email" value="" name="EMAIL" class="mailchimp-email" id="mce-EMAIL" placeholder="Váš email"> &nbsp; <input type="submit" value="Přihlásit k odběru!" name="subscribe" id="mc-embedded-subscribe" class="red-button">
					</form>
				</div>
				<div class="col-md-3">
				<h3>
					<?php 
					if ( function_exists( 'ot_get_option' ) ) {
						echo ot_get_option( 'footer_kalendar', 'Akce v kalendáři' );
					}
					?>
				</h3>
					<ul class="red">
					<?php
						$dnesni_datum = Date( 'U' );
						$args         = array(
							'post_type'   => 'akce',
							'numberposts' => '8',
							'meta_key'    => 'akce_from',
							'orderby'     => 'meta_value_num', 
							'order'       => 'ASC',
							'meta_query'  => array(
								array(
									'key'     => 'akce_from',
									'value'   => $dnesni_datum,
									'type'    => 'numeric',
									'compare' => '>=',
								),
							),
						);  
						$lastposts    = get_posts( $args );    
						foreach ( $lastposts as $post ) :
							setup_postdata( $post ); 
								
							the_title( '<li><a href="' . get_permalink() . '" title="' . get_the_excerpt() . '">', '</a></li>' );

						endforeach; 
						?>
					</ul>
				</div>
				<div class="col-md-3">
				<?php dynamic_sidebar( 'footer-social' ); ?>
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
	<footer id="dark" class="dark-footer hidden-print hidden-xs" role="contentinfo">
		© <?php echo date( 'Y' ); ?>, <a href="https://www.instruktori.cz">Instruktoři Brno, z.s.</a>, <a href="mailto:spenat@instruktori.cz">spenat@instruktori.cz</a>. Všechna práva vyhrazena. <a href="/zasady-zpracovani-osobnich-udaju">Zásady zpracování osobních údajů</a><br/>
		Design a tvorba webových stránek Persona Studio [ <?php wp_loginout(); ?> ]
	</footer><!-- #dark -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>



<?php dynamic_sidebar( 'footer-aktivity' ); ?>
