<?php
/*
Plugin Name: Click to Copy Grab Box Widget
Plugin URI: http://clickwp.com/
Description: This plugin lets you display a grab box for your blog badge in a sidebar. Your readers can click a button to copy the code to their clipboard and paste it into their blog template.
Version: 0.1.1
Author: ClickWP
Author URI: http://clickwp.com
License:

  Copyright 2012 David Wang (david@dw.my)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  
*/

class click_grab_box extends WP_Widget {
 
	// constructor
	function __construct() {
	
		$widget_ops = array('classname' => 'click_grab_box', 'description' => __('Display a grab box with a click to copy button', 'click_grab_box'));
	//	$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false, $name = __('Grab Box', 'click_grab_box'), $widget_ops /* , $control_ops */ );
		
	}
 
	// widget form creation
	function form($instance) {	
		// Check values
		if( $instance) {
		     $title = esc_attr($instance['title']);
		     $button_img = esc_attr($instance['button_img']);
		     $button_link = esc_attr($instance['button_link']);
		     $copy_text = esc_attr($instance['copy_text']);
		     $instructions = esc_textarea($instance['instructions']);
		     $target_blank = esc_attr($instance['target_blank']);
		     $show_code = esc_attr($instance['show_code']);
		     /*
		     $mode = esc_attr($instance['advanced_mode']);
		     $code = esc_textarea($instance['code']);
		     */
		} else {
		     $title = '';
		     $button_img = 'http://';
		     $button_link = 'http://';
		     $copy_text = 'Copy code';
		     $instructions = '';
		     /*
		     $show_code = '';
		     $code = '';
		     */
		}
		?>
		 
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Grab Box Title', 'click_grab_box'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_img'); ?>"><?php _e('URL to image', 'click_grab_box'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('button_img'); ?>" name="<?php echo $this->get_field_name('button_img'); ?>" type="text" value="<?php echo $button_img; ?>" /><br/>
			<small>Must include <code>http://</code></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Image Link', 'click_grab_box'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo $button_link; ?>" /><br/>
			<small>Must include <code>http://</code></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('copy_text'); ?>"><?php _e('Copy button text', 'click_grab_box'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('copy_text'); ?>" name="<?php echo $this->get_field_name('copy_text'); ?>" type="text" value="<?php echo $copy_text; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('instructions'); ?>"><?php _e('Optional description', 'click_grab_box'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('instructions'); ?>" name="<?php echo $this->get_field_name('instructions'); ?>"><?php echo $instructions; ?></textarea><br/>
			<small>e.g. Paste the code above into your sidebar</small>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('target_blank'); ?>" name="<?php echo $this->get_field_name('target_blank'); ?>" type="checkbox" value="1" <?php checked( '1', $target_blank ); ?> />
			<label for="<?php echo $this->get_field_id('target_blank'); ?>"><?php _e('Open button link in new window', 'click_grab_box'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('show_code'); ?>" name="<?php echo $this->get_field_name('show_code'); ?>" type="checkbox" value="1" <?php checked( '1', $show_code ); ?> />
			<label for="<?php echo $this->get_field_id('show_code'); ?>"><?php _e('Show grab box only (hide image)', 'click_grab_box'); ?></label>
		</p>

		<?php
	}
 
	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['button_img'] = strip_tags($new_instance['button_img']);
		$instance['button_link'] = strip_tags($new_instance['button_link']);
		$instance['copy_text'] = strip_tags($new_instance['copy_text']);
		$instance['instructions'] = strip_tags($new_instance['instructions']);
		$instance['target_blank'] = strip_tags($new_instance['target_blank']);
		$instance['show_code'] = strip_tags($new_instance['show_code']);
		return $instance;
	}
 
	// widget display
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$button_img = $instance['button_img'];
		$button_link = $instance['button_link'];
		$copy_text = $instance['copy_text'];
		$instructions = $instance['instructions'];
		$target_blank = $instance['target_blank'];
		
		if ( $target_blank == '1' ) {
			$target_blank_output = ' target="_blank" ';
		}
		$button_output = '<a href="'. $button_link .'"'. $target_blank_output .'><img src="'. $button_img .'" alt="" /></a>';
		
		// Check if button link and image are set
		if( ($button_img == 'http://') && ($button_link == 'http://') )
			return;

		echo $before_widget;
		// Display the widget
		echo '<div class="widget-click-grab-box" style="position:relative;">';
		
		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		
		// Display button & grab box
		?>
			<?php 
			if ( $show_code !== '1' ) 
				echo '<div class="click-grab-box-button">'. $button_output .'</div>'; 
			?>
			<textarea class="click-grab-box-code"><?php echo esc_html($button_output); ?></textarea>
			<input class="click-grab-box-copy" type="submit" value="<?php echo $copy_text; ?>" />
			<?php if ( $instructions ) 
				echo '<div class="click-grab-box-description">'. $instructions .'</div>';
			?>
		<?php
		echo '</div>';
		
		echo $after_widget;
	}
	
	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */	
	public function register_admin_scripts() {

	//	wp_enqueue_script( 'cgb-showhide', plugins_url( 'click-grab-box/js/admin.js' ) );

	}
	
}
 
// register widget
add_action('widgets_init', create_function('', 'return register_widget("click_grab_box");'));

// Enqueue scripts and styles
function click_grab_box_scripts_styles() {
	
	wp_enqueue_script(
		'zclip',
		plugins_url( 'lib/jquery.zclip.min.js' , __FILE__ ),
		array('jquery'),
		'1.1.1'
	);
	wp_enqueue_style( 
		'click-grab-box', 
		plugins_url( 'lib/style.css', __FILE__),
		array(),
		'0.1.2'
	);
}
add_action('wp_enqueue_scripts', 'click_grab_box_scripts_styles');

// Output init to the footer
function click_grab_box_init() {
	?>
	<script type="text/javascript">
		jQuery(document).ready( function($) {

			// initialize zclip
			$('.click-grab-box-copy').zclip({
				path:'<?php echo plugins_url( 'lib/ZeroClipboard10.swf' , __FILE__ ); ?>',
				copy:function(){
					return $(this).prev('.click-grab-box-code').val();
				}
			});
			
			// auto select textarea content
			$('.click-grab-box-code').click( function() {
				$(this).select();
			});
		}); 
	</script>
	<?php
}
add_action( 'wp_footer', 'click_grab_box_init' );

?>