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
	$sql4="select date_format(now(),'%Y') as year,date_format(now(),'%c') as month";
	$db->query($sql4);
	$row=$db->fetchRow();
	//判断检索值
	if($_POST['year']){$year = $_POST['year'];}else{$year = $row[year];}
	if($_POST['month']){$month = $_POST['month'];}else{$month = $row[month];}
	$date = $year . "-" . $month . "-1";
	$date1 = $year . "-" . $month;
	//判断如果是维护只显示自己的
	//if($_SESSION[roleid]=="3"){$search .= " and salesid = '$_SESSION[userid]'";} //维护
	
	$sql="select ceil((DAY(date)+ WEEKDAY(DATE_ADD(DATE_SUB(date,INTERVAL day(date) day),INTERVAL 1 day))) /7 ) as a,id,biaoshi,name,sum(quantity) as quantity,sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') group by biaoshi,name,a order by rv_tongji.id asc";
	$sql1="select id,biaoshi,name,sum(quantity) as q,sum(money) as m from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') group by biaoshi,name order by biaoshi desc,name desc ";
	$sql2="select count(biaoshi) as c,biaoshi from (select biaoshi from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') group by biaoshi,name) as cc group by biaoshi";
	//查找每一周的总金额
	$sql5="select ceil((DAY(date)+ WEEKDAY(DATE_ADD(DATE_SUB(date,INTERVAL day(date) day),INTERVAL 1 day))) /7 ) as a,sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') group by a";
	//查找一月的总金额
	$sql6="select sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date')";
	
	$db->query($sql);
	$list3=$db->fetchAll();
	
	$db->query($sql1);
	$list1=$db->fetchAll();

	$db->query($sql2);
	$list2=$db->fetchAll();
	
	$db->query($sql5);
	$list5=$db->fetchAll();
	
	$db->query($sql6);
	$list6=$db->fetchRow();
	//格式化输出数据
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('date',$date);	
	$smt->assign('date1',$date1);	
	$smt->assign('list3',$list3);	
	$smt->assign('list1',$list1);
	$smt->assign('list2',$list2);	
	$smt->assign('list5',$list5);
	$smt->assign('list6',$list6);	
	$smt->assign('year_cn',select($year_list,"year","","请选择"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	//$smt->assign('title',"客户列表");
	$smt->display('month_list.htm');
	exit;	
}
if($do=="print"){
	If_rabc($action,$do); //检测权限
	$sql2="select ceil((DAY(date)+ WEEKDAY(DATE_ADD(DATE_SUB(date,INTERVAL day(date) day),INTERVAL 1 day))) /7 ) as a,id,biaoshi,name,sum(quantity) as quantity,sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') group by biaoshi,name,a order by rv_tongji.id asc";
	$sql1="select id,biaoshi,name,sum(quantity) as q,sum(money) as m from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') group by biaoshi,name order by biaoshi desc,name desc ";
	$sql3="select count(biaoshi) as c,biaoshi from (select biaoshi from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') group by biaoshi,name) as cc group by biaoshi";
	//查找每一周的总金额
	$sql5="select ceil((DAY(date)+ WEEKDAY(DATE_ADD(DATE_SUB(date,INTERVAL day(date) day),INTERVAL 1 day))) /7 ) as a,sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date') group by a";
	//查找一月的总金额
	$sql6="select sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between DATE_SUB('$date',INTERVAL DAY('$date')-1 DAY) and last_day('$date')";
	
	$db->query($sql1);
	$list1=$db->fetchAll();
	$db->query($sql2);
	$list3=$db->fetchAll();
	$db->query($sql3);
	$list2=$db->fetchAll();
	$db->query($sql5);
	$list5=$db->fetchAll();
	$db->query($sql6);
	$list6=$db->fetchRow();
	header("Content-Type: application/vnd.ms-excel;charset=gbk");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk",$date1."月份业务统计").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th colspan='2' width='115'> </th>";
	echo "<th colspan='2' width='115'>第一周</th>";
	echo "<th colspan='2' width='115'>第二周</th>";
	echo "<th colspan='2' width='115'>第三周</th>";
	echo "<th colspan='2' width='115'>第四周</th>";
	echo "<th colspan='2' width='115'>第五周</th>";
	echo "<th colspan='2' width='115'>第六周</th>";
	echo "<th colspan='2' width='115'>合  计</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th width='80'></th>";
	echo "<th width='80'></th>";
	for($i=0;$i<7;$i++){
		echo "<th width='35'>数量</th>";
		echo "<th width='80'>金额</th>";
	}
	echo "</tr>";
	echo "<tr align=center>";
	foreach($list2 as $key2=>$val2){
		echo "<td rowspan=".$val2[c].">".$val2[biaoshi]."</td>";
		foreach($list1 as $key1=>$val1){
			if($val1[biaoshi]==$val2[biaoshi]){
				echo "<td>".$val1[name]."</td>";
				//echo iconv("utf-8","gbk",$val1[name]).$sep;
					for($i=1;$i<7;$i++){
						$flag=true;
						foreach($list3 as $key=>$val){
							if($val[a]==$i and $val[name]==$val1[name] and $val[biaoshi]==$val1[biaoshi]){
								echo "<td>".$val[quantity]."</td>";
								echo "<td>".$val[money]."</td>";
								$flag=false;
							}
						}
						if($flag){
							echo "<td></td>";
							echo "<td></td>";
						}	
					}
				echo "<td>".$val1[q]."</td>";
				echo "<td>".$val1[m]."</td>";
				echo "</tr>";
				echo "<tr align=center>";	
			}
		} 
	}
	echo "<td>合 计</td>";
	echo "<td></td>";
	for($i=1;$i<7;$i++){
		$flag1=true;
		foreach($list5 as $key5=>$val5){
			if($val5[a]==$i){
				echo "<td></td>";
				echo "<td>".$val5[money]."</td>";
				$flag1=false;
			}
		}
		if($flag1){
			echo "<td></td>";
			echo "<td></td>";
		}
	}
	echo "<td></td>";
	echo "<td>".$list6[money]."</td>";
	echo "</tr>";
	echo "</table>";
	//结束函数并返回true  
	return (true);
}
?>