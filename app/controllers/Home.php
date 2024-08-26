<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

 
 function __construct()
  {
    parent::__construct();
    $this->load->model('Home_model');
  }

	public function index()
	{
		echo "Welcome to connecto2o.com";die;
	}

	public function nikon()
	{
		$currentURL = current_url();
		$path = parse_url($currentURL, PHP_URL_PATH);
		$pathFragments = explode('/', $path);
		$endurl = end($pathFragments);

		$endurl = str_replace('-', '', $endurl);
	
		$data = $this->Home_model->getData($endurl); 
		if ($endurl= $data->key_value) {
			//	echo $data->redi_url;
			//redirect($data->redi_url); 
			$this->data['rurl'] =$data->redi_url;
			$this->render('home');
		}
		else {
			
			redirect(base_url()); 
		}


		//$this->data["qrcode"]      = $this->Home_model->get_qrcode();

	}
	
}
