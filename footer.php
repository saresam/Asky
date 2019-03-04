<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */

?>
	</div><!-- #content引入评论模板 -->
	<?php 
		if(akina_option('general_disqus_plugin_support')){
			get_template_part('layouts/duoshuo');
		}else{
			comments_template('', true); 
		}
	?>
	</div><!-- #page Pjax container-->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="footer-device">
			<?php 
			$statistics_link = akina_option('site_statistics_link') ? '<a href="'.akina_option('site_statistics_link').'" target="_blank" rel="nofollow">Statistics</a>' : '';
			$site_map_link = akina_option('site_map_link') ? '<a href="'.akina_option('site_map_link').'" target="_blank" rel="nofollow">Sitemap</a>' : '';
			printf('<span>Copyright © 2017 . All rights reserved. | </sapn>'. esc_html__( '%1$s &nbsp; %2$s &nbsp; %3$s &nbsp; %4$s', 'akina' ),  $site_map_link, $statistics_link,'<a href="http://skyarea.cn" rel="designer" target="_blank" rel="nofollow">| Theme</a>', '<a href="https://wordpress.org/" target="_blank" rel="nofollow"> | Powered by WordPress</a>'); 
			?>
          
         
           <div>
           	<?php if (akina_option('echo_footer_time_log') == 'yes') { ?>
                数据库查询<?php echo get_num_queries(); ?>次，页面加载<?php timer_stop(1); ?>秒
            <?php } ?>
           </div>
            <!--显示网站已运行多长时间-->
 <?php if (akina_option('web_runtime') != '0'){ 
	$web_buildtime = akina_option('web_buildtime')
          
	?>
           <div class="footer-device">
            <SPAN id=span_dt_dt></SPAN>
     <SCRIPT language=javascript>
				function show_date_time(){
				window.setTimeout("show_date_time()", 1000);
				BirthDay=new Date("<?php echo $web_buildtime ;?>");//这个日期是可以修改的
				today=new Date();
				timeold=(today.getTime()-BirthDay.getTime());
				sectimeold=timeold/1000
				secondsold=Math.floor(sectimeold);
				msPerDay=24*60*60*1000
				e_daysold=timeold/msPerDay
				daysold=Math.floor(e_daysold);
				e_hrsold=(e_daysold-daysold)*24;
				hrsold=Math.floor(e_hrsold);
				e_minsold=(e_hrsold-hrsold)*60;
				minsold=Math.floor((e_hrsold-hrsold)*60);
				seconds=Math.floor((e_minsold-minsold)*60);
				span_dt_dt.innerHTML="<?php bloginfo('name');?>"+"已成功存活了："+daysold+"天"+hrsold+"小时"+minsold+"分"+seconds+"秒";
				}
				show_date_time();
				</SCRIPT>
			</div>
 <?php } ?>

           	
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<div class="openNav">
		<div class="iconflat">	 
			<div class="icon"></div>
		</div>
		<div class="site-branding">
			<?php if (akina_option('akina_logo')){ ?>
			<div class="site-logo"><a href="<?php bloginfo('url');?>" ><img src="<?php echo akina_option('akina_logo'); ?>" alt="<?php bloginfo('name');?>"></a></div>
			<?php }else{ ?>
			<h1 class="site-title"><a href="<?php bloginfo('url');?>" ><?php bloginfo('name');?></a></h1>
			<?php } ?>
		</div>
	</div><!-- m-nav-bar -->
	</section><!-- #section -->
	<!-- m-nav-center -->
	<div id="mo-nav">
		<div class="m-avatar">
			<?php $ava = akina_option('focus_logo') ? akina_option('focus_logo') : get_template_directory_uri().'/images/avatar.jpg'; ?>
			<img src="<?php echo $ava ?>">
		</div>
		<div class="m-search">
			<form class="m-search-form" method="get" action="<?php echo home_url(); ?>" role="search">
				<input class="m-search-input" type="search" name="s" placeholder="<?php _e('搜索...', 'akina') ?>" required>
			</form>
		</div>
		<?php wp_nav_menu( array( 'depth' => 2, 'theme_location' => 'primary', 'container' => false ) ); ?>
	</div><!-- m-nav-center end -->
	<!-- search start -->
	<form class="js-search search-form search-form--modal" method="get" action="<?php echo home_url(); ?>" role="search">
		<div class="search-form__inner">
			<div>
				<p class="micro mb-"><?php _e('输入后按回车搜索 ...', 'akina') ?></p>
				<i class="iconfont icon-search"></i>
				<input class="text-input" type="search" name="s" placeholder="<?php _e('Search', 'akina') ?>" required>
			</div>
		</div>
		<div class="search_close"></div>
	</form>
	<!-- search end -->
   
    <!-- page loading -->
	<div id="loading">
		<div id="loading-center">
 			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			
			
		</div>
	</div> 
    
<?php wp_footer(); ?>
<?php if(akina_option('site_statistics')){ ?>
<div class="site-statistics">
<script type="text/javascript"><?php echo akina_option('site_statistics'); ?></script>
</div>
<?php } ?>

<!-- 波浪动画 -->
<?php if (akina_option('waveloop') != '0'){ ?>
<script>
	$(function () {
		//底部波浪动画
		function waveloop1() {
			$("#banner_bolang_bg_1").css({"left": "-236px"}).animate({"left": "-1233px"}, 25000, 'linear', waveloop1);
		}
		function waveloop2() {
			$("#banner_bolang_bg_2").css({"left": "0px"}).animate({"left": "-1009px"}, 60000, 'linear', waveloop2);
		}
		//循环播放
		if (screen && screen.width > 800) {
		waveloop1();
		waveloop2();
		}
	});
</script>
<?php } ?>


<!-- 引入峰窝canvas 如果屏幕大于480的话 -->
<?php if (akina_option('canvas_nest') != '0'){ ?>
<script>
if (screen && screen.width > 800) {
  document.write('<script src="<?php bloginfo('template_url'); ?>/js/canvas-nest.min.js" type="text/javascript"><\/script>');
}
</script>
<?php } ?>

<!-- nprogress进度条加载 -->
<?php 
if ( akina_option('progress_type') == 'loadprogress') { ?>
	
<script>
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
</script>

<?php }?>


<!-- 统一遮罩-->
<div id="black_mask" class="black_mask"></div>


</body>
</html>