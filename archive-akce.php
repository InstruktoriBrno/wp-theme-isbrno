<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Instruktoři
 */

get_header(); ?>

<div class="row">
	<section id="primary" class="content-area col-xs-12">
		<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>

			<header>
				<h1 class="page-title">
				<?php 
					if ( function_exists( 'ot_get_option' ) ) {
						echo ot_get_option( 'archive_akce_nadpis', 'Kalendář instruktorských akcí' );
					}
				?>
				</h1>
			</header>

			<?php
				$dnesni_datum = Date("U");
							$args = array(
			    				'post_type'  => 'akce',
								'numberposts' => '-1',
							    'meta_key' => 'akce_from',
							    'orderby' => 'meta_value_num', 
							    'order' => 'ASC',
								'meta_query' => array(
							    	array(
							           'key' => 'akce_from',
								       'value' => $dnesni_datum,
									   'type' => 'numeric',
								       'compare' => '>=',
								    )
								)
							);	
							$lastposts = get_posts( $args );	

							echo '<div class="row">';

							foreach($lastposts as $post) : setup_postdata($post); 
								
								$akce_from_timestamp = get_post_meta($post->ID, 'akce_from', TRUE); 
								$akce_to_timestamp = get_post_meta($post->ID, 'akce_to', TRUE); 
								$akce_url = get_post_meta($post->ID, 'akce_url', TRUE); 
								
								echo '<div class="col-sm-4 col-lg-3">';
									echo '<div class="akce-box">';
										if ( has_post_thumbnail() ) {
											$custom = get_post_custom();
											$custom = get_post_meta($custom["_thumbnail_id"][0], '_wp_attached_file',true);
											$uploads = wp_upload_dir();
											
											echo '<div class="post-archive-thumbnail post-thumbnail thumbnail-type-'.get_post_type( $post->ID ).' hidden-xs">';
											//if(!empty($akce_url)){
											//	echo '<a href="'.$akce_url.'" title="'.get_the_title().'" target="new">';
											//}
											//else{
												echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
											//}
												echo '<img src="'.$uploads['baseurl'].'/'.$custom.'" alt="'. get_the_title().'"/>';			
											echo '</a></div>'; //.post-archive-thumbnail apod.
										}
										else { // post nemá thumbnail
											echo '<div class="post-archive-thumbnail post-thumbnail thumbnail-type-'.get_post_type( $post->ID ).' hidden-xs">';
											//if(!empty($akce_url)){
											//	echo '<a href="'.$akce_url.'" title="'.get_the_title().' target="new">';
											//}
											//else{
												echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
											//}
												echo '<img src="'.get_template_directory_uri().'/images/no-thumbnail.png" alt="'. get_the_title().'"/>';			
										echo '</a></div>'; //.post-archive-thumbnail apod.
										}
										echo '<div class="akce-padding">';
											//if(!empty($akce_url)){
											//	the_title('<h3><a href="'.$akce_url.'" target="new">', '</a></h3>');
											//}
											//else{
												the_title('<h3><a href="'.get_permalink().'">', '</a></h3>');
											//}

											if (!empty($akce_from_timestamp) AND empty($akce_to_timestamp)){
												echo date('d.m.Y', $akce_from_timestamp);
											}
											elseif (!empty($akce_from_timestamp) AND !empty($akce_to_timestamp)){
												echo date('d.m.', $akce_from_timestamp).' - '.date('d.m.Y', $akce_to_timestamp);
											}

											the_excerpt();

											echo '</div>';
											echo '<div class="akce-links">';
												echo '<div class="row">';
													echo '<div class="col-sm-6"><div class="alignleft">';
														if(!empty($akce_url)){
															echo '<a href="'.$akce_url.'" class="akce-more" target="new">Web akce&nbsp;&gt;</a>';
														}
													echo '</div></div>';
													echo '<div class="col-sm-6">';
														echo '<a href="'.get_permalink().'" class="akce-more">Víc info&nbsp;&gt;</a>';	
													echo '</div>';
												echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							endforeach; 

							echo '</div>';
							?>
		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
	<?php //get_sidebar(); ?>
</div>


<?php get_footer(); ?>
