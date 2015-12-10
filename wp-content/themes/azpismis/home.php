<?php get_header(); ?>
<div id="sayfa">
	<div id="sayfa_sol">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <div class="meta"><?php the_author() ?>, <?php the_time('d F Y'); ?>, <?php comments_popup_link('No comments', '1 comment', '% comments'); ?><br />Categories: <?php the_category(', ') ?><br /><?php the_tags('Tags: ',', '); ?>
            </div>
		<?php the_content(__('Read more'));?>
			
		<!--  <?php trackback_rdf(); ?> -->
		
		<?php comments_template(); // Get wp-comments.php template ?>
		<?php endwhile; else: ?><?php endif; ?>
		
			<div class="sayfalar">
			<p align="center">			
			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { posts_nav_link(' &#8212; ', __('&laquo; Prev'), __('Next &raquo;'));} ?>
			</p>			
			</div>
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>