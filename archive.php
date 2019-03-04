<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<?php if(akina_option('patternimg') || !z_taxonomy_image_url()) { ?>
			<header class="page-header">
				<h1 class="cat-title"><?php single_cat_title('', true); ?></h1>
			<span class="cat-des"><i class="iconfont icon-shuidi"></i>
			<?php 
				if(category_description() != ""){ 
					echo "" . category_description(); 
				} 
			?>
			</span>
			</header><!-- .page-header -->
			<?php } // page-header ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();  
				/*
				* 图片展示分类
				*/				
				if ( akina_option('image_category') && is_category(explode(',',akina_option('image_category'))) ){
					get_template_part( 'tpl/content', 'category' );
				} else {
					get_template_part( 'tpl/content', get_post_format() );
				}
				
			endwhile; 
			?>
			<div class="clearer"></div>

		<?php else :

			get_template_part( 'tpl/content', 'none' );

		endif; ?>

		</main><!-- #main -->
		<?php if ( akina_option('pagenav_style') == 'ajax') { ?>
		<div id="pagination" <?php if(akina_option('image_category') && is_category(explode(',',akina_option('image_category')))) echo 'class="pagination-archive"'; ?>><?php next_posts_link(__('下一页')); ?><span></span></div>
		<?php }else{ ?>
		<nav class="navigator">
        <?php previous_posts_link('<i class="iconfont icon-left"></i>') ?><?php next_posts_link('<i class="iconfont icon-right"></i>') ?>
		</nav>
		<?php } ?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
