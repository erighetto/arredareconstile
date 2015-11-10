<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Anna Cecchini
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div  id="footer" class="site-info pull-center">
		<span id="generator-link">Via Marosticana, 140 - 36031 Dueville (VI)</span>
		<span class="meta-sep">|</span>
		<span id="theme-link">Tel. 0444 361045 - Fax 0444 369106</span>
		<span class="meta-sep">|</span>
		<span id="generator-link">Cell. 335 6057442 - <a href="mailto:<?php bloginfo('admin_email'); ?>"><?php bloginfo('admin_email'); ?></a></span>
		<span class="meta-sep"><br /></span>
		<span id="theme-link">C.F. CCCNMR53B51D379P - P.IVA IT02477510248</span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->



<div id="credits">Credits: WCS <a href="http://www.emanuelrighetto.it" title="Creazione siti web" target="_blank">Creazione siti web</a></div>

<?php wp_footer(); ?>
<script type="text/javascript">

<?php
global $imagesUrl;
if (is_array($imagesUrl)):
?>

jQuery.imgpreload(['<?php echo implode("','",$imagesUrl); ?>'],function()
{
    // this = array of dom image objects
    // check for success with: $(this[i]).data('loaded')
    // callback executes when all images are loaded
});
<?php endif;  ?>

<?php if (is_archive()): ?>
			jQuery(function() {
				var wall = new freewall("#freewall");
				var width = jQuery(window).width(),
						ratio = width > 700 ? '260' : '245';
				wall.reset({
					selector: '.preview',
					animate: true,
					cellW: ratio,
					cellH: ratio,
					fixSize: 0,
					onResize: function() {
						wall.refresh();
					}
				});

				jQuery("#filter-label li").click(function() {
					jQuery("#filter-label li").removeClass("active");
					var filter = jQuery(this).addClass('active').data('filter');
					if (filter) {
						wall.filter('.'+filter);
					} else {
						wall.unFilter();
					}
				});

				wall.fitWidth();
			});
<?php endif; ?>

jQuery(document).ready(function() {


	jQuery('.dropdown-toggle').click(function() {
	    var location = jQuery(this).attr('href');
	    window.location.href = location;
	    return false;
	});

	jQuery('#menu-mainmenu #menu-item-180 > a').attr("href","#");



	<?php if (is_single()): ?>
	jQuery("div#makeMeScrollable").smoothDivScroll({ autoScroll: "onstart", autoScrollDirection: "backandforth", autoScrollStep: 1, autoScrollInterval: 15, visibleHotSpots: "always"});
	jQuery('a.lightbox').colorbox(); // Select all links with lightbox class
	jQuery("#thumbbox .thumb img").click(function() {
		var thumbId = jQuery(this).attr('id');
		var imgId = jQuery(".single-products #imagebox div.active").attr('id');
			jQuery(".single-products #"+imgId).fadeOut('slow', function() {
				jQuery(".single-products #large-"+thumbId).fadeIn("slow",function() {
					jQuery(".single-products #"+imgId).removeClass("active");
					jQuery(".single-products #large-"+thumbId).addClass("active");
				});
			});
		});
	<?php endif; ?>




});
</script>
</body>
</html>
