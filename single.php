<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package arbah
 */

get_header(); ?>


	<div id="primary" class="content-area <?php echo $entry_class; ?> ">

		<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' ); ?>

			<div id="arbah-comments-btn">
				<span class="comments-txt">
					<i class="fa fa-comments"></i>
					<?php
						printf( // WPCS: XSS OK.
								esc_html( _nx( 'One thought', '%1$s thoughts', get_comments_number(), 'comments title', 'arbah' ) ),
								number_format_i18n( get_comments_number() ),
								'<span>' . get_the_title() . '</span>'
							);
						?>
				</span>
			</div>

			<?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			if ( get_theme_mod('show_related_posts', '1') == 1 ) { arbah_related_posts(6); }

			
			// Calculate post views number
			setPostViews(get_the_ID()); 

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
