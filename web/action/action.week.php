<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	$sql4="select date_format(date,'%Y') as year from `rv_tongji` where company1='$_SESSION[company1]' group by year";
	$db->query($sql4);
	$year_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($year_arr as $key=>$val){
		$year_list[$year_arr[$key][year]] = $year_arr[$key][year];	//年份数组		
	} 
	$sql3="select date_format(now(),'%Y-%c') as b,ceil((DAY(now())+ WEEKDAY(DATE_ADD(DATE_SUB(now(),INTERVAL day(now()) day),INTERVAL 1 day))) /7 ) as c";
	$db->query($sql3);
	$row3=$db->fetchRow();
	//判断检索值
	if($_POST['month']){$month = $_POST['month'];}else{$month = $row3[b].-1;}
	if($_POST['week']){$week = $_POST['week']-1;}else{$week = $row3[c]-1;}
	$sql="select date_format('$month','%Y-%c') as mon";
	$db->query($sql);
	$mon_row=$db->fetchRow();
	$mon=$mon_row[mon];

	//查询周一是几号
	$sql="select date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) as a";
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	//将一周七天的日期放到数组中
	$arr=array($row[a],date('Y-m-d',strtotime("$row[a] +1 day")),date('Y-m-d',strtotime("$row[a] +2 day")),date('Y-m-d',strtotime("$row[a] +3 day")),date('Y-m-d',strtotime("$row[a] +4 day")),date('Y-m-d',strtotime("$row[a] +5 day")),date('Y-m-d',strtotime("$row[a] +6 day")));//将日期放进数组arr中date('Y-m-d H:i:s',strtotime("$s +1 day"))
	
	$sql="select WEEKDAY(date)+1 as a,id,biaoshi,name,quantity,money from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY) group by biaoshi,name,date order by rv_tongji.id asc";
	$sql1="select id,biaoshi,name,sum(quantity) as q,sum(money) as m,quantity,money from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY) group by biaoshi,name order by biaoshi desc,name desc ";
	$sql2="select count(biaoshi) as c,biaoshi from (select biaoshi from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY) group by biaoshi,name) as cc group by biaoshi";
	//查询每一天的总金额
	$sql3="select WEEKDAY(date)+1 as a,sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY) group by a";
	//查询一周的总金额
	$sql4="select sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY)";
	$db->query($sql);
	$list=$db->fetchAll();
	$db->query($sql1);
	$list1=$db->fetchAll();
	$db->query($sql2);
	$list2=$db->fetchAll();
	$db->query($sql3);
	$list3=$db->fetchAll();
	$db->query($sql4);
	$list4=$db->fetchRow();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	
	$smt->assign('arr',$arr);	
	$smt->assign('week',$week);	
	$smt->assign('mon',$mon);	
	$smt->assign('month',$month);	
	$smt->assign('year_cn',selecter($year_list,"year","","请选择","w_combox_month","?action=week&do=month_combox&value={value}"));
	$smt->assign('list',$list);	
	$smt->assign('list1',$list1);
	$smt->assign('list2',$list2);	
	$smt->assign('list3',$list3);
	$smt->assign('list4',$list4);
	//$smt->assign('title',"客户列表");
	$smt->display('week_list.htm');
	exit;	
}
if($do=="month_combox"){
	//通过商品ID在`rv_storage_ru`表中查找该商品的供应商
	echo "[";
	echo '["", "请选择"],';
	for($i=1;$i<13;$i++){
	echo '["'.$value.'-'.$i.'-1", "'.$i.'月"],';
	}
	echo "]";
    exit;
}
if($do=="week_combox"){
	//通过商品ID在`rv_storage_ru`表中查找该商品的供应商
	$sql="Select ceil((DAY(LAST_DAY('$value'))+ WEEKDAY(DATE_ADD(DATE_SUB('$value',INTERVAL day('$value') day),INTERVAL 1 day))) /7 ) as w";
	$db->query($sql);
	$row=$db->fetchRow();
	echo "[";
	echo '["", "请选择"],';
	for($i=1;$i<=$row[w];$i++){
	echo '["'.$i.'", "第'.$i.'周"],';
	}
	echo "]";
    exit;
}
if($do=="print"){
	If_rabc($action,$do); //检测权限
	
	//查询周一是几号
	$sql="select date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) as a";
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	//将一周七天的日期放到数组中
	$arr=array($row[a],date('Y-m-d',strtotime("$row[a] +1 day")),date('Y-m-d',strtotime("$row[a] +2 day")),date('Y-m-d',strtotime("$row[a] +3 day")),date('Y-m-d',strtotime("$row[a] +4 day")),date('Y-m-d',strtotime("$row[a] +5 day")),date('Y-m-d',strtotime("$row[a] +6 day")));//将日期放进数组arr中date('Y-m-d H:i:s',strtotime("$s +1 day"))
	$sql="select WEEKDAY(date)+1 as a,id,biaoshi,name,quantity,money from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY) group by biaoshi,name,date order by rv_tongji.id asc";
	$sql1="select id,biaoshi,name,sum(quantity) as q,sum(money) as m,quantity,money from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY) group by biaoshi,name order by biaoshi desc,name desc ";
	$sql2="select count(biaoshi) as c,biaoshi from (select biaoshi from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY) group by biaoshi,name) as cc group by biaoshi";
	//查询每一天的总金额
	$sql3="select WEEKDAY(date)+1 as a,sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY) group by a";
	//查询一周的总金额
	$sql4="select sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date between date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7 day) and date_add(date_add('$month',INTERVAL -WEEKDAY('$month') DAY),interval $week*7+6 DAY)";
	$db->query($sql);
	$list=$db->fetchAll();
	$db->query($sql1);
	$list1=$db->fetchAll();
	$db->query($sql2);
	$list2=$db->fetchAll();
	$db->query($sql3);
	$list3=$db->fetchAll();
	$db->query($sql4);
	$list4=$db->fetchRow();
	header("Content-Type: application/vnd.ms-excel;charset=gbk");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk",$mon."月第".($week+1)."周业务统计").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th colspan='2' width='160'> </th>";
	for($i=0;$i<7;$i++){
	echo "<th colspan='2' width='115'>".$arr[$i]."</th>";
	} 
	echo "<th colspan='2' width='115'>合计</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th width='80'></th>";
	echo "<th width='80'></th>";
	for($i=0;$i<8;$i++){
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
					for($i=1;$i<8;$i++){
						$flag=true;
						foreach($list as $key=>$val){
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
	echo "<td>合计</td>";
	echo "<td></td>";
	for($i=1;$i<8;$i++){
		$flag2=true;
		foreach($list3 as $key3=>$val3){
			if($val3[a]==$i){
				echo "<td></td>";
				echo "<td>".$val3[money]."</td>";
				$flag2=false;
			}
		}
		if($flag2){
			echo "<td></td>";
			echo "<td></td>";
		}
	}
	echo "<td></td>";
	echo "<td>".$list4[money]."</td>";
	echo "</tr>";
	echo "</table>";
	//结束函数并返回true  
	return (true);
}
?>