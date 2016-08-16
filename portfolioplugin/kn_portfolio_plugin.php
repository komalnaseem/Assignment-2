<?php
/**
* Plugin Name: My Top Scored Courses Plugin 
* Plugin URI:  
* Description: Add my top scored courses to my portfolio
* Author: Komal Naseem
* Author URI: 
* Version: 1.0 
*/
function my_plugin_styles(){
	wp_enqueue_style('plugin-style', plugins_url('/css/style.css', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'my_plugin_styles' );

add_action( 'init', 'create_post_type' );

function create_post_type() {
  register_post_type( 'kn_courses', /* Custom Post Type */
    array(
      'labels' => array(
        'name' => __( 'Courses' ),
        'singular_name' => __( 'Course' ),
		'add_new_item'  => 'Add New Course'
      ),
      'Description' => 'This custom post type adds courses taken to the site',
	  'public' => true,
      'has_archive' => true,
	  'menu_icon' => 'dashicons-welcome-learn-more',     /* https://developer.wordpress.org/resource/dashicons/#welcome-learn-more */
	  'supports' => array (
	  'title',
	  'editor',
	  'author',
	  'thumbnail'
	  ) 
    )	
  );
};

/**
 * Add custom Widget (kn_widget)
 */
require plugin_dir_path( __FILE__ ) . '/inc/kn_widget.php'; 

