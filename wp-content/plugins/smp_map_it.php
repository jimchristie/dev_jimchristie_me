<?php

/*
 * Plugin Name: Map It Shortcode Plugin
 * Plugin URI: http://jimchristie.me/copyright-plugin
 * Description: Echos a copyright message
 * Author: Jim Christie
 * Version: 1.0
 * Author URI: http://jimchristie.me
 
   Copyright 2014  Jim Christie  (email : jim.e.christie@gmail.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

function smp_map_it($atts, $content=null){
    shortcode_atts( array('title' => 'Your Map:', 'address'=>''), $atts);
    $base_map_url = 'https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=256x256&center=';
    return '<h2>' . $atts['title'] . do_shortcode($content) . '</h2>
    <img width = "256" height="256" src="' . $base_map_url . urlencode($atts['address']) . '" />';
    
}

add_shortcode('map-it', 'smp_map_it');