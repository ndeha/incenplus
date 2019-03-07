<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;
use Restserver\Libraries\REST_Controller;

class Users extends MY_Controller {	
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('users_model', 'UsersModel');
    }
		
    public function login_post()
    {
        $username 			= $this->post('username'); //Username Posted
		$password			= $this->post('password'); //Pasword Posted
		$kunci 				= $this->config->item('thekey');
		if ($username == '' && $password == ''){ 
			$this->response('Username dan password tidak boleh kosong.', REST_Controller::HTTP_NOT_FOUND);
        }else if($username == ''){ 
			$this->response('Username tidak boleh kosong.', REST_Controller::HTTP_NOT_FOUND);
		}else if($password == ''){
			$this->response('Password tidak boleh kosong.', REST_Controller::HTTP_NOT_FOUND);
		}else if($password){
			$password = sha1($password);
		}
		
        $filter		= array('username' => $username);
        $val 		= $this->UsersModel->get_user($filter)->row();
		
        if($this->UsersModel->get_user($filter)->num_rows() == 0){$this->response('Username tidak terdaftar', REST_Controller::HTTP_NOT_FOUND);}
		if($val->active == 0) {$this->response('Akun tidak aktif', REST_Controller::HTTP_NOT_FOUND);}
		
		$match = $val->password;   //Get password for user from database
        if($password == $match){  //Condition if password matched
        	$token['id'] 			= $val->id;  //From here
            $token['username'] 		= $username;
            $output['token_key'] 	= JWT::encode($token, $kunci); //This is the output token
            $this->set_response($output, REST_Controller::HTTP_OK); //This is the respon if success
        }
        else {
            $this->set_response('Password salah', REST_Controller::HTTP_NOT_FOUND); //This is the respon if password not match
        }
    }
	
	public function cektoken()
	{
		$jwt 	= $this->input->get_request_header('Authorization');
		$kunci 	= $this->config->item('thekey');
		try {
			$decode = JWT::decode($jwt,$kunci,array('HS256'));
			if($this->UsersModel->get_user(array('username' => $decode->username))->num_rows() > 0){
				$this->session->set_userdata('user_id', $decode->id);
				return true;
			}
		} catch (Exception $e) {
			$this->set_response(['status'=>'Unauthorized'], REST_Controller::HTTP_UNAUTHORIZED);
			exit(json_encode('Unauthorized'));
		}
	}

}
