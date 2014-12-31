<?php
//====================================================
//		FileName: func.class.php
//		Summary:  系统函数配置
//====================================================

if(!defined('CORE'))exit("error!"); 
//当前时区
date_default_timezone_set('asia/shanghai');

//初始化数据库连接
$db	= new mysql($cfg["dbhost"],$cfg["dbuser"],$cfg["dbpass"],$cfg["dbname"]);

//提示信息
$lang_cn =array(
	"rabc_error"=>"<script>alert(\"权限不足!\");window.location=\"index.php\";</script>",
	"rabc_error1"=>"exit;<script>alert(\"权限不足!\");window.location=\"index.php#".$actron."\";</script>",
	"rabc_is_login"=>"<script>window.location=\"index.php?action=user&do=login\";</script>",
	"rabc_login_ok"=>"<script>window.location=\"index.php\";</script>",
	"rabc_login_error"=>"<script>alert(\"用户密码错误!\");window.location=\"index.php?action=user&do=login\";</script>",
	"rabc_logout"=>"<script>alert(\"安全退出!\");window.location=\"index.php?action=user&do=login\";</script>",
	"validate"=>"<script>alert(\"内容不全,返回填写!\");history.back(-1);</script>"
);

//配置类型
$type_cn =array("areaid"=>"公司地区","typeid"=>"公司名称","productid"=>"维护信息","doctid"=>"公告文档");

//销售单号
$qianzhui=JD0;
$houzhui=351000001;
//审验
$yunshen=JDYG0;
$cheshen=JDGA0;

//车辆保险种类
$insuresort_cn=array("jiaoqiang"=>"交强险","daoqiang"=>"盗抢险","three"=>"三者","cardamage"=>"车损险","carperson"=>"车上人员损险","transport"=>"货物运输险","other"=>"其他");

