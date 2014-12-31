<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
	function checkbox_insuresort($row_insuresort){
	global $insuresort_cn;	
	$insuresort=explode(',',$row_insuresort);
	$i=1;
	foreach($insuresort_cn as $key=>$val){
		if($key!="0"){
		if(in_array($key,$insuresort)){
		$cbox .="<span style=\"float:left;width:150px\"><input name=\"insuresort[]\" type=\"checkbox\" value=\"$key\" checked=\"checked\" />$val</span>\n";
		}else{
		$cbox .= "<span style=\"float:left;width:150px\"><input name=\"insuresort[]\" type=\"checkbox\" value=\"$key\" />$val</span>\n";
		}
		}
		if($i==8){$cbox .="";}//没有意义
		$i++;
	}
	return $cbox;
}

	$city=$_SESSION[city];
	$sql="select id from `rv_city` where city='$city'";
	$db->query($sql);
	$row=$db->fetchRow();
	$sql="SELECT county FROM `rv_county` where cityId='$row[id]'";
	$db->query($sql);
	$county_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($county_arr as $key=>$val){
		$county_list[$county_arr[$key][county]] = $county_arr[$key][county];	//车辆类型		
	}

//查询
	$sql="SELECT id,paicolor FROM `rv_paicolor`";
	$db->query($sql);
	$paicolor_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($paicolor_arr as $key=>$val){
		$paicolor_list[$paicolor_arr[$key][paicolor]] = $paicolor_arr[$key][paicolor];	//车牌号颜色		
	}
	
	$sql="SELECT id,cartype FROM `rv_cartype`";
	$db->query($sql);
	$cartype_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($cartype_arr as $key=>$val){
		$cartype_list[$cartype_arr[$key][cartype]] = $cartype_arr[$key][cartype];	//车辆类型		
	}
	
	
	$sql="SELECT id,city FROM `rv_city`";
	$db->query($sql);
	$city_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($city_arr as $key=>$val){
		$city_list[$city_arr[$key][city]] = $city_arr[$key][city];	//城市选择		
	}
	
	
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	if($_POST['chejiaNum']){$search .= "and chejiaNum = '$_POST[chejiaNum]'";}
	if($_POST['carNum']){$search .= "and carNum like '%$_POST[carNum]%'";}
	if($_POST['deviceId']){$search .= "and deviceId = '$_POST[deviceId]'";}
	if($_POST['simNum']){$search .= "and simNum = '$_POST[simNum]'";}
	if($_POST['inputer']){$search .= "and inputer like '%$_POST[inputer]%'";}
	if($_POST['owner']){$search .= "and owner = '$_POST[owner]'";}
	if($_POST['lasttime']){$search .= "and lasttime like '%$_POST[lasttime]%'";}
	if($_POST['judge']){$search .= "and judge = '$_POST[judge]'";}
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
	$sql1="SELECT * FROM `rv_record` where company1 in ($arr2) $search";
	$info_num=mysql_query($sql1);//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT `rv_record`.* FROM `rv_record` where rv_record.company1 in ($arr2) $search order by rv_record.id asc LIMIT $pageNum,$numPerPage";	
	$db->query($sql);
	$list=$db->fetchAll();

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('record_list.htm');
	exit;	
}


//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	
	
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('paicolor_cn',select($paicolor_list,"paicolor","","请选择"));
	$smt->assign('cartype_cn',select($cartype_list,"cartype","","请选择"));
	//$smt->assign('buywayId_cn',select1($buyway_list,"buywayId","","请选择"));
	//$smt->assign('city_cn',selecter($city_list,"city","","请选择","w_combox_county","?action=record&do=county_combox&value={value}"));
	$smt->assign('county_cn',select($county_list,"county","","请选择"));
	$smt->assign('checkbox_insuresort',checkbox_insuresort());
	$smt->assign('city',$city);
	$smt->display('record_new.htm');
	exit;
}
if($do=="county_combox"){
	$sql="select id from `rv_city` where city='$value'";
	$db->query($sql);
	$id_row=$db->fetchRow();
	$sql="select id,county from `rv_county` where cityId='$id_row[id]'";
	$result = @mysql_query($sql); 
	echo "[";
	echo '["", "请选择"],';
	while($row = mysql_fetch_assoc($result)){
	echo '["'.$row[county].'", "'.$row[county].'"],';
	}
	echo "]";
    exit;
}

