<?php
header("Content-type: text/html; charset=utf-8");
function print_excle($sql){     
	//�ļ�����
	$file_type = "vnd.ms-excel";  
	//�ļ���׺��
	$file_ending = "xls";  
	header("Content-Type: application/$file_type;charset=utf-8");   
	header("Content-Disposition: attachment; filename=����.$file_ending");          
	mysql_query("Set Names 'gbk'");          
	$result = @mysql_query($sql);    
	/* t����һ�У�n����һ�� */
	$sep = "\t";
	$sep1 = "\n";
	//�����ͷ~���ҽ���ֶ���    
	for ($i = 0; $i < mysql_num_fields($result); $i++) {  //mysql_num_fields()���ؽ�������ֶε���Ŀ
		echo mysql_field_name($result,$i) . $sep;    //ȡ�ý����ָ���ֶε��ֶ���      
	}       
	print($sep1);       
	$i = 0;       
	while($row = mysql_fetch_row($result)) {       
		$schema_insert = "";  
		//�жϱ�ͷ����
		for($j=0; $j<mysql_num_fields($result);$j++) {       
			if(!isset($row[$j]))       
				$schema_insert .= "NULL".$sep;       
			elseif ($row[$j] != "")       
				$schema_insert .= "$row[$j]".$sep;  
			else       
				$schema_insert .= "".$sep;       
		}        
		//ȥ���������߿ո�
		print(trim($schema_insert).$sep1); 
		//����
		//print($sep1);       
		$i++;       
	} 
	//��������������true  
	return (true);
}


?>