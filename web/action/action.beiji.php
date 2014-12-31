<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
    If_rabc($action,$do); //检测权限	
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}
	if($_POST['beichaidate']){$search .= " and (date_format(beichaidate,'%Y-%m') = '$_POST[beichaidate]' or beichaidate='')";}
	$date=$_POST['beichaidate'];
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
	$sql="SELECT rv_beiji.id,company,rv_beiji.carNum,chaidate,chaipeople,agreement,agreedate,deposit,beichaidate,rv_beiji.model,rv_beiji.beizhu from `rv_beiji` where company1 in ($arr2) $search";
	$info_num=mysql_query($sql);
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT rv_beiji.id,company1,company,rv_beiji.carNum,chaidate,chaipeople,agreement,agreedate,deposit,beichaidate,rv_beiji.model,rv_beiji.beizhu from `rv_beiji` where company1 in ($arr2) $search order by rv_beiji.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('date',$date);
	$smt->assign('total',$total);
	$smt->assign('title',"备机使用协议"); 
	$smt->display('beiji_list.htm');
	exit;	
}


//新增检修终端信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('beiji_new.htm');
	exit;
}

//写入检修终端信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$sql="select * from `rv_car` where company1='$_SESSION[company1]' and carNum ='$_POST[carNum]'";
	$aa=mysql_query($sql);
	$bb=mysql_num_rows($aa);
	$row=mysql_fetch_assoc($aa);
	if($bb>0){
		$sql="INSERT INTO `rv_beiji` (`company` ,`carNum` ,`chaidate` ,`chaipeople`,`agreement`,`agreedate`,`deposit`,`model`,`beizhu`,`company1`)
		VALUES ('$row[company]','$_POST[carNum]','$_POST[chaidate]','$_POST[chaipeople]','$_POST[agreement]','$_POST[agreedate]','$_POST[deposit]','$_POST[model]','$_POST[beizhu]','$_SESSION[company1]');";
		$db->query($sql);
		$sql="update `rv_client` set `chaidate`='$_POST[chaidate]',`beibeizhu`='$_POST[beizhu]' where carNum='$_POST[carNum]' and company1='$_SESSION[company1]'";
		if($db->query($sql)){echo close($msg,"beiji");}else{echo error($msg);}
	}else{
		echo error_car($msg);
	}
	exit;
}

if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_beiji`");
	$smt = new smarty();smarty_cfg($smt);
	$sql="select * from `rv_beiji` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->display('beiji_edit.htm');
	exit;
}

if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_beiji`");
	$sql="update `rv_beiji` set `beichaidate`='$_POST[beichaidate]',`beizhu`='$_POST[beizhu]' where `id`='$_POST[id]'";
	$db->query($sql);
	$sql="update `rv_client` set `beichaidate`='$_POST[beichaidate]',`beibeizhu`='$_POST[beizhu]' where carNum='$_POST[carNum]' and company1='$_SESSION[company1]'";
	if($db->query($sql)){echo close($msg,"beiji");}else{echo error($msg);}	
	exit;
}

//导出excle表格
if($do=="print"){
    If_rabc($action,$do); //检测权限
	if($date){
		$search .= " and (date_format(beichaidate,'%Y-%m') = '$date' or beichaidate='')";
	}else{
		$search .=" and (DATE_FORMAT(beichaidate,'%Y-%c')=DATE_FORMAT(now(),'%Y-%c') or beichaidate='')";
	}
	$sql="select * from rv_beiji where company1='$_SESSION[company1]' $search order by rv_beiji.id desc";
	$db->query($sql);
	$list=$db->fetchAll();
	header("Content-Type: application/vnd.ms-excel;charset=utf-8");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk","备机使用协议").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>公司名称</th>";
	echo "<th>车牌号</th>";
	echo "<th>拆取日期</th>";
	echo "<th>拆取人</th>";
	echo "<th>备机协议编号</th>";
	echo "<th>备机协议日期</th>";
	echo "<th>押金</th>";
	echo "<th>备机拆取日期</th>";
	echo "<th>设备型号</th>";
	echo "<th>备注</th>";
	echo "</tr>";
	echo "<tr align=center>";
	foreach($list as $key=>$val){
		echo "<td>".$val[id]."</td>";
		echo "<td>".$val[company]."</td>";
		echo "<td>".$val[carNum]."</td>";
		if($val[chaidate]!=0){echo "<td>".$val[chaidate]."</td>";}else {echo "<td></td>";}
		echo "<td>".$val[chaipeople]."</td>";
		echo "<td>".$val[agreement]."</td>";
		if($val[agreedate]!=0){echo "<td>".$val[agreedate]."</td>";}else {echo "<td></td>";}
		if($val[deposit]!=0){echo "<td>".$val[deposit]."</td>";}else {echo "<td></td>";}
		if($val[beichaidate]!=0){echo "<td>".$val[beichaidate]."</td>";}else {echo "<td></td>";}
		echo "<td>".$val[model]."</td>";
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