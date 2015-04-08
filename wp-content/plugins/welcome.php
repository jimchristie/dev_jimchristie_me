<?php

/*
 * Plugin Name: Welcome Plugin
 * Plugin URI: http://jimchristie.me/welcome
 * Description: This will welcome new users
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


// override the wp_new_user_notification pluggable function

if ( !function_exists('wp_new_user_notification') ){
    
    function wp_new_user_notification($user_id, $plaintext_pass = '') {
    	$user = get_userdata( $user_id );
    
    	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
    	// we want to reverse this for the plain text arena of emails.
    	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    
    	$message  = sprintf(__('New user registration on your site %s:'), $blogname) . "\r\n\r\n";
    	$message .= sprintf(__('Username: %s'), $user->user_login) . "\r\n\r\n";
    	$message .= sprintf(__('E-mail: %s'), $user->user_email) . "\r\n";
    
    	@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message);
    
    	if ( empty($plaintext_pass) )
    		return;
    
        $message = __('Welcome to dev.jimchristie.me') . "\r\n\r\n";
        $message .= __('Here is your infromation for future reference: ') . "\r\n\r\n";
    	$message .= sprintf(__('Username: %s'), $user->user_login) . "\r\n";
    	$message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n";
    	$message .= wp_login_url() . "\r\n";
    	$message .= __('Feel Free to come back and check on stuff often.');
    
    	wp_mail($user->user_email, sprintf(__('[%s] Your username and password'), $blogname), $message);
    
    }

}
?>