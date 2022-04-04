<?php
/**
 * Theme header
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arbah
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="fly-menu-wrap">

		<div class="fly-menu-close">
			<div class="nav-toggle">
				<div class="bars">
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
				</div>
			</div> <!-- /nav-toggle -->
		</div>
		<div class="fly-menu-container">
			<nav class="secondary-navigation">
				<?php wp_nav_menu( array( 
					'theme_location' => 'secondary', 
					'fallback_cb'   => 'wp_page_menu',
					) ); 
				?>
			</nav><!-- #site-navigation -->
		</div>
		<div class="fly-menu-social">
			<?php  arbah_social_profiles(); ?>
		</div>
						
	</div><!-- .fly-menu-wrap -->
	<div class="fly-menu-fade"></div>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'arbah' ); ?></a>

	<?php if ( get_theme_mod('arbah_adze_responsive', '') ) : ?>
		<div class="hero-adze clear"> 
			<?php echo get_theme_mod('arbah_adze_responsive'); ?>
		</div>
	<?php endif; ?>
	
	<header id="masthead" class="site-header" role="banner" >
		
		<div class="inner-wrapper">
			
			<div class="container clear">
				
				<div class="site-branding" >
					
					<?php 
					
					if (!has_custom_logo()) {
						if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						    <?php
						endif;

					    $description = get_bloginfo( 'description', 'display' );
					    if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					        <?php
					    endif;      
					
					} else {		
						the_custom_logo();					
					} ?>
				</div><!-- .site-branding -->
				
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<nav id="main-nav" class="main-navigation">
						<?php
							wp_nav_menu(array(
								'theme_location' => 'primary',
								'menu_id' => 'primary-menu' , 
								'depth' => 10, 
								'walker' => new arbah_super_menu()
							));
						?>
					</nav>
				<?php endif; ?>
				  
				<div class="nav-toggle">
					<div class="bars">
						<div class="bar"></div>
						<div class="bar"></div>
						<div class="bar"></div>
					</div>
				</div> <!-- /nav-toggle -->

				<div class="search-toggle" >
					<i class="searching-icon fa fa-search"></i>
				</div>


			</div><!-- .container -->
		
		</div><!-- .inner-wrapper -->
	
	</header><!-- #masthead -->

	<div class="header-search-bar">
		<div id="header-search">
           <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" >
				<input type="text" class="search-input" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search this website', 'arbah' ); ?>&#8230;" name="s"  />
				<button  type="submit"   class="search-icon" ><i class="fa fa-search"></i></button>
				<span class="fa fa-close close-search"></span>
			</form>
    	</div> 
	</div>
	
	<?php if ( is_front_page()  &&  get_theme_mod('show_homepage_slider', '1' ) == 1 ) {
		get_template_part( 'template-parts/header-slider' ); 
	} ?>

	<?php if ( is_single() && ( get_theme_mod('show_random_posts_slider', '1') == 1 )  ) {
		$posts_numb = get_theme_mod('arbah_random_post_numb', '24');
		arbah_random_posts($posts_numb); 
	} ?> 

	<?php if ( get_theme_mod('arbah_adze_header_bottom', '') ) : ?>
		<div class="header-bottom-adze clear"> 
			<?php echo get_theme_mod('arbah_adze_header_bottom'); ?>
		</div>
	<?php endif; ?>


	<?php if (  get_theme_mod('arbah_adze_fixed') ) : ?>
		<div id="fixed-adze"> 
			<a id="fixed-adze-close">
				<i class="fa fa-times"></i>
			</a>
			<div class="fixed-adze-wrap">
				<?php echo get_theme_mod('arbah_adze_fixed'); ?>
			</div>
		</div>
	<?php endif; ?>
			

	<div id="content" class="site-content">
		