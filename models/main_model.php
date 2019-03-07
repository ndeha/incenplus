<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function paging($jmlData, $limit=10, $p=1) {
        $this->load->library('paging');
        $cfg['page'] 		= $p;
        $cfg['per_page'] 	= $limit;
        $cfg['num_rows'] 	= $jmlData;
        $this->paging->init($cfg);

        return $this->paging;
    }
}

?>
