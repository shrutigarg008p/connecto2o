<div class="content-wrapper">            
  <section class="content-header">
    <h1>
        QR Redirect Code
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="<?php echo base_url();?>admin/qrcodesredirect/view"> QR Code</a></li>
      <li class="active">Add</li>
    </ol>
  </section>
<section class="content">
    <div class="row">
      <div class="box">
      
        <div class="box-body">
          <section class="content">
             <?php echo form_open(base_url().'admin/qrcodesredirect/add/',array("enctype"=>"multipart/form-data", "method"=>"post","id"=>"addForm","name"=>"addForm")) ?>
            <div class="row">
               <div class="col-sm-6">
                  <div class="form-group required">
                    <label class="control-label">Key Value</label>
                   
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'key_value', 'autocomplete'=>'off','value'=> set_value('key_value')));?>
                    <?php echo form_error('key_value'); ?>
                  </div>
                  <div class="form-group required">
                    <label class="control-label">URL</label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'redi_url', 'type'=>'url', 'placeholder'=>'https://www.example.com', 'autocomplete'=>'off','value'=> set_value('redi_url')));?>
                    <?php echo form_error('redi_url'); ?>
                  </div>

        
                <div class="form-group">
                  <button type="submit" class="btn btn-primary pull-right" id="submit">Generate Redirect URL</button>
                </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                        <label class="control-label">Note</label>
                    </div>
                    <div class="form-group">
                      <h5>Key value should be the same as QR code URL last word</h5>
                      <ul>
                        <li>https://example.com/xyz  = xyz</li>
                        <li>https://example.com/ab-c = abc</li>
                        <li>https://example.com/xyz/mk-c = mkc</li>

                      </ul>
                   
                    
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
