<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Qrcodesredirect extends Admin_Controller
{
 
 function __construct()
  {
    parent::__construct();
    _isLogin();

    $this->load->model('admin/Qrcoderedirect_model');
    $this->load->library('pagination');
    $this->load->library(array('form_validation'));
  }
 
   public function index() {
    redirect(base_url().'admin/qrcodesredirect/view');
   }
   public function view($perpage = 0, $offset = 0) 
   {
           

        if($perpage != 0)  {
            $perpage = $perpage;
            $this->data['per_page'] = $perpage;
        } 
        else  {
            $perpage = 40;
            $this->data['per_page'] = '1';
        }

        $total_records=$this->Qrcoderedirect_model->row_count();

        $config['base_url']          = base_url().'admin/qrcodesredirect/view/'.$perpage;
        $config['total_rows']        = $total_records;
        $config['per_page']          = $perpage;
        $config['uri_segment']       = 5 ;
        $config['page_query_string'] = 'FALSE';
        $config['full_tag_open']     = '<ul class="pagination">';
        $config['full_tag_close']    = '</ul>';
        $config['first_link']        = false;
        $config['last_link']         = false;
        $config['first_tag_open']    = '<li>';
        $config['first_tag_close']   = '</li>';
        $config['prev_link']         = '<<';
        $config['prev_tag_open']     = '<li class="prev">';
        $config['prev_tag_close']    = '</li>';
        $config['next_link']         = '>>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']    = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']    = '</li>';
        $config['cur_tag_open']      = '<li class="active"><a href="#">';
        $config['cur_tag_close']     = '</a></li>';
        $config['num_tag_open']      = '<li>';
        $config['num_tag_close']     = '</li>';
        $this->pagination->initialize($config);

        $this->data["result"]     = $this->Qrcoderedirect_model->data_rows($perpage, $offset,'search_text');
        $this->data['row_count']  = $total_records;
        $this->data['pagination'] = $this->pagination->create_links();
        $data['current']='view';
        if($offset==0) {
             $this->data['offset']=1;
        } else {
           $this->data['offset']=$offset+1;
        }
          
        $this->render('admin/qrcoderedirect_view');
   }
    
    public function search($search_text = 'search_text', $perpage = 0, $offset = 0)
    {
        
        if($perpage != 0)  {
            $perpage = $perpage;
            $this->data['per_page'] = $perpage;
        } 
        else  {
            $perpage = 5;
            $this->data['per_page'] = '1';
        }
        $search_text = ($this->input->get("search_text"))? $this->input->get("search_text") : $search_text;
        $total_records=$this->Qrcoderedirect_model->row_count($search_text);
        $config['base_url']   = base_url().'admin/qrcodesredirect/search/'.$search_text.'/'.$perpage;
        $config['total_rows'] = $total_records;
        $config['per_page']   =   $perpage;
        $config['uri_segment']= 6;
        $config['page_query_string'] = 'FALSE';
        $config['full_tag_open']     = '<ul class="pagination">';
        $config['full_tag_close']    = '</ul>';
        $config['first_link']        = false;
        $config['last_link']         = false;
        $config['first_tag_open']    = '<li>';
        $config['first_tag_close']   = '</li>';
        $config['prev_link']         = '<<';
        $config['prev_tag_open']     = '<li class="prev">';
        $config['prev_tag_close']    = '</li>';
        $config['next_link']         = '>>';
        $config['next_tag_open']     = '<li>';
        $config['next_tag_close']    = '</li>';
        $config['last_tag_open']     = '<li>';
        $config['last_tag_close']    = '</li>';
        $config['cur_tag_open']      = '<li class="active"><a href="#">';
        $config['cur_tag_close']     = '</a></li>';
        $config['num_tag_open']      = '<li>';
        $config['num_tag_close']     = '</li>';
        $this->pagination->initialize($config);
        //#####################Pagination Theming END###############
        $this->data["result"]     = $this->Qrcoderedirect_model->data_rows($perpage, $offset,$search_text);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['search_text']= $search_text;

        $this->data['current']='search';
        if($offset==0) {
         $this->data['offset']=1;
        } else {
         $this->data['offset']=$offset+1;
        }

        $this->render('admin/qrcoderedirect_view');
    }
   public function edit($qrcoderedirect_id=false)
    {
        $qrcoderedirect_id = base64_decode($qrcoderedirect_id);
        if($qrcoderedirect_id)  
        {
          $this->data['result']=$this->Qrcoderedirect_model->get_row($qrcoderedirect_id);
          
          if($this->input->post()) 
          {
          $this->form_validation->set_error_delimiters('<span class="err">', '</span>');
          $this->form_validation->set_rules('url', 'url', 'trim|required');
          $this->form_validation->set_message('required', '%s is required.');
              if ($this->form_validation->run() == FALSE)
              {
                      
                  $this->render('admin/qrcoderedirect_add');
              }
              else
              {   
                $insert = array('url'=>$this->input->post('url'),
                               'id'     =>$this->input->post('id')
                             );


                      $response=$this->Qrcoderedirect_model->save_rows($insert);
                      if($response) 
                      {
                            $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Data updated successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                      } 
                      else 
                      {
                           $this->session->set_flashdata('error', '<div class="alert alert-error"><i class="fa fa-check-circle"></i>Oops: Something went wrong. please try again.<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                      }
                       redirect('admin/qrcodesredirect/view');
              }
          }
          else 
          {
              $this->render('admin/qrcoderedirect_edit');
          }
        }
        else {
            redirect(base_url());
        }
    }

   public function delete($qrcoderedirect_id=false)
   {
    $qrcoderedirect_id = base64_decode($qrcoderedirect_id);
    if($qrcoderedirect_id) 
    {
     $this->Qrcoderedirect_model->delete_row($qrcoderedirect_id);
     $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Data has been deleted successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
     redirect($_SERVER['HTTP_REFERER']);
    }
    else 
    {
     redirect(base_url());
    }
   }

   public function del_file($field=false,$qrcoderedirect_id=false){
    $qrcoderedirect_id = base64_decode($qrcoderedirect_id);
    if($qrcoderedirect_id && $field) 
    {
     $data = array($field=>'');
     $this->db->where('id',$qrcoderedirect_id);
     $this->db->update($this->db->dbprefix('master_redirect'),$data);

     $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Data has been updated successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
     redirect($_SERVER['HTTP_REFERER']);
    }
    else 
    {
     redirect(base_url());
    }
   }

   

  public function add()
   {
       if($this->input->post()) 
       {

          $this->form_validation->set_error_delimiters('<span class="err">', '</span>');
          $this->form_validation->set_rules('key_value', 'Key value', 'trim|required');
          $this->form_validation->set_rules('redi_url', 'Redirect url', 'trim|required');
          $this->form_validation->set_message('required', '%s is required.');
          if ($this->form_validation->run() == FALSE)
            {
                $this->render('admin/qrcoderedirect_add');
            }
            else
            {   
              $insert = array('key_value'=>$this->input->post('key_value'),'redi_url'=>$this->input->post('redi_url'));
                    $response=$this->Qrcoderedirect_model->save_rows($insert);

                    if($response) 
                    {
                          $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Data inserted successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                    } 
                    else 
                    {
                         $this->session->set_flashdata('error', '<div class="alert alert-error"><i class="fa fa-check-circle"></i>Oops: Something went wrong. please try again.<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                    }
                    redirect('admin/qrcodesredirect/view');
            }
        }
        else 
        {
           $this->render('admin/qrcoderedirect_add');
        }
   }

     
}