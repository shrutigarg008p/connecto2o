<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Ajax_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function item_by_type($type_id = false)
	{  
	   $html='<option value="">-Select-</option>';
	   $this->db->where('itemTypeId',$type_id);
       $result= $this->db->get($this->db->dbprefix('item_variaties'))->result();
		foreach ($result as $res) {
			$html .='<option value="'.$res->id.'">'.$res->variatyName.'</option>';
		}
		return $html;
	}  

	public function mandi_by_state($state_id = false)
	{  
	   $html='<option value="">-Select-</option>';
	   $this->db->where('state_id',$state_id);
       $result= $this->db->get($this->db->dbprefix('mandi'))->result();
		foreach ($result as $res) {
			$html .='<option value="'.$res->id.'">'.$res->mandi.'</option>';
		}
		return $html;
	}  

	public function item_by_type_view($type_id = false)
	{  
	   $html=array();
	   $this->db->where('itemTypeId',$type_id);
       $result= $this->db->get($this->db->dbprefix('item_variaties'))->result();
		foreach ($result as $res) {
			$html[$res->id]=$res->variatyName;
		}
		return $html;
	}  

	public function mandi_by_state_view($state_id = false)
	{  
	   $html=array();
	   $this->db->where('state_id',$state_id);
       $result= $this->db->get($this->db->dbprefix('mandi'))->result();
		foreach ($result as $res) {
			$html[$res->id]=$res->mandi;
		}
		return $html;
	}  

	

}