<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	//判断检索值
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}
	if($_POST['inputer']){$search .= " and inputer like '%$_POST[inputer]%'";}
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
	$sql1="select rv_fee.id,rv_car.carNum,left(rv_car.carNum,7) as chehao,money,financeName,checktime,rv_car.company,rv_car.chejiaNum,date_format(now(),'%Y-%c-%d') as time,rv_fee.judge,name from `rv_fee`,`rv_feetype`,`rv_car` where rv_fee.company1 in ($arr2) and feetypeId=rv_feetype.id and rv_fee.carNum=rv_car.carNum $search";
	$info_num=mysql_query($sql1);//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="select rv_fee.id,rv_car.carNum,left(rv_car.carNum,7) as chehao,money,financeName,checktime,rv_car.company,rv_car.chejiaNum,date_format(now(),'%Y-%c-%d') as time,rv_fee.judge,name,rv_fee.company1 from `rv_fee`,`rv_feetype`,`rv_car` where rv_fee.company1 in ($arr2) and feetypeId=rv_feetype.id and rv_fee.carNum=rv_car.carNum $search order by rv_fee.id asc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	 
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"产品列表");
	$smt->display('fuwucheck_list.htm');
	exit;	
}

$sql="SELECT id,name FROM `rv_feetype`where company1='$_SESSION[company1]'";
$db->query($sql);
$list=$db->fetchAll();
 //格式化输出数据
foreach($list as $key=>$val){
	$feetype_list[$list[$key][id]] = $list[$key][name];	//费用类别数组		
} 

if($do=="sure"){
	If_rabc1($action,$do);	//检测权限
	If_comrabc($id,"`rv_fee`");
	$username=$_SESSION['username'];
	//修改出库表中judge字段为2
	$sql="update `rv_fee` set `financeName`='$username',`checktime`=now(),`judge`=2 where id='{$id}'";
	$db->query($sql);
	
	$sql1="select rv_feetype.name,rv_fee.money from `rv_feetype`,`rv_fee` where rv_feetype.company1='$_SESSION[company1]' and rv_feetype.id = rv_fee.feetypeId and rv_fee.id='{$id}'";
	$db->query($sql1);
	$row=$db->fetchRow();
	//查询`rv_tongji`表中是否存在与插入数据相同的数据
	$sql3="select name,date from `rv_tongji` where `company1`='$_SESSION[company1]' and `biaoshi`='费用' and name='$row[name]' and date=date_format(now(),'%Y-%c-%d')";
	$m=mysql_query($sql3);
	$r=mysql_num_rows($m);
	if($r>0){
		//`rv_tongji`表中存在
		$sql4="update `rv_tongji` set `quantity`=`quantity`+1,`money`=`money`+'$row[money]' where `company1`='$_SESSION[company1]' and `biaoshi`='费用' and name='$row[name]'";
		$db->query($sql4);
	}else{
		//不存在则将数据添加到rv_tongji表中
		$sql5="insert into `rv_tongji` (`biaoshi`,`name`,`quantity`,`money`,`date`,`company1`) VALUES('费用','$row[name]','1','$row[money]',date_format(now(),'%Y-%c-%d'),'$_SESSION[company1]');";
		$db->query($sql5);
	}
	echo success($msg);
	exit;
}


?>