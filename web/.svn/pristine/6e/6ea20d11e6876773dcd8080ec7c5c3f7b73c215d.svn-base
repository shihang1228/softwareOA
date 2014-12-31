<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//数组转化为type循环th名称
function type_tj_th($arr,$report){
	foreach($arr as $key=>$val){
		$slt .= "<th>".$val." <a href=\"index.php?action=report&prod=".$key."&do=".$report."&time_start=".$_POST[time_start]."&time_over=".$_POST[time_over]."\" target=\"_blank\"\">[柱状图]</a></th>\n";
	}
	return $slt;
}


//[1]维护销计表查询
function count_user_tt($productid,$cuserid,$search,$td){
		global $db;
		//按维护类型查询数量
		$sql="SELECT sellproduct,sellvol FROM `rv_sell` where salesid={$cuserid} {$search}";
		$db->query($sql);
		$list=$db->fetchAll();	
		foreach($list as $k=>$v){	
			 $list[sellvol] = explode(",",$list[$k][sellvol]);
			 $list[sellproduct] = explode(",",$list[$k][sellproduct]);
			 foreach($list[sellvol] as $key=>$val){		 
				$selllist[newsellvol][$list[sellproduct][$key]] += $val;
			 }
		}
		if($td!=""){
			$tdl="<td>";
			$tdr="</td>";
		}
		foreach($productid as $kk=>$vv){
			if($selllist[newsellvol][$kk]==""){
			$cc .= $tdl."0".$tdr;
			}else{			
			$cc .=  $tdl.$selllist[newsellvol][$kk].$tdr;
			}
		}
		return $cc;
}

//[1]维护统计表统计查询
function count_user_th($productid,$cuserid,$search){
		global $db;
		//按维护类型查询数量
		$sql="SELECT sellproduct,sellvol FROM `rv_sell` where salesid={$cuserid} {$search}";
		$db->query($sql);
		$list=$db->fetchAll();	
		foreach($list as $k=>$v){	
			 $list[sellvol] = explode(",",$list[$k][sellvol]);
			 $list[sellproduct] = explode(",",$list[$k][sellproduct]);
			 foreach($list[sellvol] as $key=>$val){		 
				$selllist[newsellvol][$list[sellproduct][$key]] += $val;
			 }
		}
		foreach($productid as $kk=>$vv){
			if($kk == $_GET[prod]){				
				if($selllist[newsellvol][$kk]==""){
					$cc[] .= "0";
				}else{
					$cc[] .=  $selllist[newsellvol][$kk];
				}			
			}
		}
		return $cc;
}

//[2]区域统计表查询
function count_areaid_tt($productid,$areaid,$search,$td){
		global $db;
		
		$sql="SELECT distinct id FROM `rv_info` WHERE `areaid` = {$areaid}";
		$db->query($sql);
		$area_list =$db->fetchAll();
		foreach($area_list as $k=>$v){
			$area_list[$k] = $area_list[$k][id];
		}
		$userarr = implode(",",$area_list); 
		//按维护类型查询数量
		if($userarr!=""){
			$sql="SELECT sellproduct,sellvol FROM `rv_sell` where `infoid` in ({$userarr}) {$search}";
		}else{
			$sql="SELECT sellproduct,sellvol FROM `rv_sell` where `infoid` in (0) {$search}";
		}
		
		$db->query($sql);
		$list=$db->fetchAll();	
		foreach($list as $k=>$v){	
			 $list[sellvol] = explode(",",$list[$k][sellvol]);
			 $list[sellproduct] = explode(",",$list[$k][sellproduct]);
			 foreach($list[sellvol] as $key=>$val){		 
				$selllist[newsellvol][$list[sellproduct][$key]] += $val;
			 }
		}
		if($td!=""){
			$tdl="<td>";
			$tdr="</td>";
		}
		foreach($productid as $kk=>$vv){
			if($selllist[newsellvol][$kk]==""){
			$cc .= $tdl."0".$tdr;
			}else{			
			$cc .=  $tdl.$selllist[newsellvol][$kk].$tdr;
			}
		}
		return $cc;
}

