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
<style type="text/css">
.page_error{font-size:36px;position:absolute;top:10%;z-index:1000;width:800px;left:50%;margin-left:-400px;text-align:center;font-weight:700;border:1px solid #fff;color:#666;-webkit-border-radius:20px;-moz-border-radius:20px;border-radius:20px}.err-button.back{font-family:microsoft yahei;text-align:center;position:absolute;top:65%;z-index:1000;width:100%}.err-button.back a{padding:10px 30px;display:block;border:1px solid #fff;color:#666;width:300px;-webkit-border-radius:20px;-moz-border-radius:20px;border-radius:20px;margin:20px auto;font-weight:700}#gohome{background:#EBEBEB;color:#666}#golast{background:#EBEBEB;color:#EDA9AB}.err-button.back a:hover{-webkit-box-shadow:5px 0 6px rgba(255,255,255,1);-moz-box-shadow:5px 0 6px rgba(255,255,255,1);-o-box-shadow:5px 0 6px rgba(255,255,255,1);box-shadow:5px 0 6px rgba(255,255,255,1)}.roadtowest{height:100%;width:100%;-webkit-background-size:cover;background-size:cover;overflow:hidden;position:relative}.roadtowest ul{height:100%;width:3920px;position:absolute;top:0;left:0;animation:dong 50s linear infinite}@keyframes dong{0%{left:0}100%{left:1920px}}.roadtowest ul li{height:100%;width:100%;background:url(images/gowest/road.jpg);float:left;margin-left:-2000px;list-style:none}.wk,.bj,.ts,.ss{background:url(images/gowest/allmen.png) no-repeat}.wk{z-index:999;width:200px;height:160px;background-position:0 -215px;position:absolute;top:40%;left:30%;animation:wkzou 1s steps(8) infinite}@media (max-width:480px){.wk{top:43%;left:-8%;animation:wkzou 1s steps(8) infinite}}@keyframes wkzou{to{background-position:-1600px -215px}}.bj{z-index:999;width:200px;height:170px;background-position:0 -375px;position:absolute;top:35%;left:40%;animation:bjzou 1s steps(8) infinite}@media (max-width:480px){.bj{top:48%;left:15%;animation:bjzou 1s steps(8) infinite}}@keyframes bjzou{to{background-position:-1600px -375px}}.ts{z-index:999;width:170px;height:220px;background-position:0 0;position:absolute;top:33%;left:50%;animation:tszou 1s steps(8) infinite}@media (max-width:480px){.ts{top:40%;left:30%;animation:tszou 1s steps(8) infinite}}@keyframes tszou{to{background-position:-1360px 0}}.ss{z-index:999;width:210px;height:170px;background-position:0 -545px;position:absolute;top:40%;left:62%;animation:sszou 1s steps(8) infinite}@media (max-width:480px){.ss{top:43%;left:40%;animation:sszou 1s steps(8) infinite}.page_error{font-size:25px;}}@keyframes sszou{to{background-position:-1680px -545px}}
</style>
</head>
<body>
<section class="error-404 not-found">
<div class="page_error">施主，您要取的经书404了</div>	
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

</html>


