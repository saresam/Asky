<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Akina
 */

 ?>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" >
<title itemprop="name"><?php global $page, $paged;wp_title( '-', true, 'right' );
bloginfo( 'name' );$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) ) echo " - $site_description";if ( $paged >= 2 || $page >= 2 ) echo ' - ' . sprintf( __( '第 %s 页'), max( $paged, $page ) );?>
</title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<section class="error-404 not-found">
<div class="page_error">您要的经书404了</div>	
<div class="err-button back">
<a id="golast" href=javascript:history.go(-1);>返回女儿国</a>
<a id="gohome" href="<?php bloginfo('url');?>">返回东土大唐</a>  
</div>
<div class="wk"></div>
<div class="bj"></div>
<div class="ts"></div>
<div class="ss"></div>
<div class="roadtowest">
<ul>
<li></li>
<li></li>
</ul>
</div>

</section>
</body>


