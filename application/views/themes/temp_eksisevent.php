<html>

    

    <head>

        <meta name="viewport" content="width=device-width, minimum-scale=1.0,maximum-scale=1.0">

	<link rel="icon" type="image/png" href="<?php echo base_url();?>style/web/images/eksisevent/icon-eksisevent.png">

        <title>Eksis Event</title>

        

        <?php

            $upVersion = "?v=02s995";
            //echo '<pre>';print_r($templatedata['package']);echo '</pre>';

        ?>

        

        <script>

            var baseurl = '<?php echo base_url(); ?>';

            var domain  = '<?php echo $this->config->item('domain'); ?>'

        </script>

		

		<script type="application/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-1.12.3.min.js<?php echo $upVersion;  ?>"></script>

		<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slideout/1.0.1/slideout.min.js<?php echo $upVersion;  ?>"></script>

		

        <script type="application/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js<?php echo $upVersion;  ?>"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/loadimages.js<?php echo $upVersion;  ?>" defer></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquerylazy/jquery.lazy.min.js<?php echo $upVersion;  ?>" defer></script>

        

        <script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxpost.js<?php echo $upVersion;  ?>" defer></script>

        <script src="<?php echo base_url(); ?>js/jqueryform/jquery.form.min.js<?php echo $upVersion;  ?>"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/alertify/dist/js/alertify.js<?php echo $upVersion;  ?>" defer></script>

        

        <!--jquery cookie-->

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-cookie/jquery.cookie.js<?php echo $upVersion;  ?>"></script>

                

        <link href="<?php echo base_url(); ?>js/alertify/dist/css/alertify.css<?php echo $upVersion;  ?>" rel="stylesheet" >

		

		<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css<?php echo $upVersion;  ?>" rel="stylesheet" media="all" />

		

		<link href="<?php echo base_url(); ?>style/web/css/style.css<?php echo $upVersion;  ?>" rel="stylesheet" media="all" type="text/css" />

        

        <link href="<?php echo base_url(); ?>js/owl-carousel/owl.carousel.css<?php echo $upVersion;  ?>" rel="stylesheet"/>

        <link href="<?php echo base_url(); ?>js/owl-carousel/owl.theme.css<?php echo $upVersion;  ?>" rel="stylesheet"/>

        <link href="<?php echo base_url(); ?>js/owl-carousel/owl.transitions.css<?php echo $upVersion;  ?>" rel="stylesheet"/>



        <!-- Font Awesome Icons -->

        <!--<link href="<?php echo base_url(); ?>assets/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->

        

        <!-- Font Awesome Icons -->

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    

            

        <!-- Load Css And Javascript -->

		

	

	        <script>

            

        function showmenu(){

            $('#iscom-header .NavMainMenu').addClass('showMobile'); 

            $('body').addClass('overflowhidden');

        }

            

        function hidemenu(child){

            if(typeof(child)=='undefined') child = false; 

            if(child){

                $('#iscom-header .NavMainMenu li').removeClass('open'); 

            }else{

                $('#iscom-header .NavMainMenu li').removeClass('open');

                $('#iscom-header .NavMainMenu').removeClass('showMobile'); 

                $('body').removeClass('overflowhidden');

            }

        }

        function hidetroli(){

            $('.trolibagmenu ').removeClass('open');

            $('body').removeClass('overflowhidden');

        }

        function toggleSearch(obj){

    

           

            if(obj.hasClass('open')){

               $('body').removeClass('overflowhidden'); 

            }else{

                hidescroll($('body'),true); 

            }

        }

            

        function hidescroll(obj, onlymobile){

            if(typeof(onlymobile)=='undefined') onlymobile = false ; 

            if(onlymobile){

                if($('window').innerWidth() <= 959){

                    obj.addClass('overflowhidden');

                }

            }else{

                obj.addClass('overflowhidden');

            }

        }

            

            

        $(document).ready(function() {
            
            $('.scroll').click(function() {
                $('body').animate({
                    scrollTop: eval($('#' + $(this).attr('target')).offset().top - 70)
                }, 1000);
            });
            
            
            $("#owl-slide").owlCarousel({
                  autoPlay:false,
                  
                  /*video: true,
                  loop: true,
                  videoWidth: 100,
                  videoHeight: 100,
                  
                  responsiveClass:true,
                  autoHeight:true,
                  slideSpeed : 300,
                  paginationSpeed : 400,
                  autoplay:false,*/
                  items : 1, 
                  itemsDesktop : false,
                  itemsDesktopSmall : false,
                  itemsTablet: false,
                  itemsMobile : false,
                  singleItem : true,
                  navigation:false,
                  stopOnHover: true,
                  //navigationText: ["",""],
                    navigationText: [
                    "<i class='glyphicon glyphicon-menu-left'></i>",
                    "<i class='glyphicon glyphicon-menu-right'></i>"
                ],
              });
            
            
            $("#owl-layanan").owlCarousel({
                loop:true,
                margin:10,
                items:1,
                itemsDesktop : false,
                  itemsDesktopSmall : false,
                  itemsTablet: false,
                  itemsMobile : false,
                transitionStyle : "fade",
                nav: true
              });
            
            
            $('.owl-usage').owlCarousel({
                            loop: false,
                            margin: 10,
                            items: 1,
                            nav: true,
                            dots: false,
                            // navContainer: '#customNav',
                            navText: ['<i class="bi bi-chevron-left"></i>', '<i class="bi bi-chevron-right"></i>'],
                            slideBy: 2
                        })

            

            $('.dropdown-menu').on({

                "click":function(e){

                  if($('window').innerWidth() <= 719){

                    e.stopPropagation();  

                  }    

                  

                }

            });

            

            $('.btnuser-login').on('click', function(){

                $('#modalLogin').modal('show');

            });

            

            //showTroli(true); 

            

            var shown = $.cookie('dialogShown');

            

            if (!shown) {

                setTimeout(function(){

                    $("#modalsubscribe").modal('show');

                },3000);

                

                $.cookie('dialogShown', 'true');

            }

          

            loadimages();

            

            $(".productrelated").owlCarousel({

                items : 3,

                itemsDesktop:[1024,4],

                itemsTablet:[646,3],

                itemsMobile:[480,1],

                lazyLoad : true,

                pagination:false,

                navigation :true,

                navigationText: [

                  "<i class='glyphicon glyphicon-menu-left'></i>",

                  "<i class='glyphicon glyphicon-menu-right'></i>"

                ],

                touchDrag               : false,

                mouseDrag               : false

            });

                

           

            $('#buttonsearch').click(function(){
                $('#formsearch').slideToggle( "fast",function(){

                    $( '#content' ).toggleClass( "moremargin" );

                });

                $('#searchbox').focus()

                $('.openclosesearch').toggle();

            });



        });

            

        function showsearch(){



           if( $('#formsearch').is(":visible")){

               $('#formsearch').hide();

               $('.openclosesearch').toggle();

               $('body').css('overflow','auto');

           }else{

               //$('#formsearch').show();

               $('#formsearch').slideToggle( "fast",function(){

                    $( '#content' ).toggleClass( "moremargin" );

                });

               

               $('.openclosesearch').toggle();

               

               var screen = $(window).width();



                if(screen > 798){

                    $('body').css('overflow','auto');

                }else{

                    $('body').css('overflow','hidden');   

                }

           }

        }

            

        </script>

        

        <style>

           



            .modal {

              text-align: center;

              padding: 0!important;

            }



            .modal:before {

              content: '';

              display: inline-block;

              height: 100%;

              vertical-align: middle;

              margin-right: -4px;

            }



            .modal-dialog {

              display: inline-block;

              text-align: left;

              vertical-align: middle;

            }

            

        </style>

        

	</head>

	<body class="fontVolteReguler backgroundEksisEvent">

	<form style="display:none" id="formglobal" action="" method="post"></form>

    <form style="display:none" id="formglobalget" action="" method="get"></form>

        

    <div id="iscom-header" class="container-fluid">

        <div class="container" id="headermain">

            <div class="row container" id="afixtop">

                <div id="afixborder"></div>

                <nav class="navbar navbarMenu" role="navigation">

                    

                    <div class="col-md-1 col-xs-3  text-center hidden-sm hidden-md hidden-lg"  id="buttonmenu" style="padding: 5px;">

                        <a href="#" onclick="showmenu(); return false;" id="showMenu" param="1" ><i class="glyphicon glyphicon-menu-hamburger text-black font24 "></i></a>

                    	<div id="headerMenu"></div>

					</div> 

                    <div class="logo col-md-6 col-xs-13 col-sm-7 text-left">

                        <a href="<?php echo base_url(); ?>">

                            <img class="img-responsive" src="<?php echo base_url();?>style/web/images/eksisevent/logo-eksisevent.png">

                        </a>

                    </div>

                    <div class="col-md-16 col-sm-23 col-xs-24 fontOswald font18 NavMainMenu hidden-xs" >

                            <div class="row menuCaption">

                                <span class="fontRoboto font18">MENU</span><span onclick="hidemenu();" class="closemenu" >X</span>

                                <hr style="margin:0px; margin-top:10px">

                            </div>

                            <ul id="navMain" class="nav navbar-nav fontAvenir" >

