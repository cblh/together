<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Codemirror_server extends CI_Controller {
	public function index()
	{
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
		}else if (isset($_GET["file"])) {
			//读取函数处理

			// $file=$_GET["file"];
			$file="/1.php";
			echo file_get_contents($file);
		}
		exit();
	}
}

/* End of file codemirror_server.php */
/* Location: ./application/controllers/codemirror_server.php */