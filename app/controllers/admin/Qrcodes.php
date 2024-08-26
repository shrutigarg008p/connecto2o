<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Qrcodes extends Admin_Controller
{
 
 function __construct()
  {
    parent::__construct();
    _isLogin();

    $this->load->model('admin/Qrcode_model');
    $this->load->library('pagination');
    $this->load->library(array('form_validation'));
  }
 
   public function index() {
    redirect(base_url().'admin/qrcodes/view');
   }
   public function view($perpage = 0, $offset = 0) 
   {
           

        if($perpage != 0)  {
            $perpage = $perpage;
            $this->data['per_page'] = $perpage;
        } 
        else  {
            $perpage = 5;
            $this->data['per_page'] = '1';
        }

        $total_records=$this->Qrcode_model->row_count();
        $config['base_url']          = base_url().'admin/qrcodes/view/'.$perpage;
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

        $this->data["result"]     = $this->Qrcode_model->data_rows($perpage, $offset,'search_text');
        $this->data['row_count']  = $total_records;
        $this->data['pagination'] = $this->pagination->create_links();
        $data['current']='view';
        if($offset==0) {
             $this->data['offset']=1;
        } else {
           $this->data['offset']=$offset+1;
        }
          
        $this->render('admin/qrcode_view');
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
        $total_records=$this->Qrcode_model->row_count($search_text);
        $config['base_url']   = base_url().'admin/qrcodes/search/'.$search_text.'/'.$perpage;
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
        $this->data["result"]     = $this->Qrcode_model->data_rows($perpage, $offset,$search_text);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['search_text']= $search_text;

        $this->data['current']='search';
        if($offset==0) {
         $this->data['offset']=1;
        } else {
         $this->data['offset']=$offset+1;
        }

        $this->render('admin/qrcode_view');
    }
   public function edit($qrcode_id=false)
    {
        $qrcode_id = base64_decode($qrcode_id);
        if($qrcode_id)  
        {
          $this->data['result']=$this->Qrcode_model->get_row($qrcode_id);
          
          if($this->input->post()) 
          {
          $this->form_validation->set_error_delimiters('<span class="err">', '</span>');
          $this->form_validation->set_rules('url', 'url', 'trim|required');
          $this->form_validation->set_message('required', '%s is required.');
              if ($this->form_validation->run() == FALSE)
              {
                      
                  $this->render('admin/qrcode_add');
              }
              else
              {   
                $insert = array('url'=>$this->input->post('url'),
                               'id'     =>$this->input->post('id')
                             );


                      $response=$this->Qrcode_model->save_rows($insert);
                      if($response) 
                      {
                            $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Data updated successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                      } 
                      else 
                      {
                           $this->session->set_flashdata('error', '<div class="alert alert-error"><i class="fa fa-check-circle"></i>Oops: Something went wrong. please try again.<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                      }
                       redirect('admin/qrcodes/view');
              }
          }
          else 
          {
              $this->render('admin/qrcode_edit');
          }
        }
        else {
            redirect(base_url());
        }
    }

   public function delete($qrcode_id=false)
   {
    $qrcode_id = base64_decode($qrcode_id);
    if($qrcode_id) 
    {
     $this->Qrcode_model->delete_row($qrcode_id);
     $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Data has been deleted successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
     redirect($_SERVER['HTTP_REFERER']);
    }
    else 
    {
     redirect(base_url());
    }
   }

   public function del_file($field=false,$qrcode_id=false){
    $qrcode_id = base64_decode($qrcode_id);
    if($qrcode_id && $field) 
    {
     $data = array($field=>'');
     $this->db->where('id',$qrcode_id);
     $this->db->update($this->db->dbprefix('qrcode'),$data);

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
          $this->form_validation->set_rules('url', 'URL', 'trim|required|is_unique[ci_qrcode.url]' ,
          array(
                  'required'      => 'Please enter campaign/product',
                  'is_unique'     => 'This %s already exists.'
          ));

          $this->form_validation->set_rules('redirect_url', 'Redirect URL', 'trim|required|is_unique[ci_qrcode.redirect_url]' ,
          array(
                  'required'      => 'Please enter valid %s.',
          ));
          $this->form_validation->set_message('required', '%s is required.');
          if ($this->form_validation->run() == FALSE)
            {
                    
                $this->render('admin/qrcode_add');
            }
            else
            {   
              $redirect_url  = $this->input->post('redirect_url');
              $pre_url  = $this->input->post('pre_url');
              $campaign = $this->input->post('url');
              $cmb_url  = $pre_url.$campaign;

              $insert         = array();
              $insert['url']  = $cmb_url;
              $insert['redirect_url'] = $redirect_url;

              $this->load->library('ciqrcode');
              $qr_image=rand().'.png';
              $params['data'] =  $insert['url'];
              $params['level'] = 'M';
              $params['size'] = 6;
              $params['savename'] ="./assets/files/qrcode/".$qr_image;

              if($this->ciqrcode->generate($params))
              {
                $insert['qr_image']=$qr_image; 
              }

               
                    $response=$this->Qrcode_model->save_rows($insert);
                    if($response) 
                    {
                          $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Data inserted successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                    } 
                    else 
                    {
                         $this->session->set_flashdata('error', '<div class="alert alert-error"><i class="fa fa-check-circle"></i>Oops: Something went wrong. please try again.<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                    }
                    redirect('admin/qrcodes/view');
            }
        }
        else 
        {
           $this->render('admin/qrcode_add');
        }
   }
}