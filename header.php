<?php global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options ); if (!isset($html5press_settings['theme_color'])) { $html5press_settings['theme_color'] = "pink"; } ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

    <meta charset="utf-8" />
    
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	
	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
 	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" />
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/<?php echo esc_attr( $html5press_settings['theme_color'] ); ?>.css" rel="stylesheet" />
    
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<?php if ( !empty($html5press_settings['custom_css']) ) { ?><style type="text/css"><?php echo $html5press_settings['custom_css']; ?></style><?php } ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

    <header id="header" class="clearfix" role="banner">
	
		<hgroup>
			<h1 id="site-title"><a href="<?php echo home_url(); ?>"><?php if (empty($html5press_settings['custom_logo_url'])) { bloginfo('name'); } else { ?><img src="<?php echo $html5press_settings['custom_logo_url']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /><?php } ?></a></h1>
			<?php if ($html5press_settings['show_tagline'] == 1) { ?><h2 id="site-description"><?php bloginfo('description'); ?></h2><?php } ?>
		</hgroup>
		
    </header> <!-- end header -->

<div id="main" class="clearfix">
    <!-- Navigation -->
	<nav id="menu" class="clearfix" role="navigation">
		<h2 class="assistive-text"><?php _e( 'Main menu', 'html5press' ); ?></h2> 
		<?php wp_nav_menu( array( 'menu' => 'top-menu', 'container' => 'false' ) ); ?>
	</nav> <!-- #nav -->