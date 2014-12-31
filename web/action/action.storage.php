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
	//判断检索值
	if($_POST['pname']){$search .= " and rv_product.name like '%$_POST[pname]%'";}
	if($_POST['roomId']){$search .= " and roomId = '$_POST[roomId]'";}
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
	$sql1="select rv_storage.id,rv_storage.model,rv_product.name as pname,rv_supplier.name as sname,rv_room.name as rname,rv_storage.quantity as quantity from `rv_storage`,`rv_product`,`rv_room`,`rv_supplier` where rv_storage.company1 in ($arr2) and rv_storage.productId=rv_product.id and rv_storage.roomId=rv_room.id and rv_storage.supplierId=rv_supplier.id $search";
	$info_num=mysql_query($sql1);
	$total=mysql_num_rows($info_num);//总条数
	//查询入库商品的相关信息
	$sql="select rv_storage.id,rv_storage.model,rv_product.name as pname,rv_supplier.name as sname,rv_room.name as rname,rv_storage.quantity as quantity,rv_storage.company1 from `rv_storage`,`rv_product`,`rv_room`,`rv_supplier` where rv_storage.company1 in ($arr2) and rv_storage.productId=rv_product.id and rv_storage.roomId=rv_room.id and rv_storage.supplierId=rv_supplier.id $search order by rv_storage.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	 
 	$smt->assign('roomId_cn',select($room_list,"roomId","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"产品列表"); 
	$smt->display('storage_list.htm');
	exit;	
}
 

?>