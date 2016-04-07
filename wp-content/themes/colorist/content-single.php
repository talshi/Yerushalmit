<?php
/**
 * @package Colorist
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
		<h1 class="entry-title"><?php the_title( '','' ); ?></h1>

		<div class="entry-meta">
			<?php colorist_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

<div class="entry-content">
	<?php
			$single_featured_image = get_theme_mod( 'single_featured_image',true);
			$single_featured_image_size = get_theme_mod ('single_featured_image_size','1');
			if( $single_featured_image ) : ?>
				<div class="post-thumb blog-thumb">
				<?php if ( $single_featured_image_size == '1' ) :
						if( has_post_thumbnail() && ! post_password_required() ) :   
							the_post_thumbnail('colorist-large-width'); 
						
						endif;
					 else: 
					 	if( has_post_thumbnail() && ! post_password_required() ) :   
								the_post_thumbnail('colorist-small-featured-image-width');
						endif;
					endif;  ?>
				</div>			
		<?php 
		endif;  ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'colorist' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php colorist_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
