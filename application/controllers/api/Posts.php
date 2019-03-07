<?php
defined('BASEPATH') OR exit('No direct script access allowed');
       
    require APPPATH . 'controllers/api/Auth.php';
    class Posts extends Auth {

        function __construct($config = 'auth') {
            parent::__construct($config);
			$this->load->model("PostsModel");
			$this->load->model("main_model");
			$this->load->library('form_validation');
            $this->cektoken();
        }

        /* index page */
        function index_get($id = '', $limit=10, $page=1) {
			$totaldata 	= $this->PostsModel->getTotaldata();
			$paging 	= $this->main_model->paging($totaldata, $page);
            if ($id == '') {
				$data 	= $this->PostsModel->getAll($paging->offset, $limit);
			} else {
				$data 	= $this->PostsModel->getById($id);
			}
			
			$this->set_response(array("data" => $data,'status'=>'success'), 200);
        }

        /*function index_post($table = '') { // baseurl/?table=nama_table
            $insert = $this->db->insert($table, $this->post());
            $id = $this->db->insert_id();
            if ($insert) {
                $response = array(
                    'data' => $this->post(),
                    'table' => $table,
                    'id' => $id,
                    'status' => 'success'
                    );
                $this->set_response($response, 200);
            } else {
                $this->set_response(array('status' => 'fail', 502));
            }
        }*/
		public function add_post()
		{
			$posts = $this->PostsModel;
			$errorMessage = [];
			if($this->post('title') == ''){
				$errorMessage[] = 'Title tidak boleh kosong.';
			}
			if($this->post('content') == ''){
				$errorMessage[] = 'Content tidak boleh kosong.';
			}
			if(count($errorMessage) == 0){
				$posts->save();
				if($this->db->affected_rows() == 1){
					$response = array(
                    'data' => $this->post(),
                    'table' => 'posts',
                    'status' => 'success'
                    );
					$this->set_response($response, 200);
				}else{
					$this->set_response(array('status' => 'fail', 502));
				}
			}else{
				$this->set_response($errorMessage);
			}

		}
	

		public function edit_post($id)
		{
			$posts = $this->PostsModel;
			$errorMessage = [];
			if($this->post('title') == ''){
				$errorMessage[] = 'Title tidak boleh kosong.';
			}
			if($this->post('content') == ''){
				$errorMessage[] = 'Content tidak boleh kosong.';
			}
			if(count($errorMessage) == 0){
				$posts->update($id);
				if($this->db->affected_rows() == 1){
					$response = array(
                    'data' => $this->post(),
                    'table' => 'posts',
                    'status' => 'success'
                    );
					$this->set_response($response, 200);
				}else{
					$this->set_response(array('status' => 'fail', 502));
				}
			}else{
				$this->set_response($errorMessage);
			}

		}
	

        /*function index_put($table = '', $id = '') { // baseurl/nama_table/id
            $get_id = 'id';
            $this->db->where($get_id, $id);
            $update = $this->db->update($table, $this->put());
            if ($update) {
                $response = array(
                    'data' => $this->put(),
                    'table' => $table,
                    'id' => $id,
                    'status' => 'success'
                    );
                $this->response($response, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }*/

        function index_delete($table = '', $id = '') {
            $get_id = 'id';
            $this->db->where($get_id, $id);
            $delete = $this->db->delete($table);
            if ($delete) {
                $response = array(
                    'table' => $table,
                    'id' => $id,
                    'status' => 'success'
                    );
                $this->response($response, 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
    }
    ?>