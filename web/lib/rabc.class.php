<?php
//====================================================
//		FileName: rabc.class.php
//		Summary:  权限控制文件
//====================================================

//检测用户页面权限
function If_rabc($action,$do){
	global $lang_cn;
	global $db;
	//检测用户登录
	if(!isLogin()){exit($lang_cn['rabc_is_login']);}
	//组合内容
	$c_action=$action.$do;
	//获取当前用户
	$userid=$_SESSION['userid'];
	//查询当前用户角色权限
	$sql="SELECT r.action FROM `rv_user` as u,`rv_role` as r
	where u.id='$userid' and u.roleid = r.id LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	$r_action = explode(',',$row['action']);
	$m_action = array("userlogin","userloginok");
	$h_action = array_merge($r_action,$m_action);//合并一个或多个数组
	//判断当前页面是否有权限
	if(!in_array($c_action,$h_action)){
	//检查$h_action数组中是否存在$c_action
		//exit($lang_cn['rabc_error']);
		$privilege=false;
	}else{
		$privilege=true;
	}
	if(!$privilege){
		echo error_aquanx($msg);
		exit;
	}
}

//检测公司权限
function If_comrabc($id,$table){
	//echo "<script>alert(\"$id,$table\");</script>";
	$sql="select * from $table where id='$id'";//$table不能加''
	$a=mysql_query($sql);
	$row=mysql_fetch_assoc($a);
	//echo "<script>alert(\"$row[company1],$_SESSION[company1]\");</script>";
	if($row[company1]==$_SESSION[company1]){
		$com_privilege=true;
	}else{
		$com_privilege=false;
	}
	if(!$com_privilege){
		echo error_aquanx($msg);
		exit;
	}
}

//检测用户A权限
function If_rabc1($action,$do){
	global $lang_cn;
	global $db;
	//检测用户登录
	if(!isLogin()){exit($lang_cn['rabc_is_login']);}
	//组合内容
	$c_action=$action.$do;
	//获取当前用户
	$userid=$_SESSION['userid'];
	//查询当前用户角色权限
	$sql="SELECT r.action FROM `rv_user` as u,`rv_role` as r
	where u.id='$userid' and u.roleid = r.id LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	$r_action = explode(',',$row['action']);
	$m_action = array("userlogin","userloginok");
	$h_action = array_merge($r_action,$m_action);//合并一个或多个数组
	//判断当前页面是否有权限
	if(!in_array($c_action,$h_action)){
	//检查$h_action数组中是否存在$c_action
		//exit($lang_cn['rabc_error']);
		$privilege=false;
	}else{
		$privilege=true;
	}
	if(!$privilege){
		echo error_aquanx($msg);
		exit;
	}
}
//检测用户是否登录
function isLogin(){
	if(!empty($_SESSION['isLogin']))
		return 1;	
	else
		return 0;  
}

?>