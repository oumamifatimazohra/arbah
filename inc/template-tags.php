<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package arbah
 */


if ( ! function_exists( 'getPostViews' ) ) :
	// function to display number of posts.
	function getPostViews($postID){
	    $count_key = 'views';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count ==''){
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return "0";
	    }
	    return $count;
	}
endif;

if ( ! function_exists( 'setPostViews' ) ) :

	// function to count views.
	function setPostViews($postID) {
	    $count_key = 'views';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }else{
	        $count++;
	        update_post_meta($postID, $count_key, $count);
	    }
	}
	//To keep the count accurate, lets get rid of prefetching
	remove_action('wp_head', 'start_post_rel_link', 10, 0 );
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

endif;

if ( ! function_exists( 'arbah_numbered_pagination' ) ) :
	/**
	 * Show numbered navigation.
	 *
	 */
	function arbah_numbered_pagination() {
		the_posts_pagination( array(
			'mid_size' => 2,
		) );
	}
endif;


if ( !function_exists( 'arbah_thumb_src' ) ) :
	/**
	 * Fetch image source.
	 *
	 */
	function arbah_thumb_src( $size ){
		global $post;
		$image_id 	= get_post_thumbnail_id($post->ID);
		$image_url 	= wp_get_attachment_image_src($image_id, $size );
		return $image_url[0];
	}
endif;


