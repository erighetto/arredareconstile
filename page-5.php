<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Anna Cecchini
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">

<?php

   $args = array(
			'post_type' => 'attachment',
			'numberposts' => -1,
			'post_status' => null,
			'post_parent' => $post->ID,
		);

$attachments = get_posts($args);

if (is_page(5)) {
?>

	<!-- Carousel ================================================== -->
    <div id="homeCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
		<?php
		$i = 0;
	foreach ($attachments as $attachment) {
     if (strpos($attachment->post_mime_type, "image")!==false) {
		print '<li data-target="#homeCarousel" data-slide-to="'.$i.'"';
		if ($i == 0) print ' class="active"';
		print '></li>';
		$i++;
     }
	}
	?>
      </ol>
      <div class="carousel-inner">
	  <?php
	  $i = 0;
	foreach ($attachments as $attachment) {

     if (strpos($attachment->post_mime_type, "image")!==false) {
       ?>
	     <div class="item<?php if ($i == 0) print ' active'; ?>">
		 <?php echo wp_get_attachment_image( $attachment->ID, 'home-page-thumbnail' ); ?>
          <!-- div class="container">
            <div class="carousel-caption">
              <h1><?php echo apply_filters( 'the_title', $attachment->post_title );?></h1>
              <?php echo apply_filters( 'the_content', $attachment->post_content );?>
            </div>
          </div -->
        </div>
	   <?php
	   $i++;
     }
	}
	?>

      </div>
      <a class="left carousel-control" href="#homeCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#homeCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

<?php
}

?>

					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php edit_post_link( esc_html__( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
