<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
//物品名称
	$sql="SELECT id,name FROM `rv_product` where company1 in ($arr2) group by name";
	$db->query($sql);
	$product_arr=$db->fetchAll();
	 // 格式化输出数据
	foreach($product_arr as $key=>$val){
		$product_list[$product_arr[$key][id]] = $product_arr[$key][name];	//物品名称数组		
	}
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
	$sql="select * from `rv_caidan` where company1='$_SESSION[company1]' and username='$username' and qufen='diaobo'";
	$b=mysql_query($sql);
	$n=mysql_num_rows($b);
	$i=0;
	if($n>$i){
	//rv_caidan表中有该用户名信息时，将信息删除
	$sql="delete from `rv_caidan` where company1='$_SESSION[company1]' and username='$username' and qufen='diaobo'";
	$db->query($sql);
	}
	//将用户名插入rv_caidan表中
	$sql="INSERT INTO `rv_caidan` (`username`,`company1`,`qufen`) VALUES('$username','$_SESSION[company1]','diaobo');";
	$db->query($sql);
	
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
	$sql="select a.id as id,a.time ,a.model,rv_supplier.name as sname,a.inputer,a.roomruId,a.roomchuId,b.name as pname,c1.name as roomchu,c2.name as roomru,a.quantity as quantity from `rv_diaobo` as a,`rv_product` as b,`rv_supplier`,`rv_room` as c1,`rv_room` as c2 where a.company1 in ($arr2) and a.productId=b.id and a.supplierId=rv_supplier.id and a.roomchuId=c1.id and a.roomruId=c2.id $search";
	$info_num=mysql_query($sql);
	$total=mysql_num_rows($info_num);//总条数
	$sql1="select a.id as id,a.time ,a.model,rv_supplier.name as sname,a.inputer,a.roomruId,a.roomchuId,b.name as pname,c1.name as roomchu,c2.name as roomru,a.quantity as quantity,a.company1 from `rv_diaobo` as a,`rv_product` as b,`rv_supplier`,`rv_room` as c1,`rv_room` as c2 where a.company1 in ($arr2) and a.productId=b.id and a.supplierId=rv_supplier.id and a.roomchuId=c1.id and a.roomruId=c2.id $search order by id desc LIMIT $pageNum,$numPerPage";
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
	$smt->display('diaobo_list.htm');
	exit;	
}



//新增
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('productId_cn',selecter($product_list,"productId","","选择商品","w_combox_model","?action=diaobo&do=model_combox&value={value}"));
	$smt->assign('roomchuId_cn',select($room_list,"roomchuId","","调出库房选择"));
	$smt->assign('roomruId_cn',select($room_list,"roomruId","","调入库房选择"));
	$smt->assign('title',"调拨记录");
	$smt->display('diaobo_new.htm');
	exit;
}

if($do=="model_combox"){
	//将productId的值插入rv_caidan表中
	$sql="UPDATE `rv_caidan` SET productId='$value' WHERE company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='diaobo'";
	$db->query($sql);
	//通过商品ID在`rv_storage_ru`表中查找该商品的供应商
	$sql="select name from `rv_product` where id=$value";
	$db->query($sql);
	$list=$db->fetchRow();
	$sql="select model from `rv_product` where company1='$_SESSION[company1]' and name='$list[name]'";
	$result = @mysql_query($sql); 
	echo "[";
	echo '["", "选择型号"],';
	while($row = mysql_fetch_assoc($result)){
	echo '["'.$row[model].'", "'.$row[model].'"],';
	}
	echo "]";
    exit;
}


if($do=="supplier_combox"){
	//将supplierId的值插入rv_caidan表中
	$sql="update `rv_caidan` set model='$value' WHERE company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='diaobo'";
	$db->query($sql);
	//从rv_caidan表中查找productId的值
	$sql="SELECT * from `rv_caidan` where company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='diaobo'";
	$db->query($sql);
	$pro_list=$db->fetchRow();
	//通过商品ID在`rv_storage`表中查找该商品的供应商
	$sql="select supplierId,name from `rv_storage`,`rv_supplier` where rv_storage.company1='$_SESSION[company1]' and productId='$pro_list[productId]' and model='$value' and supplierId=rv_supplier.id group by supplierId";
	$result = @mysql_query($sql); 
	echo "[";
	echo '["0", "选择供应商"],';
	while($supplier_row = mysql_fetch_assoc($result)){
		echo '["'.$supplier_row[supplierId].'", "'.$supplier_row[name].'"],';
	}
	echo "]";
    exit;
}

