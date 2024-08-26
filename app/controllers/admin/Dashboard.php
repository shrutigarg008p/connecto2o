<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends Admin_Controller
{
 

  function __construct()
  {
    parent::__construct();
    $this->data['page_title'] = 'Connecto2o QR App';
    $this->data['before_head'] = '';
    $this->data['before_body'] ='';
    _isLogin();
  }
 
  public function index()
  {
    //print_r($this->session->userdata());
    $this->render('admin/dashboard');
  }

}