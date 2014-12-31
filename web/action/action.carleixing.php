<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	
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

	//查询
	$sql1="SELECT * FROM `rv_carleixing`";
	$info_num=mysql_query($sql1);//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT * FROM `rv_carleixing` order by id asc LIMIT $pageNum,$numPerPage";	
	$db->query($sql);
	$list=$db->fetchAll();

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('carleixing_list.htm');
	exit;	
}



//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('carleixing_new.htm');
	exit;
}


//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	//将名称中的英文()替换为中文（）
	$leixing1=str_replace("(","（",$_POST[leixing]);
	$leixing=str_replace(")","）",$leixing1);
	$sql="INSERT INTO `rv_carleixing` (`leixing`)
	VALUES ('$leixing');";
	if($db->query($sql)){echo close($msg,"carleixing");}else{echo error($msg);}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_carleixing`");
	$sql="delete from `rv_carleixing` where `rv_carleixing`.`id`=$id limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_carleixing`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_carleixing` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('title',"编辑");
	$smt->display('carleixing_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限	
	If_comrabc($_POST[id],"`rv_carleixing`");
	if($_POST[id]){$id=$_POST[id];}
	else{$id=$_SESSION[id];}
	//将名称中的英文()替换为中文（）
	$leixing1=str_replace("(","（",$_POST[leixing]);
	$leixing=str_replace(")","）",$leixing1);
	//sql
	$sql="UPDATE `rv_carleixing` SET 
	`leixing` = '$leixing'
	WHERE `rv_carleixing`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"carleixing");}else{echo error($msg);}	
	exit;
}

?>