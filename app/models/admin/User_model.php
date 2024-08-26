<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class User_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function auth_login($data = array())
	{
		$this->db->where('status','Active');
		if(!empty($data['email'])) {
			$this->db->where('email',$data['email']);
		}
		if(!empty($data['password'])) {
			$this->db->where('password',$data['password']);
		}
		$response = $this->db->get('users')->row();
		//echo $this->db->last_query();die;
		return $response;
	}


	public function save_user($data = array())
	{
		if(!empty($data['id'])) 
		{
		   $this->db->where('id',$data['id']);
           $this->db->update($this->db->dbprefix('users'),$data);
           return $data['id'];
		}
		else 
		{
			///for slug /////////
		   $ex        = explode(' ',$data['company_name']);
		   $slug_name = strtolower($ex[0]);
		   $slug      = $this->get_by_Slug($slug_name);

		   $data['company_slug']=$slug_name;
		   if(!empty($slug)){
		   	$data['company_slug']=$data['company_slug'].'-'.$slug;
		   }
		   ////////end//////
           $this->db->insert($this->db->dbprefix('users'),$data);
           return $this->db->insert_id();
		}
		
	}

	public function get_by_Slug($slug =false)	
	{
		$return =array();
		if($slug) 
		{
			$result = $this->db->like('company_slug',$slug)->get('ci_users')->result();
           //$result = $this->db->where('company_slug',$slug)->get('ci_users')->result();
		   return count($result);
		}
	}


	#####################Company-FETCH DATA##############
    function user_count($search_text='search_text')
    {
		
	    if($search_text!='search_text') 
	    {
			$this->db->group_start();
			$this->db->or_like(array('name'=>$search_text,'company_name'=>$search_text,'mobile'=>$search_text,'userType'=>$search_text));
		    $this->db->group_end();
	    }
	    $this->db->where('userType <>','admin');
		$this->db->select('*');
        $this->db->from($this->db->dbprefix('users'));
        $result = $this->db->get()->result();
		return count($result);
	  
    }
     function user_rows($limit,$start,$search_text='search_text')
	 {
		 
		$this->db->limit($limit,$start);
		$this->db->where('userType <>','admin');
		if($search_text!='search_text') 
	    {
			  $this->db->group_start();
			  $this->db->or_like(array('name'=>$search_text,'mobile'=>$search_text,'company_name'=>$search_text,'userType'=>$search_text));
		      $this->db->group_end();
	    }
		$this->db->select('*');
        $this->db->from($this->db->dbprefix('users'));
		$this->db->order_by('id','desc');
        $result = $this->db->get()->result();
		return $result;
	

    }   

    public function delete_user($user_id = false)
	{
		if($user_id) 
		{
		   $this->db->where('id',$user_id);
           $this->db->delete($this->db->dbprefix('users'));
		}
		return true;
	}


    public function get_user($user_id = false)
	{
	   $this->db->where('id',$user_id);
       return $this->db->get($this->db->dbprefix('users'))->row();
		
	}


}