<!--                                <li class="noborder"><a href="<?php echo base_url(); ?>"><span>HOME</span></a></li>-->
<!--
                                <li class="dropdown menudropdown">

                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span>SERVICE</span></a>



                                  <ul class="dropdown-menu subMenu fontRoboto" style="background-color:white">

                                    <li class="liMenu ">

                                        <div class="row menuCaption">

                                        <span class="fontRoboto font18">SERVICE</span><span onclick="hidemenu(true);" class="closemenu">X</span>

                                        <hr style="margin:0px; margin-top:10px">

                                    </div>

                                    <ul class="menuItem">

                                        <li style="height:40%;">
                                            <?php foreach($templatedata['package'] as $listservice){ ?>
                                            
                                            <p><a href='<?php echo base_url() ?>package/detail/<?php echo $listservice->project_id; ?>'><span><?php echo strtoupper($listservice->project_name); ?></span></a></p>
                                            
                                            <?php } ?>                                
                                        </li>
                                    </ul>

                                    </li>

                                  </ul>



                                </li>
-->

                                <li class="noborder"><a href="<?php base_url(); ?>home"><span>Layanan</span></a></li>
                                <li class="noborder"><a href="<?php base_url(); ?>portfolio"><span>Portfolio</span></a></li>
                                <li class="noborder"><a href="<?php base_url(); ?>aboutus"><span>Tentang Kami</span></a></li>
                                <li class="noborder"><a href="<?php base_url(); ?>contactus"><span>Kontak Kami</span></a></li>
                                                
                                
                            </ul>







                    </div>

                </nav>

            </div>

        </div>	

    </div>

    

    <style>

        .homeimg{

            padding: 10px;

        }

        

        .listhr {

            margin-top: 10px;

            margin-bottom: 10px;

            border: 0;

            border-bottom: 1px solid #000;

        }
        
        .footerBackground {
            background: url(style/images/ceffira/image-background.jpg) no-repeat center center fixed;

        }



        @media only screen and (min-width : 320px) and (max-width : 480px) {

            .footerBackground{
               background: url(style/images/ceffira/image-background.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                /*height: 100%;
                overflow: hidden;*/
            }
        }

        </style>

    

    <div class="container-fluid" id="body">

       

       <?php echo $output ?>

	</div>
        
    
    
        
    
    <style>
.main-footer {
 background-color:#fff;
 padding:30px 50px;
 border-radius:0px 0px 0px 0px;
}
.main-footer .menu {
 list-style:none;
 padding:0px;
 margin:0px;
 margin-bottom:10px;
}
.main-footer .menu li {
 vertical-align:top;
 display:inline-block;
 margin-right:20px;
 padding-right:20px;
 border-right:1px solid rgba(0,0,0,0.1);
}
.main-footer .menu li a {
 color:rgba(0,0,0,0.75);
 font-weight:700;
}
.main-footer .menu li:last-child {
 border-right:none;
}
.main-footer .menu li > .sub-menu {
 margin-top:10px;
}
.main-footer .menu li > .sub-menu li {
 display:block;
 margin-bottom:5px;
 border-right:none;
 margin-right:5px;
 padding-right:5px;
}
.main-footer .menu li > .sub-menu li a {
 color:rgba(0,0,0,0.7);
}
.main-footer .menu li > .sub-menu .sub-menu {
 margin-top:15px;
 padding-left:15px;
 margin-bottom:15px;
}
.main-footer .menu li > .sub-menu .sub-menu li {
 display:block;
 margin-bottom:5px;
 border-right:none;
}
.main-footer .menu li > .sub-menu .sub-menu li a {
 font-weight:300;
}
.main-footer .footer-copyright {
 padding-top:10px;
}
.main-footer p {
 margin:0px;
}

.main-footer.with-social .footer-social-w ul {
 display:inline-block;
 list-style:none;
 padding:0px;
 margin:0px;
}
.main-footer.color-scheme-dark {
 color:rgba(255,255,255,0.8);
 background-color:#0e121d;
}
.main-footer.color-scheme-dark .menu li {
 border-right:1px solid rgba(255,255,255,0.1);
}
.main-footer.color-scheme-dark .menu li a {
 color:#efdd8a;
}
.main-footer.color-scheme-dark .menu li > .sub-menu li a {
 color:#e9d05d;
}
        
.main-footer.with-social {
 display:table;
 width:100%;
 table-layout:fixed;
}
.main-footer.with-social .footer-copy-and-menu-w {
 display:table-cell;
}
.main-footer.with-social .footer-social-w {
 display:table-cell;
 width:200px;
 text-align:right;
}
.main-footer.with-social .footer-social-w ul {
 display:inline-block;
 list-style:none;
 padding:0px;
 margin:0px;
}
.main-footer.with-social .footer-social-w ul li {
 display:inline-block;
 margin-left:10px;
}
.main-footer.with-social .footer-social-w ul li a {
 font-size:32px;
 color:rgba(0,0,0,0.75);
}

#footer-gray {
    margin-top: 20px;
    margin-bottom: 20px;
    min-height: 61px;
}
.background-gray {
    background-color: #38393b!important;
}
.text-white {
    color: #fff!important;
}
        
