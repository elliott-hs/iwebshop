<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $this->_siteConfig->name;?></title>
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/index.css";?>" />
	<link rel="shortcut icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" />
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iwebshop/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iwebshop/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/common.js";?>"></script>
	<script type='text/javascript' src='<?php echo $this->getWebViewPath()."javascript/site.js";?>'></script>
</head>
<body class="index">
<div class="ucenter container">
	<div class="header">
		<h1 class="logo"><a title="<?php echo $this->_siteConfig->name;?>" style="background:url(<?php if($this->_siteConfig->logo){?><?php echo IUrl::creatUrl("")."".$this->_siteConfig->logo."";?><?php }else{?><?php echo $this->getWebSkinPath()."images/front/logo.gif";?><?php }?>) center no-repeat;background-size:contain;" href="<?php echo IUrl::creatUrl("");?>"><?php echo $this->_siteConfig->name;?></a></h1>
		<ul class="shortcut">
			<li class="first"><a href="<?php echo IUrl::creatUrl("/ucenter/index");?>">我的账户</a></li><li><a href="<?php echo IUrl::creatUrl("/ucenter/order");?>">我的订单</a></li><li class='last'><a href="<?php echo IUrl::creatUrl("/site/help_list");?>">使用帮助</a></li>
		</ul>
		<p class="loginfo"><?php echo isset($this->user['username'])?$this->user['username']:"";?>您好，欢迎您来到<?php echo $this->_siteConfig->name;?>购物！[<a class='reg' href="<?php echo IUrl::creatUrl("/simple/logout");?>">安全退出</a>]</p>
	</div>
	<div class="navbar">
		<ul>
			<li><a href="<?php echo IUrl::creatUrl("");?>">首页</a></li>
			<?php foreach(Api::run('getGuideList') as $key => $item){?>
			<li><a href="<?php echo IUrl::creatUrl("".$item['link']."");?>"><?php echo isset($item['name'])?$item['name']:"";?><span> </span></a></li>
			<?php }?>
		</ul>
		<div class="mycart" name="mycart">
			<dl>
				<dt><a href="<?php echo IUrl::creatUrl("/simple/cart");?>">购物车<b name="mycart_count">0</b>件</a></dt>
				<dd><a href="<?php echo IUrl::creatUrl("/simple/cart");?>">去结算</a></dd>
			</dl>

			<!--购物车浮动div 开始-->
			<div class="shopping" id='div_mycart' style='display:none;'>
			</div>
			<!--购物车浮动div 结束-->

			<!--购物车模板 开始-->
			<script type='text/html' id='cartTemplete'>
			<dl class="cartlist">
				<%for(var item in goodsData){%>
				<%var data = goodsData[item]%>
				<dd id="site_cart_dd_<%=item%>">
					<div class="pic f_l"><img width="55px" height="55px" src="<?php echo IUrl::creatUrl("")."<%=data['img']%>";?>"></div>
					<h3 class="title f_l"><a href="<?php echo IUrl::creatUrl("/site/products/id/<%=data['goods_id']%>");?>"><%=data['name']%></a></h3>
					<div class="price f_r t_r">
						<b class="block">￥<%=data['sell_price']%> x <%=data['count']%></b>
						<input class="del" type="button" value="删除" onclick="removeCart('<%=data['id']%>','<%=data['type']%>');$('#site_cart_dd_<%=item%>').hide('slow');" />
					</div>
				</dd>
				<%}%>

				<dd class="static"><span>共<b name="mycart_count"><%=goodsCount%></b>件商品</span>金额总计：<b name="mycart_sum">￥<%=goodsSum%></b></dd>

				<%if(goodsData){%>
				<dd class="static">
					<label class="btn_orange"><input type="button" value="去购物车结算" onclick="window.location.href='<?php echo IUrl::creatUrl("/simple/cart");?>';" /></label>
				</dd>
				<%}%>
			</dl>
			</script>
			<!--购物车模板 结束-->

		</div>
	</div>

	<div class="searchbar">
		<div class="allsort">
			<a href="javascript:void();">全部商品分类</a>

			<!--总的商品分类-开始-->
			<ul class="sortlist" id='div_allsort' style='display:none'>
				<?php foreach(Api::run('getCategoryListTop') as $key => $first){?>
				<li>
					<h2><a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$first['id']."");?>"><?php echo isset($first['name'])?$first['name']:"";?></a></h2>

					<!--商品分类 浮动div 开始-->
					<div class="sublist" style='display:none'>
						<div class="items">
							<strong>选择分类</strong>
							<?php foreach(Api::run('getCategoryByParentid',array('#parent_id#',$first['id'])) as $key => $second){?>
							<dl class="category selected">
								<dt>
									<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$second['id']."");?>"><?php echo isset($second['name'])?$second['name']:"";?></a>
								</dt>

								<dd>
									<?php foreach(Api::run('getCategoryByParentid',array('#parent_id#',$second['id'])) as $key => $third){?>
									<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$third['id']."");?>"><?php echo isset($third['name'])?$third['name']:"";?></a>|
									<?php }?>
								</dd>
							</dl>
							<?php }?>
						</div>
					</div>
					<!--商品分类 浮动div 结束-->
				</li>
				<?php }?>
			</ul>
			<!--总的商品分类-结束-->

		</div>

		<div class="searchbox">
			<form method='get' action='<?php echo IUrl::creatUrl("/");?>'>
				<input type='hidden' name='controller' value='site' />
				<input type='hidden' name='action' value='search_list' />
				<input class="text" type="text" name='word' autocomplete="off" value="" placeholder="请输入关键词..."  />
				<input class="btn" type="submit" value="商品搜索" />
			</form>
		</div>

		<div class="hotwords">热门搜索：
			<?php foreach(Api::run('getKeywordList') as $key => $item){?>
			<?php $tmpWord = urlencode($item['word']);?>
			<a href="<?php echo IUrl::creatUrl("/site/search_list/word/".$tmpWord."");?>"><?php echo isset($item['word'])?$item['word']:"";?></a>
			<?php }?>
		</div>
	</div>

	<div class="position">
		您当前的位置： <a href="<?php echo IUrl::creatUrl("");?>">首页</a> » <a href="<?php echo IUrl::creatUrl("/ucenter/index");?>">我的账户</a>
	</div>
	<div class="wrapper clearfix">
		<div class="sidebar f_l">
			<img src="<?php echo $this->getWebSkinPath()."images/front/ucenter/ucenter.gif";?>" width="180" height="40" />

			<?php $index=0;?>
			<?php foreach(menuUcenter::init() as $key => $item){?>
			<?php $index++;?>
			<div class="box">
				<div class="title"><h2 class='bg<?php echo isset($index)?$index:"";?>'><?php echo isset($key)?$key:"";?></h2></div>
				<div class="cont">
					<ul class="list">
						<?php foreach($item as $moreKey => $moreValue){?>
						<li><a href="<?php echo IUrl::creatUrl("".$moreKey."");?>"><?php echo isset($moreValue)?$moreValue:"";?></a></li>
						<?php }?>
					</ul>
				</div>
			</div>
			<?php }?>
		</div>
		<div class="main f_r">

	<div class="uc_title m_10">
		<label><span><a href='<?php echo IUrl::creatUrl("/ucenter/account_log");?>'>交易记录</a></span></label>
		<label class="current"><span><a href='<?php echo IUrl::creatUrl("/ucenter/withdraw");?>'>提现申请</a></span></label>
	</div>

	<div class="prompt m_10">
		<p>账户余额：<b class="orange f14">￥<?php echo isset($this->memberRow['balance'])?$this->memberRow['balance']:"";?></b></p>
	</div>

	<div class="node">
		<table class='list_table' width='100%' cellspacing='0' cellpadding='0'>
			<col />
			<col width="120px" />
			<col width="100px" />
			<col width="140px" />
			<col width="80px" />
			<col width="80px" />
			<thead>
				<tr>
					<th>会员备注</th><th>管理员备注</th><th>金额</th><th>申请时间</th><th>状态</th><th>操作</th>
				</tr>
			</thead>

			<tbody>
				<?php $page=(isset($_GET['page'])&&(intval($_GET['page'])>0))?intval($_GET['page']):1;?>
				<?php $user_id = $this->user['user_id']?>
				<?php $queryWithdrawList = Api::run('getWithdrawList',$user_id)?>
			    <?php foreach($queryWithdrawList->find() as $key => $item){?>
				<tr>
					<td><?php echo isset($item['note'])?$item['note']:"";?></td>
					<td><?php echo isset($item['re_note'])?$item['re_note']:"";?></td>
					<td><?php echo isset($item['amount'])?$item['amount']:"";?> 元</td>
					<td><?php echo isset($item['time'])?$item['time']:"";?></td>
					<td><?php echo AccountLog::getWithdrawStatus($item['status']);?></td>
					<td>
						<?php if($item['status']==0){?>
						<a href="javascript:delModel({link:'<?php echo IUrl::creatUrl("/ucenter/withdraw_del/id/".$item['id']."");?>'});" class='blue'>取消</a>
						<?php }?>
					</td>
				</tr>
				<?php }?>
			</tbody>

			<tfoot>
				<tr><td colspan="6" class="t_l"><?php echo $queryWithdrawList->getPageBar();?></td></tr>
			</tfoot>
		</table>

		<div class="form_content">
			<form action='<?php echo IUrl::creatUrl("/ucenter/withdraw_act");?>' method='post' name='withdraw'>
				<table class="form_table mt_10" width="100%" cellpadding="0" cellspacing="0">
					<col width="120px" />
					<col />
					<tr>
						<th>收款人姓名：</th>
						<td>
							<input type="text" class="normal" name='name' pattern='required' alt='请填写真实的收款人姓名' />
							<label><span class='red'>*</span> 填写收款人真实的姓名</label>
						</td>
					</tr>
					<tr>
						<th>提现金额：</th>
						<td>
							<input type="text" class="normal" name='amount' pattern='float' alt='填写体现金额' />
							<label><span class='red'>*</span> 要提现的金额，此数值不得大于当前的账户余额</label>
						</td>
					</tr>
					<tr>
						<th>备注：</th>
						<td>
							<textarea name='note' pattern='required' alt='填写一些必要的提现信息'></textarea><br />
							<label><span class='red'>*</span> 填写必要的提现信息，如开户银行，帐号等</label>
						</td>
					</tr>
					<tr><th></th><td><label class="btn"><input type="submit" value="提交提现申请" /></label><label class="btn"><input type="reset" value="取消" /></label></td></tr>
				</table>
			</form>
		</div>
	</div>
