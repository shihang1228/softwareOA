<?php
if(!defined('CORE'))exit("error!"); 
$company1=$_SESSION['company1'];
//角色页面权限
function checkbox_role_action($row_action){
	global $action_cn;	
	$action=explode(',',$row_action);
	$i=1;
	foreach($action_cn as $key=>$val){
		if($key!="0"){
		if(in_array($key,$action)){
		$cbox .="<span style=\"float:left;width:150px\"><input name=\"action[]\" type=\"checkbox\" value=\"$key\" checked=\"checked\" />$val</span>\n";
		}else{
		$cbox .= "<span style=\"float:left;width:150px\"><input name=\"action[]\" type=\"checkbox\" value=\"$key\" />$val</span>\n";
		}
		}
		if($i==8){$cbox .="";}//没有意义
		$i++;
	}
	return $cbox;
}

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	if($_POST['title']){$search .= "and title like '%$_POST[title]%'";}
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_role` where company1 in ($arr2) $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询
	$sql="SELECT * FROM `rv_role` where company1 in ($arr2) $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][role_cn]=$role_cn[$list[$key][role_id]];		
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('title',"角色列表");
	$smt->display('role_list.htm');
	exit;
	
}


//面板	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('checkbox_role_action',checkbox_role_action());
	$smt->assign('title',"新建角色");
	$smt->display('role_new.htm');
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_role`");	
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_role` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('checkbox_role_action',checkbox_role_action($row[action]));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑角色");
	$smt->display('role_edit.htm');
	exit;
}

//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$action=implode(',',$_POST[action]);
	
	$sql="INSERT INTO `rv_role` (`title` ,`action`,`company1`)
	VALUES ( '$_POST[title]', '$action','$company1');";
	if($db->query($sql)){echo close($msg,"role");}else{echo  error($msg);}	
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	$id=$_POST['id'];
	If_comrabc($id,"`rv_role`");	
	$action=implode(',',$_POST[action]);
	$sql="UPDATE `rv_role` SET 
	`title` = '$_POST[title]',
	`action` = '$action',
	`company1` = '$company1' WHERE `rv_role`.`id` =$id LIMIT 1 ;";
	if($db->query($sql)){echo close($msg,"role");}else{echo  error($msg);}	
	exit;
}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_role`");	
	echo  "{\"statusCode\":\"300\",\"message\":\"禁止删除!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	exit;
	$sql="delete from `rv_role` where `rv_role`.`id`=$id limit 1";
	if($db->query($sql)){echo success($msg);}else{echo  error($msg);}	
	exit;
}
?>