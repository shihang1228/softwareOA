<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 


	 //查询
	$sql="SELECT id,carstate FROM `rv_carstate` where company1='$_SESSION[company1]'";
	$db->query($sql);
	$carstate_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($carstate_arr as $key=>$val){
		$carstate_list[$carstate_arr[$key][id]] = $carstate_arr[$key][carstate];	//车辆状态数组		
	}

	//查询公司
	$sql="select company from `rv_company` where company1 in ($arr2)";
	$db->query($sql);
	$com_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($com_arr as $key=>$val){
		$company_list[$com_arr[$key][company]] = $com_arr[$key][company];	//公司数组		
	}
	//查询车辆类型
	$sql="select leixing from `rv_carleixing`";
	$db->query($sql);
	$leixing_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($leixing_arr as $key=>$val){
		$leixing_list[$leixing_arr[$key][leixing]] = $leixing_arr[$key][leixing];	//车辆类型		
	}
	//查询平台
	$sql="select id,platform from `rv_platform` where company1 in ($arr2)";
	$db->query($sql);
	$platform_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($platform_arr as $key=>$val){
		$platform_list[$platform_arr[$key][platform]] = $platform_arr[$key][platform];	//平台数组		
	}
	
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['company']){$search .= " and name like '%$_POST[company]%'";}
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}
	if($_POST['carleixing']){$search .= " and carleixing like '%$_POST[carleixing]%'";}
	if($_POST['carstateId']){$search .= " and carstateId='$_POST[carstateId]'";}
	if($_POST['platform']){$search .= " and platform like '%$_POST[platform]%'";}
	if($_POST['doubledevice']){$search .= " and doubledevice like '%$_POST[doubledevice]%'";}
	if($_POST['zhuanfa']){$search .= " and zhuanfa like '%$_POST[zhuanfa]%'";}
	if($_POST['fwjzdate']){$search .= " and date_format(date_sub(fwjzdate,INTERVAL 1 month),'%Y-%c') = '$_POST[fwjzdate]'";}
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
	
	//查询出厂未自带设备
	$sql1="SELECT rv_client.*,date_format(date_sub(fwjzdate,INTERVAL 1 month),'%Y-%c') as a,carstate FROM `rv_client`,`rv_carstate` where rv_client.company1 in ($arr2) and rv_client.carstateId=rv_carstate.id $search";
	$info_num=mysql_query($sql1);
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT rv_client.*,date_format(date_sub(fwjzdate,INTERVAL 1 month),'%Y-%c') as a,carstate,rv_client.company1 FROM `rv_client`,`rv_carstate` where rv_client.company1 in ($arr2) and rv_client.carstateId=rv_carstate.id $search order by rv_client.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('search',$search);	
	$smt->assign('company_cn',select($company_list,"company","","请选择"));
	$smt->assign('carstateId_cn',select($carstate_list,"carstateId","","请选择"));
	$smt->assign('carleixing_cn',select($leixing_list,"carleixing","","请选择"));
	$smt->assign('platform_cn',select($platform_list,"platform","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	//$smt->assign('title',"客户列表");
	$smt->display('carinfo_list.htm');
	exit;	
}



//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_client`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `rv_client` where id='{$id}' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('title',"编辑");
	$smt->display('carinfo_edit.htm');
	exit;
}
//更新(修改备注，串号等)
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_client`");	
	if($_POST[id]){$id=$_POST[id];}
	else{$id=$_SESSION[id];}
	//sql
	$sql="UPDATE `rv_client` SET 
	`beizhu` = '$_POST[beizhu]'
	WHERE `rv_client`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"carinfo");}else{echo error($msg);}	
	exit;
}

if($do=="print"){
	If_rabc($action,$do); //检测权限
	/* $search2 = iconv("gbk","utf-8",$search);
	$search1 = str_replace("\\","",$search2); */
	$sql="SELECT rv_client.*,carstate FROM `rv_client`,`rv_carstate` where rv_client.company1='$_SESSION[company1]' and rv_client.carstateId=rv_carstate.id $_POST[search] order by rv_client.id desc";
	$db->query($sql);
	$list=$db->fetchAll();
	header("Content-Type: application/vnd.ms-excel;charset=utf-8");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk","车辆信息汇总表").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>公司名称</th>";
	echo "<th>车辆类型</th>";
	echo "<th>车牌号</th>";
	echo "<th>车架号</th>";
	echo "<th>平台</th>";
	echo "<th>车辆状态</th>";
	echo "<th>备注</th>";
	echo "<th>SIM卡号</th>";
	echo "<th>状态</th>";
	echo "<th>卡状态变更日期</th>";
	echo "<th>安装日期</th>";
	echo "<th>安装人员</th>";
	echo "<th>资费</th>";
	echo "<th>运管审验日期</th>";
	echo "<th>运管金额</th>";
	echo "<th>车管审验日期</th>";
	echo "<th>车管金额</th>";
	echo "<th>总金额</th>";
	echo "<th>服务费交至日期</th>";
	echo "<th>行车证审验日期</th>";
	echo "<th>合同编号</th>";
	echo "<th>设备名称</th>";
	echo "<th>设备型号</th>";
	echo "<th>设备厂家</th>";
	echo "<th>设备金额</th>";
	echo "<th>线路</th>";
	echo "<th>备机安装日期</th>";
	echo "<th>备机拆取日期</th>";
	echo "<th>备注备机</th>";
	echo "<th>终端拆取日期</th>";
	echo "<th>终端安装日期</th>";
	echo "<th>联系人</th>";
	echo "<th>联系电话</th>";
	echo "</tr>";
	echo "<tr align=center>";
	foreach($list as $key=>$val){
		echo "<td>".$val[id]."</td>";
		echo "<td>".$val[name]."</td>";
		echo "<td>".$val[carleixing]."</td>";
		echo "<td>".$val[carNum]."</td>";
		echo "<td>".$val[chejiaNum]."</td>";
		echo "<td>".$val[platform]."</td>";
		echo "<td>".$val[carstate]."</td>";
		echo "<td>".$val[beizhu]."</td>";
		echo "<td>".$val[simNum]."</td>";
		echo "<td>".$val[simstate]."</td>";
		if($val[changedate]!=0){echo "<td>".$val[changedate]."</td>";}else{echo "<td></td>";}
		if($val[installdate]!=0){echo "<td>".$val[installdate]."</td>";}else{echo "<td></td>";}
		echo "<td>".$val[installperson]."</td>";
		echo "<td>".$val[zifei]."</td>";
		if($val[yundate]!=0){echo "<td>".$val[yundate]."</td>";}else{echo "<td></td>";}
		if($val[yunmoney]!=0){echo "<td>".$val[yunmoney]."</td>";}else{echo "<td></td>";}
		if($val[chedate]!=0){echo "<td>".$val[chedate]."</td>";}else{echo "<td></td>";}
		if($val[chemoney]!=0){echo "<td>".$val[chemoney]."</td>";}else{echo "<td></td>";}
		if($val[money]!=0){echo "<td>".$val[money]."</td>";}else{echo "<td></td>";}
		if($val[fwjzdate]!=0){echo "<td>".$val[fwjzdate]."</td>";}else{echo "<td></td>";}
		if($val[zhengdate]!=0){echo "<td>".$val[zhengdate]."</td>";}else{echo "<td></td>";}
		echo "<td>".$val[danhao]."</td>";
		echo "<td>".$val[deviceName]."</td>";
		echo "<td>".$val[model]."</td>";
		echo "<td>".$val[factory]."</td>";
		echo "<td>".$val[devicemoney]."</td>";
		echo "<td>".$val[xianlu]."</td>";
		echo "<td>".$val[chaidate]."</td>";
		echo "<td>".$val[beichaidate]."</td>";
		echo "<td>".$val[beibeizhu]."</td>";
		echo "<td>".$val[terminalchaidate]."</td>";
		echo "<td>".$val[terminalandate]."</td>";
		echo "<td>".$val[linkname]."</td>";
		echo "<td>".$val[tel]."</td>";
		echo "</tr>";
		echo "<tr align=center>";
	}
	echo "</tr>";
	echo "</table>";
	//结束函数并返回true  
	return (true);
}

?>