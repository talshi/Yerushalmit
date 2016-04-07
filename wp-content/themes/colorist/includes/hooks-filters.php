<?php

	function colorist_footer_credits() { 
		printf( __('<p>Powered by <a href="%1$s">%2$s</a>', 'colorist'),
			esc_url( __( 'http://wordpress.org/', 'colorist' )), __( 'WordPress', 'colorist' ) );
		printf( '<span class="sep"> .</span>' );
		printf( __( 'Theme: %1$s by %2$s', 'colorist' ), 'Colorist', '<a href="http://www.webulousthemes.com/" rel="designer">Webulous Themes</a></p>' );
	}
	
	add_action('colorist_credits','colorist_footer_credits');

	function colorist_before_branding_widgets() {
?>
		<div class="top-nav">
			<div class="container">
			<?php if( is_active_sidebar( 'top-left' ) ) : ?>    
				<div class="cart eight columns top-left">
					<?php dynamic_sidebar('top-left' ); ?>
				</div>
			<?php endif; ?> 
			<?php if( is_active_sidebar('top-right' ) ) : ?>
				<div class="eight columns social top-right">
					<?php dynamic_sidebar('top-right' ); ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
<?php
	}


	add_action('colorist_before_branding','colorist_before_branding_widgets');
 
