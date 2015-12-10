<?php get_header(); ?>
   <div id="sayfa">
      <div id="sayfa_sol">
			<div class="sayfalar">
            <p align="center"><?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { posts_nav_link(' &#8212; ', __('&laquo; Prev'), __('Next &raquo;'));} ?></p>			
			</div>
         <?php $post = $posts[0]; ?>
         <?php 
         if (is_category()) { ?>				
            <h1>Archive for the '<?php echo single_cat_title(); ?>' Category</h1>
         <?php }	 
         elseif (is_day()) { ?>
            <h1>Archive for <?php the_time('F jS, Y'); ?></h1>
         <?php }	
         elseif (is_month()) { ?>
            <h1>Archive for <?php the_time('F, Y'); ?></h1>
         <?php }	
         elseif (is_year()) { ?>
            <h1>Archive for <?php the_time('Y'); ?></h1>
         <?php }	
         elseif (is_search()) { ?>
            <h1>Search Results</h1>
         <?php }	
         elseif (is_author()) { ?>
            <h1>Author Archive</h1>
         <?php }	 
         elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            <h1>Archive</h1>
         <?php } ?>
         <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
         <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
         <p>Yazan: <?php the_author() ?> | <?php the_time('d F Y'); ?> | <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><br />Categories: <?php the_category(', ') ?></p>  
         <?php the_excerpt(); ?>
               
         <!--
         <?php trackback_rdf(); ?>
         -->
	
         <?php comments_template(); // Get wp-comments.php template ?>
         <?php endwhile; else: ?><?php endif; ?>
         
			<div class="sayfalar">
            <p align="center"><?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { posts_nav_link(' &#8212; ', __('&laquo; Prev'), __('Next &raquo;'));} ?></p>			
			</div>		
      </div>
      <?php get_sidebar(); ?>
   </div>
<?php get_footer(); ?>