//权限页面
$action_cn=array(
	/* "info"=>"车辆列表",
	"infonew"=>"新建车辆",
	//"infomap"=>"客户地图",
	"infoadd"=>"车辆信息",
	"infoedit"=>"编辑车辆",
	"infoupdata"=>"更新车辆",
	"infodel"=>"删除车辆",
	"infoshow"=>"车辆明细", */
	
	/* "sell"=>"维护信息列表",
	"sellnew"=>"新建维护信息",
	"selladd"=>"写入维护信息",
	
	"daily"=>"日报列表",
	"dailyedit"=>"编辑日报",
	"dailyupdata"=>"更新日报",
	"dailydel"=>"删除日报", */
	
	//"photo"=>"照片管理列表",
	//"photoup"=>"上传照片",
	//"photodel"=>"删除照片信息",
	
	"room"=>"仓库管理",
	"roomnew"=>"新增库房",
	"roomadd"=>"写入库房",
	"roomdel"=>"删除库房",
	"roomedit"=>"编辑库房",
	"roomupdata"=>"更新库房",
	
	"sort"=>"物品类别",
	"sortnew"=>"新增物品类别",
	"sortadd"=>"写入物品类别",
	"sortdel"=>"删除物品类别",
	"sortedit"=>"编辑物品类别",
	"sortupdata"=>"更新物品类别",
	
	"feetype"=>"虚拟费用类别",
	"feetypenew"=>"新增费用类别",
	"feetypeadd"=>"写入费用类别",
	"feetypedel"=>"删除费用类别",
	"feetypeedit"=>"编辑费用类别",
	"feetypeupdata"=>"更新费用类别",
	
	"product"=>"物品信息",
	"productnew"=>"新增物品",
	"productadd"=>"写入物品",
	"productdel"=>"删除物品",
	"productedit"=>"编辑物品",
	"productupdata"=>"更新物品",
	
	"supplier"=>"供货商管理",
	"suppliernew"=>"新增供货商",
	"supplieradd"=>"写入供货商",
	"supplierdel"=>"删除供货商",
	"supplieredit"=>"编辑供货商",
	"supplierupdata"=>"更新供货商",
	
	"company"=>"公司名称设置",
	"companynew"=>"新增公司",
	"companyadd"=>"写入公司",
	"companydel"=>"删除公司",
	"companyedit"=>"编辑公司",
	"companyupdata"=>"更新公司",
	
	"simstate"=>"SIM卡状态管理",
	"simstatenew"=>"新增SIM卡状态",
	"simstateadd"=>"写入SIM卡状态",
	"simstatedel"=>"删除SIM卡状态",
	
	"simzifei"=>"SIM卡资费管理",
	"simzifeinew"=>"新增SIM卡资费",
	"simzifeiadd"=>"写入SIM卡资费",
	"simzifeidel"=>"删除SIM卡资费",
	
	"caigou"=>"采购商品",
	"caigounew"=>"新增采购记录",
	"caigouadd"=>"写入采购记录",
	
	"storage_ru"=>"入库信息",
	"storage_rusure"=>"入库确认",
	
	"storage_chu"=>"出库信息",
	"storage_chusure"=>"出库确认",
	
	"diaobo"=>"调拨管理",
	"diaobonew"=>"新增调拨",
	"diaoboadd"=>"写入调拨",
	
	"diaoboagree"=>"确认调拨",
	"diaoboagreesure"=>"同意调拨",
	
	"storage"=>"库存信息",
	
	"sim_sto"=>"SIM卡库存信息",
	"sim_stonew"=>"新增库房SIM卡",
	"sim_stoadd"=>"写入库房SIM卡",
	"sim_stodel"=>"删除库房SIM卡",
	"sim_stoedit"=>"编辑库房SIM卡",
	"sim_stoupdata"=>"更新库房SIM卡",
	
	"detail"=>"设备出入库明细表",
	"detailedit"=>"添加出入库明细备注",
	"detailupdata"=>"写入出入库明细备注",
	"detailprint"=>"导出出入库明细EXCLE表",
	
	"platform"=>"平台设置",
	"platformnew"=>"新增平台",
	"platformadd"=>"写入平台",
	"platformdel"=>"删除平台",
	"platformedit"=>"编辑平台",
	"platformupdata"=>"更新平台",
	
	"carstate"=>"车辆状态管理",
	"carstatenew"=>"新增车辆状态",
	"carstateadd"=>"写入车辆状态",
	"carstatedel"=>"删除车辆状态",
	"carstateedit"=>"编辑车辆状态",
	"carstateupdata"=>"更新车辆状态",
	
	"carleixing"=>"车辆类型管理",
	"carleixingnew"=>"新增车辆类型",
	"carleixingadd"=>"写入车辆类型",
	"carleixingdel"=>"删除车辆类型",
	"carleixingedit"=>"编辑车辆类型",
	"carleixingupdata"=>"更新车辆类型",
	
	
	"car"=>"车辆管理",
	"carnew"=>"新增车辆",
	"caradd"=>"写入车辆",
	"cardel"=>"删除车辆",
	"caredit"=>"编辑车辆",
	"carupdata"=>"更新车辆",
	"careditfuwufei"=>"修改车辆服务费",
	"carupdatafuwufei"=>"更新车辆服务费",
	"careditstop"=>"编辑停运车辆信息",
	"carupdatastop"=>"更新停运车辆信息",
	"carsure"=>"办理减款",
	"caredittransfer"=>"编辑转户车辆信息",
	"carupdatatransfer"=>"更新转户车辆信息",
	
	"fenqicar"=>"分期付款车辆",
	"fenqicarnew"=>"还款",
	"fenqicaradd"=>"写入还款",
	"fenqicaredit"=>"编辑还款信息",
	"fenqicarupdata"=>"更新还款信息",
	"fenqicarshow"=>"查看还款明细",
	"fenqicarwarn"=>"提醒付款",
	"fenqicarprint"=>"打印分期付款车辆信息",
	
	"sim"=>"sim卡管理",
	"simnew"=>"新增sim卡",
	"simadd"=>"写入sim卡",
	//"simdel"=>"删除sim卡",
	"simedit"=>"编辑sim卡",
	"simupdata"=>"更新sim卡",
	
	"shenyan"=>"审验管理",
	"shenyannewyun"=>"新增运管审验",
	"shenyanaddyun"=>"写入运管审验",
	"shenyannewche"=>"新增车管审验",
	"shenyanaddche"=>"写入车管审验",
	"shenyansureyun1"=>"运管审核",
	"shenyansureche1"=>"车管审核",
	
	"device"=>"设备管理",
	"devicenew"=>"新增设备",
	"deviceadd"=>"写入设备",
	//"devicedel"=>"删除设备",
	"deviceedit"=>"编辑设备",
	"deviceupdata"=>"更新设备",
	
	"beiji"=>"备机使用协议",
	"beijinew"=>"安装备机",
	"beijiadd"=>"写入安装备机",
	"beijiedit"=>"拆取备机",
	"beijiupdata"=>"写入拆取备机",
	"beijiprint"=>"导出备机使用协议EXCLE表",
	
	"repair"=>"检修终端",
	"repairnew"=>"新增检修终端信息",
	"repairadd"=>"写入检修终端信息",
	"repairedit"=>"编辑检修终端信息",
	"repairupdata"=>"更新检修终端信息",
	"repairprint"=>"导出检修终端EXCLE表",
	
	
	"carinfo"=>"车辆信息汇总",
	"carinfoedit"=>"添加车辆备注",
	"carinfoupdata"=>"更新车辆备注",
	"carinfoprint"=>"打印车辆信息汇总表",
	
	"day"=>"日统计",
	"dayprint"=>"导出日统计表",
	
	"week"=>"周统计",
	"weekprint"=>"导出周统计表",
	
	"month"=>"月统计",
	"monthprint"=>"导出月统计表",
	
	"year"=>"年统计",
	"yearprint"=>"导出年统计表",
	
	"maintain"=>"终端维修记录",
	"maintainnew"=>"新增终端维修记录",
	"maintainadd"=>"写入终端维修记录",
	"maintainedit"=>"编辑终端维修记录",
	"maintaindel"=>"删除终端维修记录",
	"maintainupdata"=>"更新终端维修记录",
	"maintainprint"=>"导出终端维修EXCLE表",
	
	"sale"=>"销售实体商品",
	"salenew"=>"新增销货记录",
	"saleadd"=>"写入销货记录",
	
	"fuwu"=>"销售虚拟商品",
	"fuwunew"=>"新增销售虚拟商品记录",
	"fuwuadd"=>"写入销售虚拟商品记录",
	
	"finance"=>"实体商品金额核对",
	"financesure"=>"确认实体商品收款金额",
	
	"fuwucheck"=>"虚拟商品金额核对",
	"fuwuchecksure"=>"确认虚拟商品收款金额",
	
	"shencheck"=>"审验金额核对",
	"shenchecksureyun1"=>"确认运管审验金额",
	"shenchecksureyun2"=>"打印运管审验收据",
	"shenchecksureche1"=>"确认车管审验金额",
	"shenchecksureche2"=>"打印车管审验收据",
	
	"cards"=>"卡号管理",
	//"cardsnew"=>"新增卡号",
	//"cardsadd"=>"写入卡号",
	"cardsdel"=>"删除卡号",
	"cardsedit"=>"编辑卡号",
	"cardsupdata"=>"更新卡号",
	"cardsprint"=>"导出SIM卡EXCLE表",
	"cards"=>"卡号管理",
	
	"wangdian"=>"网点管理",
	"wangdiannew"=>"新增网点",
	"wangdianadd"=>"写入网点",
	"wangdiandel"=>"删除网点",
	"wangdianedit"=>"编辑网点",
	"wangdianupdata"=>"更新网点",
	
	"weixiuproject"=>"维修项目管理",
	"weixiuprojectnew"=>"新增维修项目",
	"weixiuprojectadd"=>"写入维修项目",
	"weixiuprojectdel"=>"删除维修项目",
	"weixiuprojectedit"=>"编辑维修项目",
	"weixiuprojectupdata"=>"更新维修项目",
	
	"outrepair"=>"网点维修管理",
	"outrepairnew"=>"新增网点维修车辆",
	"outrepairadd"=>"写入网点维修车辆",
	"outrepairdel"=>"删除网点维修车辆",
	"outrepairedit"=>"编辑网点维修车辆",
	"outrepairupdata"=>"更新网点维修车辆",
	"outrepairsure"=>"审核网点维修车辆",
	
	"weixiuresult"=>"维修结果汇总",
	"weixiuresultedit"=>"编辑维修汇总表备注",
	"weixiuresultupdata"=>"更新维修汇总表备注",
	
	"tongji"=>"维修结果统计",
	"tongjiprint"=>"导出维修金额统计表",
	
	"jixiao"=>"绩效考核管理",
	"jixiaonew"=>"新增绩效考核",
	"jixiaoadd"=>"写入绩效考核",
	"jixiaodel"=>"删除绩效考核",
	"jixiaoedit"=>"编辑绩效考核",
	"jixiaoupdata"=>"更新绩效考核",
	
	"install"=>"安装管理",
	"installnew"=>"新增安装信息",
	"installadd"=>"写入安装信息",
	"installdel"=>"删除安装信息",
	"installedit"=>"编辑安装信息",
	"installupdata"=>"更新安装信息",
	
	"log"=>"操作日志",
	
	"record"=>"数据记录",
	"recordnew"=>"新增数据记录",
	"recordadd"=>"写入数据记录",
	"recorddel"=>"删除数据记录",
	"recordedit"=>"编辑数据记录",
	"recordupdata"=>"更新数据记录",
	"recordsure"=>"审核数据记录",
	"recordshow"=>"查看数据明细",
	"recordeditbeizhu"=>"编辑数据备注",
	"recordupdatabeizhu"=>"更新数据备注",
	
	/* "huikuan"=>"回款单",
	"huikuannew"=>"新增回款",
	"huikuanadd"=>"写入回款",
	"huikuanedit"=>"编辑回款",
	"huikuanupdate"=>"更新回款",
	"huikuandel"=>"删除回款",
	
	"duizhang"=>"对账单",
	
	"doc"=>"公告文档",
	"docupload"=>"公告文档附件",
	"docnew"=>"新建文档",
	"docadd"=>"写入文档",
	"docedit"=>"编辑文档",
	"docupdata"=>"更新文档",
	"docdel"=>"删除文档",
	"docshow"=>"文档明细",
	
	"note"=>"反馈列表",
	"notenew"=>"新建反馈",
	"noteadd"=>"写入反馈",
	"noteedit"=>"编辑反馈",
	"noteupdata"=>"更新反馈",
	"notedel"=>"删除反馈",
	
	"tel"=>"电话列表",
	"telnew"=>"新建电话",
	"teladd"=>"写入电话",
	"teledit"=>"编辑电话",
	"telupdata"=>"更新电话",
	"teldel"=>"删除电话", */
	
	//"track"=>"轨迹文档",
	//"trackshow"=>"轨迹明细",
	
	/* "reportt1"=>"维护统计表",
	"reportt1t"=>"维护统计表[图]",
	"reportt2"=>"区域统计表",
	"reportt2t"=>"区域统计表[图]",
	"reportt3"=>"公司统计表",
	"reportt3t"=>"公司统计表[图]", */
	//"reportt7"=>"考勤统计表",
	//"reportt7t"=>"考勤统计表[图]",
	//"reportt7tmap"=>"考勤轨迹查看",
	
	"user"=>"用户列表",
	"usernew"=>"新建用户",
	"useradd"=>"写入用户",
	"useredit"=>"编辑用户",
	"usereditpass"=>"修改密码",
	"userupdata"=>"更新用户",
	"userupdatapass"=>"更新密码",
	"userdel"=>"删除用户",
	
	"role"=>"角色列表",
	"rolenew"=>"新建角色",
	"roleadd"=>"写入角色",
	"roleedit"=>"编辑角色",
	"roleupdata"=>"更新角色",
	"roledel"=>"删除角色",
	
	"company1"=>"公司列表",
	"company1new"=>"新建下属公司",
	"company1add"=>"写入下属公司",
	"company1edit"=>"编辑下属公司",
	"company1updata"=>"更新下属公司",
	"company1del"=>"删除下属公司",
	
	"config"=>"配置列表",
	"confignew"=>"新建配置",
	"configadd"=>"写入配置",
	"configedit"=>"编辑配置",
	"configupdata"=>"更新配置",
	"configdel"=>"删除配置",	
		
	"datalist"=>"数据列表",
	"databackupupdata"=>"数据备份更新",
	"datarecoverupdata"=>"数据恢复更新"
	
);

