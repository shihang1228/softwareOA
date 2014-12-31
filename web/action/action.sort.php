<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	

	//判断如果是维护只显示自己的
	//if($_SESSION[roleid]=="3"){$search .= " and salesid = '$_SESSION[userid]'";} //维护
	
	//设置分页
	if($_POST[numPerPage]=="")
	{
		$numPerPage="24";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" )
	{
		$pageNum="0";
	}else{
		$pageNum=($_POST[pageNum]-1)*$numPerPage;
	}
	$info_num=mysql_query("SELECT * FROM `rv_sort`");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT * FROM `rv_sort` order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('sort_list.htm');
	exit;	
}

if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('sort_new.htm');
	exit;
}

if($do=="add"){
	If_rabc($action,$do); //检测权限
	$id=$_SESSION[id];
	//将名称中的英文()替换为中文（）
	$category1=str_replace("(","（",$_POST[category]);
	$category=str_replace(")","）",$category1);
	$sql="INSERT INTO `rv_sort` (`category`,`terminal`)
	VALUES ('$category','$_POST[terminal]');";
	if($db->query($sql)){echo close($msg,"sort");}else{echo error($msg);}
	exit;
}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_sort`");
	//查询商品表中是否还存在该类别的商品，如果存在，提示用户
	$sql="select sum(quantity) as quantity from `rv_storage` where productId in(select id from `rv_product` where categoryId=$id)";
	$db->query($sql);
	$row=$db->fetchRow();
	$i=0;
	if($row[quantity]>$i){//库存表中有该商品
		echo error_del($msg);
	}else{
		$sql="delete from `rv_sort` where `rv_sort`.`id`=$id limit 1";
		if($db->query($sql)){echo success($msg);}else{echo error($msg);}	
	}	
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_sort`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_sort` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('title',"编辑");
	$smt->display('sort_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_sort`");
	//将名称中的英文()替换为中文（）
	$category1=str_replace("(","（",$_POST[category]);
	$category=str_replace(")","）",$category1);
	//sql
	$sql="UPDATE `rv_sort` SET 
	`category` = '$category',
	`terminal`='$_POST[terminal]'
	WHERE `rv_sort`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"sort");}else{echo error($msg);}	
	exit;
}

?>