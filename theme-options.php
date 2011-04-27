<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'html5press_options', 'html5press_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'HTML5Press Options', 'html5press' ), __( 'HTML5Press Options', 'html5press' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'html5press' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'html5press' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'html5press_options' ); ?>
			<?php $options = get_option( 'html5press_theme_options' ); ?>
			<table class="form-table">
				<?php
				/**
				 * Enable or disable "Back to Top"
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Back to Top Button', 'html5press' ); ?></th>
					<td>
						<input id="html5press_theme_options[backToTop]" name="html5press_theme_options[backToTop]" type="checkbox" value="1" <?php checked( '1', $options['backToTop'] ); ?> />
						<label class="description" for="html5press_theme_options[backToTop]"><?php _e( 'Enabled', 'html5press' ); ?></label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'html5press' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['backToTop'] ) )
		$input['backToTop'] = null;
	$input['backToTop'] = ( $input['backToTop'] == 1 ? 1 : 0 );

	return $input;
}