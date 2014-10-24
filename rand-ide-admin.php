<?php
add_action('admin_enqueue_scripts', 'rand_admin_scripts', 11);

function rand_admin_scripts() {
	wp_register_script('rand-ide', plugins_url('js/rand-ide.js', __FILE__));
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('jquery-ui-core', '//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
	wp_enqueue_script( 'rand-ide');
}

add_action('admin_menu', 'rand_add_menus', 12);
function rand_add_menus() {
	$member_credits = add_submenu_page('idc', __('Rand IDE Settings', 'randide'), __('Rand IDE Settings', 'randide'), 'manage_options', 'rand_settings', 'rand_settings');
}

function rand_settings() {
	$member = new ID_Member();
	if (isset($_POST['rand_submit'])) {
		// Getting all the allowed users whose credits could be added
		$users = array_reverse($member->get_allowed_users());
		// Looping the users and updating their credits
		foreach ($users as $user) {
			ID_Member::add_credits($user->user_id, $_POST['user_credits']);
		}

		echo '<div id="message" class="updated">'.__('Credits saved for all users', 'randide').'</div>';
	}

	// Getting the option if stored before
	$default_proj_end_date = get_option( "ign_default_project_end_date" );
	if (isset($_POST['rand_proj_date_submit'])) {
		// Saving the field in options
		update_option( "ign_default_project_end_date", $_POST['default_project_end_date'] );
		$default_proj_end_date = $_POST['default_project_end_date'];

		// Updating all the projects ending dates
		$projects = ID_Project::get_project_posts();
		// Looping those posts and updating their end date in post meta
		foreach ($projects as $project) {
			update_post_meta($project->ID, 'ign_fund_end', $default_proj_end_date);
		}
	}

	include_once 'templates/admin/_randSettings.php';
}
?>