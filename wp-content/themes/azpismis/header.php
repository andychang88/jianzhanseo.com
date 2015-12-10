<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="robots" content="follow, all" />
<meta name="language" content="tr, en" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon" />
<?php wp_head(); ?>
<style type="text/css" media="screen">
<!-- @import url( <?php bloginfo('stylesheet_url'); ?> ); -->
</style>
</head>
<body>
<div id="navbar">
   <div id="navbarleft"></div>
   <div id="navbarright">
      <ul>
         <li><a href="<?php echo get_settings('home'); ?>">Home</a></li>
         <?php wp_list_pages('title_li=&depth=1'); ?>		
         <li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS feed">RSS</a></li>
      </ul>	
      <div class="blogbaslik">
         <a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a>
      </div>      
      <div class="blogaciklama">
         <a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('description'); ?></a>
      </div>
   </div>
</div>