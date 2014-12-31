<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	if($_POST['company']){$search .= " and company like '%$_POST[company]%'";}
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
	$info_num=mysql_query("SELECT * FROM `rv_company` where company1 in ($arr2) $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT * FROM `rv_company` where company1 in ($arr2) $search order by id asc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	//$smt->assign('title',"客户列表");
	$smt->display('company_list.htm');
	exit;	
}



//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('company_new.htm');
	exit;
}


//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	//将名称中的英文()替换为中文（）
	$company1=str_replace("(","（",$_POST[company]);
	$company=str_replace(")","）",$company1);
	$sql="INSERT INTO `rv_company` (`company`,`company1` )
	VALUES ('$company','$_SESSION[company1]');";
	if($db->query($sql)){echo close($msg,"company");}else{echo error($msg);}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_company`");
	$sql="delete from `rv_company` where `rv_company`.`id`='{$id}' limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_company`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_company` where id='{$id}' LIMIT 1";//'{$id}'获取list页面中传递的id
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('title',"编辑");
	$smt->display('company_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_company`");	
	//将名称中的英文()替换为中文（）
	$company1=str_replace("(","（",$_POST[company]);
	$company=str_replace(")","）",$company1);
	//sql
	$sql="UPDATE `rv_company` SET 
	`company` = '$company'
	WHERE `rv_company`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"company");}else{echo error($msg);}	
	exit;
}

?>