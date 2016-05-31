<?php
function cardoza_twitter_box_options_page() {
    if (isset($_POST['frm_submit'])) {
        if (!empty($_POST['frm_title']))
            update_option('cardoza_tb_title', $_POST['frm_title']);
        if (!empty($_POST['frm_username']))
            update_option('cardoza_tb_username', $_POST['frm_username']);
        if (!empty($_POST['frm_user_widget_id']))
            update_option('cardoza_tb_user_widget_id', $_POST['frm_user_widget_id']);
        if (!empty($_POST['frm_width']))
            update_option('cardoza_tb_width', $_POST['frm_width']);
        if (!empty($_POST['frm_height']))
            update_option('cardoza_tb_height', $_POST['frm_height']);
        if (!empty($_POST['frm_links_color']))
            update_option('cardoza_tb_links_color', $_POST['frm_links_color']);
        if (!empty($_POST['frm_theme']))
            update_option('cardoza_tb_theme', $_POST['frm_theme']);
        ?>
        <div id="message" class="updated fade"><p><strong><?php _e('Options saved.', 'twittertweetbox'); ?></strong></p></div>
        <?php
    }
    $option_value = ctb_retrieve_options($opt_val);
    ?>
    <div class="wrap">
        <h2><?php _e("Twitter Box Options", 'twittertweetbox'); ?></h2><br />
        <!-- Administration panel form -->
        <form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <h3><?php _e('General Settings', 'twittertweetbox');?></h3>
            <table>
                <tr>
                    <td>
                        <strong><?php _e('Title', 'twittertweetbox');?>:</strong>
                    </td>
                    <td>
                        <input type="text" name="frm_title" size="50" value="<?php echo $option_value['ctb_title']; ?>"/>
                        (<?php _e('Title of the twitter box', 'twittertweetbox');?>)
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong><?php _e('Username', 'twittertweetbox');?>:</strong>
                    </td>
                    <td>
                        <input type="text" name="frm_username" size="50" value="<?php echo $option_value['ctb_username']; ?>"/>
                        (<?php _e('Username for your twitter account', 'twittertweetbox');?>)
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong><?php _e('Widget ID', 'twittertweetbox');?>:</strong>
                    </td>
                    <td>
                        <input type="text" name="frm_user_widget_id" size="50" value="<?php echo $option_value['ctb_user_widget_id']; ?>"/>
                        (<?php _e('Widget ID from your twitter account - you can get this from the url of your widget', 'twittertweetbox');?>)
                    </td>
                </tr>
                <tr>
                    <td><strong><?php _e('Width', 'twittertweetbox');?>:</strong></td>
                    <td><input type="text" name="frm_width" size="20" value="<?php echo $option_value['ctb_width']; ?>"/>px</td>
                </tr>
                <tr>
                    <td><strong><?php _e('Height', 'twittertweetbox');?>:</strong></td>
                    <td><input type="text" name="frm_height" size="20" value="<?php echo $option_value['ctb_height']; ?>"/>px</td>
                </tr>
                <tr>
                    <td><strong><?php _e('Links color', 'twittertweetbox');?>:</strong></td>
                    <td><input type="text" name="frm_links_color" size="20" value="<?php echo $option_value['ctb_links_color']; ?>"/>(<?php _e('Should be an hex value like #000', 'twittertweetbox');?>)</td>
                </tr>
                <tr>
                    <td><strong><?php _e('Theme', 'twittertweetbox');?>:</strong></td>
                    <td>
                        <select name="frm_theme">
                            <option value="default" <?php if ($option_value['ctb_theme'] == "default") echo "selected='selected'"; ?>>
                                <?php _e('default', 'twittertweetbox');?>
                            </option>
                            <option value="dark" <?php if ($option_value['ctb_theme'] == "dark") echo "selected='selected'"; ?>>
                                <?php _e('dark', 'twittertweetbox');?>
                            </option>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="submit" name="frm_submit" value="<?php _e('Update Options', 'twittertweetbox');?>" />
        </form>
    </div>
    <?php
}
?>