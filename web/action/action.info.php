<?php
//====================================================
//		FileName: action.info.php
//		Summary:  客户信息文件
//====================================================
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
@define("CORE",dirname(__FILE__)."/"); 	    //根目录    dirname(string path)返回路径中的目录部分
require_once("lib/mysql.class.php"); 
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}	
	if($_POST['address']){$search .= " and address like '%$_POST[address]%'";}
	if($_POST['areaid']){$search .= " and areaid = '$_POST[areaid]'";}
	if($_POST['typeid']){$search .= " and typeid = '$_POST[typeid]'";}
	if($_POST['salesid']){$search .= " and salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND  `created_at` <  '$_POST[time_over] 23:59:59'";
	}
	else if($_POST['time_start']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND `created_at` <  '$_POST[time_start] 23:59:59'";
	}
	else if($_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_over] 00:00:00' AND `created_at` <  '$_POST[time_over] 23:59:59'";
	}
	
	//判断如果是维护只显示自己的
	if($_SESSION[roleid]=="3"){$search .= " and salesid = '$_SESSION[userid]'";} //维护
	
	//设置分页
	if($_POST[numPerPage]==""){$numPerPage="24";}else{$numPerPage=$_POST[numPerPage];}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_info` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT * FROM `rv_info` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][typeid_txt] = $typeid[$list[$key][typeid]];
		$list[$key][areaid_txt] = $areaid[$list[$key][areaid]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];		
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid",$_POST[typeid],"选择公司"));
	$smt->assign('areaid_cn',select($areaid,"areaid",$_POST[areaid],"地区选择"));
	$smt->assign('salesid_cn',select($user_list,"salesid",$_POST[salesid],"维护选择"));	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"车辆列表");
	$smt->display('info_list.htm');
	exit;	
}

//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//模版
	$smt->assign('typeid_cn',select($typeid,"typeid","","选择公司","required"));
	$smt->assign('brandid_cn',select($brandid,"brandid","","品牌选择","required"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择","required"));
	$smt->assign('salesid_cn',select($user_list,"salesid","","维护选择"));	
	$smt->assign('title',"新建");
	$smt->display('info_new.htm');
	exit;
}

//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	if($_POST[salesid]){$salesid=$_POST[salesid];}
	else{$salesid=$_SESSION[userid];}
	$post_productid = implode(",",$_POST[productid]);
	$sql="INSERT INTO `rv_info` (`name` ,`address`,`linkman`,`tel`,`longitude`,`latitude`,`location`,`areaid`,`salesid`,`typeid`,`intro`)
	VALUES ('$_POST[name]', '$_POST[address]', '$_POST[linkman]','$_POST[tel]','$_POST[longitude]','$_POST[latitude]','$_POST[location]','$_POST[areaid]','$salesid','$_POST[typeid]','$_POST[intro]');";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_info` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('typeid_cn',select($typeid,"typeid",$row[typeid],"类型选择","required"));
	$smt->assign('areaid_cn',select($areaid,"areaid",$row[areaid],"地区选择","required"));
	$smt->assign('brandid_cn',select($brandid,"brandid",$row[brandid],"品牌选择","required"));
	$smt->assign('salesid_cn',select($user_list,"salesid",$row[salesid],"销售选择"));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑");
	$smt->display('info_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限	
	if($_POST[salesid]){$salesid=$_POST[salesid];}
	else{$salesid=$_SESSION[userid];}
	//dump($_POST);	
	$updated_at=date("Y-m-d H:i:s", time());
	$post_productid = implode(",",$_POST[productid]);
	//sql
	$sql="UPDATE `rv_info` SET 
	`name` = '$_POST[name]',
	`areaid` = '$_POST[areaid]',
	`typeid` = '$_POST[typeid]',
	`address` = '$_POST[address]',
	`linkman` = '$_POST[linkman]',
	`tel` = '$_POST[tel]',
	`longitude` = '$_POST[longitude]',
	`latitude` = '$_POST[latitude]',
	`location` = '$_POST[location]',
	`intro` = '$_POST[intro]',
	`salesid`='$salesid',
	`updated_at` = '$updated_at' WHERE `rv_info`.`id` ='$_POST[id]' LIMIT 1 ;";
	
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}	
	exit;
}

//展示	
if($do=="show"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_info` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	
	$row[typeid_txt] = $typeid[$row[typeid]];
	$row[brandid_txt] = $brandid[$row[brandid]];
	$row[areaid_txt] = $areaid[$row[areaid]];
	$row[salesid_txt] = $user_list[$row[salesid]];
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"明细");
	$smt->display('info_show.htm');
	exit;
}


//展示	
if($do=="map"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_info` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('latitude',$row[latitude]);
	$smt->assign('longitude',$row[longitude]);	
	$smt->assign('title',"明细");
	$smt->display('track_show.htm');
	exit;
}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `rv_info` where `rv_info`.`id`=$id limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}
?>