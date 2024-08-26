<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Ajax extends Admin_Controller
{
 
 function __construct()
  {
    parent::__construct();
    _isLogin();

    $this->load->model('admin/Ajax_model');
    $this->load->library('pagination');
    $this->load->library(array('form_validation'));
  }
 

 function item_by_type() 
   {
    if(!empty($_POST['type_id'])) 
    {
     $type_id =$_POST['type_id'];
     $result=$this->Ajax_model->item_by_type($type_id);      
     echo $result; die;
    }
    else 
    {
     redirect(base_url());
    }
   }

  function mandi_by_state() 
   {
    if(!empty($_POST['state_id'])) 
    {
     $state_id =$_POST['state_id'];
     $result=$this->Ajax_model->mandi_by_state($state_id);      
     echo $result; die;
    }
    else 
    {
     redirect(base_url());
    }
   }

   
}