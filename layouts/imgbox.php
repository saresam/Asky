<?php

$img_download = get_random_bg_url()? get_random_bg_url():'';
$image_file = 'background-image: url('.$img_download.');';
$bg_style = akina_option('focus_height') ? 'background-position: center center;background-attachment: inherit;' : '';
?>
<figure id="centerbg" class="centerbg" style="<?php echo $image_file.$bg_style ?>" title="<?php bloginfo('name');?>">
<?php if (akina_option('waveloop') != '0'){ ?>
     <div id="banner_bolang_bg_1"></div>
     <div id="banner_bolang_bg_2"></div>
<?php } ?>
	<?php if ( !akina_option('focus_infos') ){ ?>
	<div class="focusinfo">
   		<?php if (akina_option('focus_logo')):?>
	     <div class="header-tou"><a href="<?php bloginfo('url');?>" ><img src="<?php echo akina_option('focus_logo', ''); ?>" alt="<?php bloginfo('name');?>"></a></div>
	  	<?php else :?>
         <div class="header-tou" ><a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url'); ?>/images/avatar.jpg"></a></div>	
      	<?php endif; ?>
		<div class="header-info"><p><?php echo akina_option('admin_des', 'Carpe Diem and Do what I like'); ?></p></div>
		<div class="top-social">
		<?php if (akina_option('wechat')){ ?>
		<li class="wechat"><a href="#"><div class="social_img" style="background-position:center -485px"></div></a>
			<div class="wechatInner">
				<img src="<?php echo akina_option('wechat', ''); ?>" alt="微信公众号">
			</div>
		</li>
		<?php } ?> 
		<?php if (akina_option('sina')){ ?>
		<li><a href="<?php echo akina_option('sina', ''); ?>" target="_blank" class="social-sina" title="sina"><div class="social_img" style="background-position: center -365px"></div></a></li>
		<?php } ?>
		<?php if (akina_option('qq')){ ?>
		<li class="qq"><a href="//wpa.qq.com/msgrd?v=3&uin=<?php echo akina_option('qq', ''); ?>&site=qq&menu=yes" target="_blank" title="Initiate chat ?"><div class="social_img" style="background-position:center -5px"></div></a></li>
		<?php } ?>	
		<?php if (akina_option('qzone')){ ?>
		<li><a href="<?php echo akina_option('qzone', ''); ?>" target="_blank" class="social-qzone" title="qzone"><div class="social_img" style="background-position: center -325px"></div></a></li>
		<?php } ?>
		<?php if (akina_option('github')){ ?>
		<li><a href="<?php echo akina_option('github', ''); ?>" target="_blank" class="social-github" title="github"><div class="social_img" style="background-position:center -125px"></div></a></li>
		<?php } ?>	
		<?php if (akina_option('lofter')){ ?>
		<li><a href="<?php echo akina_option('lofter', ''); ?>" target="_blank" class="social-lofter" title="lofter"><div class="social_img" style="background-position:center -245px"></div></a></li>
		<?php } ?>	
		<?php if (akina_option('bili')){ ?>
		<li><a href="<?php echo akina_option('bili', ''); ?>" target="_blank" class="social-bili" title="bilibili"><div class="social_img" style="background-position:center -45px"></div></a></li>
		<?php } ?>
		<?php if (akina_option('youku')){ ?>
		<li><a href="<?php echo akina_option('youku', ''); ?>" target="_blank" class="social-youku" title="youku"><div class="social_img" style="background-position:center -525px"></div></a></li>
		<?php } ?>
		<?php if (akina_option('wangyiyun')){ ?>
		<li><a href="<?php echo akina_option('wangyiyun', ''); ?>" target="_blank" class="social-wangyiyun" title="CloudMusic"><div class="social_img" style="background-position:center -445px"></div></a></li>
		<?php } ?>
		<?php if (akina_option('twitter')){ ?>
		<li><a href="<?php echo akina_option('twitter', ''); ?>" target="_blank" class="social-wangyiyun" title="Twitter"><div class="social_img" style="background-position:center -405px"></div></a></li>
		<?php } ?>	
		<?php if (akina_option('facebook')){ ?>
		<li><a href="<?php echo akina_option('facebook', ''); ?>" target="_blank" class="social-wangyiyun" title="Facebook"><div class="social_img" style="background-position:center -85px"></div></a></li>
		<?php } ?>	
		<?php if (akina_option('googleplus')){ ?>
		<li><a href="<?php echo akina_option('googleplus', ''); ?>" target="_blank" class="social-wangyiyun" title="Google+"><div class="social_img" style="background-position: center -165px"></div></a></li>
			<?php } ?>	
				
	  	</div>		 
	</div>
	<?php } ?>
	<img src="<?php echo $img_download ?>" alt="右键下载背景图"  style="position: absolute; bottom: 90px;right: 5px; width: 32px; height: 32px; padding: 1px;z-index: 100;border-radius: 100%;object-fit: cover">
</figure>


<?php
echo bgvideo(); //BGVideo 