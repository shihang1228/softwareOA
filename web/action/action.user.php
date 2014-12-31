<?php
if(!defined('CORE'))exit("error!"); 

//类型
$sql_tt="SELECT id,title,type FROM `rv_type` order by id asc ";
$db->query($sql_tt);
$type_cut=$db->fetchAll();
foreach ($type_cut as $key => $val) {
        $type_cut[$val[type]][$val[id]] = $val[title];
        unset($type_cut[$key]);
}

$typeid=$type_cut[typeid];
$productid=$type_cut[productid];
$doctid=$type_cut[doctid];


//验证登录
if($do=="loginok"){
	$name=$_POST[username];
	$pwd=$_POST[password];
	
	//查找
	
	
	$validate_arr=array($name,$pwd);
	Ifvalidate($validate_arr);
	
	$sql = "SELECT id,username,roleid,company1,trueName from rv_user WHERE username = '$name' AND password = md5('$pwd') limit 1";
	$db->query($sql);
	if ($record = $db->fetchRow()){	//登录成功
	
	
	$sql="select * from `rv_dengji` where company1='$record[company1]'";
	$db->query($sql);
	$row=$db->fetchRow();
	if($row[dengji]==1){
		$sql="select company1 from `rv_dengji` where dengji>='$row[dengji]' and one='$row[one]'";	
	}else if($row[dengji]==2){
		$sql="select company1 from `rv_dengji` where dengji>='$row[dengji]' and two='$row[two]'";
	}else if($row[dengji]==3){
		$sql="select company1 from `rv_dengji` where dengji>='$row[dengji]' and three='$row[three]'";
	}else if($row[dengji]==4){
		$sql="select company1 from `rv_dengji` where dengji>='$row[dengji]' and four='$row[four]'";
	}else if($row[dengji]==5){
		$sql="select company1 from `rv_dengji` where dengji>='$row[dengji]' and five='$row[five]'";
	}
	$a=$db->query($sql);
	 /* $list=$db->fetchAll();
	 //格式化输出数据
	foreach($list as $key=>$val){
		$company1_list[$list[$key][company1]] = $list[$key][company1];	//公司名称数组		
	}
	$as=array_values($company1_list); */
	
	$arr1.="^1^";
	while($row1=mysql_fetch_assoc($a)){
		$arr1.=",^".$row1[company1]."^";
	}
	//$arr2=str_replace("^","'",$arr1);

	
		$_SESSION['isLogin'] = true;
		$_SESSION['userid']	= $record['id'];
		$_SESSION['username'] = $record['trueName'];
		$_SESSION['roleid']	= $record['roleid'];
		//$_SESSION['rights']	= $record['rights'];
		$_SESSION['company1'] = $record['company1'];
		$_SESSION['city'] = $row[city];
		$_SESSION['xscompany1'] = $arr1;
		exit($lang_cn['rabc_login_ok']);
	}
	else
		exit($lang_cn['rabc_login_error']);
	exit;
}

//登录	
if($do=="login"){
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('web_name',$web_name);
	$smt->assign('title',"登录");
	$smt->display('user_login.htm');
	exit;
}


//退出	
if($do=="logout"){
	$_SESSION = array();
	session_destroy();
	exit($lang_cn['rabc_logout']);
}
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	if($_POST['username']){$search .= "and username like '%$_POST[username]%'";}	
	if($_POST['roleid']){$search .= "and roleid = '$_POST[roleid]'";}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `rv_user` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询
	$sql="SELECT * FROM `rv_user` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();	
	
	
	//角色数组
	$sql_role="SELECT id,title FROM `rv_role`";
	$db->query($sql_role);
	$list_role=$db->fetchAll();
	
	//格式化输出数据
	foreach($list_role as $key=>$val){
		$role_cn[$list_role[$key][id]]=$list_role[$key][title];		
	}
	
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][role_cn]=$role_cn[$list[$key][roleid]];		
	}
	
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	$smt->assign('select_role_cn',select($role_cn,"roleid","","选择角色","required"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('title',"用户列表");
	$smt->display('user_list.htm');
	exit;
	
}


//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	
	//角色数组
	$sql="SELECT id,title FROM `rv_role`";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//格式化角色数据
	foreach($list as $key=>$val){
		$role_cn[$list[$key][id]]=$list[$key][title];		
	}
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('select_role_cn',select($role_cn,"roleid","","选择角色","required"));
	$smt->assign('title',"新建用户");
	$smt->display('user_new.htm');
	exit;
}

//编辑	
if($do=="edit"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_user` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	
	//角色数组
	$sql_role="SELECT id,title FROM `rv_role`";
	$db->query($sql_role);
	$list_role=$db->fetchAll();
	
	//格式化角色数据
	foreach($list_role as $key=>$val){
		$role_cn[$list_role[$key][id]]=$list_role[$key][title];		
	}
	
	//模版
	$smt->assign('select_role_cn',select($role_cn,"roleid",$row[roleid],"选择角色","required"));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑用户");
	$smt->display('user_edit.htm');
	exit;
}


//修改密码	
if($do=="editpass"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_user` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"修改密码");
	$smt->display('user_edit_pass.htm');
	exit;
}

//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$created_at=date("Y-m-d H:i:s", time());
	$password=md5($_POST[password]);
	$company1=$_SESSION['company1'];
	//查询
	$sql="SELECT * FROM `rv_user` where username ='$_POST[username]' LIMIT 1";
	$db->query($sql);
	if($db->fetchRow()){echo  "{\"statusCode\":\"300\",\"message\":\"错误!用户已存在!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";exit();}
	
	$sql="INSERT INTO `rv_user` (`username` ,`password` ,`roleid` ,`trueName`,`created_at`,`company1` )
	VALUES ( '$_POST[username]', '$password', '$_POST[roleid]','$_POST[trueName]','$created_at','$company1');";
	if($db->query($sql)){echo close($msg,"user");}else{echo  error($msg);}
	exit;
}

//更新密码
if($do=="updatapass"){
	If_rabc($action,$do); //检测权限
	$updated_at=date("Y-m-d H:i:s", time());
	$id=$_SESSION['userid'];
	if($_POST[password]){
		$password=md5($_POST[password]);
		$pasql="`password`='$password',";
	}
	$sql="UPDATE `rv_user` SET $pasql
	`updated_at` = '$updated_at' WHERE `rv_user`.`id` =$id LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=logout\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=logout\"}";}	
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	$updated_at=date("Y-m-d H:i:s", time());
	$id=$_POST['id'];
	$areaid=implode(',',$_POST[areaid]);
	
	if($_POST[password]){
		$password=md5($_POST[password]);
		$pasql="`password`='$password',";
	}
	$sql="UPDATE `rv_user` SET 
	$pasql
	`roleid`  = '$_POST[roleid]',
	`trueName` = '$_POST[trueName]',
	`updated_at` = '$updated_at' WHERE `rv_user`.`id` =$id LIMIT 1 ;";
	if($db->query($sql)){echo user($msg);}else{echo  error($msg);}
	exit;
}


//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限	
	$sql="delete from `rv_user` where `rv_user`.`id`=$id limit 1";
	if($db->query($sql)){echo success($msg);}else{echo  error($msg);}	
	exit;
}
?>