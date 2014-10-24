<?php
/*
Plugin Name: Rand IgnitionDeck Customization
URI: 
Description: An IgnitionDeck customization for Rand
Version: 1.0
Author: IgnitionDeck
Author URI: http://IgnitionDeck.com
License: GPL2
*/

include_once 'rand-ide-admin.php';

function randide_activate() {
	// If class ID_Member doesn't exist, deactivate the plugin
	if (!class_exists('ID_Member')) {
		deactivate_plugins($plugins_path.'rand-ide/rand-ide.php');
	}
}
register_activation_hook( __FILE__, 'randide_activate' );

/**
 * Hook to check ID_Member class exists, if yes then activate this plugin
 * randide_activate_check()
 */
function randide_activate_check() {
	// If class ID_Member doesn't exist, deactivate the plugin
	if (!class_exists('ID_Member')) {
		deactivate_plugins(plugin_basename(__FILE__));
	}
}
add_action( 'admin_init', 'randide_activate_check' );

/**
 * Deactivate this plugin if IDCommerce plugin is deactivated
 * detect_plugin_deactivation()
 */
function detect_plugin_deactivation( $plugin, $network_activation ) {
	if ($plugin == "idcommerce/idcommerce.php" ) {
		deactivate_plugins( plugin_basename(__FILE__) );
	}
}
add_action( 'deactivated_plugin', 'detect_plugin_deactivation', 10, 2 );

/**
 * Action to store the default project end date in case of Rand customization, called on Project Creation
 * It's a hook function called from ignitiondeck-enterprise.php
 */
function rand_set_project_end_date($user_id, $project_id, $post_id, $proj_args, $saved_levels, $project_fund_type) {
	// Getting the default end date from the options
	$default_proj_end_date = get_option( "ign_default_project_end_date" );

	// If date is not null, then update the meta to store that date
	if ($default_proj_end_date != "") {
		update_post_meta($post_id, 'ign_fund_end', $default_proj_end_date);
	}
}
//add_action('ide_fes_create', 'rand_set_project_end_date');

/**
 * Action to store the default project end date in case of Rand customization, called on Project Updation
 * It's a hook function called from ignitiondeck-enterprise.php
 * Though this action is not needed, but in case the user (creator) has tried to change it forcefully.
 */
function rand_update_project_end_date($user_id, $project_id, $post_id, $proj_args, $saved_levels, $project_fund_type) {
	// Getting the default end date from the options
	$default_proj_end_date = get_option( "ign_default_project_end_date" );

	// If date is not null, then update the meta to store that date
	if ($default_proj_end_date != "") {
		update_post_meta($post_id, 'ign_fund_end', $default_proj_end_date);
	}
}
//add_action('ide_fes_update', 'rand_update_project_end_date');

function rand_enqueue_scripts() {
	// If we are on the create_project page (FES form), then hide project end date field
    if ( (isset($_GET['create_project']) || isset($_GET['edit_project'])) && is_user_logged_in() ) {
    	// Check if default project end date is set and not Null
    	$default_proj_end_date = get_option( "ign_default_project_end_date" );
    	if (!empty($default_proj_end_date)) {
    		// Hiding project end date field using jQuery
    		wp_register_script('rand-ide', plugins_url('js/rand-ide.js', __FILE__));
    		wp_enqueue_script('jquery');
    		wp_enqueue_script( 'rand-ide');
    		$default_proj_end_date = get_option( "ign_default_project_end_date" );
    		wp_localize_script('rand-ide', 'randEndDate', $default_proj_end_date);
    	}
    }
}
add_action( 'wp_enqueue_scripts', 'rand_enqueue_scripts' );
?>