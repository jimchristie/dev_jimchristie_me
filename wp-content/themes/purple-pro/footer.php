	</div></section>

	<footer><div>

<?php if(is_front_page() & !is_paged() ) { ?>
<p class="powered"><?php _e('Theme created by', 'purple_pro'); ?> <a href="http://thememotive.com/">Theme Motive</a>. <?php _e('Powered by', 'purple_pro'); ?> <a href="http://wordpress.org/">WordPress</a>.</p>
<?php } ?>	
	<div class="clearfix widgets">
        	<div class="cols">
				<div  class="col">
					<?php dynamic_sidebar('footer-widget-area-1'); ?>
				</div >
				<div  class="col">
					<?php dynamic_sidebar('footer-widget-area-2'); ?>
				</div >
			</div>
            <div class="cols">
				<div  class="col">
					<?php dynamic_sidebar('footer-widget-area-3'); ?>
				</div >
				<div  class="col">
					<?php dynamic_sidebar('footer-widget-area-4'); ?>
				</div >
			</div>
        </div >
		<div class="f-menu">
		<?php wp_nav_menu( array('fallback_cb' => 'purple_pro_page_menu', 'container' => false, 'menu' => 'secondary', 'depth' => '1', 'theme_location' => 'secondary', 'link_before' => '', 'link_after' => '') ); ?>
		</div>
	</div></footer>
<?php wp_footer(); ?>	
</body>
</html>