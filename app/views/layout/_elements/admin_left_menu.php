  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
        
         <img src="<?php echo base_url();?>assets/files/user-default.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php if(!empty($this->session->userdata->name)) { echo ucwords($this->session->userdata->name); } ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li>
          <a href="<?php echo site_url('admin/dashboard') ?>">
            <i class="fa fa-cog"></i> <span>Dashboard</span>
          </a>
        </li>
   
        <li>
            <a href="<?php echo site_url('admin/qrcodes/view') ?>">
              <i class="fa fa-cog"></i> <span>Manage QR</span>
            </a>
        </li>
       <!--  <li>
          <a href="<?php echo site_url('admin/qrcodesredirect/view') ?>">
            <i class="fa fa-cog"></i> <span>Manage Redirect QR</span>
          </a>
        </li> -->
      <?php if(!empty($this->session->userdata('userType')) && $this->session->userdata('userType')=='admin') { ?>
        <li>
          <a href="<?php echo site_url('admin/users/view') ?>">
            <i class="fa fa-cog"></i> <span>Manage Users</span>
          </a>

        </li>   
      <?php } ?>
      </ul>
    </section>
  </aside>