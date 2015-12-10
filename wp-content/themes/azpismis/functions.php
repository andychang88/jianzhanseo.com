<?php
if ( function_exists('register_sidebar') )
    register_sidebars(2, array(
        'before_widget' => '<div class="widgets">',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ));
    
function widget_mytheme_arama() {
?>
	<h1>Search</h1>	
	<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
	<input type="text" name="s" id="s" size="30" value=""/></form>
	Write a word and hit enter key.
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Azpismis search'), 'widget_mytheme_arama');

?>