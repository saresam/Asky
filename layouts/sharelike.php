<?php 
	/**
	 * sharelike
	 */

?>

		

<?php if ( akina_option('post_like') == 'yes') { ?>
<div class="post-like">
<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="specsZan <?php if(isset($_COOKIE['specs_zan_'.get_the_ID()])) echo 'done';?>" style="padding: 0px">
	<i id="heart_zan" class="iconfont <?php if(isset($_COOKIE['specs_zan_'.get_the_ID()])){echo 'icon-heart';}  else {echo 'icon-heart_line';} ?>"></i> <span class="count">
		<?php if( get_post_meta(get_the_ID(),'specs_zan',true) ){
			echo get_post_meta(get_the_ID(),'specs_zan',true);
		} else {
			echo '0';
		}?></span>
	</a>
</div>
<?php } ?>
<?php if ( akina_option('post_share') == 'yes') { ?>		
<div class="post-share">
	<ul class="sharehidden">
	<li class="wechat" id="weixin" >
		<div class="social_img" style="background-position:center -485px;background-color:rgba(0,0,0,0.00)" title="微信分享">
		
		</div>
		
		</li>
	
	<li><a href="http://connect.qq.com/widget/shareqq/index.html?url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'QQ-share', 'width=490,height=700');return false;" class="s-weixin"><div class="social_img" style="background-position:center -5px;background-color:rgba(0,0,0,0.00)" title="QQ分享"></div></a></li>
	<li><a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'Q-zone-share', 'width=730,height=500');return false;" class="s-qq" title="Qzone分享"><div class="social_img" style="background-position: center -325px;background-color:rgba(0,0,0,0.00)"></div></a></li>
	<li><a href="http://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'weibo-share', 'width=550,height=235');return false;" class="s-sina" title="微博分享"><div class="social_img" style="background-position: center -365px;background-color:rgba(0,0,0,0.00)"></div></a></li>
	
	</ul>
	<div class="share_buttom"><p>分享</p><i class="iconfont show-share icon-share"></i></div>
</div>
	<div id="qrcode-open" class="qrcode-cover">
		<div class="wechat-discrip">
			<span><i class="iconfont icon-wechat" style="margin-right: 5px"></i>扫描二唯码在微信中打开</span>
		</div>
		<div id="qrcode"></div>
	</div>





<?php } ?>

