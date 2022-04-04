<?php
/*
	Display posts in sidebar

*/

/*  Register widget
/* ------------------------------------ */
if ( ! function_exists( 'arbah_register_widget_sidebar_posts' ) ) {

	function arbah_register_widget_sidebar_posts() { 
		register_widget( 'sidebar_posts' );
	}
	
}
add_action( 'widgets_init', 'arbah_register_widget_sidebar_posts' );


class sidebar_posts extends WP_Widget {

/*  Constructor
/* ------------------------------------ */

	function __construct() {
		parent::__construct(
		// Base ID of the widget
		'sidebar_posts', 

		// Widget name
		__('Sidebar Posts List', 'arbah'), 

		// Widget description
		array( 'description' => __( 'Show a list of posts from a selected category with big thumbnails', 'arbah' ), ) 
		);
	}
	
/*  Widget
/* ------------------------------------ */
	public function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$output = $before_widget."\n";
		if($title)
			$output .=  '<h2 class="widget-title">' . $title .'</h2>' ;
		ob_start();
	
?>

	<?php
		$posts = new WP_Query( array(
			'post_type'				=> array( 'post' ),
			'showposts'				=> $instance['posts_num'],
			'cat'					=> $instance['posts_cat_id'],
			'ignore_sticky_posts'	=> true,
			'orderby'				=> $instance['posts_orderby'],
			'order'					=> 'dsc',
			'meta_key'				=>	'_thumbnail_id',
			'date_query' => array(
				array(
					'after' => $instance['posts_time'],
				),
			),
		) );
	?>
		
	<?php 
	$posts_trend = '';
	if ( $instance['show_numbers'] ) { $posts_trend = 'posts-trend'; } ?>
	<div id="entries-list" class="clear <?php echo $posts_trend; ?> ">

			<?php 
			while ($posts->have_posts()): $posts->the_post();  ?>

				<div class="sidebar-post-wrap" >
						
					<a href="<?php the_permalink(); ?>" class="link-box">
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="sidebar-post-img">
							<figure>
								<img class="lazy-img" src='<?php echo arbah_thumb_src( 'small-thumb' ); ?>' alt='<?php the_title(); ?>'  title='<?php the_title(); ?>'>
							</figure>
							<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-play"></i></span>'; ?>
		    				<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-volume-up"></i></span>'; ?>
		    				<?php if ( is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-star"></i></span>'; ?>
						</div>
						<?php endif ?>
						<h3 class="post-title"><?php the_title(); ?></h3>
					</a>
				</div>
			<?php endwhile; ?>

		<?php wp_reset_postdata(); ?>
	</div>

<?php
		$output .= ob_get_clean();
		$output .= $after_widget."\n";
		echo $output;
	}
	
/*  Widget update
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = strip_tags($new['title']);
	// Posts
		$instance['posts_num'] = strip_tags($new['posts_num']);
		$instance['posts_cat_id'] = strip_tags($new['posts_cat_id']);
		$instance['posts_orderby'] = strip_tags($new['posts_orderby']);
		$instance['posts_time'] = strip_tags($new['posts_time']);
		$instance['posts_category'] = $new['posts_category']?1:0;
		$instance['posts_date'] = $new['posts_date']?1:0;

		$instance['show_numbers'] = strip_tags($new['show_numbers']);


		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title' 			=> '',
		// Posts
			'posts_num' 		=> '6',
			'posts_cat_id' 		=> '0',
			'posts_orderby'     => 'date',
			'posts_time' 		=> '0',

			'show_numbers' 		    => '',

		);
		$instance = wp_parse_args( (array) $instance, $defaults );

?>

	<style>
	.widget .widget-inside .postslist-options .postform { width: 100%; }
	.widget .widget-inside .postslist-options p { margin: 3px 0; }
	.widget .widget-inside .postslist-options hr { margin: 20px 0 10px; }
	.widget .widget-inside .postslist-options h4 { margin-bottom: 10px; }
	</style>
	
	<div class="postslist-options">
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ','arbah');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>
		
		<h4><?php _e('Posts list: ','arbah');?></h4>

		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("posts_num"); ?>"><?php _e('Posts number to show ','arbah');?></label>
			<input style="width:20%;" id="<?php echo $this->get_field_id("posts_num"); ?>" name="<?php echo $this->get_field_name("posts_num"); ?>" type="text" value="<?php echo absint($instance["posts_num"]); ?>" size='3' />
		</p>

		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_cat_id"); ?>"><?php _e('Category: ','arbah');?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("posts_cat_id"), 'selected' => $instance["posts_cat_id"], 'show_option_all' => 'All', 'show_count' => true ) ); ?>		
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_orderby"); ?>"><?php _e('Order by: ','arbah');?></label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("posts_orderby"); ?>" name="<?php echo $this->get_field_name("posts_orderby"); ?>">
			  <option value="date"<?php selected( $instance["posts_orderby"], "date" ); ?>><?php _e('Most recent','arbah');?></option>
			  <option value="comment_count"<?php selected( $instance["posts_orderby"], "comment_count" ); ?>><?php _e('Most commented','arbah');?></option>
			  <option value="rand"<?php selected( $instance["posts_orderby"], "rand" ); ?>><?php _e('Random','arbah');?></option>
			</select>	
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_time"); ?>"><?php _e('Posts from ','arbah');?></label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("posts_time"); ?>" name="<?php echo $this->get_field_name("posts_time"); ?>">
			  <option value="0"<?php selected( $instance["posts_time"], "0" ); ?>><?php _e('All Time','arbah');?></option>
			  <option value="1 year ago"<?php selected( $instance["posts_time"], "1 year ago" ); ?>><?php _e('This year','arbah');?></option>
			  <option value="1 month ago"<?php selected( $instance["posts_time"], "1 month ago" ); ?>><?php _e('This month','arbah');?></option>
			  <option value="1 week ago"<?php selected( $instance["posts_time"], "1 week ago" ); ?>><?php _e('This week','arbah');?></option>
			  <option value="1 day ago"<?php selected( $instance["posts_time"], "1 day ago" ); ?>><?php _e('Past 24 hours','arbah');?></option>
			</select>	
		</p>


		<hr>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_numbers' ); ?>"><?php _e( 'Would you like to show posts with numbers?' , 'arbah') ?></label>
			<input id="<?php echo $this->get_field_id( 'show_numbers' ); ?>" name="<?php echo $this->get_field_name( 'show_numbers' ); ?>" value="true" <?php if( !empty( $instance['show_numbers'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<hr>

	</div>
<?php

}

}


