<?php
//====================================================
//		FileName: rabc.class.php
//		Summary:  Ȩ�޿����ļ�
//====================================================

//����û�ҳ��Ȩ��
function If_rabc($action,$do){
	global $lang_cn;
	global $db;
	//����û���¼
	if(!isLogin()){exit($lang_cn['rabc_is_login']);}
	//�������
	$c_action=$action.$do;
	//��ȡ��ǰ�û�
	$userid=$_SESSION['userid'];
	//��ѯ��ǰ�û���ɫȨ��
	$sql="SELECT r.action FROM `rv_user` as u,`rv_role` as r
	where u.id='$userid' and u.roleid = r.id LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	$r_action = explode(',',$row['action']);
	$m_action = array("userlogin","userloginok");
	$h_action = array_merge($r_action,$m_action);//�ϲ�һ����������
	//�жϵ�ǰҳ���Ƿ���Ȩ��
	if(!in_array($c_action,$h_action)){
	//���$h_action�������Ƿ����$c_action
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

//��⹫˾Ȩ��
function If_comrabc($id,$table){
	//echo "<script>alert(\"$id,$table\");</script>";
	$sql="select * from $table where id='$id'";//$table���ܼ�''
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

//����û�AȨ��
function If_rabc1($action,$do){
	global $lang_cn;
	global $db;
	//����û���¼
	if(!isLogin()){exit($lang_cn['rabc_is_login']);}
	//�������
	$c_action=$action.$do;
	//��ȡ��ǰ�û�
	$userid=$_SESSION['userid'];
	//��ѯ��ǰ�û���ɫȨ��
	$sql="SELECT r.action FROM `rv_user` as u,`rv_role` as r
	where u.id='$userid' and u.roleid = r.id LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	$r_action = explode(',',$row['action']);
	$m_action = array("userlogin","userloginok");
	$h_action = array_merge($r_action,$m_action);//�ϲ�һ����������
	//�жϵ�ǰҳ���Ƿ���Ȩ��
	if(!in_array($c_action,$h_action)){
	//���$h_action�������Ƿ����$c_action
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
//����û��Ƿ��¼
function isLogin(){
	if(!empty($_SESSION['isLogin']))
		return 1;	
	else
		return 0;  
}

?>