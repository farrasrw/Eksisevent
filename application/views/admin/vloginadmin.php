<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="<?php echo base_url();?>style/web/images/kusbiyanto_logo_new1.png">
  <title>Admin Kusbiyanto</title>
    <link rel="stylesheet" href="<?php base_url(); ?>style/admin/css/stylelogin.css">
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!--<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
</head>
<body class="background">
<div class="login-card">
    <h1>
    <img src="<?php echo base_url(); ?>style/web/images/kusbiyanto_logo_new1.png" align="center" class="img-responsive"/></h1>
    <br>
    
    <form method="post" action="<?php echo base_url(); ?>dashboard/cekLogin">
	
			
        <input type="text" name="user" placeholder="type your username here" required>
        <input type="password" name="pass" placeholder="type your password here" required>
        <br>
        <input type="submit" name="btn_login" class="login login-submit" value="Login">
    </form>
    <div class="login-help">
    <h3><b style="color:#000; font-size:14px;">© 2019 Admin Kusbiyanto & Co</b></h3>
    </div>
</div>
</body>
</html>