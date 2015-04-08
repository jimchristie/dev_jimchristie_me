<?php

/*
 * Plugin Name: Simple Dashboard Widget
 * Plugin URI: http://jimchristie.me/simple-db-widget
 * Description: This plugin dds a widget to the admin dashboard
 * Author: Jim Christie
 * Version: 1.0
 * Author URI: http://jimchristie.me
 */
 
 
function simple_dashboard_widget(){
    ?>
    <h2>Simple Dashboard Widget</h2>
    <p>Welcome to Wordpress Development. Now you can build your own Dashboard widgets.</p>
    <p><a href="http://jimchristie.me">Visit Jim Christie's Home page</a>
    <?php
}

function sdbw_register_widget(){
    wp_add_dashboard_widget('simple-dashboard-widget', 'Simple Dashboard Widget', 'simple_dashboard_widget');
    
}

add_action('wp_dashboard_setup', 'sdbw_register_widget');