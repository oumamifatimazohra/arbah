<?php
add_action( 'admin_init', 'arbah_cpt_post_add_metaboxes' );
add_action( 'save_post', 'arbah_cpt_post_update_meta' );

	if ( ! function_exists( 'arbah_cpt_post_add_metaboxes' ) ):
		function arbah_cpt_post_add_metaboxes() {
			add_meta_box( 'arbah-post-details', esc_html__( 'Post Options', 'arbah' ), 'arbah_add_post_details_meta_box', 'post', 'normal', 'high' );
		}
	endif;

	if ( ! function_exists( 'arbah_cpt_post_update_meta' ) ):
		function arbah_cpt_post_update_meta( $post_id ) {

			if ( ! arbah_can_save_meta( 'post' ) ) {
				return;
			}

			update_post_meta( $post_id, 'arbah_readmore_button', arbah_sanitize_checkbox_ref( $_POST['arbah_readmore_button'] ) );
		}
	endif;

	if ( ! function_exists( 'arbah_add_post_details_meta_box' ) ):
		function arbah_add_post_details_meta_box( $object, $box ) {
			arbah_prepare_metabox( 'post' );

			?><div class="at-cf-wrap"><?php
				arbah_metabox_open_tab( '' );
					arbah_metabox_checkbox( 'arbah_readmore_button', 1, esc_html__( "Display readmore button inside the post", 'arbah' ) );
				arbah_metabox_close_tab();
			?></div><?php

		}
	endif;



/**
 * Sanitizes a checkbox value. Value is passed by reference.
 *
 * Useful when sanitizing form checkboxes. Since browsers don't send any data when a checkbox
 * is not checked, arbah_sanitize_checkbox() throws an error.
 * arbah_sanitize_checkbox_ref() however evaluates &$input as null so no errors are thrown.
 *
 * @param int|string|bool &$input Input value to sanitize.
 * @return int|string Returns 1 if $input evaluates to 1, an empty string otherwise.
 */
function arbah_sanitize_checkbox_ref( &$input ) {
	if ( $input == 1 ) {
		return 1;
	}
	return '';
}

function arbah_metabox_checkbox( $fieldname, $value, $label, $params = array() ) {
	global $post;

	$defaults = array(
		'before'  => '<p class="at-field-group at-field-checkbox">',
		'after'   => '</p>',
		'default' => ''
	);
	$params = wp_parse_args( $params, $defaults );

	$custom_keys = get_post_custom_keys( $post->ID );

	if ( is_array( $custom_keys ) && in_array( $fieldname, $custom_keys ) ) {
		$checked = get_post_meta( $post->ID, $fieldname, true );
	} else {
		$checked = $params['default'];
	}

	echo $params['before'];
	?>
		<input type="checkbox" id="<?php echo esc_attr( $fieldname ); ?>" class="check" name="<?php echo esc_attr( $fieldname ); ?>" value="<?php echo esc_attr( $value ); ?>" <?php checked( $checked, $value ); ?> />
		<label for="<?php echo esc_attr( $fieldname ); ?>"><?php echo $label; ?></label>
	<?php
	echo $params['after'];
}

function arbah_metabox_open_tab( $title ) {
	?>
	<div class="at-cf-section">
		<?php if ( ! empty( $title ) ): ?>
			<h3 class="at-cf-title"><?php echo esc_html( $title ); ?></h3>
		<?php endif; ?>
		<div class="at-cf-inside">
	<?php
}

function arbah_metabox_close_tab() {
	?>
		</div>
	</div>
	<?php
}


function arbah_prepare_metabox( $post_type ) {
	wp_nonce_field( basename( __FILE__ ), $post_type . '_nonce' );
}

function arbah_can_save_meta( $post_type ) {
	global $post;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return false;
	}

	if ( ! isset( $_POST[ $post_type . '_nonce' ] ) or ! wp_verify_nonce( $_POST[ $post_type . '_nonce' ], basename( __FILE__ ) ) ) {
		return false;
	}

	$post_type_obj = get_post_type_object( $post->post_type );
	if ( ! current_user_can( $post_type_obj->cap->edit_post, $post->ID ) ) {
		return false;
	}

	return true;
}


