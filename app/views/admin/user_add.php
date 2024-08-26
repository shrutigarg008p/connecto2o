<div class="content-wrapper">            
  <section class="content-header">
    <h1>
        Users
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="<?php echo base_url();?>admin/users/view"> Users</a></li>
      <li class="active">Add</li>
    </ol>
  </section>
<section class="content">
    <div class="row">
      <div class="box">
      
        <div class="box-body">
          <section class="content">
             <?php echo form_open(base_url().'admin/users/add/',array("enctype"=>"multipart/form-data", "method"=>"post","id"=>"addForm")) ?>
            <div class="row">
               <div class="col-sm-6">

                  <div class="form-group required">
                    <label class="control-label">Name</label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'name', 'autocomplete'=>'off','value'=> set_value('name')));?>
                    <?php echo form_error('name'); ?>
                  </div>

                 <div class="form-group required">
                    <label class="control-label">Email </label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'email', 'autocomplete'=>'off','value'=> set_value('email')));?>
                    <?php echo form_error('email'); ?>
                  </div>

                  <div class="form-group required">
                    <label class="control-label">Mobile Number </label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'mobile','maxlength'=>'10', 'autocomplete'=>'off','value'=> set_value('mobile')));?>
                    <?php echo form_error('mobile'); ?>
                  </div>
                  <div class="form-group required">
                    <label class="control-label">Company Name</label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'company_name', 'autocomplete'=>'off','value'=> set_value('company_name')));?>
                    <?php echo form_error('company_name'); ?>
                  </div>


                  <!-- <div class="form-group">
                    <label class="control-label">Gender</label>
                       <select name="gender" class="form-control ">
                         <option value="Male">Male</option>
                         <option value="Female">Female</option>
                       </select>
                  </div> -->
                  <div class="form-group">
                    <label class="control-label">Address</label>
                    <?php echo form_textarea(array('class'=>'form-control', 'name'=>'address', 'autocomplete'=>'off',"rows"=>"4",'value'=> set_value('address')));?>
                    <?php echo form_error('address'); ?>
                  </div>
               
                  <div class="form-group ">
                    <label class="control-label">Avatar </label>
                   <input type="file" class="form-control" name="avatar" id="avatar">
                  </div>
    
        
                <div class="form-group">
                  <button type="submit" class="btn btn-primary pull-right"  id="submit">Add User</button>
                  </div>
            <?=form_close()?>
          </section>
       </div> 
         </div>
      </div>
   </div>
</section>
</div>