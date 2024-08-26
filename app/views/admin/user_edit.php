<div class="content-wrapper">            
  <section class="content-header">
    <h1>
        Users
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="<?php echo base_url();?>admin/users/view"> Users</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>
   <section class="content">
      <div class="row">
          <div class="box">
          <div class="box-header">	
			</div>
				<div class="box-body">
				<section class="content">
				 <?php if($this->session->flashdata('success')) {  echo $this->session->flashdata('success'); }  ?>  
				 <?php echo form_open(base_url().'admin/users/edit/'.base64_encode($result->id),array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"add_record","id"=>"add_record")) ?>
          <input type="hidden" name="id" value="<?=$result->id;?>">     
               <div class="row">
                <div class="col-sm-6">
                  <div class="form-group required">
                    <label class="control-label">Name</label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'name', 'autocomplete'=>'off','value'=>$result->name));?>
                    <?php echo form_error('name'); ?>
                  </div>
                  <div class="form-group required">
                    <label class="control-label">Email </label>
                    <?php echo form_input(array('class'=>'form-control','readonly'=>'readonly', 'name'=>'email', 'autocomplete'=>'off','value'=>$result->email));?>
                    <?php echo form_error('email'); ?>
                  </div>
                              

                  <div class="form-group required">
                    <label class="control-label">Mobile Number </label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'mobile','maxlength'=>'10', 'autocomplete'=>'off','value'=> $result->mobile));?>
                    <?php echo form_error('mobile'); ?>
                  </div>

                  <div class="form-group required">
                    <label class="control-label">Company Name </label>
                    <?php echo form_input(array('class'=>'form-control', 'readonly'=>'readonly','name'=>'company_name', 'autocomplete'=>'off','value'=> $result->company_name));?>
                    <?php echo form_error('company_name'); ?>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Address</label>
                    <?php echo form_textarea(array('class'=>'form-control', 'name'=>'address', 'autocomplete'=>'off',"rows"=>"4",'value'=> $result->address));?>
                    <?php echo form_error('address'); ?>
                  </div>


                  <div class="form-group ">
                    <label class="control-label">Avatar </label>
                   <input type="file" class="form-control" name="avatar" id="avatar">
                   <?php if(!empty($result->avatar)) {?>
                     <a download  href="<?php echo site_url('assets/files/avatar/'.$result->avatar);?>"><img style="margin-top:5px;" width="80" height="auto" src="<?php echo site_url('assets/files/avatar/'.$result->avatar);?>"></a>
                     <a onclick="return confirm('Are you sure want to continue?')"  class="btn-danger" href="<?php echo site_url('admin/users/del_file/avatar/'.base64_encode($result->id));?>"><span class="glyphicon glyphicon-remove"></span> </a>
                   <?php } ?>
                  </div>

                  <div class="form-group">
                  <button type="submit" class="btn btn-primary pull-right"  id="submit">Update</button>
                  </div>
                  
                  
               </div>
              </div>


          <?=form_close()?>
          </section><!-- /.content -->	
    		  </div>	
        </div>
      </div>
   </section>
 </div><!-- /.right-side -->  