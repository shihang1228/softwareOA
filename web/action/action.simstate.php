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
	$info_num=mysql_query("SELECT * FROM `rv_simstate` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	//查询
	$sql="SELECT * FROM `rv_simstate` where 1=1 $search order by id asc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	//$smt->assign('title',"客户列表");
	$smt->display('simstate_list.htm');
	exit;	
}

//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('simstate_new.htm');
	exit;
}

//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	//将名称中的英文()替换为中文（）
	$simstate1=str_replace("(","（",$_POST[simstate]);
	$simstate=str_replace(")","）",$simstate1);
	$sql="INSERT INTO `rv_simstate` (`simstate`)
	VALUES ('$simstate');";
	if($db->query($sql)){echo close($msg,"simstate");}else{echo error($msg);}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_simstate`");
	$sql="delete from `rv_simstate` where `rv_simstate`.`id`='{$id}' limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}

?>