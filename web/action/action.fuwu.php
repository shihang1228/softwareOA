<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	//判断检索值
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}
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
	//查询
	$sql1="select rv_fee.id,carNum,money,feetime,inputer,judge,name from `rv_fee`,`rv_feetype` where rv_fee.company1 in ($arr2) and feetypeId=rv_feetype.id $search";
	$info_num=mysql_query($sql1);//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="select rv_fee.id,carNum,money,feetime,inputer,judge,name,rv_fee.company1 from `rv_fee`,`rv_feetype` where rv_fee.company1 in ($arr2) and feetypeId=rv_feetype.id $search order by rv_fee.id asc LIMIT $pageNum,$numPerPage";	
	$db->query($sql);
	$list=$db->fetchAll();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	 
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"产品列表");
	$smt->display('fuwu_list.htm');
	exit;	
}

	$sql="SELECT id,name FROM `rv_feetype`where company1='$_SESSION[company1]'";
	$db->query($sql);
	$list=$db->fetchAll();
	 //格式化输出数据
	foreach($list as $key=>$val){
		$feetype_list[$list[$key][id]] = $list[$key][name];	//费用类别数组		
	} 

//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('feetype_cn',select($feetype_list,"feetype","","费用类型"));
	$smt->assign('title',"新增销货记录");
	$smt->display('fuwu_new.htm');
	exit;
}
	

if($do=="add"){
	If_rabc($action,$do); //检测权限
	$username=$_SESSION['username'];
	$sql="select * from `rv_car` where company1='$_SESSION[company1]' and carNum='$_POST[carNum]'";
	$d=mysql_query($sql);
	$t=mysql_num_rows($d);
	if($t>0){
		$sql="INSERT INTO `rv_fee` (`carNum` ,`feetypeId`,`money`,`inputer`,`feetime`,`judge`,`company1`)
		VALUES ('$_POST[carNum]', '$_POST[feetype]', '$_POST[money]','$username',now(),1,'$_SESSION[company1]');";
		if($db->query($sql)){echo close($msg,"fuwu");}else{echo error($msg);}
		
	}else{
		echo error_car($msg);
	}		
	exit;
}

?>