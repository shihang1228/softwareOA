<?php
if(!defined('CORE'))exit("error!"); 
	
		//分期付款提醒
		$p_action="fenqicarwarn";
		//获取当前用户
		$userid=$_SESSION['userid'];
		//查询当前用户角色权限
		$sql="SELECT r.action FROM `rv_user` as u,`rv_role` as r
		where u.id='$userid' and u.roleid = r.id LIMIT 1";
		$db->query($sql);
		$row=$db->fetchRow();
		$q_action = explode(',',$row['action']);
		//检测是否有权限
		$count=0;
		if(in_array($p_action,$q_action)){
		//如果有权限
			$sql1="SELECT a.id,a.carId,carNum,b.money,b.totalmoney,b.repaydate,b.totalyear,(b.totalmoney-money) as lastmoney, b.beizhu,a.truedate,a.judge FROM (select * from rv_fenqicar where company1='$_SESSION[company1]' order by truedate desc) as a,(select `rv_fenqicar`.*,sum(getmoney) as money from `rv_fenqicar` where company1='$_SESSION[company1]' GROUP BY carId order by id asc) as b, `rv_car` where a.carId=b.carId and a.carId=rv_car.id and a.company1='$_SESSION[company1]' group by carId";
			$db->query($sql1);
			$fen_list=$db->fetchAll();
			foreach($fen_list as $key=>$val){
				if($val[lastmoney]>0 && date('Y')>date('Y',strtotime($val[truedate])) && date('m')>=($val[repaydate]-1)){
					$count=$count+1;
				}
			}
		}
//首页	
if($do==""){
	global $count;//不是在一开始将变量设为global，而是在需要的时候在加global
	if(!isLogin()){exit($lang_cn['rabc_is_login']);} //exit输出一个消息并且退出当前脚本,判断是否登录,如果没有登录action=user&do=login进入登录界面，如果已经登录则进入index.htm界面
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('count',$count);
	$smt->display('index.htm');
	exit;
}



?>
