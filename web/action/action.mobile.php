<?php
if(!defined('CORE'))exit("error!"); 

//类型数组
function select2($arr,$name,$self="",$cn_name="选择"){	
	$slt .= "    <option value=\"0\" selected=\"selected\">".$cn_name."</option>";
	foreach($arr as $key=>$val){
		if($key==$self){
		$slt .= "    <option value=\"".$key."\" selected=\"selected\">".$val."</option>";
		}else{
		$slt .= "    <option value=\"".$key."\">".$val."</option>";
		}
	}
	return $slt;
}

//区域数组
function select3($arr,$name,$self="",$cn_name="选择",$user_areaid){	
	$slt .= "    <option value=\"0\" selected=\"selected\">".$cn_name."</option>";
	foreach($arr as $key=>$val){
		if(in_array($key,$user_areaid)){
			if($key==$self){
			$slt .= "    <option value=\"".$key."\" selected=\"selected\">".$val."</option>";
			}else{
			$slt .= "    <option value=\"".$key."\">".$val."</option>";
			}
		}
	}
	return $slt;
}

	
//客户列表
if($do=="list"){
	
	if($_GET['name']){$search .= " and name like '%$_GET[name]%'";}	
	if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}
	
	//设置分页
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_info` where 1=1 and salesid = '{$cuserid}'");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数		
	
	//查询
	$sql="SELECT * FROM `rv_info` where 1=1 and salesid = '{$cuserid}' {$search} order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//echo $sql;
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][typeid_txt] = $typeid[$list[$key][typeid]];
		$list[$key][areaid_txt] = $areaid[$list[$key][areaid]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
	}

	$jsondata = my_json_encode($list);	
	exit($_GET['callback']."(".$jsondata.")");
}

//新建	
if($do=="new"){
	
	//查询
	$sql="SELECT areaid FROM `rv_user` where id = '{$cuserid}'";
	$db->query($sql);
	$row_areaid=$db->fetchRow();
	$user_areaid=explode(',',$row_areaid[areaid]);
	
	$typeid_cn= select2($typeid,"typeid","","类型选择");
	$areaid_cn= select3($areaid,"areaid","","地区选择",$user_areaid);
	
	$jsondata="{typeid_cn:'".$typeid_cn."',areaid_cn:'".$areaid_cn."'}";
	exit($_GET['callback']."(".$jsondata.")");
}

//写入客户
if($do=="add"){

	//查询
	$sql="SELECT id FROM `rv_info` where name = '{$_GET[name]}'";
	$db->query($sql);
	$row=$db->fetchRow();
	if($row[id]){
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
	
	//判断必填
	if($_GET[name]=="" || $_GET[address]=="" || $_GET[tel]=="" || $_GET[linkman]=="" || $_GET[areaid]=="0" || $_GET[typeid]=="0" || $cuserid=="" ){		
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
	
	$sql="INSERT INTO `rv_info` (`name` ,`address`,`linkman`,`tel`,`longitude`,`latitude`,`location`,`areaid`,`salesid`,`typeid`,`intro`)
	VALUES ('$_GET[name]', '$_GET[address]', '$_GET[linkman]','$_GET[tel]','$_GET[longitude]','$_GET[latitude]','$_GET[location]','$_GET[areaid]','{$cuserid}','$_GET[typeid]','$_GET[intro]');";
	if($db->query($sql)){
		$jsondata='{state:"yes"}';
		exit($_GET['callback']."(".$jsondata.")");
	}else{
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
}


//编辑	
if($do=="edit"){

	//查询
	$sql="SELECT areaid FROM `rv_user` where id = '{$cuserid}'";
	$db->query($sql);
	$row_areaid=$db->fetchRow();
	$user_areaid=explode(',',$row_areaid[areaid]);
	
	//查询
	$sql="SELECT * FROM `rv_info` where id='{$id}' and salesid = '{$cuserid}' LIMIT 1";	
	if($db->query($sql)){	

		$row=$db->fetchRow();
		$row[typeid_cn] = select2($typeid,"typeid",$row[typeid],"类型选择");
		$row[areaid_cn] = select3($areaid,"areaid",$row[areaid],"地区选择",$user_areaid);		
		$jsondata=my_json_encode($row);	
		exit($_GET['callback']."(".$jsondata.")");
		
	}else{		
		exit($_GET['callback']."({state:\"no\"})");
	}
	exit;
}

//更新
if($do=="updata"){	
	
	if($id=="" || $cuserid==""){
		exit($_GET['callback']."({state:\"no\"})");
	}

	$updated_at=date("Y-m-d H:i:s", time());
	
	$sql="UPDATE `rv_info` SET 
	`name` = '{$_GET[name]}',
	`areaid` = '{$_GET[areaid]}',
	`typeid` = '{$_GET[typeid]}',
	`address` = '{$_GET[address]}',
	`linkman` = '{$_GET[linkman]}',
	`tel` = '{$_GET[tel]}',
	`longitude` = '{$_GET[longitude]}',
	`latitude` = '{$_GET[latitude]}',
	`location` = '{$_GET[location]}',
	`intro` = '{$_GET[intro]}',
	`updated_at` = '{$updated_at}' WHERE `rv_info`.`id` ='{$_GET[id]}' LIMIT 1 ;";
	
	if($db->query($sql)){
		$jsondata='{state:"yes"}';
		exit($_GET['callback']."(".$jsondata.")");
	}else{		
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
	exit;
}

//拜访	
if($do=="visit"){
	//查询
	$sql="SELECT * FROM `rv_info` where id='{$id}' and salesid = '{$cuserid}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
			
	foreach($productid as $key=>$val){		
		$row[productid_txt].= "<input type=\"text\" name=\"sellproduct[]\" value=\"".$key."\" style=\"display:none;\"/> 
		<span><label>".$val."</label><input name=\"sellvol[]\" type=\"text\" class=\"khinrt\" id=\"textfield\" value=\"0\"></span>";
	}
	
	//查询
	$sql="SELECT * FROM `rv_sell` where infoid='{$id}' and salesid = '{$cuserid}' LIMIT 5";
	$db->query($sql);
	$list=$db->fetchAll();
	
	$listx[pro_list] = $row;
	$listx[sell_list] = $list;
	$jsondata = my_json_encode($listx);	
	echo $_GET['callback']."(".$jsondata.")";
	exit;
}

	  
//拜访写入
if($do=="visitadd"){
	$post_sellproduct = implode(",",$_GET[sellproduct]);
	$post_sellvol = implode(",",$_GET[sellvol]);
	$created_at=date("Y-m-d H:i:s", time());
	
	//判断必填
	if($_GET[infoid]=="" || $_GET[intro]==""  ){		
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
	
	//上传	
	if($_FILES["file"]["name"]!=""){
		$filename= md5(time().rand(0,9).$_FILES["file"]["name"]).".jpg";
		move_uploaded_file($_FILES["file"]["tmp_name"],"uploadfile/".$filename);
		$resizeimage = new resizeimage("uploadfile/".$filename, "137", "123", "1","uploadfile/"."m_".$filename);
	}
	
	$sql="INSERT INTO `rv_sell` (`infoid` ,`intro`,`sellproduct` ,`sellvol`,`filename`,`created_at`,`salesid`)
	VALUES ('{$_GET[infoid]}', '{$_GET[intro]}','{$post_sellproduct}','{$post_sellvol}','{$filename}','{$created_at}','{$cuserid}');";
	if($db->query($sql)){		
		$jsondata='{state:"yes"}';
		exit($_GET['callback']."(".$jsondata.")");
	}else{
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
}



//公告文档	
if($do=="doc"){

	if($_GET['title']){$search .= " and title like '%$_GET[title]%'";}	
	if($_GET['doctid']){$search .= " and doctid = '$_GET[doctid]'";}	
	if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}
	

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_doc` where 1=1 {$search}");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//查询
	$sql="SELECT * FROM `rv_doc` where 1=1 {$search} order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//echo $sql;
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][doctid_txt] = $doctid[$list[$key][doctid]];
	}
	
	$jsondata = my_json_encode($list);	
	exit($_GET['callback']."(".$jsondata.")");
	
}


