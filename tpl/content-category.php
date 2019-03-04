<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */
 
 if(has_post_thumbnail()){
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	$post_img = $large_image_url[0];
}

?>
<article class="post works-list" itemscope="" itemtype="http://schema.org/BlogPosting">
<div class="works-entry">
<div class="works-main">
<div class="works-feature">
	<?php if ( has_post_thumbnail() ) { ?>
		<a href="<?php the_permalink();?>" style="background-image: url(<?php echo $post_img; ?>);"></a>
		<?php } else {?>
		<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_url'); ?>/images/temp.jpg" /></a>
		<?php } ?>
	</div>
	
 	<div class="works-content">
	<h1 class="works-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
	<p><?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 80,"...");?></p>
	<div class="works-meta">
	<div class="works-p-time">		
	  <i class="iconfont icon-clock"></i> <?php the_time('Y-m-d');?>
	  </div>
       <div class="works-comnum">  
        <span><i class="iconfont icon-mark"></i> <?php comments_popup_link('暂无', '1 ', '% '); ?></span>
		</div>
		<div class="works-views"> 
		<span><i class="iconfont icon-eye"></i>  <?php echo get_post_views(get_the_ID()); ?> </span>
		 </div>   
        </div>
     </div>		
	<!-- .entry-footer -->
	</div>	
	</div>	
	
</article><!-- #post-## -->




