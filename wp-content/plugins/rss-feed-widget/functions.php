<?php
/*
	if(!function_exists('rfw_cache')){
		function rfw_cache(){
			
		}
	}*/

class rfw_dock extends WP_Widget {
	
	public $rfw_cache_val;

	public function __construct() {
		// widget actual processes
		parent::__construct(
			'rfw_dock', // Base ID
			__('RSS Feed Widget', 'text_domain'), // Name
			array( 'description' => __( 'A feed widget with sliding effect.', 'text_domain' ), ) // Args
		);
	}
	

	function clean_xhtml($string)
	{
		$string = ereg_replace("<[^>]*>", "", $string);
		$string = preg_replace("@<p[^>]*?>.*?
		@siu", '',$string);
		return $string;
	}

	public function rfw_cache(){
		return $this->rfw_cache_val;
	}
	
	public function is_url($url){
		$ret = true;
		if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
			$ret = false;
		}
		return $ret;
	}
	
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		 
		 global $wpdb;
		 //pree($instance);
		 $limit_feeds = ($instance['number']>0?$instance['number']:1);
		 
		 $title = $instance['title'];
		 //pree($title);
		 $rss_url = $instance['rss_url'];
		 
		 $fb_page_id = !$this->is_url($rss_url);
		 
		 $show_feed_title = $instance['show_feed_title'];
		 
		 $feed_words = ($instance['feed_words']>0?$instance['feed_words']:60);
		 
		 $display_type = $instance['content_display'];
		 
		 $content_order = $instance['content_order']; 
		 
		 $content_height = $instance['content_height']; 
		 
		 $this->rfw_cache_val = $instance['rfw_cache']; 
		 //pree($title);
		 $html = '<aside id="rfw-id" class="rfw-class">';
		 $html.= ($title!='')?'<h3 class="widget-title">'.$title.'</h3>':'';
		 $html.= '<nav class="add-nav widget_dock" id="rfw-authors">';
		 //pree($title);
				
				
		
			//pree($rss_url);
		$html_arr = array();
		$html_ul.= '<ul class="rfw_dock" style="'.($content_height!=''?'height:'.$content_height:'').'">';
		
