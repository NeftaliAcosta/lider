<?php

/**
 * 
 * TYP Widget Class
 *
 * @version 1.4
 * @author  Rik de Vos
 */
class YTP_Widget extends WP_Widget {

	public static $options = array(
		'title' => '',
		'type' => 'playlist',
		'playlist' => '',
		'channel' => '',
		'user' => '',
		'video' => '',
	);

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'TYP_Widget',
			'YouTube Playlist Widget',
			array('description' => 'Add a Youtube playlist to your page') // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		echo $args['before_widget'];

		if(self::get_option('title', $instance) !== '') {
			echo $args['before_title'] . apply_filters( 'widget_title', self::get_option('title', $instance)). $args['after_title'];
		}
		
		$type = self::get_option('type', $instance);

		switch ($type) {
			case 'playlist':
				preg_match('/list\=([A-Za-z0-9_-]+)/', self::get_option('playlist', $instance), $matches);
				if(count($matches) !== 2) {
					echo '<strong>The URL you have entered inside the widget field is incorrect, or it\'s the wrong type.</strong>';
					break;
				}
				echo do_shortcode('[ytp_playlist source="'.$matches[1].'"]');
				break;
			case 'channel':
				preg_match('/channel\/([A-Za-z0-9_-]+)/', self::get_option('channel', $instance), $matches);
				if(count($matches) !== 2) {
					echo '<strong>The URL you have entered inside the widget field is incorrect, or it\'s the wrong type.</strong>';
					break;
				}
				echo do_shortcode('[ytp_channel source="'.$matches[1].'"]');
				break;
			case 'user':
				preg_match('/user\/([A-Za-z0-9_-]+)/', self::get_option('user', $instance), $matches);
				if(count($matches) !== 2) {
					echo '<strong>The URL you have entered inside the widget field is incorrect, or it\'s the wrong type.</strong>';
					break;
				}
				echo do_shortcode('[ytp_user source="'.$matches[1].'"]');
				break;
			case 'video':
				preg_match_all('/watch\?v\=([A-Za-z0-9_-]+)/', self::get_option('video', $instance), $matches);
				if(count($matches[1]) == 0) {
					echo '<strong>The URL you have entered inside the widget field is incorrect, or it\'s the wrong type.</strong>';
					break;
				}
				echo do_shortcode('[ytp_video source="'.implode(',', $matches[1]).'"]');
				break;
			
		}

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		$type = self::get_option('type', $instance);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( self::get_option('title', $instance) ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>">Playlist Type:</label><br />
			<select onchange="ytp_widget_type_change(this)" id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" style="width: 100%">
				<option value="playlist"<?php if($type == 'playlist') { echo ' selected="selected"'; } ?>>Playlist</option>
				<option value="channel"<?php if($type == 'channel') { echo ' selected="selected"'; } ?>>Channel</option>
				<option value="user"<?php if($type == 'user') { echo ' selected="selected"'; } ?>>User</option>
				<option value="video"<?php if($type == 'video') { echo ' selected="selected"'; } ?>>Custom Video(s)</option>
			</select>
		</p>
		<p class="ytp-widget-type-field ytp-widget-type-field-playlist" <?php if($type !== 'playlist') { echo 'style="display: none"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'playlist' ); ?>">Playlist:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'playlist' ); ?>" name="<?php echo $this->get_field_name( 'playlist' ); ?>" type="text" value="<?php echo esc_attr( self::get_option('playlist', $instance) ); ?>">
			<em style="font-size: 12px; padding: 5px; background: #eee; display: block;  word-wrap: break-word; word-break: break-all;"><strong>Example 1: </strong>https://youtube.com/watch?v=vLeQJL8K0&amp;list=Cn1t1pybju9ffSPBohU<br /><strong>Example 2: </strong>http://www.youtube.com/playlist?list=PLncTFGctaqZtjmdxnpOpqYc</em>
		</p>
		<p class="ytp-widget-type-field ytp-widget-type-field-channel" <?php if($type !== 'channel') { echo 'style="display: none"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'channel' ); ?>">Channel:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'channel' ); ?>" name="<?php echo $this->get_field_name( 'channel' ); ?>" type="text" value="<?php echo esc_attr( self::get_option('channel', $instance) ); ?>">
			<em style="font-size: 12px; padding: 5px; background: #eee; display: block;  word-wrap: break-word; word-break: break-all;"><strong>Example: </strong>https://www.youtube.com/channel/UCq-4ombcPnNvFFS7duZfpeg</em>
		</p>
		<p class="ytp-widget-type-field ytp-widget-type-field-user" <?php if($type !== 'user') { echo 'style="display: none"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'user' ); ?>">User:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" type="text" value="<?php echo esc_attr( self::get_option('user', $instance) ); ?>">
			<em style="font-size: 12px; padding: 5px; background: #eee; display: block;  word-wrap: break-word; word-break: break-all;"><strong>Example: </strong>https://www.youtube.com/user/username</em>
		</p>
		<p class="ytp-widget-type-field ytp-widget-type-field-video" <?php if($type !== 'video') { echo 'style="display: none"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'video' ); ?>">Video(s):</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'video' ); ?>" name="<?php echo $this->get_field_name( 'video' ); ?>" type="text" value="<?php echo esc_attr( self::get_option('video', $instance) ); ?>">
			<em style="font-size: 12px; padding: 5px; background: #eee; display: block;  word-wrap: break-word; word-break: break-all;"><strong>Example: </strong>https://youtube.com/watch?v=vLeQJLffSPBo</em>
			<strong>For multiple video's, seperate the URL's by a space.</strong>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach(self::$options as $key => $option) {
			$instance[$key] = ( ! empty( $new_instance[$key] ) ) ? strip_tags( $new_instance[$key] ) : '';
		}
		return $instance;
	}

	public function get_option($key, $instance) {
		if(!isset($instance[$key])) {
			return self::$options[$key];
		}else {
			return $instance[$key];
		}
	}

}