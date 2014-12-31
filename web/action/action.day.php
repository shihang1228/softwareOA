<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表
if($do==""){
 	If_rabc($action,$do); //检测权限	
	//获取当前日期
	$sql4="select date_format(now(),'%Y-%c-%d') as date1";
	$db->query($sql4);
	$row=$db->fetchRow();
	//判断检索值
	if($_POST['date1']){$date = $_POST['date1'];}else{$date = $row[date1];}
	
	$sql="select date,id,biaoshi,name,quantity,money from `rv_tongji` where company1='$_SESSION[company1]' and date='$date' order by rv_tongji.id asc";
	$sql1="select id,biaoshi,name,sum(quantity) as q,sum(money) as m from `rv_tongji` where company1='$_SESSION[company1]' and date='$date' group by biaoshi,name order by biaoshi desc,name desc ";
	$sql2="select count(biaoshi) as c,biaoshi from (select biaoshi from `rv_tongji` where company1='$_SESSION[company1]' and date='$date' group by biaoshi,name) as cc group by biaoshi";
	//查找一天的金额合计
	$sql5="select sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date='$date'";
	
	$db->query($sql);
	$list3=$db->fetchAll();
	
	$db->query($sql1);
	$list1=$db->fetchAll();
	
	$db->query($sql2);
	$list2=$db->fetchAll();
	
	$db->query($sql5);
	$list5=$db->fetchRow();
	//格式化输出数据
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('date',$date);	
	$smt->assign('row',$row);
	$smt->assign('list3',$list3);	
	$smt->assign('list1',$list1);
	$smt->assign('list2',$list2);	
	$smt->assign('list5',$list5);
	//$smt->assign('title',"客户列表");
	$smt->display('day_list.htm');
	exit;	
}
if($do=="print"){
	If_rabc($action,$do); //检测权限
	$sql="select date,id,biaoshi,name,quantity,money from `rv_tongji` where company1='$_SESSION[company1]' and date='$date' order by rv_tongji.id asc";
	$sql1="select id,biaoshi,name,sum(quantity) as q,sum(money) as m from `rv_tongji` where company1='$_SESSION[company1]' and date='$date' group by biaoshi,name order by biaoshi desc,name desc ";
	$sql2="select count(biaoshi) as c,biaoshi from (select biaoshi from `rv_tongji` where company1='$_SESSION[company1]' and date='$date' group by biaoshi,name) as cc group by biaoshi";
	//查找一天的金额合计
	$sql5="select sum(money) as money from `rv_tongji` where company1='$_SESSION[company1]' and date='$date'";
	$db->query($sql);
	$list3=$db->fetchAll();
	$db->query($sql1);
	$list1=$db->fetchAll();
	$db->query($sql2);
	$list2=$db->fetchAll();
	$db->query($sql5);
	$list5=$db->fetchRow();
	header("Content-Type: application/vnd.ms-excel;charset=gbk");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk",$date."业务统计").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th colspan='2' width='160'></th>";
	echo "<th colspan='2' width='115'>$date</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th width='80'></th>";
	echo "<th width='80'></th>";
	echo "<th width='35'>数量</th>";
	echo "<th width='80'>金额</th>";
	echo "</tr>";
	echo "<tr align=center>";
	foreach($list2 as $key2=>$val2){
		echo "<td rowspan=".$val2[c].">".$val2[biaoshi]."</td>";
		foreach($list1 as $key1=>$val1){
			if($val1[biaoshi]==$val2[biaoshi]){
				echo "<td>".$val1[name]."</td>";
				$flag=true;
				foreach($list3 as $key=>$val){
					if($val[name]==$val1[name] and $val[biaoshi]==$val1[biaoshi]){
						echo "<td>".$val[quantity]."</td>";
						echo "<td>".$val[money]."</td>";
						$flag=false;
					}
				}
				if($flag){
					echo "<td></td>";
					echo "<td></td>";
				}	
					
				
				echo "</tr>";
				echo "<tr align=center>";	
			}
		} 
	}
	echo "<td>合 计</td>";
	echo "<td></td>";
	echo "<td></td>";
	echo "<td>".$list5[money]."</td>";
	echo "</tr>";
	echo "</table>";
	//结束函数并返回true  
	return (true);
}
?>