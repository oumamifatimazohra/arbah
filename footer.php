<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arbah
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

 		<div class="footer-wrap">

			<div class="container clear">
				
				<div class="column onecol">

					<?php  arbah_social_profiles(); ?>
				</div><!-- .onecol -->

				<div class="column onecol">
					<div class="footer-navigation" class="clear">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container'=> '','menu_id'=> 'footer-menu','menu_class'=> 'clear','fallback_cb' => 'false','depth' => 1 ) ); ?>
			
					</div>
				</div>
				

				<div id="copyright"  class="column onecol">
								
					<?php
					if ( get_theme_mod('arbah_footer_text', '') ) :
						
						echo get_theme_mod('arbah_footer_text');
					
					else : 
							
							$copyright = '&copy; %year% %blogname%' ;
							$copyright = str_replace( '%year%', date( 'Y' ), $copyright );
							$copyright = str_replace( '%blogname%', get_bloginfo( 'name' ), $copyright );
							echo esc_html( $copyright ); 
							echo '<p id="designed-by">' . __( 'Developed by: ', 'arbah' ) . '<a href="https://www.ar-themes.com/" title="' . esc_attr( __( 'Arabic Themes', 'arbah' ) ) . '" rel="designer" ">' . esc_attr( __( 'Arabic Themes', 'arbah' ) ) . '</a></p>' ;
					endif; ?>

				</div><!-- #copyright -->

			</div><!-- .container -->

			<a href="#top" id="smoothup"><i class="fa fa-angle-up" ></i></a>

		
		</div><!-- .footer-wrap -->

	
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
