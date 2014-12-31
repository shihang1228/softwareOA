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
	if($_POST['carNum']){$search .= " and a.carNum like '%$_POST[carNum]%'";}
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
	//先查询judge等于多少，如果judge=1， inputer=""空，
	//查询
	$sql1="SELECT a.id,danhao,financeName,e.chejiaNum,rv_sim_sto.cardnum,date_format(now(),'%Y-%c-%d') as time,a.carNum,left(a.carNum,7) as chehao,a.judge,a.quantity,a.outprice,a.shouquantity,a.checktime ,a.model,c.name as pname,e.company,b.name as rname,d.name as sname,a.quantity*a.outprice as heji,a.shouquantity*a.outprice as shouheji FROM `rv_storage_chu` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d,`rv_car` as e,`rv_sim_sto` 
	where a.company1 in ($arr2) and a.leixing in(1,3) and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.carNum=e.carNum $search";
	$info_num=mysql_query($sql1);//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT a.id,danhao,financeName,e.chejiaNum,rv_sim_sto.cardnum,date_format(now(),'%Y-%c-%d') as time,a.carNum,left(a.carNum,7) as chehao,a.judge,a.quantity,a.outprice,a.shouquantity,a.checktime ,a.model,c.name as pname,e.company,b.name as rname,d.name as sname,a.quantity*a.outprice as heji,a.shouquantity*a.outprice as shouheji, a.company1 FROM `rv_storage_chu` as a, `rv_room` as b,`rv_product` as c,`rv_supplier` as d,`rv_car` as e,rv_sim_sto
	where a.company1 in ($arr2) and a.leixing in(1,3) and a.productId=c.id and a.roomId=b.id and a.supplierId=d.id and a.carNum=e.carNum $search order by a.id desc LIMIT $pageNum,$numPerPage";
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
	$smt->display('finance_list.htm');
	exit;	
}



//写入维护信息
if($do=="sure"){
	If_rabc1($action,$do);	//检测权限
	If_comrabc($id,"`rv_storage_chu`");
	$username=$_SESSION['username'];
	//修改出库表中judge字段为2
	$sql="update `rv_storage_chu` set `financeName`='$username',`checktime`=now(),`judge`=2 where id='{$id}'";
	$db->query($sql);
	echo success($msg);
	exit;
}

?>