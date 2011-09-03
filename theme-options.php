<?php

// Default options values
$sa_options = array(
	'social_buttons' => false,
	'sidebar_feed' => true,
	'credits' => true,
	'compact_homepage' => false,
	'nav_view' => 'pills',
	'iubenda_id' => '',
	'back_to_main' => ''
);


if ( is_admin() ) : // Load only if we are viewing an admin page

function sa_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'sa_theme_options', 'sa_options', 'sa_validate_options' );
}

add_action( 'admin_init', 'sa_register_settings' );

// Store layouts views in array
$sa_nav = array(
	'pills' => array(
		'value' => 'pills',
		'label' => 'Pills style'
	),
	'tabs' => array(
		'value' => 'tabs',
		'label' => 'Tabs style'
	),
);


function sa_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'sa_theme_options_page' );
}

add_action( 'admin_menu', 'sa_theme_options' );



// Function to generate options page
function sa_theme_options_page() {
	global $sa_options, $sa_nav;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'sa_options', $sa_options ); ?>
	
	<?php settings_fields( 'sa_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->

	<tr valign="top"><th scope="row">Social Buttons</th>
	<td>
	<p>
		<input type="checkbox" id="social_buttons" name="sa_options[social_buttons]" value="1" <?php checked( true, $settings['social_buttons'] ); ?> />
		<label for="social_buttons">Enable social buttons after each post</label>
		<label for="social_buttons">Notice that if you enable the social buttons you require a Privacy Policy (see the following option)</label>
	</p>
	</td>
	</tr>

	<tr valign="top"><th scope="row">Privacy policy ID from <a href="http://www.iubenda.com">iubenda</a></th>
	<td>
	<p>
		<input id="iubenda_id" name="sa_options[iubenda_id]" type="text" value="<?php  esc_attr_e($settings['iubenda_id']); ?>" />
		<label for="iubenda_id">Paste here the privacy policy ID from iubenda.</label>
	</p>
	<p>
	<label for="iubenda_id">You can find it into the embedding code, within the URL (es. http://www.iubenda.com/privacy-policy/NUMERICID/ )</label> <br />
	<label for="iubenda_id">If you fill this field, the iubenda privacy policy icon will be embedded on the footer</label>
	</p>
	</td>
	</tr>
	
	<tr valign="top"><th scope="row">Back to the main website buttons</th>
	<td>
	<p>
		<input id="back_to_main" name="sa_options[back_to_main]" type="text" value="<?php  esc_attr_e($settings['back_to_main']); ?>" />
		<label for="back_to_main">Fill this field with the URL of your main website if you want to enable a button that points there on the header (include http://).</label>
	</p>
	</td>
	</tr>

	<tr valign="top"><th scope="row">Main navigation style</th>
	<td>
	<?php foreach( $sa_nav as $nav ) : ?>
	<input type="radio" id="<?php echo $nav['value']; ?>" name="sa_options[nav_view]" value="<?php esc_attr_e( $nav['value'] ); ?>" <?php checked( $settings['nav_view'], $nav['value'] ); ?> />
	<label for="<?php echo $nav['value']; ?>"><?php echo $nav['label']; ?></label><br />
	<?php endforeach; ?>
			<label for="nav_view">If you set up the primary navigation menu in the menu settings page, a navigation bar will appear after the header.</label>
			<label for="nav_view">This option lets you change the style of that navigation.</label>

	</td>
	</tr>
	
	<tr valign="top"><th scope="row">RSS sidebar button</th>
	<td>
	<p>
		<input type="checkbox" id="sidebar_feed" name="sa_options[sidebar_feed]" value="1" <?php checked( true, $settings['sidebar_feed'] ); ?> />
		<label for="sidebar_feed">Enable the RSS Feed link button on the sidebar</label>
	</p>
	</td>
	</tr>

	<tr valign="top"><th scope="row">Compact Home Page</th>
	<td>
	<p>
		<input type="checkbox" id="compact_homepage" name="sa_options[compact_homepage]" value="1" <?php checked( true, $settings['compact_homepage'] ); ?> />
		<label for="compact_homepage">Enable the compact home page (the first post is shown completely, the others only as list of titles)</label>
	</p>
	</td>
	</tr>

	<tr valign="top"><th scope="row">Credits</th>
	<td>
	<p>
		<input type="checkbox" id="credits" name="sa_options[credits]" value="1" <?php checked( true, $settings['credits'] ); ?> />
		<label for="credits">Enable the credits on the footer</label>
	</p>
	</td>
	</tr>

	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function sa_validate_options( $input ) {
	global $sa_options, $sa_nav;

	$settings = get_option( 'sa_options', $sa_options );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['social_buttons'] ) )
		$input['social_buttons'] = null;
	// We verify if the input is a boolean value
	$input['social_buttons'] = ( $input['social_buttons'] == 1 ? 1 : 0 );

	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['credits'] ) )
		$input['credits'] = null;
	// We verify if the input is a boolean value
	$input['credits'] = ( $input['credits'] == 1 ? 1 : 0 );

	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['sidebar_feed'] ) )
		$input['sidebar_feed'] = null;
	// We verify if the input is a boolean value
	$input['sidebar_feed'] = ( $input['sidebar_feed'] == 1 ? 1 : 0 );


	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['iubenda_id'] = wp_filter_nohtml_kses( $input['iubenda_id'] );
	$input['back_to_main'] = wp_filter_nohtml_kses( $input['back_to_main'] );

	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['nav_view'];
	// We verify if the given value exists in the layouts array
	if ( !array_key_exists( $input['nav_view'], $sa_nav ) )
		$input['nav_view'] = $prev;
	
	return $input;
}

endif;  // EndIf is_admin()