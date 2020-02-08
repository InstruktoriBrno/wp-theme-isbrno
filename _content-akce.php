<?php
/**
 * Výpis jednoho excerptu akce s kalendářem (akce)
 *
 *
 * @package Persona Studio
 * @subpackage Instuktoři
 *
*/

				
	$akce_from_timestamp = get_post_meta($post->ID, 'akce_from', TRUE); 
	$akce_to_timestamp = get_post_meta($post->ID, 'akce_to', TRUE); 
	$akce_url = get_post_meta($post->ID, 'akce_url', TRUE); 
								
	echo '<div class="row">';
		if ( has_post_thumbnail() ) {
			$custom = get_post_custom();
			$custom = get_post_meta($custom["_thumbnail_id"][0], '_wp_attached_file',true);
			$uploads = wp_upload_dir();
												
			echo '<div class="col-xs-4">';
				echo '<div class="post-archive-thumbnail post-thumbnail thumbnail-type-'.get_post_type( $post->ID ).' hidden-xs">';
				if(!empty($akce_url)){
					echo '<a href="'.$akce_url.'" title="'.get_the_title().'">';
				}
				else{
					echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
				}
					echo '<img src="'.$uploads['baseurl'].'/'.$custom.'" alt="'. get_the_title().'"/>';			
				echo '</a></div>'; //.post-archive-thumbnail apod.
			echo '</div>'; //.col-xs-4
		}
		else { // post nemá thumbnail
			echo '<div class="col-xs-4">';		
				echo '<div class="post-archive-thumbnail post-thumbnail thumbnail-type-'.get_post_type( $post->ID ).' hidden-xs">';
				if(!empty($akce_url)){
					echo '<a href="'.$akce_url.'" title="'.get_the_title().'">';
				}
				else{
					echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
				}
				
					echo '<img src="'.get_template_directory_uri().'/images/no-thumbnail.png" alt="'. get_the_title().'"/>';			
				echo '</a></div>'; //.post-archive-thumbnail apod.
			echo '</div>'; //.col-xs-4
		}
		echo '<div class="col-xs-8">';
			
				if(!empty($akce_url)){
					the_title('<h3><a href="'.$akce_url.'">', '</a></h3>');
				}
				else{
					the_title('<h3><a href="'.get_permalink().'">', '</a></h3>');
				}
			

			if (!empty($akce_from_timestamp) AND empty($akce_to_timestamp)){
				echo date('d.m.Y', $akce_from_timestamp);
			}
			elseif (!empty($akce_from_timestamp) AND !empty($akce_to_timestamp)){
				echo date('d.m.', $akce_from_timestamp).' - '.date('d.m.Y', $akce_to_timestamp);
			}

			the_excerpt();
			//echo '<H1>ahoj</H1>';
			
			if(!empty($akce_url)){
				echo '<a href="'.$akce_url.'" class="akce-more">Web akce &gt;</a>';
			}
			else{
				echo '<a href="'.get_permalink().'" class="akce-more">Chci vědět víc &gt;</a>';	
			}
			
		echo '</div>'; // .col-xs-8
	echo '</div>'; //.row
