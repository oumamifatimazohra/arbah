<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package arbah
 */


?>


<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?> >
	
	<div class="post-inner clear"  >
		<a href="<?php the_permalink(); ?>" class="link-box">

			<div class="post-image"> 
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="post-thumbnail">
						<img class="lazy-img" src='<?php echo arbah_thumb_src( 'feat-thumb' ); ?>' alt='<?php the_title(); ?>'  title='<?php the_title(); ?>'>
					</figure><!-- .post-thumbnail -->
					<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-play"></i></span>'; ?>
    				<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-volume-up"></i></span>'; ?>
    				<?php if ( is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-star"></i></span>'; ?>
    			<?php else: ?>
    				<div class="no-image"></div>
				<?php endif ?>
			</div>

			<div class="post-info">
				<?php arbah_first_category(); ?>

				<h3 class="post-title"><?php the_title(); ?></h3>
				<div class="post-excerpt"><?php echo arbah_excerpt(25); ?></div>
				<span class="more-btn"><?php _e('Continue Reading', 'arbah'); ?></span>
				
			</div>

		</a>
	</div>

</article><!-- #post-## -->
