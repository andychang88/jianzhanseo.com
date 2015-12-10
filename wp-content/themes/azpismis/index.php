<?php get_header(); ?>

<div id="index_ana">
	<div id="index_sol">

	<div class="yazilar" style="text-align:left"><?php previous_post_link('&laquo; %link') ?></div>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>	
            <div class="meta"><?php the_author() ?>, <?php the_time('d F Y'); ?>, <?php comments_popup_link('No comments', '1 comment', '% comments'); ?><br />Categories: <?php the_category(', ') ?><br /><?php the_tags('Tags: ',', '); ?>
            </div>
		<?php the_content(__('Read more'));?>
	<!--
	<?php trackback_rdf(); ?>
	-->

<div class="yazilar" style="text-align:right"><?php next_post_link('%link &raquo;') ?></div>

	<?php endwhile; else: ?>

	<h1>Error</h1>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
	</div>

<div id="index_sag">

	<h1>Comments</h1>
	<?php comments_template(); // Get wp-comments.php template ?>
	</div>

	</div>
</div>

<?php get_footer(); ?>