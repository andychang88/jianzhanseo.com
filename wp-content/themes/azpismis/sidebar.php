<div id="sagtaraf">
   <div class="sayfalist1">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

      <h1>Recently Written</h1>
      <ul><?php get_archives('postbypost', 16); ?></ul>
      <h1>Archives</h1>	
      <ul><?php get_archives('monthly','12'); ?></ul>
<?php endif; ?>
   </div>
   <div class="sayfalist2">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>	
<a href="<?php bloginfo('rss2_url'); ?>" title="RSS feed"><img src="<?php bloginfo('template_url'); ?>/images/rss.jpg" alt="rss" style="border:0;"/></a>
      <?php if (function_exists('get_flickrrss')) { ?>
      <h1>Recently Pictures</h1>
      <?php get_flickrrss(); ?>
      <?php } ?>      
      <?php if (function_exists('get_recent_comments')) { ?>
      <h1>Last Comments</h1>
      <ul><?php get_recent_comments(); ?></ul>
      <?php } ?>
      <h1>Categories</h1>
      <ul><?php wp_list_cats('sort_column=name'); ?></ul>      
      <h1>Links</h1>
      <ul>
      <?php get_links(-1, '<li>', '</li>', '', TRUE, 'url', FALSE); ?>
      </ul>
<?php endif; ?>
   </div>
</div>