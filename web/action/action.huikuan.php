<?php
//====================================================
//		FileName: action.info.php
//		Summary:  客户信息文件
//====================================================
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
//查询
	$sql="SELECT id,name FROM `rv_client` where company1 in ($arr2)";
	$db->query($sql);
	$client_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($client_arr as $key=>$val){
		$client_list[$client_arr[$key][id]] = $client_arr[$key][name];	//车辆的公司名称数组		
	}
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['cname']){$search .= " and rv_client.name like '%$_POST[cname]%'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `date` >  '$_POST[time_start] 00:00:00' AND  `date` <  '$_POST[time_over] 23:59:59'";
	}
	else if($_POST['time_start']!=""){
		$search .= " and `date` >  '$_POST[time_start] 00:00:00' AND `date` <  '$_POST[time_start] 23:59:59'";
	}
	else if($_POST['time_over']!=""){
		$search .= " and `date` >  '$_POST[time_over] 00:00:00' AND `date` <  '$_POST[time_over] 23:59:59'";
	}
	
	//设置分页
	if($_POST[numPerPage]==""){$numPerPage="24";}else{$numPerPage=$_POST[numPerPage];}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_huikuan` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT rv_huikuan.id,rv_client.name,rv_huikuan.money,rv_huikuan.date,rv_huikuan.inputer FROM `rv_huikuan`,`rv_client` where rv_huikuan.clientId=rv_client.id $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"汇款单");
	$smt->display('huikuan_list.htm');
	exit;	
}

//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('clientId_cn',select($client_list,"clientId","","选择客户"));
	//模版	
	$smt->assign('title',"新建");
	$smt->display('huikuan_new.htm');
	exit;
}

//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$username=$_SESSION['username'];
	$sql="INSERT INTO `rv_huikuan` (`clientId` ,`money` ,`inputer`)
	VALUES ('$_POST[clientId]', '$_POST[money]','$username');";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}
	$sql="SELECT * FROM `rv_duizhang` where clientId='$_POST[clientId]'";
	$a=mysql_query($sql);
	$r=mysql_num_rows($a);
	$i=0;
	if($r>$i){
	//对账表中有该客户
	$sql="UPDATE `rv_duizhang` SET `huikuan`=`huikuan`+'$_POST[money]' where `clientId`='$_POST[clientId]'";
	$db->query($sql);
	}else{
	//对账表中没有该客户
	$sql="INSERT INTO `rv_duizhang` (`clientId`,`huikuan`) VALUES ('$_POST[clientId]','$_POST[money]');";
	$db->query($sql);
	}
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	
	//查询
	$sql="SELECT * FROM `rv_huikuan` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('clientId_cn',select($client_list,"clientId",$row[clientId],"选择客户"));//第三个参数显示选中的选项
	$smt->assign('row',$row);
	$smt->assign('title',"编辑");
	$smt->display('huikuan_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限	
	if($_POST[id]){$id=$_POST[id];}
	else{$id=$_SESSION[id];}
	
	$sql="UPDATE `rv_huikuan` SET
	`clientId` = '$_POST[clientId]',
	`money` = '$_POST[money]'
	 WHERE `rv_huikuan`.`id` ='$_POST[id]' LIMIT 1 ;";
	
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}	
	exit;
}


//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `rv_huikuan` where `rv_huikuan`.`id`=$id limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}
?>