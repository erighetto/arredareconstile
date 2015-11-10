<?php
/**
 * Template part for displaying single posts.
 *
 * @package Anna Cecchini
 */

/*
 * Stabilisco se sono nella sezione portfolio o news
*/
$post_categories = wp_get_post_categories( $post->ID );

foreach($post_categories as $catid){
	$cat = get_category( $catid );
	$parent = $cat->category_parent;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
				<h2 class="entry-title"><?php
//portfolio
 if (($catid==9)||($parent==9)) {
            if(function_exists('bcn_display'))
            {
              bcn_display();
            }
 } else the_title();
            ?></h2>

		<div class="entry-meta">
			<?php annacecchini_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

<div class="entry-content">
<?php
//portfolio
if (($catid==9)||($parent==9)) {

   $args = array(
	'post_type' => 'attachment',
	'numberposts' => -1,
	'post_status' => null,
	'post_parent' => $post->ID
	);

$attachments = get_posts($args);

		if ($attachments) {
			global $imagesUrl;
			 $stringa_alt =  get_the_title($post->ID);
		echo '	<div id="makeMeScrollable">
					<div class="scrollingHotSpotLeft"></div>
					<div class="scrollingHotSpotRight"></div>
					<div class="scrollWrapper">
						<div class="scrollableArea">
				';
			foreach ($attachments as $attachment) {

		     if (strpos($attachment->post_mime_type, "image")!==false) {
			     $image = wp_get_attachment_image_src( $attachment->ID, 'full', $icon );
					 $imagesUrl[] = get_bloginfo('template_url').'/thumb.php?src='.$image[0].'&amp;w=600&amp;h=400&amp;zc=1&amp;q=95';
			     echo '<a href="'.$image[0].'" class="lightbox" title="'.$stringa_alt.'">'."\n".
						'<img src="'. get_bloginfo('template_url').'/thumb.php?src='.$image[0].
						'&amp;w=600&amp;h=400&amp;zc=1&amp;q=95" title="'.
						$stringa_alt.'" alt="'.$stringa_alt.'" />'."\n".
				    '</a>' ."\n";
			 		     }
			}
		echo '			</div>
					</div>
				</div>';
		}

}
?>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'annacecchini' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php annacecchini_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
