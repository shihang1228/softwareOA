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
	if($_POST['pname']){$search .= " and c.name like '%$_POST[pname]%'";}
	if($_POST['roomId']){$search .= " and roomId = '$_POST[roomId]'";}
	if($_POST['supplierId']){$search .= " and supplierId = '$_POST[supplierId]'";}
	if($_POST['inputer']){$search .= " and inputer like '%$_POST[inputer]%'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `rukutime` >  '$_POST[time_start] 00:00:00' AND  `rukutime` <  '$_POST[time_over] 23:59:59'";
	}
	else if($_POST['time_start']!=""){
		$search .= " and `rukutime` >  '$_POST[time_start] 00:00:00' AND `rukutime` <  '$_POST[time_start] 23:59:59'";
	}
	else if($_POST['time_over']!=""){
		$search .= " and `rukutime` >  '$_POST[time_over] 00:00:00' AND `rukutime` <  '$_POST[time_over] 23:59:59'";
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
	$sql1="SELECT a.id,a.judge,kuguanName,a.quantity,a.model,a.inprice,a.rukutime ,c.name as pname,b.name as rname,d.name as sname,a.quantity*a.inprice as heji FROM `rv_storage_ru` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d 
	where a.judge in(1,2) and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.diaojudge in(0,2) and a.company1 in ($arr2) $search";
	$info_num=mysql_query($sql1);
	$total=mysql_num_rows($info_num);//总条数
	//查询
	$sql="SELECT a.id,a.judge,kuguanName,a.quantity,a.model,a.inprice,a.rukutime ,c.name as pname,b.name as rname,d.name as sname,a.quantity*a.inprice as heji,a.company1 FROM `rv_storage_ru` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d 
	where a.judge in(1,2) and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.diaojudge in(0,2) and a.company1 in ($arr2) $search order by a.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('roomId_cn',select($room_list,"roomId","","请选择"));
	$smt->assign('supplierId_cn',select($supplier_list,"supplierId","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"产品列表");
	$smt->display('storage_ru_list.htm');
	exit;	
}
if($do=="sure"){
	If_rabc1($action,$do);
	If_comrabc($id,"`rv_storage_ru`");
	$username=$_SESSION['username'];
	//查询需要确认入库的商品
	$sql="select * from `rv_storage_ru` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row1=$db->fetchRow();
	
	//查询调拨表中的数据
	$sql="select * from `rv_diaobo` where struId='{$id}'and company1='$_SESSION[company1]' LIMIT 1";
	$db->query($sql);
	$row2=$db->fetchRow();
	$m=mysql_query($sql);
	$ms=mysql_num_rows($m);
	if($ms>0){
		$roomId=$row2[roomruId];
		$row=$row2;
	}else{
		$roomId=$row1[roomId];
		$row=$row1;
	}
	//查询库存表中是否有该商品
	$sql="select * from `rv_storage` where company1='$_SESSION[company1]' and productId='$row[productId]' and supplierId='$row[supplierId]' and `model`='$row[model]' and roomId='$roomId'";
	$aa=mysql_query($sql);
	$ts=mysql_num_rows($aa);
	//查询入库的商品在rv_detail表中是否存在
	$sql="select * from `rv_detail` where company1='$_SESSION[company1]' and productId='$row[productId]' and roomId='$roomId' and model='$row[model]' and supplierId='$row[supplierId]' and date=date_format(now(),'%Y-%c')";
	$cc=mysql_query($sql);
	$cs=mysql_num_rows($cc);
	if($ts>0){
	//判断`rv_storage`表中是否存在该产品，存在则修改数据，不存在新增记录
	//修改库存表相应商品的数量
	$sql="update `rv_storage` set `quantity`=`quantity`+'$row[quantity]' where company1='$_SESSION[company1]' and `productId`='$row[productId]' and supplierId='$row[supplierId]' and `model`='$row[model]' and `roomId`='$roomId'";
	$db->query($sql);
	}else{
		//将入库记录插入`rv_storage`表中
		$sql="INSERT INTO `rv_storage` (`productId` ,`model` ,`roomId` ,`supplierId`,`quantity`,`company1`)
		VALUES ('$row[productId]','$row[model]','$roomId','$row[supplierId]','$row[quantity]','$_SESSION[company1]');";
		$db->query($sql);
	}
	 if($cs>0){
   //入库商品在`rv_detail`表中存在时，更新表中的数据
   $sql="update `rv_detail` set `curruquantity`=`curruquantity`+'$row[quantity]' where `company1`='$_SESSION[company1]' and `productId`='$row[productId]' and `roomId`='$roomId' and model='$row[model]' and supplierId='$row[supplierId]' and date=date_format(now(),'%Y-%c')";
	$db->query($sql);
   }else{
   //否则将入库商品的数据插入表中
   $sql="INSERT INTO `rv_detail` (`productId` ,`model`,`roomId` ,`supplierId`,`curruquantity`,`date`,`company1`)
   VALUES ('$row[productId]','$row[model]','$roomId','$row[supplierId]','$row[quantity]',date_format(now(),'%Y-%c'),'$_SESSION[company1]');";
   $db->query($sql);
   }
	$sql="update `rv_storage_ru` set `kuguanName`='$username',`rukutime`=now(),`judge`=2 where id='{$id}'";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}
	exit;

}

?>