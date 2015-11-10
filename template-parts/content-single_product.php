<?php
/**
 * Template part for displaying single product.
 *
 * @package Anna Cecchini
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php annacecchini_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6">
	<?php
			     $args = array(
					'post_type' => 'attachment',
					'numberposts' => -1,
					'post_status' => null,
					'post_parent' => $post->ID
					);

				$attachments = get_posts($args);
				if ($attachments) {
					$i = 1;
              	   foreach ($attachments as $attachment) {
              	   	if ($i==1) $class = ' class="active"'; else $class ="";
                		$image_thumb_attributes = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                    $image_attributes = wp_get_attachment_image_src( $attachment->ID, 'full' );

										$thumb.='<span class="thumb"><img id="'.$attachment->ID.'" src="'.$image_thumb_attributes[0].'" width="'.$image_thumb_attributes[1].'" height="'.$image_thumb_attributes[2].'" class="img-thumbnail"></span>'."\n";
										$img.='<div id="large-'.$attachment->ID.'"'.$class.'><a href="'.wp_get_attachment_url( $attachment->ID ).'" class="lightbox"><img class="img-responsive" src="'.$image_attributes[0].'" width="'.$image_attributes[1].'" height="'.$image_attributes[2].'"></a></div>'."\n";
										++$i;
                  }
		echo '<div id="imagebox">'."\n".$img."\n</div>\n";
		echo '<p id="thumbbox">'.$thumb."</p>\n";
        }
			  ?>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<ul class="list-group">
				  <li class="list-group-item">
				  	<h4>Descrizione</h4>
				    <?php the_content(); ?>
				  </li>
				  <li class="list-group-item">
				  	<h4>Stile</h4>
				    <?php the_field('stile'); ?>
				  </li>
				  <li class="list-group-item">
				  	<h4>Epoca</h4>
				    <?php the_field('epoca'); ?>
				  </li>
				  <li class="list-group-item">
				  	<h4>Provenienza</h4>
				    <?php the_field('provenienza'); ?>
				  </li>
				  <li class="list-group-item">
				  	<h4>Prezzo</h4>
						<?php if (get_field('field_name')):  ?>
				    <?php the_field('prezzo'); ?> €
					  <?php else: ?>
							<a href="<?php echo get_page_link(19);  ?>" class="btn btn-primary">Richiedi</a>
						<?php endif; ?>
				  </li>
				  <li class="list-group-item">
				  	<h4>Dimensioni (cm):</h4>
				    Altezza: <?php the_field('altezza'); ?><br />
				    Larghezza: <?php the_field('larghezza'); ?><br />
				    Profondità: <?php the_field('profondita'); ?><br />
				  </li>
				</ul>
			</div>
		</div>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php annacecchini_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
