<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

$i=0; while ( have_posts() ) : the_post(); $i++;
$class = ($i%2 == 0) ? 'post-list-thumb-left' : ''; // 如果为偶数
if(has_post_thumbnail()){
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	$post_img = $large_image_url[0];
}else{
    if ( !empty( get_post_thumb( ) ) ) {
        $post_img = get_post_thumb( 'false' );
	} else {
		$post_img = 'https://cbu01.alicdn.com/img/ibank/2017/918/632/7933236819_1641696839.jpg';
    }
}
$the_cat = get_the_category();
?>
	<article class="post post-list-thumb" itemscope="" itemtype="http://schema.org/BlogPosting">
	<a>
		<a href="<?php the_permalink(); ?>">
			    <img src="<?php echo akina_option('focus_logo', ''); ?>" style="float: left;border-radius: 15px;height: 50px;width: 50px;">
	    	<a href="<?php the_permalink(); ?>" style="float: left;">
		    	<h4 style="margin-left: 10px;margin-top: 0px;margin-bottom: 0px;"><?php bloginfo('name');?>
		    		<img src="https://cbu01.alicdn.com/img/ibank/2020/928/794/20520497829_1413442486.jpg" style="margin-left: 5px;">
		    	</h4>
		    	<span class="post-date" style="padding-left: 10px;"><i class="iconfont icon-clock"></i><?php echo poi_time_since(strtotime($post->post_date_gmt)); ?><?php if(is_sticky()) : ?><i class="iconfont hotpost icon-fire"></i><?php endif ?><?php esc_html_e(' 来自 博客 ', 'akina'); ?><?php bloginfo('url');?>
		    	</span>
	    	</a></a>
	</a>
		<a href="<?php the_permalink(); ?>" class="post-title" style="width: 92%;float: right;"><h3><?php the_title();?></h3></a>
		<?php if( !empty( get_post_thumb( ) ) ) : ?>
			<div class="post-thumb">
				<a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><img src="<?php echo $post_img; ?>" " alt="<?php the_title();?>"></a>
			</div><!-- thumbnail-->
		<?php endif ?>
		<div class="post-content-wrap">
			<div class="post-content">
				<div class="float-content">
					<p class="post-text" style="width: 92%;float: right;"><?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 280," ...");?></p>
				</div>
				<div class="post-meta" style="margin-top: 10px;width: 92%;float: right;">
					<span><i class="iconfont icon-eye"></i><?php echo get_post_views(get_the_ID()); ?> </span>
					<span class="comments-number"><i class="iconfont icon-mark"></i><?php comments_popup_link('0', '1 ', '% '); ?>
					</span>
					<?php if ( akina_option('post_like') == 'yes') { ?>
					<span class="post-like">
					<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="specsZan <?php if(isset($_COOKIE['specs_zan_'.get_the_ID()])) echo 'done';?>" style="padding: 0px">
						<i id="heart_zan" class="iconfont <?php if(isset($_COOKIE['specs_zan_'.get_the_ID()])){echo 'icon-heart';}  else {echo 'icon-heart_line';} ?>"></i> <span class="count">
							<?php if( get_post_meta(get_the_ID(),'specs_zan',true) ){
								echo get_post_meta(get_the_ID(),'specs_zan',true);
							} else {
								echo '0';
							}?></span>
						</a>
					</span>
					<?php } ?>
				</div>
			</div>
		</div>
	</article>
<?php
endwhile; 