<?php
if(isset($_POST["data"])){
	//保存函数处理
	$file=$_POST["file"];
	$data=$_POST["data"];
	echo $file;
	$status="save successfully";
	if (file_put_contents($file, $data)) {
		echo " ".$status;
	}
		


}else if (isset($_POST["file"])) {
	//读取函数处理
	$file=$_POST["file"];
	echo file_get_contents($file);
}
// echo file_put_contents("1.php", "This is something.");
exit();


