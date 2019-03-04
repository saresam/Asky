<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */
get_header();
?>
   
   <?php if ( akina_option('head_notice') != '0'){ 
   		$text = akina_option('notice_title');
		$text_cusor= akina_option('notice-cursor');
   	?>
	<div class="notice">
	   <i class="iconfont icon-shuidi"></i>
	  <?php if(strlen($text) > 142 && !wp_is_mobile()){ ?> 
	  	<marquee align="middle" behavior="scroll" loop="-1" scrollamount="6" style="margin: 0 8px 0 20px; display: block;" onMouseOut="this.start()" onMouseOver="this.stop()">
			<div class="notice-content"><?php echo $text; ?> <?php echo get_totalviews('true');?> <span class="notice-cursor"><?php echo $text_cusor;?></span> </div>
		</marquee>
		<?php }else{ ?>
        <!--加入类光标动画文字-->
			<div class="notice-content"><?php echo $text; ?><span class="notice-cursor"><?php echo $text_cusor;?></span> </div>
		<?php } ?>
	</div>
	<?php } ?>
	
	<?php 
		if(akina_option('top_feature')=='1'){
			get_template_part('layouts/feature');
		}
	?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">	
		<h1 class="main-title"><i class="iconfont icon-message_fill" style="margin-right: 5px"></i>Posts</h1>
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

			<?php
			endif;
			/* Start the Loop */
			if(akina_option('post_list_style') == 'standard'){
				while ( have_posts() ) : the_post();
				get_template_part( 'tpl/content', get_post_format() );
				endwhile; 
			}else{
				get_template_part( 'tpl/content', 'thumb' );
			}
		?>
		<?php else : get_template_part( 'tpl/content', 'none' ); endif; ?>
		</main><!-- #main -->
		<?php if ( akina_option('pagenav_style') == 'ajax') { ?>
		<div id="pagination"><?php next_posts_link(__('下一页')); ?></div>
		<div id="add_post"><span id="add_post_time" <?php if ( akina_option('auto_load_post','') != '3600' and akina_option('auto_load_post','') != '0' ) { ?> style="-webkit-transition:<?php echo akina_option('auto_load_post',''); ?>s;transition: <?php echo akina_option('auto_load_post'); ?>s;"<?php } else{ ?> style="visibility: hidden;" <?php } ?> title="<?php echo akina_option('auto_load_post',''); ?>"  ></span></div>
		<?php }else{ ?>
		<nav class="navigator">
		<?php previous_posts_link('<i class="iconfont icon-left"></i>') ?><?php next_posts_link('<i class="iconfont icon-right"></i>') ?>
		</nav>
		<?php } ?>
	</div><!-- #primary -->
<?php
get_footer();