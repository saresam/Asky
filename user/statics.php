<?php 
/**
 Template Name: Statics
 */

get_header();
?>


	<?php while(have_posts()) : the_post(); ?>

	<article <?php post_class("post-item"); ?>>
			<?php the_content(); ?>
	</article>
	<div id="primary" class="content-area">
		<div class="statistics">
		
		<!--<div class="img_statistics"><img src="https://api.isoyu.com/mm_images.php"  alt="姬长信api" /></div>-->
		<div class="post_statistics">
			
			<div><?php echo simple_stats();?>
			</div>
		
		</div>
		
		
		

	</div><!-- #primary -->
     <?php the_reward(); ?>
	 <?php endwhile; ?> 
<?php
get_footer();
?>