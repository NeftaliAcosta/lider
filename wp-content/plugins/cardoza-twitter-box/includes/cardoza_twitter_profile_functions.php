<?php

/* Function to retrieve the options value from the database */

function ctb_retrieve_options($opt_val) {
    $opt_val = array(
        'ctb_title' => stripslashes(get_option('cardoza_tb_title')),
        'ctb_username' => stripslashes(get_option('cardoza_tb_username')),
        'ctb_user_widget_id' => stripslashes(get_option('cardoza_tb_user_widget_id')),
        'ctb_width' => stripslashes(get_option('cardoza_tb_width')),
        'ctb_height' => stripslashes(get_option('cardoza_tb_height')),
        'ctb_links_color' => stripslashes(get_option('cardoza_tb_links_color')),
        'ctb_theme' => stripslashes(get_option('cardoza_tb_theme'))
    );
    return $opt_val;
}

function widget_cardoza_twitter_box($args) {
    $option_value = ctb_retrieve_options($opt_val);
    extract($args);
    echo $before_widget;
    echo $before_title;
    if (empty($option_value['ctb_title']))
        $option_value['ctb_title'] = "Twitter";
    echo $option_value['ctb_title'];
    echo $after_title;
    $username = get_option('cardoza_tb_username');
    $user_widget_id = get_option('cardoza_tb_user_widget_id');
    $width = get_option('cardoza_tb_width');
    $height = get_option('cardoza_tb_height');
    $links_color = get_option('cardoza_tb_links_color');
    $theme = get_option('cardoza_tb_theme');

    echo '<a class="twitter-timeline"  href="https://twitter.com/' . $username . '"  data-widget-id="' . $user_widget_id . '"';
    if (!empty($width))
        echo ' width="' . $width . '"';
    if (!empty($height))
        echo ' height="' . $height . '"';
    if (!empty($links_color))
        echo ' data-link-color="' . $links_color . '"';
    if (!empty($theme) && $theme == 'dark')
        echo ' data-theme= "dark"';
    echo '>Tweets by @' . $username . '</a>';
    ?>
    <script>!function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = p + "://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, "script", "twitter-wjs");</script>
    <?php

    global $wpdb;
    echo $after_widget;
}
?>