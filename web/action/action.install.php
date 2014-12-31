<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['address']){$search .= " and address like '%$_POST[address]%'";}
	
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
	$info_num=mysql_query("SELECT * FROM `rv_install` where company1 in ($arr2) $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT * FROM `rv_install` where company1 in ($arr2) $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('install_list.htm');
	exit;	
}



//新增安装信息
if($do=="new"){
    If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('install_new.htm');
	exit;
}


//写入安装信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$sql="INSERT INTO `rv_install` (`carNum`,`company1` )
	VALUES ('$_POST[carNum]', '$_SESSION[company1]');";
	if($db->query($sql)){echo close($msg,"install");}else{echo error($msg);}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_storage`");	
	//查找该库房中是否有东西
	$sql="select * from `rv_storage` where roomId='$id' and company1='$_SESSION[company1]'";
	$a=mysql_query($sql);
	$b=mysql_num_rows($a);
	if($b>0){
		echo error("该库房中有商品不能进行删除！");	
	}else{
		$sql="delete from `rv_room` where `rv_room`.`id`='$id' limit 1";
		if($db->query($sql)){echo success($msg);}else{echo error($msg);}
	}	
	exit;
}
//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限	
	If_comrabc($_POST[id],"`rv_install`");	
	//sql
	$sql="UPDATE `rv_room` SET 
	`name` = '$name',
	`address` = '$_POST[address]'
	WHERE `rv_room`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"room");}else{echo error($msg);}	
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_storage`");	
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_room` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('title',"编辑");
	$smt->display('room_edit.htm');
	exit;
}

?>