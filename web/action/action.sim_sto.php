<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
	//SIM卡资费
	$sql="select zifei from `rv_simzifei`";
	$db->query($sql);
	$zifei_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($zifei_arr as $key=>$val){
		$zifei_list[$zifei_arr[$key][zifei]] = $zifei_arr[$key][zifei];	//车辆状态数组		
	}

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
	if($_POST['tmobile']){$search .= " and tmobile ='$_POST[tmobile]'";}
	if($_POST['simstateId']){$search .= " and simstateId ='$_POST[simstateId]'";}
	if($_POST['inputer']){$search .= " and inputer like '%$_POST[inputer]%'";}
	//判断如果是维护只显示自己的
	//if($_SESSION[roleid]=="3"){$search .= " and salesid = '$_SESSION[userid]'";} //维护
	
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
	$sql="select rv_sim_sto.id,tmobile,cardnum,simstate,zifei,inputer,time from `rv_sim_sto`,`rv_simstate` where simstateId=rv_simstate.id and rv_sim_sto.company1 in ($arr2) $search";
	$info_num=mysql_query($sql);
	$total=mysql_num_rows($info_num);//总条数
	//查询
	$sql="select rv_sim_sto.id,tmobile,cardnum,simstate,zifei,inputer,time,rv_sim_sto.company1 from `rv_sim_sto`,`rv_simstate` where simstateId=rv_simstate.id and rv_sim_sto.company1 in ($arr2) $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('simstateId_cn',select($simstate_list,"simstateId","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('sim_sto_list.htm');
	exit;	
}

//新增sim卡	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('simstateId_cn',select($simstate_list,"simstateId","","请选择"));
	$smt->assign('simzifei_cn',select($zifei_list,"zifei","","请选择"));
	$smt->assign('title',"新增sim卡");
	$smt->display('sim_sto_new.htm');
	exit;
}


//写入SIM卡
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$username=$_SESSION['username'];
	//查找库存中是否存在该SIM卡
	$sql="select * from `rv_sim_sto` where cardnum='$_POST[cardnum]' and company1='$_SESSION[company1]'";
	$aa=mysql_query($sql);
	$as=mysql_num_rows($aa);
	if($as>0){
		echo error("该SIM卡已经存在，请重新录入");
	}else{
		//将数据插入sim卡库存表中
		$sql="INSERT INTO `rv_sim_sto` (`tmobile` ,`cardnum` ,`simstateId`,`zifei`,`time` ,`inputer`,`company1`)
		VALUES ('$_POST[tmobile]','$_POST[cardnum]','$_POST[simstateId]','$_POST[zifei]',now(),'$username','$_SESSION[company1]');";
		$db->query($sql);
		//将数据插入SIM卡统计表rv_cards表中
		$sql="INSERT INTO `rv_cards` (`tmobile` ,`cardnum` ,`simstateId`,`tariff`,`date`,`company1`)
		VALUES ('$_POST[tmobile]','$_POST[cardnum]','$_POST[simstateId]','$_POST[zifei]',date_format(now(),'%Y-%m'),'$_SESSION[company1]');";
		$db->query($sql);
		echo close($msg,"sim_sto");
	}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_sim_sto`");
	//查找删除的SIM卡号
	$sql1="select cardnum from `rv_sim_sto` where id='{$id}'";
	$db->query($sql1);
	$sim_row=$db->fetchRow();
	//删除库存表相应的sim卡号
	$sql2="delete from `rv_sim_sto` where `rv_sim_sto`.`id`='{$id}' limit 1";
	$db->query($sql2);
	//删除sim卡统计表中的SIM卡好
	$sql="delete from `rv_cards` where cardnum='$sim_row[cardnum]' and company1='$_SESSION[company1]'";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}
//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_sim_sto`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_sim_sto` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	$sql="select * from `rv_cards` where cardnum='$row[cardnum]' and company1='$_SESSION[company1]' LIMIT 1";
	$db->query($sql);
	$row1=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('simstateId_cn',select($simstate_list,"simstateId","$row[simstateId]","SIM卡状态"));
	$smt->assign('simzifei_cn',select($zifei_list,"zifei","$row[zifei]","SIM卡资费"));
	$smt->assign('title',"编辑");
	$smt->display('sim_sto_edit.htm');
	exit;
}
//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_sim_sto`");	
	if($_POST[id]){$id=$_POST[id];}
	else{$id=$_SESSION[id];}
	$username=$_SESSION['username'];
	//sql
	$sql="UPDATE `rv_sim_sto` SET 
	`tmobile` = '$_POST[tmobile]',
	`cardnum` = '$_POST[cardnum]',
	`simstateId` = '$_POST[simstateId]',
	`zifei` = '$_POST[zifei]',
	`time`=now(),
	`inputer`='$username'
	WHERE `rv_sim_sto`.`id` ='$_POST[id]' LIMIT 1 ;";	
	$db->query($sql);
	//修改cards表中对应的数据的时间
	$sql3="select * from `rv_cards` where cardnum='$_POST[cardnum]' and company1='$_SESSION[company1]' order by id desc LIMIT 1";
	$db->query($sql3);
	$row3=$db->fetchRow();
	//查询当前时间
	$sql4="select date_format(now(),'%Y-%m') as curdate";
	$db->query($sql4);
	$da_row=$db->fetchRow();
	
	//如果插入的时间与统计表中的时间不同，则插入新数据，相同则更新本条数据
	if($row3[date]==$da_row[curdate]){
		$sql5="UPDATE `rv_cards` set
			`tmobile`='$_POST[tmobile]',
			`cardnum`='$_POST[cardnum]',
			`simstateId`='$_POST[simstateId]',
			`tariff`='$_POST[zifei]'
			where id='$row3[id]'";
			$db->query($sql5);
	}else{
		$sql="INSERT INTO `rv_cards` (`tmobile` ,`cardnum` ,`simstateId`,`tariff`,`date`,`company1`)
			VALUES ('$_POST[tmobile]','$_POST[cardnum]','$_POST[simstateId]','$_POST[zifei]',date_format(now(),'%Y-%m'),'$_SESSION[company1]');";
		$db->query($sql);
	}
	
	//判断卡的资费和状态是否变化   如果变化则更新日期
	if($row3[tariff] != $_POST[zifei]){
		//更新该条数据
		$sql="update `rv_cards` set `tariffdate`=date_format(now(),'%Y-%m-%d') where id='$row3[id]'";
		$db->query($sql);
	}
	if($row3[simstateId] != $_POST[simstateId]){
		//更新该条数据
		$sql="update `rv_cards` set `changedate`=date_format(now(),'%Y-%m-%d') where id='$row3[id]'";
		$db->query($sql);
	}
	echo close($msg,"sim_sto");
	exit;
}
?>