//文档展示	
if($do=="docshow"){
	//查询
	$sql="SELECT * FROM `rv_doc` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	
	$row[doctid_txt] = $doctid[$row[doctid]];
	
	$jsondata = my_json_encode($row);	
	exit($_GET['callback']."(".$jsondata.")");
}


//信息反馈	
if($do=="note"){

	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="10";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_note` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//查询
	$sql="SELECT * FROM `rv_note` where 1=1 and sendid = '{$cuserid}' or open = 1 order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//echo $sql;
	//格式化输出数据
	foreach($list as $key=>$val){	
		$list[$key][sendid_txt] = $user_list[$list[$key][sendid]];		
	}
	
	$jsondata = my_json_encode($list);	
	exit($_GET['callback']."(".$jsondata.")");
	
}

//上传打卡考勤
if($do=="noteadd"){

	if( $_GET[intro]=="" || $cuserid=="" ){		
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
	
	$created_at=date("Y-m-d H:i:s", time());
	$sql="INSERT INTO `rv_note` (`sendid`,`collectid`,`open` ,`intro` ,`created_at`)
	VALUES ('{$cuserid}', '1', '{$_GET[open]}', '{$_GET[intro]}',  '$created_at');";	
	if($db->query($sql)){
		$jsondata='{state:"yes"}';
		exit($_GET['callback']."(".$jsondata.")");
	}else{
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
}

//电话本列表
if($do=="tel"){

	if($_GET['name']){$search .= " and name like '%$_GET[name]%'";}
	if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_tel` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	//查询
	$sql="SELECT * FROM `rv_tel` where 1=1 {$search} order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	$jsondata = my_json_encode($list);	
	exit($_GET['callback']."(".$jsondata.")");
	
}