</div>

<script type='text/javascript'>
	var formObj = new Form('withdraw');
	formObj.init({
		'name':'<?php echo isset($this->withdrawRow['name'])?$this->withdrawRow['name']:"";?>',
		'note':'<?php echo isset($this->withdrawRow['note'])?$this->withdrawRow['note']:"";?>',
		'amount':'<?php echo isset($this->withdrawRow['amount'])?$this->withdrawRow['amount']:"";?>'
	});
</script>

	</div>

	<div class="help m_10">
		<div class="cont clearfix">
			<?php foreach(Api::run('getHelpCategoryFoot') as $key => $helpCat){?>
			<dl>
     			<dt><a href="<?php echo IUrl::creatUrl("/site/help_list/id/".$helpCat['id']."");?>"><?php echo isset($helpCat['name'])?$helpCat['name']:"";?></a></dt>
				<?php foreach(Api::run('getHelpListByCatidAll',array('#cat_id#',$helpCat['id'])) as $key => $item){?>
					<dd><a href="<?php echo IUrl::creatUrl("/site/help/id/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a></dd>
				<?php }?>
      		</dl>
      		<?php }?>
		</div>
	</div>
	<?php echo IFilter::stripSlash($this->_siteConfig->site_footer_code);?>
</div>
<script type='text/javascript'>
//DOM加载完毕后运行
$(function()
{
	//隔行换色
	$(".list_table tr:nth-child(even)").addClass('even');
	$(".list_table tr").hover(
		function () {
			$(this).addClass("sel");
		},
		function () {
			$(this).removeClass("sel");
		}
	);

	var allsortLateCall = new lateCall(200,function(){$('#div_allsort').show();});

	//商品分类
	$('.allsort').hover(
		function(){
			allsortLateCall.start();
		},
		function(){
			allsortLateCall.stop();
			$('#div_allsort').hide();
		}
	);
	$('.sortlist li').each(
		function(i)
		{
			$(this).hover(
				function(){
					$(this).addClass('hover');
					$('.sublist:eq('+i+')').show();
				},
				function(){
					$(this).removeClass('hover');
					$('.sublist:eq('+i+')').hide();
				}
			);
		}
	);

	//排行,浏览记录的图片
	$('#ranklist li').hover(
		function(){
			$(this).addClass('current');
		},
		function(){
			$(this).removeClass('current');
		}
	);

	//按钮高亮
	<?php $localUrl = IWeb::$app->getController()->getId().'/'.IWeb::$app->getController()->getAction()->getId()?>
	$('a[href*="<?php echo isset($localUrl)?$localUrl:"";?>"]').parent().addClass('current');
});
</script>
</body>
</html>
