<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Qrcode_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function save_rows($data = array())
	{
		if(!empty($data['id'])) 
		{

		   $this->db->where('id',$data['id']);
           $this->db->update($this->db->dbprefix('qrcode'),$data);
           return $data['id'];
		}
		else 
		{
			if($this->session->userdata('userType')=='company')
			{
		    	$user_id= $this->session->userdata('authId');
		    	$data['user_id']=$user_id;
	    	}
           $this->db->insert($this->db->dbprefix('qrcode'),$data);
           return $this->db->insert_id();
		}
		
	}

    function row_count($search_text='search_text')
    {
	
		if($this->session->userdata('userType')=='company'){
	    	$user_id= $this->session->userdata('authId');
	    	$this->db->where('user_id',$user_id);
	    }
	    if($search_text!='search_text') 
	    {
			$this->db->group_start();
			$this->db->or_like(array('url'=>$search_text,'description'=>$search_text));
		    $this->db->group_end();
	    }
		$this->db->select('*');
        $this->db->from($this->db->dbprefix('qrcode'));
        $result = $this->db->get()->result();
		return count($result);
	  
    }
     function data_rows($limit,$start,$search_text='search_text')
	 {

	 	if($this->session->userdata('userType')=='company'){
	    	$user_id= $this->session->userdata('authId');
	    	$this->db->where('user_id',$user_id);
	    }
		 
		$this->db->limit($limit,$start);
		 if($search_text!='search_text') 
	    {
			  $this->db->group_start();
			  $this->db->or_like(array('url'=>$search_text,'description'=>$search_text));
		      $this->db->group_end();
	    }
		$this->db->select('*');
        $this->db->from($this->db->dbprefix('qrcode'));
		$this->db->order_by('id','desc');
        $result = $this->db->get()->result();
		return $result;
	

    }   

    public function delete_row($user_id = false)
	{
		if($user_id) 
		{
		   $this->db->where('id',$user_id);
           $this->db->delete($this->db->dbprefix('qrcode'));
		}
		return true;
	}


    public function get_row($user_id = false)
	{
	   $this->db->where('id',$user_id);
       return $this->db->get($this->db->dbprefix('qrcode'))->row();
		
	}



}