//[2]维护统计表统计查询
function count_areaid_th($productid,$areaid,$search){
		global $db;
		
		$sql="SELECT distinct id FROM `rv_info` WHERE `areaid` = {$areaid}";
		$db->query($sql);
		$area_list =$db->fetchAll();
		foreach($area_list as $k=>$v){
			$area_list[$k] = $area_list[$k][id];
		}
		$areaarr = implode(",",$area_list); 
		
		//按维护类型查询数量
		
		//按维护类型查询数量
		if($areaarr!=""){
			$sql="SELECT sellproduct,sellvol FROM `rv_sell` where `infoid` in ({$areaarr}) {$search}";
		}else{
			$sql="SELECT sellproduct,sellvol FROM `rv_sell` where `infoid` in (0) {$search}";	
		}
		
		$db->query($sql);
		$list=$db->fetchAll();	
		foreach($list as $k=>$v){	
			 $list[sellvol] = explode(",",$list[$k][sellvol]);
			 $list[sellproduct] = explode(",",$list[$k][sellproduct]);
			 foreach($list[sellvol] as $key=>$val){		 
				$selllist[newsellvol][$list[sellproduct][$key]] += $val;
			 }
		}
		foreach($productid as $kk=>$vv){		
			if($kk == $_GET[prod]){			
				if($selllist[newsellvol][$kk]==""){
				$cc[] .= "0";
				}else{			
				$cc[] .=  $selllist[newsellvol][$kk];
				}
			}
		}
		return $cc;
}


//[3]类型统计表查询
function count_typeid_tt($productid,$typeid,$search,$td){
		global $db;
		
		$sql="SELECT distinct id FROM `rv_info` WHERE `typeid` = {$typeid}";
		$db->query($sql);
		$type_list =$db->fetchAll();
		foreach($type_list as $k=>$v){
			$type_list[$k] = $type_list[$k][id];
		}
		$typearr = implode(",",$type_list); 
		
		//按维护类型查询数量
		if($typearr!=""){
			$sql="SELECT sellproduct,sellvol FROM `rv_sell` where `infoid` in ({$typearr}) {$search}";	
		}else{
			$sql="SELECT sellproduct,sellvol FROM `rv_sell` where `infoid` in (0) {$search}";		
		}
		$db->query($sql);
		$list=$db->fetchAll();	
		
		foreach($list as $k=>$v){	
			 $list[sellvol] = explode(",",$list[$k][sellvol]);
			 $list[sellproduct] = explode(",",$list[$k][sellproduct]);
			 foreach($list[sellvol] as $key=>$val){		 
				$selllist[newsellvol][$list[sellproduct][$key]] += $val;
			 }
		}
		if($td!=""){
			$tdl="<td>";
			$tdr="</td>";
		}
		foreach($productid as $kk=>$vv){
			if($selllist[newsellvol][$kk]==""){
			$cc .= $tdl."0".$tdr;
			}else{			
			$cc .=  $tdl.$selllist[newsellvol][$kk].$tdr;
			}
		}
		return $cc;
}

//[3]类型统计表统计查询
function count_typeid_th($productid,$typeid,$search){
		global $db;
		
		$sql="SELECT distinct id FROM `rv_info` WHERE `typeid` = {$typeid}";
		$db->query($sql);
		$type_list =$db->fetchAll();
		foreach($type_list as $k=>$v){
			$type_list[$k] = $type_list[$k][id];
		}
		$typearr = implode(",",$type_list); 
		//按维护类型查询数量
		if($typearr!=""){
			$sql="SELECT sellproduct,sellvol FROM `rv_sell` where `infoid` in ({$typearr}) {$search}";	
		}else{
			$sql="SELECT sellproduct,sellvol FROM `rv_sell` where `infoid` in (0) {$search}";		
		}
		$db->query($sql);
		$list=$db->fetchAll();	
		foreach($list as $k=>$v){	
			 $list[sellvol] = explode(",",$list[$k][sellvol]);
			 $list[sellproduct] = explode(",",$list[$k][sellproduct]);
			 foreach($list[sellvol] as $key=>$val){		 
				$selllist[newsellvol][$list[sellproduct][$key]] += $val;
			 }
		}
		foreach($productid as $kk=>$vv){		
			if($kk == $_GET[prod]){			
				if($selllist[newsellvol][$kk]==""){
				$cc[] .= "0";
				}else{			
				$cc[] .=  $selllist[newsellvol][$kk];
				}
			}
		}
		return $cc;
}


