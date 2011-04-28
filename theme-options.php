<?php

// Default options values
$html5press_options = array(
	'back_to_top' => true,
	'featured_image_size' => 'large'
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function html5press_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'html5press_theme_options', 'html5press_options', 'html5press_validate_options' );
}

add_action( 'admin_init', 'html5press_register_settings' );

// Store image sizes in array
$html5press_image_sizes = array(
	'full' => array(
		'value' => 'full',
		'label' => 'Full'
	),
	'large' => array(
		'value' => 'large',
		'label' => 'Large'
	),
	'medium' => array(
		'value' => 'medium',
		'label' => 'Medium'
	),
	'thumbnail' => array(
		'value' => 'thumbnail',
		'label' => 'Thumbnail'
	)
);

function html5press_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'HTML5Press Options', 'HTML5Press Options', 'edit_theme_options', 'theme_options', 'html5press_theme_options_page' );
}

add_action( 'admin_menu', 'html5press_theme_options' );

// Function to generate options page
function html5press_theme_options_page() {
	global $html5press_options, $html5press_image_sizes;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>"; ?>

	<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved', 'html5press' ); ?></strong></p></div>
	<?php endif; ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'html5press_options', $html5press_options ); ?>
	
	<?php settings_fields( 'html5press_theme_options' ); ?>

	<table class="form-table">

	<tr valign="top"><th scope="row">"Back to Top" Button</th>
	<td>
	<input type="checkbox" id="back_to_top" name="html5press_options[back_to_top]" value="1" <?php checked( true, $settings['back_to_top'] ); ?> />
	<label for="back_to_top">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="featured_image_size">Linked Featured Image Size</label></th>
	<td>
	<select id="featured_image_size" name="html5press_options[featured_image_size]">
	<?php
	foreach ( $html5press_image_sizes as $images ) :
		$label = $images['label'];
		$selected = '';
		if ( $images['value'] == $settings['featured_image_size'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $images['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function html5press_validate_options( $input ) {
	global $html5press_options,$html5press_image_sizes;

	$settings = get_option( 'html5press_options', $html5press_options );
	
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['featured_image_size'];
	if ( !array_key_exists( $input['featured_image_size'], $html5press_image_sizes ) )
		$input['featured_image_size'] = $prev;
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['back_to_top'] ) )
		$input['back_to_top'] = null;
	// We verify if the input is a boolean value
	$input['back_to_top'] = ( $input['back_to_top'] == 1 ? 1 : 0 );
	
	return $input;
}

endif;  // EndIf is_admin()
