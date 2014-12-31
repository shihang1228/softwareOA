<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['sortid']){$search .= " and categoryId = '$_POST[sortid]'";}
	
	
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
	$info_num=mysql_query("SELECT rv_product.id,rv_product.name,rv_product.unit,rv_sort.category as b,model FROM `rv_product`,`rv_sort` where rv_product.categoryId = rv_sort.id and rv_product.company1 in ($arr2) $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	//查询
	$sql="SELECT rv_product.id,rv_product.name,rv_product.unit,rv_sort.category as b,model,rv_product.company1 FROM `rv_product`,`rv_sort` where rv_product.categoryId = rv_sort.id and rv_product.company1 in ($arr2) $search order by rv_product.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);	 
	$smt->assign('sortid_cn',select($list1,"sortid","","请选择"));//第一个参数是数组，第二个是要传递的字段名，第三个判断是否被选中
	$smt->assign('numPerPage',$numPerPage); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	//$smt->assign('title',"客户列表");
	$smt->display('product_list.htm');
	exit;	
}

//新增维护信息	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('sortid_cn',select($list1,"categoryId","","类别选择"));
	$smt->assign('title',"新增");
	$smt->display('product_new.htm');
	exit;
}

//写入维护信息
if($do=="add"){
	If_rabc($action,$do); //检测权限
	//先查询商品表中是否有该型号的产品，如果有则不能进行插入
	if($_POST['name']){$search .= " and name = '$_POST[name]'";}
	if($_POST['model']){$search .= " and model = '$_POST[model]'";}
	if($_POST['categoryId']){$search .= " and categoryId = '$_POST[categoryId]'";}
	$sql="select * from `rv_product` where 1=1 $search";
	$aa=mysql_query($sql);
	$bb=mysql_num_rows($aa);
	$i=0;
	if($bb<=$i){
	//商品表中不存在此商品，插入此商品
		//将型号中的英文()替换为中文（）
		$model1=str_replace("(","（",$_POST[model]);
		$model=str_replace(")","）",$model1);
		//将商品中的英文()替换为中文（）
		$name1=str_replace("(","（",$_POST[name]);
		$name=str_replace(")","）",$name1);
		$sql="INSERT INTO `rv_product` (`name` ,`model`,`unit` ,`categoryId`,`company1`)
		VALUES ('$name','$model','$_POST[unit]','$_POST[categoryId]','$_SESSION[company1]');";
		if($db->query($sql)){echo close($msg,"product");}else{echo error($msg);}
	}else{
		echo error_cun($msg);
	}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_product`");
	$sql="delete from `rv_product` where `id`=$id limit 1";
	if($db->query($sql)){echo success($msg);}else{echo error($msg);}		
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	If_comrabc($id,"`rv_product`");
	//查询
	$sql="SELECT * FROM `rv_product` where id='$id' LIMIT 1";
 	$db->query($sql);
	$row=$db->fetchRow();
	$smt = new smarty();smarty_cfg($smt);
	//模版
	$smt->assign('sortid_cn',select($list1,"categoryId",$row[categoryId],"类别选择"));
	$smt->assign('row',$row); 
	$smt->assign('title',"编辑");
	$smt->display('product_edit.htm');
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限	
	If_comrabc($_POST[id],"`rv_product`");
	if($_POST[id]){$id=$_POST[id];}
	else{$id=$_SESSION[id];}
	//将型号中的英文()替换为中文（）
	$model1=str_replace("(","（",$_POST[model]);
	$model=str_replace(")","）",$model1);
	//将商品中的英文()替换为中文（）
	$name1=str_replace("(","（",$_POST[name]);
	$name=str_replace(")","）",$name1);
	//sql
	$sql="UPDATE `rv_product` SET 
	`name` = '$name',`model` = '$model',`unit` = '$_POST[unit]',`categoryId` = '$_POST[categoryId]'
	WHERE `rv_product`.`id` ='$_POST[id]' LIMIT 1 ;";	
	if($db->query($sql)){echo close($msg,"product");}else{echo error($msg);}	
	exit;
}

?>