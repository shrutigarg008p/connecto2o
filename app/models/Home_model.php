<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	
     function get_qrcode()
	 {
		 
        $result =$this->db->from($this->db->dbprefix('qrcode'))->order_by('id','desc')->get()->result();
		return $result;
    }   

    function getData($key)
    {
 
		$query = $this->db->get_where('ci_master_redirect', ['key_value' => $key])->row();
		return $query; 


		 
    }


}