//安全验证
function _RunMagicQuotes(&$svar){
	if(!get_magic_quotes_gpc())	{
		if( is_array($svar) ){
			foreach($svar as $_k => $_v) $svar[$_k] = _RunMagicQuotes($_v);
		}else{
			$svar = addslashes($svar);
		}
	}
	return $svar;
}

//SMARTY模版配置
function smarty_cfg($self){
	global $cfg;
	global $css;
	$self->template_dir='./tpl';
	$self->cache_dir='./tmp/cache';
	$self->compile_dir	='./tmp/compile';
	$self->assign('cfg',$cfg);
	$self->assign('css',$css);
}

//安全过滤
foreach(Array('_GET','_POST','_COOKIE') as $_request){
	foreach($$_request as $_k => $_v) ${$_k} = _RunMagicQuotes($_v);
}

//dwz_ajax_succee
function success($msg){
	$msg = $msg ? $msg : "操作成功!";
	$json = "{\"statusCode\":\"200\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}
function close($msg,$rel){
	$msg = $msg ? $msg : "操作成功!";
	//$rel = $rel ? $rel : "record";
	$json = "{\"statusCode\":\"200\",\"message\":\"".$msg."\",\"navTabId\":\"".$rel."\",\"callbackType\":\"closeCurrent\",\"rel\":\"\"}";
	return $json;
}
function success_fugai($msg){
	$msg = $msg ? $msg : "是否覆盖上个月的数据";
	$json = "{\"statusCode\":\"200\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}

//dwz_ajax_error
function error($msg){
	$msg = $msg ? $msg : "操作错误!";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}
function error_diao($msg){
	$msg = $msg ? $msg : "库存商品不足，无法调出!";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}
function error_xiao($msg){
	$msg = $msg ? $msg : "库存商品不足,无法销售!";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}
function error_no($msg){
	$msg = $msg ? $msg : "该库房中不存在此商品!";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}
function error_cun($msg){
	$msg = $msg ? $msg : "该商品已存在!";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}

function error_del($msg){
	$msg = $msg ? $msg : "库存中存在该类别的商品，不允许删除该类别";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}
function error_car($msg){
	$msg = $msg ? $msg : "不存在该车辆，不能进行该操作";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}
function error_car1($msg){
	$msg = $msg ? $msg : "该车辆已经存在，不允许重复添加";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}
function error_device($msg){
	$msg = $msg ? $msg : "不存在该车辆，不能添加设备";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	return $json;
}
//权限
function error_aquanx($msg){
	$msg = $msg ? $msg : "没有权限!";
	$json = "{\"statusCode\":\"300\",\"message\":\"".$msg."\",\"navTabId\":\"\",\"callbackType\":\"closeCurrent\",\"rel\":\"\"}";
	return $json;
}




/*打印友好的数组形式*/
function dump($array){
	echo "<pre>";
	print_r($array);
	echo "<pre>";
}

//中文截取
function cnString($text, $length){
	if(strlen($text) <= $length){
		return $text;
	}
	$str = substr($text, 0, $length) . chr(0) ; 
	return $str;
}


//数组转化为select
function select($arr,$name,$self="",$cn_name="选择",$class="combox"){
	$slt .= "<select name=\"".$name."\" class=\"input required ".$class."\" title=\"此项目必填.\">";
	$slt .= "<option value=\"\" selected=\"selected\">".$cn_name."</option>";
	foreach($arr as $key=>$val){
		if($key==$self){
		$slt .= "    <option value=\"".$key."\" selected=\"selected\">".$val."</option>";
		}else{
		$slt .= "    <option value=\"".$key."\">".$val."</option>";
		}
	}
    $slt .= "</select>";
	return $slt;
}

//数组转化为select,可以不填写
function select1($arr,$name,$self="",$cn_name="选择",$class="combox"){
	$slt .= "<select name=\"".$name."\" class=\"".$class."\">";
	//$slt .= "<option value=\"\" selected=\"selected\">".$cn_name."</option>";
	foreach($arr as $key=>$val){
		if($key==$self){
		$slt .= "    <option value=\"".$key."\" selected=\"selected\">".$val."</option>";
		}else{
		$slt .= "    <option value=\"".$key."\">".$val."</option>";
		}
	}
    $slt .= "</select>";
	return $slt;
}

//数组转化为selecter
function selecter($arr,$name,$self="",$cn_name="选择",$ref,$refUrl,$class="combox"){
	$slt .= "<select name=\"".$name."\" class=\"input required ".$class."\" title=\"此项目必填.\" ref=\"".$ref."\" refUrl=\"".$refUrl."\">";//$ref为父类传递给子集的ID，$refUrl自己的变化
	$slt .= "<option value=\"\" selected=\"selected\">".$cn_name."</option>";
	foreach($arr as $key=>$val){
		if($key==$self){
		$slt .= "    <option value=\"".$key."\" selected=\"selected\">".$val."</option>";
		}else{
		$slt .= "    <option value=\"".$key."\">".$val."</option>";
		}
	}
    $slt .= "</select>";
	return $slt;
}


//读取目录所有的文件名
function myreaddir($dir) {
	$handle=opendir($dir);
	$i=0;
	while($file=readdir($handle)){
		if ($file!="." && $file!=".." && !is_dir($file)){
		$list[$i]=$file;
		$i=$i+1;
		}
	}
	closedir($handle);
	rsort($list);
	return $list;
}

//验证内容
function Ifvalidate($arr){
	global $lang_cn;
	foreach($arr as $val){
		if(!$val){exit($lang_cn['validate']);}
	}
}

//arr=>json
function my_json_encode($phparr){
    if(function_exists("json_encode")){
      return json_encode($phparr);
    }else{
      require_once './include/json.php';
      $json = new Services_JSON;
      return $json->encode($phparr);
    }
}

//json=>arr
function json_to_array($web){
	$arr=array();
	foreach($web as $k=>$w){
	if(is_object($w)) $arr[$k]=json_to_array($w);  //判断类型是不是object
	else $arr[$k]=$w;
	}
	return $arr;
}

//数组转化为type循环th名称
function type_th($arr){
	foreach($arr as $key=>$val){
		$slt .= "<th>".$val."</th>\n";
	}
	return $slt;
}

?>