<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	//判断检索值
	if($_POST['title']){$search .= " and title like '%$_POST[title]%'";}
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
	$info_num=mysql_query("SELECT * FROM `rv_doc` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//查询
	$sql="SELECT * FROM `rv_doc` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][doctid_txt] = $doctid[$list[$key][doctid]];
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"列表");
	$smt->display('doc_list.htm');
	exit;
	
}

//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);

	//模版
	$smt->assign('doctid_cn',select($doctid,"doctid","","选择类型","required"));
	$smt->assign('title',"新建");
	$smt->display('doc_new.htm');
	exit;
}

//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$salesid=$_SESSION[userid];
	$created_at=date("Y-m-d H:i:s", time());
	$sql="INSERT INTO `rv_doc` (`title`,`doctid`,`intro` ,`created_at`)
	VALUES ('$_POST[title]', '$_POST[doctid]','$_POST[intro]','$created_at');";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_doc` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('doctid_cn',select($doctid,"doctid",$row[doctid],"类型选择","required"));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑");
	$smt->display('doc_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	//dump($_POST);	
	$updated_at=date("Y-m-d H:i:s", time());
	$post_productid = implode(",",$_POST[productid]);
	//sql
	$sql="UPDATE `rv_doc` SET 
	`title` = '$_POST[title]',
	`doctid` = '$_POST[doctid]',
	`intro` = '$_POST[intro]',
	`updated_at` = '$updated_at' WHERE `rv_doc`.`id` ='$_POST[id]' LIMIT 1 ;";
	
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}	
	exit;
}

//展示	
if($do=="show"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_doc` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$row[doctid_txt] = $doctid[$row[doctid]];
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"明细");
	$smt->display('doc_show.htm');
	exit;
}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `rv_doc` where `rv_doc`.`id`='$id' LIMIT 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}


//上传图片
if($do=="upload"){	
	If_rabc($action,$do); //检测权限	
	$salesid=$_SESSION[userid];	
	
	$filename= md5(time().rand(0,9).$_FILES["filedata"]["name"]).".jpg";
	move_uploaded_file($_FILES["filedata"]["tmp_name"],"uploadfile/".$filename);	
	if($_FILES["filedata"]["size"]>"1240"){	
		$resizeimage = new resizeimage("uploadfile/".$filename, "137", "123", "1","uploadfile/"."m_".$filename);
	}else{	
		$resizeimage = new resizeimage("uploadfile/".$filename, "137", "123", "1","uploadfile/"."m_".$filename);
	}
	
	$created_at=date("Y-m-d h:i:s");
	$sql = "INSERT INTO `rv_photo` (`salesid`,`filename`,`intro`,`created_at` ) VALUES ( '$salesid','$filename','文档图片','$created_at');";	
	if($db->query($sql)){
		$url= "uploadfile/".$filename;
		exit("{'err':'','msg':{'url':'!".$url."'}}");
	}else{
		exit(error($msg));
	}
	
}
?>