/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Brand Color
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			$( 'a, a:hover, a:focus, a:active, .home-posts-title, .related-posts-title, #secondary .widget-title, .secondary-navigation a:hover, a.link-box:hover .more-btn, a.link-box:hover .post-title, .arbah-slider .slick-prev, .arbah-slider .slick-next, .sub-menu-wrapper li:hover .small-title a  ' ).css( 'color', to );
			$( '.nav-toggle, .search-toggle .searching-icon, .text-cover, a[data-readmore-toggle], .prev-next-posts .page-link , #smoothup, .fly-menu-social .social-icons a, .sidebar-post-img:after, button, input[type="button"], input[type="reset"], input[type="submit"], .post-cat, .comments-title .fa, .pagination .page-numbers:hover, .pagination .page-numbers.dots:hover, .text-box h3 ').css( 'background-color', to );
		} );
	} );
	
} )( jQuery );
