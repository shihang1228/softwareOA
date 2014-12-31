<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 



//列表	
if($do==""){
    If_rabc($action,$do); //检测权限	
	$sql="select date_format(str_to_date(date,'%Y-%c-%d'),'%Y') as year from `rv_detail` where company1='$_SESSION[company1]' group by year";
	$db->query($sql);
	$year_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($year_arr as $key=>$val){
		$yearlist[$year_arr[$key][year]] = $year_arr[$key][year];	//年份数组		
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
	//查询上月和本月的所有商品
	$sql="select rv_detail.id,rv_detail.model,rv_supplier.name as sname,rv_product.name as pname,rv_room.name as rname from `rv_detail`,`rv_product`,`rv_room`,`rv_supplier` 
	where rv_detail.company1='$_SESSION[company1]' and rv_detail.productId=rv_product.id and rv_detail.supplierId=rv_supplier.id and rv_detail.roomId=rv_room.id and DATE_FORMAT(str_to_date(date,'%Y-%c-%d'),'%Y-%m') between DATE_FORMAT(DATE_SUB('$date',INTERVAL 1 month),'%Y-%m') and DATE_FORMAT('$date','%Y-%m') group by pname,model,sname,rname";
	$db->query($sql);
	$name_list=$db->fetchAll();
	$info_num=mysql_query($sql);
	$total=mysql_num_rows($info_num);//总条数
	//修改rv_detail表中本月当前库存
	$sql1="update `rv_detail`,`rv_storage` as st set rv_detail.kucun=st.quantity where rv_detail.company1='$_SESSION[company1]' and rv_detail.productId=st.productId and rv_detail.model=st.model and rv_detail.supplierId=st.supplierId and rv_detail.roomId=st.roomId and rv_detail.date=date_format('$date','%Y-%c')";
	$db->query($sql1);
	//查询商品的相关信息
	$sql2="select rv_detail.id,rv_detail.model,rv_supplier.name as sname,rv_product.name as pname,rv_room.name as rname,curruquantity,curchuquantity,shouquantity,kucun,beizhu,inputer from `rv_detail`,`rv_product`,`rv_room`,`rv_supplier` 
	where rv_detail.company1='$_SESSION[company1]' and rv_detail.productId=rv_product.id and rv_detail.supplierId=rv_supplier.id and rv_detail.roomId=rv_room.id and rv_detail.date=date_format('$date','%Y-%c') order by rv_detail.id desc";
	$db->query($sql2);
	$list=$db->fetchAll();
	//查询商品本年的出入库数量
	$sql3="select rv_detail.model,rv_supplier.name as sname,rv_product.name as pname,rv_room.name as rname,sum(curruquantity) as yearruquantity,sum(curchuquantity) as yearchuquantity from `rv_detail`,`rv_product`,`rv_room`,`rv_supplier` 
	where rv_detail.company1='$_SESSION[company1]' and rv_detail.productId=rv_product.id and rv_detail.supplierId=rv_supplier.id and rv_detail.roomId=rv_room.id and DATE_FORMAT(str_to_date(date,'%Y-%c-%d'),'%Y')=date_format('$date','%Y') group by pname,model,sname,rname";
	$db->query($sql3);
	$year_list=$db->fetchAll();
	
	
	//查询上月库存
	$sql4="select rv_detail.model,rv_supplier.name as sname,rv_product.name as pname,rv_room.name as rname,kucun as lastkucun from `rv_detail`,`rv_product`,`rv_room`,`rv_supplier` 
	where rv_detail.company1='$_SESSION[company1]' and rv_detail.productId=rv_product.id and rv_detail.supplierId=rv_supplier.id and rv_detail.roomId=rv_room.id and date=DATE_FORMAT(DATE_SUB('$date',INTERVAL 1 month),'%Y-%c')";
	$db->query($sql4);
	$last_list=$db->fetchAll();
	$date3=date('Y-m');

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('date',$date);
	$smt->assign('date1',$date1);	
	$smt->assign('date3',$date3);	
	$smt->assign('month',$month);	
	$smt->assign('year_list',$year_list);
	$smt->assign('last_list',$last_list);	
	$smt->assign('name_list',$name_list);
	$smt->assign('year_cn',select($yearlist,"year","","请选择"));
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"产品列表"); 
	$smt->display('detail_list.htm');
	exit;	
}
//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_detail`");
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$name_sql="SELECT * FROM `rv_detail` where id='{$id}' LIMIT 1";
 	$db->query($name_sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('title',"编辑");
	$smt->display('detail_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_detail`");	
	$username=$_SESSION['username'];
	$sql="select * from `rv_detail` where id='$_POST[id]'";
	$db->query($sql);
	$name_row=$db->fetchRow();
	$sql="select * from `rv_detail` where company1='$_SESSION[company1]' and productId='$name_row[productId]' and model='$name_row[model]' and supplierId='$name_row[supplierId]' and roomId='$name_row[roomId]' and date=date_format(now(),'%Y-%c')";
	$m=mysql_query($sql);
	$n=mysql_num_rows($m);
	if($n>0){
	//修改的是有本月数据的记录
	//sql
	$sql="UPDATE `rv_detail` SET 
	`beizhu` = '$_POST[beizhu]',`inputer` = '$username' WHERE company1='$_SESSION[company1]' and productId='$name_row[productId]' and model='$name_row[model]' and supplierId='$name_row[supplierId]' and roomId='$name_row[roomId]' and date=date_format(now(),'%Y-%c') LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"detail");}else{echo error($msg);}	
	}else{
	//修改的是只有上月库存而没有本月数据的记录，将备注和用户名插入本月数据
	$sql1="insert into `rv_detail` (`productId`,`model`,`supplierId`,`roomId`,`beizhu`,`inputer`,`date`,`company1`) VALUES ('$name_row[productId]','$name_row[model]','$name_row[supplierId]','$name_row[roomId]','$_POST[beizhu]','$username',DATE_FORMAT(now(),'%Y-%c'),'$_SESSION[company1]')";
	if($db->query($sql1)){echo close($msg,"detail");}else{echo error($msg);}
	}
	exit;
}
//导出excle表格
if($do=="print"){
	If_rabc($action,$do); //检测权限
	//查询上月和本月的所有商品
	$sql="select rv_detail.id,rv_detail.model,rv_supplier.name as sname,rv_product.name as pname,rv_room.name as rname from `rv_detail`,`rv_product`,`rv_room`,`rv_supplier` 
	where rv_detail.company1='$_SESSION[company1]' and rv_detail.productId=rv_product.id and rv_detail.supplierId=rv_supplier.id and rv_detail.roomId=rv_room.id and DATE_FORMAT(str_to_date(date,'%Y-%c-%d'),'%Y-%m') between DATE_FORMAT(DATE_SUB('$date',INTERVAL 1 month),'%Y-%m') and DATE_FORMAT('$date','%Y-%m') group by pname,model,sname,rname";
	//查询商品的相关信息
	$sql2="select rv_detail.id,rv_detail.model,rv_supplier.name as sname,rv_product.name as pname,rv_room.name as rname,curruquantity,curchuquantity,shouquantity,kucun,beizhu,inputer from `rv_detail`,`rv_product`,`rv_room`,`rv_supplier` 
	where rv_detail.company1='$_SESSION[company1]' and rv_detail.productId=rv_product.id and rv_detail.supplierId=rv_supplier.id and rv_detail.roomId=rv_room.id and rv_detail.date=date_format('$date','%Y-%c') order by rv_detail.id desc";
	//查询商品本年的出入库数量
	$sql3="select rv_detail.model,rv_supplier.name as sname,rv_product.name as pname,rv_room.name as rname,sum(curruquantity) as yearruquantity,sum(curchuquantity) as yearchuquantity from `rv_detail`,`rv_product`,`rv_room`,`rv_supplier` 
	where rv_detail.company1='$_SESSION[company1]' and rv_detail.productId=rv_product.id and rv_detail.supplierId=rv_supplier.id and rv_detail.roomId=rv_room.id and DATE_FORMAT(str_to_date(date,'%Y-%c-%d'),'%Y')=date_format('$date','%Y') group by pname,model,sname,rname";
	//查询上月库存
	$sql4="select rv_detail.model,rv_supplier.name as sname,rv_product.name as pname,rv_room.name as rname,kucun as lastkucun from `rv_detail`,`rv_product`,`rv_room`,`rv_supplier` 
	where rv_detail.company1='$_SESSION[company1]' and rv_detail.productId=rv_product.id and rv_detail.supplierId=rv_supplier.id and rv_detail.roomId=rv_room.id and date=DATE_FORMAT(DATE_SUB('$date',INTERVAL 1 month),'%Y-%c')";
	$db->query($sql);
	$name_list=$db->fetchAll();
	$db->query($sql2);
	$list=$db->fetchAll();
	$db->query($sql3);
	$year_list=$db->fetchAll();
	$db->query($sql4);
	$last_list=$db->fetchAll();
	header("Content-Type: application/vnd.ms-excel;charset=utf-8");   
	header("Content-Disposition: attachment; filename=".iconv("utf-8","gbk","设备出入库明细").".xls");
	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>商品名称</th>";
	echo "<th>型号</th>";
	echo "<th>供货商</th>";
	echo "<th>库房名称</th>";
	echo "<th>接上月库存</th>";
	echo "<th>本月入库数量</th>";
	echo "<th>本月出库数量</th>";
	echo "<th>出库收款数量</th>";
	echo "<th>当前库存</th>";
	echo "<th>备注</th>";
	echo "<th>操作者</th>";
	echo "<th>本年累计入库数</th>";
	echo "<th>本年累计出库数</th>";
	echo "</tr>";
	echo "<tr align=center>";
	foreach($name_list as $key1=>$val1){
		echo "<td>".$val1[id]."</td>";
		echo "<td>".$val1[pname]."</td>";
		echo "<td>".$val1[model]."</td>";
		echo "<td>".$val1[sname]."</td>";
		echo "<td>".$val1[rname]."</td>";
		
		$flag=true;
		foreach($last_list as $key4=>$val4){
			if($val1[pname]==$val4[pname] and $val1[model]==$val4[model] and $val1[sname]==$val4[sname] and $val1[rname]==$val4[rname]){
				echo "<td>".$val4[lastkucun]."</td>";
				$flag=false;
			}
		}
		if($flag){
			echo "<td></td>";
		}
		
		$flag1=true;
		foreach($list as $key2=>$val2){
			if($val1[pname]==$val2[pname] and $val1[model]==$val2[model] and $val1[sname]==$val2[sname] and $val1[rname]==$val2[rname]){
				echo "<td>".$val2[curruquantity]."</td>";
				echo "<td>".$val2[curchuquantity]."</td>";
				echo "<td>".$val2[shouquantity]."</td>";
				echo "<td>".$val2[kucun]."</td>";
				echo "<td>".$val2[beizhu]."</td>";
				echo "<td>".$val2[inputer]."</td>";
				$flag1=false;
			}	
		}
		if($flag1){
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
		}
		
		$flag2=true;
		foreach($year_list as $key3=>$val3){
			if($val1[pname]==$val3[pname] and $val1[model]==$val3[model] and $val1[sname]==$val3[sname] and $val1[rname]==$val3[rname]){
				echo "<td>".$val3[yearruquantity]."</td>";
				echo "<td>".$val3[yearchuquantity]."</td>";
				$flag2=false;
			}
		}
		if($flag2){
			echo "<td></td>";
			echo "<td></td>";
		}
		echo "</tr>";
		echo "<tr align=center>";
	}
	echo "</tr>";
	echo "</table>";
	//结束函数并返回true  
	return (true);
	}

?>