<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND  `created_at` <  '$_POST[time_over] 23:59:59'";
	}
	else if($_POST['time_start']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND `created_at` <  '$_POST[time_start] 23:59:59'";
	}
	else if($_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_over] 00:00:00' AND `created_at` <  '$_POST[time_over] 23:59:59'";
	}
		
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_tel` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//查询
	$sql="SELECT * FROM `rv_tel` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//echo $sql;
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"列表");
	$smt->display('tel_list.htm');
	exit;
	
}

//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);

	//模版
	$smt->assign('title',"新建");
	$smt->display('tel_new.htm');
	exit;
}

//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$salesid=$_SESSION[userid];
	$created_at=date("Y-m-d H:i:s", time());
	$sql="INSERT INTO `rv_tel` (`name` ,`number`,`department`,`created_at`)
	VALUES ('$_POST[name]', '$_POST[number]','$_POST[department]','$created_at');";
	if($db->query($sql)){echo success($msg);}else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=tel\"}";}
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_tel` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"编辑");
	$smt->display('tel_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	//dump($_POST);	
	$updated_at=date("Y-m-d H:i:s", time());
	$post_productid = implode(",",$_POST[productid]);
	//sql
	$sql="UPDATE `rv_tel` SET 
	`name` = '$_POST[name]',
	`number` = '$_POST[number]',
	`department` = '$_POST[department]',
	`updated_at` = '$updated_at' WHERE `rv_tel`.`id` ='$_POST[id]' LIMIT 1 ;";
	
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}	
	exit;
}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `rv_tel` where `rv_tel`.`id`='$id' LIMIT 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}
?>