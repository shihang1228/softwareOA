<?php
//====================================================
//		FileName: action.info.php
//		Summary:  客户信息文件
//====================================================
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['linkman']){$search .= " and linkman like '%$_POST[linkman]%'";}		
	
	//设置分页
	if($_POST[numPerPage]==""){$numPerPage="24";}else{$numPerPage=$_POST[numPerPage];}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_supplier` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT * FROM `rv_supplier` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"车辆列表");
	$smt->display('supplier_list.htm');
	exit;	
}

//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);

	//模版	
	$smt->assign('title',"新建");
	$smt->display('supplier_new.htm');
	exit;
}

//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	//将供货商名称中的英文()替换为中文（）
	$name1=str_replace("(","（",$_POST[name]);
	$name=str_replace(")","）",$name1);
	$sql="INSERT INTO `rv_supplier` (`name` ,`linkman` ,`address`,`phone`)
	VALUES ('$name', '$_POST[linkman]', '$_POST[address]', '$_POST[phone]');";
	if($db->query($sql)){echo close($msg,"supplier");}else{echo error($msg);}
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_supplier`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_supplier` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"编辑");
	$smt->display('supplier_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_supplier`");	
	//将供货商名称中的英文()替换为中文（）
	$name1=str_replace("(","（",$_POST[name]);
	$name=str_replace(")","）",$name1);
	$sql="UPDATE `rv_supplier` SET
	`name` = '$name',
	`linkman` = '$_POST[linkman]',
	`address` = '$_POST[address]',
	`phone` = '$_POST[phone]' WHERE `rv_supplier`.`id` ='$_POST[id]' LIMIT 1 ;";
	if($db->query($sql)){echo close($msg,"supplier");}else{echo error($msg);}	
	exit;
}


//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_supplier`");
	$sql="delete from `rv_supplier` where `rv_supplier`.`id`=$id limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}
?>