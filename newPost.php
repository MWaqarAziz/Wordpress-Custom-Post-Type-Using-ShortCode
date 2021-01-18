<?php
/*
Plugin Name:  Shortcode
Description: Learning Wordpress
Version: 1.0
*/

// Register Custom Taxonomy
function movies_type() {

	$labels = array(
		'name'                       => _x( 'Movies Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Movies Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Movies Type', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'movies_type', array( 'movies' ), $args );

}
add_action( 'init', 'movies_type', 0 );

function create_custom_post_type(){
    $labels = array(
                     'name' => 'Movies',
                     'singular_name' => 'Movie',
                     'add_new'    => 'Add Movie',
                     'add_new_item' => 'Enter Movie Details',
                     'all_items' => 'All Movies',
                     'featured_image' => 'Add Poster Image',
                     'set_featured_image' => 'Set Poster Image',
                     'remove_featured_image' => 'Remove Poster Image',
                     'search_items' => 'Search Movies',
                     'view_item'=> 'View Post',
                     'attributes'=> 'Post Attributes'

 
                   );
    $args = array(    
                    'public' => true,
                    'label'       => 'Movies',
                    'labels'      => $labels,
                    'description' => 'Movies is a collection of movies and their info',
                    'supports'   => array( 'title', 'editor', 'thumbnail','excerpt'),
                    'capability_type' => 'post',
                    
                
                );
    register_post_type('movies', $args);
}
 
add_action( 'init', 'create_custom_post_type' );
 function create_shortcode_movies_post_type($args){
    $args = array(
                    'post_type'      => 'movies',
                    'posts_per_page' => $args['limit'],
                    'publish_status' => 'published',
                     'order' => 'ASC',
                 );
    $query = new WP_Query($args);
   if($query->have_posts()) :
        while($query->have_posts()) :
            $query->the_post() ;     
          $result .= get_the_post_thumbnail().'<br/>';
        $result .=  get_the_title().'<br/>' ;
        $result .=  get_the_content().'<br/>'; 
       
      endwhile;
    wp_reset_postdata();
    endif;    
   return $result;            
}
 
add_shortcode( 'movies-list', 'create_shortcode_movies_post_type' ); 
