<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

 	function __construct() {

            parent::__construct();
            $this->load->helper('form');
            $this->load->model('account_mdl');
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->library('session');
        }

	public function index()
	{
        if(($this->session->userdata('username'))){
            //echo '未登录';/*把引导放这里*/
            $this->load->view('welcome');   
        } 
        else {
		if(isset($_POST['sign_in'])) {
			$this->sign_in();
		}
		else if(isset($_POST['sign_up'])){
			$this->sign_up();
		}
		else { 
                $data = $this->account_mdl->init_data();
		
                $this->load->view('index.php',$data);
	}
            }
	}

	public function sign_in() {

		$data = $this->account_mdl->login_data();
  
            if($this->form_validation->run($data['check']) == FALSE) {

                $status['status'] = "输入有误";
                    $this->load->view("status",$status);
            }
            else {

                $flag=$this->account_mdl->check_user();
                if ($flag == 1) {
                    //$this->set_session();
                    $this->session->set_userdata(array('username' => $data['username']));
                    $this->load->view("welcome");
                    
                }
                else {
                    $status['status'] = "用户名或密码错误";
                    $status['md'] = md5($this->input->post('password1'));
                    $this->load->view("status",$status);
                    
                }
            }

	}

	public function sign_up() {

            $data = $this->account_mdl->sign_up_data();
            if($this->form_validation->run($data) == FALSE) {

               $status['status'] = "输入有误";
                    $this->load->view("status",$status);
            }
            else {

                $flag = $this->account_mdl->register();
                if ($flag == 0) {

                    $status['status'] = "用户名已被注册";
                    $this->load->view("status",$status);
                }
                else {

                    //$this->set_session();
                    $this->session->set_userdata(array('username' => $data['username']));
                    $status['status'] = "Succeed";
                    $this->load->view("welcome");
                }
            }

        }
}