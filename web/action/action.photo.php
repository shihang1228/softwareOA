<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	
	//判断检索值
	if($_POST['salesid']){$search .= " and salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and created_at >  '$_POST[time_start] 00:00:00' AND  created_at <  '$_POST[time_over] 23:59:59'";
	}
	
	//判断用户级别显示
	if($_SESSION[roleid]=="3"){$search .= " and s.salesid = '$_SESSION[userid]'";} //销售
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_photo` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	


	//查询
	$sql="SELECT * FROM `rv_photo` where 1=1  $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//echo $sql;
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$list[$key][intro] = urldecode($list[$key][intro]);		
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('salesid_cn',select($user_list,"salesid",$_POST[salesid],"销售选择"));	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"列表");
	$smt->display('photo_list.htm');
	exit;
	
}

?>