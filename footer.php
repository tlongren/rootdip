<?php $options = rootdip_get_options(); ?>

	<footer id="footer" role="contentinfo">
		<!-- You're free to remove the credit links in the footer, but please, please leave it there. -->
		<p>
			<?php
				/* translators: 1: year, 2: blog name, 3: link to designer 4: link to theme */
				printf( __( 'Copyright &copy; %1$s %2$s - Design by %3$s & WordPress\'d by %4$s','rootdip' ),
					date('Y'),
					'<a href="' . home_url() . '" title="' . get_bloginfo('name') . '">' . get_bloginfo('name') . '</a>',
					'<a href="http://jayj.dk" title="Design by Jayj.dk">Jayj.dk</a>',
					'<a href="http://www.longren.org/wordpress/rootdip/">Tyler Longren</a>'
				);
			?>
		</p>

		<p>
			<?php 
				printf( __( 'Powered by %1$s and %2$s','rootdip' ),
					sprintf('<a href="http://wordpress.org/">%1$s</a>',
						__( 'WordPress','rootdip' )
					),
					sprintf('<a href="http://www.longren.org/wordpress/rootdip/" title="%1$s">RootDip %2$s</a>',
						__( 'RootDip WordPress Theme.','rootdip' ),
						rootdip_getinfo('version')
					)
				);
			?>

			<?php
				if ( $options['show_query_stats'] == 1) { 
					printf( __( '- %1$s queries in %2$s seconds','rootdip' ), get_num_queries(), timer_stop() );
				}
			?>
		</p>
	</footer> <!-- end #footer -->
	
	<div class="clear"></div>

</div> <!-- end #wrapper -->
	<?php wp_footer(); ?>
</body>
</html>
