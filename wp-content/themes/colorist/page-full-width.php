<?php
/**
 * Template Name: Page Full Width
 *
 * @package colorist
 */

get_header(); ?>

	<div class="breadcrumb-wrap">
		<div class="container">
			<div class="six columns">
				<?php $breadcrumb = get_theme_mod( 'breadcrumb',true ); 
				if( $breadcrumb ) : ?>
					<div id="breadcrumb" role="navigation">
						<?php colorist_breadcrumbs(); ?>    
					</div>
				<?php else:  ?>    
					&nbsp;
				<?php endif; ?>
			</div>
			<div class="ten columns">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->				
			</div>
		</div>
	</div> 

	<?php do_action('colorist_before_content'); ?>
	

	<div id="content" class="site-content container">

		<div id="primary" class="content-area sixteen columns">

			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .row -->

<?php get_footer(); ?>
