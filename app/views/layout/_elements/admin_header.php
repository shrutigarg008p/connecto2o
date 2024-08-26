<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $page_title;?></title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content=""/>
<!-- css & js files --> 
<?php 
  echo admin_theme_style('bootstrap.min.css');
  echo admin_theme_style('AdminLTE.css');
  echo admin_theme_style('skins/_all-skins.min.css');
  echo admin_theme_style('font-awesome.min.css');

  echo admin_theme_script('jquery-2.2.3.min.js');
  echo admin_theme_script('bootstrap.js');
 // echo admin_theme_script('bootbox.min.js');

?>
<script type="text/javascript">
    var appPath = '<?php echo base_url() ?>';
</script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo"> 
    App Name
      <!-- mini logo for sidebar mini 50x50 pixels -->
    <!--   <span class="logo-mini"><img width="50" src="<?php echo site_url('assets/admin/img/logo.png');?>" alt="logo"></span> -->
      <!-- logo for regular state and mobile devices -->
      <!-- <span class="logo-lg"><img height="43" src="<?php echo site_url('assets/admin/img/logo.png');?>" alt="logo"></span> -->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">   
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			 
			   <img src="<?php echo base_url();?>assets/files/user-default.png" class="user-image" alt="User Image">
			
              <span class="hidden-xs"> <?php if(!empty($this->session->userdata('name'))) { echo ucwords($this->session->userdata('name')); } ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
			  
			          <img src="<?php echo base_url();?>assets/files/user-default.png" class="img-circle" alt="User Image">

                <p>
                  <small>Last Login : <?php echo $this->session->userdata('lastLogin');?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a data-toggle="modal" data-target="#chgpasswordModel" href="#" class="btn btn-default btn-flat" >Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?>admin/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  	<div class="modal fade" id="chgpasswordModel" tabindex="-1" role="dialog" >
			<div class="modal-dialog" role="document">
				<div class="modal-content news-w3l">
				    <form method="post" action="" name="frmcngPwd" autocomplete="off" id="frmcngPwd">
						<div class="modal-header">
							<button type="button" class="close w3l" data-dismiss="modal">&times;</button>
							<h4>Change Password</h4>
							 <div id="pwdChgSuccess"></div>
						 </div>
						
                         <div class="modal-body">
							 <div class="alert alert-danger form-group hide"></div>
							<div class="loginmodal-container">  
                             <div class="form-group">
					            <label>Enter New Password<span style="font-size:14px" class="error"></span></label>
					            <input type="password" autocomplete="off" maxlength="100" class="form-control" name="newPassword" id="newPassword">
					          </div>
					           <div class="form-group">
					            <label>Re-Enter Password<span style="font-size:14px" class="error"></span></label>
					            <input type="password" autocomplete="off" maxlength="100" class="form-control" name="newRePassword" id="newRePassword">
					          </div>
					       </div>
					       <div class="modal-footer">
					       <div class="row">
					          <div class="form-group">
						          <div class="pull-right">
						            <button type="submit" class="btn btn-primary" id="btnPwd">Change</button>
						          </div>
							  </div>
							</div>
							</div>		
						</div>
					</form>
					</div>
			</div>
		</div>