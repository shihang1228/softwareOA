<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['carNum']){$search .= " and carNum like '%$_POST[carNum]%'";}
	
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
	$sql1="SELECT `rv_shenyan`.*,date_format(rv_shenyan.yundate,'%Y-%c-%d') as yundate1,date_format(rv_shenyan.chedate,'%Y-%c-%d') as chedate1,rv_car.carNum,left(rv_car.carNum,7) as chehao,rv_car.chejiaNum,rv_car.carleixing from `rv_shenyan`,`rv_car` where rv_shenyan.company1 in ($arr2) and rv_shenyan.carId=rv_car.id $search";
	$info_num=mysql_query($sql1);
	$total=mysql_num_rows($info_num);//总条数
	
	$sql="SELECT `rv_shenyan`.*,date_format(rv_shenyan.yundate,'%Y-%c-%d') as yundate1,date_format(rv_shenyan.chedate,'%Y-%c-%d') as chedate1,rv_car.company,date_format(now(),'%Y-%c-%d') as time,rv_car.carNum,left(rv_car.carNum,7) as chehao,rv_car.chejiaNum,rv_car.carleixing,rv_shenyan.company1 from `rv_shenyan`,`rv_car` where rv_shenyan.company1 in ($arr2) and rv_shenyan.carId=rv_car.id $search order by rv_shenyan.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][id_txt] = $list[$list[$key][id]];		
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	
	$smt->assign('yunshen',$yunshen);	
	$smt->assign('cheshen',$cheshen);	
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->display('shenyan_list.htm');
	exit;	
}

//新增运管审验信息	
if($do=="newyun"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('shenyan_newyun.htm');
	exit;
}

