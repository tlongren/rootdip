<?php

// Default options values
$html5press_options = array(
	'back_to_top' => true,
	'show_tagline' => true,
	'enable_slimbox' => false,
	'show_query_stats' => false,
	'fuzzy_timestamps' => false,
	'maintenance_mode' => false,
	'custom_logo_url' => '',
	'featured_image_size' => 'large',
	'theme_color' => 'pink',
	'theme_font' => 'droid-serif',
	'featured_cat' => '',
	'num_featured' => '5',
	'custom_css' => ''
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
$html5press_categories[10000] = array(
	'value' => 10000,
	'label' => 'All Categories'
);

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
$html5press_theme_fonts = array(
	'droid-serif' => array(
		'value' => 'droid-serif',
		'label' => 'Droid Serif'
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

function html5press_theme_options() {
	// Add theme options page to the addmin menu
	add_menu_page( 'HTML5Press', 'HTML5Press', 'edit_theme_options', 'theme_options', 'html5press_theme_options_page',get_template_directory_uri() . '/images/html5.png' );
	add_submenu_page( 'theme_options', 'HTML5Press Notes', 'Notes', 'edit_theme_options', 'theme_options_notes', 'html5press_theme_notes_page');
}

add_action( 'admin_menu', 'html5press_theme_options' );

// Function for notes page
function html5press_theme_notes_page() {
	echo '<div class="wrap">';
	screen_icon();
	echo '<h2>HTML5Press Notes</h2><ol>
	<li><strong>Archive Page:</strong> There\'s a page template called Archives. Don\'t enter any page content, just title the page and select Archives for the page template. The archives will be generated automatically. See <a href="http://html5press.com/archives/">here for an example</a>.</li>
	<li><strong>Link Post Format:</strong> To utilize the link Post Format, simply write a new post and select "Link" for the format. You\'ll also need to add a custom field with the URL you want to link to. The custom field name should be LinkFormatURL and the custom field value should be the URL you want to link to.</li>
	<li><strong>Quote Post Format:</strong> When using this post format, I usually use the author or source as the post title, and then put the quote inside a blockquote for the actual post content.</li>
	<li><strong>Status Post Format:</strong> Just put your status as the post title and publish (make sure you select the status format!). No post content is necessary.</li>
	<li><strong>Maintenance Mode:</strong> This option lets you show a "maintenance" message to visitors who aren\'t logged in. This can be useful while making changes to your website or while tinkering with HTML5Press. Just don\'t forget to disable it when you\'re done or your visitors won\'t see your site!</li>
	<li><strong>Fuzzy Timestamps:</strong> Enabling fuzzy timestamps on the options page will cause dates/times to display like "two days ago" or "4 hours ago", instead of dates showing "10/07/2011 11:23:34".</li>
	<li><strong>Twitter Widget:</strong> A custom twitter widget is included with HTML5Press as of version 2.1. This widget is based on the <a href="https://github.com/matthiassiegel/Simple-Twitter-Widget" target="_blank">Simple Twitter Widget</a> by <a href="http://chipsandtv.com" target="_blank">Matthias Siegel</a>. Matthias graciously allowed me to include his code in HTML5Press.</li>
</ol></div>';
}

// Function to generate options page
function html5press_theme_options_page() {
	global $html5press_options, $html5press_image_sizes, $html5press_categories, $html5press_num_featured_options, $html5press_theme_colors, $html5press_theme_fonts;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options','html5press' ) . "</h2>"; ?>

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
	<tr valign="top"><th scope="row"><label for="enable_slimbox">Slimbox2 Image Overlay</label></th>
	<td>
	<input type="checkbox" id="enable_slimbox" name="html5press_options[enable_slimbox]" value="1" <?php checked( true, $settings['enable_slimbox'] ); ?> />
	<label for="enable_slimbox">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="show_query_stats">Show Query Stats In Footer</label></th>
	<td>
	<input type="checkbox" id="show_query_stats" name="html5press_options[show_query_stats]" value="1" <?php checked( true, $settings['show_query_stats'] ); ?> />
	<label for="show_query_stats">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="fuzzy_timestamps">Fuzzy Timestamps</label></th>
	<td>
	<input type="checkbox" id="fuzzy_timestamps" name="html5press_options[fuzzy_timestamps]" value="1" <?php checked( true, $settings['fuzzy_timestamps'] ); ?> />
	<label for="fuzzy_timestamps">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="maintenance_mode">Maintenance Mode</label></th>
	<td>
	<input type="checkbox" id="maintenance_mode" name="html5press_options[maintenance_mode]" value="1" <?php checked( true, $settings['maintenance_mode'] ); ?> />
	<label for="maintenance_mode">Enabled</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="custom_logo_url">Custom Logo URL</label></th>
	<td>
	<input type="text" id="custom_logo_url" name="html5press_options[custom_logo_url]" value="<?php echo esc_attr($settings['custom_logo_url']); ?>" />
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
	<tr valign="top"><th scope="row"><label for="theme_font">Theme Font</label></th>
	<td>
	<select id="theme_font" name="html5press_options[theme_font]">
	<?php
	foreach ( $html5press_theme_fonts as $fonts ) :
		$label = $fonts['label'];
		$selected = '';
		if ( $fonts['value'] == $settings['theme_font'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $fonts['value'] ) . '" ' . $selected . '>' . $label . '</option>';
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
	<tr valign="top"><th scope="row"><label for="custom_css">Custom CSS</label></th>
	<td>
	<textarea name="html5press_options[custom_css]" style="width:350px; height:200px;" cols="" rows=""><?php echo esc_attr($settings['custom_css']); ?></textarea>
	</td>
	</tr>
	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function html5press_validate_options( $input ) {
	global $html5press_options, $html5press_image_sizes, $html5press_categories, $html5press_num_featured_options, $html5press_theme_colors, $html5press_theme_fonts;

	$settings = get_option( 'html5press_options', $html5press_options );
	
	$input['custom_logo_url'] = wp_filter_nohtml_kses( $input['custom_logo_url'] );
	
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
	$prev = $settings['theme_font'];
	if ( !array_key_exists( $input['theme_font'], $html5press_theme_fonts ) )
		$input['theme_font'] = $prev;

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
	if ( ! isset( $input['maintenance_mode'] ) )
		$input['maintenance_mode'] = null;
	// We verify if the input is a boolean value
	$input['maintenance_mode'] = ( $input['maintenance_mode'] == 1 ? 1 : 0 );
	
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['back_to_top'] ) )
		$input['back_to_top'] = null;
	// We verify if the input is a boolean value
	$input['back_to_top'] = ( $input['back_to_top'] == 1 ? 1 : 0 );
	
	return $input;
}

endif;  // EndIf is_admin()
?>
