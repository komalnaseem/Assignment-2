<?php
/**
* Plugin Name: My Top Three Scored Courses Plugin 
* Plugin URI:  
* Description: Add my top three scored courses to my portfolio
* Author: Komal Naseem
* Author URI: 
* Version: 1.0 
*/
function my_plugin_styles(){
	wp_enqueue_style('plugin-style', plugins_url('/css/style.css', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'my_plugin_styles' );

function adding_user_contacts($user_contactmethods){
	$user_contactmethods['Course 1'] ='First highest scored course';
	return$user_contactmethods;
	}
	add_filter('user_contactmethods', 'adding_user_contacts');
	
/*function $user_contactmethods($top_courses){
	$$user_contactmethods['Course 1'] ='First highest scored course';
	/*$top_courses['Course 2'] ='Second highest scored course';
	$top_courses['Course 3'] ='Third highest scored course';
	return $top_courses;
	}
	add_filter('top_courses', 'adding_top_courses');*/
	
function my_top_courses($content){
	if(is_single() || is_feed()){
		/*$bio = '<div id="the-bio"><div id="author-img">';
		$bio .= get_avatar(get_the_author_meta('user_email'));
		$bio .= '</div><div id="author-text">';
		$bio .= get_the_author_meta('display_name');
		$bio .= '</h3><p>';
		$bio .= get_the_author_meta('user_description');
		$bio .= '</p><p class="social-links"><a href="'; */
		$course .= get_the_author_meta ('Course 1');
				$course .= '</h3><p>';
		/*$course .= '</div><div id="Course 1">';
		$bio .= '">Facebook</a> | <a href="';
		$bio .= get_the_author_meta ('twitter');
		$bio .= '">Twitter</a><p></div></div>'; */
		$content .= $course;
	}
	return $content;
}

add_filter ('the_content', 'my_top_courses');

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'kn_courses',
    array(
      'labels' => array(
        'name' => __( 'Courses' ),
        'singular_name' => __( 'Course' ),
		'add_new_item'  => 'Add New Course'
      ),
      'public' => true,
      'has_archive' => true,
	  'menu_icon' => 'dashicons-businessman',
	  'supports' => array (
	  'title',
	  'editor',
	  'author',
	  'thumbnail',
	  'custom-fields'
	  )
    )
	
	
  );
}

function adding_user_courses($kn_courses){
	$kn_courses['Course 1'] ='First highest scored course';
	return $kn_courses;
	}
	add_filter('kn_courses', 'adding_user_courses');