<?php
/**
 * The template for displaying Author biography
 *
 */
?>
<?php 
	global $post;
    $author_id = $post->post_author;
    $author_avatar = get_avatar( $author_id, '70' );
    $author_nickname = get_the_author_meta( 'display_name' );
    $author_extra_img_url = get_the_author_meta( 'user_meta_image', $post->post_author );
    $arbah_author_website = get_the_author_meta( 'user_url' );
?>

<div class="author-info">
	<div class="author-bio clear">
		<div class="author-avatar">
			 <?php 
                if( !empty( $author_extra_img_url ) ) {
                    $author_img_id = arbah_get_attachment_id_from_url( $author_extra_img_url );
                    $author_thumb_img = wp_get_attachment_image_src( $author_img_id, 'thumbnail', true );
                    echo '<img src="'. esc_url( $author_thumb_img[0] ) .'" />';
                } else {
                    echo $author_avatar;
                }
            ?>
		</div><!-- .author-avatar -->
		
		<div class="author-description">
			<h3 class="author-name"><?php the_author_posts_link(); ?></h3>

			<div class="author-social clear">
                 <?php if( !empty( $arbah_author_website ) ) { ?>
                    <a href="<?php echo esc_url( $arbah_author_website ); ?>" target="_blank" class="admin-dec"><i class="fa fa-home"></i></a>
                <?php } ?>
                <?php 
                    global $arbah_user_social_array;
                    foreach( $arbah_user_social_array as $icon_id => $icon_name ) {
                        $author_social_link = get_the_author_meta( $icon_id );
                        if( !empty( $author_social_link ) ) {
                ?>
                            <span class="social-icon-wrap"><a href="<?php echo esc_url( $author_social_link )?>" target="_blank" title="<?php echo esc_attr( $icon_name )?>"><i class="fa fa-<?php echo esc_attr( $icon_id ); ?>"></i></a></span>
                <?php            
                        }
                    }
                ?>
            </div><!-- .author-social -->

			<p class="author-desc">
				<?php the_author_meta( 'description' ); ?>
			</p><!-- .author-bio -->

		</div><!-- .author-description -->
	</div><!-- .author-bio -->
</div><!-- .author-info -->
