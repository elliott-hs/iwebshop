<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo isset($item['name'])?$item['name']:"";?>_商品清晰图</title>
	<link type="image/x-icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" rel="icon">
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/jquerySlider/jquery.bxslider.min.js"></script><link rel="stylesheet" type="text/css" href="/iwebshop/runtime/_systemjs/jquerySlider/jquery.bxslider.css" />
	<style type="text/css">
	body {
	    font: 12px/1.5 "宋体",Arial,Helvetica,sans-serif;
	    text-align: center;
	}
	.goodsTitle{font-size:14px;clear:both;background-color: #f7f7f7; border: 1px solid #ddd;height:35px;line-height:35px;margin-bottom:10px}

	.header {
	    color: #848484;
	    height: 63px;
	    text-align: right;
	}
	.header .logo {
	    float: left;
	    height: 53px;
	    overflow: hidden;
	    width: 250px;
	}
	.header .logo a {
	    display: block;
	    height: 53px;
	    line-height: 53px;
	    text-indent: 9999px;
	}
	</style>
</head>
<body>

<div class="header">
	<h1 class="logo"><a title="<?php echo $this->_siteConfig->name;?>" style="background:url(<?php if($this->_siteConfig->logo){?><?php echo IUrl::creatUrl("")."".$this->_siteConfig->logo."";?><?php }else{?><?php echo $this->getWebSkinPath()."images/front/logo.gif";?><?php }?>);" href="<?php echo IUrl::creatUrl("");?>"><?php echo $this->_siteConfig->name;?></a></h1>
</div>

<div class="goodsTitle red2">
	<a href="<?php echo IUrl::creatUrl("/site/products/id/".$id."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a>
	<span style="float:right"><a href="<?php echo IUrl::creatUrl("/site/products/id/".$id."");?>">返回商品页面</a></span>
</div>

<ul class="pic_thumb">
	<?php foreach($photo as $key => $item){?>
	<li>
		<a href='javascript:changeImage("<?php echo IUrl::creatUrl("")."".$item['img']."";?>");'>
			<img style="border:1px solid #ccc;margin-bottom:10px;" src='<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/70/h/70");?>' width="70px" height="70px" />
		</a>
	</li>
	<?php }?>
</ul>

<hr/>

<div style="padding:15px 0px;margin: 0 auto;">
	<img src="" id="bigImg" style="width:570px;border:1px solid #ccc;" />
</div>

<hr/>

<div class="footer">
	<?php echo IFilter::stripSlash($this->_siteConfig->site_footer_code);?>
</div>

<script language="javascript">
//切换图片
function changeImage(img)
{
	$('#bigImg').prop("src",img);
}

//图片初始化
var goodsBigPic = "";

//存在图片数据时候
<?php if(isset($photo) && $photo){?>
goodsBigPic = "<?php echo IUrl::creatUrl("")."".$photo['0']['img']."";?>";
<?php }?>

//初始化商品轮换图
$('.pic_thumb').bxSlider({
	infiniteLoop: false,
	hideControlOnEnd: true,
	pager:false,
	minSlides: 25,
	maxSlides: 25,
	slideWidth: 72,
	slideMargin: 15,
	controls:true,
	onSliderLoad:function(currentIndex){
		//设置图片
		$('#bigImg').prop('src',goodsBigPic);
	}
});
</script>

</body>
</html>