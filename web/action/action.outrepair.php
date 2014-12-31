<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
	$sql="select id,name from `rv_weixiuproject` where company1 in ($arr2)";
	$db->query($sql);
	$pro_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($pro_arr as $key=>$val){
		$pro_list[$pro_arr[$key][name]] = $pro_arr[$key][name];	//sim卡状态数组		
	}

//列表	
if($do==""){
    If_rabc($action,$do); //检测权限	
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}//对应原则
	if($_POST['company']){$search .= " and company like '%$_POST[company]%'";}//对应原则
	if($_POST['wangdian']){$search .= " and wangdian like '%$_POST[wangdian]%'";}//对应原则
	if($_POST['weixiuproject']){$search .= " and weixiuproject like '%$_POST[weixiuproject]%'";}//对应原则
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
	$info_num=mysql_query("SELECT * from `rv_outrepair` where company1 in ($arr2) $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT rv_outrepair.* from `rv_outrepair` where company1 in ($arr2) $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('pro_cn',select($pro_list,"weixiuproject","","请选择"));
	$smt->assign('search',$search);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('outrepair_list.htm');
	exit;	
}


//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('outrepair_new.htm');
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
		$sql="INSERT INTO `rv_outrepair` (`company`,`carNum` ,`fachudate` ,`fachuperson`,`weixiuperson`,`wangdian`,`judge`,`company1`)
		VALUES ('$_POST[company]','$_POST[carNum]','$_POST[fachudate]','$_SESSION[username]','$_POST[weixiuperson]','$_POST[wangdian]',1,'$_SESSION[company1]');";
		if($db->query($sql)){echo close($msg,"outrepair");}else{echo error($msg);}
	}else{
		echo error("该公司中不存在此车辆，请重新输入！");
	}
	exit;
}

if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_outrepair`");
	$smt = new smarty();smarty_cfg($smt);
	$sql="select * from `rv_outrepair` where id='{$id}' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row); 
	$smt->assign('pro_cn',select($pro_list,"weixiuproject",$row[weixiuproject],"请选择"));
	$smt->display('outrepair_edit.htm');
	exit;
}

if($do=="updata"){
	If_rabc($action,$do); //检测权限
	If_comrabc($_POST[id],"`rv_outrepair`");
	$path1 = "D:/OAWEB/";
	$path = "uploads/";//保存到根目录下的uploads文件中
	for($i=1;$i<3;$i++){
		if(!$_FILES["file".$i]["name"])continue;
		if ((($_FILES["file".$i]["type"] == "image/jpeg")
		|| ($_FILES["file".$i]["type"] == "image/pjpeg"))
		&& ($_FILES["file".$i]["size"] < 2000000)){
			if ($_FILES["file".$i]["error"] > 0){
				echo error($_FILES["file".$i]["error"]);
				exit;
			}else{
				$j=0;
				while(file_exists($path1 . $path . md5($_FILES["file".$i]["name"]).$j)){
					$j++;
				}
				move_uploaded_file($_FILES["file".$i]["tmp_name"],
				$path1 . $path . md5($_FILES["file".$i]["name"]).$j.".jpg");
				$address = $path . md5($_FILES["file".$i]["name"]).$j;
		}
		}else{
			echo error("无效的文件");
			exit;
		}
		$location="location".$i;
		$sql="update `rv_outrepair` set `$location`='$address' where `rv_outrepair`.`id` ='$_POST[id]'";
		$db->query($sql);
	}
	$sql="update `rv_outrepair` set `weixiuproject`='$_POST[weixiuproject]',`reason`='$_POST[reason]',`finishdate`=date_format(now(),'%Y-%m-%d'),`result`='$_POST[result]' where `id`='$_POST[id]' LIMIT 1";
	if($db->query($sql)){echo close($msg,"outrepair");}else{echo error($msg);}	
	exit;
}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_outrepair`");
	$sql="delete from `rv_outrepair` where `id`='$id'";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}	
	exit;
}

if($do=="sure"){
	If_rabc($action,$do); //检测权限
	$sql1="update `rv_outrepair` set `judge`=2 where id='{$id}'";
	$db->query($sql1);
	$sql2="select * from `rv_outrepair` where id='{$id}'";
	$db->query($sql2);
	$row=$db->fetchRow();
	//查找价格
	$sql3="select price from `rv_weixiuproject` where name='$row[weixiuproject]' and company1 in ($arr2)";
	$db->query($sql3);
	$pr_row=$db->fetchRow();
	$sql4="INSERT INTO `rv_weixiuresult` (`name`,`weixiuproject`,`price`,`date`,`company1`) value ('$row[weixiuperson]','$row[weixiuproject]','$pr_row[price]','$row[finishdate]','$_SESSION[company1]')";
	if($db->query($sql4)){echo success($msg);}else{echo error($msg);}
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