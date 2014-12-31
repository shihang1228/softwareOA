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
	$sql="select * from `rv_caidan` where company1='$_SESSION[company1]' and username='$username' and qufen='sale'";
	$b=mysql_query($sql);
	$n=mysql_num_rows($b);
	$i=0;
	if($n>$i){
	//rv_caidan表中有该用户名信息时，将信息删除
	$sql="delete from `rv_caidan` where company1='$_SESSION[company1]' and username='$username' and qufen='sale'";
	$db->query($sql);
	}
	//将用户名插入rv_caidan表中
	$sql="INSERT INTO `rv_caidan` (`username`,`company1`,`qufen`) VALUES('$username','$_SESSION[company1]','sale');";
	$db->query($sql);
	//判断检索值
	if($_POST['carNum']){$search .= " and a.carNum = '$_POST[carNum]'";}
	if($_POST['pname']){$search .= " and c.name like '%$_POST[pname]%'";}
	if($_POST['roomId']){$search .= " and roomId = '$_POST[roomId]'";}
	if($_POST['supplierId']){$search .= " and supplierId = '$_POST[supplierId]'";}
	if($_POST['inputer']){$search .= " and inputer = '$_POST[inputer]'";}
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
	$sql1="SELECT a.id,danhao,a.inputer,a.model,a.carNum,a.quantity,a.outprice,a.shouquantity,a.time ,c.name as pname,e.company,b.name as rname,d.name as sname,a.quantity*a.outprice as heji,a.shouquantity*a.outprice as shouheji FROM `rv_storage_chu` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d,`rv_car` as e 
	where a.company1 in ($arr2) and a.leixing=1 and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.carNum=e.carNum $search";
	$info_num=mysql_query($sql1);//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	//查询
	$sql="SELECT a.id,danhao,a.inputer,a.model,a.carNum,a.quantity,a.outprice,a.shouquantity,a.time ,c.name as pname,e.company,b.name as rname,d.name as sname,a.quantity*a.outprice as heji,a.shouquantity*a.outprice as shouheji,a.company1 FROM `rv_storage_chu` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d,`rv_car` as e 
	where a.company1 in ($arr2) and a.leixing=1 and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.carNum=e.carNum $search order by a.id desc LIMIT $pageNum,$numPerPage";	
	$db->query($sql);
	$list=$db->fetchAll();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('qianzhui',$qianzhui);		
	$smt->assign('roomId_cn',select($room_list,"roomId","","请选择"));
	$smt->assign('supplierId_cn',select($supplier_list,"supplierId","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"产品列表");
	$smt->display('sale_list.htm');
	exit;	
}



//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('productId_cn',selecter($product_list,"productId","","选择商品","w_combox_model","?action=sale&do=model_combox&value={value}"));
	$smt->assign('title',"新增入库记录");
	$smt->display('sale_new.htm');
	exit;
}


if($do=="add"){
	If_rabc($action,$do); //检测权限
	$sql="select danhao from `rv_storage_chu` where company1='$_SESSION[company1]' group by danhao,company1 order by danhao desc limit 1";
	$db->query($sql);
	$danhao_row=$db->fetchRow();
	$b=mysql_query($sql);
	$d=mysql_num_rows($b); 
	$username=$_SESSION['username'];
	$sql1="select * from `rv_storage` where company1='$_SESSION[company1]' and productId='$_POST[productId]' and model='$_POST[model]' and roomId='$_POST[roomId]' and supplierId='$_POST[supplierId]'";
	$aa=mysql_query($sql1);
	$ts=mysql_num_rows($aa);
	$i=0;
	$list_cun=mysql_fetch_assoc($aa);//查询一行
	$quantity_cun=$list_cun[quantity];
	
	$sql="select carNum from `rv_car` where company1='$_SESSION[company1]' and carNum='$_POST[carNum]'";
	$a2=mysql_query($sql);
	$r=mysql_num_rows($a2);
	if($r>0){
		if($ts>$i){
		//判断`rv_storage`表中是否存在该产品，存在则修改数据，不存在提示不存在
			if($_POST[quantity] <= $quantity_cun){
				if($d>0){
				//判断销售的数量是否大于库存数量
				//将数据插入出库表，'judge'=1：商品处于已销售状态，可以确认收款；'judge'=2：商品处于已收款状态，可以确认出库；'judge'=3：商品可以出库；leixing=1表示销售出去的商品，leixing=2表示调拨出库的商品
				$sql="INSERT INTO `rv_storage_chu` (`productId` ,`model` ,`carNum`,`roomId` ,`supplierId` ,`quantity` ,`outprice`,`shouquantity`,`inputer`,`judge`,`leixing`,`danhao`,`company1`)
				VALUES ('$_POST[productId]','$_POST[model]','$_POST[carNum]','$_POST[roomId]','$_POST[supplierId]','$_POST[quantity]','$_POST[outprice]','$_POST[shouquantity]','$username',1,1,'$danhao_row[danhao]'+1,'$_SESSION[company1]');";
				}else{
				$sql="INSERT INTO `rv_storage_chu` (`productId` ,`model` ,`carNum`,`roomId` ,`supplierId` ,`quantity` ,`outprice`,`shouquantity`,`inputer`,`judge`,`leixing`,`danhao`,`company1`)
				VALUES ('$_POST[productId]','$_POST[model]','$_POST[carNum]','$_POST[roomId]','$_POST[supplierId]','$_POST[quantity]','$_POST[outprice]','$_POST[shouquantity]','$username',1,1,'$houzhui','$_SESSION[company1]');";
				}
				$db->query($sql);
				echo close($msg,"sale");
			}else {
				echo error_xiao($msg);//库存不足
			}
		}else{
			echo error_no($msg);//库房中没有该商品，不能销售
		}
	}else{
		echo error_car($msg);
	}
	exit;
}

if($do=="model_combox"){
	//将productId的值插入rv_caidan表中
	$sql="UPDATE `rv_caidan` SET `productId`='$value' WHERE company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='sale'";
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
	$sql="update `rv_caidan` set `model`='$value' WHERE company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='sale'";
	$db->query($sql);
	//从rv_caidan表中查找productId的值
	$sql="SELECT * from `rv_caidan` where company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='sale'";
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

if($do=="room_combox"){
	$sql="update `rv_caidan` set `supplierId`='$value' WHERE company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='sale'";
	$db->query($sql);
	//从rv_caidan表中查找productId的值
	$sql="SELECT * from `rv_caidan` where company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='sale'";
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

?>