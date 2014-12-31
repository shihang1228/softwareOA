<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php echo $this->_var['cfg']['webname']; ?></title>
<link href="./themes/default/style.css" rel="stylesheet" type="text/css" />
<link href="./themes/css/core.css" rel="stylesheet" type="text/css" />
<link href="./themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<!--[if IE]>
<link href="./themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->
<script src="./themes/javascripts/speedup.js" type="text/javascript"></script>
<script src="./themes/javascripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="./themes/javascripts/jquery.cookie.js" type="text/javascript"></script>
<script src="./themes/javascripts/jquery.validate.js" type="text/javascript"></script>
<script src="./themes/javascripts/jquery.bgiframe.js" type="text/javascript"></script>
<script src="./themes/javascripts/dwz.min.js" type="text/javascript"></script>
<script src="./themes/xheditor/xheditor-1.1.12-zh-cn.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
	DWZ.init("./themes/dwz.frag.xml", {
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({themeBase:"themes"});
			if(<?php echo $this->_var['count']; ?>>0){
				alertMsg.info('有<?php echo $this->_var['count']; ?>辆车需交还款');
			}
		}
	});
});
//清理浏览器内存,只对IE起效,FF不需要
if ($.browser.msie) {
	window.setInterval("CollectGarbage();", 10000);
}
</script>


</head>

