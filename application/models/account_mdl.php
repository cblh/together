<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_mdl extends CI_Model {

        public function __construct() {

            parent::__construct();
            $this->load->database();
        }

        public function init_data() {
            $data['sign_in_username'] = array(
              'name'        => 'username1',
              'id'          => 'username1',
              'class'       => 'form-control'
            );
        $data['sign_in_password'] = array(
              'name'        => 'password1',
              'id'          => 'password1',
              'class'       => 'form-control'
            );
        $data['sign_up_username'] = array(
              'name'        => 'username2',
              'id'          => 'username2',
              'class'       => 'form-control'
            );
        $data['sign_up_password'] = array(
              'name'        => 'password2',
              'id'          => 'password2',
              'class'       => 'form-control'
            );
        $data['sign_up_confirm'] = array(
              'name'        => 'confirm',
              'id'          => 'confirm',
              'class'       => 'form-control'
            );
        return $data;
        }
        public function login_data() {

            $check = $this->form_validation->set_rules('username1','Username','required|min_length[4]');
            $check = $this->form_validation->set_rules('password1','Password','required|min_length[6]');

            $data = array(
                'check' => $check,
                'username' => $this->input->post('username1'),
            );
            return $data;
        }

        public function check_user() {

            $data = array(
                'username' => $this->input->post('username1'),
                'password' => md5($this->input->post('password1')),
            );

            $this->db->where("username",$data['username']);
            $this->db->select("*");
            $query=$this->db->get("user");
            $str = $query->result_array();
//             echo $str;
//             var_dump($str);

            if (!empty($str)) {
            if ($str[0]['password'] == $data['password']) {

                return 1;
            }
            else {

                return 0;
            }
        } else {
            return 0;
        }
        }

        function sign_up_data() {

            $check['user'] = $this->form_validation->set_rules('username2','Username','required|min_length[4]|max_length[12]|is_unique[user.username]');
            $check['password'] = $this->form_validation->set_rules('password2','Password','required|min_length[6]|matches[confirm]');
            $check['confirm'] = $this->form_validation->set_rules('confirm','Password Confirmation','required');
           
            $return = array(
                'check' =>$check,
                'username' => $this->input->post('username2'),
            );
            return $return;

        }

        public function register() {
            
            $data = array(
                'username' => $this->input->post('username2'),
                'password' => md5($this->input->post('password2')),
            );

            /**
             *  检查注册的用户是否存在，存在返回0,不存在则插入到数据库中 
             */
            $this->db->where("username",$data['username']);
            $this->db->select("*");
            $query=$this->db->get("user");
            $str = $query->result_array();
//             echo $str;
//             var_dump($str);

            if (!empty($str)) {

                return 0;
            }
            else {

                $this->insert($data);
                return 1;
            }
        }

        public function insert($str) {

            $this->db->insert('user',$str);
        }

    }
?>