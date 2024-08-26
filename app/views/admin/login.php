<!DOCTYPE html>
<html>
  <head>
  <title>Connecto2o - Admin Login</title>
  <?php 
  echo admin_theme_style('bootstrap.min.css');
  echo admin_theme_style('AdminLTE.css');
  echo admin_theme_style('font-awesome.min.css');
  echo admin_theme_script('jquery-2.2.3.min.js');
  echo admin_theme_script('validate.js');
  echo admin_theme_script('validator.js');
  echo admin_theme_script('user.auth.js');
?>
  <style type="text/css">
  body, html 
  {
  height: 100%;
  background-repeat: no-repeat;
  background: #333333;
  }

.login_box{
    background:#f7f7f7;
    border:3px solid #F4F4F4;
    padding-left: 15px;
    margin-bottom:10px;
    }
.input_title{
    color:rgba(164, 164, 164, 0.9);
    padding-left:3px;
        margin-bottom: 2px;
    }

hr{
    width:100%;
}
    

.login_title{
    font-family: "myriad-pro",sans-serif;
    font-style: normal;
    font-weight: 100;
    color:rgba(164, 164, 164, 0.44);
}

.signup-container.signup {
    max-width: 350px;

}
.alert{padding: 6px;text-align: center;}
.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    border-radius:0;
    height: 55px;
    margin-bottom:10px;
}

/*
 * signup
 */
.signup {
    background-color: #FFFFFF;
    /* just in case there no content*/
    padding: 1px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 15%x;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}
.error{
  color:red;font-size: 13px;
}
  </style>
  </head>
  <body>
   
    <div class="container">
    <h1 class="welcome text-center">&nbsp;</h1>
        <div class="signup signup-container">
        <h2 class='login_title text-center'>Login</h2>
        <hr>

            <form method="post" action="<?php echo site_url('admin/login');?>" class="form-signin" name="frmLogin" id="frmLogin">
                 <?php if(!empty($this->session->flashdata('error'))){ echo $this->session->flashdata('error'); } ?>
                <p class="input_title">Email</p>
                <input type="text" name="userEmail" id="inputEmail" class="login_box" placeholder="Email">
                <p class="input_title">Password</p>
                <input type="password" name="userPswd" id="inputPassword" class="login_box" placeholder="Password">
                <div id="remember" class="checkbox">   <label> &nbsp;</label></div>
                <button class="btn btn-lg btn-success btnLogin" type="submit">Login</button>
            </form>
        </div>
    </div>
  </body>
</html>