<body scroll="no">
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<a class="logo" href="javascript:void(0)">标志</a>
				<ul class="nav">
					<li><a href="#">用户:<?php echo $_SESSION['username']; ?></a></li>
					<li><a href="index.php?action=user&do=editpass" target="dialog" mask="true">修改密码</a></li>
					<li><a href="index.php?action=user&do=logout">退出</a></li>
				</ul>
			</div>		
		</div>

		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			<div id="sidebar">
				<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

				<div class="accordion" fillSpace="sidebar">
					<div class="accordionHeader">
						<h2><span>Folder</span>基本信息模块</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							
							<!-- <li><a>基本功能</a>
								<ul>								
									<li><a href="index.php?action=info" target="navTab" rel="info">车辆管理</a></li>
									<li><a href="index.php?action=sell" target="navTab" rel="sell">维护管理</a></li>
									<li><a href="index.php?action=daily" target="navTab" rel="daily">日报管理</a></li>
								</ul>
							</li> -->
							
							<li><a>基本设置</a>
								<ul>								
									<li><a href="index.php?action=room" target="navTab" rel="room">库房管理</a></li>
									<li><a href="index.php?action=sort" target="navTab" rel="sort">物品类别</a></li>
									<li><a href="index.php?action=feetype" target="navTab" rel="feetype">虚拟费用类别</a></li>
									<li><a href="index.php?action=product" target="navTab" rel="product">物品信息</a></li>
									<li><a href="index.php?action=supplier" target="navTab" rel="supplier">供货商管理</a></li>
									<li><a href="index.php?action=company" target="navTab" rel="company">公司名称设置</a></li>
									<li><a href="index.php?action=simstate" target="navTab" rel="simstate">SIM卡状态</a></li>
									<li><a href="index.php?action=simzifei" target="navTab" rel="simzifei">SIM卡资费</a></li>
									<li><a href="index.php?action=platform" target="navTab" rel="platform">平台设置</a></li>
									<li><a href="index.php?action=carstate" target="navTab" rel="carstate">车辆状态</a></li>
									<li><a href="index.php?action=carleixing" target="navTab" rel="carleixing">车辆类型</a></li>
								</ul>
							</li>
						</ul>
					</div>
							
					<div class="accordionHeader">
						<h2><span>Folder</span>库房管理</h2>
					</div>
					<div class="accordionContent"> 
						<ul class="tree treeFolder">
							<li><a>出入库管理</a>
								<ul>
									<li><a href="index.php?action=caigou" target="navTab" rel="caigou">采购商品</a></li>					
									<li><a href="index.php?action=storage_ru" target="navTab" rel="storage_ru">入库确认</a></li>
									<li><a href="index.php?action=storage_chu" target="navTab" rel="storage_chu">出库确认</a></li>
									<li><a href="index.php?action=diaobo" target="navTab" rel="diaobo">调拨管理</a></li>
									<li><a href="index.php?action=diaoboagree" target="navTab" rel="diaoboagree">确认调拨</a></li>
									<li><a href="index.php?action=storage" target="navTab" rel="storage">库存信息</a></li>
									<li><a href="index.php?action=sim_sto" target="navTab" rel="sim_sto">SIM卡库存信息</a></li>
									<li><a href="index.php?action=detail" target="navTab" rel="detail">设备出入库明细表</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="accordionHeader">
						<h2><span>Folder</span>业务模块</h2>
					</div>
					<div class="accordionContent"> 
						<ul class="tree treeFolder">		
							<li><a>业务管理</a>
								<ul>
									
									<li><a href="index.php?action=car" target="navTab" rel="car">车辆管理</a></li>
									<li><a href="index.php?action=fenqicar" target="navTab" rel="fenqicar">分期付款车辆(<?php echo $this->_var['count']; ?>)</a></li>
									<li><a>设备管理</a>
									<ul>
									<li><a href="index.php?action=device" target="navTab" rel="device">设备管理</a></li>
									<li><a href="index.php?action=beiji" target="navTab" rel="beiji">备机管理</a></li>
									<li><a href="index.php?action=repair" target="navTab" rel="repair">检修终端</a></li>
									</ul>
									</li>	
									<li><a href="index.php?action=sim" target="navTab" rel="sim">SIM卡管理</a></li>	
									<li><a href="index.php?action=shenyan" target="navTab" rel="shenyan">审验管理</a></li>
									<li><a href="index.php?action=carinfo" target="navTab" rel="carinfo">车辆信息汇总表</a></li>
									<li><a>业务统计</a>
									<ul>
									<li><a href="index.php?action=day" target="navTab" rel="day">日统计</a></li>
									<li><a href="index.php?action=week" target="navTab" rel="week">周统计</a></li>
									<li><a href="index.php?action=month" target="navTab" rel="month">月统计</a></li>
									<li><a href="index.php?action=year" target="navTab" rel="year">年统计</a></li>
									</ul>
									</li>
									<li><a href="index.php?action=maintain" target="navTab" rel="maintain">终端维修记录</a></li>
								</ul>
							</li>
							
							<li><a>销售管理</a>
								<ul>							
									<li><a href="index.php?action=sale" target="navTab" rel="sale">销售实体商品</a></li>
									<li><a href="index.php?action=fuwu" target="navTab" rel="fuwu">销售虚拟商品</a></li>
								</ul>
							</li>
							
							<li><a>卡号管理</a>
								<ul>	
									<li><a href="index.php?action=cards" target="navTab" rel="cards">SIM卡统计</a></li>
								</ul>
							</li>
							<li><a>维修网点</a>
								<ul>
									<li><a href="index.php?action=wangdian" target="navTab" rel="wangdian">维修网点管理</a></li>
									<li><a href="index.php?action=weixiuproject" target="navTab" rel="weixiuproject">维修项目管理</a></li>
									<li><a href="index.php?action=outrepair" target="navTab" rel="outrepair">维修车辆管理</a></li>
									<li><a href="index.php?action=weixiuresult" target="navTab" rel="weixiuresult">维修结果汇总</a></li>
									<li><a href="index.php?action=tongji" target="navTab" rel="tongji">维修结果统计</a></li>
									<li><a href="index.php?action=ticheng" target="navTab" rel="ticheng">维修提成统计</a></li>
								</ul>
							</li>
							<li><a>货运车辆录入信息审核</a>
								<ul>
									<li><a href="index.php?action=log" target="navTab" rel="log">操作日志</a></li>
									<li><a href="index.php?action=record" target="navTab" rel="record">数据记录</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="accordionHeader">
						<h2><span>Folder</span>财务模块</h2>
					</div>
					<div class="accordionContent"> 
						<ul class="tree treeFolder">
							<li><a>出纳核对</a>
								<ul>
									<li><a href="index.php?action=finance" target="navTab" rel="finance">实体商品金额核对</a></li>
									<li><a href="index.php?action=fuwucheck" target="navTab" rel="fuwucheck">虚拟商品金额核对</a></li>
									<li><a href="index.php?action=shencheck" target="navTab" rel="shencheck">审验金额核对</a></li>
								</ul>
							</li>
							
							<!-- <li><a>账单管理</a>
								<ul>								
									<li><a href="index.php?action=huikuan" target="navTab" rel="huikuan">回款单</a></li>
									<li><a href="index.php?action=duizhang" target="navTab" rel="duizhang">对账单</a></li>
									
								</ul>
							</li> -->
							
							<!-- <?php if ($_SESSION['rights'] == "1" || $_SESSION['rights'] == "2"): ?>	
							<li><a>常用功能</a>
								<ul>								
									<li><a href="index.php?action=doc" target="navTab" rel="doc">公告文档</a></li>
									<li><a href="index.php?action=tel" target="navTab" rel="tel">电话管理</a></li>
									<li><a href="index.php?action=note" target="navTab" rel="note">信息管理</a></li>
								</ul>
							</li>
							<?php endif; ?>
							<?php if ($_SESSION['rights'] == "1" || $_SESSION['rights'] == "3"): ?>
							<li><a>统计报表</a>
								<ul>
									<li><a href="index.php?action=report&do=t1" target="navTab" rel="reportt1">维护统计表</a></li>
									<li><a href="index.php?action=report&do=t2" target="navTab" rel="reportt2">区域统计表</a></li>
									<li><a href="index.php?action=report&do=t3" target="navTab" rel="reportt3">公司统计表</a></li>
								</ul>
							</li>
							<?php endif; ?> -->
							
						</ul>
					</div>
					
					<div class="accordionHeader">
						<h2><span>Folder</span>绩效考核模块</h2>
					</div>
					<div class="accordionContent"> 
						<ul class="tree treeFolder">
							<li><a href="index.php?action=jixiao" target="navTab" rel="jixiao">绩效考核管理</a></li>
							<li><a href="index.php?action=install" target="navTab" rel="install">安装信息管理</a></li>
						</ul>
					</div>
					
					<?php if ($_SESSION['roleid'] == "1"): ?>	
					<div class="accordionHeader">
						<h2><span>Folder</span>系统管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder ">
							
							<li><a>用户管理</a>
								<ul>
									<li><a href="index.php?action=user" target="navTab" rel="user">用户列表</a></li>
								</ul>
							</li>
	
							<li><a>角色管理</a>
								<ul>
									<li><a href="index.php?action=role" target="navTab" rel="role">角色列表</a></li>									
								</ul>
							</li>
							
							<li><a>公司管理</a>
								<ul>
									<li><a href="index.php?action=company1" target="navTab" rel="company1">公司列表</a></li>									
								</ul>
							</li>
							
							<!-- <li><a>配置管理</a>
								<ul>
									<li><a href="index.php?action=config" target="navTab" rel="config">配置列表</a></li>
								</ul>
							</li>
							
							
							<li><a>数据管理</a>
								<ul>
									<li><a href="index.php?action=data&do=list" target="navTab" rel="data">数据备份</a></li>
								</ul>
							</li> -->
						</ul>
					</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
		<div id="container">
			<div id="navTab" class="tabsPage">
				<div class="tabsPageHeader">
					<div class="tabsPageHeaderContent">
						<ul class="navTab-tab">
							<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
						</ul>
					</div>
					<div class="tabsLeft">left</div>
					<div class="tabsRight">right</div>
					<div class="tabsMore">more</div>
				</div>
				<ul class="tabsMoreList">
					<li><a href="javascript:;">我的主页</a></li>
				</ul>
				<div class="navTab-panel tabsPageContent layoutBox">
					<div class="page unitBox">
						<div class="accountInfo">
							<p><span><?php echo $this->_var['cfg']['webname']; ?></span></p>
							<p>开发者 : 于惊涛 郝马存</p>
						</div>
						<div class="pageFormContent" layoutH="80">
