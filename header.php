<?php $options = html5press_get_options(); ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	
	<!-- Always force latest IE rendering engine & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	
	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width">
	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" />
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/<?php echo esc_attr( $options['theme_color'] ); ?>.css" rel="stylesheet" />
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php wp_head(); ?>

	<?php if ( ! empty( $options['custom_css'] ) ) { ?>
		<style><?php echo $options['custom_css']; ?></style>
	<?php } ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">
	<!-- Prompt IE 6 and 7 users to install Chrome Frame:		chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 8]>
		<p class="chromeframe alert alert-warning">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
	<![endif]-->
	<header id="master-header" class="clearfix" role="banner">
	
		<div id="hgroup">
			<h1 id="site-title">
				<a href="<?php echo home_url(); ?>">
					<?php
						if ( empty( $options['custom_logo_url'] ) ) {
							bloginfo( 'name' );
						} else {
					?>
						<img src="<?php echo esc_url( $options['custom_logo_url'] ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
					<?php } ?>
				</a>
			</h1>

			<?php if ( $options['show_tagline'] ) { ?>
				<h2 id="site-description"><?php bloginfo('description'); ?></h2>
			<?php } ?>
		</div>
		
	</header> <!-- #master-header -->

<div id="main" class="row">
	
	<!-- Main navigation -->
	<nav id="menu" class="main-navigation span12 clearfix" role="navigation">
		<h3 class="assistive-text"><?php _e( 'Main menu', 'html5press' ); ?></h2> 
		<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu' => 'top-menu', 'container' => 'false' ) ); ?>
	</nav> <!-- #nav -->