
            
        </div>
    </div>

	<div id="body_right">
		<div id="sidebars">
			<?php get_sidebar(); ?>
		</div>
	</div>

</div>
</div>
</div>

<div id="footer">
	<div id="footer_text">
    	<p>&copy; 2007. All Rights Reserved. <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></p>
		<p class="designed">Powered by Andy</b></p>
    </div>
</div>

		<?php wp_footer(); ?>


</div>

<div id="particles"></div>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/particles.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/particles-app.js"></script>

<style type="text/css">
#particles{
  width: 100%;
  height: 100%;
  background-image: none;
  background-size: cover;
  background-position: 50% 50%;
  background-repeat: no-repeat;
  position:absolute;
  top:0px;
  z-index:-1;
}
</style>
</body>
</html>