<pre style="margin:5px;line-height:1.4em"><?php echo $this->_var['cfg']['webname']; ?>(Enterprise sales management),主要针对本公司办公重复，不明确等问题的协同办公的系统.员工可以手持智能android手机,进行服务器提交数据与访问服务器数据。
主要功能有:基本信息设置,出入库管理,业务管理,销售管理,出纳核对,SIM卡统计等。
OA协同办公系统,是基于Linux开放性内核和Apache基础上Php+Mysql的智能B/S交互式服务系统。
OA系统移动端由移动端采用javascript、html5、ajax、json等技术。
中间件层包括函数库,由java开发,android操作系统、中间件、用户界面和应用软件组成。
最佳分辨率: 1440x900 最佳浏览器: IE，搜狗,火狐Firefox,等。。
</pre>

<div class="divider"></div>
<h2>功能描述:</h2>
<pre style="margin:5px;line-height:1.4em">
1.基本设置: (手机端+web端)
2.出入库管理: (手机端+web端)
3.业务管理: (手机端+web端)
4.销售管理: (手机端+web端)
5.出纳核对: (手机端+web端)
6.SIM卡统计: (手机端+web端)
7.用户管理 (web端)
8.角色管理: (web端)
9.配置管理: (web端)
10:数据管理: (web端)
</pre>

<div class="divider"></div>
<h2>服务请联系:</h2>
<p style="color:red"><br/>
开发公司: <?php echo $this->_var['cfg']['webname']; ?><br/><br/>
官方网站: <a href="http://www.qmclwfwpt.com" target="_blank">http://www.qmclwfwpt.com</a><br/><br/>
研发邮箱: 296267833@qq.com,603400049@qq.com<br/><br/>研发QQ: 296267833,603400049</p>
						</div>
					</div>
					
				</div>
			</div>
		</div>

	</div>

	<div id="footer">Copyright &copy; 2014 <a href="http://www.qmclwfwpt.com" target="_blank"><?php echo $this->_var['cfg']['webname']; ?> 研发组</a> 客服QQ:296267833,603400049</div>


</body>
</html>