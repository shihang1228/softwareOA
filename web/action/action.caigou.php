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
	
	//物品名称
	$sql="SELECT id,name FROM `rv_product` where company1 in ($arr2) group by name";
	$db->query($sql);
	$product_arr=$db->fetchAll();
	 // 格式化输出数据
	foreach($product_arr as $key=>$val){
		$product_list[$product_arr[$key][id]] = $product_arr[$key][name];	//物品名称数组		
	}
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['pname']){$search .= " and c.name like '%$_POST[pname]%'";}
	if($_POST['roomId']){$search .= " and roomId = '$_POST[roomId]'";}
	if($_POST['supplierId']){$search .= " and supplierId = '$_POST[supplierId]'";}
	if($_POST['inputer']){$search .= " and inputer = '$_POST[inputer]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `caigoutime` >  '$_POST[time_start] 00:00:00' AND  `caigoutime` <  '$_POST[time_over] 23:59:59'";
	}
	else if($_POST['time_start']!=""){
		$search .= " and `caigoutime` >  '$_POST[time_start] 00:00:00' AND `caigoutime` <  '$_POST[time_start] 23:59:59'";
	}
	else if($_POST['time_over']!=""){
		$search .= " and `caigoutime` >  '$_POST[time_over] 00:00:00' AND `caigoutime` <  '$_POST[time_over] 23:59:59'";
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
	$sql="SELECT a.id,a.inputer,a.quantity,a.model,a.inprice,a.caigoutime ,c.name as pname,b.name as rname,d.name as sname,a.quantity*a.inprice as heji FROM `rv_storage_ru` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d 
	where a.leixing=1 and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.company1 in ($arr2) $search";
	$info_num=mysql_query($sql);
	$total=mysql_num_rows($info_num);//总条数
	//查询
	$sql="SELECT a.id,a.company1,a.inputer,a.quantity,a.model,a.inprice,a.caigoutime ,c.name as pname,b.name as rname,d.name as sname,a.quantity*a.inprice as heji FROM `rv_storage_ru` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d 
	where a.leixing=1 and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.company1 in ($arr2) $search order by a.id desc LIMIT $pageNum,$numPerPage";
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
	$smt->display('caigou_list.htm');
	exit;	
}

//新增	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//$smt->assign('productId_cn',selecter($product_list,"productId","","选择商品","w_combox_model","?action=caigou&do=model_combox&value={value}"));
	$smt->assign('roomId_cn',select($room_list,"roomId","","库房选择"));
	$smt->assign('supplierId_cn',select($supplier_list,"supplierId","","供应商选择"));
	$smt->assign('title',"新增入库记录");
	$smt->display('caigou_new.htm');
	exit;
}

/* if($do=="model_combox"){
	//通过商品ID在`rv_storage_ru`表中查找该商品的供应商
	$sql="select name from `rv_product` where id=$value";
	$db->query($sql);
	$list=$db->fetchRow();
	$sql="select model from `rv_product` where name='$list[name]' and company1 in ($arr2)";
	$result = @mysql_query($sql); 
	echo "[";
	echo '["", "选择型号"],';
	while($row = mysql_fetch_assoc($result)){
	echo '["'.$row[model].'", "'.$row[model].'"],';
	}
	echo "]";
    exit;
} */


//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$username=$_SESSION['username'];
	$sql="select id from `rv_product` where name='$_POST[name]' and model='$_POST[model]'";
	$db->query($sql);
	$row=$db->fetchRow();
	//将数据插入入库表
	$sql="INSERT INTO `rv_storage_ru` (`productId` ,`model` ,`roomId` ,`supplierId` ,`quantity` ,`inprice`,`inputer`,`caigoutime`,`judge`,`leixing`,`company1`)
	VALUES ('$row[id]','$_POST[model]','$_POST[roomId]','$_POST[supplierId]','$_POST[quantity]','$_POST[inprice]','$username',now(),1,1,'$_SESSION[company1]');";
	$db->query($sql);
	echo close($msg,"caigou");
	exit;
}

if($do=="search"){
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['model']){$search .= " and model like '%$_POST[model]%'";}
	$sql="SELECT * FROM `rv_product` where company1 in ($arr2) order by id desc";
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
	$sql="select * from `rv_product` where company1 in ($arr2) $search order by id asc LIMIT $pageNum,$numPerPage";
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
	$smt->display('product.htm');
	exit;	
}

?>