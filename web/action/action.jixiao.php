<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

	$sql="select id,company1 from `rv_dengji` where company1 in ($arr2)";
	$db->query($sql);
	$company1_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($company1_arr as $key=>$val){
		$company1_list[$company1_arr[$key][company1]] = $company1_arr[$key][company1];	//sim卡状态数组		
	}
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
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
	$info_num=mysql_query("SELECT * FROM `rv_jixiao` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT * FROM `rv_jixiao` where company1 in ($arr2) $search order by id LIMIT $pageNum,$numPerPage";
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
	$smt->display('jixiao_list.htm');
	exit;	
}



//新增评价
if($do=="new"){
    If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('jixiao_new.htm');
	exit;
}


//写入绩效
if($do=="add"){
	If_rabc($action,$do); //检测权限
	//将名称中的英文()替换为中文（）
	$name1=str_replace("(","（",$_POST[pingjia]);
	$name=str_replace(")","）",$name1);
	$sql="INSERT INTO `rv_jixiao` (`pingjia`,`money`,`company1` )
	VALUES ('$name', '$_POST[money]','$_SESSION[company1]');";
	if($db->query($sql)){echo close($msg,"jixiao");}else{echo error($msg);}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_jixiao`");	
	//查找该库房中是否有东西
	$sql="select * from `rv_jixiao` where id='$id' and company1='$_SESSION[company1]'";
	$a=mysql_query($sql);
	$b=mysql_num_rows($a);
	$sql="delete from `rv_jixiao` where `rv_jixiao`.`id`='$id' limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}
	exit;
}
//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限	
	If_comrabc($_POST[id],"`rv_jixiao`");	
	//将名称中的英文()替换为中文（）
	$name1=str_replace("(","（",$_POST[pingjia]);
	$name=str_replace(")","）",$name1);
	//sql
	$sql="UPDATE `rv_jixiao` SET 
	`pingjia` = '$name',
	`money` = '$_POST[money]'
	WHERE `rv_jixiao`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"jixiao");}else{echo error($msg);}	
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_jixiao`");	
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_jixiao` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('title',"编辑");
	$smt->display('jixiao_edit.htm');
	exit;
}

?>