if($do=="roomchu_combox"){
	$sql="update `rv_caidan` set supplierId='$value' WHERE company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='diaobo'";
	$db->query($sql);
	//从rv_caidan表中查找productId的值
	$sql="SELECT * from `rv_caidan` where company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='diaobo'";
	$db->query($sql);
	$sup_list=$db->fetchRow();
	//通过商品ID在`rv_storage`表中查找存在该商品的库房名
	$sql="select roomId,name from `rv_storage`,`rv_room` where rv_storage.company1='$_SESSION[company1]' and supplierId='$value' and productId='$sup_list[productId]' and model='$sup_list[model]' and roomId=rv_room.id group by roomId";
	$result = @mysql_query($sql); 
	echo "[";
	echo '["0", "选择库房"],';
	while($row = mysql_fetch_assoc($result)){
	echo '["'.$row[roomId].'", "'.$row[name].'"],';
	}
	echo "]";
}

if($do=="roomru_combox"){
	$sql="update `rv_caidan` set roomId='$value' WHERE company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='diaobo'";
	$db->query($sql);
	//从rv_caidan表中查找productId的值
	$sql="SELECT * from `rv_caidan` where company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='diaobo'";
	$db->query($sql);
	$sup_list=$db->fetchRow();
	//通过商品ID在`rv_storage`表中查找存在该商品的库房名
	$sql="select id,name from `rv_room` where company1='$_SESSION[company1]' and id<>'$value'";
	$result = @mysql_query($sql); 
	echo "[";
	echo '["0", "选择库房"],';
	while($row = mysql_fetch_assoc($result)){
	echo '["'.$row[id].'", "'.$row[name].'"],';
	}
	echo "]";
}

//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$username=$_SESSION['username'];
	//查询调出的商品在库存表中是否存在
	$sql1="select * from `rv_storage` where company1='$_SESSION[company1]' and productId='$_POST[productId]' and roomId='$_POST[roomchuId]' and model='$_POST[model]' and supplierId='$_POST[supplierId]'";
	$aa=mysql_query($sql1);
	$ts=mysql_num_rows($aa);
	$list_cun=mysql_fetch_assoc($aa);//查询一行
	$quantity_cun=$list_cun[quantity];//获取库存表中相应商品的数量
	$i=0;
	if($ts>$i){
		if($_POST[quantity] <= $quantity_cun){
		    //调出的数量小于库存数量
			//将调出的商品写入出库表中
			$sql="INSERT INTO `rv_storage_chu` (`productId` ,`model` ,`roomId` ,`supplierId` ,`quantity` ,`inputer`,`judge`,`leixing`,`diaojudge`,`company1`)
			VALUES ('$_POST[productId]','$_POST[model]','$_POST[roomchuId]','$_POST[supplierId]','$_POST[quantity]','$username',2,2,1,'$_SESSION[company1]');";
			$db->query($sql);
			//查询该条调拨记录在出库表中的ID，并将其插入调拨表中
			$sql="select id from `rv_storage_chu` order by id desc LIMIT 1";
			$db->query($sql);
			$row1=$db->fetchRow();
			//将调入的商品写入入库表中
			$sql="INSERT INTO `rv_storage_ru` (`productId` ,`model` ,`roomId` ,`supplierId` ,`quantity` ,`inputer`,`judge`,`leixing`,`diaojudge`,`company1`)
			VALUES ('$_POST[productId]','$_POST[model]','$_POST[roomruId]','$_POST[supplierId]','$_POST[quantity]','$username',1,2,1,'$_SESSION[company1]');";
			$db->query($sql);
			//查询该条调拨记录在入库表中的ID，并将其插入调拨表中
			$sql="select id from `rv_storage_ru` order by id desc LIMIT 1";
			$db->query($sql);
			$row2=$db->fetchRow();
		   //将调拨信息插入调拨表中
		   $sql="INSERT INTO `rv_diaobo` (`productId` ,`model`,`supplierId`,`roomchuId`,`roomruId` ,`quantity`,`inputer`,`stchuId`,`struId`,`time`,`judge`,`company1`)
			VALUES ('$_POST[productId]','$_POST[model]','$_POST[supplierId]','$_POST[roomchuId]','$_POST[roomruId]','$_POST[quantity]','$username','$row1[id]','$row2[id]',now(),1,'$_SESSION[company1]');";
			$db->query($sql);
			echo close($msg,"diaobo");
		}else {
			echo error_diao($msg);//库存不足
		}
		
	}else{
		echo error_no($msg);//库房中不存在该商品
	}
	
	exit;
}

?>