<?php get_header(); ?>
<div class="main">
	<?php if (have_posts()) : ?>

		<h1><?php echo get_search_query();?></h1>
	
		<?php while (have_posts()) : the_post(); ?>
			<!-- Start: Post -->
			<article <?php post_class(); ?>><div>
			
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> <?php edit_post_link(__('Edit this entry', 'purple_pro'), '', ''); ?></h2>
				<?php the_post_thumbnail(); ?>
				<p class="post-meta"><span class="icon date"></span> <?php the_time( get_option( 'date_format' ) ) ?>, <span class="icon author"></span> <?php the_author(); ?> <span class="icon cats"></span><?php the_category(", "); ?>, <?php if ( comments_open() ) : ?>, <?php comments_popup_link('<span class="icon comments"></span> 0', '<span class="icon comments"></span> 1', '<span class="icon comments"></span> %'); ?> <?php endif; ?></p>
				<?php the_excerpt(); ?>
				<?php if(has_tag()): ?><p class="tags"><span class="icon tags"></span><?php the_tags(""); ?></p><?php endif; ?>
			</div>
			<p class="more"><a href="<?php the_permalink() ?>"><span><?php _e( ' ', 'purple_pro' );?></span></a></p>
			</article>
			<!-- End: Post -->
		<?php endwhile; ?>

		<p class="pagination">
			<span class="prev"><?php next_posts_link("&lsaquo; ".__('Previous Posts', 'purple_pro')) ?></span>
			<span class="next"><?php previous_posts_link(__('Next posts', 'purple_pro')."&rsaquo;") ?></span>
		</p>
	<?php else : ?>
	<h1><?php echo get_search_query();?></h1>
	<article class="post">	
		<div>

		<p><?php _e( 'No posts found. Try a different search?', 'purple_pro' ); ?></p>
		<?php get_search_form(); ?>
		</div>
	</article>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>