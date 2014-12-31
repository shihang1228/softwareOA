<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
$sql="select id,simstate from `rv_simstate`";
	$db->query($sql);
	$simstate_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($simstate_arr as $key=>$val){
		$simstate_list[$simstate_arr[$key][id]] = $simstate_arr[$key][simstate];	//sim卡状态数组		
	}
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['tmobile']){$search .= " and tmobile = '$_POST[tmobile]'";}
	if($_POST['cardnum']){$search .= " and cardnum = '$_POST[cardnum]'";}
	if($_POST['simstateId']){$search .= " and simstateId = '$_POST[simstateId]'";}
	if($_POST['tariff']){$search .= " and tariff='$_POST[tariff]'";}
	if($_POST['date']){$search .= " and date = '$_POST[date]'";}
	//查询当前月份
	$sql="select date_format(now(),'%Y-%m') as da";
	$db->query($sql);
	$da_row=$db->fetchRow();
	if($_POST['date']){$date=$_POST[date];}else {$date=$da_row[da];}
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
	//查询
	$sql1="SELECT rv_cards.*,simstate FROM `rv_cards`,`rv_simstate` where simstateId=rv_simstate.id and rv_cards.company1 in ($arr2) $search";
	$info_num=mysql_query($sql1);//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	$sql="SELECT rv_cards.*,simstate FROM `rv_cards`,`rv_simstate` where simstateId=rv_simstate.id and rv_cards.company1 in ($arr2) $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('date',$date);	
	$smt->assign('state_cn',select($simstate_list,"simstateId","","请选择"));
	$smt->assign('tariff_cn',select($cards_tariff_list,"tariff","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('cards_list.htm');
	exit;	
}

//新增
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('cards_new.htm');
	exit;
}

//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$id=$_SESSION[id];
	$sql="INSERT INTO `rv_cards` (`tmobile`,`cardnum`,`state`,`changedate`,`imei`,`tariff`,`beizhu`,`company1`)
	VALUES ('$_POST[tmobile]','$_POST[cardnum]','$_POST[state]','$_POST[changedate]','$_POST[imei]','$_POST[tariff]','$_POST[beizhu]','$_SESSION[company1]');";
	if($db->query($sql)){echo close($msg,"cards");}else{echo error($msg);}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_cards`");
	$sql="delete from `rv_cards` where `rv_cards`.`id`=$id limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_cards`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_cards` where id='{$id}'";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('state_cn',select($simstate_list,"simstateId",$row[simstateId],"请选择"));
	$smt->assign('title',"编辑");
	$smt->display('cards_edit.htm');
	exit;
}
//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限	
	If_comrabc($_POST[id],"`rv_cards`");
	//sql
	$sql="UPDATE `rv_cards` SET 
	`tmobile` = '$_POST[tmobile]',
	`cardnum` = '$_POST[cardnum]',
	`simstateId` = '$_POST[simstateId]',
	`changedate` = '$_POST[changedate]',
	`imei` = '$_POST[imei]',
	`tariff` = '$_POST[tariff]',
	`beizhu` = '$_POST[beizhu]'
	WHERE id ='$_POST[id]';";	
	if($db->query($sql)){echo close($msg,"cards");}else{echo error($msg);}	
	exit;
}


if($do=="print"){
	If_rabc($action,$do); //检测权限	
	$sql="SELECT rv_cards.*,simstate FROM `rv_cards`,`rv_simstate` where simstateId=rv_simstate.id and date='$date' and rv_cards.company1='$_SESSION[company1]' order by id desc";
	$db->query($sql);
	$list=$db->fetchAll();
	header("Content-Type: application/vnd.ms-excel;charset=utf-8");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk","SIM卡统计表").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th width='50'>ID</th>";
	echo "<th width='120'>运营商</th>";
	echo "<th width='120'>卡号</th>";
	echo "<th width='100'>卡状态</th>";
	echo "<th width='150'>卡状态变更日期</th>";
	echo "<th width='150'>串号</th>";
	echo "<th width='80'>资费</th>";
	echo "<th width='150'>资费变更日期</th>";
	echo "<th width='150'>备注</th>";
	echo "</tr>";
	echo "<tr align=center>";
	foreach($list as $key=>$val){
		echo "<td>".$val[id]."</td>";
		echo "<td>".$val[tmobile]."</td>";
		echo "<td>".$val[cardnum]."</td>";
		echo "<td>".$val[simstate]."</td>";
		if($val[changedate]!=0){echo "<td>".$val[changedate]."</td>";}else{echo "<td></td>";}
		if($val[imei]!=0){echo "<td>".$val[imei]."</td>";}else{echo "<td></td>";}
		echo "<td>".$val[tariff]."</td>";
		if($val[tariffdate]){echo "<td>".$val[tariffdate]."</td>";}else{echo "<td></td>";}
		echo "<td>".$val[beizhu]."</td>";
		echo "</tr>";
		echo "<tr align=center>";
	}
	echo "</tr>";
	echo "</table>";
	//结束函数并返回true  
	return (true);
}


?>