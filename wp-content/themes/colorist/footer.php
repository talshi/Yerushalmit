<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Colorist
 */
?>
		</div> <!-- .container -->
	</div><!-- #content -->

	<?php do_action('colorist_before_footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php 
			$footer_widgets = get_theme_mod( 'footer_widgets',true );
			if( $footer_widgets ) : ?>
			<div class="footer-widgets">
				<div class="container">
					<?php get_template_part('footer','widgets'); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="footer-bottom site-info copy">
			<div class="container">
				<div class="seven columns">
					<?php if( get_theme_mod('copyright') ) : ?>
						<p><?php echo get_theme_mod('copyright'); ?></p>
					<?php else : 
						do_action('colorist_credits');
					endif;  ?>
				</div>
				<div class="footer-right social nine columns">      
					<?php dynamic_sidebar( 'footer-nav' ); ?>
				</div>
			</div>
		</div><!-- .site-info -->	

		
	</footer><!-- #colophon -->    

	<?php do_action('colorist_after_footer'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
