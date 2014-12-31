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
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}
	if($_POST['simNum']){$search .= " and simNum like '%$_POST[simNum]%'";}
	
	
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
	$sql1="SELECT `rv_sim`.*,rv_simstate.simstate,rv_car.carNum,rv_car.chejiaNum from `rv_sim`,`rv_car`,`rv_simstate` where rv_sim.company1 in ($arr2) and rv_sim.simstateId=rv_simstate.id and rv_sim.carId=rv_car.id $search";
	$info_num=mysql_query($sql1);
	$total=mysql_num_rows($info_num);//总条数
	//查询出厂未自带设备
	$sql="SELECT `rv_sim`.*,rv_simstate.simstate,rv_car.carNum,rv_car.chejiaNum from `rv_sim`,`rv_car`,`rv_simstate` where rv_sim.company1 in ($arr2) and rv_sim.simstateId=rv_simstate.id and rv_sim.carId=rv_car.id $search order by rv_sim.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('sim_list.htm');
	exit;	
}

//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('simstateId_cn',select($simstate_list,"simstateId","","请选择"));
	$smt->assign('title',"新增");
	$smt->display('sim_new.htm');
	exit;
}


//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	if($_POST['carNum']){$search .= " and carNum ='$_POST[carNum]'";}
	if($_POST['chejiaNum']){$search .= " and chejiaNum ='$_POST[chejiaNum]'";}
	//查找是否有该车辆
	$sql1="select id from `rv_car` where company1='$_SESSION[company1]' $search";
	$aa=mysql_query($sql1);
	$bb=mysql_num_rows($aa);
	if($bb==1){
		$list_carid=mysql_fetch_assoc($aa);//变量是查询的结果
		$ab=$list_carid[id];
		//查找库存中是否存在输入的sim卡号
		$sql2="select * from `rv_sim_sto` where cardnum='$_POST[simNum]' and company1='$_SESSION[company1]'";
		$r=mysql_query($sql2);
		$q=mysql_num_rows($r);
		$db->query($sql2);
		$sto_row=$db->fetchRow();
		if($q==1){
			$list_sim=mysql_fetch_assoc($r);
			$tmobile=$list_sim[tmobile];
			//库存中有该sim卡，先删除库存中的sim卡
			$sql3="delete from `rv_sim_sto` where cardnum='$_POST[simNum]' and company1='$_SESSION[company1]'";
			$db->query($sql3);
			//将数据插入`rv_sim`表中
			$sql4="INSERT INTO `rv_sim` (`carId`,`simNum`,`zifei`,`simstateId`,`beizhu`,`company1`)
			VALUES ('$ab','$_POST[simNum]','$sto_row[zifei]','$sto_row[simstateId]','$_POST[beizhu]','$_SESSION[company1]');";
			$db->query($sql4);
			//查找SIM卡状态ID对应的状态
			$sql5="select simstate from `rv_simstate` where id='$sto_row[simstateId]' and company1='$_SESSION[company1]'";
			$db->query($sql5);
			$state_row=$db->fetchRow();
			//将新增的数据插入`rv_client`表中
			$sql7="update `rv_client` set `simNum`='$_POST[simNum]',`zifei`='$sto_row[zifei]',`simstate`='$state_row[simstate]' where company1='$_SESSION[company1]' $search";
			if($db->query($sql7)){echo close($msg,"sim");}else{echo error($msg);}
		}else{
			echo error("sim卡输入错误，库存中不存在该sim卡");
		}
		
	}else{
		echo error_car($msg);
	}
	exit;
}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_sim`");
	$sql="delete from `rv_sim` where `rv_sim`.`id`=$id";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_sim`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_sim` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	$sql="select * from `rv_cards` where cardnum='$row[simNum]' and company1='$_SESSION[company1]' LIMIT 1";
	$db->query($sql);
	$row1=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('row1',$row1);
	$smt->assign('simstateId_cn',select($simstate_list,"simstateId","$row[simstateId]","SIM卡状态"));
	$smt->assign('simzifei_cn',select($zifei_list,"zifei","$row[zifei]","SIM卡资费"));
	$smt->assign('title',"编辑");
	$smt->display('sim_edit.htm');
	exit;
}
//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_sim`");	
	if($_POST[id]){$id=$_POST[id];}
	else{$id=$_SESSION[id];}

	//查找SIM卡状态ID对应的状态
	$sql1="select simstate from `rv_simstate` where id='$_POST[simstateId]' and company1='$_SESSION[company1]'";
	$db->query($sql1);
	$state_row=$db->fetchRow();
	//查找选中的sim卡号
	$sql2="select * from `rv_sim` where id='$_POST[id]'";
	$db->query($sql2);
	$sim_row=$db->fetchRow();
	//选中的sim卡号和之前的不一样，删除库存表中选中的sim卡，并向库存中添加被修改的sim卡
	if($sim_row[simNum] != $_POST[simNum]){
		//删除sim_sto表中的sim卡
		$sql3="delete from `rv_sim_sto` where cardnum='$_POST[simNum]' and company1='$_SESSION[company1]'";
		$db->query($sql3);
		/* //从cards统计表中查找卡的相关信息
		$sql="select * from `rv_cards` where cardnum='$sim_row[simNum]' and company1='$_SESSION[company1]' LIMIT 1";
		$db->query($sql);
		$card_row=$db->fetchRow();
		//将被修改的sim卡号添加到sim卡库存表中
		$sql="INSERT INTO `rv_sim_sto` (`tmobile`,`cardnum`,`simstateId`,`zifei`,`time`,`inputer`,`company1`)
		VALUES('$card_row[tmobile]','$card_row[cardnum]','$card_row[simstateId]','$card_row[tariff]',now(),'$_SESSION[username]','$_SESSION[company1]')";
		$db->query($sql); */
	}
	//sql
	$sql="UPDATE `rv_sim` SET 
	`simNum` = '$_POST[simNum]',
	`zifei` = '$_POST[zifei]',
	`zichangedate` = '$_POST[zichangedate]',
	`simstateId` = '$_POST[simstateId]',
	`changedate`='$_POST[changedate]',
	`beizhu`='$_POST[beizhu]'
	WHERE `rv_sim`.`id` ='$_POST[id]' LIMIT 1 ;";	
	$db->query($sql);
	//修改cards表中对应的数据的时间
	$sql3="select * from `rv_cards` where cardnum='$_POST[simNum]' and company1='$_SESSION[company1]'";
	$db->query($sql3);
	$row3=$db->fetchRow();
	//查询当前时间
	$sql4="select date_format(now(),'%Y-%m') as curdate";
	$db->query($sql4);
	$da_row=$db->fetchRow();
	//如果插入的时间与统计表中的时间不同，则插入新数据，相同则更新本条数据
	if($row3[date]==$da_row[curdate]){
		$sql5="UPDATE `rv_cards` set
			`tariff`='$_POST[zifei]',
			`tariffdate`='$_POST[zichangedate]',
			`simstateId`='$_POST[simstateId]',
			`changedate`='$_POST[changedate]',
			`imei`='$_POST[imei]',
			`beizhu`='$_POST[beizhu]'
			where `cardnum`='$_POST[simNum]' and company1='$_SESSION[company1]'";
			$db->query($sql5);
	}else{
		//查询运营商
			$sql2="select * from `rv_sim_sto` where cardnum='$_POST[simNum]' and company1='$_SESSION[company1]'";
			$db->query($sql2);
			$row2=$db->fetchRow();
			$sql6="INSERT INTO `rv_cards` (`cardnum`,`tmobile`,`tariff`,`tariffdate`,`simstateId`,`changedate`,`imei`,`beizhu`,`date`,`company1`)
			values ('$_POST[simNum]','$row2[tmobile]','$_POST[zifei]','$_POST[zichangedate]','$_POST[simstateId]','$_POST[changedate]','$_POST[imei]','$_POST[beizhu]',date_format(now(),'%Y-%m'),'$_SESSION[company1]')";
			$db->query($sql6);
	}

	//搜索出选中数据对应的车牌号和车架号
	$sql="SELECT carNum,chejiaNum FROM `rv_sim`,`rv_car` where rv_sim.company1='$_SESSION[company1]' and rv_sim.id='$_POST[id]' and carId=rv_car.id LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	$sql="UPDATE `rv_client` SET 
	`simNum` = '$_POST[simNum]',
	`zifei` = '$_POST[zifei]',
	`zichangedate` = '$_POST[zichangedate]',
	`simstate` = '$state_row[simstate]',
	`changedate`='$_POST[changedate]'
	WHERE company1='$_SESSION[company1]' and (`carNum`='$row[carNum]' and `chejiaNum`='$row[chejiaNum]');";	
	if($db->query($sql)){echo close($msg,"sim");}else{echo error($msg);}	
	exit;
}

if($do=="search"){
	if($_POST['simNum']){$search .= " and cardnum like '%$_POST[simNum]%'";}
	$sql="select rv_sim_sto.*,simstate from `rv_sim_sto`,`rv_simstate` where simstateId=rv_simstate.id and rv_sim_sto.company1='$_SESSION[company1]' $search order by cardnum asc";
	$info_num=mysql_query($sql);
	$total=mysql_num_rows($info_num);//总条数
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
	$sql="select rv_sim_sto.*,simstate from `rv_sim_sto`,`rv_simstate` where simstateId=rv_simstate.id and rv_sim_sto.company1='$_SESSION[company1]' $search order by cardnum asc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('sim.htm');
	exit;	
}

?>