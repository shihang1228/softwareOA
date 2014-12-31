<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
 //查询
	$sql="SELECT id,name FROM `rv_room` where company1 in ($arr2)";
	$db->query($sql);
	$room_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($room_arr as $key=>$val){
		$room_list[$room_arr[$key][id]] = $room_arr[$key][name];	//仓库名称数组		
	}
//列表	
if($do==""){
    If_rabc($action,$do); //检测权限	
	$username=$_SESSION['username'];
	if($_POST['roomruId']){$search .= " and c2.id = '$_POST[roomruId]'";}//对应原则
	if($_POST['roomchuId']){$search .= " and c1.id = '$_POST[roomchuId]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `time` >  '$_POST[time_start] 00:00:00' AND  `time` <  '$_POST[time_over] 23:59:59'";
	}
	else if($_POST['time_start']!=""){
		$search .= " and `time` >  '$_POST[time_start] 00:00:00' AND `time` <  '$_POST[time_start] 23:59:59'";
	}
	else if($_POST['time_over']!=""){
		$search .= " and `time` >  '$_POST[time_over] 00:00:00' AND `time` <  '$_POST[time_over] 23:59:59'";
	}
	
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
	//调拨商品的信息
	$sql="select a.id as id,a.agreetime ,a.model,person,rv_supplier.name as sname,a.person,a.roomruId,a.roomchuId,b.name as pname,c1.name as roomchu,c2.name as roomru,a.quantity as quantity,a.judge from `rv_diaobo` as a,`rv_product` as b,`rv_supplier`,`rv_room` as c1,`rv_room` as c2 where a.company1 in ($arr2) and a.productId=b.id and a.supplierId=rv_supplier.id and a.roomchuId=c1.id and a.roomruId=c2.id $search";
	$info_num=mysql_query($sql);
	$total=mysql_num_rows($info_num);//总条数
	$sql1="select a.id as id,a.agreetime ,a.model,person,rv_supplier.name as sname,a.person,a.roomruId,a.roomchuId,b.name as pname,c1.name as roomchu,c2.name as roomru,a.quantity as quantity,a.judge,a.company1 from `rv_diaobo` as a,`rv_product` as b,`rv_supplier`,`rv_room` as c1,`rv_room` as c2 where a.company1 in ($arr2) and a.productId=b.id and a.supplierId=rv_supplier.id and a.roomchuId=c1.id and a.roomruId=c2.id $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql1);
	$list=$db->fetchAll();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	 
	$smt->assign('roomruId_cn',select($room_list,"roomruId","","请选择"));
	$smt->assign('roomchuId_cn',select($room_list,"roomchuId","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"产品列表"); 
	$smt->display('diaoboagree_list.htm');
	exit;	
}

if($do=="sure"){
	 If_rabc1($action,$do); //检测权限	
	If_comrabc($id,"`rv_diaobo`");
	//修改表中judge的值
	$sql1="update `rv_diaobo` set `judge`='2',`agreetime`=now(),`person`='$_SESSION[username]' where id='{$id}'";
	$db->query($sql1);
	//查找选中的值
	$sql2="select * from `rv_diaobo` where id='{$id}'";
	$db->query($sql2);
	$row=$db->fetchRow();
	//修改出库表中diaojudge的值，当diaojudge=2时显示到确认出库界面
	$sql3="update `rv_storage_chu` set `diaojudge`='2' where id='$row[stchuId]' and company1='$_SESSION[company1]'";
	$db->query($sql3);
	//修改入库表中diaojudge的值，当diaojudge=2时显示到确认入库界面
	$sql4="update `rv_storage_ru` set `diaojudge`='2' where id='$row[struId]' and company1='$_SESSION[company1]'";
	if($db->query($sql4)){echo success($msg);}else{echo error($msg);}
	exit;
}
?>