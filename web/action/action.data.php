<?php
if(!defined('CORE'))exit("error!");


//数据管理	
if($do=="list"){	
	If_rabc($action,$do); //检测权限
	
	$dir = "./backup";
	$list=myreaddir($dir);
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('title',"恢复列表");
	$smt->display('data_list.htm');
	exit;	
}


//备份	
if($do=="backupupdata"){	
		If_rabc($action,$do); //检测权限
		
		$host = array($cfg["dbhost"],$cfg["dbuser"],$cfg["dbpass"],$cfg["dbname"]);
		$conn=mysql_connect($host[0],$host[1],$host[2]);
		mysql_select_db($host[3]);
		mysql_query("set names utf8");//注意编码
		$res=mysql_list_tables($host[3]);
		
		//得到数据库中所有的表
		while ($row = mysql_fetch_row($res))
		   $table[]=$row[0];
		
		//导出表的结构		   
		foreach ($table as $v){
			$sql.="DROP TABLE IF EXISTS `$v`;\n";   //如果导入是会先执行一段删除表.
			$create=mysql_query("SHOW CREATE TABLE $v");
			$rs = mysql_fetch_row($create);
			$tables =$rs[1].";\n\n";
		}
		//导出所有数据
		foreach ($table as $v){
			$res=mysql_query("select * from $v");
			while ($rs=mysql_fetch_array($res,MYSQL_NUM))
			{        
					foreach ($rs as $key => $val)
					$rs[$key] = mysql_escape_string($val);
					$inser = implode("','",$rs);
					$inse .= sprintf("INSERT INTO $v VALUES('%1s');",$inser)."\n";
			}
		}
		
		$path=CORE."/backup/".date('Y-m-d-h-m-s').'.sql';
		if(file_put_contents($path,$inse)){		
			echo "{\"statusCode\":\"200\",\"message\":\"数据备份成功,生成备份文件!".date('Y-m-d-h-m-s').'.sql'."\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=data&do=list\"}";
		}else{
			echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=data&do=list\"}";
		}
		
	exit;
}

//恢复	
if($do=="recoverupdata"){
		exit("{\"statusCode\":\"300\",\"message\":\"恢复数据功能禁用!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=data&do=recover\"}");
}

?>