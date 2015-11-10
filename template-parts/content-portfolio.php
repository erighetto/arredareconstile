<?php
/**
 * The template part for displaying results in portfolio pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Anna Cecchini
 */

	$classes = array(
			'col-xs-12',
			'col-sm-6',
			'col-md-2',
			'preview',
		);
?>


<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<header class="entry-header">
		<div class="img"><a href="<?php the_permalink() ?>" title="<?php printf( __('Permalink to %s', 'sandbox'), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php 
			if (has_post_thumbnail()&&!is_single()) {
			  the_post_thumbnail('portfolio-thumbnail',array('class'=>'img-thumbnail'));
			}
		 ?></a></div>
	</header><!-- .entry-header -->

 	<div class="txt"><a href="<?php the_permalink() ?>" title="<?php printf( __('Permalink to %s', 'sandbox'), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php the_title() ?></a></div>
</article><!-- #post-## -->
