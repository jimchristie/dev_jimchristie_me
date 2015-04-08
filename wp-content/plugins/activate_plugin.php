<?php

/*
 * Plugin Name: Activate Plugin
 * Plugin URI: http://jimchristie.me/first_plugin
 * Description: Shows how to register an activation hook
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

function my_plugin_activate(){
    error_log("my pluing activated");    
}
register_activation_hook(__FILE__, "my_plugin_activate");


function my_plugin_deactivated(){
    error_log("my plugin deactivated");
}
register_deactivation_hook(__FILE__, "my_plugin_deactivate");

?>