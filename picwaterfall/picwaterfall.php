<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
	<meta name="referrer" content="no-referrer" />
<title>jQueryʵ�����޼����ٲ�����Ч</title>
<style type="text/css">
/* ��ǩ�ض��� */
body{padding:0;margin:0;background:#ddd url(images/bg.jpg) repeat;}
img{border:none;}
a{text-decoration:none;color:#444;}
a:hover{color:#999;}
#title{width:600px;margin:20px auto;text-align:center;}
/* ����ؼ�֡ */
@-webkit-keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
@-moz-keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
@-ms-keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
@-o-keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
@keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
/* wrap */
#wrap{width:auto;height:auto;margin:0 auto;position:relative;}
#wrap .box{width:280px;height:auto;padding:10px;border:none;float:left;}
#wrap .box .info{width:280px;height:auto;border-radius:8px;box-shadow:0 0 11px #666;background:#fff;}
#wrap .box .info .pic{width:260px;height:auto;margin:0 auto;padding-top:10px;}
#wrap .box .info .pic:hover{
	-webkit-animation:shade 3s ease-in-out 1;
	-moz-animation:shade 3s ease-in-out 1;
	-ms-animation:shade 3s ease-in-out 1;
	-o-animation:shade 3s ease-in-out 1;
	animation:shade 3s ease-in-out 1;
}
#wrap .box .info .pic img{width:260px;border-radius:3px;}
#wrap .box .info .title{width:260px;height:40px;margin:0 auto;line-height:40px;text-align:center;color:#666;font-size:18px;font-weight:bold;overflow:hidden;}
</style>
<?php //echo get_template_directory_uri();?>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
window.onload = function(){
	//�����ٲ��������� 
	PBL('wrap','box');
	//ģ������
	//var data = [{'src':'1.jpg','title':'�ٲ���Ч��'},{'src':'2.jpg','title':'�ٲ���Ч��'},{'src':'3.jpg','title':'�ٲ���Ч��'},{'src':'4.jpg','title':'�ٲ���Ч��'},{'src':'5.jpg','title':'�ٲ���Ч��'},{'src':'6.jpg','title':'�ٲ���Ч��'},{'src':'7.jpg','title':'�ٲ���Ч��'},{'src':'8.jpg','title':'�ٲ���Ч��'},{'src':'9.jpg','title':'�ٲ���Ч��'},{'src':'10.jpg','title':'�ٲ���Ч��'}];
	//var data = loading_img();
	
	var data = loading_img();
	
	//���ù�������
	window.onscroll = function(){
		
		//У����������
		if(getCheck()){
			
			var wrap = document.getElementById('wrap');
			var i=0;
			setTimeout(function x(){
			//document.getElementById('img'+i).src=arr[i].img;
			var box = document.createElement('div');
				box.className = 'box';
				wrap.appendChild(box);
				//����info
				var info = document.createElement('div');
				info.className = 'info';
				box.appendChild(info);
				//����pic
				var pic = document.createElement('div');
				pic.className = 'pic';
				info.appendChild(pic);
				//����img
				var img = document.createElement('img');
				img.src = data[i].img;
					//'images/'+data[i].src;
					
				img.style.height = 'auto';
				pic.appendChild(img);
				//����title
				var title = document.createElement('div');
				title.className = 'title';
				info.appendChild(title);
				//����a���
				var a = document.createElement('a');
				a.innerHTML = data[i].title;
				title.appendChild(a);
				i++;
				data = loading_img(i);
   			if(i < data.length)setTimeout(x,500);
			},500);
			
	//		for(i in data){
//				//����box
//				var box = document.createElement('div');
//				box.className = 'box';
//				wrap.appendChild(box);
//				//����info
//				var info = document.createElement('div');
//				info.className = 'info';
//				box.appendChild(info);
//				//����pic
//				var pic = document.createElement('div');
//				pic.className = 'pic';
//				info.appendChild(pic);
//				//����img
//				var img = document.createElement('img');
//				img.src = data[i].img;
//				//'images/'+data[i].src;
//					
//				img.style.height = 'auto';
//				pic.appendChild(img);
//				//����title
//				var title = document.createElement('div');
//				title.className = 'title';
//				info.appendChild(title);
//				//����a���
//				var a = document.createElement('a');
//				a.innerHTML = data[i].title;
//				title.appendChild(a);
//			}
			
			PBL('wrap','box');
		
		}
		
	}
 

}

/**
* �ٲ���������
* @param  wrap	[Str] ���Ԫ�ص�ID
* @param  box 	[Str] ÿһ��box������
*/
function PBL(wrap,box){
	//	1.�������Լ�ÿһ��box
	var wrap = document.getElementById(wrap);
	var boxs  = getClass(wrap,box);
	
	//	2.�����Ļ����ʾ������
	var boxW = boxs[0].offsetWidth;
	var colsNum = Math.floor(document.documentElement.clientWidth/boxW);
	wrap.style.width = boxW*colsNum+'px';//Ϊ��㸳ֵ���

	//	3.ѭ�������е�box�������ٲ�������
	var everyH = [];//����һ������洢ÿһ�еĸ߶�
	for (var i = 0; i < boxs.length; i++) {
		if(i<colsNum){
			everyH[i] = boxs[i].offsetHeight;
		}else{
			var minH = Math.min.apply(null,everyH);//�����С���еĸ߶�
			var minIndex = getIndex(minH,everyH); //�����С�е�����
			getStyle(boxs[i],minH,boxs[minIndex].offsetLeft,i);
			everyH[minIndex] += boxs[i].offsetHeight;//������С�еĸ߶�
		}
	}
}
	
	
	function loading_img(i){
	var data;
	if (i=20){
	$.ajax({
    url: 'https://api.isoyu.com/index.php/api/Picture/hua_ban',
    async: false,//ͬ����ʽ��������trueΪ�첽����
    type: "GET",
    data: {},
    success: function (result) {
	data = result.data;
 	}
 	});
	return data;}
	console.log("%c �Զ�����ʱ����ʱ %c","background:#9a9da2; color:#ffffff; border-radius:4px;","","http://skyarea.cn",data);
	}
//	
/**
* ��ȡ��Ԫ��
* @param  warp		[Obj] ���
* @param  className	[Str] ����
*/
function getClass(wrap,className){
	var obj = wrap.getElementsByTagName('*');
	var arr = [];
	for(var i=0;i<obj.length;i++){
		if(obj[i].className == className){
			arr.push(obj[i]);
		}
	}
	return arr;
	
}
/**
* ��ȡ��С�е�����
* @param  minH	 [Num] ��С�߶�
* @param  everyH [Arr] �����и߶ȵ�����
*/
function getIndex(minH,everyH){
	for(index in everyH){
		if (everyH[index] == minH ) return index;
	}
}
/**
* �����������
*/
function getCheck(){
	var documentH = document.documentElement.clientHeight;
	var scrollH = document.documentElement.scrollTop || document.body.scrollTop;
	return documentH+scrollH>=getLastH() ?true:false;
}
/**
* ������һ��box�����еĸ߶�
*/
function getLastH(){
	var wrap = document.getElementById('wrap');
	var boxs = getClass(wrap,'box');
	return boxs[boxs.length-1].offsetTop+boxs[boxs.length-1].offsetHeight;
}
/**
* ���ü�����ʽ
* @param  box 	[obj] ���õ�Box
* @param  top 	[Num] box��topֵ
* @param  left 	[Num] box��leftֵ
* @param  index [Num] box�ĵڼ���
*/
var getStartNum = 0;//����������ص�������λ��
function getStyle(box,top,left,index){
    if (getStartNum>=index) return;
    $(box).css({
    	'position':'absolute',
        'top':top,
		
        "left":left,
        "opacity":"0"
    });
	console.log("%c �߶� %c","background:#9a9da2; color:#ffffff; border-radius:4px;","","http://skyarea.cn",top);
    $(box).stop().animate({
        "opacity":"1"
    },999);
    getStartNum = index;//�����������ݵ�����λ��
}
</script>


</head>
<body>
	<div id="wrap">
	
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/1.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/2.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/3.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/4.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
	
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/5.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/6.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/7.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/8.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/9.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/10.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
			<div class="box">
			<div class="info">
				<div class="pic"><img src="images/6.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/7.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/8.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/9.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="images/10.jpg"></div>
				<div class="title"><a href="http://www.5icool.org/" target="_blank">�ٲ���Ч��</a></div>
			</div>
		</div>
		
	</div>
</body>
</html>