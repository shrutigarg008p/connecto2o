<?php 
if(!empty($this->session->userdata('company_slug'))) 
{ 
  $slug='https://www.connecto2o.com/uny/'.$this->session->userdata('company_slug').'/'; 
} 
else{
  $slug='https://www.connecto2o.com/uny/';
}
?>
<div class="content-wrapper">            
  <section class="content-header">
    <h1>
        QR Code
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="<?php echo base_url();?>admin/qrcodes/view"> QR Code</a></li>
      <li class="active">Add</li>
    </ol>
  </section>
<section class="content">
    <div class="row">
      <div class="box">
      
        <div class="box-body">
          <section class="content">
             <?php echo form_open(base_url().'admin/qrcodes/add/',array("enctype"=>"multipart/form-data", "method"=>"post","id"=>"addForm","name"=>"addForm")) ?>
            <div class="row">
               <div class="col-sm-12">
                  <div class="form-group required">
                    <label class="control-label">URL</label>
                    <div class="clearfix"></div>
                    <input type="hidden" name="pre_url" value="<?php echo $slug;?>">
                    <div class="hidden_txt" style="float: left;padding-top: 8px; margin-right: 5px;"><?php echo  $slug;?></div>
                    <div class="txt-field" style="float: left; width: 552px;">
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'url','type'=>'text', 'placeholder'=>'campaign/product', 'autocomplete'=>'off','value'=> set_value('url')));?>
                    <?php echo form_error('url'); ?>
                  </div>
                  </div>
                </div>
              </div>
               <div class="clearfix"></div>
             <div class="row">

                <div class="col-sm-6">
                  <div class="form-group required">
                    <label class="control-label">Redirect URL</label>
                
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'redirect_url','type'=>'url', 'placeholder'=>'https://www.connecto2o.com', 'autocomplete'=>'off','value'=> set_value('redirect_url')));?>
                    <?php echo form_error('redirect_url'); ?>
                  </div>
                  </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-12">
                    <div class="form-group">
                  <button type="submit" class="btn btn-primary pull-right"   id="submit">Generate QR Code</button>
                  </div>
                </div>
              </div>


            <?=form_close()?>
          </section>
       </div> 
         </div>
      </div>
   </div>
</section>

</div>
