<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users extends Admin_Controller
{
 
 function __construct()
  {
    parent::__construct();
    _isLogin();

    $this->load->model('admin/User_model');
    $this->load->library('pagination');
    $this->load->library(array('form_validation'));
  }
 

   public function view($perpage = 0, $offset = 0) 
   {
           

        if($perpage != 0)  {
            $perpage = $perpage;
            $this->data['per_page'] = $perpage;
        } 
        else  {
            $perpage = 10;
            $this->data['per_page'] = '1';
        }

        $total_records=$this->User_model->user_count();
        $config['base_url']          = base_url().'admin/users/view/'.$perpage;
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

        $this->data["result"]     = $this->User_model->user_rows($perpage, $offset,'search_text');
        $this->data['row_count']  = $total_records;
        $this->data['pagination'] = $this->pagination->create_links();
        $data['current']='view';
        if($offset==0) {
             $this->data['offset']=1;
        } else {
           $this->data['offset']=$offset+1;
        }
          
        $this->render('admin/user_view');
   }
    
    public function search($search_text = 'search_text', $perpage = 0, $offset = 0)
    {
        
        if($perpage != 0)  {
            $perpage = $perpage;
            $this->data['per_page'] = $perpage;
        } 
        else  {
            $perpage = 10;
            $this->data['per_page'] = '1';
        }
        $search_text = ($this->input->get("search_text"))? $this->input->get("search_text") : $search_text;
        $total_records=$this->User_model->user_count($search_text);
        $config['base_url']   = base_url().'admin/users/search/'.$search_text.'/'.$perpage;
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
        $this->data["result"]     = $this->User_model->user_rows($perpage, $offset,$search_text);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['search_text']= $search_text;

        $this->data['current']='search';
        if($offset==0) {
         $this->data['offset']=1;
        } else {
         $this->data['offset']=$offset+1;
        }

        $this->render('admin/user_view');
    }
  public function edit($user_id=false)
    {
        $user_id = base64_decode($user_id);
        if($user_id)  
        {
          $this->data['result']=$this->User_model->get_user($user_id);
          
          if($this->input->post()) 
          {
          $this->form_validation->set_error_delimiters('<span class="err">', '</span>');
          $this->form_validation->set_rules('mobile', 'Mobile number', 'trim|required|numeric');
          $this->form_validation->set_rules('name', 'Name', 'trim|required');
          $this->form_validation->set_message('required', '%s is required.');
              if ($this->form_validation->run() == FALSE)
              {
                      
                  $this->render('admin/user_add');
              }
              else
              {   
                $insert = array('name'=>$this->input->post('name'),
                            'mobile'  =>$this->input->post('mobile'),
                            'email'  =>$this->input->post('email'),
                            'address'=>$this->input->post('address'),
                            'modified_at'=>date('Y-m-d H:i'),
                            'id'     =>$this->input->post('id')
                           );
                if(!empty($_FILES['avatar']['name']))
               {
               $config['upload_path']   = './assets/files/avatar/'; 
               $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg'; 
               $file_name = time().'_'.$_FILES['avatar']['name'];
               $config['file_name'] = $file_name;
               $config['overwrite'] = FALSE;  
               $this->load->library('upload', $config);
               $this->upload->initialize($config);
            
                 if($this->upload->do_upload('avatar'))  {
                   $insert['avatar'] = $file_name;
                 }
               } 

                      $response=$this->User_model->save_user($insert);
                      if($response) 
                      {
                            $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Record updated successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                      } 
                      else 
                      {
                           $this->session->set_flashdata('error', '<div class="alert alert-error"><i class="fa fa-check-circle"></i>Oops: Something went wrong. please try again.<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                      }
                       redirect('admin/users/view');
              }
          }
          else 
          {
              $this->render('admin/user_edit');
          }
        }
        else {
            redirect(base_url());
        }
    }

   public function delete($user_id=false){
    $user_id = base64_decode($user_id);
    if($user_id) 
    {
     $this->User_model->delete_user($user_id);
     $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Data has been deleted successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
     redirect($_SERVER['HTTP_REFERER']);
    }
    else 
    {
     redirect(base_url());
    }
   }

   public function del_file($field=false,$user_id=false){
    $user_id = base64_decode($user_id);
    if($user_id && $field) 
    {
     $data = array($field=>'');
     $this->db->where('id',$user_id);
     $this->db->update($this->db->dbprefix('users'),$data);

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
          $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[ci_users.email]',['required'=> 'Please enter email id.','is_unique'=> 'This %s Id already exists.']);

          $this->form_validation->set_rules('mobile', 'Mobile number', 'trim|required|numeric');
          

          $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|is_unique[ci_users.company_name]' ,['required'=> 'Please enter company name.','is_unique'=>'This %s already exists.']
          );
          $this->form_validation->set_rules('name', 'Name', 'trim|required');
          $this->form_validation->set_message('required', '%s is required.');
          if ($this->form_validation->run() == FALSE)
            {
                    
                $this->render('admin/user_add');
            }
            else
            {   

              $insert = array('name'=>$this->input->post('name'),
                          'company_name'=>$this->input->post('company_name'),
                          'mobile'=>$this->input->post('mobile'),                          
                          'email'=>$this->input->post('email'),
                          'address'=>$this->input->post('address'),
                          'password'=>md5($this->input->post('mobile')),
                          'status'=>'Active',
                          'created_at'=>date('Y-m-d H:i'),
                         );

                  if(!empty($_FILES['avatar']['name']))
                   {
                   $config['upload_path']   = './assets/files/avatar/'; 
                   $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg'; 
                   $file_name = time().'_'.$_FILES['avatar']['name'];
                   $config['file_name'] = $file_name;
                   $config['overwrite'] = FALSE;  
                   $this->load->library('upload', $config);
                   $this->upload->initialize($config);
                
                     if($this->upload->do_upload('avatar'))  {
                       $insert['avatar'] = $file_name;
                     }
                   } 
               
                    $response=$this->User_model->save_user($insert);
                    if($response) 
                    {
                          $this->session->set_flashdata('success', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>Record inserted successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                    } 
                    else 
                    {
                         $this->session->set_flashdata('error', '<div class="alert alert-error"><i class="fa fa-check-circle"></i>Oops: Something went wrong. please try again.<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
                    }
                     redirect('admin/users/view');
            }
        }
        else 
        {
           $this->render('admin/user_add');
        }
   }
}