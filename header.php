<!DOCTYPE html>
<html lang="en">
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
<?php wp_head(); ?>
<script type="text/javascript">
	var $j = jQuery.noConflict();
	$j(function () {
	var scroll_timer;
	var displayed = false;
	var $message = $j('#message a');
	var $window = $j(window);
	var top = $j(document.body).children(0).position().top;
	$window.scroll(function () {
		window.clearTimeout(scroll_timer);
		scroll_timer = window.setTimeout(function () {
			if($window.scrollTop() <= top)
			{
				displayed = false;
				$message.fadeOut(500);
			}
			else if(displayed == false)
			{
				displayed = true;
				$message.stop(true, true).show().click(function () { $message.fadeOut(500); });
			}
		}, 100);
	});
});
</script>
</head>

<body>
<div id="top"></div>
<div id="wrapper" class="container_12">

    <header id="header" class="grid_12">
    
    	<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
    
    </header> <!-- end header -->
	<div id="content">
    
        <nav>
           <?php wp_nav_menu( array( 'menu' => 'top-menu', 'container' => 'false', 'menu_id' => 'menu', 'menu_class' => 'clearfix' ) ); ?>
            <br class="clear" />
        </nav>