<?php 
/**
 Template Name: facetest
 */

get_header();

?>

<?php 
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('my-upload');
        wp_enqueue_style('thickbox'); 
 ?>


<?php




function test_girls(){
	

$path  =  $_POST['img_url'];	
//$path   = 'http://skyarea.cn/wp-content/themes/ASky/images/girl.jpg';
$data   = file_get_contents($path);
$base64 = base64_encode($data);


// 设置请求数据（应用密钥、接口请求参数）
$appkey = 'DnMG3289K0ntHgaO';
$params = array(
    'app_id'     => '2108141203',
    'image'      => $base64,
    'mode'       => '0',
    'time_stamp' => strval(time()),
    'nonce_str'  => strval(rand()),
    'sign'       => '',
);
$params['sign'] = getReqSign($params, $appkey);

$url = 'https://api.ai.qq.com/fcgi-bin/face/face_detectface';
$response = doHttpPost($url, $params);
//echo $response;
	
$jsonStr = $response;
 
$arr = json_decode($jsonStr);
 
$face_id = $arr->data->face_list[0]->face_id;
$gender =$arr->data->face_list[0]->gender;
$age =$arr->data->face_list[0]->age;
$expression =$arr->data->face_list[0]->expression;
$beauty =$arr->data->face_list[0]->beauty;
$glass =$arr->data->face_list[0]->glass;
echo 	
'<p><i class="iconfont icon-message_fill"></i>ID:<span>', $face_id, '</span></p><br>',
'<i class="iconfont icon-shuidi"></i><p>性别：</p><span>', $gender, '</span>----性别 [0~100]（越接近0越倾向为女性，越接近100越倾向为男性）</p><br>',
'<p><i class="iconfont icon-info"></i>年龄：<span>', $age, '</span>----年龄 [0~100]</p><br>',
'<p><i class="iconfont icon-tags"></i>表情：<span>', $expression, '</span>----微笑[0~100] （0-没有笑容，50-微笑，100-大笑）</p><br>',
'<p><i class="iconfont icon-communityfill"></i>魅力：<span>', $beauty, '</span>----魅力 [0~100]</p><br>',
'<p><i class="iconfont icon-heart"></i>眼镜：<span>', $glass, '</span>----是否有眼镜 [0, 1]</p><br>';
}

function getReqSign($params /* 关联数组 */, $appkey /* 字符串*/)
{
    // 1. 字典升序排序
    ksort($params);
	
    // 2. 拼按URL键值对
    $str = '';
    foreach ($params as $key => $value)
    {
        if ($value !== '')
        {
            $str .= $key . '=' . urlencode($value) . '&';
        }
    }

    // 3. 拼接app_key
    $str .= 'app_key=' . $appkey;


    // 4. MD5运算+转换大写，得到请求签名
    $sign = strtoupper(md5($str));
    return $sign;
	
}

// doHttpPost ：执行POST请求，并取回响应结果
// 参数说明
//   - $url   ：接口请求地址
//   - $params：完整接口请求参数（特别注意：不同的接口，参数对一般不一样，请以具体接口要求为准）
// 返回数据
//   - 返回false表示失败，否则表示API成功返回的HTTP BODY部分
function doHttpPost($url, $params)
{
    $curl = curl_init();

    $response = false;
    do
    {
        // 1. 设置HTTP URL (API地址)
        curl_setopt($curl, CURLOPT_URL, $url);
		

        // 2. 设置HTTP HEADER (表单POST)
        $head = array(
            'Content-Type: application/x-www-form-urlencoded'
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $head);

        // 3. 设置HTTP BODY (URL键值对)
        $body = http_build_query($params);
		
		
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);

        // 4. 调用API，获取响应结果
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_NOBODY, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        if ($response === false)
        {
            $response = false;
            break;
        }

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($code != 200)
        {
            $response = false;
            break;
        }
    } while (0);

    curl_close($curl);
    return $response;
}

function img_url(){
	$path  =  $_POST['img_url'];
	echo $path;
}

?>
	<?php while(have_posts()) : the_post(); ?>
	<?php if(akina_option('patternimg') || !get_post_thumbnail_id(get_the_ID())) { ?>
	<span class="linkss-title"><?php the_title();?></span>
	<?php } ?>
	<article <?php post_class("post-item"); ?>>
			
	</article>
<div id="primary" class="content-area">
		<div class="statistics">
		
		
		<div class="post_statistics">
			<div><img src="<?php img_url()?>" alt="" ></div>
			<div><?php test_girls();?></div>
			
			</div>
	<form action="" method="post">
 				<input id="upload_image" name="img_url" type="text" value=""/>
    			<input id="upload_image_button" type="button"  value="上传图片" width="50%" />
				<button type="submit" on_click="test_face()" >检测</button>
		</form>
		</div>
		
		


	</div><!-- #primary -->
  



		
	
 <?php the_reward(); ?>
	<?php endwhile; ?> 
<script>
    jQuery(document).ready(function() {
        jQuery('#upload_image_button').click(function() {
         formfield = jQuery('#upload_image').attr('name');
         // show Wordpress' uploader modal box
         tb_show('', '<?php echo admin_url(); ?>media-upload.php?type=image&amp;TB_iframe=true');
         return false;
        });
        window.send_to_editor = function(html) {
         // this will execute automatically when a image uploaded and then clicked to 'insert to post' button
         imgurl = jQuery('img',html).attr('src');
         // put uploaded image's url to #upload_image
         jQuery('#upload_image').val(imgurl);
         tb_remove();
        }
    });
</script>
<style>
	.post_statistics div{
		margin: 0 10px;
	}
	.post_statistics img{
		width: 150px;
	}
	form{
		display: flex;
		margin 0 10px;
	}
	form input{
		width: 260px;
		margin: 10px 10px;
	}
	form button{
		width: 260px;
		margin: 10px 10px;
	}
</style>


<?php
get_footer();