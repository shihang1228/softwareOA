<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}
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
	$sql1="SELECT `rv_shenyan`.*,rv_car.carNum,left(rv_car.carNum,7) as chehao,rv_car.company,date_format(now(),'%Y-%c-%d') as time,date_format(rv_client.fwjzdate,'%Y-%c') as fwjz,date_format(rv_shenyan.yundate,'%Y-%c') as yun,date_format(rv_shenyan.chedate,'%Y-%c') as che,rv_car.chejiaNum,rv_car.carleixing from `rv_shenyan`,`rv_car`,`rv_client` where rv_shenyan.company1 in ($arr2) and rv_shenyan.carId=rv_car.id and rv_car.carNum=rv_client.carNum $search";
	$info_num=mysql_query($sql1);//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	//先查询judge等于多少，如果judge=1， inputer=""空，
	//查询
	$sql1="SELECT `rv_shenyan`.*,rv_car.carNum,left(rv_car.carNum,7) as chehao,rv_car.company,date_format(now(),'%Y-%c-%d') as time,date_format(rv_client.fwjzdate,'%Y-%c') as fwjz,date_format(rv_shenyan.yundate,'%Y-%c') as yun,date_format(rv_shenyan.chedate,'%Y-%c') as che,rv_car.chejiaNum,rv_car.carleixing,rv_shenyan.company1 from `rv_shenyan`,`rv_car`,`rv_client` where rv_shenyan.company1 in ($arr2) and rv_shenyan.carId=rv_car.id and rv_car.carNum=rv_client.carNum $search order by rv_shenyan.id desc LIMIT $pageNum,$numPerPage";	
	$db->query($sql1);
	$list=$db->fetchAll();

	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('yunshen',$yunshen);	
	$smt->assign('cheshen',$cheshen);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('shencheck_list.htm');
	exit;	
}

if($do=="sureyun1"){
	//确认收款
	If_rabc1($action,$do);
	If_comrabc($id,"`rv_shenyan`");	
	$username=$_SESSION['username'];
	$sql="update `rv_shenyan` set `checkpeople`='$username',`judgeyun`=3,`judgepryun`=2 where id='{$id}'";
	$db->query($sql);
	//查找id对应的车辆类型
	$sql2="select rv_car.carleixing,rv_shenyan.yunmoney from `rv_shenyan`,`rv_car` where rv_shenyan.id='{$id}' and rv_shenyan.carId=rv_car.id";
	$db->query($sql2);
	$shen_row=$db->fetchRow();
	//查询`rv_tongji`表中是否存在与插入数据的车辆类型、标识和日期相同的数据
	$sql3="select name,date from `rv_tongji` where company1='$_SESSION[company1]' and `biaoshi`='运管审验' and name='$shen_row[carleixing]' and date=date_format(now(),'%Y-%c-%d')";
	$m=mysql_query($sql3);
	$r=mysql_num_rows($m);
	if($r>0){
		//`rv_tongji`表中存在与插入数据的车辆类型、标识和日期相同的数据
		$sql4="update `rv_tongji` set `quantity`=`quantity`+1,`money`=`money`+'$shen_row[yunmoney]' where company1='$_SESSION[company1]' and `biaoshi`='运管审验' and name='$shen_row[carleixing]'";
		$db->query($sql4);
	}else{
		//不存在则将数据添加到rv_tongji表中
		$sql5="insert into `rv_tongji` (`biaoshi`,`name`,`quantity`,`money`,`date`,`company1`) VALUES('运管审验','$shen_row[carleixing]',1,'$shen_row[yunmoney]',date_format(now(),'%Y-%c-%d'),'$_SESSION[company1]');";
		$db->query($sql5);
	}
	echo success($msg);
	exit;
}

if($do=="sureche1"){
	//确认收款
	If_rabc1($action,$do);
	If_comrabc($id,"`rv_shenyan`");
	$username=$_SESSION['username'];
	$sql="update `rv_shenyan` set `checkpeople`='$username',`judgeche`=3,`judgeprche`=2 where id='{$id}'";
	$db->query($sql);
	//查找id对应的车辆类型
	$sql2="select rv_car.carleixing,rv_shenyan.chemoney from `rv_shenyan`,`rv_car` where rv_shenyan.id='{$id}' and rv_shenyan.carId=rv_car.id";
	$db->query($sql2);
	$shen_row=$db->fetchRow();
	//查询`rv_tongji`表中是否存在与插入数据的车辆类型、标识和日期相同的数据
	$sql3="select name,date from `rv_tongji` where `company1`='$_SESSION[company1]' and `biaoshi`='车管审验' and name='$shen_row[carleixing]' and date=date_format(now(),'%Y-%c-%d')";
	$m=mysql_query($sql3);
	$r=mysql_num_rows($m);
	if($r>0){
		//`rv_tongji`表中存在与插入数据的车辆类型、标识和日期相同的数据
		$sql4="update `rv_tongji` set `quantity`=`quantity`+1,`money`=`money`+'$shen_row[chemoney]' where `company1`='$_SESSION[company1]' and `biaoshi`='车管审验' and name='$shen_row[carleixing]'";
		$db->query($sql4);
	}else{
		//不存在则将数据添加到rv_tongji表中
		$sql5="insert into `rv_tongji` (`biaoshi`,`name`,`quantity`,`money`,`date`,`company1`) VALUES('车管审验','$shen_row[carleixing]',1,'$shen_row[chemoney]',date_format(now(),'%Y-%c-%d'),'$_SESSION[company1]');";
		$db->query($sql5);
	} 
	
	echo success($msg);
	exit;
}

?>