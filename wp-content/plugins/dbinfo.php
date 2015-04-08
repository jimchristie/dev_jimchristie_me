<?php
/* 
Plugin Name: DB Info Plugin
Plugin URI: http://jimchristie.me/dbinfo
Description: This plugin tells the admin stuff about the database.
Author: Drew Falkman
Version: 1.0
Author URI: http://jimchristie.me
*/

function databaseinfo_dashboard_widget(){
    global $wpdb;
    ?>
    <h2>DB Info Dashboard Widget</h2>
    <p><b>Last Query: </b><?php echo $wpdb->last_query; ?></p>
    <p><b>Last Error: </b><?php echo $wpdb->last_error; ?></p>
    <!--<pre><?php // echo var_dump($wpdb); ?></pre> -->
    <?php
}

function databaseinfo_register_widget(){
    wp_add_dashboard_widget('databaseinfo-dashboard-widget', 'Counter Dashboard Widget', 'databaseinfo_dashboard_widget' );
}

add_action('wp_dashboard_setup', 'databaseinfo_register_widget');