/**
 * Adds additional user fields
 * more info: http://justintadlock.com/archives/2009/09/10/adding-and-using-custom-user-profile-fields
 */

add_action( 'show_user_profile', 'arbah_additional_user_fields' );
add_action( 'edit_user_profile', 'arbah_additional_user_fields' );


function arbah_get_attachment_id_from_url( $attachment_url ) {     
    global $wpdb;
    $attachment_id = false;
 
    // If there is no url, return.
    if ( '' == $attachment_url )
        return;
 
    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();
 
    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
        // Remove the upload path base directory from the attachment URL
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
    }     
    return $attachment_id;
}

function arbah_additional_user_fields( $user ) { 

	wp_nonce_field( basename( __FILE__ ), 'arbah_author_meta_nonce' );

	$user_img_url = get_the_author_meta( 'user_meta_image', $user->ID );
	$user_img_id = arbah_get_attachment_id_from_url( $user_img_url );
	$user_thumb_img_url = wp_get_attachment_image_src( $user_img_id, 'thumbnail', true );
?>
 
 
    <table class="form-table">
 
        <tr>
            <th><label for="user_meta_image"><?php esc_html_e( 'User Image', 'arbah' ); ?></label></th>
            <td>
                <!-- Outputs the image after save -->
                <img class="show-author-img" src="<?php echo esc_url( $user_thumb_img_url[0] ); ?>" style="width:150px;"><br />
                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
                <input type="text" name="user_meta_image" id="user_meta_image" value="<?php echo esc_url_raw( get_the_author_meta( 'user_meta_image', $user->ID ) ); ?>" class="regular-text" />
                <!-- Outputs the save button -->
                <input type='button' class="additional-user-image button-primary" value="<?php esc_html_e( 'Upload Image', 'arbah' ); ?>" id="uploadUserImage" /><br />



                <span class="description"><?php esc_html_e( 'Upload an additional image for your user profile.', 'arbah' ); ?></span>
            </td>
        </tr>
 
    </table><!-- end form-table -->
<?php } // arbah_additional_user_fields

/**
* Saves additional user fields to the database
*/
function arbah_save_additional_user_meta( $user_id ) {

	// Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'arbah_author_meta_nonce' ] ) || !wp_verify_nonce( $_POST[ 'arbah_author_meta_nonce' ], basename( __FILE__ ) ) ) {
        return;
    }
 
    // only saves if the current user can edit user profiles
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
 
    update_usermeta( $user_id, 'user_meta_image', $_POST['user_meta_image'] );
}
 

add_action( 'personal_options_update', 'arbah_save_additional_user_meta' );
add_action( 'edit_user_profile_update', 'arbah_save_additional_user_meta' );


$arbah_user_social_array = array(
    'behance' => __( 'Behance', 'arbah ' ),
    'dribbble' => __( 'Dribbble', 'arbah ' ),
    'facebook' => __( 'Facebook', 'arbah ' ),
    'flickr' => __( 'Flickr', 'arbah ' ),
    'github' => __( 'Github', 'arbah ' ),
    'instagram' => __( 'Instagram', 'arbah ' ),    
    'linkedin' => __( 'Linkedin', 'arbah ' ),
    'pinterest' => __( 'Pinterest', 'arbah ' ),
    'reddit' => __( 'Reddit', 'arbah ' ),
    'rss' => __( 'RSS', 'arbah ' ),
    'skype' => __( 'Skype', 'arbah ' ),
    'soundcloud' => __( 'Soundcloud', 'arbah ' ),
    'tumblr' => __( 'Tumblr', 'arbah ' ),
    'twitter' => __( 'Twitter', 'arbah ' ),
    'vimeo' => __( 'Vimeo', 'arbah ' ),
    'wordpress' => __( 'Woordpress', 'arbah ' ),
    'youtube' => __( 'Youtube', 'arbah ' )
);

add_filter( 'user_contactmethods', 'arbah_author_meta_contact' );

function arbah_author_meta_contact() {
    global $arbah_user_social_array;
    foreach( $arbah_user_social_array as $icon_id => $icon_name ) {
        $contactmethods[$icon_id] = $icon_name;
    }
    return $contactmethods;
}
