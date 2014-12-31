<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

	//查找每年需交服务费
	$sql="select fuwufei from `rv_fuwufei`";
	$db->query($sql);
	$fuwufei_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($fuwufei_arr as $key=>$val){
		$fuwufei_list[$fuwufei_arr[$key][fuwufei]] = $fuwufei_arr[$key][fuwufei];	//车辆状态数组		
	}
	
 //查询车辆状态
	$sql="SELECT id,carstate FROM `rv_carstate`";
	$db->query($sql);
	$carstate_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($carstate_arr as $key=>$val){
		$carstate_list[$carstate_arr[$key][id]] = $carstate_arr[$key][carstate];	//车辆状态数组		
	}
	
	//查询车辆状态
	$sql="SELECT id,leixing FROM `rv_carleixing`";
	$db->query($sql);
	$carleixing_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($carleixing_arr as $key=>$val){
		$carleixing_list[$carleixing_arr[$key][leixing]] = $carleixing_arr[$key][leixing];	//车辆类型数组		
	}
	
	//查询平台
	$sql="select id,platform from `rv_platform` where company1 in ($arr2)";
	$db->query($sql);
	$platform_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($platform_arr as $key=>$val){
		$platform_list[$platform_arr[$key][platform]] = $platform_arr[$key][platform];	//平台数组		
	}

	//查询公司
	$sql="select company from `rv_company` where company1 in ($arr2)";
	$db->query($sql);
	$com_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($com_arr as $key=>$val){
		$company_list[$com_arr[$key][company]] = $com_arr[$key][company];	//公司数组		
	}
	
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['company']){$search .= " and company like '%$_POST[company]%'";}
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}
	if($_POST['carleixing']){$search .= " and carleixing like '%$_POST[carleixing]%'";}
	if($_POST['carstateId']){$search .= " and carstateId='$_POST[carstateId]'";}
	if($_POST['platform']){$search .= " and platform like '%$_POST[platform]%'";}
	if($_POST['doubledevice']){$search .= " and doubledevice like '%$_POST[doubledevice]%'";}
	if($_POST['zhuanfa']){$search .= " and zhuanfa like '%$_POST[zhuanfa]%'";}
	
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
	
	$sql1="SELECT `rv_car`.*,carstate from `rv_car`,`rv_carstate` where rv_car.company1 in ($arr2) and carstateId=`rv_carstate`.id $search";
	$info_num=mysql_query($sql1);
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT `rv_car`.*,carstate from `rv_car`,`rv_carstate` where rv_car.company1 in ($arr2) and carstateId=`rv_carstate`.id $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('company_cn',select($company_list,"company","","请选择"));
	$smt->assign('carstateId_cn',select($carstate_list,"carstateId","","请选择"));
	$smt->assign('carleixing_cn',select($carleixing_list,"carleixing","","请选择"));
	$smt->assign('platform_cn',select($platform_list,"platform","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('car_list.htm');
	exit;	
}

//新增
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('carstateId_cn',select($carstate_list,"carstateId","","车辆状态"));
	$smt->assign('carleixing_cn',select($carleixing_list,"carleixing","","车辆类型"));
	$smt->assign('platform_cn',select($platform_list,"platform","","选择平台"));
	$smt->assign('fuwufei_cn',select($fuwufei_list,"fuwufei","","请选择"));
	$smt->assign('title',"新增");
	$smt->display('car_new.htm');
	exit;
}


