<?php
/*
Plugin Name: Simple Widget
Plugin URI: http://jimchristie.me
Description: A simple OOP widget
Author: Jim Christie
Version: 1.0
Author URI: http://jimchristie.me
*/

class SimpleWidget extends WP_Widget {
    function SimpleWidget() {
        $widget_options = array(
            'classname' => 'simple-widget',
            'description' => 'Just a simple widget');
        
        parent::WP_Widget('simple-widget', 'Simple Widget', $widget_options);
    }   
    
    function widget($args, $instance){
        extract( $args, EXTR_SKIP );
        $title = ( $instance['title'] ) ? $instance['title'] : 'A Simple Widget';
        $body = ( $instance['body'] ) ? $instance['body'] : 'A simple message'; 
        ?>
        <?php echo $before_widget; ?>
        <?php echo $before_title . $title . $after_title; ?>
        <p><?php echo $body; ?></p>
        <?php 
    }
    
    function form( $instance ){
        ?>
        
        <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
        <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat"
            name="<?php echo $this->get_field_name('title'); ?>"
            value="<?php echo esc_attr($instance['title']); ?>" />
        
        <label for="<?php echo $this->get_field_id('body'); ?>">Body: </label>
        <textarea id="<?php echo $this->get_field_id('body'); ?>" class="widefat"
            name="<?php echo $this->get_field_name('body'); ?>"><?php echo esc_attr($instance['body']); ?></textarea>
        <?php
    }
}

function simple_widget_init(){
    register_widget("SimpleWidget");
}

add_action('widgets_init', 'simple_widget_init');