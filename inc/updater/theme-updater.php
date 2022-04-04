<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// The theme version to use in the updater
define( 'arbah_THEME_VERSION', wp_get_theme( 'arbah' )->get( 'Version' ) );

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://www.ar-themes.com', // Site where EDD is hosted
		'item_name'      => 'قالب أرباح', // Name of theme
		'theme_slug'     => 'arbah', // Theme slug
		'version'        => arbah_THEME_VERSION, // The current version of this theme
		'author'         => 'ar-themes.com', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'arbah' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'arbah' ),
		'license-key'               => __( 'License Key', 'arbah' ),
		'license-action'            => __( 'License Action', 'arbah' ),
		'deactivate-license'        => __( 'Deactivate License', 'arbah' ),
		'activate-license'          => __( 'Activate License', 'arbah' ),
		'status-unknown'            => __( 'License status is unknown.', 'arbah' ),
		'renew'                     => __( 'Renew?', 'arbah' ),
		'unlimited'                 => __( 'unlimited', 'arbah' ),
		'license-key-is-active'     => __( 'License key is active.', 'arbah' ),
		'expires%s'                 => __( 'Expires %s.', 'arbah' ),
		'expires-never'             => __( 'Lifetime License.', 'arbah' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'arbah' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'arbah' ),
		'license-key-expired'       => __( 'License key has expired.', 'arbah' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'arbah' ),
		'license-is-inactive'       => __( 'License is inactive.', 'arbah' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'arbah' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'arbah' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'arbah' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'arbah' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'arbah' ),
	)

);
