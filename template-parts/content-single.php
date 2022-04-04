<?php
/**
 * Template part for displaying single posts.
 *
 * @package arbah
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clear'); ?>>
	<header class="entry-header">
		
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
		?>
	
		<div class="entry-meta">
			<?php arbah_post_meta(); ?>
		</div><!-- .entry-meta -->

		<?php if ( get_theme_mod('arbah_adze_post', '') ) : ?>
			<div class="post-title-adze"> 
				<?php echo get_theme_mod('arbah_adze_post'); ?>
			</div>
		<?php endif; ?>

		<?php if (  get_theme_mod('hide_feat_img', '0') == 0 ) :  ?>
			<figure class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</figure>
		<?php endif; ?>
		
		<?php if ( get_theme_mod('show_social_inside_posts', '1') == 1 ) { arbah_social_bookmarks(); } ?>
	</header><!-- .entry-header -->
			
	<div class="article-content">
		<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'arbah' ),
				'after'  => '</div>',
			) );
		?>
		</div><!-- .entry-content -->
		
	</div><!-- .article-content -->

	<?php if ( get_theme_mod('arbah_adze_readmore', '') && get_post_meta( get_the_ID(), 'arbah_readmore_button', true ) ) : ?>
		<div class="read-more-adze">
			<?php echo get_theme_mod('arbah_adze_readmore'); ?>
		</div>
	<?php endif; ?>

	<footer class="entry-footer clear">
		
		<?php if ( has_tag() ) : ?>
		
			<div class="post-tags">
				<?php the_tags('',''); ?>
				
			</div>
		
		<?php endif; ?>

		<?php if ( get_theme_mod('show_social_inside_posts', '1') == 1 ) { arbah_social_bookmarks(); } ?>	


		<?php if ( get_theme_mod('show_author_box', '0') == 1 ) {
			get_template_part( 'template-parts/author-bio' ); 
		} ?>				
		
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
