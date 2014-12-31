<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

	$sql="select id,name from `rv_weixiuproject` where company1 in ($arr2)";
	$db->query($sql);
	$pro_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($pro_arr as $key=>$val){
		$pro_list[$pro_arr[$key][name]] = $pro_arr[$key][name];	//sim卡状态数组		
	}
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['weixiuproject']){$search .= " and weixiuproject like '%$_POST[weixiuproject]%'";}//对应原则
	if($_POST['date']){$search .= " and date = '$_POST[date]'";}//对应原则
	
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
	$info_num=mysql_query("SELECT * FROM `rv_weixiuresult` where company1 in ($arr2) $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT * FROM `rv_weixiuresult` where company1 in ($arr2) $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('pro_cn',select($pro_list,"weixiuproject","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('weixiuresult_list.htm');
	exit;	
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_weixiuresult`");	
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_weixiuresult` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('title',"编辑");
	$smt->display('weixiuresult_edit.htm');
	exit;
}
//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限	
	If_comrabc($_POST[id],"`rv_weixiuresult`");	
	//sql
	$sql="UPDATE `rv_weixiuresult` SET 
	`beizhu` = '$_POST[beizhu]'
	WHERE `rv_weixiuresult`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"weixiuresult");}else{echo error($msg);}	
	exit;
}

?>