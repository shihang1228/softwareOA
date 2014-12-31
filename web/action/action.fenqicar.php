<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 


	//查询公司
	$sql="select company from `rv_car` where fenqi='是' and company1 in ($arr2) group by company";
	$db->query($sql);
	$com_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($com_arr as $key=>$val){
		$company_list[$com_arr[$key][company]] = $com_arr[$key][company];	//公司数组		
	}
	
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	if($_POST['carNum']){$search .= " and carNum = '$_POST[carNum]'";}	
	if($_POST['company']){$search .= " and company = '$_POST[company]'";}
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
	$sql1="SELECT rv_fenqicar.id,carId,carNum,sum(getmoney) as money,totalmoney,repaydate,totalyear,(totalmoney-sum(getmoney)) as lastmoney, beizhu,rv_fenqicar.judge FROM `rv_fenqicar`,`rv_car` where carId=rv_car.id and rv_fenqicar.company1 in ($arr2) $search group by carId order by rv_fenqicar.id asc";
	$info_num=mysql_query($sql1);//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT rv_fenqicar.id,carId,carNum,rv_car.company,sum(getmoney) as money,totalmoney,repaydate,totalyear,(totalmoney-sum(getmoney)) as lastmoney, beizhu,rv_fenqicar.judge,rv_fenqicar.company1 FROM `rv_fenqicar`,`rv_car` where carId=rv_car.id and rv_fenqicar.company1 in ($arr2) $search group by carId order by rv_fenqicar.id asc LIMIT $pageNum,$numPerPage";	
	$db->query($sql);
	$list=$db->fetchAll();

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('search',$search);	
	$smt->assign('company_cn',select($company_list,"company","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('fenqicar_list.htm');
	exit;	
}

//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('fenqicar_new.htm');
	exit;
}


//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	//查找车牌号对应的id
	$sql1="select id from `rv_car` where carNum='$_POST[carNum]' and company1='$_SESSION[company1]'";
	$db->query($sql1);
	$id_row=$db->fetchRow();
	$sql2="INSERT INTO `rv_fenqicar` (`carId`,`getmoney`,`truedate`,`beizhu`,`company1` )
	VALUES ('$id_row[id]','$_POST[getmoney]',now(),'$_POST[beizhu]','$_SESSION[company1]');";
	if($db->query($sql2)){echo close($msg,"fenqicar");}else{echo error($msg);}
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_fenqicar`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT rv_fenqicar.*,carNum FROM `rv_fenqicar`,`rv_car` where rv_fenqicar.id='{$id}' and rv_car.id=carId LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->display('fenqicar_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_fenqicar`");	
	if($_POST[id]){$id=$_POST[id];}
	else{$id=$_SESSION[id];}
	//sql
	$sql="UPDATE `rv_fenqicar` SET 
	`getmoney` = '$_POST[getmoney]',
	`repaydate` = '$_POST[repaydate]',
	`totalmoney` = '$_POST[totalmoney]',
	`totalyear` = '$_POST[totalyear]',
	`truedate` = now(),
	`judge` = 2,
	`beizhu` = '$_POST[beizhu]'
	WHERE `rv_fenqicar`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"fenqicar");}else{echo error($msg);}	
	exit;
}

if($do=="show"){
	If_rabc($action,$do); //检测权限	
	$sql1="select carId from `rv_fenqicar` where id='{$id}'";
	$db->query($sql1);
	$row1=$db->fetchRow();
	$sql2="select rv_fenqicar.id,getmoney,rv_fenqicar.truedate,beizhu,carNum from `rv_fenqicar`,`rv_car` where rv_fenqicar.carId='$row1[carId]' and rv_car.id='$row1[carId]' and rv_fenqicar.company1='$_SESSION[company1]'";
	$db->query($sql2);
	$list=$db->fetchAll();
	$smt = new smarty();smarty_cfg($smt);
	//模版
	$smt->assign('list',$list);
	$smt->assign('title',"明细");
	$smt->display('fenqicar_show.htm');
	exit;
}

if($do=="print"){
	If_rabc($action,$do); //检测权限
	//$search1 = str_replace("\\","",$search);	
	$sql="SELECT rv_fenqicar.id,carId,rv_car.company,carNum,sum(getmoney) as money,totalmoney,repaydate,totalyear,(totalmoney-sum(getmoney)) as lastmoney, beizhu,rv_fenqicar.judge FROM `rv_fenqicar`,`rv_car` where carId=rv_car.id and rv_fenqicar.company1='$_SESSION[company1]' $_POST[search] group by carId order by rv_fenqicar.id asc;";	
	$db->query($sql);
	$list=$db->fetchAll();
	header("Content-Type: application/vnd.ms-excel;charset=utf-8");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk","分期付款车辆信息表").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th width='50'>ID</th>";
	echo "<th width='200'>公司名称</th>";
	echo "<th width='120'>车牌号</th>";
	echo "<th width='120'>已还金额</th>";
	echo "<th width='100'>还款月份</th>";
	echo "<th width='150'>总金额</th>";
	echo "<th width='150'>总年限</th>";
	echo "<th width='80'>剩余金额</th>";
	echo "<th width='150'>备注</th>";
	echo "</tr>";
	echo "<tr align=center>";
	foreach($list as $key=>$val){
		echo "<td>".$val[id]."</td>";
		echo "<td>".$val[company]."</td>";
		echo "<td>".$val[carNum]."</td>";
		if($val[money]!=0){echo "<td>".$val[money]."</td>";}else{echo "<td></td>";}
		if($val[repaydate]!=0){echo "<td>".$val[repaydate]."</td>";}else{echo "<td></td>";}
		if($val[totalmoney]!=0){echo "<td>".$val[totalmoney]."</td>";}else{echo "<td></td>";}
		echo "<td>".$val[totalyear]."</td>";
		if($val[lastmoney]){echo "<td>".$val[lastmoney]."</td>";}else{echo "<td></td>";}
		echo "<td>".$val[beizhu]."</td>";
		echo "</tr>";
		echo "<tr align=center>";
	}
	echo "</tr>";
	echo "</table>";
	//结束函数并返回true  
	return (true);
}
?>