<?php get_header(); ?>

<div id="index_ana">
<div id="index_sol">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php the_content(__('Read more'));?>
 			
	<!--
	<?php trackback_rdf(); ?>
	-->
	
	<?php endwhile; else: ?>

	<h1>Error</h1>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>

</div>	

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>