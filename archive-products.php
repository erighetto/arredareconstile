<?php
/**
 * The template for displaying product page.
 *
 *
 * @package Anna Cecchini
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' );
					
					
				echo '<ul class="list-inline" id="filter-label">';
			    $terms = get_terms( 'typology' );
			    foreach($terms as $term) { 
			        echo 
			            '<li data-filter="typology-'.$term->slug.'">    
			                    '.$term->name.'
			            </li>';
			    }
			    echo '<li>Tutti</li></ul>';
				?>
			<div id="freewall" class="row">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'product' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>
			</div><!-- #freewall -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>