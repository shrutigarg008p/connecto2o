<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class User extends Admin_Controller
{
 
  function __construct()
  {
    parent::__construct();
    $this->load->model('admin/User_model');
  }
 
  public function index()
  {
    //$this->load->view('admin/login');
    redirect('admin/login');
  }
  public function login()
  { 
    if($this->input->post())
    {
      $this->form_validation->set_rules('userEmail', 'Email', 'required');
      $this->form_validation->set_rules('userPswd', 'Password', 'required');
      if($this->form_validation->run()===TRUE)
      {
        $email = $this->input->post('userEmail');
        $paswd = md5($this->input->post('userPswd')); 
        $auth  = $this->User_model->auth_login(array('email'=>$email,'password'=>$paswd)); 
        if(!empty($auth))
        { 
          $this->session->set_userdata(
                                 array('name'      =>ucwords($auth->name),
                                       'email'     =>ucwords($auth->email),
                                       'company_name'     =>ucwords($auth->company_name),
                                       'company_slug'     =>strtolower($auth->company_slug),
                                       'authId'    =>ucwords($auth->id),
                                       'userType'  =>$auth->userType,
                                       'lastLogin' =>date('Y-m-d h:i A'),
                                       'avatar'    =>$auth->avatar,
                                      )
                                  );
          $this->db->where('id',$auth->id)->update('users',array('lastLogin'=>date('Y-m-d H:i:s')));
          redirect(site_url('admin/dashboard'));
        }
        else
        {
          $this->session->set_flashdata('error','<div class="alert alert-danger">Your credentials are incorrect. </div>');
        }
      }
      else 
      {
          $this->session->set_flashdata('error','<div class="alert alert-danger">Invalid email or password. </div>');
      }
    }

    $this->load->view('admin/login');
  }
  
  public function logout()
  {
    $authItems = array('name', 'email','authId','userType','lastLogin','avatar');
    $this->session->unset_userdata($authItems);
    $this->session->set_flashdata('error','<div class="alert alert-success">You have logged out successfully.</div>');
    redirect('admin/login', 'refresh');
  }

}