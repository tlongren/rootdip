<?php
/**
 * Returns the default options for RootDip
 */
function rootdip_get_default_options() {
	return array(
		'back_to_top' => true,
		'show_tagline' => true,
		'enable_slimbox' => false,
		'show_query_stats' => false,
		'fuzzy_timestamps' => false,
		'maintenance_mode' => false,
		'featured_image_size' => 'large',
		'theme_color' => 'black',
		'theme_font' => 'open-sans',
		'featured_cat' => '',
		'num_featured' => '5',
		'custom_css' => '',
		'homepage_article_summary' => false
	);
}

/**
 * Returns the options array for RootDip.
 */
function rootdip_get_options() {
	return get_option( 'rootdip_options', rootdip_get_default_options() );
}


if ( is_admin() ) : // Load only if we are viewing an admin page

function rootdip_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'rootdip_theme_options', 'rootdip_options', 'rootdip_validate_options' );
}

add_action( 'admin_init', 'rootdip_register_settings' );

// Store image sizes in array
$rootdip_image_sizes = array(
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
$rootdip_categories[0] = array(
	'value' => 0,
	'label' => ''
);
$rootdip_cats = get_categories(); $i = 1;
foreach( $rootdip_cats as $rootdip_cat ) :
	$rootdip_categories[$rootdip_cat->cat_ID] = array(
		'value' => $rootdip_cat->cat_ID,
		'label' => $rootdip_cat->cat_name
	);
	$i++;
endforeach;
$rootdip_categories[10000] = array(
	'value' => 10000,
	'label' => 'All Categories'
);

// Store number of featured posts to show options
$rootdip_num_featured_options = array(
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
$rootdip_theme_colors = array(
	'pink' => array(
		'value' => 'pink',
		'label' => 'Pink'
	),
	'black' => array(
		'value' => 'black',
		'label' => 'Black'
	),
	'blue' => array(
		'value' => 'blue',
		'label' => 'Blue'
	),
	'bluishpurple' => array(
		'value' => 'bluishpurple',
		'label' => 'Bluish Purple'
	),
	'green' => array(
		'value' => 'green',
		'label' => 'Green'
	),
	'orange' => array(
		'value' => 'orange',
		'label' => 'Orange'
	),
	'red' => array(
		'value' => 'red',
		'label' => 'Red'
	)
);

// Store font choices in an array
$rootdip_theme_fonts = array(
	'open-sans' => array(
		'value' => 'open-sans',
		'label' => 'Open Sans'
	),
	'abel' => array(
		'value' => 'abel',
		'label' => 'Abel'
	),
	'aclonica' => array(
		'value' => 'aclonica',
		'label' => 'Aclonica'
	),
	'allerta' => array(
		'value' => 'allerta',
		'label' => 'Allerta'
	),
	'amaranth' => array(
		'value' => 'amaranth',
		'label' => 'Amaranth'
	),
	'antic' => array(
		'value' => 'antic',
		'label' => 'Antic'
	),
	'architects-daughter' => array(
		'value' => 'architects-daughter',
		'label' => 'Architects Daughter'
	),
	'cabin' => array(
		'value' => 'cabin',
		'label' => 'Cabin'
	),
	'calligraffitti' => array(
		'value' => 'calligraffitti',
		'label' => 'Calligraffitti'
	),
	'carter-one' => array(
		'value' => 'carter-one',
		'label' => 'Carter One'
	),
	'cherry-cream-soda' => array(
		'value' => 'cherry-cream-soda',
		'label' => 'Cherry Cream Soda'
	),
	'comfortaa' => array(
		'value' => 'comfortaa',
		'label' => 'Comfortaa'
	),
	'coming-soon' => array(
		'value' => 'coming-soon',
		'label' => 'Coming Soon'
	),
	'days-one' => array(
		'value' => 'days-one',
		'label' => 'Days One'
	),
	'droid-serif' => array(
		'value' => 'droid-serif',
		'label' => 'Droid Serif'
	),
	'give-you-glory' => array(
		'value' => 'give-you-glory',
		'label' => 'Give You Glory'
	),
	'gloria-hallelujah' => array(
		'value' => 'gloria-hallelujah',
		'label' => 'Gloria Hallelujah'
	),
	'hammersmith-one' => array(
		'value' => 'hammersmith-one',
		'label' => 'Hammersmith One'
	),
	'im-fell-great-primer-sc' => array(
		'value' => 'im-fell-great-primer-sc',
		'label' => 'IM Fell Great Primer SC'
	),
	'istok-web' => array(
		'value' => 'istok-web',
		'label' => 'Istok Web'
	),
	'julee' => array(
		'value' => 'julee',
		'label' => 'Julee'
	),
	'jura' => array(
		'value' => 'jura',
		'label' => 'Jura'
	),
	'just-another-hand' => array(
		'value' => 'just-another-hand',
		'label' => 'Just Another Hand'
	),
	'lato' => array(
		'value' => 'lato',
		'label' => 'Lato'
	),
	'lobster-two' => array(
		'value' => 'lobster-two',
		'label' => 'Lobster Two'
	),
	'neucha' => array(
		'value' => 'neucha',
		'label' => 'Neucha'
	),
	'news-cycle' => array(
		'value' => 'news-cycle',
		'label' => 'News Cycle'
	),
	'nothing-you-could-do' => array(
		'value' => 'nothing-you-could-do',
		'label' => 'Nothing You Could Do'
	),
	'numans' => array(
		'value' => 'numans',
		'label' => 'Numans'
	),
	'nunito' => array(
		'value' => 'nunito',
		'label' => 'Nunito'
	),
	'patrick-hand' => array(
		'value' => 'patrick-hand',
		'label' => 'Patrick Hand'
	),
	'pt-sans-narrow' => array(
		'value' => 'pt-sans-narrow',
		'label' => 'PT Sans Narrow'
	),
	'quattrocento-sans' => array(
		'value' => 'quattrocento-sans',
		'label' => 'Quattrocento Sans'
	),
	'questrial' => array(
		'value' => 'questrial',
		'label' => 'Questrial'
	),
	'rationale' => array(
		'value' => 'rationale',
		'label' => 'Rationale'
	),
	'redressed' => array(
		'value' => 'redressed',
		'label' => 'Redressed'
	),
	'reenie-beanie' => array(
		'value' => 'reenie-beanie',
		'label' => 'Reenie Beanie'
	),
	'rochester' => array(
		'value' => 'rochester',
		'label' => 'Rochester'
	),
	'rock-salt' => array(
		'value' => 'rock-salt',
		'label' => 'Rock Salt'
	),
	'short-stack' => array(
		'value' => 'short-stack',
		'label' => 'Short Stack'
	),
	'smythe' => array(
		'value' => 'smythe',
		'label' => 'Smythe'
	),
	'sue-ellen-francisco' => array(
		'value' => 'sue-ellen-francisco',
		'label' => 'Sue Ellen Francisco'
	),
	'terminal-dosis' => array(
		'value' => 'terminal-dosis',
		'label' => 'Terminal Dosis'
	),
	'varela-round' => array(
		'value' => 'varela-round',
		'label' => 'Varela Round'
	),
	'vibur' => array(
		'value' => 'vibur',
		'label' => 'Vibur'
	),
	'volkhov' => array(
		'value' => 'volkhov',
		'label' => 'Volkhov'
	),
	'voltaire' => array(
		'value' => 'voltaire',
		'label' => 'Voltaire'
	),
	'walter-turncoat' => array(
		'value' => 'walter-turncoat',
		'label' => 'Walter Turncoat'
	),
	'yellowtail' => array(
		'value' => 'yellowtail',
		'label' => 'Yellowtail'
	)
);

function rootdip_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'RootDip Options', 'RootDip Options', 'edit_theme_options', 'theme_options', 'rootdip_theme_options_page' );
}