//写入运管审验信息
if($do=="addyun"){
	If_rabc($action,$do); //检测权限
	if($_POST['carNum']){$search .= " and carNum ='$_POST[carNum]'";}
	if($_POST['chejiaNum']){$search .= " and chejiaNum ='$_POST[chejiaNum]'";}
	$sql="select yundanhao from `rv_shenyan` where company1='$_SESSION[company1]' and yundanhao!='' group by yundanhao,company1 order by yundanhao desc limit 1";
	$db->query($sql);
	$yundanhao_row=$db->fetchRow();
	$m=mysql_query($sql);
	$n=mysql_num_rows($m);
	
	$sql6="select id from `rv_car` where company1='$_SESSION[company1]' $search";
	$a1=mysql_query($sql6);
	$b1=mysql_num_rows($a1);
	if($b1>0){
		$list_carid=mysql_fetch_assoc($a1);//变量是查询的结果
		$ab=$list_carid[id];
		//查询rv_shenyan表中是否有该车辆
		$sql="select * from `rv_shenyan` where company1='$_SESSION[company1]' and carId=$ab order by chedate desc LIMIT 1";
		$a2=mysql_query($sql);
		$b2=mysql_num_rows($a2);
		$row1=mysql_fetch_assoc($a2);
		if($b2>0){
		//rv_shenyan表中存在该车辆
			if($row1[yundate]!=0){
				//如果运管数据存在，则将新数据插入表中
				if($n>0){
					$sql="INSERT INTO `rv_shenyan` (`carId`,`yundate`,`yunmoney`,`yundanhao`,`judgeyun`,`company1`)
					VALUES ('$ab',now(),'$_POST[yunmoney]','$yundanhao_row[yundanhao]'+1,1,'$_SESSION[company1]');";
				}else{
					$sql="INSERT INTO `rv_shenyan` (`carId`,`yundate`,`yunmoney`,`yundanhao`,`judgeyun`,`company1`)
					VALUES ('$ab',now(),'$_POST[yunmoney]','$houzhui',1,'$_SESSION[company1]');";
				}
				$db->query($sql);
			}else{
				//如果运管数据不存在，则更新表中最新一条数据
				if($n>0){
					$sql="UPDATE `rv_shenyan` SET 
					`yundate` = now(),
					`yunmoney` = '$_POST[yunmoney]',
					`yundanhao`='$yundanhao_row[yundanhao]'+1,
					`judgeyun`=1
					where company1='$_SESSION[company1]' and carId=$ab order by chedate desc LIMIT 1;";	
				}else{
					$sql="UPDATE `rv_shenyan` SET 
					`yundate` = now(),
					`yunmoney` = '$_POST[yunmoney]',
					`yundanhao`='$houzhui',
					`judgeyun`=1
					where company1='$_SESSION[company1]' and carId=$ab order by chedate desc LIMIT 1;";	
				}
				$db->query($sql);
			}
				
			
		} else{
		//rv_shenyan表中不存在该车辆，将信息写入统计表中的维护车辆
			if($n>0){
				$sql1="INSERT INTO `rv_shenyan` (`carId`,`yundate`,`yunmoney`,`yundanhao`,`judgeyun`,`company1`)
				VALUES ('$ab',now(),'$_POST[yunmoney]','$yundanhao_row[yundanhao]'+1,1,'$_SESSION[company1]');";
			}else{
				$sql1="INSERT INTO `rv_shenyan` (`carId`,`yundate`,`yunmoney`,`yundanhao`,`judgeyun`,`company1`)
				VALUES ('$ab',now(),'$_POST[yunmoney]','$houzhui',1,'$_SESSION[company1]');";
			}
			$db->query($sql1);
		} 
		
		//查询rv_shenyan表中的运管和车管金额
		//$sql="select * from `rv_shenyan` where company1='$_SESSION[company1]' and date_format(yundate,'%Y') and carId=$ab order by chedate,yundate desc LIMIT 1";
		//查询运管本年审验总金额
		$sql2="select sum(yunmoney) as totalyunmoney,date_format(now(),'%Y') as a from `rv_shenyan` where company1='$_SESSION[company1]' and date_format(yundate,'%Y')=date_format(now(),'%Y') and carId=$ab group by a";
		$db->query($sql2);
		$yun_row=$db->fetchRow();
		//查询车管本年审验总金额
		$sql3="select sum(chemoney) as totalchemoney,date_format(now(),'%Y') as a from `rv_shenyan` where company1='$_SESSION[company1]' and date_format(chedate,'%Y')=date_format(now(),'%Y') and carId=$ab group by a";
		$db->query($sql3);
		$che_row=$db->fetchRow();
		//本年该车辆服务费总金额
		$zongmoney=$yun_row[totalyunmoney]+$che_row[totalchemoney];
		
		//查询新增车辆每年需交的服务费
		$sql7="select fuwufei from `rv_car` where company1='$_SESSION[company1]' $search";
		$db->query($sql7);
		$row3=$db->fetchRow();
		//每月的服务费
		$monthMoney=$row3[fuwufei]/12;
		//查询车辆汇总表中该车辆的信息
		$sql4="select * from `rv_client` where company1='$_SESSION[company1]' $search";
		$db->query($sql4);
		$row4=$db->fetchRow();
		//如果输入的是负数金额
		if($_POST[yunmoney]<0){
			$yunmoney=$row4[yunmoney]+$_POST[yunmoney];
			//服务费交的月份
			$n=floor(($_POST[yunmoney])/$monthMoney);
			//将新增的数据插入`rv_client`表中
			if($row4[fwjzdate] != ""){
				$sql8="update `rv_client` set `money`='$zongmoney',`fwjzdate`=date_format(date_add(fwjzdate,interval '$n' month),'%Y-%c-%d'),`yundate`=date_format(now(),'%Y-%c-%d'),`yunmoney`='$yunmoney' where `company1`='$_SESSION[company1]' $search";
				if($db->query($sql8)){echo close($msg,"shenyan");}else{echo error($msg);}
			}else{
				$sql8="update `rv_client` set `money`='$zongmoney',`fwjzdate`=date_format(date_add(now(),interval '$n' month),'%Y-%c-%d'),`yundate`=date_format(now(),'%Y-%c-%d'),`yunmoney`='$yunmoney' where `company1`='$_SESSION[company1]' $search";
				if($db->query($sql8)){echo close($msg,"shenyan");}else{echo error($msg);}
			}
		}else{
			$yunmoney=$row4[yunmoney]+$_POST[yunmoney];
			//服务费交的月份
			$n=floor(($_POST[yunmoney])/$monthMoney);
			//将新增的数据插入`rv_client`表中
			if($row4[fwjzdate] != ""){
				$sql8="update `rv_client` set `money`='$zongmoney',`fwjzdate`=date_format(date_add(fwjzdate,interval '$n' month),'%Y-%c-%d'),`yundate`=date_format(now(),'%Y-%c-%d'),`yunmoney`='$yunmoney' where `company1`='$_SESSION[company1]' $search";
				if($db->query($sql8)){echo close($msg,"shenyan");}else{echo error($msg);}
			}else{
				$sql8="update `rv_client` set `money`='$zongmoney',`fwjzdate`=date_format(date_add(now(),interval '$n' month),'%Y-%c-%d'),`yundate`=date_format(now(),'%Y-%c-%d'),`yunmoney`='$yunmoney' where `company1`='$_SESSION[company1]' $search";
				if($db->query($sql8)){echo close($msg,"shenyan");}else{echo error($msg);}
			}
		}
	}else{
		echo error_car($msg);
	}
	exit;
}

