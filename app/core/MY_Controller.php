<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
  protected $data = array();
  function __construct()
  {
    parent::__construct();
    $this->data['page_title'] = 'Connecto2o QR App';
    $this->data['before_head'] = '';
    $this->data['before_body'] ='';
  }

  protected function render($the_view = NULL, $template = 'public')
  {
    if($template == 'json' || $this->input->is_ajax_request())
    {
      header('Content-Type: application/json');
      echo json_encode($this->data);
    }
    else
    {
      $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);;
      $this->load->view('layout/'.$template, $this->data);
    }
  }
}

class Admin_Controller extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->data['page_title'] = 'Connecto2o QR App - Dashboard';
  }

  protected function render($the_view = NULL, $template = 'admin')
  {
    parent::render($the_view, $template);
  }
}

class Public_Controller extends MY_Controller
{

 function __construct()
  {
    parent::__construct();
  $this->data['page_title'] = 'Connecto2o Qr App';
  $this->data['meta_key'] = '';
  $this->data['meta_desc'] = '';
  }

  protected function render($the_view = NULL, $template = 'public')
  {
    parent::render($the_view, $template);
  }
}