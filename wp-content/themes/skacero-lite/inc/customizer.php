<?php
/**
 * Skacero Pro Theme Customizer.
 *
 * @package Skacero Pro
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
/*-----------------------------------------------------------------------------------*/
/*  Registering the Customizer Settings
/*-----------------------------------------------------------------------------------*/
	
function skacero_pro_options_theme_customizer_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	
		//Add textarea support to the theme customizer
		class Customizer_Textarea_Control extends WP_Customize_Control {
			public $type = 'textarea';
		 
			public function render_content() {
				?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
					</label>
				<?php
			}
		}
		
		
		// Add Radio-Image control support to the theme customizer
		class Customizer_Radio_Image_Control extends WP_Customize_Control {
			public $type = 'radio-image';
			
			public function enqueue() {
				wp_enqueue_script( 'jquery-ui-button' );
			}
			
			// Markup for the field's title
			public function title() {
				echo '<span class="customize-control-title">';
					$this->label();
					$this->description();
				echo '</span>';
			}

			// The markup for the label.
			public function label() {
				// The label has already been sanitized in the Fields class, no need to re-sanitize it.
				echo $this->label;
			}

			// Markup for the field's description
			public function description() {
				if ( ! empty( $this->description ) ) {
					// The description has already been sanitized in the Fields class, no need to re-sanitize it.
					echo '<span class="description customize-control-description">' . $this->description . '</span>';
				}
			}
			
			public function render_content() {
				if ( empty( $this->choices ) ) {
					return;
				}
				$name = '_customize-radio-' . $this->id;
				?>
				<?php $this->title(); ?>
				<div id="input_<?php echo $this->id; ?>" class="image">
					<?php foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_html( $label ); ?>">
							</label>
						</input>
					<?php endforeach; ?>
				</div>
				<script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
				<?php
			}
		}
		
		
		//Add input[type=number] support to the theme customizer
		class Customizer_Number_Control extends WP_Customize_Control {
			public $type = 'number';
			
			public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<input class="number-control small" min="0" max="500" step="1" type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
				</label>
			<?php
			}
		}