			if($fb_page_id){
				$access_token_array = array(
					'1489500477999288|KFys5ppNi3sreihdreqPkU2ChIE',
					'859332767418162|BR-YU8zjzvonNrszlll_1a4y_xE',
					'360558880785446|4jyruti_VkxxK7gS7JeyX-EuSXs',
					'1487072591579718|0KQzP-O2E4mvFCPxTLWP1b87I4Q',
					'640861236031365|2rENQzxtWtG12DtlZwqfZ6Vu6BE',
					'334487440086538|hI_NNy1NvxQiQxm-TtXsrmoCVaE',
					'755471677869105|Jxv8xVDad7vUUTauk8K2o71wG2w',
					'518353204973067|dA7YTe-k8eSvgZ8lqa51xSm16DA',
					'444286039063163|5qkYu2qxpERWO3gcs2f3nxeqhpg',
					'944793728885704|XJ6QqKK8Ldsssr4n5Qrs2tVr7rs',
					'1444667452511509|wU7tzWiuj6NadfpHfgkIGLGO86o',
					'1574171666165548|ZL9tXNXxpnCdAvdUjCX5HtRnsR8'
				);
				$access_token = $access_token_array[rand(0, 11)];	
				
				$json_resp = 'https://graph.facebook.com/'.$rss_url.'/posts?fields=object_id,message,story,link,type&access_token='.$access_token.'&limit='.$limit_feeds.'&locale=en_US';
$response = wp_remote_get( $url );

				$response = wp_remote_get($json_resp);
				
				

				if( is_wp_error( $response ) ) {
				   $error_message = $response->get_error_message();
				   //echo "Something went wrong: $error_message";
				} else {
					if( is_array($response) ) {
					  $header = $response['headers']; // array of http header lines
					  $body = $response['body']; // use the content
					  $body = json_decode($body);
					  $body = current($body);
					  if(!empty($body)){
						  foreach($body as $items){
							
							$items->message = (isset($items->message)?$items->message:'');
							$items->story = (isset($items->story)?$items->story:$items->message);
							
							$unique_key = strtolower(substr($items->story, 0, 1));
							
							$content = '';
							
							$img = '';
							
							$link = '<a title="'.$items->story.'" href="'.esc_url( $items->link ).'" target="_blank" rel="nofollow">_LINK_TEXT_</a>';
							
							$content .= $show_feed_title?str_replace('_LINK_TEXT_', '<h3 class="entry-title">'.esc_html( $items->story ).'</h3>', $link):'';
							
							$description = $items->message;	
							
														  
							switch($display_type){
								
								case 'text_only':						
										
										
									$content .= $this->string_limit_words($this->clean_xhtml($description), $feed_words).' ...';				
								break;
								
								default:
								
									if($items->type=='photo')
									$img = 'https://graph.facebook.com/'.$items->object_id.'/picture';	
									
									
									$description = (!$this->is_url($description)?$description:'');
									$content .= ($description!=''?'<div class="text_div">'.$this->string_limit_words($description, $feed_words).' ...</div>':'');	
								break;
								
								case 'image_only':	
									if($items->type=='photo')
									$img = 'https://graph.facebook.com/'.$items->object_id.'/picture';
								break;
							}
							
							
							if($img!=''){							   
								$content .= str_replace('_LINK_TEXT_', '<div class="image_only"><img alt="'.$items->story.'" src="'.$img.'" /></div>', $link);						
							}
						   
						   
							$html_arr[$unique_key][] = ($content!=''?'<li>'.$content.'</li>':'');

						  }
					  }
					}
				}				
							
			}else{
					
				add_filter( 'wp_feed_cache_transient_lifetime' , array($this, 'rfw_cache') );
				$rss = fetch_feed($rss_url);
			 
			 	//pree($rss);
				remove_filter( 'wp_feed_cache_transient_lifetime' , array($this, 'rfw_cache') );
					
					
				 if ( ! is_wp_error( $rss ) ){
					 
					$maxitems = $rss->get_item_quantity( $limit_feeds );  
					
					$rss_items = $rss->get_items( 0, $maxitems );
					
					
					
					if ( $maxitems > 0 ){
						
						
				   
						foreach ( $rss_items as $item ){
							$unique_key = strtolower(substr($item->get_title(), 0, 1));
							
							$html_arr[$unique_key][]='<li>';
							
							$img = '';
							
							$link = '<a href="'.esc_url( $item->get_permalink() ).'" target="_blank" rel="nofollow">_LINK_TEXT_</a>';
							
							$html_arr[$unique_key][]= $show_feed_title?str_replace('_LINK_TEXT_', '<h3 class="entry-title">'.esc_html( $item->get_title() ).'</h3>', $link):'';
							
							$description = $item->get_description();	
							
							
							
							switch($display_type){
								
								case 'text_only':						
									$html_arr[$unique_key][]= $this->string_limit_words($this->clean_xhtml($description), $feed_words).' ...';							
								break;
								
								default:
									$html_arr[$unique_key][]= $this->string_limit_words($description, $feed_words).' ...';	
								break;
								
								case 'image_only':						
									//preg_match_all('/<img[^>]+>/i', $description, $img); 
									//
									//preg_match_all('/src="([^"]*)"/', $description, $img); 
									preg_match_all('@<img.*src="([^"]*)"[^>/]*/?>@Ui', $description, $img); 
									
									
									if(!empty($img)){
										
										$img = end($img);
										
										if(isset($img[0]) && $img[0]!=''){
											$img = $img[0];
											
											$img = current(explode('?', $img));
											
											
											
										}else{
											$img = '';
										}
									}
								break;		
							}
							
							
						   
							if($img!=''){
							   
								$html_arr[$unique_key][]= str_replace('_LINK_TEXT_', '<div class="image_only"><img src="'.$img.'" /></div>', $link);
							
							}
						   
						   
							$html_arr[$unique_key][]= '</li>';
						  
						}
					}
				 }			
			}


		
		 if(is_array($html_arr) && !empty($html_arr)){
			 switch($content_order){
				
				 case 'aa':
				 	ksort($html_arr); 
				 break;
				
				 case 'ad':
				 	krsort($html_arr); 
				 break;
				 				 
				
			 }
			foreach($html_arr as $alphabet=>$feeds){
		 		$html_ul .= implode(' ', $feeds);
			}
		 
		 }
		 $html .= $html_ul.'</ul></nav></aside>';
		 echo $html;
	
	}

	private function string_limit_words($string, $word_limit)
	{
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  return implode(' ', $words);
	}
	
 	public function form( $instance ) {
		// outputs the options form on admin
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$rss_url     = isset( $instance['rss_url'] ) ? esc_attr( $instance['rss_url'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6;
		
		$show_feed_title = isset( $instance['show_feed_title'] ) ? esc_attr( $instance['show_feed_title'] ) : true;
		$feed_words    = isset( $instance['feed_words'] ) ? absint( $instance['feed_words'] ) : 60;
		$content_display    = isset( $instance['content_display'] ) ? $instance['content_display'] : 'default';
		$content_order    = isset( $instance['content_order'] ) ? $instance['content_order'] : 'default';
		$content_height    = isset( $instance['content_height'] ) ? $instance['content_height'] : '';
		$rfw_cache    = isset( $instance['rfw_cache'] ) ? $instance['rfw_cache'] : '';
		
		
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p><label for="<?php echo $this->get_field_id( 'rss_url' ); ?>"><?php _e('Enter the RSS feed URL or Facebook Page ID here: <a title="Click here for examples" target="_blank" href="http://www.tutorsloop.net/app/live.php?id=4330772">(What\'s this?)</a>'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'rss_url' ); ?>" name="<?php echo $this->get_field_name( 'rss_url' ); ?>" type="text" value="<?php echo esc_attr( $rss_url ); ?>" /></p>
    
     <p><label for="<?php echo $this->get_field_id( 'content_display' ); ?>"><?php _e( 'Display type:' ); ?></label>
        <select id="<?php echo $this->get_field_id( 'content_display' ); ?>" name="<?php echo $this->get_field_name( 'content_display' ); ?>">
        	<option value="default" <?php echo $content_display=='default'?'selected="selected"':''; ?>>Default</option>
            <option value="text_only" <?php echo $content_display=='text_only'?'selected="selected"':''; ?>>Text Only</option>
            <option value="image_only" <?php echo $content_display=='image_only'?'selected="selected"':''; ?>>Image Only</option>
        </select></p>
        
        <p><label for="<?php echo $this->get_field_id( 'content_order' ); ?>"><?php _e( 'Sort order:' ); ?></label>
        <select id="<?php echo $this->get_field_id( 'content_order' ); ?>" name="<?php echo $this->get_field_name( 'content_order' ); ?>">
        	<option value="default" <?php echo $content_order=='default'?'selected="selected"':''; ?>>Default</option>
            <option value="aa" <?php echo $content_order=='aa'?'selected="selected"':''; ?>>Alphabetical Ascending</option>
            <option value="ad" <?php echo $content_order=='ad'?'selected="selected"':''; ?>>Alphabetical Descending</option>
        </select></p>
        
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of feeds to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'show_feed_title' ); ?>"><?php _e( 'Display feed title (Yes/No):' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'show_feed_title' ); ?>" name="<?php echo $this->get_field_name( 'show_feed_title' ); ?>" type="checkbox" value="true" <?php echo $show_feed_title?'checked="checked"':''; ?>  /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'feed_words' ); ?>"><?php _e( 'No. of feed words to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'feed_words' ); ?>" name="<?php echo $this->get_field_name( 'feed_words' ); ?>" type="text" value="<?php echo $feed_words; ?>" size="3" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'content_height' ); ?>"><?php _e( 'Widget Height:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'content_height' ); ?>" name="<?php echo $this->get_field_name( 'content_height' ); ?>" type="text" value="<?php echo $content_height; ?>" size="6" /><small><br />
e.g. 400px<br />
        <?php _e( 'Leave empty for auto.' ); ?></small>
        </p>
        
        <p><label for="<?php echo $this->get_field_id( 'rfw_cache' ); ?>"><?php _e( 'Cache Period:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'rfw_cache' ); ?>" name="<?php echo $this->get_field_name( 'rfw_cache' ); ?>" type="text" value="<?php echo $rfw_cache; ?>" placeholder="Enter in seconds" size="20" /><small><br />
e.g. 7200 seconds = 2 hours<br />
        <?php _e( 'Leave empty or 0 for no cache.' ); ?></small>
        </p>
        
       
        
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['rss_url'] = strip_tags($new_instance['rss_url']);
		$instance['number'] = (int) $new_instance['number'];
		
		$instance['show_feed_title'] = ($new_instance['show_feed_title']==true);
		$instance['feed_words'] = (int) $new_instance['feed_words'];
		$instance['content_display'] = strip_tags($new_instance['content_display']);
		$instance['content_order'] = strip_tags($new_instance['content_order']);
		$instance['content_height'] = strip_tags($new_instance['content_height']);
		

		return $instance;
		
	}
}
if(!function_exists('rfw_init')){
	function rfw_init(){
		 register_widget( 'rfw_dock' );
		}
	}
?>