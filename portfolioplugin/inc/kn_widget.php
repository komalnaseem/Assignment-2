<?php
	class CourseList extends WP_Widget{ /* Create the Widget */
		
		public function __construct(){ /* Initialize the widget */
			$widget_ops = array(
				'classname' => 'widget_archive',
				'description' => 'A Course list of your site'
			);
			parent::__construct('course_list','Course List', $widget_ops);
		}
		
		public function widget($args, $instance){ /* Declare what Widget displays */ 
			$title = apply_filters('widget_title', empty($instance['title']) ? 'Course List' : $instance['title'], $instance, $this->id_base); /* Displays the widget title */
			
			echo $args['before_widget'];
			
			if($title){
				echo $args['before_title'] . $title . $args['after_title'];
			}
			
			/* This reads the posts of custom post type kn_courses, it will sort ascending based on post titles . Reference - https://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters */
			$query = new WP_Query( array( 'post_type' => 'kn_courses', 
										  'orderby' => 'title',
										  'order'   => 'ASC'
										) ); ?>
			<ul>
				<?php  /* While loop to dispaly post title displaying it as a link */
				while ($query -> have_posts()) : $query -> the_post();  ?>
					<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
					<?php get_the_post_thumbnail(the_post()); ?>
					<?php		
				endwhile;
				wp_reset_postdata(); /* This function restores the global $post variable of the main query loop after a widget query loop using new WP_Query. It restores the $post variable to the current post in the main query. */
				?>
			</ul>
			<?php  
			echo $args['after_widget'];
					
		}
		
		/* Backend Form - This function displays the available options in the Widget Admin form */		
		public function form($instance){
			$instance = wp_parse_args((array) $instance, array('title'=>'','count'=> 0, 'dropdown'=> ''));
			$title = strip_tags($instance['title']);
			$count = $instance['count'] ? 'checked="checked"' : '';
			$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

		<?php }
	
		public function update($new_instance,$old_instance){			
			$instance = $old_instance;
			$new_instance = wp_parse_args((array) $new_instance, array('title' => ''));
			$instance['title'] = strip_tags($new_instance['title']);
			
			return $instance;	
		}			
}
	
add_action('widgets_init',function(){ register_widget('CourseList'); }); /* Tell the wordpress that the widget has been created and display it in the list of available widgets */