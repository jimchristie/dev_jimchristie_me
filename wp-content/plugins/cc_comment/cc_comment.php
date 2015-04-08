<?php

/*
 * Plugin Name: CC Comment
 * Plugin URI: http://jimchristie.me/cc_comment
 * Description: Sends an email when a comment is made
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

function cc_comment(){
    global $_REQUEST; // This doesn't seem to do anything. All of the stuff below just comes out blank.
    
    $to = "jim.e.christie@gmail.com";
    $subject = "New comment posted on " . get_bloginfo('name');
    $message = "Message from: " . $_REQUEST['author'] . " at email " . $_REQUEST['email'] . ". \n\n" . "Message: \n" . $_REQUEST['comment'];
    
    // This uses php's built-in mail function
    
    wp_mail($to, $subject, $message);
    /*
     * using the pluggable version of the mail function
     *
     * wp_mail($to, $subject, $message);
     *
     * Same deal, just wp_mail can be rewritten any way that we want it to work whereas php's version is set in stone.
     * wp-mail() shows Wordpress as sender, mail() shows the database user as the sender
     *
     */
    
    
}

add_action('comment_post', 'cc_comment');
//remove_action('comment_post', 'cc_comment');

function cccomm_init(){
    register_setting('cccomm_options', 'cccomm_cc_email');
}

add_action('admit_init', 'cccomm_init');

// outputs page

/*
function cccomm_option_page(){
?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2> CC Comment Options</h2>
        <p>Welcome to CC Comments Plugin. Here you can edit the email(s) to CC your comments to.</p>
        <form action="options.php" method="post" id="cc-comments-email-options-form">
            <?php settings_fields('cccomm_options'); ?>
            <h3><label for="cccomm_cc_email">Email to send CC to:</label>
            <input type="text" id="cccomm_cc_email" name="cccomm_cc_email"
            value="<?php echo esc_attr(get_option('cccomm_cc_email') ); ?>"</h3>
            <p><input type="submit" name="submit" value ="Save Email" /></p>
        </form>
    </div>
<?php
}

*/

function cccomm_settings_section(){
    ?>
    <p>Settings for the CC Comments plugin:</p>
    <?php
}


function cccomm_setting_field(){
    ?>
    <input type="text" name="cccomm_cc_email" id="cccomm_cc_email"
        value="<?php echo get_option('cccomm_cc_email'); ?>" />
        <div id="emailInfo" aling="left"></div>
    <?php
}



function cccomm_plugin_menu(){
    // adds a link to the settings menu
    //add_menu_page('CC Comments Settings', 'CC Comments', 'manage_options', 'cc-comments-plugin', 'cccomm_option_page', '/wp-content/plugins/cc_comment/cc_icon.png', '26');
    
    
    // adds a section to the General Settins Page
    add_settings_section('cccomm', 'CC Comments', 'cccomm_settings_section', 'general');
    // adds an input field to the General Settings Page
    add_settings_field('cccomm_cc_email', 'CC Comments', 'cccomm_setting_field', 'general', 'cccomm');
}

add_action('admin_menu', 'cccomm_plugin_menu');

function cccomm_email_check(){
    $email = isset($_POST['cccomm_cc_email']) ? $_POST['cccomm_cc_email'] : null;
    $msg = 'invalid';
    if ( $email ){
        if ( is_email( $email ) ){
            $msg = 'valid';
        }
    }
    echo $msg;
    die();
}

add_action('wp_ajax_cccomm_email_check', 'cccomm_email_check');
add_action('admin_print_scripts-options-general.php', 'cccomm_email_check_script');
function cccomm_check_email_script(){
    wp_enqueue_script("cc-comments", path_join_(WP_PLUGIN_URL, basename( dirname( __FILE__ ) ) . "/cc_comment.js"). array('jquery'));
}