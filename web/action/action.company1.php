<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
	//查询公司数组
	$sql="select company1 from `rv_dengji`";
	$db->query($sql);
	$company1_arr=$db->fetchAll();
	//格式化输出数据
	foreach($company1_arr as $key=>$val){
		$company1_list[$company1_arr[$key][company1]] = $company1_arr[$key][company1];
	}
	
	$sql="SELECT id,city FROM `rv_city`";
	$db->query($sql);
	$city_arr=$db->fetchAll();
	 //格式化输出数据
	foreach($city_arr as $key=>$val){
		$city_list[$city_arr[$key][city]] = $city_arr[$key][city];	//城市选择		
	}
	
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['address']){$search .= " and address like '%$_POST[address]%'";}
	
	
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
	$info_num=mysql_query("SELECT * FROM `rv_dengji` $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//查询
	$sql="SELECT * FROM `rv_dengji` $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('city_cn',select($city_list,"city","","市区选择"));
	$smt->assign('total',$total);
	$smt->display('company1_list.htm');
	exit;	
}



//新增库房
if($do=="new"){
    If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('company1_cn',select($company1_list,"fucompany1",$_SESSION[company1],"公司选择"));
	$smt->assign('city_cn',select($city_list,"city","","市区选择"));
	$smt->assign('title',"新增");
	$smt->display('company1_new.htm');
	exit;
}


//写入库房
if($do=="add"){
	If_rabc($action,$do); //检测权限
	//将新公司名称添加到表中
	$sql2="INSERT INTO `rv_dengji` (company1) value ('$_POST[company1]')";
	 if($db->query($sql2)){
		//查找父类公司的等级信息
		$sql3="select one,two,three,four,five,dengji from `rv_dengji` where company1='$_POST[fucompany1]'";
		$db->query($sql3);
		$fu_row=$db->fetchRow();
		//更新公司的数据,及市区
		$sql4="update `rv_dengji` set `one`='$fu_row[one]',`two`='$fu_row[two]',`three`='$fu_row[three]',`four`='$fu_row[four]',`five`='$fu_row[five]',`dengji`='$_POST[dengji]',`city`='$_POST[city]' where company1='$_POST[company1]'";
		if($db->query($sql4)){
			//查询新增公司是几等级，就在该位置添加，首先查找跟当前公司同一等级的最大值
			if($_POST[dengji]==2){
				$sql="select two from `rv_dengji` where one='$fu_row[one]' order by two desc LIMIT 1";
				$db->query($sql);
				$t_row=$db->fetchRow();
				//更新新增公司的等级
				$sql="update `rv_dengji` set two='$t_row[two]'+1 where company1='$_POST[company1]'";
				$db->query($sql);
			}else if($_POST[dengji]==3){
				$sql="select three from `rv_dengji` where one='$fu_row[one]' and two='$fu_row[two]' order by three desc LIMIT 1";
				$db->query($sql);
				$t_row=$db->fetchRow();
				//更新新增公司的等级
				$sql="update `rv_dengji` set `three`='$t_row[three]'+1 where company1='$_POST[company1]'";
				$db->query($sql);
			}else if($_POST[dengji]==4){
				$sql="select four from `rv_dengji` where one='$fu_row[one]' and two='$fu_row[two]' and three='$fu_row[three]' order by four desc LIMIT 1";
				$db->query($sql);
				$t_row=$db->fetchRow();
				//更新新增公司的等级
				$sql="update `rv_dengji` set `four`='$t_row[four]'+1 where company1='$_POST[company1]'";
				$db->query($sql);
			}else if($_POST[dengji]==5){
				$sql="select five from `rv_dengji` where one='$fu_row[one]' and two='$fu_row[two]' and three='$fu_row[three]' and four='$fu_row[four]' order by five desc LIMIT 1";
				$db->query($sql);
				$t_row=$db->fetchRow();
				//更新新增公司的等级
				$sql="update `rv_dengji` set `five`='$t_row[five]'+1 where company1='$_POST[company1]'";
				$db->query($sql);
			}
			echo close($msg,"company1");
		}else{echo error($msg);}
	}else{echo error($msg);} 
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `rv_dengji` where `id`='$id' limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}	
	exit;
}

?>