if($do=="add"){
	If_rabc($action,$do); //检测权限
	if($_POST['carNum']){$search .= " and carNum = '$_POST[carNum]'";}
	//if($_POST['chejiaNum']){$search .= " and chejiaNum = '$_POST[chejiaNum]'";}
	$sql="select * from `rv_car` where company1='$_SESSION[company1]' $search";
	$aa=mysql_query($sql);
	$bb=mysql_num_rows($aa);
	if($bb>0){
		echo error_car1($msg);
	}else{
	//判断如果是双设备车辆不限制车牌号位数，否则车牌号必须为8位
	//不是双设备车辆
		if($_POST[doubledevice]=="否"){
			if($_POST[carNum] != null && strlen($_POST[carNum])!=9){
				echo error("车牌号输入错误，请重新输入");
			}else{
				$sql="INSERT INTO `rv_car` (`company`,`carNum`,`chejiaNum`,`platform`,`carleixing`,`carstateId`,`zhengdate`,`xianlu`,`linkname`,`tel`,`fuwufei`,`fenqi`,`doubledevice`,`zhuanfa`,`company1`)
				VALUES ('$_POST[company]','$_POST[carNum]','$_POST[chejiaNum]','$_POST[platform]','$_POST[carleixing]','$_POST[carstateId]','$_POST[zhengdate]','$_POST[xianlu]','$_POST[linkname]','$_POST[tel]','$_POST[fuwufei]','$_POST[fenqi]','$_POST[doubledevice]','$_POST[zhuanfa]','$_SESSION[company1]');";
				$db->query($sql);
				$sql="INSERT INTO `rv_client` (`name`,`carNum`,`chejiaNum`,`platform`,`carleixing`,`carstateId`,`zhengdate`,`xianlu`,`linkname`,`tel`,`fuwufei`,`fenqi`,`doubledevice`,`zhuanfa`,`company1`)
				VALUES ('$_POST[company]','$_POST[carNum]','$_POST[chejiaNum]','$_POST[platform]','$_POST[carleixing]','$_POST[carstateId]','$_POST[zhengdate]','$_POST[xianlu]','$_POST[linkname]','$_POST[tel]','$_POST[fuwufei]','$_POST[fenqi]','$_POST[doubledevice]','$_POST[zhuanfa]','$_SESSION[company1]');";
				if($db->query($sql)){echo close($msg,"car");}else{echo error($msg);}	
			}
		}
		//双设备车辆
		if($_POST[doubledevice]=="是"||$_POST[doubledevice]=="特殊"){
			$sql="INSERT INTO `rv_car` (`company`,`carNum`,`chejiaNum`,`platform`,`carleixing`,`carstateId`,`zhengdate`,`xianlu`,`linkname`,`tel`,`fuwufei`,`fenqi`,`doubledevice`,`zhuanfa`,`company1`)
			VALUES ('$_POST[company]','$_POST[carNum]','$_POST[chejiaNum]','$_POST[platform]','$_POST[carleixing]','$_POST[carstateId]','$_POST[zhengdate]','$_POST[xianlu]','$_POST[linkname]','$_POST[tel]','$_POST[fuwufei]','$_POST[fenqi]','$_POST[doubledevice]','$_POST[zhuanfa]','$_SESSION[company1]');";
			$db->query($sql);
			$sql="INSERT INTO `rv_client` (`name`,`carNum`,`chejiaNum`,`platform`,`carleixing`,`carstateId`,`zhengdate`,`xianlu`,`linkname`,`tel`,`fuwufei`,`fenqi`,`doubledevice`,`zhuanfa`,`company1`)
			VALUES ('$_POST[company]','$_POST[carNum]','$_POST[chejiaNum]','$_POST[platform]','$_POST[carleixing]','$_POST[carstateId]','$_POST[zhengdate]','$_POST[xianlu]','$_POST[linkname]','$_POST[tel]','$_POST[fuwufei]','$_POST[fenqi]','$_POST[doubledevice]','$_POST[zhuanfa]','$_SESSION[company1]');";
			if($db->query($sql)){echo close($msg,"car");}else{echo error($msg);}
		}
		//如果是分期付款则将车辆信息添加到分期付款页面
		if($_POST[fenqi]=="是"){
			$sql1="select id from `rv_car` where carNum='$_POST[carNum]' and company1='$_SESSION[company1]'";
			$db->query($sql1);
			$car_row=$db->fetchRow();
			//如果是分期付款车辆，需将信息添加到rv_fenqicar表中
			$sql2="INSERT INTO `rv_fenqicar` (`carId`,`judge`,`company1`) VALUES ('$car_row[id]',1,'$_SESSION[company1]')";
			$db->query($sql2);
		}
	}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_car`");
	//删除`rv_car`表中的车辆信息
	$sql="delete from `rv_car` where `rv_car`.`id`=$id";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	
	If_comrabc($id,"`rv_car`");
	//查询
	$sql="SELECT * FROM `rv_car` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row); 
	$smt->assign('carstateId_cn',select($carstate_list,"carstateId",$row[carstateId],"车辆状态"));
	//$smt->assign('carleixing_cn',select($carleixing_list,"carleixing",$row[carleixing],"车辆类型"));
	//$smt->assign('carleixing_cn',select1($carleixing_list,"carleixing","","车辆类型"));
	$smt->assign('platform_cn',select($platform_list,"platform",$row[platform],"选择平台"));
	$smt->assign('fuwufei_cn',select($fuwufei_list,"fuwufei",$row[fuwufei],"请选择"));
	$smt->assign('title',"编辑");
	$smt->display('car_edit.htm');
	exit;
}
//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_car`");	
	$sql="UPDATE `rv_car` SET 
	`company` = '$_POST[company]',
	`carNum` = '$_POST[carNum]',
	`chejiaNum` = '$_POST[chejiaNum]',
	`platform` = '$_POST[platform]',
	`carleixing` = '$_POST[carleixing]',
	`carstateId`='$_POST[carstateId]',
	`zhengdate`='$_POST[zhengdate]',
	`xianlu` = '$_POST[xianlu]',
	`linkname` = '$_POST[linkname]',
	`tel` = '$_POST[tel]',
	`fuwufei` = '$_POST[fuwufei]',
	`fenqi` = '$_POST[fenqi]',
	`doubledevice` = '$_POST[doubledevice]',
	`zhuanfa` = '$_POST[zhuanfa]'
	WHERE `rv_car`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){
		/* //查找该车辆的车架号
		$sql="select chejiaNum from `rv_car` where id='$_POST[id]' LIMIT 1";
		$db->query($sql);
		$chejia_row=$db->fetchRow(); */
		$sql="UPDATE `rv_client` SET 
		`name` = '$_POST[company]',
		`carNum` = '$_POST[carNum]',
		`chejiaNum` = '$_POST[chejiaNum]',
		`platform` = '$_POST[platform]',
		`carleixing` = '$_POST[carleixing]',
		`carstateId`='$_POST[carstateId]',
		`zhengdate`='$_POST[zhengdate]',
		`xianlu` = '$_POST[xianlu]',
		`linkname` = '$_POST[linkname]',
		`tel` = '$_POST[tel]',
		`fuwufei` = '$_POST[fuwufei]',
		`fenqi` = '$_POST[fenqi]',
		`doubledevice` = '$_POST[doubledevice]',
		`zhuanfa` = '$_POST[zhuanfa]'
		WHERE company1='$_SESSION[company1]' and carNum ='$_POST[carNum]' LIMIT 1 ;";
		if($db->query($sql)){echo close($msg,"car");}else{echo error($msg);}
	}	
	exit;
}

