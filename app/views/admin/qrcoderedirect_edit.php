<div class="content-wrapper">            
  <section class="content-header">
    <h1>
        QR Code
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="<?php echo base_url();?>admin/qrcode/view"> QR Code</a></li>
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
				 <?php echo form_open(base_url().'admin/qrcodes/edit/'.base64_encode($result->id),array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"add_record","id"=>"add_record")) ?>
          <input type="hidden" name="id" value="<?=$result->id;?>">     
               <div class="row">
                <div class="col-sm-6">
                  <div class="form-group required">
                    <label class="control-label">Name</label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'url', 'autocomplete'=>'off','value'=>$result->url));?>
                    <?php echo form_error('url'); ?>
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