<?php
	//====================================================
	//		FileName: index.php
	//		Summary:  程序入口文件
	//====================================================
	header("Content-type: text/html; charset=utf-8");
	session_start();
	error_reporting(0);

	//配置数据库
	$cfg["dbhost"]="localhost";     //数据库主机名
	$cfg["dbuser"]="root";		    //数据库用户名
	$cfg["dbpass"]="123456"; 				//数据库密码
	$cfg["dbname"]="esm";  			//数据库名称
	$cfg["webname"]="山西冀东启明科技有限公司"; //系统名称

	//打卡时间
	$attendance_txt ="注:公司打卡时间 早晨8:00-9:00 中午11:00-13:00 下午18:00-24:00"; 

	//引入类库及公共方法
	@define("CORE",dirname(__FILE__)."/"); 	    //根目录    dirname(string path)返回路径中的目录部分
	require_once("lib/mysql.class.php");        //数据类
	require_once("lib/smarty.class.php");       //模版类
	require_once('lib/json.class.php');		    //JSON类
	require_once("lib/func.class.php");         //核心类
	require_once("lib/rabc.class.php");         //查询类
	require_once("lib/image.class.php");        //图片类
	require_once("lib/excle.php");              //导出excle	
	//require_once("lib/upload.func.php"); 
	//操作值
	$action=empty($_GET['action'])?'':trim($_GET['action']); 	 //get action值     判断action的get传值是否为空，如果为空则返回空，否则返回action的Get传值
	$do=empty($_GET['do'])?'':trim($_GET['do']);			 	 //get do值
	$id=empty($_GET['id'])?'':intval($_GET['id']);				 //get id值    intval()获取变量的整数值
	$cuserid=empty($_GET['userid'])?'':intval($_GET['userid']);  //get userid值
	
	//读取参数数组
	$sql_tt="SELECT id,title,type FROM `rv_type` where company1='$_SESSION[company1]'";
	$db->query($sql_tt);//执行SQL语句
	$type_cut=$db->fetchAll();//取出所有的记录（数组形式）
	foreach ($type_cut as $key => $val) {//foreach遍历数组或对象
		$type_cut[$val[type]][$val[id]] = $val[title];
		unset($type_cut[$key]);//取消掉引用
	}

	 //将$_SESSION[company1]变为数组('a','b','c'.....)
	$arr2=str_replace("^","'",$_SESSION[xscompany1]);
	
	//初始值参数数组
	$areaid=$type_cut[areaid];				//区域参数
	$typeid=$type_cut[typeid];				//类型参数
	$productid=$type_cut[productid];		//维护参数
	$doctid=$type_cut[doctid];				//文档参数

	//读取用户数组
	$sql_user="SELECT id,username FROM `rv_user` where company1='$_SESSION[company1]'";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	 //用户数组
	}

	
	
    $sql="SELECT id,category FROM `rv_sort`";
	$db->query($sql);
	$list=$db->fetchAll();
	 //格式化输出数据
	foreach($list as $key=>$val){
		$list1[$list[$key][id]] = $list[$key][category];	//物品类型数组		
	} 

	
	//查询
	$sql="SELECT id,name FROM `rv_supplier`";
	$db->query($sql);
	$supplier_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($supplier_arr as $key=>$val){
		$supplier_list[$supplier_arr[$key][id]] = $supplier_arr[$key][name];	//供应商名称数组		
	}

