<?php 
/**
 * Arbah Super menu
**/ 
?>
<?php
class arbah_super_menu extends Walker_Nav_Menu {
	
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "\n<ul class=\"menu-links inside-menu\">\n";
	}
	
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "</ul>\n";
	}
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		global $wp_query;
		$cat = $item->object_id;
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item ) );
		$class_names = ' class="' . esc_attr ( $class_names ) .'"';
		
		$output .= $indent . '<li id="menu-item-exm1' . $item->ID . '"' . $value . $class_names . '>';
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . ' title="'.esc_attr($item->title).'" class="menu-link">';
		$item_output .= $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';	
		
		$parent_tax = get_post_meta( $item->menu_item_parent, '_menu_item_object', true );
		$children = get_posts ( array (
				'post_type' => 'nav_menu_item',
				'nopaging' => true,
				'numberposts' => 1,
				'meta_key' => '_menu_item_menu_item_parent',
				'meta_value' => $item->ID ,
		) );		
				
		if ($depth == 0 && $item->object == 'category' && ! empty ( $children )) {
			$item_output .= '<div class="sub-menu-wrapper">';
		} elseif (! empty ( $children )) {
			$item_output .= '<div class="sub-meni">';
		} elseif ($depth == 0 && $item->object == 'category' && empty ( $children )) {
			$item_output .= '<div class="sub-menu-wrapper no-children">';
		} elseif ($depth == 1 && $item->object == 'category' && ! empty ( $children ) && $parent_tax == 'category') {
		}
		$item_output .= $args->after;				
		//if ($depth == 0 && empty ( $children ) && $item->object == 'category' ) {
		//} 
	
		if ($depth < 2 && $item->object == 'category' )  {
				  if ($parent_tax == 'category' || $parent_tax == ''){
						$cat = $item->object_id;		
						global $post;
						if ($depth < 1 && empty ( $children )){
						$menuposts = get_posts ( array('numberposts' => 6, 'cat' => $cat ));
						$item_output .= '<div class="sub-menu six-menu">';											
						}else{
						$menuposts = get_posts ( array('numberposts' => 5, 'cat' => $cat ));
						$item_output .= '<div class="sub-menu five-menu">';	
						}	
						$item_output .= '<ul class="small-category">';	
						foreach ( $menuposts as $post ) :
							setup_postdata ( $post );			
							$post_title = wp_trim_words( get_the_title(), 10 );
							$post_link = get_permalink ();
							$post_image = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), "small-thumb" );
							$menu_post_image = arbah_thumb_src( 'small-thumb' ); ;			
							$item_output .= '<li class="">
							<a href="' . esc_url($post_link) . '" >
								<div class="small-image" style="background-image:url('.$menu_post_image.');">				
									
								</div></a><!--small-image-->
								<div class="small-text">																		
									<div class="small-title">
										<h2><a href="' . esc_url($post_link) . '" >' . esc_html($post_title) . '</a></h2>
									</div><!--small-title-->
								</div>
								<!--small-text-->
							</li>';
						endforeach;
						wp_reset_postdata();			
						$item_output .= '</ul></div>';
						
				  
				  }
			  } 
		elseif ($depth == 0 && $item->object != 'category') {
		}	

		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function end_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		$children = get_posts ( array (
				'post_type' => 'nav_menu_item',
				'nopaging' => true,
				'numberposts' => 1,
				'meta_key' => '_menu_item_menu_item_parent',
				'meta_value' => $item->ID ,
		) );
		if (! empty ( $children )||($depth == 0 && $item->object == 'category' && empty ( $children ))) {$output .= '</div>';}
		$output .= "</li>\n";
	}
}