//【1】维护统计表
if($do=="t1"){
	If_rabc($action,$do); //检测权限	//查询
	
	//判断检索值
	if($_POST['time_start'] && $_POST['time_over']){
		$search = " and `created_at` > '$_POST[time_start] 00:00:00' and `created_at`<  '$_POST[time_over] 23:59:59' ";
	}	
	
	//sql按用户
	$sql ="SELECT id,username FROM `rv_user` as u group by id asc";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][productid_tj] = count_user_tt($productid,$list[$key][id],$search,"td");
	}
	
	//sql合计
	$sqltotal ="SELECT sellproduct,sellvol FROM `rv_sell` where 1=1 {$search}";
	$db->query($sqltotal);
	$listtotal=$db->fetchAll();
	//格式化输出数据
	foreach($listtotal as $k=>$v){	
		 $listtotal[sellvol] = explode(",",$listtotal[$k][sellvol]);
		 $listtotal[sellproduct] = explode(",",$listtotal[$k][sellproduct]);
		 foreach($listtotal[sellvol] as $key=>$val){		 
			$selllist[newsellvol][$listtotal[sellproduct][$key]] += $val;
		 }
	}
	foreach($selllist[newsellvol] as $keyt=>$valt){
		$productid_tj_total .= "<td>".$valt."</td>";
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('productid_tj_total',$productid_tj_total);	
	$smt->assign('productid_cn',type_tj_th($productid,"t1t"));
	$smt->assign('postdate_start',$_POST[time_start]);
	$smt->assign('postdate_over',$_POST[time_over]);
	$smt->assign('title',"维护统计表");
	$smt->display('report_t1.htm');
	exit;
}


//【1】 维护统计表 [图]
if($do=="t1t"){
	If_rabc($action,$do); //检测权限
	$post_prod = $_POST[prod];
	
	//判断检索值
	if($_GET['time_start'] && $_GET['time_over']){
		$search = " and `created_at` > '$_GET[time_start] 00:00:00' and `created_at`<  '$_GET[time_over] 23:59:59' ";
		$postdate = "<span class='t_title'>当前时间范围: [$_GET[time_start] 00:00:00] 到 [$_GET[time_over] 23:59:59]</span>";
	}else{
		$postdate = "<span class='t_title'>当前时间范围:全部时间</span>";
	}
	
	//sql按用户查询
	$sql ="SELECT id,username FROM `rv_user` as u group by id asc";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$x_title[]="'".$list[$key][username]."'";
		$productid_tj[] = count_user_th($productid,$list[$key][id],$search);
	}
	
	//格式化报表数据按维护类型维护人合计
	foreach($productid as $key=>$val){	
		if($key==$_GET[prod]){		
			$i=0;
			foreach($productid_tj as $k=>$v){
				$num_arr0[$i+1][] = $productid_tj[$k][$i];
			}
			$i++;
		}
	}
	
	//格式化
	foreach($productid as $key=>$val){		
		if($key==$_GET[prod]){
			$i=1;
			$num_arr[] = "var s".$i." = [".implode(",", $num_arr0[$i])."];\n";
			$numname_arr[] = "s".$i ;
			$titlecolor[] = $i.". ".$val."<br\>";
			$i++;
		}
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('prod_name',$productid[$_GET[prod]]);
	$smt->assign('x_title',implode(",", $x_title));
	$smt->assign('titlecolor',implode("<br/>", $titlecolor));
	$smt->assign('num',implode("", $num_arr));
	$smt->assign('numname',implode(",", $numname_arr));
	$smt->assign('postdate',$postdate);
	$smt->assign('title',"维护统计表 [图]");
	$smt->display('report_t1_t.htm');
	exit;
}



