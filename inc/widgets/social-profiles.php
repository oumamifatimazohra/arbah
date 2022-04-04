<?php
/*
	Widget to display Social Profiles in top of the site 

*/

/*  Register widget
/* ------------------------------------ */
if ( ! function_exists( 'arbah_register_widget_social' ) ) {

	function arbah_register_widget_social() { 
		register_widget( 'social_profiles' );
	}
	
}
add_action( 'widgets_init', 'arbah_register_widget_social' );


class social_profiles extends WP_Widget {

/*  Constructor
/* ------------------------------------ */

	function __construct() {
		parent::__construct(
		// Base ID of the widget
		'social_profiles', 

		// Widget name
		__('arbah : Social Profiles', 'arbah'), 

		// Widget description
		array( 'description' => __( 'Show your social profiles', 'arbah' ), ) 
		);
	}
	
/*  Widget
/* ------------------------------------ */
	public function widget($args, $instance) {
		extract( $args );
		$fb_text = $instance['fb_text'];		 		
		$twitter_text = $instance['twitter_text'];
		$instagram_text = $instance['instagram_text'];
		$yt_text = $instance['yt_text'];
		$linkedin_text = $instance['linkedin_text'];	
		$output = $before_widget."\n";
		ob_start();
	?>

	<?php //social profiles
		$facebook_url = get_theme_mod( 'facebook_url' );
		$twitter_url = get_theme_mod( 'twitter_url' );
		$instagram_url = get_theme_mod( 'instagram_url' );
		$youtube_url = get_theme_mod( 'youtube_url' );
		$linkedin_url = get_theme_mod( 'linkedin_url' );
	?>

	<?php if ( ( false  !== $facebook_url ) || ( false  !== $twitter_url ) || ( false  !== $instagram_url ) ||  ( false  !== $youtube_url ) || ( false  !== $linkedin_url ) ) : ?>

		<div id="social" class="clear ">

			<ul>
				<?php if ( false  !== $facebook_url && '' !== $facebook_url  ) : ?>
					<li><a href="<?php echo esc_url( $facebook_url ); ?>" class="fb" target="_blank"><span><?php echo esc_textarea($fb_text); ?></span></a></li>
				<?php endif; ?>
				<?php if ( false  !== $twitter_url && '' !== $twitter_url ) : ?>
					<li ><a href="<?php echo esc_url( $twitter_url ); ?>" class="twt " target="_blank"><span><?php echo esc_textarea($twitter_text); ?></span></a></li>
				<?php endif; ?>
				<?php if ( false  !== $instagram_url && '' !== $instagram_url ) : ?>
					<li ><a href="<?php echo esc_url( $instagram_url ); ?>" class="instagram " target="_blank"><span><?php echo esc_textarea($instagram_text); ?></span></a></li>
				<?php endif; ?>
				<?php if ( false  !== $youtube_url && '' !== $youtube_url ) : ?>
					<li><a href="<?php echo esc_url( $youtube_url ); ?>"  class="ytb " target="_blank"><span><?php echo esc_textarea($yt_text); ?></span></a></li>
				<?php endif; ?>
				<?php if ( false  !== $linkedin_url && '' !== $linkedin_url ) : ?>
					<li ><a href="<?php echo esc_url( $linkedin_url ); ?>" class="linkedin " target="_blank"><span><?php echo esc_textarea($linkedin_text); ?></span></a></li>
				<?php endif; ?>
			</ul>
		</div>
	<?php endif; ?>

<?php
		$output .= ob_get_clean();
		$output .= $after_widget."\n";
		echo $output;
	}
	
/*  Widget update
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['fb_text'] = strip_tags($new['fb_text']);
		$instance['twitter_text'] = strip_tags($new['twitter_text']);
		$instance['instagram_text'] = strip_tags($new['instagram_text']);
		$instance['yt_text'] = strip_tags($new['yt_text']);
		$instance['linkedin_text'] = strip_tags($new['linkedin_text']);

		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'fb_text' 			=> '',
			'twitter_text' 		=> '',
			'instagram_text' 	=> '',
			'yt_text' 			=> '',
			'linkedin_text' 	=> '',			
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

?>

	<style>
	.widget .widget-inside .postslist-options .postform { width: 100%; }
	.widget .widget-inside .postslist-options p { margin: 3px 0; }
	.widget .widget-inside .postslist-options hr { margin: 20px 0 10px; }
	.widget .widget-inside .postslist-options h4 { margin-bottom: 10px; }
	</style>
	
	<div class="social-options">
		<span><?php _e('Write custom box text for each social network: ','arbah');?></span>
		<p>
			<label for="<?php echo $this->get_field_id('fb_text'); ?>"><?php _e('Facebook  Text: ','arbah');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('fb_text'); ?>" name="<?php echo $this->get_field_name('fb_text'); ?>" type="text" value="<?php echo esc_attr($instance["fb_text"]); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter_text'); ?>"><?php _e('Twitter  Text: ','arbah');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_text'); ?>" name="<?php echo $this->get_field_name('twitter_text'); ?>" type="text" value="<?php echo esc_attr($instance["twitter_text"]); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('instagram_text'); ?>"><?php _e('Instagram  Text: ','arbah');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram_text'); ?>" name="<?php echo $this->get_field_name('instagram_text'); ?>" type="text" value="<?php echo esc_attr($instance["instagram_text"]); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('yt_text'); ?>"><?php _e('Youtube  Text: ','arbah');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('yt_text'); ?>" name="<?php echo $this->get_field_name('yt_text'); ?>" type="text" value="<?php echo esc_attr($instance["yt_text"]); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linkedin_text'); ?>"><?php _e('Linkedin  Text: ','arbah');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin_text'); ?>" name="<?php echo $this->get_field_name('linkedin_text'); ?>" type="text" value="<?php echo esc_attr($instance["linkedin_text"]); ?>" />
		</p>
		
	</div>
<?php

}

}


