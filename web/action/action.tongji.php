<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表
if($do==""){
 	If_rabc($action,$do); //检测权限	
	$sql3="select date_format(date,'%Y') as year from `rv_tongji` where company1 in ($arr2) group by year";
	$db->query($sql3);
	$year_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($year_arr as $key=>$val){
		$year_list[$year_arr[$key][year]] = $year_arr[$key][year];	//年份数组		
	} 
	$sql4="select date_format(now(),'%Y-%m') as date1";
	$db->query($sql4);
	$row=$db->fetchRow();
	//判断检索值
	if($_POST['date']){$date1 = $_POST['date'];}else{$date1 = $row[date1];}
	$date = $date1 . "-1";
	//判断如果是维护只显示自己的
	//if($_SESSION[roleid]=="3"){$search .= " and salesid = '$_SESSION[userid]'";} //维护
	$sql1="select name,weixiuproject,count(*) as num,sum(price) as money from `rv_weixiuresult` where date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') and company1='$_SESSION[company1]' group by name,weixiuproject";
	//获取列数
	$sql2="select count(name) as c,name,sum(p) as money from (select name,weixiuproject,count(*),sum(price) as p from `rv_weixiuresult` where date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') and company1='$_SESSION[company1]' group by name,weixiuproject) as a group by name";
	$db->query($sql1);
	$list1=$db->fetchAll();

	$db->query($sql2);
	$list2=$db->fetchAll();
	
	//格式化输出数据
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('date',$date);	
	$smt->assign('date1',$date1);	
	$smt->assign('list1',$list1);
	$smt->assign('list2',$list2);	
	$smt->assign('year_cn',select($year_list,"year","","请选择"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	//$smt->assign('title',"客户列表");
	$smt->display('tongji_list.htm');
	exit;	
}
if($do=="print"){
	If_rabc($action,$do); //检测权限
	$sql1="select name,weixiuproject,count(*) as num,sum(price) as money from `rv_weixiuresult` where date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') and company1='$_SESSION[company1]' group by name,weixiuproject";
	//获取列数
	$sql2="select count(name) as c,name,sum(p) as money from (select name,weixiuproject,count(*),sum(price) as p from `rv_weixiuresult` where date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') and company1='$_SESSION[company1]' group by name,weixiuproject) as a group by name";
	$db->query($sql1);
	$list1=$db->fetchAll();
	$db->query($sql2);
	$list2=$db->fetchAll();
	header("Content-Type: application/vnd.ms-excel;charset=gbk");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk",$date1."维修网点月份金额统计表").".xls");
	echo "<table border='1'>";
	echo "<tr align='center'>";
	echo "<th width='100' rowspan='2'>维修人员</th>";
	echo "<th width='100' rowspan='2'>本月总金额</th>";
	echo "<th width='500' colspan='3'>明细</th>";
	echo "</tr>";
	echo "<tr align='center'>";
	echo "<th width='300'>维修项目</th>";
	echo "<th width='100'>维修次数</th>";
	echo "<th width='100'>项目总金额</th>";
	echo "</tr>";
	echo "<tr align=center>";
	foreach($list2 as $key2=>$val2){
		echo "<td rowspan=".$val2[c].">".$val2[name]."</td>";
		echo "<td rowspan=".$val2[c].">".$val2[money]."</td>";
		foreach($list1 as $key1=>$val1){
			if($val1[name]==$val2[name]){
				echo "<td>".$val1[weixiuproject]."</td>";
				echo "<td>".$val1[num]."</td>";
				echo "<td>".$val1[money]."</td>";
				echo "</tr>";
				echo "<tr align=center>";	
			}
		} 
	}
	echo "</tr>";
	echo "</table>";
	//结束函数并返回true  
	return (true);
}
?>