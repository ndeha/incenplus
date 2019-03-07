<?php
defined('BASEPATH') OR exit('No direct script access allowed');
       
require APPPATH . 'controllers/Users.php';
use Restserver\Libraries\REST_Controller;

class Posts extends Users {

	function __construct($config = 'users') {
		parent::__construct($config);
		$this->load->model("posts_model", 'PostsModel');
		$this->load->model("main_model");
		$this->cektoken();
	}

	/* index page */
	function index_get($id = '') {
		$limit		= isset($_GET['limit']) ? $_GET['limit'] : 10;
		$page		= isset($_GET['page']) ? $_GET['page'] : 1;
		
		$totaldata 	= $this->PostsModel->getTotaldata();
		$paging 	= $this->main_model->paging($totaldata, $limit, $page);
		
		if ($id == '') {
			$data 	= $this->PostsModel->getAll($paging->offset, $limit);
		} else {
			$data 	= $this->PostsModel->getById($id);
		}
		
		$this->set_response(array("data" => $data), REST_Controller::HTTP_OK);
	}

	public function add_post()
	{
		$posts 			= $this->PostsModel;
		$errorMessage 	= [];
		if($this->post('title') == ''){
			$errorMessage[] = 'Title tidak boleh kosong.';
		}
		if($this->post('content') == ''){
			$errorMessage[] = 'Content tidak boleh kosong.';
		}
		if(count($errorMessage) == 0){
			$posts->save();
			if($this->db->affected_rows() == 1){
				$this->set_response('success', REST_Controller::HTTP_OK);
			}else{
				$this->set_response('failed', REST_Controller::HTTP_BAD_GATEWAY);
			}
		}else{
			$this->set_response($errorMessage, REST_Controller::HTTP_BAD_GATEWAY);
		}
	}

	public function edit_post($id)
	{
		$posts 			= $this->PostsModel;
		$errorMessage 	= [];
		if($this->post('title') == ''){
			$errorMessage[] = 'Title tidak boleh kosong.';
		}
		if($this->post('content') == ''){
			$errorMessage[] = 'Content tidak boleh kosong.';
		}
		if(count($errorMessage) == 0){
			$posts->update($id);
			if($this->db->affected_rows() == 1){
				$this->set_response('success', REST_Controller::HTTP_OK);
			}else{
				$this->set_response('failed', REST_Controller::HTTP_BAD_GATEWAY);
			}
		}else{
			$this->set_response($errorMessage, REST_Controller::HTTP_BAD_GATEWAY);
		}
	}

	public function delete_delete($id) {
		$posts = $this->PostsModel;
		if($posts->delete($id)){
			$this->set_response('success', REST_Controller::HTTP_OK);
		}else{
			$this->set_response('failed', REST_Controller::HTTP_BAD_GATEWAY);
		}
	}
}
?>