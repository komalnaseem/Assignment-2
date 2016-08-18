<?php
/**
* Plugin Name: My Courses Plugin 
* Plugin URI: http://phoenix.sheridanc.on.ca/~ccit3680/ 
* Description: Add my courses to my portfolio
* Author: Komal Naseem
* Author URI: http://phoenix.sheridanc.on.ca/~ccit3680/ 
* Version: 1.0 
*/
function my_plugin_styles(){	/* Register the theme's style.css to be used.  */
	wp_enqueue_style('plugin-style', plugins_url('/css/style.css', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'my_plugin_styles' );

add_action( 'init', 'create_post_type' );

function create_post_type() {			/* https://codex.wordpress.org/Post_Types - Explains the functionality to create custom post types */
  register_post_type( 'kn_courses', 	/* Add "kn_courses" Custom Post Type to wordpress. https://codex.wordpress.org/Function_Reference/register_post_type */
    array(
      'labels' => array(
        'name' => __( 'Courses' ),			  /* This name is displayed as plural name in wordpress admin menu */
        'singular_name' => __( 'Course' ),	  /* This name is displayed as singular name in wordpress admin menu */	
		'add_new_item'  => 'Add New Course',  /* !!!Extra Functionality!!! - Default is Add New Post, I gave it a title 'Add New Course' which is relevant to my plugin */
		'search_items' => 'Search Course'     /* !!!Extra Functionality!!! - Default is Search Post, I gave it a title 'Search Course' which is relevant to my plugin */
      ),
      'Description' => 'This custom post type adds courses to the site', /* !!!Extra Functionality!!! - Default is Null, I gave it a description which is relevant to my plugin */
	  'public' => true,						  /* Controls how the type is visible to authors, default is false, I have set it to true so it is visible. */
      'has_archive' => true,				  /* Enables post type archives, default is false, I have set it to true. */
	  'menu_icon' => 'dashicons-welcome-learn-more',     /* !!!Extra Functionality!!! - Changed the default custom post type icon to a graduation hat icon making it relevant to the courses. https://developer.wordpress.org/resource/dashicons/#welcome-learn-more - This link provides the code for menu_icon. */
	  'supports' => array (
	  'title',								  /* This enables the title of the course */
	  'editor',								  /* This enables the content area of the course */
	  'author',								  /* !!!Extra Functionality!!! - This enables author of the course post */
	  'thumbnail'							  /* This enables the featured image of the course */
	     ) 
       )	
  );
};

/**
 * Add custom Widget (kn_widget)
 * Reference - https://developer.wordpress.org/reference/functions/plugin_dir_path/
 * This sets the path of widget file by using an relative path. Function plugin_dir_path gets the path to this file and then I concatenate '/inc/kn_widget.php' to give the full
 * path. This will ensure that when this plugin is installed by anyone on their site and it will work because of relative path used 
 */
require plugin_dir_path( __FILE__ ) . '/inc/kn_widget.php'; 

/* 
* Shortcode to display Course taken at which school and it have the link to the school website 
*/	
function schoollink($atts){
		extract(shortcode_atts(
			array(
				'linktitle' => 'Course Taken At', 		/* This is the default link title */
				'schoollink' => 'http://google.com'		/* This is the link to the school website, by default it will go to google.com */
			),$atts
		));
		return '<p class="the-link"><a href="' . $schoollink . '">' . $linktitle . '</a></p>'; /* This will display the link title and link to the school website */
}
add_shortcode('schoollink','schoollink');				/* This adds a hook for a shortcode tag schoollink */
