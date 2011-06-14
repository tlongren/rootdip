<?php

// Default options values
$html5press_options = array(
	'back_to_top' => true,
	'show_tagline' => true,
	'show_query_stats' => false,
	'featured_image_size' => 'large',
	'theme_color' => 'pink',
	'featured_cat' => '',
	'num_featured' => '5'
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

// Store categories in array
$html5press_categories[0] = array(
	'value' => 0,
	'label' => ''
);
$html5press_cats = get_categories(); $i = 1;
foreach( $html5press_cats as $html5press_cat ) :
	$html5press_categories[$html5press_cat->cat_ID] = array(
		'value' => $html5press_cat->cat_ID,
		'label' => $html5press_cat->cat_name
	);
	$i++;
endforeach;

// Store number of featured posts to show options
$html5press_num_featured_options = array(
	'5' => array(
		'value' => '5',
		'label' => '5'
	),
	'10' => array(
		'value' => '10',
		'label' => '10'
	),
	'15' => array(
		'value' => '15',
		'label' => '15'
	),
	'20' => array(
		'value' => '20',
		'label' => '20'
	)
);

// Store stylesheet choices in an array
$html5press_theme_colors = array(
	'pink' => array(
		'value' => 'pink',
		'label' => 'Pink'
	),
	'blue' => array(
		'value' => 'blue',
		'label' => 'Blue'
	),
	'green' => array(
		'value' => 'green',
		'label' => 'Green'
	),
	'red' => array(
		'value' => 'red',
		'label' => 'Red'
	),
	'black' => array(
		'value' => 'black',
		'label' => 'Black'
	)
);

function html5press_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'HTML5Press Options', 'HTML5Press Options', 'edit_theme_options', 'theme_options', 'html5press_theme_options_page' );
}

add_action( 'admin_menu', 'html5press_theme_options' );

// Function to generate options page
function html5press_theme_options_page() {
	global $html5press_options, $html5press_image_sizes, $html5press_categories, $html5press_num_featured_options, $html5press_theme_colors;

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

	<tr valign="top"><th scope="row"><label for="back_to_top">"Back to Top" Button</label></th>
	<td>
	<input type="checkbox" id="back_to_top" name="html5press_options[back_to_top]" value="1" <?php checked( true, $settings['back_to_top'] ); ?> />
	<label for="back_to_top">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="show_tagline">Show Tagline In Header</label></th>
	<td>
	<input type="checkbox" id="show_tagline" name="html5press_options[show_tagline]" value="1" <?php checked( true, $settings['show_tagline'] ); ?> />
	<label for="show_tagline">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="show_query_stats">Show Query Stats In Footer</label></th>
	<td>
	<input type="checkbox" id="show_query_stats" name="html5press_options[show_query_stats]" value="1" <?php checked( true, $settings['show_query_stats'] ); ?> />
	<label for="show_query_stats">Enabled</label>
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
	<tr valign="top"><th scope="row"><label for="theme_color">Theme Color</label></th>
	<td>
	<select id="theme_color" name="html5press_options[theme_color]">
	<?php
	foreach ( $html5press_theme_colors as $colors ) :
		$label = $colors['label'];
		$selected = '';
		if ( $colors['value'] == $settings['theme_color'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $colors['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="featured_cat">Featured Post Category</label></th>
	<td>
	<select id="featured_cat" name="html5press_options[featured_cat]">
	<?php
	foreach ( $html5press_categories as $category ) :
		$label = $category['label'];
		$selected = '';
		if ( $category['value'] == $settings['featured_cat'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $category['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="num_featured"># Featured Posts to Show</label></th>
	<td>
	<select id="num_featured" name="html5press_options[num_featured]">
	<?php
	foreach ( $html5press_num_featured_options as $featured ) :
		$label = $featured['label'];
		$selected = '';
		if ( $featured['value'] == $settings['num_featured'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $featured['value'] ) . '" ' . $selected . '>' . $label . '</option>';
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
	global $html5press_options, $html5press_image_sizes, $html5press_categories, $html5press_num_featured_options, $html5press_theme_colors;

	$settings = get_option( 'html5press_options', $html5press_options );
	
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['featured_cat'];
	// We verify if the given value exists in the categories array
	if ( !array_key_exists( $input['featured_cat'], $html5press_categories ) )
		$input['featured_cat'] = $prev;
		
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['num_featured'];
	// We verify if the given value exists in the categories array
	if ( !array_key_exists( $input['num_featured'], $html5press_num_featured_options ) )
		$input['num_featured'] = $prev;
		
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['theme_color'];
	if ( !array_key_exists( $input['theme_color'], $html5press_theme_colors ) )
		$input['theme_color'] = $prev;
	
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['featured_image_size'];
	if ( !array_key_exists( $input['featured_image_size'], $html5press_image_sizes ) )
		$input['featured_image_size'] = $prev;
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['show_tagline'] ) )
		$input['show_tagline'] = null;
	// We verify if the input is a boolean value
	$input['show_tagline'] = ( $input['show_tagline'] == 1 ? 1 : 0 );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['show_query_stats'] ) )
		$input['show_query_stats'] = null;
	// We verify if the input is a boolean value
	$input['show_query_stats'] = ( $input['show_query_stats'] == 1 ? 1 : 0 );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['back_to_top'] ) )
		$input['back_to_top'] = null;
	// We verify if the input is a boolean value
	$input['back_to_top'] = ( $input['back_to_top'] == 1 ? 1 : 0 );
	
	return $input;
}

endif;  // EndIf is_admin()
?>
