<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
    If_rabc($action,$do); //检测权限	
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}//对应原则
	if($_POST['baoxiuqi']){$search .= " and baoxiuqi = '$_POST[baoxiuqi]'";}
	if($_POST['jianxiufei']){$search .= " and jianxiufei = '$_POST[jianxiufei]'";}
	if($_POST['andate']){$search .= " and (date_format(andate,'%Y-%m') = '$_POST[andate]' or andate='')";}
	$date=$_POST['andate'];
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
	$info_num=mysql_query("SELECT * from `rv_repair` where company1 in ($arr2) $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT * from `rv_repair` where company1 in ($arr2) $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('repair_list.htm');
	exit;	
}


//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('repair_new.htm');
	exit;
}


//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$sql="select * from `rv_car` where company1='$_SESSION[company1]' and carNum ='$_POST[carNum]'";
	$aa=mysql_query($sql);
	$bb=mysql_num_rows($aa);
	$row=mysql_fetch_assoc($aa);
	if($bb>0){
		$sql="INSERT INTO `rv_repair` (`company` ,`carNum` ,`model` ,`chaidate`,`changdate`,`huidate`,`andate`,`baoxiuqi`,`jianxiufei`,`chaipeople`,`beizhu`,`company1`)
		VALUES ('$row[company]','$_POST[carNum]','$_POST[model]','$_POST[chaidate]','$_POST[changdate]','$_POST[huidate]','$_POST[andate]','$_POST[baoxiuqi]','$_POST[jianxiufei]','$_POST[chaipeople]','$_POST[beizhu]','$_SESSION[company1]');";
		$db->query($sql);
		$sql="update `rv_client` set `terminalchaidate`='$_POST[chaidate]',`terminalandate`='$_POST[andate]' where carNum='$_POST[carNum]' and company1='$_SESSION[company1]'";
		if($db->query($sql)){echo close($msg,"repair");}else{echo error($msg);}
	}else{
		echo error_car($msg);
	}
	exit;
}

if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_repair`");
	$smt = new smarty();smarty_cfg($smt);
	$sql="select * from `rv_repair` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->display('repair_edit.htm');
	exit;
}

if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_repair`");
	$sql="update `rv_repair` set `chaidate`='$_POST[chaidate]',`changdate`='$_POST[changdate]',`huidate`='$_POST[huidate]',`andate`='$_POST[andate]',`baoxiuqi`='$_POST[baoxiuqi]',`jianxiufei`='$_POST[jianxiufei]',`chaipeople`='$_POST[chaipeople]',`beizhu`='$_POST[beizhu]' where `id`='$_POST[id]' LIMIT 1";
	$db->query($sql);
	$sql="update `rv_client` set `terminalchaidate`='$_POST[chaidate]',`terminalandate`='$_POST[andate]' where carNum='$_POST[carNum]' and company1='$_SESSION[company1]'";
	if($db->query($sql)){echo close($msg,"repair");}else{echo error($msg);}	
	exit;
}

//导出excle表格
if($do=="print"){
    If_rabc($action,$do); //检测权限
	if($date){
		$search .= " and (date_format(andate,'%Y-%m') = '$date' or andate='')";
	}else{
		$search .=" and (DATE_FORMAT(andate,'%Y-%c')=DATE_FORMAT(now(),'%Y-%c') or andate='')";
	}
	$sql="SELECT * from `rv_repair` where company1='$_SESSION[company1]' $search order by id desc";
	$db->query($sql);
	$list=$db->fetchAll();
	header("Content-Type: application/vnd.ms-excel;charset=utf-8");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk","返厂终端收取检修费").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>公司名称</th>";
	echo "<th>车牌号</th>";
	echo "<th>型号</th>";
	echo "<th>拆取日期</th>";
	echo "<th>返厂日期</th>";
	echo "<th>返回日期</th>";
	echo "<th>安装日期</th>";
	echo "<th>是否过保修期</th>";
	echo "<th>是否收取检修费</th>";
	echo "<th>拆取人</th>";
	echo "<th>备注</th>";
	echo "</tr>";
	echo "<tr align=center>";
	foreach($list as $key=>$val){
		echo "<td>".$val[id]."</td>";
		echo "<td>".$val[company]."</td>";
		echo "<td>".$val[carNum]."</td>";
		echo "<td>".$val[model]."</td>";
		if($val[chaidate]!=0){echo "<td>".$val[chaidate]."</td>";}else {echo "<td></td>";}
		if($val[changdate]!=0){echo "<td>".$val[changdate]."</td>";}else {echo "<td></td>";}
		if($val[huidate]!=0){echo "<td>".$val[huidate]."</td>";}else {echo "<td></td>";}
		if($val[andate]!=0){echo "<td>".$val[andate]."</td>";}else {echo "<td></td>";}
		echo "<td>".$val[baoxiuqi]."</td>";
		echo "<td>".$val[jianxiufei]."</td>";
		echo "<td>".$val[chaipeople]."</td>";
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