if($do=="sureyun1"){
	If_rabc1($action,$do);
	If_comrabc($id,"`rv_shenyan`");
	$username=$_SESSION['username'];
	$sql="update `rv_shenyan` set `nameshen`='$username',`judgeyun`=4 where id='{$id}'";
	$db->query($sql);
	echo success($msg);
	exit;
}

if($do=="sureche1"){
	If_rabc1($action,$do);
	If_comrabc($id,"`rv_shenyan`");
	$username=$_SESSION['username'];
	$sql="update `rv_shenyan` set `nameshen`='$username',`judgeche`=4 where id='{$id}'";
	$db->query($sql);
	echo success($msg);
	exit;
}

//新增车管维护信息	
if($do=="newche"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"新增");
	$smt->display('shenyan_newche.htm');
	exit;
}

//写入车管维护信息
if($do=="addche"){
	If_rabc($action,$do); //检测权限
	if($_POST['carNum']){$search .= " and carNum ='$_POST[carNum]'";}
	if($_POST['chejiaNum']){$search .= " and chejiaNum ='$_POST[chejiaNum]'";}
	$sql="select chedanhao from `rv_shenyan` where company1='$_SESSION[company1]' and chedanhao!='' group by chedanhao,company1 order by chedanhao desc limit 1";
	$db->query($sql);
	$chedanhao_row=$db->fetchRow();
	$k=mysql_query($sql);
	$t=mysql_num_rows($k); 
	
	$sql6="select id from `rv_car` where company1='$_SESSION[company1]' $search";
	$a1=mysql_query($sql6);
	$b1=mysql_num_rows($a1);
	if($b1==1){
		$list_carid=mysql_fetch_assoc($a1);//变量是查询的结果
		$ab=$list_carid[id];
		//查询rv_shenyan表中是否有该车辆
		$sql="select * from `rv_shenyan` where company1='$_SESSION[company1]' and carId=$ab order by yundate desc LIMIT 1";
		$a2=mysql_query($sql);
		$b2=mysql_num_rows($a2);
		$row1=mysql_fetch_assoc($a2);
		if($b2>0){
		//rv_shenyan表中存在该车辆
			if($row1[chedate]!=0){
				//如果车管数据存在，则将新数据插入表中
				if($t>0){
					//审验表中有该公司的车管单号
					$sql="INSERT INTO `rv_shenyan` (`carId`,`chedate`,`chemoney`,`chedanhao`,`judgeche`,`company1`)
					VALUES ('$ab',now(),'$_POST[chemoney]','$chedanhao_row[chedanhao]'+1,1,'$_SESSION[company1]');";
				}else{
					$sql="INSERT INTO `rv_shenyan` (`carId`,`chedate`,`chemoney`,`chedanhao`,`judgeche`,`company1`)
					VALUES ('$ab',now(),'$_POST[chemoney]','$houzhui',1,'$_SESSION[company1]');";
				}
				$db->query($sql);
			}else{
				//如果车管数据不存在，则更新表中最新一条数据
				if($t>0){
					$sql="UPDATE `rv_shenyan` SET 
					`chedate` = now(),
					`chemoney` = '$_POST[chemoney]',
					`chedanhao`='$chedanhao_row[chedanhao]'+1,
					`judgeche`=1
					where company1='$_SESSION[company1]' and carId=$ab order by yundate desc LIMIT 1;";	
				}else{
					$sql="UPDATE `rv_shenyan` SET 
					`chedate` = now(),
					`chemoney` = '$_POST[chemoney]',
					`chedanhao`='$houzhui',
					`judgeche`=1
					where company1='$_SESSION[company1]' and carId=$ab order by yundate desc LIMIT 1;";	
				}
				$db->query($sql);
				}
			
		}else{
		//rv_shenyan表中不存在该车辆，将信息写入统计表中的维护车辆
			if($t>0){
				$sql1="INSERT INTO `rv_shenyan` (`carId`,`chedate`,`chemoney`,`chedanhao`,`judgeche`,`company1`)
				VALUES ('$ab',now(),'$_POST[chemoney]','$chedanhao_row[chedanhao]'+1,1,'$_SESSION[company1]');";
			}else{
				$sql1="INSERT INTO `rv_shenyan` (`carId`,`chedate`,`chemoney`,`chedanhao`,`judgeche`,`company1`)
				VALUES ('$ab',now(),'$_POST[chemoney]','$houzhui',1,'$_SESSION[company1]');";
			}
			$db->query($sql1);
		}
		//查询rv_shenyan表中的运管和车管金额
		//$sql="select * from `rv_shenyan` where company1='$_SESSION[company1]' and carId=$ab order by chedate,yundate desc LIMIT 1";
		//查询运管本年审验总金额
		$sql2="select sum(yunmoney) as totalyunmoney,date_format(now(),'%Y') as a from `rv_shenyan` where company1='$_SESSION[company1]' and date_format(yundate,'%Y')=date_format(now(),'%Y') and carId=$ab group by a";
		$db->query($sql2);
		$yun_row=$db->fetchRow();
		//查询车管本年审验总金额
		$sql3="select sum(chemoney) as totalchemoney,date_format(now(),'%Y') as a from `rv_shenyan` where company1='$_SESSION[company1]' and date_format(chedate,'%Y')=date_format(now(),'%Y') and carId=$ab group by a";
		$db->query($sql3);
		$che_row=$db->fetchRow();
		//本年该车辆服务费总金额
		$zongmoney=$yun_row[totalyunmoney]+$che_row[totalchemoney];
		//查询新增车辆每年需交的服务费
		$sql7="select fuwufei from `rv_car` where `company1`='$_SESSION[company1]' $search";
		$db->query($sql7);
		$row3=$db->fetchRow();
		//每月的服务费
		$monthMoney=$row3[fuwufei]/12;
		$sql4="select * from `rv_client` where company1='$_SESSION[company1]' $search";
		$db->query($sql4);
		$row4=$db->fetchRow();
		//输入的车管审验金额为负数
		if($_POST[chemoney]<0){
			$chemoney=$row4[chemoney]+$_POST[chemoney];
			//服务费交的月份
			$n=floor(($_POST[chemoney])/$monthMoney);
			//将新增的数据插入`rv_client`表中
			if($row4[fwjzdate] != ""){
				$sql8="update `rv_client` set `money`='$zongmoney',`fwjzdate`=date_format(date_add(fwjzdate,interval '$n' month),'%Y-%c-%d'),`chemoney`='$chemoney' where `company1`='$_SESSION[company1]' $search";
				if($db->query($sql8)){echo close($msg,"shenyan");}else{echo error($msg);}
			}else{
				$sql8="update `rv_client` set `money`='$zongmoney',`fwjzdate`=date_format(date_add(now(),interval '$n' month),'%Y-%c-%d'),`chemoney`='$chemoney' where `company1`='$_SESSION[company1]' $search";
				if($db->query($sql8)){echo close($msg,"shenyan");}else{echo error($msg);}
			}
		}else{
			$chemoney=$row4[chemoney]+$_POST[chemoney];
			//服务费交的月份
			$n=floor($_POST[chemoney]/$monthMoney);
			//将新增的数据插入`rv_client`表中
			if($row4[fwjzdate] != ""){
				$sql8="update `rv_client` set `money`='$zongmoney',`fwjzdate`=date_format(date_add(fwjzdate,interval '$n' month),'%Y-%c-%d'),`chedate`=date_format(now(),'%Y-%c-%d'),`chemoney`='$chemoney' where `company1`='$_SESSION[company1]' $search";
				if($db->query($sql8)){echo close($msg,"shenyan");}else{echo error($msg);}
			}else{
				$sql8="update `rv_client` set `money`='$zongmoney',`fwjzdate`=date_format(date_add(now(),interval '$n' month),'%Y-%c-%d'),`chedate`=date_format(now(),'%Y-%c-%d'),`chemoney`='$chemoney' where `company1`='$_SESSION[company1]' $search";
				if($db->query($sql8)){echo close($msg,"shenyan");}else{echo error($msg);}
			}
		}
	}else{
		echo error_car($msg);
	}
	exit;
}

?>