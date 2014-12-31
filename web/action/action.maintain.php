<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 


//列表	
if($do==""){
    If_rabc($action,$do); //检测权限	
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}//对应原则
	if($_POST['backdate']){$search .= " and (date_format(backdate,'%Y-%m') = '$_POST[backdate]' or backdate='')";}
	if($_POST['fromcity']){$search .= " and fromcity like '%$_POST[fromcity]%'";}//对应原则
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
	$info_num=mysql_query("SELECT * from `rv_maintain` where company1 in ($arr2) $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT rv_maintain.*,name,rv_maintain.company1 from `rv_maintain`,`rv_supplier` where supplierId=rv_supplier.id and rv_maintain.company1 in ($arr2) $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('search',$search);	
	$smt->assign('supplierId_cn',select($supplier_list,"supplierId","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('maintain_list.htm');
	exit;	
}


//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('supplierId_cn',select($supplier_list,"supplierId","","请选择"));
	$smt->assign('title',"新增");
	$smt->display('maintain_new.htm');
	exit;
}


//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$sql="select * from `rv_car` where company1='$_SESSION[company1]' and carNum ='$_POST[carNum]' and company='$_POST[company]'";
	$aa=mysql_query($sql);
	$bb=mysql_num_rows($aa);
	$row=mysql_fetch_assoc($aa);
	if($bb>0){
		$sql="INSERT INTO `rv_maintain` (`company`,`carNum` ,`chudate` ,`fromcity`,`supplierId`,`model`,`zhujiId`,`beizhu`,`company1`)
		VALUES ('$_POST[company]','$_POST[carNum]','$_POST[chudate]','$_POST[fromcity]','$_POST[supplierId]','$_POST[model]','$_POST[zhujiId]','$_POST[beizhu]','$_SESSION[company1]');";
		if($db->query($sql)){echo close($msg,"maintain");}else{echo error($msg);}
	}else{
		echo error("该公司中不存在此车辆，请重新输入！");
	}
	exit;
}

if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_maintain`");
	$smt = new smarty();smarty_cfg($smt);
	$sql="select * from `rv_maintain` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->display('maintain_edit.htm');
	exit;
}

if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_maintain`");
	$sql="update `rv_maintain` set `model`='$_POST[model]',`reason`='$_POST[reason]',`getdate`='$_POST[getdate]',`phenomenon`='$_POST[phenomenon]',`reasult`='$_POST[reasult]',`backdate`='$_POST[backdate]',`mainNum`='$_POST[mainNum]',`beizhu`='$_POST[beizhu]' where `id`='$_POST[id]' LIMIT 1";
	if($db->query($sql)){echo close($msg,"maintain");}else{echo error($msg);}	
	exit;
}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_maintain`");
	$sql="delete from `rv_maintain` where `id`='$id'";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}	
	exit;
}

if($do=="print"){
	If_rabc($action,$do); //检测权限
	$sql="SELECT rv_maintain.*,name from `rv_maintain`,`rv_supplier` where supplierId=rv_supplier.id and rv_maintain.company1='$_SESSION[company1]' $_POST[search] order by rv_maintain.id desc";
	$db->query($sql);
	$list=$db->fetchAll();
	header("Content-Type: application/vnd.ms-excel;charset=utf-8");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk","终端维修记录表").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>公司名称</th>";
	echo "<th>车牌号</th>";
	echo "<th>寄出时间</th>";
	echo "<th>收到时间</th>";
	echo "<th>地市</th>";
	echo "<th>终端厂家</th>";
	echo "<th>型号</th>";
	echo "<th>序列号</th>";
	echo "<th>返修原因</th>";
	echo "<th>检测现象</th>";
	echo "<th>维修结果(上线/定位/照片)</th>";
	echo "<th>返回时间</th>";
	echo "<th>检修次数</th>";
	echo "<th>备注</th>";
	echo "</tr>";
	echo "<tr align=center>";
	foreach($list as $key=>$val){
		echo "<td>".$val[id]."</td>";
		echo "<td>".$val[company]."</td>";
		echo "<td>".$val[carNum]."</td>";
		echo "<td>".$val[chudate]."</td>";
		echo "<td>".$val[getdate]."</td>";
		echo "<td>".$val[fromcity]."</td>";
		echo "<td>".$val[name]."</td>";
		echo "<td>".$val[model]."</td>";
		echo "<td>".$val[zhujiId]."</td>";
		echo "<td>".$val[reason]."</td>";
		echo "<td>".$val[phenomenon]."</td>";
		echo "<td>".$val[reasult]."</td>";
		echo "<td>".$val[backdate]."</td>";
		echo "<td>".$val[mainNum]."</td>";
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