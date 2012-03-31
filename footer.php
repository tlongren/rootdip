<?php $options = html5press_get_options(); ?>

	<footer id="footer" role="contentinfo">
		<!-- You're free to remove the credit links in the footer, but please, please leave it there. -->
		<p>
			<?php
				/* translators: 1: year, 2: blog name, 3: link to designer 4: link to theme */
				printf( __( 'Copyright &copy; %1$s %2$s - Design by %3$s and & WordPress\'d by %4$s','html5press' ),
					date('Y'),
					'<a href="' . home_url() . '" title="' . get_bloginfo('name') . '">' . get_bloginfo('name') . '</a>',
					'<a href="http://jayj.dk" title="Design by Jayj.dk">Jayj.dk</a>',
					'<a href="http://www.longren.org/wordpress/html5press/">Tyler Longren</a>'
				);
			?>
		</p>

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
				);
			?>

			<?php
				if ( $options['show_query_stats'] == 1) { ?>
					- <?php echo get_num_queries(); _e( ' queries in ','html5press' ); timer_stop(1); _e( ' seconds','html5press' );
				}
			?>
		</p>
	</footer> <!-- end #footer -->
	
	<div class="clear"></div>

</div> <!-- end #wrapper -->

	<?php if ($options['back_to_top'] == 1) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {		
		jQuery().UItoTop({ easingType: 'easeOutQuart',text: 'Back To Top',min: '300'});
	});
	</script>
	<?php } ?>
	<?php if ($options['fuzzy_timestamps'] == 1) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("time.timeago").timeago();
	});
	</script>
	<?php } ?>
	<?php wp_footer(); ?>
</body>
</html>
