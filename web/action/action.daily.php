<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " and i.name like '%$_POST[name]%'";}	
	if($_POST['salesid']){$search .= " and s.salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND  `created_at` <  '$_POST[time_over] 23:59:59'";
	}
	else if($_POST['time_start']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND `created_at` <  '$_POST[time_start] 23:59:59'";
	}
	else if($_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_over] 00:00:00' AND `created_at` <  '$_POST[time_over] 23:59:59'";
	}
	
	//判断如果是销售只显示自己的
	if($_SESSION[roleid]=="3"){$search .= " and s.salesid = '$_SESSION[userid]'";} //销售
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_sell` as s,`rv_info` as i where s.infoid = i.id $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT i.name,s.id,s.salesid,s.sellproduct,s.sellvol,s.filename,s.intro,s.created_at FROM `rv_sell` as s,`rv_info` as i where s.infoid = i.id  $search order by s.id desc LIMIT $pageNum,$numPerPage";
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
		$list[$key][typeid_txt] = $typeid[$list[$key][typeid]];
		$list[$key][areaid_txt] = $areaid[$list[$key][areaid]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$list_sellproduct = explode(",",$list[$key][sellproduct]);
		$list_sellvol = explode(",",$list[$key][sellvol]);
		foreach($list_sellproduct as $k=>$v){
			$list[$key][sellproduct_txt] .= $productid[$v]."<span style='color:red'>(".$list_sellvol[$k].")</span>　";
		}
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('salesid_cn',select($user_list,"salesid","","销售选择"));	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"列表");
	$smt->display('daily_list.htm');
	exit;
	
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	//查询
	$sql="SELECT i.name,s.id,s.salesid,s.sellproduct,s.sellvol,s.intro,s.created_at FROM `rv_sell` as s,`rv_info` as i where s.infoid = i.id  and s.id = {$id} order by s.id desc LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	
	$row_sellproduct = explode(",",$row[sellproduct]);
	$row_sellvol = explode(",",$row[sellvol]);
	foreach($row_sellproduct as $k=>$v){
		$pro_arr[$v] = $row_sellvol[$k];
	}
	
	foreach($productid as $key=>$val){
		$row[productid_txt].= "<input type=\"text\" name=\"sellproduct[]\" value=\"".$key."\" style=\"display:none;\"/>数量:<input type=\"text\" name=\"sellvol[]\" value=\"".$pro_arr[$key]."\" style=\"float:none;width:30px\"/> ".$val ."<br/>";
	}

	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"销售");
	$smt->display('daily_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	//dump($_POST);	
	$updated_at=date("Y-m-d H:i:s", time());
	$post_sellproduct = implode(",",$_POST[sellproduct]);
	$post_sellvol = implode(",",$_POST[sellvol]);
	
	//sql
	$sql="UPDATE `rv_sell` SET 
	`sellproduct` = '$post_sellproduct',
	`sellvol` = '$post_sellvol',
	`intro` = '$_POST[intro]',
	`updated_at` = '$updated_at' WHERE `rv_sell`.`id` ='$_POST[id]' LIMIT 1 ;";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}	
	exit;
}



//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `rv_sell` where `rv_sell`.`id`={$id} limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}
?>