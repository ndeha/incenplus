<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Users_model extends CI_Model{

	function get_user($q) {
		return $this->db->get_where('users',$q);
	}
}