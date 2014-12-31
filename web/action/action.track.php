<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	if($_POST['salesid']){$search .= " and salesid = '$_POST[salesid]'";}
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
	$info_num=mysql_query("SELECT * FROM `rv_track` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//判断检索值
	if($_POST['name']){	
		$sql_user_cur="SELECT id,username FROM `rv_user` where username like '%$_POST[name]%' limit 1 ";
		$db->query($sql_user_cur);
		$user_cur=$db->fetchRow();
		$user_cur_id=$user_cur[id];	
		$search.=" and salesid = '$user_cur_id' ";
	}
	
	//查询
	$sql="SELECT * FROM `rv_track` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
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
		$intro=json_decode($list[$key][intro]);
		$intro_txt=json_to_array($intro);
		$list[$key][country]=$intro_txt[location][address][country];	
		if($list[$key][country]==""){$list[$key][country]="无地图信息!";}
		$list[$key][region]=$intro_txt[location][address][region];
		$list[$key][city]=$intro_txt[location][address][city];
		$list[$key][street]=$intro_txt[location][address][street];
		$list[$key][street_number]=$intro_txt[location][address][street_number];
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('salesid_cn',select($user_list,"salesid",$_POST[salesid],"销售选择"));	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"列表");
	$smt->display('track_list.htm');
	exit;
}

//展示	
if($do=="show"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_track` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
		
	//用户
	$sql_user="SELECT id,username FROM `rv_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$row[salesid_txt] = $user_list[$row[salesid]];
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"明细");
	$smt->assign('latitude',$row[latitude]);
	$smt->assign('longitude',$row[longitude]);	
	$smt->display('track_show.htm');
	exit;
}
?>