<?php
/**
 * Template Name: Sidebar Left
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
		
	<div id="content" class="site-content">
		<div class="container">

	 <?php get_sidebar('left'); ?>	 	
	 

    <div id="primary" class="content-area  eleven columns">
			
			<main id="main" class="site-main" role="main">
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
		?>
	
		<?php get_footer(); ?>