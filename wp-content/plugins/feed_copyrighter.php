<?php

/*
 * Plugin Name: Content Watermark Plugin
 * Plugin URI: http://jimchristie.me/content_watermark
 * Description: This will add a "watermark" to content
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


function cwmp_add_content_watermark( $content ){
    if ( is_feed() ){
        return $content . "<p>Created by Jim Christie, copyright " . date('Y') . " all rights reserved.</p>";
        
    }   
    
    return $content;
}

//add_filter('the_content', 'cwmp_add_content_watermark');
//remove_filter('the_content', 'cwmp_add_content_watermark');
?>