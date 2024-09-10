<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Kusbiyanto & Co</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" href="<?php echo base_url();?>style/web/images/kusbiyanto_logo_new1.png">
      
    <script type="text/javascript">
			var baseurl = '<?php echo base_url(); ?>';
		</script>
      
      <!--<script type="text/javascript" src="<?php echo base_url(); ?>style/shopping/js/jquerylazy/jquery.lazy.min.js" defer></script>-->
      
    <link href="<?php echo base_url();?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo base_url();?>style/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url();?>style/admin/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	
	<link href="<?php echo base_url();?>plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />

    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url();?>plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
      
    <script src="<?php echo base_url();?>plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>
      
    <!--<script src="<?php echo base_url() ?>js/jquery-ui-1.9.2.custom/jquery-1.8.3.min.js"></script>-->
	<script src="<?php echo base_url() ?>js/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.min.js"></script>
      
         <link href="<?php echo base_url();?>js/icheck/skins/square/blue.css" rel="stylesheet" type="text/css" /> 
	<script src="<?php echo base_url() ?>js/icheck/icheck.min.js"></script>
	  <script src="<?php echo base_url()?>js/jqueryform/jquery.form.min.js"></script>

    
  
      

  </head>
  <body class="skin-black">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        
        <a href="<?php echo site_url('admin/menu'); ?>" class="logo"><b>KUSBIYANTO&CO</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url() ?>style/admin/images/admin.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $templatedata["header"]; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url() ?>style/admin/images/admin.jpg" class="img-circle" alt="User Image" />
                    <p>
                        <?php echo $templatedata["nama"]; ?>
                      <small><b>Kusbiyanto & Co</b></small>
                      <small><?php echo date("l, d F Y H:i:s") ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo site_url('admin/menu/profile') ;?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('admin/menu/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!--Awal Menu-->
          <ul class="sidebar-menu">
            <li class="treeview">
              <a href="<?php echo site_url('admin/menu'); ?>">
                  <i class="fa fa-dashboard"></i><span>DASHBOARD</span>
              </a>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i><span>MASTER CONTENT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/client'); ?>"><i class="fa fa-arrow-right"></i>CLIENT</a></li>
                    <li><a href="<?php echo site_url('admin/uploaddataclient'); ?>"><i class="fa fa-arrow-right"></i>UPLOAD DATA CLIENT</a></li>
                    <li><a href="<?php echo site_url('admin/banner'); ?>"><i class="fa fa-arrow-right"></i>BANNER</a></li>
                    <li><a href="<?php echo site_url('admin/berita'); ?>"><i class="fa fa-arrow-right"></i>ARTIKEL</a></li>
                    <li><a href="<?php echo site_url('admin/kategori'); ?>"><i class="fa fa-arrow-right"></i>ARTIKEL KATEGORI</a></li>
                    <!--<li><a href="<?php echo site_url('admin/project'); ?>"><i class="fa fa-arrow-right"></i>PROJECT</a></li>-->
                    <li><a href="<?php echo site_url('admin/project'); ?>"><i class="fa fa-arrow-right"></i>SERVICE</a></li>
                    <li><a href="<?php echo site_url('admin/about'); ?>"><i class="fa fa-arrow-right"></i>ABOUT & CONTACT US</a></li>
                    <li><a href="<?php echo site_url('admin/message'); ?>"><i class="fa fa-arrow-right"></i>MESSAGE</a></li>
                </ul>
            </li>
            
            <!--<li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i><span>SUBMENU</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/about'); ?>"><i class="fa fa-arrow-right"></i>SUBMENU</a></li>
                    <li><a href="<?php echo site_url('admin/daftarjasa'); ?>"><i class="fa fa-arrow-right"></i>DAFTAR JASA</a></li>
                    <li><a href="<?php echo site_url('admin/preview'); ?>"><i class="fa fa-arrow-right"></i>PREVIEW</a></li>
                </ul>
            </li>-->
            
            
            <!--<li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i><span>Tes Multilevel</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-share"></i><span>Tes Multilevel One</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-folder"></i><span>Tes Multilevel Two</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>-->
          </ul>
          <!--Akhir Menu-->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
	  
	   <!-- Content Header (Page header) -->
       <?php //include "isi.php"; ?>
       <?php echo $output;?>
		<!-- /.content-Header -->
       
	  </div><!-- /.content-wrapper -->
      <footer class="main-footer no-print">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright 2017 <a href="#">butuhdesign.com</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
    
    <!--<script src="<?php echo base_url();?>plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>-->
    <!-- AdminLTE App -->
    <!--<script src="<?php echo base_url();?>style/admin/js/app.min.js" type="text/javascript"></script>-->
	
	<!-- Bxslider -->       
      <script type="text/javascript" src="<?php echo base_url(); ?>js/boxslider/jquery.bxslider.min.js"></script>
      
      <!-- Bootstrap 3.3.6 -->
    <script src="<?php  echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php  echo base_url(); ?>assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php  echo base_url(); ?>assets/admin/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php  echo base_url(); ?>assets/admin/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php  echo base_url(); ?>assets/admin/dist/js/demo.js"></script>
    <script src="<?php  echo base_url(); ?>assets/js/jqueryform/jquery.form.min.js"></script>
    <script src="<?php  echo base_url(); ?>js/ajaxpost.js"></script>
    <script src="<?php echo base_url();  ?>assets/js/core/ajaxupload.js"></script>

    <script src="<?php  echo base_url(); ?>assets/js/alertify/dist/js/alertify.js"></script>


    <!--<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>-->
	
  </body>
</html>