//上传打卡考勤
if($do=="clockin"){	
	$created_at=date("Y-m-d H:i:s", time());
	$created_at_time = time();
	$current_day=date("Y-m-d", time());

	if( $_GET[longitude]=="" ||  $_GET[latitude]=="" ||  $_GET[location]=="" || $cuserid=="" ){		
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	} 
	
	$attendance_a_1 = strtotime($current_day." 00:00:00");
	$attendance_a_2 = strtotime($current_day." 09:00:00");
	$attendance_b_1 = strtotime($current_day." 11:00:00");
	$attendance_b_2 = strtotime($current_day." 13:00:00");
	$attendance_c_1 = strtotime($current_day." 18:00:00");
	$attendance_c_2 = strtotime($current_day." 23:59:59");
	if(($created_at_time>$attendance_a_1 && $created_at_time<$attendance_a_2)){
		$current_clockin = true;		
		$sql="SELECT count(*) AS c FROM `rv_track` WHERE `created_at` BETWEEN '{$current_day} 00:00:00' AND '{$current_day} 09:00:00' ";	
		$db->query($sql);	
		$row=$db->fetchRow();
	}elseif(($created_at_time>$attendance_b_1 && $created_at_time<$attendance_b_2)){
		$current_clockin = true;		
		$sql="SELECT count(*) AS c FROM `rv_track` WHERE `created_at` BETWEEN '{$current_day} 11:00:00' AND '{$current_day} 13:00:00' ";
		$db->query($sql);	
		$row=$db->fetchRow();
	}elseif(($created_at_time>$attendance_c_1 && $created_at_time<$attendance_c_2)){
		$current_clockin = true;
		$sql="SELECT count(*) AS c FROM `rv_track` WHERE `created_at` BETWEEN '{$current_day} 18:00:00'AND '{$current_day} 23:59:59'";
		$db->query($sql);	
		$row=$db->fetchRow();
	}else{}
	
	if(!$row[c] && $current_clockin){
		$status = "1";
	}
	
	$sql="INSERT INTO `rv_track` (`longitude`,`latitude`,`location`,`salesid` ,`status`,`created_at`)
	VALUES ( '{$_GET[longitude]}','{$_GET[latitude]}','{$_GET[location]}','{$cuserid}','{$status}', '{$created_at}');";	
	if($db->query($sql)){
		$jsondata='{state:"yes"}';
		exit($_GET['callback']."(".$jsondata.")");
	}else{
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
}

//读取打卡考勤记录	
if($do=="clockinlist"){
	if($cuserid){
		//查询问题
		$sql="SELECT * FROM `rv_track` where salesid = '{$cuserid}' order by created_at desc LIMIT 5";
		$db->query($sql);
		$list=$db->fetchAll();
		
		$listx[lbs] = $list; 		
		$listx[attendance_txt] = $attendance_txt;
		//考勤注释:
		$jsondata = my_json_encode($listx);	
		exit($_GET['callback']."(".$jsondata.")");
	}	
}


//验证登录
if($do=="loginok"){

	$name=$_GET[user];
	$pwd=$_GET[pass];	
	
	$sql = "SELECT id,username,roleid from rv_user WHERE username = '$name' AND password = md5('$pwd') limit 1";
	$db->query($sql);
	if ($record = $db->fetchRow()){	//登录成功
		$_SESSION['isLogin'] 	= true;
		$_SESSION['userid']		= $record['id'];
		$_SESSION['username']	= $record['username'];
		$_SESSION['roleid']	= $record['roleid'];
		$jsondata='{gourl:"index_list.html",state:"yes",session_IsLogin:"true",session_userid:"'.$record['id'].'",session_username:"'.$record['username'].'"}';
		exit($_GET['callback']."(".$jsondata.")");
		exit();
	}else{
		$jsondata='{gourl:"index.html",state:"no",session_IsLogin:"false"}';
		exit($_GET['callback']."(".$jsondata.")");
		exit();
	}
}

//读取照片记录	
if($do=="photolist"){
	if($cuserid){		
		if($_GET['intro']){$search .= " and intro like '%$_GET[intro]%'";}		
	
		//查询问题
		$sql="SELECT * FROM `rv_photo` where salesid = '{$cuserid}' {$search} order by id desc LIMIT 2";
		$db->query($sql);
		$list=$db->fetchAll();
			
		//格式化输出数据
		foreach($list as $key=>$val){
			$list[$key][intro] = urldecode($list[$key][intro]);
		}
	
		//考勤注释:
		$jsondata = my_json_encode($list);	
		exit($_GET['callback']."(".$jsondata.")");
	}	
}


//上传图片
if($do=="upphoto"){
	if($_GET[userid]!=""){
		$salesid=intval($_GET[userid]);	
		$intro=strip_tags($_GET[intro]);	
	}else{
		exit("userid error!");	
	}
	
	$filename= md5(time().rand(0,9).$_FILES["file"]["name"]).".jpg";
	move_uploaded_file($_FILES["file"]["tmp_name"],"uploadfile/".$filename);	
	if($_FILES["file"]["size"]>"10240"){	
		$resizeimage = new resizeimage("uploadfile/".$filename, "137", "123", "1","uploadfile/"."m_".$filename);
	}else{	
		$resizeimage = new resizeimage("uploadfile/".$filename, "137", "123", "1","uploadfile/"."m_".$filename);
	}
	
	$created_at=date("Y-m-d h:i:s");
	$sql = "INSERT INTO `rv_photo` (`salesid`,`filename`,`intro`,`created_at` ) VALUES ( '$salesid','$filename','$intro','$created_at');";
	if (!$db->query($sql)){		
		$jsondata='{state:"yes",filename:"m_'.$filename.'"}';
		exit($_GET['callback']."(".$jsondata.")");
	}else{
		$jsondata='{state:"no"}';
		exit($_GET['callback']."(".$jsondata.")");
	}
}


?>
