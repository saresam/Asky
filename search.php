<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Akina
 */

get_header(); ?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php if (have_posts()) : ?>
        <?php
        if (akina_option('patternimg') || !get_random_bg_url()) : ?>
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        esc_html__('搜索结果: %s', 'akina'),
                        '<span>' . esc_html(get_search_query()) . '</span>'
                    );
                    ?>
                </h1>
            </header>
        <?php endif; ?>

        <?php
        // 循环结构
        while (have_posts()) : 
            the_post();
            get_template_part('tpl/content', get_post_format());
        endwhile;

        the_posts_navigation();

    else : ?>
        <div class="search-box">
		<!-- search start -->
            <form class="s-search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <i class="iconfont icon-search"></i>
                <input class="text-input" type="search" name="s" 
                    placeholder="<?php esc_attr_e('Search...', 'akina') ?>" 
                    value="<?php echo esc_attr(get_search_query()); ?>" required>
            </form>
			<!-- search end -->
        </div>

        <?php get_template_part('tpl/content', 'none'); ?>

    <?php endif; ?>

    </main>
</section>

<?php
get_footer();