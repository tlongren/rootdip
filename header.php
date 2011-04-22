<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="utf-8" />
    
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    
    <meta name="description" content="" />
    
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
    
    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <![endif]-->
    
    <!--[if lte IE 7]>
    	<link href="<?php echo get_template_directory_uri(); ?>/css/ie.css" rel="stylesheet" type="text/css" />
    <![endif]-->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="container_12">

    <header id="header" class="grid_12">
    
    	<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
    
    </header> <!-- end header -->
	<div id="content">
    
        <nav>
           <?php wp_nav_menu( array( 'menu' => 'top-menu', 'container' => 'false', 'menu_id' => 'menu', 'menu_class' => 'clearfix' ) ); ?>
            <br class="clear" />
        </nav>