//编辑	
if($do=="editstop"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_car`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_car` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('carstateId_cn',select($carstate_list,"carstateId",$row[carstateId],"车辆状态"));
	$smt->display('carstop_edit.htm');
	exit;
}

//修改表中停运车辆的日期
if($do=="updatastop"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_car`");
	//更新car表中的数据
	$sql="update `rv_car` set `company`='$_POST[company]',`carstateId`='$_POST[carstateId]',`stopdate`='$_POST[stopdate]',`startdate`='$_POST[startdate]' where id='$_POST[id]' LIMIT 1";
	$db->query($sql);
	//更新client表中的数据 
	$sql1="update `rv_client` set `name`='$_POST[company]',`carstateId`='$_POST[carstateId]' where company1='$_SESSION[company1]' and carNum='$_POST[carNum]'";
	$db->query($sql1);
	$sql="select stopdate,startdate from `rv_car` where id='$_POST[id]'";
	$db->query($sql);
	$date_row=$db->fetchRow(); 
	if($date_row[stopdate]!=0 && $date_row[startdate]==0){
		$sql="update `rv_car` set `judge`=0 where id='$_POST[id]' LIMIT 1";
		$db->query($sql);
	}
	if($date_row[stopdate]!=0 && $date_row[startdate]!=0){
		$sql="update `rv_car` set `judge`=1 where id='$_POST[id]' LIMIT 1";
		$db->query($sql);
	}
	echo close($msg,"car");
	exit;
}

//编辑	
if($do=="editfuwufei"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_car`");
	
	//查询
	$sql="SELECT * FROM `rv_car` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	$smt = new smarty();smarty_cfg($smt);
	//模版
	$smt->assign('row',$row); 
	$smt->assign('fuwufei_cn',select($fuwufei_list,"fuwufei",$row[fuwufei],"请选择"));
	$smt->display('carfuwufei_edit.htm');
	exit;
}


