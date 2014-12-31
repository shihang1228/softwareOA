<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//查找类型为终端的设备
$sql="SELECT `rv_product`.id,`rv_product`.name FROM `rv_product`,`rv_sort` where rv_product.categoryId=rv_sort.id and rv_sort.terminal='是' and rv_product.company1 in ($arr2) group by name";
$db->query($sql);
$product_arr1=$db->fetchAll();
 // 格式化输出数据
foreach($product_arr1 as $key=>$val){
	$terminalpro_list1[$product_arr1[$key][id]] = $product_arr1[$key][name];	//物品名称数组		
}
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	//判断检索值
	if($_POST['carNum']){$search .= " and rv_car.carNum like '%$_POST[carNum]%'";}
	if($_POST['installperson']){$search .= " and installperson like '%$_POST[installperson]%'";}
	
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
	
	//查询出厂未自带设备
	$sql1="SELECT `rv_device`.*,rv_car.carNum,rv_car.chejiaNum from `rv_device`,`rv_car` where rv_device.company1 in ($arr2) and rv_device.carId=rv_car.id $search";
	$info_num=mysql_query($sql1);
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT `rv_device`.*,rv_car.carNum,rv_car.chejiaNum from `rv_device`,`rv_car` where rv_device.company1 in ($arr2) and rv_device.carId=rv_car.id $search order by rv_device.id desc LIMIT $pageNum,$numPerPage";
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
	$smt->display('device_list.htm');
	exit;	
}

//新增	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$username=$_SESSION['username'];
	$sql1="select * from `rv_caidan` where company1='$_SESSION[company1]' and username='$username' and qufen='device'";
	$b=mysql_query($sql1);
	$n=mysql_num_rows($b);
	$i=0;
	if($n>$i){
	//rv_caidan表中有该用户名信息时，将信息删除
	$sql2="delete from `rv_caidan` where company1='$_SESSION[company1]' and username='$username' and qufen='device'";
	$db->query($sql2);
	}
	//将用户名插入rv_caidan表中
	$sql3="INSERT INTO `rv_caidan` (`username`,`company1`,`qufen`) VALUES('$username','$_SESSION[company1]','device');";
	$db->query($sql3);
	
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('productId_cn',selecter($terminalpro_list1,"productId","","选择设备","w_combox_model","?action=device&do=model_combox&value={value}"));
	$smt->assign('title',"新增");
	$smt->display('device_new.htm');
	exit;
}

if($do=="model_combox"){
	//将productId的值插入rv_caidan表中
	$sql="UPDATE `rv_caidan` SET `productId`='$value' WHERE company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='device'";
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
	$sql="update `rv_caidan` set `model`='$value' WHERE company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='device'";
	$db->query($sql);
	//从rv_caidan表中查找productId的值
	$sql="SELECT * from `rv_caidan` where company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='device'";
	$db->query($sql);
	$pro_list=$db->fetchRow();
	//通过商品ID在`rv_storage`表中查找该商品的供应商
	$sql="select supplierId,name from `rv_storage`,`rv_supplier` where rv_storage.company1='$_SESSION[company1]' and rv_storage.productId='$pro_list[productId]' and rv_storage.model='$value' and rv_storage.supplierId=rv_supplier.id group by supplierId";
	$result = @mysql_query($sql); 
	echo "[";
	echo '["0", "选择设备厂家"],';
	while($supplier_row = mysql_fetch_assoc($result)){
	echo '["'.$supplier_row[name].'", "'.$supplier_row[name].'"],';
	}
	echo "]";
    exit;
}

if($do=="room_combox"){
	//查找该供应商名对应的ID
	$sql="select id from `rv_supplier` where name='$value' and company1='$_SESSION[company1]'";
	$db->query($sql);
	$id_row=$db->fetchRow();
	//从rv_caidan表中查找productId的值
	$sql="SELECT * from `rv_caidan` where company1='$_SESSION[company1]' and username='$_SESSION[username]' and qufen='device'";
	$db->query($sql);
	$sup_list=$db->fetchRow();
	//通过商品ID在`rv_storage`表中查找存在该商品的库房名
	$sql="select roomId,name from `rv_storage`,`rv_room` where rv_storage.company1='$_SESSION[company1]' and supplierId='$id_row[id]' and productId='$sup_list[productId]' and model='$sup_list[model]' and roomId=rv_room.id group by roomId";
	$result = @mysql_query($sql); 
	echo "[";
	echo '["0", "选择库房"],';
	while($row = mysql_fetch_assoc($result)){
	echo '["'.$row[roomId].'", "'.$row[name].'"],';
	}
	echo "]";
}

