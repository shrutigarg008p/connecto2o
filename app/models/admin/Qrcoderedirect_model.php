<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Qrcoderedirect_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function save_rows($data = array())
	{
		
	
		if(!empty($data['id'])) 
		{
		   $this->db->where('id',$data['id']);
           $this->db->update($this->db->dbprefix('master_redirect'),$data);
           return $data['id'];
		}
		else 
		{
		
           $this->db->insert($this->db->dbprefix('master_redirect'),$data);
           return $this->db->insert_id();
		}
		
	}

    function row_count($search_text='search_text')
    {
		
	    if($search_text!='search_text') 
	    {
			$this->db->group_start();
			$this->db->or_like(array('redi_url'=>$search_text,'key_value'=>$search_text));
		    $this->db->group_end();
	    }
		$this->db->select('*');
        $this->db->from($this->db->dbprefix('master_redirect'));
        $result = $this->db->get()->result();
		return count($result);
	  
    }
     function data_rows($limit,$start,$search_text='search_text')
	 {
		 
		$this->db->limit($limit,$start);
		 if($search_text!='search_text') 
	    {
			  $this->db->group_start();
			  $this->db->or_like(array('redi_url'=>$search_text,'key_value'=>$search_text));
		      $this->db->group_end();
	    }
		$this->db->select('*');
        $this->db->from($this->db->dbprefix('master_redirect'));
		$this->db->order_by('id','desc');
        $result = $this->db->get()->result();
		return $result;
	

    }   

    public function delete_row($user_id = false)
	{
		if($user_id) 
		{
		   $this->db->where('id',$user_id);
           $this->db->delete($this->db->dbprefix('master_redirect'));
		}
		return true;
	}


    public function get_row($user_id = false)
	{
	   $this->db->where('id',$user_id);
       return $this->db->get($this->db->dbprefix('master_redirect'))->row();
		
	}



}