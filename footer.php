    <?php global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options ); ?>
    <footer id="footer" role="contentinfo">
        <!-- You're free to remove the credit link in the footer, but please, please leave it there. -->
        <p><?php _e( 'Copyright ','html5press' ); ?>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>" title="<?php _e( 'This Website','html5press' ); ?>"><?php bloginfo('name'); ?></a> - <?php _e( 'Design by ','html5press' ); ?><a href="http://jayj.dk" title="Design by Jayj.dk">Jayj.dk</a><?php _e( ' & WordPress\'d by ','html5press' ); ?><a href="http://www.longren.org/wordpress/html5press/">Tyler Longren</a></p>
	<p>
	<?php 
	printf( __( 'Powered by %1$s and %2$s','html5press' ),
		sprintf('<a href="http://wordpress.org/">%1$s</a>',
			__( 'WordPress','html5press' )
		),
		sprintf('<a href="http://www.longren.org/wordpress/html5press/" title="%1$s">HTML5Press %2$s</a>',
			__( 'HTML5Press WordPress Theme.','html5press' ),
			html5press_getinfo('version')
		)
	);?>
	<?php
	if ($html5press_settings['show_query_stats'] == 1) { ?>
		 - <?php echo get_num_queries(); _e( ' queries in ','html5press' ); timer_stop(1); _e( ' seconds','html5press' ); } ?>
	</p>
	</footer> <!-- end footer -->
    
    <div class="clear"></div>

</div> <!-- end wrapper -->
	<?php if ($html5press_settings['back_to_top'] == 1) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		jQuery().UItoTop({ easingType: 'easeOutQuart',text: 'Back To Top',min: '300'});
	});
	</script>
	<?php } ?>
	<?php if ($html5press_settings['fuzzy_timestamps'] == 1) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
  		jQuery("time.timeago").timeago();
	});
	</script>
	<?php } ?>
	<?php wp_footer(); ?>
</body>
</html>
