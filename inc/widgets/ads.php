<?php
/*
	Ads Widgets

*/

/*  Register widget
/* ------------------------------------ */
if ( ! function_exists( 'arbah_register_widget_ads' ) ) {

	function arbah_register_widget_ads() { 
		register_widget( "arbah_sidebar_adze_widget" );
	}
	
}
add_action( 'widgets_init', 'arbah_register_widget_ads' );



class arbah_sidebar_adze_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_sidebar_adze' );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'Sidebar Advertisement', 'arbah' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'adze_image_url' => '', 'adze_image_link' => '', 'ads_code' => '') );
      $title = esc_attr( $instance[ 'title' ] );

      $image_link = 'adze_image_link';
      $image_url = 'adze_image_url';

      $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
      $instance[ $image_url ] = esc_url( $instance[ $image_url ] );

      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'arbah' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement Images Here', 'arbah' ); ?></label>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'arbah' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'arbah' ); ?></label>

         <?php
         if ( $instance[ $image_url ] != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[ $image_url ] . 'preview') . '"src="' . $instance[ $image_url ] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'arbah' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( 'ads_code' ); ?>"><?php _e( 'Adsense code:', 'arbah' ); ?></label>
         <textarea id="<?php echo $this->get_field_id( 'ads_code' ); ?>" name="<?php echo $this->get_field_name( 'ads_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads_code'] ) ) echo $instance['ads_code']; ?></textarea>
      </p>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      $instance['ads_code'] = $new_instance['ads_code'] ;
     
      $image_link = 'adze_image_link';
      $image_url = 'adze_image_url';

      $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
      $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';

      $image_link = 'adze_image_link';
      $image_url = 'adze_image_url';

      $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
      $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

      echo $before_widget; ?>

      <div class="block-adze">
         <?php if ( !empty( $title ) ) { ?>
            <div class="block-adze-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_url ) ) {
               $output .= '<div class="block-adze-content">';
               if ( !empty( $image_link ) ) {
               $output .= '<a href="'.$image_link.'" class="single-block-adze" target="_blank" rel="nofollow">
                                    <img src="'.$image_url.'" width="300" height="250">
                           </a>';
               } else {
                  $output .= '<img src="'.$image_url.'" width="300" height="250">';
               }
               $output .= '</div>';
               echo $output;
               } 
            elseif  ( !empty( $ads_code ) ) { 
               $ads ='';
               $ads .= '<div class="block-adze-content"><div class="block-adze-inner">'. $ads_code .'</div></div>';
               echo $ads; 
            } ?>
      </div>
      <?php
      echo $after_widget;
   }
}