//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	if($_POST['carNum']){$search .= " and carNum ='$_POST[carNum]'";}
	if($_POST['chejiaNum']){$search .= " and chejiaNum ='$_POST[chejiaNum]'";}
	$sql="select id,carNum from `rv_car` where company1='$_SESSION[company1]' $search";
	$aa=mysql_query($sql);
	$bb=mysql_num_rows($aa);
	//查找商品ID对应的商品名称
	$sql="select name from `rv_product` where id='$_POST[productId]' and company1='$_SESSION[company1]'";
	$db->query($sql);
	$name_row=$db->fetchRow();
	//查找供货商名称呢个对应的ID
	$sql2="select id from `rv_supplier` where name='$_POST[factory]' and company1='$_SESSION[company1]'";
	$db->query($sql2);
	$suId_row=$db->fetchRow();
	if($bb==1){
	//查找输入的设备数量在库存中是否为0
		$sql1="select * from `rv_storage` where company1='$_SESSION[company1]' and productId='$_POST[productId]' and model='$_POST[model]' and supplierId='$suId_row[id]' and roomId='$_POST[roomId]'";
		$x=mysql_query($sql1);
		$ts=mysql_num_rows($x);
		$list_cun=mysql_fetch_assoc($x);//查询一行
		$quantity_cun=$list_cun[quantity];
		if($ts>0){
		//判断库存中是否存在该设备
			if($quantity_cun>0){
			//判断数量是否大于0
				$list_carid=mysql_fetch_assoc($aa);//变量是查询的结果
				$ab=$list_carid[id];
				//将数据插入到设备表中
				$sql1="INSERT INTO `rv_device` (`carId`,`name`,`factory`,`model`,`roomId`,`money`,`installdate`,`installperson`,`danhao`,`zhujiId`,`company1`)
				VALUES ('$ab','$name_row[name]','$_POST[factory]','$_POST[model]','$_POST[roomId]','$_POST[money]','$_POST[installdate]','$_POST[installperson]','$_POST[danhao]','$_POST[zhujiId]','$_SESSION[company1]');";
				$db->query($sql1);
				//查找供货商对应的ID
				$sql="select id from `rv_supplier` where name='$_POST[factory]' and company1='$_SESSION[company1]'";
				$db->query($sql);
				$su_row=$db->fetchRow();
				//查找最近的一个单号
				$sql="select danhao from `rv_storage_chu` where company1='$_SESSION[company1]' group by danhao,company1 order by danhao desc limit 1";
				$db->query($sql);
				$danhao_row=$db->fetchRow();
				//将设备数据插入出库表中
				$sql2="INSERT INTO `rv_storage_chu` (`productId`,`model`,`carNum`,`quantity`,`outprice`,`shouquantity`,`supplierId`,`roomId`,`judge`,`leixing`,`danhao`,`company1`)
				VALUES ('$_POST[productId]','$_POST[model]','$list_carid[carNum]',1,'$_POST[money]',1,'$su_row[id]','$_POST[roomId]',1,3,'$danhao_row[danhao]'+1,'$_SESSION[company1]')";
				$db->query($sql2);
				/* //查找车辆汇总表中的总金额
				$sql4="select * from `rv_client` where company1='$_SESSION[company1]' $search;";
				$db->query($sql4);
				$money_row=$db->fetchRow();
				$money=$money_row[money] - $money_row[devicemoney] + $_POST[money]; */
				//更新`rv_client`表中的数据
				$sql="UPDATE `rv_client` SET 
				`deviceName`='$name_row[name]',
				`factory` = '$_POST[factory]',
				`model` = '$_POST[model]',
				`devicemoney`='$_POST[money]',
				`installdate` = '$_POST[installdate]',
				`installperson` = '$_POST[installperson]',
				`zhujiId` = '$_POST[zhujiId]',
				`danhao`='$_POST[danhao]'
				WHERE company1='$_SESSION[company1]' and carNum ='$_POST[carNum]' and chejiaNum ='$_POST[chejiaNum]';";	
				if($db->query($sql)){echo close($msg,"device");}else{echo error($msg);}
			}else{
				echo error("该设备数量不足，不能添加");
			}
		}else{
			echo error("不存在该设备，不能添加");
		}
		
	}else{
		echo error("不存在该车辆，不能添加设备");
	}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_device`");
	$sql="delete from `rv_device` where `rv_device`.`id`=$id";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_device`");
	$username=$_SESSION['username'];
	$sql1="select * from `rv_caidan` where company1='$_SESSION[company1]' and username='$username' and qufen='device'";
	$b=mysql_query($sql1);
	$n=mysql_num_rows($b);
	$i=0;
	if($n>$i){
	//rv_caidan表中有该用户名信息时，将信息删除
	$sql2="delete from `rv_caidan` where company1='$_SESSION[company1]' and username='$username' and qufen='device'";
	$db->query($sql2);
	}
	//将用户名插入rv_caidan表中
	$sql3="INSERT INTO `rv_caidan` (`username`,`company1`,`qufen`) VALUES('$username','$_SESSION[company1]','device');";
	$db->query($sql3);
	
	//查询
	$sql="SELECT * FROM `rv_device` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	$sql2="select id from `rv_product` where name='$row[name]' and company1='$_SESSION[company1]'";
	$db->query($sql2);
	$row2=$db->fetchRow();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('productId_cn',selecter($terminalpro_list1,"productId",$row2[id],"选择设备","w_combox_model","?action=device&do=model_combox&value={value}"));
	$smt->assign('title',"编辑");
	$smt->display('device_edit.htm');
	exit;
}
//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_device`");	
	if($_POST[id]){$id=$_POST[id];}
	else{$id=$_SESSION[id];}
	//查找商品ID对应的商品名称
	$sql1="select name from `rv_product` where id='$_POST[productId]' and company1='$_SESSION[company1]'";
	$db->query($sql1);
	$name_row=$db->fetchRow();
	//sql
	$sql2="UPDATE `rv_device` SET 
	`name` = '$name_row[name]',
	`factory` = '$_POST[factory]',
	`model` = '$_POST[model]',
	`money` = '$_POST[money]',
	`installdate` = '$_POST[installdate]',
	`installperson` = '$_POST[installperson]',
	`zhujiId` = '$_POST[zhujiId]',
	`danhao`='$_POST[danhao]'
	WHERE `rv_device`.`id` ='$_POST[id]';";	
	$db->query($sql2);
	//搜索出选中数据对应的车牌号和车架号
	$sql3="SELECT carNum,chejiaNum FROM `rv_device`,`rv_car` where rv_device.id='$_POST[id]' and carId=rv_car.id";
 	$db->query($sql3);
	$row=$db->fetchRow();
	//查询client表中的总金额
	/* $sql4="select * from `rv_client` where company1='$_SESSION[company1]' and (`carNum`='$row[carNum]' and `chejiaNum`='$row[chejiaNum]');";
	$db->query($sql4);
	$money_row=$db->fetchRow();
	$money=$money_row[money] - $money_row[devicemoney] + $_POST[money]; */
	$sql="UPDATE `rv_client` SET 
	`deviceName`='$name_row[name]',
	`factory` = '$_POST[factory]',
	`model` = '$_POST[model]',
	`devicemoney`='$_POST[money]',
	`installdate` = '$_POST[installdate]',
	`installperson` = '$_POST[installperson]',
	`zhujiId` = '$_POST[zhujiId]',
	`danhao`='$_POST[danhao]'
	WHERE company1='$_SESSION[company1]' and `carNum`='$row[carNum]' and `chejiaNum`='$row[chejiaNum]';";
	if($db->query($sql)){echo close($msg,"device");}else{echo error($msg);}	
	exit;
}

if($do=="search"){
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}
	if($_POST['chejiaNum']){$search .= " and chejiaNum like '%$_POST[chejiaNum]%'";}
	$sql="select * from `rv_car` where company1 in ($arr2) $search order by id asc";
	$info_num=mysql_query($sql);
	$total=mysql_num_rows($info_num);//总条数
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
	$sql="select * from `rv_car` where company1 in ($arr2) $search order by id asc LIMIT $pageNum,$numPerPage";
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
	$smt->display('carNum.htm');
	exit;	
}
?>