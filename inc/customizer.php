<?php
/**
 * arbah Theme Customizer.
 *
 * @package arbah
 */


// arbah theme options
class arbah_Customize {

   public static function arbah_register ( $wp_customize ) {

   	// Theme Options

    	$wp_customize->add_section( 'arbah_options', 
        	array(
	            'title' => __( 'Options for arbah', 'arbah' ), //Visible title of section
	            'priority' => 1, //Determines what order this appears in
	            'capability' => 'edit_theme_options', //Capability needed to tweak
	            'description' => __('Allows you to customize theme settings for arbah.', 'arbah'), //Descriptive tooltip
        	) 
      	);
     	  	
		  
			$wp_customize->add_setting( 'hide_feat_img', 
	      		array(
					'default'        => false,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
				$wp_customize->add_control( 'hide_feat_img',
					array(
					    'section'   => 'arbah_options',
					    'label'     => __( 'Hide featured image in single posts?', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);

			
			$wp_customize->add_setting( 'show_related_posts', 
	      		array(
					'default'        => true,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
				$wp_customize->add_control( 'show_related_posts',
					array(
					    'section'   => 'arbah_options',
					    'label'     => __( 'Show related posts under the post?', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);

			$wp_customize->add_setting( 'show_post_author', 
	      		array(
					'default'        => true,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
	      		$wp_customize->add_control( 'show_post_author',
					array(
					    'section'   => 'arbah_options',
					    'label'     => __( 'Show post author?', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);
			$wp_customize->add_setting( 'show_post_date', 
	      		array(
					'default'        => true,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
				$wp_customize->add_control( 'show_post_date',
					array(
					    'section'   => 'arbah_options',
					    'label'     => __( 'Show post date?', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);
			
			$wp_customize->add_setting( 'show_social_inside_posts', 
	      		array(
					'default'        => true,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
				$wp_customize->add_control( 'show_social_inside_posts',
					array(
					    'section'   => 'arbah_options',
					    'label'     => __( 'Display social sharing buttons in posts?', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);

			$wp_customize->add_setting( 'show_author_box', 
	      		array(
					'default'        => false,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
	      		$wp_customize->add_control( 'show_author_box',
					array(
					    'section'   => 'arbah_options',
				    	'label'     => __( 'Show author box after post content?', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);
	
			$wp_customize->add_setting( 'make_sidebars_sticky', 
	      		array(
					'default'        => true,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
				$wp_customize->add_control( 'make_sidebars_sticky',
					array(
					    'section'   => 'arbah_options',
					    'label'     => __( 'Make sidebars sticky?', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);
			
			$wp_customize->add_setting( 'arbah_footer_text', 
	      		array(
					'default'        => '',
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);

				$wp_customize->add_control( 'arbah_footer_text',
					array(
					    'section'   => 'arbah_options',
					    'label'     => __( 'Custom Footer Credit Text', 'arbah' ),
					    'priority' => 100, 
					    'type' => 'textarea'
					)
				);
				
		
			


    // Slider Option
    
		$wp_customize->add_section( 'arbah_slider_section' , array(
		    'title'       => __( 'Slider Options', 'arbah' ),
		    'priority'    => 20,
		    'description' => __('Customize slider options in homepage and posts.', 'arbah'),
	  	) );
		  	
	      	$wp_customize->add_setting( 'show_homepage_slider', 
	      		array(
					'default'        => true,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
		  		$wp_customize->add_control( 'show_homepage_slider',
					array(
					    'section'   => 'arbah_slider_section',
					    'label'     => __( 'Display slider in homepage?', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);

			$wp_customize->add_setting('arbah_slider_post_tag', 
				array(
					'default' => '', 
					'sanitize_callback' => 'arbah_sanitize_text'
				)
			);
				$wp_customize->add_control('arbah_slider_post_tag', 
					array('label' => __('Show posts from tag:', 'arbah'), 
						'section' => 'arbah_slider_section', 
						'type' => 'text'
					)
				);
    
    		$wp_customize->add_setting('arbah_home_post_numb',
    			array(
    				'default' => '6', 
    				'sanitize_callback' => 'arbah_sanitize_integer'
    			)
    		);
    			$wp_customize->add_control('arbah_home_post_numb', 
    				array(
    					'label' => __('Posts number in the slider', 'arbah'), 
    					'section' => 'arbah_slider_section', 
    					'type' => 'text'
    				)
    			);

    		$wp_customize->add_setting( 'show_random_posts_slider', 
	      		array(
					'default'        => true,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
				$wp_customize->add_control( 'show_random_posts_slider',
					array(
					    'section'   => 'arbah_slider_section',
					    'label'     => __( 'Show a slider with radnom posts in single post ?', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);

			$wp_customize->add_setting('arbah_random_post_numb',
    			array(
    				'default' => '24', 
    				'sanitize_callback' => 'arbah_sanitize_integer'
    			)
    		);
    			$wp_customize->add_control('arbah_random_post_numb', 
    				array(
    					'label' => __('Random posts number', 'arbah'), 
    					'section' => 'arbah_slider_section', 
    					'type' => 'text'
    				)
    			);

    // Ads Managment

	    $wp_customize->add_section( 'arbah_adze_section' , array(
		    'title'       => __( 'Ads Managment', 'arbah' ),
		    'priority'    => 20,
		    'description' => __('Add ads in different placement.', 'arbah'),
	  	) );
		  	
	      	$wp_customize->add_setting( 'arbah_adblock_detector', 
	      		array(
					'default'        => false,
					'sanitize_callback' => 'arbah_sanitize_checkbox'
			 	) 
			);
				$wp_customize->add_control( 'arbah_adblock_detector',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Block adblockers from browsing the site', 'arbah' ),
					    'type'      => 'checkbox'
					)
				);

			$wp_customize->add_setting( 'arbah_adblock_notice', 
	      		array(
					'default'        => __( 'Please consider supporting us by disabling your ad blocker', 'arbah' ),
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);
		  		$wp_customize->add_control( 'arbah_adblock_notice',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Adblock Notice', 'arbah' ),
					    'description'     => __( 'Notice for visitors with adblock', 'arbah' ),
					    'type' => 'textarea'
					)
				);

			$wp_customize->add_setting( 'arbah_adze_responsive', 
	      		array(
					'default'        => '',
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);
		  		$wp_customize->add_control( 'arbah_adze_responsive',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Responsive Ad', 'arbah' ),
					    'description'     => __( 'Display a responsive ad before header', 'arbah' ),
					    'type' => 'textarea'
					)
				);
			
			$wp_customize->add_setting( 'arbah_adze_header_bottom', 
	      		array(
					'default'        => '',
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);
		  		$wp_customize->add_control( 'arbah_adze_header_bottom',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Header Bottom Ad', 'arbah' ),
					    'description'     => __( 'Display an ad after header', 'arbah' ),
					    'type' => 'textarea'
					)
				);
			
			$wp_customize->add_setting( 'arbah_adze_home_post', 
	      		array(
					'default'        => '',
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);
		  		$wp_customize->add_control( 'arbah_adze_home_post',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Homepage Post Ad', 'arbah' ),
					    'description'     => __( 'Display an ad after the first post in homepage', 'arbah' ),
					    'type' => 'textarea'
					)
				);
			
			$wp_customize->add_setting( 'arbah_adze_post', 
	      		array(
					'default'        => '',
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);
		  		$wp_customize->add_control( 'arbah_adze_post',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Under Post Title Ad', 'arbah' ),
					    'description'     => __( 'Display an ad under post title', 'arbah' ),
					    'type' => 'textarea'
					)
				);
			
			$wp_customize->add_setting( 'arbah_adze_fixed', 
	      		array(
					'default'        => '',
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);
		  		$wp_customize->add_control( 'arbah_adze_fixed',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Fixed Ad', 'arbah' ),
					    'description'     => __( 'Display a fixed ad', 'arbah' ),
					    'type' => 'textarea'
					)
				);

			$wp_customize->add_setting( 'arbah_adze_prev_next', 
	      		array(
					'default'        => '',
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);				
		  		$wp_customize->add_control( 'arbah_adze_prev_next',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Prev Next Links Ad', 'arbah' ),
					    'description'     => __( 'Display an ad before prev next links', 'arbah' ),
					    'type' => 'textarea'
					)
				);
		
			$wp_customize->add_setting( 'arbah_adze_readmore', 
	      		array(
					'default'        => '',
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);				
		  		$wp_customize->add_control( 'arbah_adze_readmore',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Read More ad', 'arbah' ),
					    'description'     => __( 'Display an ad under read more button', 'arbah' ),
					    'type' => 'textarea'
					)
				);

			$wp_customize->add_setting( 'arbah_adze_cse', 
	      		array(
					'default'        => '',
					'sanitize_callback' => 'arbah_sanitize_text'
			 	) 
			);
		  		$wp_customize->add_control( 'arbah_adze_cse',
					array(
					    'section'   => 'arbah_adze_section',
					    'label'     => __( 'Google Search Code', 'arbah' ),
					    'type' => 'textarea'
					)
				);

	// Social Profiles

		$wp_customize->add_section( 'arbah_social_section' , array(
		    'title'       => __( 'Social Profiles', 'arbah' ),
		    'priority'    => 50,
		    'description' => __('Add your social profiles.', 'arbah'),
	  	) );

	  		$wp_customize->add_setting( 'social_title', array(
				'default'           => __( 'Follow Us On', 'arbah' ),
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'arbah_sanitize_text',
			) );
				$wp_customize->add_control( 'social_title', array(
					'label'	  => __( 'Social Profiles Title', 'arbah' ),
					'section' => 'arbah_social_section',
					'type'    => 'text',
				) );

			$wp_customize->add_setting( 'facebook_url', array(
				'default'           => '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			) );
				$wp_customize->add_control( 'facebook_url', array(
					'label'	  => __( 'Facebook Profile URL', 'arbah' ),
					'section' => 'arbah_social_section',
					'type'    => 'text',
				) );

	      	$wp_customize->add_setting( 'twitter_url', array(
				'default'           => '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			) );
				$wp_customize->add_control( 'twitter_url', array(
					'label'	  => __( 'Twitter Profile URL', 'arbah' ),
					'section' => 'arbah_social_section',
					'type'    => 'text',
				) );

			$wp_customize->add_setting( 'whatsapp_url', array(
				'default'           => '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			) );
				$wp_customize->add_control( 'whatsapp_url', array(
					'label'	  => __( 'Whatsapp Profile URL', 'arbah' ),
					'section' => 'arbah_social_section',
					'type'    => 'text',
				) );

			$wp_customize->add_setting( 'instagram_url', array(
				'default'           => '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			) );
				$wp_customize->add_control( 'instagram_url', array(
					'label'	  => __( 'Instagram Profile URL', 'arbah' ),
					'section' => 'arbah_social_section',
					'type'    => 'text',
				) );

			$wp_customize->add_setting( 'youtube_url', array(
				'default'           => '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			) );
				$wp_customize->add_control( 'youtube_url', array(
					'label'	  => __( 'Youtube Profile URL', 'arbah' ),
					'section' => 'arbah_social_section',
					'type'    => 'text',
				) );

			$wp_customize->add_setting( 'linkedin_url', array(
				'default'           => '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			) );
				$wp_customize->add_control( 'linkedin_url', array(
					'label'	  => __( 'Linkedin Profile URL', 'arbah' ),
					'section' => 'arbah_social_section',
					'type'    => 'text',
				) );

      	/* Colors */

    	$wp_customize->add_setting( 'accent_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         	array(
	            'default' => '#f1300d', //Default setting/value to save
	            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
	            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	      		'sanitize_callback' => 'sanitize_hex_color'
        	) 
      	);
      		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         	$wp_customize, //Pass the $wp_customize object (required)
         		'arbah_accent_color', //Set a unique ID for the control
         		array(
            		'label' => __( 'Accent Color', 'arbah' ), //Admin-visible name of the control
            		'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            		'settings' => 'accent_color', //Which setting to load and manipulate (serialized is okay)
            		'priority' => 10, //Determines the order this control appears in for the specified section
         		) 
      		) );


      	/* Body Background  */
      
	  	$wp_customize->remove_section( 'background_image' );

	    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	    
	    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	}

   public static function arbah_header_output() {

      ?>      
	      <!-- Customizer CSS --> 
	      
	      <style type="text/css">
	           <?php self::arbah_generate_css('a, a:hover, a:focus, a:active, .home-posts-title, .related-posts-title, #secondary .widget-title, .secondary-navigation a:hover, a.link-box:hover .more-btn, a.link-box:hover .post-title, .arbah-slider .slick-prev, .arbah-slider .slick-next, .sub-menu-wrapper li:hover .small-title a  ', 'color', 'accent_color'); ?>
			  
	           <?php self::arbah_generate_css('.nav-toggle, .search-toggle .searching-icon, .text-cover, a[data-readmore-toggle], .prev-next-posts .page-link , #smoothup, .fly-menu-social .social-icons a, .sidebar-post-img:after, button, input[type="button"], input[type="reset"], input[type="submit"], .post-cat, .comments-title .fa, .pagination .page-numbers:hover, .pagination .page-numbers.dots:hover, .text-box h3, .pagination .current, .pagination .current:hover ', 'background-color', 'accent_color'); ?>
	             

	      </style> 
	      
	      <!--/Customizer CSS-->
	      
    	<?php
    }
   
    public static function arbah_live_preview() {
    	wp_enqueue_script( 
           'arbah-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/js/customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      	);
   }

   public static function arbah_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      	$return = '';
      	$mod = get_theme_mod($mod_name);

      	if ( ! empty( $mod ) ) {
         	$return = sprintf('%s { %s:%s; }',
	            $selector,
	            $style,
	            $prefix.$mod.$postfix
         	);
        	if ( $echo ) {
            	echo $return;
         	}
      	}
      	return $return;
    }
}

/**
 * Sanitize the settings with checboxs
 */
function arbah_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Sanitize the settings with textareas
 */
function arbah_sanitize_text( $value ) {

    if ( current_user_can('unfiltered_html') ) :
        return $value;
    else :
        return stripslashes( wp_filter_post_kses( addslashes($value) ) );
    endif;
}
/**
 * Sanitize the settings with integers
 */
function arbah_sanitize_integer($input) {
    return strip_tags($input);
}


// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'arbah_Customize' , 'arbah_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'arbah_Customize' , 'arbah_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'arbah_Customize' , 'arbah_live_preview' ) );