//【2】区域统计表	
if($do=="t2"){
	If_rabc($action,$do); //检测权限	//查询
	//判断检索值
	if($_POST['time_start'] && $_POST['time_over']){
		$search = " and `created_at` > '$_POST[time_start] 00:00:00' and `created_at`<  '$_POST[time_over] 23:59:59' ";
	}
	
	//格式化输出数据
	$i=0;
	foreach($areaid as $k1=>$v1){
		$list[$i][username] = $v1;
		$list[$i][productid_tj] = count_areaid_tt($productid,$k1,$search,"td");		
		$i++;
	}
	
	//sql合计
	$sqltotal ="SELECT sellproduct,sellvol FROM `rv_sell` where 1=1 {$search}";
	$db->query($sqltotal);
	$listtotal=$db->fetchAll();
	//格式化输出数据
	foreach($listtotal as $k=>$v){	
		 $listtotal[sellvol] = explode(",",$listtotal[$k][sellvol]);
		 $listtotal[sellproduct] = explode(",",$listtotal[$k][sellproduct]);
		 foreach($listtotal[sellvol] as $key=>$val){		 
			$selllist[newsellvol][$listtotal[sellproduct][$key]] += $val;
		 }
	}
	foreach($selllist[newsellvol] as $keyt=>$valt){
		$productid_tj_total .= "<td>".$valt."</td>";
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('productid_tj_total',$productid_tj_total);	
	$smt->assign('productid_cn',type_tj_th($productid,"t2t"));
	$smt->assign('postdate_start',$_POST[time_start]);
	$smt->assign('postdate_over',$_POST[time_over]);
	$smt->assign('title',"维护统计表");
	$smt->display('report_t2.htm');
	exit;
}

//【2】区域统计表 [图]
if($do=="t2t"){
	If_rabc($action,$do); //检测权限
	//判断检索值
	if($_GET['time_start'] && $_GET['time_over']){
		$search = " and `created_at` > '$_GET[time_start] 00:00:00' and `created_at`<  '$_GET[time_over] 23:59:59' ";
		$postdate = "<span class='t_title'>当前时间范围: [$_GET[time_start] 00:00:00] 到 [$_GET[time_over] 23:59:59]</span>";
	}else{
		$postdate = "<span class='t_title'>当前时间范围:全部时间</span>";
	}
	
	
	//格式化输出数据
	$i=0;
	foreach($areaid as $k1=>$v1){
		$x_title[]="'".$v1."'";
		$productid_tj[] = count_areaid_th($productid,$k1,$search);
		$i++;
	}
	
	//格式化报表数据按产品按人合计
	foreach($productid as $key=>$val){
		if($key==$_GET[prod]){		
			$i=0;
			foreach($productid_tj as $k=>$v){
				$num_arr0[$i+1][] = $productid_tj[$k][$i];
			}
			$i++;
		}
	}
	//格式化
	foreach($productid as $key=>$val){		
		if($key==$_GET[prod]){
			$i=1;		
			$num_arr[] = "var s".$i." = [".implode(",", $num_arr0[$i])."];\n";
			$numname_arr[] = "s".$i ;
			$titlecolor[] = $i.". ".$val."<br\>";
			$i++;
		}
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('prod_name',$productid[$_GET[prod]]);
	$smt->assign('x_title',implode(",", $x_title));
	$smt->assign('titlecolor',implode("<br/>", $titlecolor));
	$smt->assign('num',implode("", $num_arr));
	$smt->assign('numname',implode(",", $numname_arr));
	$smt->assign('postdate',$postdate);
	$smt->assign('title',"维护统计表 [图]");
	$smt->display('report_t2_t.htm');
	exit;
}

//【3】公司统计表	
if($do=="t3"){
	If_rabc($action,$do); //检测权限	//查询
	//判断检索值
	if($_POST['time_start'] && $_POST['time_over']){
		$search = " and `created_at` > '$_POST[time_start] 00:00:00' and `created_at`<  '$_POST[time_over] 23:59:59' ";
	}	
	
	//格式化输出数据
	$i=0;
	foreach($typeid as $k1=>$v1){
		$list[$i][username] = $v1;
		$list[$i][productid_tj] = count_typeid_tt($productid,$k1,$search,"td");
		$i++;
	}
	//sql合计
	$sqltotal ="SELECT sellproduct,sellvol FROM `rv_sell` where 1=1 {$search}";
	$db->query($sqltotal);
	$listtotal=$db->fetchAll();
	//格式化输出数据
	foreach($listtotal as $k=>$v){	
		 $listtotal[sellvol] = explode(",",$listtotal[$k][sellvol]);
		 $listtotal[sellproduct] = explode(",",$listtotal[$k][sellproduct]);
		 foreach($listtotal[sellvol] as $key=>$val){		 
			$selllist[newsellvol][$listtotal[sellproduct][$key]] += $val;
		 }
	}
	foreach($selllist[newsellvol] as $keyt=>$valt){
		$productid_tj_total .= "<td>".$valt."</td>";
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('productid_tj_total',$productid_tj_total);	
	$smt->assign('productid_cn',type_tj_th($productid,"t3t"));
	$smt->assign('postdate_start',$_POST[time_start]);
	$smt->assign('postdate_over',$_POST[time_over]);
	$smt->assign('title',"公司统计表");
	$smt->display('report_t3.htm');
	exit;
}

//【3】公司统计表 [图]
if($do=="t3t"){
	If_rabc($action,$do); //检测权限
	//判断检索值
	if($_GET['time_start'] && $_GET['time_over']){
		$search = " and `created_at` > '$_GET[time_start] 00:00:00' and `created_at`<  '$_GET[time_over] 23:59:59' ";
		$postdate = "<span class='t_title'>当前时间范围: [$_GET[time_start] 00:00:00] 到 [$_GET[time_over] 23:59:59]</span>";
	}else{
		$postdate = "<span class='t_title'>当前时间范围:全部时间</span>";
	}
	
	//格式化输出数据
	$i=0;
	foreach($typeid as $k1=>$v1){
		$x_title[]="'".$v1."'";
		$productid_tj[] = count_typeid_th($productid,$k1,$search);
		$i++;
	}
	
	//格式化报表数据按产品按人合计
	foreach($productid as $key=>$val){			
		if($key==$_GET[prod]){
			$i=0;
			foreach($productid_tj as $k=>$v){
				$num_arr0[$i+1][] = $productid_tj[$k][$i];
			}
			$i++;
		}
	}
	//格式化
	foreach($productid as $key=>$val){				
		if($key==$_GET[prod]){
			$i=1;
			$num_arr[] = "var s".$i." = [".implode(",", $num_arr0[$i])."];\n";
			$numname_arr[] = "s".$i ;
			$titlecolor[] = $i.". ".$val."<br\>";
			$i++;
		}
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('prod_name',$productid[$_GET[prod]]);
	$smt->assign('x_title',implode(",", $x_title));
	$smt->assign('titlecolor',implode("<br/>", $titlecolor));
	$smt->assign('num',implode("", $num_arr));
	$smt->assign('numname',implode(",", $numname_arr));
	$smt->assign('postdate',$postdate);
	$smt->assign('title',"公司统计表 [图]");
	$smt->display('report_t3_t.htm');
	exit;
}



//考勤统计表	
if($do=="t7"){
	If_rabc($action,$do); //检测权限	//查询
	//判断检索值
	if($_POST['time_start'] && $_POST['time_over']){
		$search = " and `created_at` > '$_POST[time_start] 00:00:00' and `created_at`<  '$_POST[time_over] 23:59:59' ";
	}	

	//sql按用户
	$sql ="SELECT id,username,
	(SELECT count(*) FROM `rv_track` as r where u.id= r.salesid {$search}) as num ,
	(SELECT count(*) FROM `rv_track` as r where u.id= r.salesid and status = '1' {$search} ) as numz 
	FROM `rv_user` as u ";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//sql按合计
	$sql ="SELECT count(*)  as num ,
	(SELECT count(*) FROM `rv_track` where status = '1' {$search}) as numz 
	FROM `rv_track` where 1=1 {$search}";
	$db->query($sql);
	$rowtotal=$db->fetchRow();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('attendance_txt',$attendance_txt);	
	$smt->assign('postdate_start',$_POST[time_start]);
	$smt->assign('postdate_over',$_POST[time_over]);
	$smt->assign('rowtotal',$rowtotal);	
	$smt->assign('title',"考勤统计表");
	$smt->display('report_t7.htm');
	exit;
}

//考勤统计表	[图]
if($do=="t7t"){
	If_rabc($action,$do); //检测权限	//查询
	//判断检索值
	if($_GET['time_start'] && $_GET['time_over']){
		$search = " and `created_at` > '$_GET[time_start] 00:00:00' and `created_at`<  '$_GET[time_over] 23:59:59' ";
		$postdate = "<span class='t_title'>当前时间范围: [$_GET[time_start] 00:00:00] 到 [$_GET[time_over] 23:59:59]</span>";
	}else{
		$postdate = "<span class='t_title'>当前时间范围:全部时间</span>";
	}

	//sql按用户
	$sql ="SELECT id,username,
	(SELECT count(*) FROM `rv_track` as r where u.id= r.salesid and status = 1 {$search}) as num 
	FROM `rv_user` as u ";
	$db->query($sql);
	$list=$db->fetchAll();	
	foreach($list as $key=>$val){
		$x_title[]="'".$list[$key][username]."'";
		$num[]=$list[$key][num];
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('num',implode(",", $num));
	$smt->assign('x_title',implode(",", $x_title));
	$smt->assign('postdate',$postdate);
	$smt->assign('rowtotal',$rowtotal);	
	$smt->assign('title',"考勤统计表");
	$smt->display('report_t7_t.htm');
	exit;
}

//考勤轨迹查看	
if($do=="t7tmap"){
	If_rabc($action,$do); //检测权限
	
	//设置允许查询范围
	$tt =  abs(strtotime($_GET['time_over']) - strtotime($_GET['time_start']))/86400;
	if($tt>3 || $tt<0 || $_GET['time_over']=="" || $_GET['time_start']==""){exit("<span style=\"font-size:12px;color:red\">时间范围只允许3日内,请关闭重选...</span>");}
	
	//判断检索范围
	if($_GET['time_start'] && $_GET['time_over']){
		$search = " and `created_at` > '$_GET[time_start] 00:00:00' and `created_at`<  '$_GET[time_over] 23:59:59' ";
		$postdate = "<span class='t_title'>当前时间范围: [$_GET[time_start] 00:00:00] 到 [$_GET[time_over] 23:59:59]</span>";
	}else{
		$postdate = "<span class='t_title'>当前时间范围:全部时间</span>";
	}
	
	//sql按用户
	$sql ="SELECT id,username FROM `rv_user` where id = {$id} limit 1";
	$db->query($sql);
	$rowuser=$db->fetchRow();
	
	//sql按用户
	$sql ="SELECT * FROM `rv_track` where salesid = {$id} {$search} order by id asc";
	$db->query($sql);
	$list=$db->fetchAll();
	$i=1;
	foreach($list as $key=>$val){
		$list[$key][number] = $i;
		$list[$key][number2] = $i+1;
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$i++;
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('postdate',$postdate);
	$smt->assign('numberindex',count($list));
	$smt->assign('username',$rowuser[username]);
	$smt->assign('title',"考勤轨迹查看");
	$smt->display('report_t7_t_map.htm');
	exit;
}

?>