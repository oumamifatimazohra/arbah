<?php

if ( ! function_exists( 'arbah_import_files' ) ) :
function arbah_import_files() {
  return array(
    array(
      'import_file_name'             => 'Arbah',
      'local_import_file'            => trailingslashit( get_template_directory() ) . '/inc/import/demo-1/arbah-content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/inc/import/demo-1/arbah-widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . '/inc/import/demo-1/arbah-customizer.dat',
      'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . '/inc/import/demo-1/arbah-screenshot.jpg',
      'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'arbah' ),
    )


  );
}
add_filter( 'pt-ocdi/import_files', 'arbah_import_files' );
endif;

if ( ! function_exists( 'arbah_after_import' ) ) :
function arbah_after_import( $selected_import ) {
        
        //Set Menu

        $main_menu = get_term_by('name', 'main-menu', 'nav_menu');
        $footer_menu = get_term_by('name', 'footer-menu', 'nav_menu');
        set_theme_mod( 'nav_menu_locations' , 
           array( 
              'primary' => $main_menu->term_id,
              'footer-menu' => $footer_menu->term_id,  
           ) 
        );
 
       // Assign front page.
          update_option( 'show_on_front', 'posts' );
}
endif;

add_action( 'pt-ocdi/after_import', 'arbah_after_import' );

function arbah_ocdi_plugin_page_setup( $default_settings ) {
  $default_settings['parent_slug'] = 'themes.php';
  $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'arbah' );
  $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'arbah' );
  $default_settings['capability']  = 'import';
  $default_settings['menu_slug']   = 'pt-one-click-demo-import';

  return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'arbah_ocdi_plugin_page_setup' );

function arbah_ocdi_plugin_intro_text( $default_text ) {
  $default_text = '<div class="ocdi__intro-text"><h3>' . esc_html__( 'Importing demo data will remove all your files' , 'arbah' ) .'</h3></div>';

  return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'arbah_ocdi_plugin_intro_text' );


add_action( 'pt-ocdi/before_content_import', 'ocdi_before_content_import' );


add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

add_filter( 'pt-ocdi/enable_grid_layout_import_popup_confirmation', '__return_false' );