if($do=="updatafuwufei"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_car`");
	$sql="update `rv_car` set `fuwufei`='$_POST[fuwufei]' where id='$_POST[id]' LIMIT 1";
	$db->query($sql);
	$sql="update `rv_client` set `fuwufei`='$_POST[fuwufei]' where company1='$_SESSION[company1]' and carNum ='$_POST[carNum]' LIMIT 1 ";
	if($db->query($sql)){echo close($msg,"car");}else{echo error($msg);}	
	exit;
}

if($do=="sure"){
	If_rabc1($action,$do); //检测权限
	If_comrabc($id,"`rv_car`");
	$sql="select carNum,period_diff(date_format(startdate,'%Y%m'),date_format(stopdate,'%Y%m')) as m from `rv_car` where id='{$id}'";
	$db->query($sql);
	$row=$db->fetchRow();
	$sql="update `rv_client` set `fwjzdate`=date_add(fwjzdate,interval '$row[m]' month) where company1='$_SESSION[company1]' and carNum='$row[carNum]'";
	$db->query($sql);
	$sql="update `rv_car` set `judge`=2 where id='{$id}'";
	$db->query($sql);
	echo success($msg);
	exit;
}

if($do=="edittransfer"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_car`");
	$sql="select id,company,carNum,chejiaNum,linkname,tel from `rv_car` where company1='$_SESSION[company1]' and id='{$id}'";
	$db->query($sql);
	$row=$db->fetchRow();
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row); 
	$smt->display('cartransfer_edit.htm');
	exit;
}

if($do=="updatatransfer"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_car`");
	//查找id对应的车牌号
	$sql1="select company,carNum from `rv_car` where company1='$_SESSION[company1]' and id='$_POST[id]'";
	$db->query($sql1);
	$row=$db->fetchRow();
	//更新车辆表
	$sql2="update `rv_car` set `company`='$_POST[company]',`carNum`='$_POST[carNum]',`chejiaNum`='$_POST[chejiaNum]',`linkname`='$_POST[linkname]',`tel`='$_POST[tel]' where id='$_POST[id]'";
	$db->query($sql2);
	//更新车辆汇总表
	$sql3="update `rv_client` set `name`='$_POST[company]',`carNum`='$_POST[carNum]',`linkname`='$_POST[linkname]',`tel`='$_POST[tel]' where carNum='$row[carNum]' and company1='$_SESSION[company1]'";
	if($db->query($sql3)){echo close($msg,"car");}else{echo error($msg);}	
}

if($do=="search"){
	if($_POST['company']){$search .= " and company like '%$_POST[company]%'";}
	$sql="select * from `rv_company` where company1 in ($arr2) $search order by id asc";
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
	$sql="select * from `rv_company` where company1 in ($arr2) $search order by id asc LIMIT $pageNum,$numPerPage";
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
	$smt->display('company.htm');
	exit;	
}

if($do=="search1"){
	if($_POST['carleixing']){$search .= " and leixing like '%$_POST[carleixing]%'";}
	$sql="SELECT id,leixing FROM `rv_carleixing`";
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
	$sql="SELECT id,leixing FROM `rv_carleixing` where 1=1 $search order by id asc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	/* //格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	} */
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('carleixing.htm');
	exit;	
}

?>