add_action( 'admin_menu', 'rootdip_theme_options' );

// Function to generate options page
function rootdip_theme_options_page() {
	global $rootdip_image_sizes, $rootdip_categories, $rootdip_num_featured_options, $rootdip_theme_colors, $rootdip_theme_fonts;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Theme Options','rootdip' ) . "</h2>"; ?>

	<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved', 'rootdip' ); ?></strong></p></div>
	<?php endif; ?>

	<form method="post" action="options.php">

	<?php $options = rootdip_get_options(); ?>
	
	<?php settings_fields( 'rootdip_theme_options' ); ?>

	<table class="form-table">

	<tr valign="top"><th scope="row"><label for="back_to_top">"Back to Top" Button</label></th>
	<td>
	<input type="checkbox" id="back_to_top" name="rootdip_options[back_to_top]" value="1" <?php checked( true, $options['back_to_top'] ); ?> />
	<label for="back_to_top">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="pace_loader"><a href="http://github.hubspot.com/pace/docs/welcome/" target="_blank">Pace</a> Page Load Indicator</label></th>
	<td>
	<input type="checkbox" id="pace_loader" name="rootdip_options[pace_loader]" value="1" <?php checked( true, $options['pace_loader'] ); ?> />
	<label for="pace_loader">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="show_tagline">Show Tagline In Header</label></th>
	<td>
	<input type="checkbox" id="show_tagline" name="rootdip_options[show_tagline]" value="1" <?php checked( true, $options['show_tagline'] ); ?> />
	<label for="show_tagline">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="enable_slimbox">Slimbox2 Image Overlay</label></th>
	<td>
	<input type="checkbox" id="enable_slimbox" name="rootdip_options[enable_slimbox]" value="1" <?php checked( true, $options['enable_slimbox'] ); ?> />
	<label for="enable_slimbox">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="show_query_stats">Show Query Stats In Footer</label></th>
	<td>
	<input type="checkbox" id="show_query_stats" name="rootdip_options[show_query_stats]" value="1" <?php checked( true, $options['show_query_stats'] ); ?> />
	<label for="show_query_stats">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="fuzzy_timestamps">Fuzzy Timestamps</label></th>
	<td>
	<input type="checkbox" id="fuzzy_timestamps" name="rootdip_options[fuzzy_timestamps]" value="1" <?php checked( true, $options['fuzzy_timestamps'] ); ?> />
	<label for="fuzzy_timestamps">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="homepage_article_summary">Article Summaries on Home Page</label></th>
	<td>
	<input type="checkbox" id="homepage_article_summary" name="rootdip_options[homepage_article_summary]" value="1" <?php checked( true, $options['homepage_article_summary'] ); ?> />
	<label for="homepage_article_summary">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="maintenance_mode">Maintenance Mode</label></th>
	<td>
	<input type="checkbox" id="maintenance_mode" name="rootdip_options[maintenance_mode]" value="1" <?php checked( true, $options['maintenance_mode'] ); ?> />
	<label for="maintenance_mode">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="featured_image_size">Linked Featured Image Size</label></th>
	<td>
	<select id="featured_image_size" name="rootdip_options[featured_image_size]">
	<?php
	foreach ( $rootdip_image_sizes as $images ) :
		$label = $images['label'];
		$selected = '';
		if ( $images['value'] == $options['featured_image_size'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $images['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="theme_color">Theme Color</label></th>
	<td>
	<select id="theme_color" name="rootdip_options[theme_color]">
	<?php
	foreach ( $rootdip_theme_colors as $colors ) :
		$label = $colors['label'];
		$selected = '';
		if ( $colors['value'] == $options['theme_color'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $colors['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="theme_font">Theme Font</label></th>
	<td>
	<select id="theme_font" name="rootdip_options[theme_font]">
	<?php
	foreach ( $rootdip_theme_fonts as $fonts ) :
		$label = $fonts['label'];
		$selected = '';
		if ( $fonts['value'] == $options['theme_font'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $fonts['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="featured_cat">Featured Post Category</label></th>
	<td>
	<select id="featured_cat" name="rootdip_options[featured_cat]">
	<?php
	foreach ( $rootdip_categories as $category ) :
		$label = $category['label'];
		$selected = '';
		if ( $category['value'] == $options['featured_cat'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $category['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="num_featured"># Featured Posts to Show</label></th>
	<td>
	<select id="num_featured" name="rootdip_options[num_featured]">
	<?php
	foreach ( $rootdip_num_featured_options as $featured ) :
		$label = $featured['label'];
		$selected = '';
		if ( $featured['value'] == $options['num_featured'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $featured['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="custom_css">Custom CSS</label></th>
	<td>
	<textarea name="rootdip_options[custom_css]" style="width:350px; height:200px;" cols="" rows=""><?php echo esc_attr($options['custom_css']); ?></textarea>
	</td>
	</tr>
	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function rootdip_validate_options( $input ) {
	global $rootdip_image_sizes, $rootdip_categories, $rootdip_num_featured_options, $rootdip_theme_colors, $rootdip_theme_fonts;
	
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $options['featured_cat'];
	// We verify if the given value exists in the categories array
	if ( !array_key_exists( $input['featured_cat'], $rootdip_categories ) )
		$input['featured_cat'] = $prev;
		
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $options['num_featured'];
	// We verify if the given value exists in the categories array
	if ( !array_key_exists( $input['num_featured'], $rootdip_num_featured_options ) )
		$input['num_featured'] = $prev;
		
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $options['theme_color'];
	if ( !array_key_exists( $input['theme_color'], $rootdip_theme_colors ) )
		$input['theme_color'] = $prev;
	
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $options['theme_font'];
	if ( !array_key_exists( $input['theme_font'], $rootdip_theme_fonts ) )
		$input['theme_font'] = $prev;

	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $options['featured_image_size'];
	if ( !array_key_exists( $input['featured_image_size'], $rootdip_image_sizes ) )
		$input['featured_image_size'] = $prev;
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['show_tagline'] ) )
		$input['show_tagline'] = null;
	// We verify if the input is a boolean value
	$input['show_tagline'] = ( $input['show_tagline'] == 1 ? 1 : 0 );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['enable_slimbox'] ) )
		$input['enable_slimbox'] = null;
	// We verify if the input is a boolean value
	$input['enable_slimbox'] = ( $input['enable_slimbox'] == 1 ? 1 : 0 );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['show_query_stats'] ) )
		$input['show_query_stats'] = null;
	// We verify if the input is a boolean value
	$input['show_query_stats'] = ( $input['show_query_stats'] == 1 ? 1 : 0 );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['fuzzy_timestamps'] ) )
		$input['fuzzy_timestamps'] = null;
	// We verify if the input is a boolean value
	$input['fuzzy_timestamps'] = ( $input['fuzzy_timestamps'] == 1 ? 1 : 0 );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['homepage_article_summary'] ) )
		$input['homepage_article_summary'] = null;
	// We verify if the input is a boolean value
	$input['homepage_article_summary'] = ( $input['homepage_article_summary'] == 1 ? 1 : 0 );	

	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['maintenance_mode'] ) )
		$input['maintenance_mode'] = null;
	// We verify if the input is a boolean value
	$input['maintenance_mode'] = ( $input['maintenance_mode'] == 1 ? 1 : 0 );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['back_to_top'] ) )
		$input['back_to_top'] = null;
	// We verify if the input is a boolean value
	$input['back_to_top'] = ( $input['back_to_top'] == 1 ? 1 : 0 );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['pace_loader'] ) )
		$input['pace_loader'] = null;
	// We verify if the input is a boolean value
	$input['pace_loader'] = ( $input['pace_loader'] == 1 ? 1 : 0 );

	return $input;
}

endif;  // EndIf is_admin()
?>