if ( ! function_exists( 'arbah_post_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function arbah_post_meta() { ?>

		<?php if ( get_theme_mod('show_post_author', '1') == 1 ) : ?>
			
			<span><?php _e('By ','arbah'); ?></span><a class="entry-author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a>
		<?php endif; ?>

		<?php if ( get_theme_mod('show_post_date', '1') == 1 ) : ?>
			<span class="entry-date"><?php echo arbah_time_link(); ?></span>

		<?php endif; ?>

		<?php
	}
endif;

if ( ! function_exists( 'arbah_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function arbah_time_link() {
	$time_string = '<time class="published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'twentyseventeen' ),
		 $time_string
	);
}
endif;


if ( ! function_exists( 'arbah_social_bookmarks' ) ) :
	/**
	 * Show social sharing buttons
	 */
	function arbah_social_bookmarks() {
	global $post;
			// Get current page URL 
			$crunchifyURL = urlencode(get_permalink());
	 
			// Get current page title
			$crunchifyTitle = str_replace( ' ', '%20', get_the_title());
				 
			// Construct sharing URL without using any script
			$twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL;
			$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
			$whatsappURL = 'https://wa.me/?text='.$crunchifyURL;
			
			// Add sharing button at the end of page/page variable
			$variable = '';
			$variable .= '<div class="crunchify-social clear"><span class="title">'. __("Share this post with friends! " , "arbah") . '</span><div class="social-buttons">';
			$variable .= '<a class="crunchify-link crunchify-facebook " href="'.$facebookURL.'"  onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><span>'.__("Facebook", "arbah").'</span><i class="fa fa-facebook tada" ></i></a>';
			$variable .= ' <a class="crunchify-link crunchify-twitter" href="'. $twitterURL .'"  onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;" ><span>'.__("Twitter", "arbah").'</span><i class="fa fa-twitter tada"></i></a>';
			$variable .= '<a class="crunchify-link crunchify-whatsapp" href="'.$whatsappURL.'" target="_blank"><span>'.__("Whatsapp", "moodoo").'</span><i class="fa fa-whatsapp tada"></i></a>';
			$variable .= '</div></div>';

			echo $variable;
 	}
endif;

if ( ! function_exists( 'arbah_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since arbah 1.0
	 */

	function arbah_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="pingback">
			<p><?php _e( 'Pingback:', 'arbah' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'arbah' ), ' ' ); ?></p>
		<?php
			break;
			default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment-body">
				<footer>
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 70 ); ?>
						<?php printf( __( '%s <span class="says">said:</span>', 'arbah' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'arbah' ); ?></em>
						<br />
					<?php endif; ?>

					<div class="comment-meta commentmetadata">
						<time datetime="<?php comment_time( 'c' ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s - %2$s', 'arbah' ), get_comment_date(), get_comment_time() ); ?>
						</time>
						<?php edit_comment_link( __( 'Edit', 'arbah' ), ' ' );
						?>
					</div><!-- .comment-meta .commentmetadata -->
				</footer>

				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch;
	}
endif; // ends check for arbah_comment()

if ( ! function_exists( 'arbah_random_posts' ) ) :
	/**
	 * Show random posts
	 */
	function arbah_random_posts($number_of_posts) { ?>
		
		<div class="random-posts clear arbah-slider">								
				<?php 
					global $post;
				
						$random_posts = new WP_Query( apply_filters(
							'arbah_random_posts_args', array(
						        'posts_per_page'		=>	$number_of_posts,
						        'post_status'			=>	'publish',
						        'orderby'				=>	'rand',
						        'post__not_in'			=>	array($post->ID),
						        'ignore_sticky_posts'	=>	true,
						        'meta_query' => array(
							        array(
								        'key' => '_thumbnail_id',
								        'compare' => 'EXISTS'
							        ),
								)
							) 
						) );
						
						if ($random_posts->have_posts()) :
							
							while ( $random_posts->have_posts() ) : $random_posts->the_post(); ?>
							
							<?php global $post; ?>
							
					    		<div class="slick-slide" style="background-image:url(<?php echo arbah_thumb_src( 'small-thumb' ); ?>);">
					    			<a href="<?php the_permalink(); ?>" rel="bookmark">

					    				<div class="text-cover">
					    					<h3><?php the_title(); ?></h3>
					    				</div><!--featured-text-->

					    			</a>
					    				
					    		</div>
    								
						<?php endwhile; ?>
								
				<?php endif; ?>
		
			<?php wp_reset_query(); ?>

		</div> <!-- /random-posts -->


		<?php if ( is_rtl() ) : ?>
			<script>
			jQuery(document).ready(function() {
				
			jQuery('.random-posts').slick({
			rtl: true,
			dots: false,
			infinite: true,
			speed: 2000,
			slidesToShow: 12,
			slidesToScroll: 12,
			autoplaySpeed: 2000,
			prevArrow : '<span type="button" class="slick-prev fa fa-angle-left"></span>',
			nextArrow : '<span type="button" class="slick-next fa fa-angle-right"></span>',
			responsive: [
			  {
			    breakpoint: 1239,
			    settings: {
			      slidesToShow: 9,
			      slidesToScroll: 9,
			      infinite: true,
			        dots: false,
				autoplaySpeed: 2000,
				}
			  },
			  {
			    breakpoint: 991,
			    settings: {
			    	slidesToShow: 6,
			    	slidesToScroll: 6,
			    	infinite: true,
			        dots: false,
					autoplaySpeed: 2000,
					arrows: false,
				}
			  },
			  {
			    breakpoint: 568,
			    settings: {
			    	arrows: false,
			    	slidesToShow: 3,
			    	slidesToScroll: 3,
			    	infinite: true,
			        autoplay: true,
					autoplaySpeed: 2000,
					arrows: false,
			    }
			  }
			]
			});

			});
			</script>
			<?php else : ?>
			<script>
			jQuery(document).ready(function() {

			jQuery('.random-posts').slick({
			dots: false,
			infinite: true,
			speed: 2000,
			slidesToShow: 12,
			slidesToScroll: 12,
			autoplaySpeed: 2000,
			prevArrow : '<span type="button" class="slick-prev fa fa-angle-left"></span>',
			nextArrow : '<span type="button" class="slick-next fa fa-angle-right"></span>',
			responsive: [
			  {
			    breakpoint: 1239,
			    settings: {
			      slidesToShow: 9,
			      slidesToScroll: 9,
			      infinite: true,
			        dots: false,
				autoplaySpeed: 2000,
				}
			  },
			  {
			    breakpoint: 991,
			    settings: {
			    	slidesToShow: 6,
			    	slidesToScroll: 6,
			    	infinite: true,
			        dots: false,
					autoplaySpeed: 2000,
					arrows: false,
				}
			  },
			  {
			    breakpoint: 568,
			    settings: {
			    	arrows: false,
			    	slidesToShow: 3,
			    	slidesToScroll: 3,
			    	infinite: true,
			        autoplay: true,
					autoplaySpeed: 2000,
					arrows: false,
			    }
			  }
			]
			});

			});

			</script>
	<?php endif;
	}
endif;

if ( ! function_exists( 'arbah_related_posts' ) ) :
	/**
	 * Show related posts
	 */
	function arbah_related_posts($number_of_posts) { ?>
		<div class="related-posts clear">
			<p class="related-posts-title"><?php _e('Read Next','arbah'); ?></p>	
			<?php // Check for posts in the same category
				
			global $post;
			$cat_ID = array();
			$categories = get_the_category();
			foreach($categories as $category) {
				array_push($cat_ID,$category->cat_ID);
			}
			
		
			$related_posts = new WP_Query( apply_filters(
			'arbah_related_posts_args', array(
			        'posts_per_page'		=>	$number_of_posts,
			        'post_status'			=>	'publish',
			        'category__in'			=>	$cat_ID,
			        'post__not_in'			=>	array($post->ID),
			        'meta_key'				=>	'_thumbnail_id',
			        'ignore_sticky_posts'	=>	true,
			        
			) ) );
			
			if ($related_posts->have_posts()) : ?>
				
				<div class="related-post-wrap" >

				<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				
				<?php global $post; ?>

				
					<div class="single-entry" >
					
						<a href="<?php the_permalink(); ?>" class="link-box">
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="post-thumbnail">
										<img class="lazy-img" src='<?php echo arbah_thumb_src( 'feat-thumb' ); ?>' alt='<?php the_title(); ?>'  title='<?php the_title(); ?>'>
									</figure><!-- .post-thumbnail -->
								<?php endif ?>
							<h3 class="post-title"><?php the_title(); ?></h3>
						</a>
					</div>
					
				<?php endwhile; ?>

				</div>
			
			<?php else: // If there are no other posts in the post categories, get random posts ?>

				<?php
					
				$related_posts = new WP_Query( apply_filters(
				'arbah_related_posts_args', array(
				        'posts_per_page'		=>	$number_of_posts,
				        'post_status'			=>	'publish',
				        'orderby'				=>	'rand',
				        'post__not_in'			=>	array($post->ID),
						'meta_key'				=>	'_thumbnail_id',
				        'ignore_sticky_posts'	=>	true
				) ) );
				
				if ($related_posts->have_posts()) : ?>

					<div class="related-post-wrap" >

					<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
						
						<?php global $post; ?>

						
						<div class="single-entry" >
					
						<a href="<?php the_permalink(); ?>" class="link-box">
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="post-thumbnail">
										<img class="lazy-img" src='<?php echo arbah_thumb_src( 'feat-thumb' ); ?>' alt='<?php the_title(); ?>'  title='<?php the_title(); ?>'>
									</figure><!-- .post-thumbnail -->
								<?php endif ?>
							<h3 class="post-title"><?php the_title(); ?></h3>
						</a>
					</div>
							
					<?php endwhile; ?>

				</div>
				
				<?php endif; ?>
							
			<?php endif; ?>

			<?php wp_reset_query(); ?>

		</div> <!-- /related-posts -->
		<?php
	}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function arbah_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'arbah_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'arbah_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so arbah_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so arbah_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in arbah_categorized_blog.
 */
function arbah_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'arbah_categories' );
}
add_action( 'edit_category', 'arbah_category_transient_flusher' );
add_action( 'save_post',     'arbah_category_transient_flusher' );


