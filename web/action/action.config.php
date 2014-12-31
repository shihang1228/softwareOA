<?php
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	if($_POST['title']){$search .= "and title like '%$_POST[title]%'";}	
	if($_POST['type']){$search .= "and type = '$_POST[type]'";}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_type` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询
	$sql="SELECT * FROM `rv_type` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();	
	
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][type_cn]=$type_cn[$list[$key][type]];	
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('select_type_cn',select($type_cn,"type","","选择类型","required"));
	$smt->assign('title',"配置列表");
	$smt->display('config_list.htm');
	exit;
	
}


//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('select_type_cn',select($type_cn,"type","","选择类型","required"));
	$smt->assign('title',"新建配置");
	$smt->display('config_new.htm');
	exit;
}

//编辑	
if($do=="edit"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_type` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	//模版
	$smt->assign('select_type_cn',select($type_cn,"type",$row[type],"选择类型","required"));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑配置");
	$smt->display('config_edit.htm');
	exit;
}



//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$created_at=date("Y-m-d H:i:s", time());
	
	$sql="INSERT INTO `rv_type` (`title` ,`type` ,`created_at` )
	VALUES ( '$_POST[title]','$_POST[type]', '$created_at');";
	if($db->query($sql)){echo success($msg);}else{echo  success($msg);}	
	exit;
}


//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	$updated_at=date("Y-m-d H:i:s", time());
	$id=$_POST['id'];

	$sql="UPDATE `rv_type` SET 
	`title`  = '$_POST[title]',
	`type`  = '$_POST[type]',	
	`updated_at` = '$updated_at' WHERE `rv_type`.`id` ='$id' LIMIT 1 ;";
	if($db->query($sql)){echo success($msg);}else{echo  success($msg);}		
	exit;
}


//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `rv_type` where `rv_type`.`id`=$id limit 1";
	if($db->query($sql)){echo success($msg);}else{echo  success($msg);}	
	exit;
}
?>