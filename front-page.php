 <?php
/**
 * Titulní strana prezentace 
 *
 * @package Nordic Sports
 * 
 */

$dnesni_datum = Date("U");
$dnesni_datum=$dnesni_datum-86400;

get_header(); ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main front-page" role="main">
				<div class="row">
					<section class="col-xs-12 col-lg-3">
						<?php dynamic_sidebar( 'front-page-is' ); ?>
					</section>
					<section class="col-xs-12 col-lg-9">
						<?php 
							if ( function_exists( 'ot_get_option' ) ) {
								echo '<h2>'.ot_get_option( 'udalosti_nadpis', 'Nejbližší události' ).'</h2>';
							}
						?>
						<?php
							$args = array(
			    				'post_type'  => 'akce',
								'numberposts' => '3',
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
								
								echo '<div class="col-md-4 col-sm-6">';
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
														echo '<a href="'.get_permalink().'" class="akce-more">Detail&nbsp;&gt;</a>';	
													echo '</div>';
												echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							endforeach; 

							echo '</div>';
							?>
				        
					</section>
				</div><!-- .row -->
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .container -->
</div><!-- .red-area -->

<div class="container">
	<div class="row">
		<section class="col-xs-12 col-lg-9 col-lg-push-3">
					<?php 
						if ( function_exists( 'ot_get_option' ) ) {
							echo '<h2>'.ot_get_option( 'dalsi_akce', '<strong>Další chystané akce</strong><span class="hidden-xxs"> Instruktorů Brno</span>' ).'</h2>';
						}
					?>
					<?php
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

						echo '<table class="table table-hover">';
						echo '<tr><th>Název</th><th>Termín</th><th class="hidden-xs">Typ</th><th>Detail</th></tr>';

						foreach($lastposts as $post) : setup_postdata($post); 
							echo '<tr><td><a href="'.get_permalink().'">'.get_the_title().'</a></td>';
							
							$akce_from_timestamp = get_post_meta($post->ID, 'akce_from', TRUE); 
							$akce_to_timestamp = get_post_meta($post->ID, 'akce_to', TRUE); 
							$akce_url = get_post_meta($post->ID, 'akce_url', TRUE); 

							echo '<td>';

							if (!empty($akce_from_timestamp) AND empty($akce_to_timestamp)){
								echo date('d.m.Y', $akce_from_timestamp);
							}
							elseif (!empty($akce_from_timestamp) AND !empty($akce_to_timestamp)){
								echo date('d.m.', $akce_from_timestamp).' - '.date('d.m.Y', $akce_to_timestamp);
							}

							echo '</td>';
							echo '<td class="hidden-xs">';

							$terms = get_the_terms( $post->ID, 'typ_akce' );
							$count = count($terms);
							$category_list = '';
							if ( $count > 0 ){
								$i=1;
							 	foreach ( $terms as $term ) {
									if ($i > 1) {
										$category_list.=', ';
									}
									$category_list.=$term->name;
									$i++;
								}
							}
							echo $category_list;
							$category_list = '';

							echo '</td>';
							echo '<td><div class="alignright">';
							
							if (!empty($akce_url)){
								echo '<a class="detail-button" target="new" href="'.$akce_url.'">WEB &gt;</a> ';
							}
							
								echo '<a class="detail-button" href="'.get_permalink().'">DETAIL &gt;</a>';	
							

							
							echo '</div></td>';
							echo '</tr>';

						endforeach; 

						echo '</table>';
						?>
				        
		</section>
		<section class="hidden-xs col-md-12 col-lg-3 col-lg-pull-9">
					<?php 
						if ( function_exists( 'ot_get_option' ) ) {
							echo '<h2>'.ot_get_option( 'tradicni_akce', 'Tradiční akce' ).'</h2>';
						}
					?>
					<?php
						$args = array(
		    				'post_type'  => 'tradice',
							'numberposts' => '6',
						    'orderby' => 'rand'
						);	
						$lastposts = get_posts( $args );	

						$i=1;
						foreach($lastposts as $post) : setup_postdata($post); 
							
							$tradice_url = get_post_meta($post->ID, 'tradice_url', TRUE); 
							
							if ( has_post_thumbnail() ) {

								$custom = get_post_custom();
								$custom = get_post_meta($custom["_thumbnail_id"][0], '_wp_attached_file',true);
								$uploads = wp_upload_dir();
								
								if ($i%2==0){
									$class = 'no-margin';
								}

								echo '<div class="post-archive-thumbnail post-thumbnail thumbnail-type-'.get_post_type( $post->ID ).' hidden-xs"><a href="'.$tradice_url.'" title="'.get_the_title().'">';
									echo '<img src="'.$uploads['baseurl'].'/'.$custom.'" alt="'. get_the_title().'"/>';			
								echo '</a></div>'; //.post-archive-thumbnail apod.
								$i++;
								$class='';
							}
						endforeach; 
						?>
				        
		</section>
	</div>
<?php get_footer(); ?>