if ( ! function_exists( 'arbah_first_category' ) ) :
	/**
	 * display login form in menu
	 *
	 */
	function arbah_first_category() { 
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
		    echo '<h4 class="post-cat">' . esc_html( $categories[0]->name ) . '</h4>';
		}
	}
endif; 

if ( !function_exists( 'arbah_excerpt' ) ) :
	/**
	 * Add Content Limit.
	 *
	 */
	function arbah_excerpt($limit) {

		$excerpt = explode(' ', get_the_excerpt(), $limit);

		if (count($excerpt)>=$limit) {

			array_pop($excerpt);

			$excerpt = implode(" ",$excerpt).'...';

		  } else {

			$excerpt = implode(" ",$excerpt);

		}

		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

		return $excerpt;

	}
endif;



if ( !function_exists( 'arbah_social_profiles' ) ) :
	/**
	 * Add social profiles
	 *
	 */
	function arbah_social_profiles() {

		$social_title = get_theme_mod( 'social_title' );
		$facebook_url = get_theme_mod( 'facebook_url' );
		$twitter_url = get_theme_mod( 'twitter_url' );
		$whatsapp_url = get_theme_mod( 'whatsapp_url' );
		$youtube_url = get_theme_mod( 'youtube_url' );
		$linkedin_url = get_theme_mod( 'linkedin_url' );
		$instagram_url = get_theme_mod( 'instagram_url' );
		
		if ( $facebook_url || $twitter_url || $whatsapp_url || $youtube_url || $linkedin_url || $instagram_url ) : ?>
			<div class="social-icons">
				<p class="social-title"><?php echo $social_title; ?></p>
				<ul>
					<?php if ( false  !== $facebook_url && '' !== $facebook_url  ) : ?>
						<li class="social-facebook" ><a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<?php endif; ?>

					<?php if ( false  !== $twitter_url && '' !== $twitter_url ) : ?>
						<li class="social-twitter" ><a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
					<?php endif; ?>

					<?php if ( false  !== $whatsapp_url && '' !== $whatsapp_url ) : ?>
						<li class="social-whatsapp" ><a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" ><i class="fa fa-whatsapp"></i></span></a></li>
					<?php endif; ?>

					<?php if ( false  !== $instagram_url && '' !== $instagram_url) : ?>
						<li class="social-instagram"><a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
					<?php endif; ?>

					<?php if ( false  !== $youtube_url && '' !== $youtube_url ) : ?>
						<li class="social-youtube" ><a href="<?php echo esc_url( $youtube_url ); ?>" target="_blank" ><i class="fa fa-youtube"></i></a></li>
					<?php endif; ?>

					<?php if ( false  !== $linkedin_url && '' !== $linkedin_url ) : ?>
						<li class="social-linkedin" ><a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
					<?php endif; ?>	
						
				</ul> 
			</div><!-- .social-icons -->
		<?php endif; 
	}
endif;




if ( get_theme_mod('arbah_adblock_detector', '0') == 1 ) :
	/**
	 * Ad Blocker
	 */
	function ad_blocker(){

		 ?>

			<div id="arbah-popup-adblock" class=" arbah-popup">
				<div class="arbah-popup-container">
					<div class="arbah-popup-wrapper">
					<span class="fa fa-ban" aria-hidden="true"></span>
					<h2><?php esc_html_e( 'Adblock Detected', 'arbah' ) ?></h2>
					<div class="adblock-message"><?php echo get_theme_mod("arbah_adblock_notice"); ?></div>
					</div>
				</div>
			</div><!-- .arbah-popup /-->
			<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/advertisement.js'></script>
		<?php
	
	}
	add_action( 'wp_footer', 'ad_blocker' );
endif;