//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$insuresort=implode(',',$_POST[insuresort]);
	//判断这个车辆是否已将存在
	$sql="select * from `rv_record` where carNum='$_POST[carNum]' and company1='$_SESSION[company1]'";
	$aa=mysql_query($sql);
	$as=mysql_num_rows($aa);
	if($as>0){
		echo error("该车辆已存在不能重复添加！");
	}else{
		$sql1="INSERT INTO `rv_record` (`deviceId`,`simNum`,`tranNum`,`city`,`county`,`owner`,`linkman`,`linktel`,`chejiaNum`,`carNum`,`paicolor`,`cartype`,`carbrand`,`carmodel`,`totalweight`,`payload`,`pullweight`,`outlength`,`outwidth`,`outhigh`,`inlength`,`inwidth`,`inhigh`,`zhouNum`,`tiresNum`,`tiresstandard`,`chutime`,`operascope`,`carcolor`,`buyway`,`insuretime`,`checkdue`,`licence`,`insuresort`,`lasttime`,`inputer`,`judge`,`company1` )
		VALUES ('$_POST[deviceId]','$_POST[simNum]','$_POST[tranNum]','$_POST[city]','$_POST[county]','$_POST[owner]','$_POST[linkman]','$_POST[linktel]','$_POST[chejiaNum]','$_POST[carNum]','$_POST[paicolor]','$_POST[cartype]','$_POST[carbrand]','$_POST[carmodel]','$_POST[totalweight]','$_POST[payload]','$_POST[pullweight]','$_POST[outlength]','$_POST[outwidth]','$_POST[outhigh]','$_POST[inlength]','$_POST[inwidth]','$_POST[inhigh]','$_POST[zhouNum]','$_POST[tiresNum]','$_POST[tiresstandard]','$_POST[chutime]','$_POST[operascope]','$_POST[carcolor]','$_POST[buyway]','$_POST[insuretime]','$_POST[checkdue]','$_POST[licence]','$insuresort',now(),'$_SESSION[username]',1,'$_SESSION[company1]');";
		if($db->query($sql1)){
				//查找添加的这条记录的ID
				$sql3="select id from `rv_record` where carNum='$_POST[carNum]' and company1='$_SESSION[company1]' order by id desc LIMIT 1";
				if($db->query($sql3)){
					$id_row=$db->fetchRow();
					$path1 = "D:/OAWEB/";
					$path = "uploads/";//保存到根目录下的uploads文件中
					for($i=1;$i<4;$i++){
						if(!$_FILES["file".$i][name])continue;
						if ((($_FILES["file".$i]["type"] == "image/jpeg")
						|| ($_FILES["file".$i]["type"] == "image/pjpeg"))
						&& ($_FILES["file".$i]["size"] < 2000000)){
							if ($_FILES["file".$i]["error"] > 0){
								echo error($_FILES["file".$i]["error"]);
								exit;
							}else{
								$j=0;
								while(file_exists($path1 . $path . md5($_FILES["file".$i]["name"]).$j)){
									$j++;
								}
								move_uploaded_file($_FILES["file".$i]["tmp_name"],
								$path1 . $path . md5($_FILES["file".$i]["name"]).$j.".jpg");
								$address = $path . md5($_FILES["file".$i]["name"]).$j;
							}
						}else{
							echo error("无效的文件");
							exit;
						}
						$location="location".$i;
						$sql="update `rv_record` set `$location`='$address' where `rv_record`.`id` ='$id_row[id]'";
						$db->query($sql);
					}
					//将数据插入操作日志表中
					$sql2="INSERT INTO `rv_log` (`carNum`,`caozuo`,`date`,`inputer`,`company1`)
					VALUES ('$_POST[carNum]','新增车辆',now(),'$_SESSION[username]','$_SESSION[company1]')";
					if($db->query($sql2)){echo close($msg,"record");}else{echo error($msg);}
				}else{
					echo error($msg);
				}
		}else{
			echo error($msg);
		}	
	}
	exit;
}

