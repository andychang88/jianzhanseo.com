<div id="footerbg">
<div id="footer">

<div id="footerleft">
	<h2>Search</h2>	
	<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
	<input type="text" name="s" id="s" size="30" value="" tabindex="5" /></form>
	Write a word and hit enter key.
	<a name="arama"></a>
</div>

<div id="footermiddle1">
<h2>Statistics</h2>		
<ul>
<?php
$numposts = (int) $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish'");
$numcomms = (int) $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
$numcats  = wp_count_terms('category');
$numtags = wp_count_terms('post_tag');
$post_str = sprintf(__ngettext('%1$s posts', '%1$s posts', $numposts), number_format_i18n($numposts), '');
$comm_str = sprintf(__ngettext('%1$s comments', '%1$s comments', $numcomms), number_format_i18n($numcomms), '');
$cat_str  = sprintf(__ngettext('%1$s categories', '%1$s categories', $numcats), number_format_i18n($numcats), '');
$tag_str  = sprintf(__ngettext('%1$s tags', '%1$s tags', $numtags), number_format_i18n($numtags));
?>
<li><?php printf(__('%1$s.'), $post_str, $comm_str, $cat_str, $tag_str); ?></li>
<li><?php printf(__('%2$s.'), $post_str, $comm_str, $cat_str, $tag_str); ?></li>
<li><?php printf(__('%3$s.'), $post_str, $comm_str, $cat_str, $tag_str); ?></li>
<li><?php printf(__('%4$s.'), $post_str, $comm_str, $cat_str, $tag_str); ?></li>
<?php if (function_exists(wp_onlinecounter)) {
wp_onlinecounter();
} ?>
</ul>
	
</div>
<div id="footermiddle2">
	<h2>About</h2>
	<br />
	<p>Copyright &copy; <?php echo date("Y"); ?> <a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a><br />
	Powered by <a href="http://www.wordpress.org">WordPress <?php bloginfo('version'); ?></a> and <a href="http://www.hakkiceylan.com/azpismis_v2_wordpress_turkce_tema/" >Azpismis v2</a>, theme by <a href="http://www.hakkiceylan.com" >HC</a>.</p>
</div>

<div id="footerright">
	<?php global $user_ID, $user_identity; get_currentuserinfo(); if (!$user_ID): ?>
		<h2><?php _e('Login'); ?></h2>         
         <form name="loginform" id="loginform" action="<?php echo get_settings('siteurl'); ?>/wp-login.php" method="post">       
			 <?php _e('Username') ?>:<br />
			 <input type="text" name="log" id="log" value="" size="30" tabindex="6" /><br />
			 <?php _e('Password') ?>:<br />
			 <input type="password" name="pwd" id="pwd" value="" size="20" tabindex="7" />
			 <input type="submit" name="submit" id="giris" value="<?php _e('Login'); ?>" tabindex="8" /><br />
			 <input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="9" /><?php _e(' Remember me'); ?>         
			 <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/><br />
         </form>
		<p><br /><?php wp_register('', ''); ?></p>
   
<?php  else:?>
   <h2><?php echo $user_identity; ?></h2>
      <ul>
         <li><a href="<?php echo get_settings('siteurl'); ?>/wp-admin/">Control Panel</a></li>
         <li><a href="<?php echo get_settings('siteurl'); ?>/wp-admin/post-new.php">Send a post</a></li>
         <li><a href="<?php echo get_settings('siteurl'); ?>/wp-admin/profile.php">Profile</a></li>
         <li><a href="<?php echo get_settings('siteurl') . '/wp-login.php?action=logout&amp;redirect_to=' . $_SERVER['REQUEST_URI']; ?>"><?php _e('Logout'); ?></a></li>
      </ul>
<?php  endif;?>
</div>


</div>
</div>
<?php do_action('wp_footer'); ?>
</body>
</html>