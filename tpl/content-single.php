<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(akina_option('patternimg')) { ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<p class="entry-census"><i class="iconfont icon-clock"><?php echo poi_time_since(strtotime($post->post_date_gmt)); ?>&nbsp;&nbsp;<i class="iconfont icon-fire"></i><?php echo get_post_views(get_the_ID()); ?> 次阅读</p>
		<hr>
	</header><!-- .entry-header  -->
	<?php } ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ondemand' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content id="saveImg" -->
	<?php the_reward(); ?>

	<footer class="post-footer">
	<div class="post-lincenses site-info"><a href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh-hans" target="_blank" rel="noopener noreferrer">知识共享（CC）协议：署名—非商业性使用—相同方式共享 4.0 协议国际版</a></div>
	<div class="post-tags">
		<?php if ( has_tag() ) { echo '<i class="iconfont icon-tags"></i> '; the_tags('', ' ', ' ');}?>
	</div>
    <?php get_template_part('layouts/sharelike'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