if($do=="sure"){
	If_rabc1($action,$do);
	If_comrabc($id,"`rv_record`");
	//更新judge的值为2
	$sql1="update `rv_record` set `judge`=2 where id='{$id}'";
	$db->query($sql1);
	//查找车牌号
	$sql="select carNum from `rv_record` where id='{$id}'";
	$db->query($sql);
	$row=$db->fetchRow();
	//将操作插入到操作日志表中
	$sql2="INSERT INTO `rv_log` (`carNum`,`caozuo`,`date`,`inputer`,`company1`)
	VALUES ('$row[carNum]','审核车辆',now(),'$_SESSION[username]','$_SESSION[company1]')";
	if($db->query($sql2)){echo success($msg);}else{echo error($msg);}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_record`");
	$sql1="select carNum from `rv_record` where id='$id'";
	$db->query($sql1);
	$row1=$db->fetchRow();
	$sql2="INSERT INTO `rv_log` (`carNum`,`caozuo`,`date`,`inputer`,`company1`)
	VALUES ('$row1[carNum]','删除车辆',now(),'$_SESSION[username]','$_SESSION[company1]')";
	$db->query($sql2);
	$sql3="delete from `rv_record` where `id`=$id limit 1";
	if($db->query($sql3)){echo success($msg);}else{echo error($msg);}
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_record`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT rv_record.* FROM `rv_record` where rv_record.id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('paicolor_cn',select($paicolor_list,"paicolor",$row[paicolor],"请选择"));
	$smt->assign('cartype_cn',select($cartype_list,"cartype",$row[cartype],"请选择"));
	//$smt->assign('buywayId_cn',select1($buyway_list,"buywayId",$row[buywayId],"请选择"));
	$smt->assign('city_cn',selecter($city_list,"city",$row[city],"请选择","w_combox_county","?action=record&do=county_combox&value={value}"));
	$smt->assign('checkbox_insuresort',checkbox_insuresort($row[insuresort]));
	$smt->display('record_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_record`");	
	$insuresort=implode(',',$_POST[insuresort]);
	$path1 = "D:/OAWEB/";
	$path = "uploads/";//保存到根目录下的uploads文件中
	for($i=1;$i<4;$i++){
		if(!$_FILES["file".$i]["name"])continue;
		if ((($_FILES["file".$i]["type"] == "image/jpeg")
		|| ($_FILES["file".$i]["type"] == "image/pjpeg"))
		&& ($_FILES["file".$i]["size"] < 2000000)){
			if ($_FILES["file".$i]["error"] > 0){
				echo error($_FILES["file".$i]["error"]);
				exit;
			}else{
				$j=0;
				while(file_exists($path1 . $path . md5($_FILES["file".$i]["name"]).$j)){
					$j++;
				}
				move_uploaded_file($_FILES["file".$i]["tmp_name"],
				$path1 . $path . md5($_FILES["file".$i]["name"]).$j.".jpg");
				$address = $path . md5($_FILES["file".$i]["name"]).$j;
		}
		}else{
			echo error("无效的文件");
			exit;
		}
		$location="location".$i;
		$sql="update `rv_record` set `$location`='$address' where `rv_record`.`id` ='$_POST[id]'";
		$db->query($sql);
	}
	//sql
	$sql="UPDATE `rv_record` SET 
	`deviceId` = '$_POST[deviceId]',
	`simNum` = '$_POST[simNum]',
	`tranNum` = '$_POST[tranNum]',
	`city` = '$_POST[city]',
	`county` = '$_POST[county]',
	`owner` = '$_POST[owner]',
	`linkman` = '$_POST[linkman]',
	`linktel` = '$_POST[linktel]',
	`chejiaNum` = '$_POST[chejiaNum]',
	`carNum` = '$_POST[carNum]',
	`paicolor` = '$_POST[paicolor]',
	`cartype` = '$_POST[cartype]',
	`carbrand` = '$_POST[carbrand]',
	`carmodel` = '$_POST[carmodel]',
	`totalweight` = '$_POST[totalweight]',
	`payload` = '$_POST[payload]',
	`pullweight` = '$_POST[pullweight]',
	`outlength` = '$_POST[outlength]',
	`outwidth` = '$_POST[outwidth]',
	`outhigh` = '$_POST[outhigh]',
	`inlength` = '$_POST[inlength]',
	`inwidth` = '$_POST[inwidth]',
	`inhigh` = '$_POST[inhigh]',
	`zhouNum` = '$_POST[zhouNum]',
	`tiresNum` = '$_POST[tiresNum]',
	`tiresstandard` = '$_POST[tiresstandard]',
	`chutime` = '$_POST[chutime]',
	`operascope` = '$_POST[operascope]',
	`carcolor` = '$_POST[carcolor]',
	`buyway` = '$_POST[buyway]',
	`insuretime` = '$_POST[insuretime]',
	`checkdue` = '$_POST[checkdue]',
	`licence` = '$_POST[licence]',
	`insuresort` = '$insuresort',
	`lasttime`=now(),
	`inputer`='$_SESSION[username]'
	WHERE `rv_record`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"record");}else{echo error($msg);}	
	
	//将相应操作添加到日志表中
	$sql2="INSERT INTO `rv_log` (`carNum`,`caozuo`,`date`,`inputer`,`company1`)
	VALUES ('$_POST[carNum]','修改车辆信息',now(),'$_SESSION[username]','$_SESSION[company1]')";
	$db->query($sql2);
	
	exit;
}

if($do=="show"){
	If_rabc($action,$do); //检测权限	
	$sql="SELECT `rv_record`.* FROM `rv_record` where rv_record.id='{$id}' and rv_record.company1='$_SESSION[company1]' order by rv_record.id asc";	
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('checkbox_insuresort',checkbox_insuresort($row[insuresort]));
	$smt->assign('title',"明细");
	$smt->display('record_show.htm');
	exit;
}
if($do=="location1"){
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('lo',$lo);
	$smt->display('tupian.htm');
	exit;
}
//编辑	
if($do=="editbeizhu"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_record`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT rv_record.* FROM `rv_record` where rv_record.id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->display('record_editbeizhu.htm');
	exit;
}
if($do=="updatabeizhu"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_record`");
	$sql="update `rv_record` set `beizhu`='$_POST[beizhu]' where id='$_POST[id]'";
	if($db->query($sql)){echo close($msg,"record");}else{echo error($msg);}
	exit;	
}
?>