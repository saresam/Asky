<?php 
/**
 Template Name: uploadimg
 */

get_header();
?>





	<?php while(have_posts()) : the_post(); ?>
	<?php if(akina_option('patternimg') || !get_post_thumbnail_id(get_the_ID())) { ?>
	<span class="linkss-title"><?php the_title();?></span>
	<?php } ?>
	<article <?php post_class("post-item"); ?>>
			<?php the_content(); ?>
	</article>
	<div id="primary" class="content-area">
		<div class="statistics">
		
		
		<div class="post_statistics">
			<div>
			
				
						<div class="upload">
						<input id="upload_image" name="img_url" type="text" value=""/>
						<input type="button" class="btn" onclick="browerfile.click()" value="上传">
						<input type="file" id="browerfile" style="display: none;" class="test">
						<div class="img_center">
						  <img src="" class="img1-img">
						</div>
					  </div>
			</div>
			</div>
		
		</div>
	</div><!-- #primary -->


     <?php the_reward(); ?>
	<?php endwhile; ?> 





<!-- #以下为实时预览图片-->
<script>
function getObjectURL(file){
  var url = null;
  if(window.createObjectURL != undefined){
    url = window.createObjectURL(file);//basic
  }else if(window.URL != undefined){
    url = window.URL.createObjectURL(file);
  }else if(window.webkitURL != undefined){
    url = window.webkitURL.createObjectURL(file);
  }
 
  return url;
	jQuery('#upload_image').val(url);
	
}
 
//实现功能代码
jQuery(document).ready(function($){
$(function(){
  $("#browerfile").change(function(){
    var path = browerfile.value;
    var objUrl = getObjectURL(this.files[0]);
    if(objUrl){
		console.log("%c 图片地址 %c","background:#9a9da2; color:#ffffff; border-radius:4px;","","http://skyarea.cn",objUrl);
		jQuery('#upload_image').val(objUrl);
      $('.img1-img').attr("src",objUrl);
	  
    }
  })
})
})
</script>

<?php
get_footer();