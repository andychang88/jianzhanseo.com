<?php get_header(); ?>
<div id="sayfa">
	<div id="sayfa_sol">
		<p align="center">
			<div class="sayfalar">
			<p align="center">			
			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { posts_nav_link(' &#8212; ', __('&laquo; Önceki'), __('Sonraki &raquo;'));} ?>
			</p>			
			</div>
		</p>
   <h1>Search Results</h1>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<p>Author: <?php the_author() ?> | <?php the_time('d F Y'); ?> | <?php comments_popup_link('No comments', '1 comment', '% comments'); ?><br />Categories: <?php the_category(', ') ?></p>		
	<?php the_excerpt(); ?>
	<!-- <?php trackback_rdf(); ?> -->
	<?php comments_template(); // Get wp-comments.php template ?>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
		<p align="center">
			<div class="sayfalar">
			<p align="center">			
			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { posts_nav_link(' &#8212; ', __('&laquo; Prev'), __('Next &raquo;'));} ?>
			</p>			
			</div>
		</p>
</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>