// General Settings SECTION
		$wp_customize->add_section( 
			'general_settings', array(
			'title' => __( 'General Settings', 'skacero-pro' ),
			'priority' => 10,
		) );


		
		//Custom Navigation
		$wp_customize->add_setting( 
			'custom_navigation' , array(
				'default'     => 'off',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(	
				'custom_navigation', array(
					'label' =>  __( 'Custom Navigation', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Custom Posts Pagination. ', 'skacero-pro' ),
					'section' => 'general_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					)
				)
		);
			
		

// Header Settings SECTION
		$wp_customize->add_section( 
			'header_settings', array(
				'title' => __( 'Header Settings', 'skacero-pro' ),
				'priority' => 20
		) );		
	
	
		// Topbar Menu
		$wp_customize->add_setting( 
			'top_bar_menu' , array(
				'default'     => 'off',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(
			//new Customizer_Switcher_Control(
				//$wp_customize,				
				'top_bar_menu',
				array(
					'label' =>  __( 'Topbar Menu', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Header Top Menu.', 'skacero-pro' ),
					'section' => 'header_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
			//)
		);		
		
		
		//Logo Upload	
		$wp_customize->add_setting( 
			'custom_logo' , array(
				'default'     => get_template_directory_uri() .'/images/logo/logo.jpg',
				'sanitize_callback' => 'esc_url_raw',
		));
		 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'custom_logo',
				array(
					'label' =>  __( 'Custom Logo', 'skacero-pro' ),
					'section' => 'header_settings',
					'settings' => 'custom_logo',
				)
			)
		);	

			
		// Header Ads Area
		$wp_customize->add_setting( 
			'header_ads' , array(
				'default'     => 'off',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(				
				'header_ads',
				array(
					'label' =>  __( 'Header Banner Ads', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the 728x90 Header Banner Ads Area beside the logo. To add a Header Advert banner go to Appearance > Widgets then add your banner link.', 'skacero-pro' ),
					'section' => 'header_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);	

		
		//Header Image	
		$wp_customize->add_setting( 
			'header_image' , array(
				'default'     => '',
				'sanitize_callback' => 'esc_url_raw',
		));
		 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'header_image',
				array(
					'label' =>  __( 'Header Image', 'skacero-pro' ),
					'section' => 'header_settings',
					'settings' => 'header_image',
				)
			)
		);	
		
		
		// Website Description
		$wp_customize->add_setting( 
			'site_description' , array(
				'default'     => 'on',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(				
				'site_description',
				array(
					'label' =>  __( 'Website Description', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Website Description. When you have a Custom Logo Uploaded, this feature is automatically OFF. To add a website Description or tagline, go to Settings and edit the Tagline. Or Site Identity in the Customizer', 'skacero-pro' ),
					'section' => 'header_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);
		
		// Menu color
		$wp_customize->add_setting(
			'menu_color',
			array(
				'default' => '#971d0c',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'menu_color',
				array(
					'label' => __( 'Menu Background Color', 'skacero-pro' ),
					'section' => 'header_settings',
					'settings' => 'menu_color',
				)
			)
		);
		
		// Menu Hover color
		$wp_customize->add_setting(
			'menu_hover_color',
			array(
				'default' => '#871e10',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'menu_hover_color',
				array(
					'label' => __( 'Menu Hover Color', 'skacero-pro' ),
					'section' => 'header_settings',
					'settings' => 'menu_hover_color',
				)
			)
		);
		
// Front Page Settings SECTION
		$wp_customize->add_section( 
			'frontpage_settings', array(
				'title' => __( 'Front Page Settings', 'skacero-pro' ),
				'priority' => 20
		) );		
		
		
		// Front Page Sidebar
		$wp_customize->add_setting( 
			'home_page_sidebar' , array(
				'default'     => 'off',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
			
		$wp_customize->add_control(			
				'home_page_sidebar',
				array(
					'label' =>  __( 'Display Sidebar on Home Page', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Sidebar Widget in the Home Page. <a href="//www.icynets.com/home/skacero-theme/" target="_blank">VIEW DOCUMENTATION</a>', 'skacero-pro' ),
					'section' => 'frontpage_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);		
			
			
		// Front Page Slider and Cat Columns
		$wp_customize->add_setting( 
			'home_page_slider_and_post_columns' , array(
				'default'     => 'off',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
			
		$wp_customize->add_control(				
				'home_page_slider_and_post_columns',
				array(
					'label' =>  __( 'Home Page Slider', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Home Page Post Slider. <a href="//wpthemes.icynets.com/skacero/" target="_blank">VIEW DEMO</a>. To add Slider Widget, go to Appearance > Widgets then add Skacero: Home Page Post Slider to the Home Page: Slider Area. Repeat step to add Skacero: Home Page 4 Column to Home Page: 4 Column Area. <a href="//www.icynets.com/home/skacero-theme/" target="_blank">VIEW DOCUMENTATION</a>', 'skacero-pro' ),
					'section' => 'frontpage_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);		
		
		
// Footer Area SECTION
		$wp_customize->add_section( 
			'footer_area', array(
				'title' => __( 'Footer Area Settings', 'skacero-pro' ),
				'priority' => 20
		) );		
		
		
		// Footer Banner Ads
		$wp_customize->add_setting( 
			'footer_ads' , array(
				'default'     => 'off',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
			
		$wp_customize->add_control(				
				'footer_ads',
				array(
					'label' =>  __( 'Banner Ads in Footer', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Footer Ads Widget Area. IF enabled, go to Appearance > Widgets then add a link to your banner ads.', 'skacero-pro' ),
					'section' => 'footer_area',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);		
		
		
		//Footer Column Widgets
		$wp_customize->add_setting(
			'footer_column_widgets',
			array(
				'default' => 'off',
				'sanitize_callback' => 'skacero_pro_sanitize_footer_column_widgets',
			)
		);

		$wp_customize->add_control(	
			new Customizer_Radio_Image_Control(
				$wp_customize,
				'footer_column_widgets', array(
					'label' 	=> __( 'Footer Column Widgets', 'skacero-pro' ),
					'description' =>  __( 'Select the number of Widget Columns to display in the Footer area. To add widgets go to Appearance > Widgets, then add widgets to the columns. <a href="//wpthemes.icynets.com/skacero/" target="_blank">VIEW DEMO</a>', 'skacero-pro' ),
					'section' => 'footer_area',
					'choices' => array(
						'off' 	=> get_template_directory_uri() .'/images/footer/widget-off.png',
						'1' 	=> get_template_directory_uri() .'/images/footer/column-1.png',
						'2' 	=> get_template_directory_uri() .'/images/footer/column-2.png',
						'3' 	=> get_template_directory_uri() .'/images/footer/column-3.png',
						'4' 	=> get_template_directory_uri() .'/images/footer/column-4.png',
					),
				)
			)
		);	
		
		
		// Powered By WordPress
		$wp_customize->add_setting( 
			'wordpress_powered_by' , array(
				'default'     => 'on',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
			
		$wp_customize->add_control(			
				'wordpress_powered_by',
				array(
					'label' =>  __( 'WordPress Powered by', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Powered by WordPress Link', 'skacero-pro' ),
					'section' => 'footer_area',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);		
		
		
		// Theme By
		//$wp_customize->add_setting( 
		//	'theme_by' , array(
		//		'default'     => 'on',
		//		'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
		//		)
		//);
			
		//$wp_customize->add_control(				
		//		'theme_by',
		//		array(
		//			'label' =>  __( 'Theme By', 'skacero-pro' ),
		//			'description' =>  __( 'Enable / Disable the Theme By: icyNETS link.', 'skacero-pro' ),
		//			'section' => 'footer_area',
		//			'type' => 'radio',
		//			'choices' 	=> array(
		//				'on' 	=> __( 'Enable', 'skacero-pro' ),
		//				'off' 	=> __( 'Disable', 'skacero-pro' ),
		//			),
		//		)
		//);		
		
		
		
// Article Settings SECTION
		$wp_customize->add_section( 
			'article_settings', array(
				'title' => __( 'Article Settings', 'skacero-pro' ),
				'priority' => 30
		) );	
	
		//Display
		$wp_customize->add_setting(
			'article_image_display',
			array(
				'default' => 'image_full_featured',
				'sanitize_callback' => 'skacero_pro_sanitize_display',
			)
		);

		$wp_customize->add_control(	
			new Customizer_Radio_Image_Control(
				$wp_customize,
				'article_image_display', array(
					'label' => __( 'Article Image Display Type', 'skacero-pro' ),
					'description' =>  __( 'Select how to display featured image in Single Posts', 'skacero-pro' ),
					'section' => 'article_settings',
					'choices' => array(
						'image_full_featured' => get_template_directory_uri() .'/images/customizer/bigthumb.png',
						'image_smallfeatured' => get_template_directory_uri() .'/images/customizer/smallthumb.png',
					),
				)
			)
		);		

		//Hide Or Enable Featured Image
		$wp_customize->add_setting( 
			'featured_image_hide' , array(
				'default'     => 'on',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(	
				'featured_image_hide', array(
					'label' =>  __( 'Featured Image Display', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the featured image display in Single posts ', 'skacero-pro' ),
					'section' => 'article_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);
		
		//Post Meta
		$wp_customize->add_setting( 
			'post_meta' , array(
				'default'     => 'on',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(	
				'post_meta', array(
					'label' =>  __( 'Post Meta', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Posts Meta Info ', 'skacero-pro' ),
					'section' => 'article_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);
		
		//Comments Count
		$wp_customize->add_setting( 
			'comments_count' , array(
				'default'     => 'on',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(	
				'comments_count', array(
					'label' =>  __( 'Comments Count', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Post Comments Count Info. If Post Meta is Disabled, Comments are off by default. ', 'skacero-pro' ),
					'section' => 'article_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);
		
		
		//Next/Prev Article
		$wp_customize->add_setting( 
			'next_prev_post' , array(
				'default'     => 'on',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(			
				'next_prev_post', array(
					'label' =>  __( 'Next/Prev Article', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Next/Previous Navigation.', 'skacero-pro' ),
					'section' => 'article_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);		
		
		
		// Author Information
		$wp_customize->add_setting( 
			'author_bio' , array(
				'default'     => 'off',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(			
				'author_bio',
				array(
					'label' =>  __( 'Display Author Info', 'skacero-pro' ),
					'description' =>  __( 'Enable / Disable the Author information to be displayed below the single Posts.', 'skacero-pro' ),
					'section' => 'article_settings',
					'type' => 'radio',
					'choices' 	=> array(
						'on' 	=> __( 'Enable', 'skacero-pro' ),
						'off' 	=> __( 'Disable', 'skacero-pro' ),
					),
				)
		);	


				//Related Posts
		$wp_customize->add_setting( 
			'related_posts' , array(
				'default'     => 'off',
				'sanitize_callback' => 'skacero_pro_sanitize_enable_disable_feature',
				)
		);
		
		$wp_customize->add_control(
			'related_posts', array(
			'label' 	=>  __( 'Related Posts', 'skacero-pro' ),
			'description' =>  __( 'Enable / Disable the Related Posts feature below the Single Articles. ', 'skacero-pro' ),
			'section' 	=> 'article_settings',
			'type' 		=> 'radio',
			'choices' 	=> array(
					'on' 	=> __( 'Enable', 'skacero-pro' ),
					'off' 	=> __( 'Disable', 'skacero-pro' ),
				),
			)
		);
		
		
		//Related Posts Number
		$wp_customize->add_setting( 
			'related_posts_number', array( 
				'default' => '3',
				'sanitize_callback' => 'skacero_pro_sanitize_integer',
		) );
				
		$wp_customize->add_control( 
			'related_posts_number', array(
				'label'    => __( 'Number of Post', 'skacero-pro' ),
				'description' =>  __( 'Specify number of Related Post to display if Related Post is enabled. (Default is 3)', 'skacero-pro' ),
				'section'  => 'article_settings',
				'settings' => 'related_posts_number',
				'type'     => 'number'
		) );		
		
		
		//Related Posts Query type
		$wp_customize->add_setting(
			'related_posts_query',
			array(
				'default' => 'categories',
				'sanitize_callback' => 'skacero_pro_sanitize_related_posts_query',
			)
		);
		
		$wp_customize->add_control(
			'related_posts_query', array(
				'type' => 'radio',
				'label' => __( 'Related Posts Type', 'skacero-pro' ),
				'description' =>  __( 'Select which type of Related Post to display. Either by Tags or Categories.', 'skacero-pro' ),
				'section' => 'article_settings',
				'choices' => array(
					'tags' => 'Tags',
					'categories' => 'Categories',
				),
			)
		);	
	
	
// Design & Layout SECTION
		$wp_customize->add_section( 
			'colors', array(
				'title' => __( 'Layout Colors', 'skacero-pro' ),
				'priority' => 40
		) );
		
		// Theme color
		$wp_customize->add_setting(
			'links_color',
			array(
				'default' => '#0066bf',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'links_color',
				array(
					'label' => __( 'Links Color', 'skacero-pro' ),
					'section' => 'colors',
					'settings' => 'links_color',
				)
			)
		);
		
		// Widget Title Color
		$wp_customize->add_setting(
			'wt_titles',
			array(
				'default' => '#0e1e7d',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wt_titles',
				array(
					'label' => __( 'Widget Title Color', 'skacero-pro' ),
					'section' => 'colors',
					'settings' => 'wt_titles',
				)
			)
		);
		
		
		// Custom CSS
		$wp_customize->add_setting( 
			'custom_css', array(
				'default' => '',
				'sanitize_callback' => 'wp_strip_all_tags',
			)
		);
		
		$wp_customize->add_control(
			new Customizer_Textarea_Control(
				$wp_customize,
				'custom_css',
				array(
					'label' 	=> __( 'Custom CSS', 'skacero-pro' ),
					'section' 	=> 'colors',
					'settings' 	=> 'custom_css',
				)
			)
		);
		
		
		
			
}
add_action( 'customize_register', 'skacero_pro_options_theme_customizer_register' );

/*-----------------------------------------------------------------------------------*/
/*  CUSTOM DATA SANITIZATION
/*-----------------------------------------------------------------------------------*/
	
// Sanitize text
//function sanitize_text( $input ) {
	//return strip_tags( $input,'<a>' );
//}	
	
// Sanitize checkbox
//function sanitize_checkbox( $input ) {
//	if ( $input == 1 ) {
//		return 1;
//	} else {
//		return '';
//	}
//}

// Sanitize integer
function skacero_pro_sanitize_integer( $input ) {
	return absint( $input );
}

// Sanitize Footer Widget Columns
function skacero_pro_sanitize_footer_column_widgets( $input ) {
    $valid = array(
		'off' 	=> __('Columns Off','skacero-pro'),
		'1' 	=> __('One Footer Column','skacero-pro'),
		'2' 	=> __('Two Footer Columns','skacero-pro'),
		'3' 	=> __('Three Footer Columns','skacero-pro'),
		'4'	 	=> __('Four Footer Columns','skacero-pro'),
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

// Sanitize display
function skacero_pro_sanitize_display( $input ) {
    $valid = array(
		'image_smallfeatured' => __('Featured Image Floats left in Articles','skacero-pro'),
		'image_full_featured' => __('Featured Image Displays top of Article','skacero-pro'),
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

// Sanitize Related Posts Query
function skacero_pro_sanitize_related_posts_query( $input ) {
    $valid = array(
		'tags' => __('Tags','skacero-pro'),
		'categories' => __('Categories','skacero-pro'),
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

// Sanitize Enable / Disable feature
function skacero_pro_sanitize_enable_disable_feature( $input ) {
    $valid = array(
		'on' => __( 'Enable', 'skacero-pro' ),
		'off' => __( 'Disable', 'skacero-pro' ),
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

// Style settings output.
function skacero_pro_add_style_settings() {
	
	$menu_color = get_theme_mod( 'menu_color', '#971d0c' );
	$menu_hover_color = get_theme_mod( 'menu_hover_color', '#871e10' );
	$wt_titles = get_theme_mod( 'wt_titles', '#0e1e7d' );
	
	$links_color = get_theme_mod( 'links_color', '#0066bf' );
	$custom_css = get_theme_mod( 'custom_css' );
		
	
	?>
	<style type="text/css">
		<!--Header Color-->
		.top-bar, .secondary-navigation, .secondary-navigation ul ul li,  #mobile-menu-wrapper, a.sideviewtoggle ,.foot-bottom, .page-numbers a, .posts-navigation a { background-color: <?php echo esc_attr( $menu_color) ?>; }
		
		.page-numbers .current, .page-numbers .current, .page-numbers a:hover, .posts-navigation a:hover  { color: <?php echo esc_attr( $menu_color) ?>; border: 2px solid <?php echo esc_attr( $menu_color) ?>;}
		
		<!--Header Hover Color-->
		.secondary-navigation ul ul a:hover, .secondary-navigation li:hover > a, .secondary-navigation li.focus > a { background-color: <?php echo esc_attr($menu_hover_color )?>;}
		
		.secondary-navigation .current_page_item > a, .secondary-navigation .current-menu-item > a, .secondary-navigation .current_page_ancestor > a { background: <?php echo esc_attr($menu_hover_color) ?>; }
		
		<!--Widget Title Color-->
		.widget h3, .widget h2 { color: <?php echo esc_attr($wt_titles) ?>; }
		
		<!--Theme Color-->
		 button, .nav-links a, input[type='submit'], .error-404 input[type="submit"], .pagination a,  #wp-calendar caption, #wp-calendar #prev a:before, #wp-calendar #next a:before, .tagcloud a, #wp-calendar thead th.today, #wp-calendar td a:hover, #wp-calendar #today { background: <?php echo esc_attr($links_color) ?>; } 
		
		a, .breadcrumb a, .entry-content a {color: <?php echo esc_attr($links_color) ?>;} 
		
		 .post-data .post-title a:hover, .post-title a:hover, .post-info a:hover, .reply a, .fn a, .comment-reply-link, .entry-content a:hover, .breadcrumb a:hover, .widget-post-title a:hover { color: <?php echo esc_attr($links_color) ?>; } 
		 
		<?php if ( $custom_css ) { echo esc_attr($custom_css); } ?>
	</style>
	<?php
}
add_action( 'wp_head', 'skacero_pro_add_style_settings' );

//Loading Customizer Styles
function skacero_pro_customizer_inline_css() {
?>
	<style type="text/css">
	#customize-control-favicon_image .current {
		width: 50px;
	}	
	.ui-state-active img {
		border: 2px solid #c60000;
	}
	#customize-control-sidebar_settings .ui-state-active img {
		width: 71px;
		height: 46px;
	}
	#input_background_pattern {
		height: 220px;
		overflow: auto;
	}
	#input_background_pattern img {
		width: 70px;
		height: 70px;
	}	
	#input_background_pattern .ui-state-active img {
		width: 66px;
		height: 66px;
	}	
	/* Switch Styles */	
	input[type="checkbox"].ios-switch {
		display: none !important;
	}
	input[type="checkbox"].ios-switch + div {
		vertical-align: middle;
		width: 40px;	height: 20px;
		border: 1px solid rgba(0,0,0,.4);
		border-radius: 999px;
		background-color: rgba(0, 0, 0, 0.1);
		-webkit-transition-duration: .4s;
		-webkit-transition-property: background-color, box-shadow;
		box-shadow: inset 0 0 0 0px rgba(0,0,0,0.4);
		margin: 15px 1.2em 15px 2.5em;
	}
	input[type="checkbox"].ios-switch:checked + div {
		width: 40px;
		background-position: 0 0;
		background-color: #3b89ec;
		border: 1px solid #0e62cd;
		box-shadow: inset 0 0 0 10px rgba(59,137,259,1);
	}
	input[type="checkbox"].tinyswitch.ios-switch + div {
		width: 34px;	height: 18px;
	}
	input[type="checkbox"].bigswitch.ios-switch + div {
		width: 50px;	height: 25px;
	}
	input[type="checkbox"].green.ios-switch:checked + div {
		background-color: #00e359;
		border: 1px solid rgba(0, 162, 63,1);
		box-shadow: inset 0 0 0 10px rgba(0,227,89,1);
	}
	input[type="checkbox"].ios-switch + div > div {
		float: left;
		width: 18px; height: 18px;
		border-radius: inherit;
		background: #ffffff;
		-webkit-transition-timing-function: cubic-bezier(.54,1.85,.5,1);
		-webkit-transition-duration: 0.4s;
		-webkit-transition-property: transform, background-color, box-shadow;
		-moz-transition-timing-function: cubic-bezier(.54,1.85,.5,1);
		-moz-transition-duration: 0.4s;
		-moz-transition-property: transform, background-color;
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(0, 0, 0, 0.4);
		pointer-events: none;
		margin-top: 1px;
		margin-left: 1px;
	}
	input[type="checkbox"].ios-switch:checked + div > div {
		-webkit-transform: translate3d(20px, 0, 0);
		-moz-transform: translate3d(20px, 0, 0);
		background-color: #ffffff;
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172,1);
	}
	input[type="checkbox"].tinyswitch.ios-switch + div > div {
		width: 16px; height: 16px;
		margin-top: 1px;
	}
	input[type="checkbox"].tinyswitch.ios-switch:checked + div > div {
		-webkit-transform: translate3d(16px, 0, 0);
		-moz-transform: translate3d(16px, 0, 0);
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172,1);
	}
	input[type="checkbox"].bigswitch.ios-switch + div > div {
		width: 23px; height: 23px;
		margin-top: 1px;
	}
	input[type="checkbox"].bigswitch.ios-switch:checked + div > div {
		-webkit-transform: translate3d(25px, 0, 0);
		-moz-transform: translate3d(16px, 0, 0);
		box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3), 0px 0px 0 1px rgba(8, 80, 172,1);
	}
	input[type="checkbox"].green.ios-switch:checked + div > div {
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(0, 162, 63,1);
	}
	.ios-switch-div {
		margin: 1px !important;
		margin-bottom: 10px !important;
	}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'skacero_pro_customizer_inline_css' );

//Theme Option.
if (! function_exists('skacero_pro_theme_option') ){
	function skacero_pro_theme_option (){
	//if ( get_theme_mod( 'theme_by' ) != 'off' ) {
		?>
		<div class="col-md-6 float-r" style="text-align: right">
			<a href="<?php echo esc_url( __( 'http://www.icynets.com/', 'skacero-pro' ) ); ?>" target="_blank"><?php printf( esc_html__( 'Skacero Theme by : %s', 'skacero-pro' ), 'icyNETS' ); ?></a>
		</div>
	<?php 
	//}
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function skacero_pro_customize_preview_js() {
	wp_enqueue_script( 'skacero_pro_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'skacero_pro_customize_preview_js' );
