<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class AuthModel extends CI_Model{

	function get_user($q) {
		return $this->db->get_where('users',$q);
	}
}