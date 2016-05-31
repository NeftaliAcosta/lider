<?php
   /*
   Plugin Name: Twitter Tweets Box
   Plugin URI: http://www.vinojcardoza.com/blog/cardoza-twitter-box/
   Description: Twitter Tweets Box enables you to display the tweets in your website.
   Version: 1.7
   Author: Vinoj Cardoza
   Author URI: http://www.vinojcardoza.com/
   License: GPL2
   */
   
add_action("plugins_loaded", "cardoza_twitter_box_init");
add_action("admin_menu", "cardoza_twitter_box_options");
add_shortcode("cardoza_twitter_box", "cardoza_twitter_box_sc");

require('includes/cardoza_twitter_profile_forms.php');
require('includes/cardoza_twitter_profile_functions.php');

//The following function will retrieve all the avaialable 
//options from the wordpress database

function cardoza_twitter_box_options(){
    add_menu_page(
        __('Twitter Box'), 
        'Twitter Box', 
        'manage_options', 
        'slug_for_twitter_box', 
        'cardoza_twitter_box_options_page',
        plugin_dir_url(__FILE__).'includes/twitter.png');
}


function cardoza_twitter_box_init(){
    load_plugin_textdomain('twittertweetbox', false, dirname(plugin_basename(__FILE__)) . '/languages');
    register_sidebar_widget(__('Twitter Tweets Box'), 'widget_cardoza_twitter_box');
}

function cardoza_twitter_box_sc(){
    ob_start();
    $option_value = ctb_retrieve_options($opt_val);
    $username = get_option('cardoza_tb_username');
    $user_widget_id = get_option('cardoza_tb_user_widget_id');
    $width = get_option('cardoza_tb_width');
    $height = get_option('cardoza_tb_height');
    $links_color = get_option('cardoza_tb_links_color');
    $theme = get_option('cardoza_tb_theme');

    echo '<a class="twitter-timeline"  href="https://twitter.com/'.$username.'"  data-widget-id="'.$user_widget_id.'"';
    if(!empty($width)) echo ' width="'.$width.'"';
    if(!empty($height)) echo ' height="'.$height.'"';
    if(!empty($links_color)) echo ' data-link-color="'.$links_color.'"';
    if(!empty($theme) && $theme == 'dark') echo ' data-theme="dark"';
    echo '>Tweets by @'.$username.'</a>';
    ?>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
?>
