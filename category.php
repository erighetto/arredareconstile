<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Anna Cecchini
 */

get_header();

	/*
	* Stabilisco se sono nella sezione portfolio o news
	*/
	$catid = get_query_var('cat');
	$cat = &get_category($catid);
	$parent = $cat->category_parent;
	
	
	//portfolio
	if (($catid==9)||($parent==9)) {
		$child_of = 9;
		$tpl = 	'portfolio';
	}
					
	//news
	elseif (($catid==1)||($parent==1)) {
		$child_of = 1; 
		$tpl = 	'news';	
	}
 ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
		    
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				?>

		<?php if ( have_posts() ) : ?>
			
		<?php if (($catid==9)||($catid==1)):
			    echo '<ul class="list-inline" id="filter-label">';
			    $args = array(
			        'hide_empty'=> 1,
			        'orderby' => 'name',
			        'child_of' => $child_of,
			        'order' => 'ASC'
			    );
			    $categories = get_categories($args);
			    foreach($categories as $category) { 
			        echo 
			            '<li data-filter="category-'.$category->slug.'">    
			                    '.$category->name.'
			            </li>';
			    }
			    echo '<li>Tutti</li></ul>';
		 endif; ?> 
			<div id="freewall" class="row">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					 get_template_part( 'template-parts/content', $tpl );					
				?>

			<?php endwhile; ?>
			</div><!-- #freewall -->
			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	

<?php get_sidebar(); ?>
<?php get_footer(); ?>
