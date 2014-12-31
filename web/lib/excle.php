<?php
header("Content-type: text/html; charset=utf-8");
function print_excle($sql){     
	//文件类型
	$file_type = "vnd.ms-excel";  
	//文件后缀名
	$file_ending = "xls";  
	header("Content-Type: application/$file_type;charset=utf-8");   
	header("Content-Disposition: attachment; filename=导出.$file_ending");          
	mysql_query("Set Names 'gbk'");          
	$result = @mysql_query($sql);    
	/* t是下一列，n是下一行 */
	$sep = "\t";
	$sep1 = "\n";
	//输出表头~查找结果字段名    
	for ($i = 0; $i < mysql_num_fields($result); $i++) {  //mysql_num_fields()返回结果集中字段的数目
		echo mysql_field_name($result,$i) . $sep;    //取得结果中指定字段的字段名      
	}       
	print($sep1);       
	$i = 0;       
	while($row = mysql_fetch_row($result)) {       
		$schema_insert = "";  
		//判断表头个数
		for($j=0; $j<mysql_num_fields($result);$j++) {       
			if(!isset($row[$j]))       
				$schema_insert .= "NULL".$sep;       
			elseif ($row[$j] != "")       
				$schema_insert .= "$row[$j]".$sep;  
			else       
				$schema_insert .= "".$sep;       
		}        
		//去掉左右两边空格
		print(trim($schema_insert).$sep1); 
		//换行
		//print($sep1);       
		$i++;       
	} 
	//结束函数并返回true  
	return (true);
}


?>