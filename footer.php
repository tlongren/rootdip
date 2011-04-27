    
    <footer id="footer" class="grid_12">
        <!-- You're free to remove the credit link in the footer, but please, please leave it there. -->
        <p><?php _e( 'Copyright ','html5press' ); ?>&copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>" title="<?php _e( 'This Website','html5press' ); ?>"><?php bloginfo('name'); ?></a> - <?php _e( 'Design by ','html5press' ); ?><a href="http://jayj.dk" title="Design by Jayj.dk">Jayj.dk</a><?php _e( ' & WordPress\'d by ','html5press' ); ?><a href="http://www.longren.org/wordpress/html5press/">Tyler Longren</a></p>
	<p>
	<?php 
	printf( _x('Powered by %1$s and %2$s','html5press'),
		sprintf('<a href="http://wordpress.org/">%1$s</a>',
			__('WordPress','html5press')
		),
		sprintf('<a href="http://www.longren.org/wordpress/html5press/" title="%1$s">HTML5Press %2$s</a>',
			__('HTML5Press WordPress Theme.','html5press'),
			html5press_getinfo('version')
		)
	);?>
	</p>
	</footer> <!-- end footer -->
    
    <div class="clear"></div>

</div> <!-- end wrapper -->
	<?php $options = get_option('html5press_theme_options'); if ($options['backToTop'] == 1) { ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/easing.js" type="text/javascript"></script> 
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.ui.totop.js" type="text/javascript"></script>
	<script type="text/javascript">
	var $j = jQuery.noConflict();
	$j(document).ready(function() {		
		$j().UItoTop({ easingType: 'easeOutQuart',text: 'Back To Top',min: '300'});
	});
	</script>
	<?php } ?>
	<?php wp_footer(); ?>
</body>
</html>
