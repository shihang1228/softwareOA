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
	//if($_POST['carNum']){$search .= " and a.carNum = '$_POST[carNum]'";}
	if($_POST['pname']){$search .= " and c.name like '%$_POST[pname]%'";}
	if($_POST['roomId']){$search .= " and roomId = '$_POST[roomId]'";}
	if($_POST['supplierId']){$search .= " and supplierId = '$_POST[supplierId]'";}
	if($_POST['inputer']){$search .= " and inputer like '%$_POST[inputer]%'";}
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
	//查询
	$sql="SELECT a.id,danhao,kuguanName,a.carNum,a.judge as judge,a.quantity,a.model,a.shouquantity,a.chutime ,c.name as pname,b.name as rname,d.name as sname FROM `rv_storage_chu` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d
	where a.company1 in ($arr2) and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.judge in(2,3) and a.diaojudge in(0,2) $search order by a.id desc";
	$info_num=mysql_query($sql);
	$total=mysql_num_rows($info_num);//总条数	
	$sql1="SELECT a.id,danhao,kuguanName,a.carNum,a.judge as judge,a.quantity,a.model,a.shouquantity,a.chutime ,c.name as pname,b.name as rname,d.name as sname,a.company1 FROM `rv_storage_chu` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d
	where a.company1 in ($arr2) and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.judge in(2,3) and a.diaojudge in(0,2) $search order by a.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql1);
	$list=$db->fetchAll();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	 
	$smt->assign('username',$username);
	$smt->assign('qianzhui',$qianzhui);	
	$smt->assign('roomId_cn',select($room_list,"roomId","","请选择"));
	$smt->assign('supplierId_cn',select($supplier_list,"supplierId","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"产品列表");
	$smt->display('storage_chu_list.htm');
	exit;	
}

//写入维护信息
if($do=="sure"){
	If_rabc1($action,$do);	//检测权限
	If_comrabc($id,"`rv_storage_chu`");
	//查找要确认收款的出库产品
	$sql="select * from `rv_storage_chu` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$leixing=$row[leixing];
	//查询调拨表中的数据
	$diao_sql="select * from `rv_diaobo` where stchuId='{$id}' LIMIT 1";
	$db->query($diao_sql);
	$diao_row=$db->fetchRow();
	//查询调出的商品在库存表中是否存在
	$sql1="select * from `rv_storage` where company1='$_SESSION[company1]' and productId='$diao_row[productId]' and roomId='$diao_row[roomchuId]' and model='$diao_row[model]' and supplierId='$diao_row[supplierId]'";
	$aa=mysql_query($sql1);
	$as=mysql_num_rows($aa);
	$list_cun=mysql_fetch_assoc($aa);//查询一行
	$quantity_cun=$list_cun[quantity];//获取库存表中相应商品的数量
	$i=0;
	$username=$_SESSION['username'];
	//调拨模块
	if($as>$i and $leixing=="2"){
		if($diao_row[quantity] <= $quantity_cun){
		    //调出的数量小于库存数量
			//查询调出的商品在rv_detail表中是否存在
			$sql="select * from `rv_detail` where company1='$_SESSION[company1]' and productId='$diao_row[productId]' and roomId='$diao_row[roomchuId]' and model='$diao_row[model]' and supplierId='$diao_row[supplierId]' and date=date_format(now(),'%Y-%c')";
			$cc=mysql_query($sql);
			$cs=mysql_num_rows($cc);
			//修改出库表中judge字段为3
			$sql="update `rv_storage_chu` set `kuguanName`='$username',`chutime`=now(),`judge`=3 where id='{$id}'";
			$db->query($sql);
			//更新库存表中相应产品的数量
			$sql="update `rv_storage` set `quantity`=`quantity`-'$diao_row[quantity]' where `company1`='$_SESSION[company1]' and `productId`='$diao_row[productId]' and `roomId`='$diao_row[roomchuId]' and model='$diao_row[model]' and supplierId='$diao_row[supplierId]'";
			$db->query($sql);
		   if($cs>$i){
			   //调出商品在`rv_detail`表中存在时，更新表中的数据
			   $sql="update `rv_detail` set `curchuquantity`=`curchuquantity`+'$diao_row[quantity]' where `company1`='$_SESSION[company1]' and `productId`='$diao_row[productId]' and `roomId`='$diao_row[roomchuId]' and model='$diao_row[model]' and supplierId='$diao_row[supplierId]' and date=date_format(now(),'%Y-%c')";
			   $db->query($sql);
		   }else{
			   //否则将调出商品的数据插入表中
			   $sql="INSERT INTO `rv_detail` (`productId` ,`model`,`roomId` ,`supplierId`,`curchuquantity`,`date`,`company1`)
			   VALUES ('$diao_row[productId]','$diao_row[model]','$diao_row[roomchuId]','$diao_row[supplierId]','$diao_row[quantity]',date_format(now(),'%Y-%c'),'$_SESSION[company1]');";
			   $db->query($sql);
		   }
		echo success($msg);	
		exit;
		}else {
			echo error_diao($msg);//库存不足
		}	
	}else{
	//查找`rv_storage`表中是否有对应出库商品信息
	$sql1="select * from `rv_storage` where company1='$_SESSION[company1]' and productId='$row[productId]' and model='$row[model]' and supplierId='$row[supplierId]' and roomId='$row[roomId]'";
	$aa=mysql_query($sql1);
	$ts=mysql_num_rows($aa);
	$list_cun=mysql_fetch_assoc($aa);//查询一行
	$quantity_cun=$list_cun[quantity];
	$i=0;
	//销售模块
	if($ts>$i && ($leixing=="1"||$leixing=="3")){
	//判断`rv_storage`表中是否存在该产品，存在则修改数据，不存在提示不存在
		if($row[quantity] <= $quantity_cun){
			//通过productId查找商品名称
			$sql="select name from `rv_product` where id='$row[productId]'";
			$db->query($sql);
			$row2=$db->fetchRow();
			
			//搜索`rv_detail`表中是否有入库产品的信息
			$sql="select * from `rv_detail` where company1='$_SESSION[company1]' and productId='$row[productId]' and model='$row[model]' and supplierId='$row[supplierId]' and roomId='$row[roomId]' and date=date_format(now(),'%Y-%c')";
			$db->query($sql);
			$cc=mysql_query($sql);
			$qs=mysql_num_rows($cc);
		
			//修改出库表中judge字段为3
			$sql="update `rv_storage_chu` set `kuguanName`='$username',`chutime`=now(),`judge`=3 where id='{$id}'";
			$db->query($sql);
			if($leixing=="1"){
				//查询`rv_tongji`表中是否存在与插入数据的相同的数据
				$sql3="select name,date from `rv_tongji` where company1='$_SESSION[company1]' and `biaoshi`='配件销售' and name='$row2[name]' and date=date_format(now(),'%Y-%c-%d')";
				$m=mysql_query($sql3);
				$r=mysql_num_rows($m);
				if($r>0){
					//`rv_tongji`表中存在
					$sql4="update `rv_tongji` set `quantity`=`quantity`+'$row[quantity]',`money`=`money`+'$row[quantity]'*'$row[outprice]' where `biaoshi`='配件销售' and name='$row2[name]' and company1='$_SESSION[company1]'";
					$db->query($sql4);
				}else{
					//不存在则将数据添加到rv_tongji表中
					$sql5="insert into `rv_tongji` (`biaoshi`,`name`,`quantity`,`money`,`date`,`company1`) VALUES('配件销售','$row2[name]','$row[quantity]','$row[quantity]'*'$row[outprice]',date_format(now(),'%Y-%c-%d'),'$_SESSION[company1]');";
					$db->query($sql5);
				}
			}
			if($leixing=="3"){
				//购买设备
				//查找车辆的ID
				$sql6="select * from `rv_car` where company1='$_SESSION[company1]' and carNum='$row[carNum]'";
				$db->query($sql6);
				$car_row=$db->fetchRow();
				//查找设备表中的数据，判断是否属于重购
				$sql7="select * from `rv_device` where company1='$_SESSION[company1]' and carId='$car_row[id]'";
				$x=mysql_query($sql7);
				$y=mysql_num_rows($x);
				if($y>1){
				//重购设备
					//查询`rv_tongji`表中是否存在与插入数据的相同的数据
					$sql3="select name,date from `rv_tongji` where `company1`='$_SESSION[company1]' and `biaoshi`='重购' and name='$car_row[carleixing]' and date=date_format(now(),'%Y-%c-%d')";
					$m=mysql_query($sql3);
					$r=mysql_num_rows($m);
					if($r>0){
						//`rv_tongji`表中存在与插入数据的车辆类型、标识和日期相同的数据
						$sql4="update `rv_tongji` set `quantity`=`quantity`+1,`money`=`money`+'$row[outprice]' where `company1`='$_SESSION[company1]' and `biaoshi`='重购' and name='$car_row[carleixing]'";
						$db->query($sql4);
					}else{
						//不存在则将数据添加到rv_tongji表中
						$sql5="insert into `rv_tongji` (`biaoshi`,`name`,`quantity`,`money`,`date`,`company1`) VALUES('重购','$car_row[carleixing]',1,'$row[outprice]',date_format(now(),'%Y-%c-%d'),'$_SESSION[company1]');";
						$db->query($sql5);
					}
				}else{//新安设备
					//查询`rv_tongji`表中是否存在与插入数据的相同的数据
					$sql3="select name,date from `rv_tongji` where `company1`='$_SESSION[company1]' and `biaoshi`='新安' and name='$car_row[carleixing]' and date=date_format(now(),'%Y-%c-%d')";
					$m=mysql_query($sql3);
					$r=mysql_num_rows($m);
					if($r>0){
						//`rv_tongji`表中存在与插入数据的车辆类型、标识和日期相同的数据
						$sql4="update `rv_tongji` set `quantity`=`quantity`+1,`money`=`money`+'$row[outprice]' where `company1`='$_SESSION[company1]' and `biaoshi`='新安' and name='$car_row[carleixing]'";
						$db->query($sql4);
					}else{
						//不存在则将数据添加到rv_tongji表中
						$sql5="insert into `rv_tongji` (`biaoshi`,`name`,`quantity`,`money`,`date`,`company1`) VALUES('新安','$car_row[carleixing]',1,'$row[outprice]',date_format(now(),'%Y-%c-%d'),'$_SESSION[company1]');";
						$db->query($sql5);
					}
				}
			}
			//修改库存表相应商品的数量
			$sql="update `rv_storage` set `quantity`=`quantity`-'$row[quantity]' where company1='$_SESSION[company1]' and productId='$row[productId]' and model='$row[model]' and supplierId='$row[supplierId]' and `roomId`='$row[roomId]'";
			$db->query($sql);
			if($qs>0){
				//`rv_detail`表中有该产品信息,修改表中的数据
				$sql="update `rv_detail` set `curchuquantity`= `curchuquantity`+'$row[quantity]',`shouquantity`=`shouquantity`+'$row[shouquantity]' where company1='$_SESSION[company1]' and productId='$row[productId]' and model='$row[model]' and supplierId='$row[supplierId]' and roomId='$row[roomId]' and date=date_format(now(),'%Y-%c')";
				$db->query($sql);
			}else{
				//`rv_detail`表中不存在该产品信息,将新增的产品入库数量插入
				$sql="INSERT INTO `rv_detail` (`productId` ,`model`,`supplierId`,`roomId` ,`curchuquantity`,`shouquantity`,`company1`,`date`)
				VALUES ('$row[productId]','$row[model]','$row[supplierId]','$row[roomId]','$row[quantity]','$row[shouquantity]','$_SESSION[company1]',date_format(now(),'%Y-%c'));";
				$db->query($sql);
			}
		echo success($msg);	
		exit;
		}else {
			echo error_xiao($msg);//库存不足
		}
	}else{
		echo error_no($msg);//库房中没有该商品，不能销售
	}
	
	}
}

?>