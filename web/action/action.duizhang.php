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
	$info_num=mysql_query("SELECT * FROM `rv_duizhang` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT rv_duizhang.id,name,huokuan,huikuan,(huikuan-huokuan) as tongji,date FROM `rv_duizhang`,`rv_client` where rv_duizhang.clientId=rv_client.id $search order by rv_duizhang.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"对账单");
	$smt->display('duizhang_list.htm');
	exit;	
}

?>