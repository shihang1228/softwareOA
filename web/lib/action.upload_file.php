<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

function uploadfile(){
	/* if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/pjpeg"))//IE浏览器识别jpg的方式
	&& ($_FILES["file"]["size"] < 2000000))
	{ */
		/* if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			$location="error";
		}else{ */
			echo "文件名: " . $_FILES["file"]["name"] . "<br />";
			echo "文件类型: " . $_FILES["file"]["type"] . "<br />";
			echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "临时文件: " . $_FILES["file"]["tmp_name"] . "<br />";

			if (file_exists("../upload/" . md5($_FILES["file"]["name"])))
			{
				echo $_FILES["file"]["name"] . " 已经存在. ";
				$location="exists";
			}
			else{
				move_uploaded_file($_FILES["file"]["tmp_name"],
				"../upload/" . md5($_FILES["file"]["name"]).".jpg");//../表示上级目录	
				echo "存储在: " . "..upload/" . md5($_FILES["file"]["name"]);
				$location="../upload/" . md5($_FILES["file"]["name"]).".jpg";
			}
		//}
	/* }else{
		echo "无效的文件";
		$location="void";
	} */
	return $location;
}
  
?>