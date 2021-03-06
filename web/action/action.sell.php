<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 


//客户销售统计表查询
function count_info_sl($productid,$infoid,$td){
	global $db;
	//按维护类型查询数量
	$sql="SELECT sellproduct,sellvol FROM `rv_sell` where infoid={$infoid}";
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


//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['salesid']){$search .= " and salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND  `created_at` <  '$_POST[time_over] 23:59:59'";
	}	
	
	//判断如果是维护只显示自己的
	if($_SESSION[roleid]=="3"){$search .= " and salesid = '$_SESSION[userid]'";} //维护
	
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
	$info_num=mysql_query("SELECT * FROM `rv_info` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT * FROM `rv_info` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];		
		$list[$key][productid_tj] = count_info_sl($productid,$list[$key][id],"td");	
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('productid_cn',type_th($productid));
	$smt->assign('salesid_cn',select($user_list,"salesid",$_POST[salesid],"维护选择"));	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"客户列表");
	$smt->display('sell_list.htm');
	exit;	
}



//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_info` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	
	$row[typeid_txt] = $typeid[$row[typeid]];
	$row[areaid_txt] = $areaid[$row[areaid]];
	$row[salesid_txt] = $user_list[$row[salesid]];
	
	foreach($productid as $key=>$val){
		$row[productid_txt].= "<input type=\"text\" name=\"sellproduct[]\" value=\"".$key."\" style=\"display:none;\"/>次数:<input type=\"text\" name=\"sellvol[]\" value=\"0\" style=\"float:none;width:30px\"/> ".$val ."<br/>";
	}

	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"维护");
	$smt->display('sell_new.htm');
	exit;
}


//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$salesid=$_SESSION[userid];
	$post_sellproduct = implode(",",$_POST[sellproduct]);
	$post_sellvol = implode(",",$_POST[sellvol]);
	$created_at=date("Y-m-d H:i:s", time());

	$sql="INSERT INTO `rv_sell` (`infoid` ,`intro`,`sellproduct` ,`sellvol`,`created_at`,`salesid`)
	VALUES ('$_POST[infoid]', '$_POST[intro]','$post_sellproduct','$post_sellvol','$created_at','$salesid');";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}
	exit;
}


?>