//执行页面
switch ($action){
	case "":
	  include('action/action.index.php');     //首页
	  break;
	case "info":
	  include('action/action.info.php');      //车辆
	  break;
	case "sell":
	  include('action/action.sell.php');      //维护
	  break;
	case "daily":
	  include('action/action.daily.php');     //日报
	  break;
	case "room":
	  include('action/action.room.php');      //仓库
	  break;
	case "sort":
	  include('action/action.sort.php');      //物品类别
	  break;
	case "feetype":
	  include('action/action.feetype.php');      //物品类别
	  break;
	case "product":
	  include('action/action.product.php');     //物品信息
	  break;
	case "supplier":
	  include('action/action.supplier.php');     //供货商管理
	  break;
	case "company":
	  include('action/action.company.php');     //公司名称设置
	  break;
	case "simstate":
	  include('action/action.simstate.php');     //sim卡状态管理
	  break;
	case "simzifei":
	  include('action/action.simzifei.php');     //sim卡资费管理
	  break;
	case "caigou":
	  include('action/action.caigou.php');      //采购商品
	  break;
	case "storage_ru":
	  include('action/action.storage_ru.php');     //入库信息
	  break;
	case "storage_chu":
	  include('action/action.storage_chu.php');     //出库信息
	  break;
	case "storage":
	  include('action/action.storage.php');     //库存信息
	  break;
	case "sim_sto":
	  include('action/action.sim_sto.php');     //SIM卡库存信息
	  break;
	case "diaobo":
	  include('action/action.diaobo.php');     //调拨管理
	  break;
	case "diaoboagree":
	  include('action/action.diaoboagree.php');     //确认调拨
	  break;
	case "detail":
	  include('action/action.detail.php');     //设备出入库明细表
	  break;
	case "platform":
	  include('action/action.platform.php');     //平台管理
	  break;
	case "carstate":
	  include('action/action.carstate.php');     //车辆状态管理
	  break;
	case "carleixing":
	  include('action/action.carleixing.php');     //车辆类型管理
	  break;
	
	case "car":
	  include('action/action.car.php');     //车辆管理
	  break;
	case "fenqicar":
	  include('action/action.fenqicar.php');     //车辆管理
	  break;
	case "sim":
	  include('action/action.sim.php');     //SIM卡管理
	  break;
	case "device":
	  include('action/action.device.php');     //设备管理
	  break; 
    case "beiji":
	  include('action/action.beiji.php');     //备机使用协议
	  break;
    case "beijiunusual":
	  include('action/action.beijiunusual.php');     //异常备机
	  break;
    case "repair":
	  include('action/action.repair.php');     //备机使用协议
	  break;
	case "shenyan":
	  include('action/action.shenyan.php');     //审验管理
	  break;
	case "carinfo":
	  include('action/action.carinfo.php');     //车辆汇总信息管理
	  break;
	case "day":
	  include('action/action.day.php');     //日统计
	  break;
	case "week":
	  include('action/action.week.php');     //周统计
	  break;
	case "month":
	  include('action/action.month.php');     //月统计
	  break;
	case "year":
	  include('action/action.year.php');     //周统计
	  break;
	case "maintain":
	  include('action/action.maintain.php');     //终端维修记录
	  break;
	case "cards":
	  include('action/action.cards.php');     //卡号管理
	  break;
	  
	case "sale":
	  include('action/action.sale.php');     //销售实体商品
	  break;
	case "fuwu":
	  include('action/action.fuwu.php');     //销售实体商品
	  break;
	case "finance":
	  include('action/action.finance.php');     //实体商品核对
	  break;
	case "fuwucheck":
	  include('action/action.fuwucheck.php');     //虚拟商品核对
	  break;
	case "shencheck":
	  include('action/action.shencheck.php');     //审验核对
	  break;
	  
	case "huikuan":
	  include('action/action.huikuan.php');     //回款单
	  break;
	case "duizhang":
	  include('action/action.duizhang.php');     //对账单
	  break;
	  
	case "photo":
	  include('action/action.photo.php');     //照片
	  break;
	case "tel":
	  include('action/action.tel.php');       //电话
	  break;
	case "doc":
	  include('action/action.doc.php');       //公告
	  break;
	case "track":
	  include('action/action.track.php');     //打卡
	  break;
	case "note":
	  include('action/action.note.php');      //反馈
	  break;
	case "report":
	  include('action/action.report.php');    //报表
	  break;
	case "config":
	  include('action/action.config.php');    //配置
	  break;
	case "role":
	  include('action/action.role.php');      //角色
	  break;
	case "user":
	  include('action/action.user.php');      //用户
	  break;
	case "company1":
	  include('action/action.company1.php');      //分公司管理
	  break;
	case "data":
	  include('action/action.data.php');      //数据
	  break;
	case "mobile":
	  include('action/action.mobile.php');	  //手机
	  break;
    case "wangdian":
	  include('action/action.wangdian.php');	  //维修网点管理
	  break;
	case "weixiuproject":
	  include('action/action.weixiuproject.php');	  //维修项目管理
	  break;	  
	case "outrepair":
	  include('action/action.outrepair.php');	  //维修网点
	  break;
	case "weixiuresult":
	  include('action/action.weixiuresult.php');	  //维修结果汇总
	  break;
	case "tongji":
	  include('action/action.tongji.php');	  //维修结果统计
	  break;
	case "log":
	  include('action/action.log.php');	  //操作日志
	  break;
	case "record":
	  include('action/action.record.php');	  //数据记录
	  break;
	case "jixiao":
	  include('action/action.jixiao.php');	  //绩效考核
	  break;
	case "install":
	  include('action/action.install.php');	  //绩效考核
	  break;
	default:
	  echo "404!";
}

?>