.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}
</style>
        

<div class="container-fluid background-gray" id="footer-gray">
    <div class="container text-center">
        <div class="row font18">
            <div class="col-xs-24 footer-social-w">
                <a href="https://www.instagram.com/eksisevent/" class="text-black text-bold" target="_blank">
                    <button type="button" class="btn btn-default btn-circle btn-xl footer-logo"><i class="fa fa-instagram"></i></button>
                </a>
                <a href="https://www.youtube.com/eksisevent/" class="text-black text-bold" target="_blank">
                    <button type="button" class="btn btn-default btn-circle btn-xl footer-logo"><i class="fa fa-youtube"></i></button>
                </a>
                <a href="https://api.whatsapp.com/send?phone=+628122609949&text=Hello Eksis Event!" class="text-black text-bold" target="_blank">
                    <button type="button" class="btn btn-success btn-circle btn-xl footer-logo"><i class="fa fa-whatsapp"></i></button>
                </a>
            </div>
            
            
        </div>
    </div>
</div>
        
        <div class="container-fluid">
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-24">
                        
                        <img style="padding: 10px 10px; display: inline-block;" src="<?php echo base_url();?>style/web/images/eksisevent/logo-eksisevent.png" width="200">
                        
                        <div class="footer-copyright">
                            <p style="margin-top:20px;margin-bottom:20px;color:white;padding:10px" class="font16">Jl. Pacar No. 67A Baciro, Gondokusuman, Yogyakarta 55525</p>
                            <div style="margin-top:20px;margin-bottom:20px;color:white;" class="font16">
                                Email : eksisevent@gmail.com<br>
                                Tel : +62 274 558072<br>
                                
                            </div>
                            <p style="margin-top:50px;margin-bottom:50px;color:#e50112;" class="font16">copyright @ exsisevent 2022</p>
                        </div>
                </div>
                </div>
            </div>
        </div>
        
        
        
        
        
        <style>
        .homebutton{
    position: fixed;
    bottom: 70px;
    right: 17px;
    width: 50px;
 }

 .scrollbutton{
    position: fixed;
    bottom: 15px;
    right: 17px;
    width: 50px;
 }
        </style>
        
        <div class="container-fluid">
       
<!--       <img class="homebutton" onclick="window.location ='https://api.whatsapp.com/send?phone=628122609949'" id="chatwa" src="https://www.jagapati.com/style/web/images/whatappicon.png">-->
       
       <a class="scroll scrollbutton" target="body"><img src="https://www.salubritas.id/style/web/images/up-button.png" width="100%"></a>
  
    </div>

		

	</body>

	<script type="application/javascript" src="<?php echo base_url(); ?>js/main.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/owl-carousel/owl.carousel.min.js" defer></script>

</html>









