<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

?>

<article class="post post-list" itemscope="" itemtype="http://schema.org/BlogPosting">
<div class="post-status">
 <div class="postava">
  <a href="javascript:;">
  	<?php echo get_avatar(get_the_author_meta('email'), 64 ,get_avatar_profile_url() ); ?>
  </a>
  </div>
  <div class="s-content">
	<p><?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 1000 ,"...");?></p>
	<div class="s-time">
	<?php if(is_sticky()) : ?>
			<i class="iconfont hotpost icon-fire"></i>
		 <?php endif ?>
	  <i class="iconfont icon-clock"></i><?php echo poi_time_since(strtotime($post->post_date_gmt));//the_time('Y-m-d');?>
	  </div>
	</div>
	<footer class="entry-footer">
	<div class="info-meta">
       <div class="comnum">  
        <span><i class="iconfont icon-mark"></i><?php comments_popup_link('NOTHING', '1 条评论', '% 条评论'); ?></span>
		</div>
		<div class="views"> 
		<span><i class="iconfont icon-eye"></i><?php echo get_post_views(get_the_ID()); ?> 热度</span>
		 </div>   
        </div>		
	</footer><!-- .entry-footer -->
	</div>	
	<hr>
</article><!-- #post-## -->

