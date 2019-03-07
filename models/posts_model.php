<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model
{
    private $_table = "posts";

    public function getAll($offset='', $limit=10)
    {
		$sql   = "
				SELECT *
				From posts
				ORDER BY id DESC
				LIMIT $limit OFFSET $offset
				";
				
		$query 	= $this->db->query($sql);
		$data	= $query->result();
        return $data;
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

	public function GetTotaldata() {
		
		$sql   = "
				SELECT DISTINCT(id)
				FROM posts
				";
		
		$query = $this->db->query($sql);
		$data=$query->num_rows();
		
        return $data;
    }
	
    public function save()
    {
        $post 				= $this->input->post();
        $this->title 		= $post["title"];
        $this->content 		= $post["content"];
		$this->created_by 	= $this->session->userdata('user_id');
        $this->active 		= isset($post["active"]) ? $post["active"] : 1;
		$this->created_at 	= Date('Y-m-d H:i:s');
        $this->db->insert($this->_table, $this);
    }

    public function update($id)
    {
        $post 				= $this->input->post();
        $this->title 		= $post["title"];
        $this->content 		= $post["content"];
		$this->updated_by 	= $this->session->userdata('user_id');
        $this->active 		= isset($post["active"]) ? $post["active"] : 1;
		$this->updated_at 	= Date('Y-m-d H:i:s');
        $this->db->update($this->_table, $this, array('id' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}