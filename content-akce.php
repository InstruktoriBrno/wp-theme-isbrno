<?php
/**
 * Výpis jednoho excerptu akce s kalendářem (akce)
 *
 * @package Persona Studio
 * @subpackage Instuktoři
 */

				
	$akce_from_timestamp = get_post_meta( $post->ID, 'akce_from', true ); 
	$akce_to_timestamp   = get_post_meta( $post->ID, 'akce_to', true ); 
	$akce_url            = get_post_meta( $post->ID, 'akce_url', true ); 
	$akce_from_time      = get_post_meta( $post->ID, 'akce_from_time', true ); 
	$akce_place          = get_post_meta( $post->ID, 'akce_place', true ); 
	$akce_map            = get_post_meta( $post->ID, 'akce_map', true ); 
									
	echo '<div class="row">';
		echo '<div class="col-sm-9">';
			
			the_title( '<h1>', '</h1>' );

			the_content();
			
if ( ! empty( $akce_url ) ) {
	echo '<a href="' . $akce_url . '" class="akce-more">Více informací naleznete na webu akce &gt;</a>';
}
			
		echo '</div>'; // .col-sm-9
		echo '<div class="col-sm-3">';
?>

			<div class="akce-meta-box">
				<?php the_title( '<h3>', '</h3>' ); ?>
				<?php
					$terms = get_the_terms( $post->ID, 'typ_akce' );
					$count = count( $terms );
				if ( $count > 0 && is_array( $terms ) ) {
					$i = 1;
					foreach ( $terms as $term ) {
						if ( $i > 1 ) {
							$category_list .= ', ';
						}
						$category_list .= $term->name;
								
						$i++;
					}
				}
					echo '<strong>Typ akce: </strong>' . $category_list . '<br/><br/>';
					$category_list = '';
				?>

				<?php echo '<strong>Začátek:</strong> ' . date( 'd.m.Y', $akce_from_timestamp + 0 ); ?>
				<?php 
				if ( ! empty( $akce_from_time ) ) {
					echo 'od ' . $akce_from_time;
				}
				?>
				<br/>
				<?php 
				if ( ! empty( $akce_to_timestamp ) ) {
					echo '<strong>Konec:</strong> ' . date( 'd.m.Y', $akce_to_timestamp ) . '<br/>';
				}
				?>
				<br/>
				<?php 
				if ( ! empty( $akce_place ) or ! empty( $akce_map ) ) {
					echo '<strong>Místo konání: </strong><br/>';
					if ( ! empty( $akce_place ) ) {
						echo $akce_place . '<br/>';
					}

					if ( ! empty( $akce_map ) ) {
						echo '<iframe
							  width="243"
							  height="126"
							  frameborder="0" style="border:0"
							  src="https://www.google.com/maps/embed/v1/place?key=' . get_theme_mod('google_maps_api_key') . '&q=' . $akce_map . '&zoom=15" allowfullscreen>
							</iframe>';
					}
				}
				?>
			</div>

			<?php
			echo '</div>'; // .col-sm-3
			echo '</div>'; // .row
			?>
