<script>
    
function tmessage(){
            var data;
            var url; 
            var target;
            var objForm = $('#form_message');
            postData(data,url,objForm);
        }
    
$(document).ready(function() {
    
    
    
            
});
    
</script>

<style>
.headerContact {
    width: auto;
    font-size: 16pt;
    color: #555;
    padding-bottom: 15px;
    margin-bottom: 15px;
    border-bottom: 2px solid #0e8f36;
}

.content {
    width: auto;
    min-height: 506px;
    line-height: 20px;
    font-size: 10pt;
    position: relative;
}
.content a {
    font-weight: bold;
    color: #0e8f36;
    text-decoration: none;
}
.italic {
    font-style: italic;
}
.bold {
    font-weight: bold;
}
.noBullet {
    list-style-type: none;
}
.main{
    display: none;
    color: #282828;
    border: 1px solid #ccc;
    padding: 20px;
}
.show {
    display: block;
}
    
.embed-responsive {
  position: relative;
  display: block;
  height: 0;
  padding: 0;
  overflow: hidden;
}
    
.embed-responsive .embed-responsive-item,
.embed-responsive iframe,
.embed-responsive embed,
.embed-responsive object,
.embed-responsive video {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
}
.embed-responsive-16by9 {
  padding-bottom: 56.25%;
}
.embed-responsive-4by3 {
  padding-bottom: 75%;
}
    
.aboutus{
    margin-top:20px;
    margin-bottom:20px;
}
    
#owl-demo .item{
  margin: 3px;
}
    
#owl-demo .owl-item .item{
  width: 195px;
}

#owl-demo .item img{
  display: block;
  width: 100%;
  height: auto;
}
    
.themeNav .owl-controls .owl-buttons {
    position: absolute;
    top: 42%;
    width: 100%;
    left: 0px;
}
    
.themeNav .owl-controls .owl-buttons .owl-prev {
    left: -5px;
    position: absolute;
    border-radius: 0px;
    padding: 30px 5px;
    background-color: white;
    font-size: 20px;
    border: 1px solid rgba(210, 205, 205, 0.85);
    color: #121212;
    top: -31px;
}
    
.themeNav .owl-controls .owl-buttons .owl-next {
    right: -5px;
    position: absolute;
    border-radius: 0px;
    padding: 30px 5px;
    background-color: white;
    font-size: 20px;
    border: 1px solid rgba(210, 205, 205, 0.85);
    color: #121212;
    top: -31px;
}
    
.owl-theme .owl-controls {
    text-align: center !important;
    /*margin-top: -30px !important;*/
    
}

.abouttop{
    position: absolute; bottom: 5px; padding: 0px; left: 0px; right: 50%px;top:0px; text-align: center; text-shadow: rgb(191, 191, 191) 0px 0px 1px;z-index:2;width: 50%;
}
        
.aboutvideo{
    position: absolute; bottom: 5px; padding: 0px; left: 50%; right: 0px;top:0px; text-align: center; text-shadow: rgb(191, 191, 191) 0px 0px 1px;z-index:1;width: 50%;cursor: pointer;
}
        
.aboutbottom{
    position: absolute; bottom: 5px; padding: 10px; left: 0px; right: 0px;top:930px; text-align: center; text-shadow: rgb(191, 191, 191) 0px 0px 1px;
}
    
#owl-brand img {
	-webkit-filter: grayscale(100%); /* Chrome, Safari, Opera */
	filter: grayscale(100%);
	opacity: 0.5;
}

#owl-brand img:hover {
	-webkit-filter: grayscale(0%); /* Chrome, Safari, Opera */
	filter: grayscale(0%);
	opacity: 1;
}
    
    
@media only screen and (max-device-width: 798px) {
    /* STYLES HERE */
    .aboutus{
        margin-top:20px;
        margin-bottom:20px;
        text-align: center;
    }
    
    .abouttop{
        position: absolute; bottom: 5px; padding: 0px; left: 0px; right: 50%;top:0px; text-align: center; text-shadow: rgb(191, 191, 191) 0px 0px 1px;z-index:2;width: 50%;
    }

    .aboutvideo{
        position: absolute; bottom: 5px; padding: 0px; left: 50%; right: 0px;top:0px; text-align: center; text-shadow: rgb(191, 191, 191) 0px 0px 1px;z-index:1;cursor: pointer;width: 50%;
    }

    .aboutbottom{
        position: absolute; bottom: 5px; padding: 10px; left: 0px; right: 0px;top:65%; text-align: center; text-shadow: rgb(191, 191, 191) 0px 0px 1px;
    }
}
}
</style>

<style>
    .paddingProduk{
        padding: 0px 10px 10px 10px;
    }
    .colorBeli{
        color: #d12229;
    }
    
     #main-menu {
    background-color: #2E3039;
}

.list-group-item {
    background-color: white;
    border: none;
    color: black;
}

a.list-group-item {
    color: #000;
}

a.list-group-item:hover,
a.list-group-item:focus {
    background-color: white;
}

a.list-group-item.active,
a.list-group-item.active:hover,
a.list-group-item.active:focus {
    color: #000;
    background-color: #FFF;
    border: none;
}

.list-group-item:first-child,
.list-group-item:last-child {
    border-radius: 0;
}

.list-group-level1 .list-group-item {
    padding-left:30px;
}

.list-group-level2 .list-group-item {
    padding-left:60px;
}
    
.list-group-item {
    position: relative;
    display: block;
    padding: 5px 15px;
    margin-bottom: -1px;
    background-color: #fff;
}
    
.fly{
    background-color: #060808;
    /*border-bottom: 1px solid rgba(255, 255, 255, 0.1);*/
    /*box-shadow: 0 4px 0 #d12229;*/
    font-size: 13px;
    height: 50px;
    left: 0;
    position: fixed;
    right: 0;
    top: 0;
    width: 100%;
    z-index: 1000;

}

.fly .content ul{
    list-style-type: none;
    float: left;
}
.fly .content ul li{
    display: inline;
}
.fly .content ul li a{
    display: inline-block;
    text-decoration: none;
    padding: 7px 10px;
    border-right: 1px solid rgba(255, 255, 255, 0.125);
    color: #f8f8f8;
    font-weight: bold;
}
.fly .content .ribbon{
    text-align: center;
    float: left;
    width: 25%;
    /*background: #fff;
    padding: 2px 10px;
    -webkit-box-shadow: 0 8px 6px -6px #999;
       -moz-box-shadow: 0 8px 6px -6px #999;
            box-shadow: 0 8px 6px -6px #999*/;
}
ul, ol {
    margin-top: 10px;
    margin-bottom: 10px;
}

.trolibagCounter {
    position: absolute;
    right: 96px;
    top: 33px;
    border-radius: 50%;
    height: 25px;
    width: 25px;
    background-color: #da0000;
    font-size: 12px;
    color: white;
    text-align: center;
    padding: 3px;
    z-index: 4;
}

.icon i {
    font-size: 42px;
    line-height: 50px;
    height: 42px;
    margin-top: 15px;
    margin-bottom: 20px;
}

.shoppcart{
    color: black;
    font-size: 24px;
    padding:0px;
    }
    
.navbar {
    position: relative;
    min-height: 50px;
    margin-bottom: 20px;
    border: 0px solid transparent;
}
    
.itemproduct {
    padding: 5px;
    /*border: 1px solid #eae7e7;*/
    border-radius: 2px;
    text-align: center;
    background-color: #fff;
    height: 250px;
}

.itemproduct :hover {
    text-decoration: none;
    /*border: 1px solid #9eb181;*/
    box-shadow: 0 0 3px #B4B4B499;
    border-radius: 2px;
}
    
.second { 
                /*setting alpha = 0.3*/ 
                background: rgba(0, 0, 0, 0.3); 
                border-radius:15px;
            } 

.footerBackground {
	background: url(style/images/ceffira/image-background.jpg) no-repeat center center fixed;

}
    
.img-size {
            width: 220;
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
    
/*css  Tablet-sm  Max  width 789px */
@media only screen and (max-device-width: 719px) {
    .itemproduct {
        padding: 5px;
        /*border: 1px solid #eae7e7;*/
        border-radius: 2px;
        text-align: center;
        background-color: #fff;
        height: 230px;
    }
    
    .paddingProduk{
        padding: 0px 5px 5px 5px;
    }
        
}
    

<style>

    
    .owl-carousel .item {
    background: #1b1b1b;
    padding: 1rem;
}

body{
/*  padding: 10px;*/
}.flex-container {
  display: flex;
  flex-wrap: nowrap;
  background-color: #1b1b1b;
}

.flex-container > div {
  background-color: #f1f1f1;
  width: 100%;
  margin: 5px;
  text-align: center;
  line-height: 75px;
  font-size: 30px;
}
    
    
.image-box {
    position: relative;
    overflow: hidden;
}

.image-box img {
    width: 100%;
    transition: .5s
}

.text-box {
    position: absolute;
    top: 0;
    left: -100%;
    height: 100%;
    width: 100%;
    background: rgba(255, 0, 0, 0.7);
    transition: 0.5s
}

.text-box h3 {
    margin: 0;
    padding: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    color: #FFF;
    font-family: arial;
    transform: translateX(-50%) translateY(-50%);
}

.text-box p {
    margin: 0;
    padding: 0;
    position: absolute;
    top: 60%;
    left: 112%;
    width: 100%;
    color: #FFF;
    font-family: arial;
    transform: translateX(-50%) translateY(-50%);
}
    
.container-img {
    margin: 30px auto;
    width: 500px;
}



.image-box:hover .text-box {
    left: 0%;
}

.image-box:hover img {
    transform: scale(1.2)
}
</style>


<div class="container-fluid" style="margin-top:5px">
    <div class="container">
        <div class="row">
            <div class="col-xs-24">
                
                <div id="owl-layanan"  class="owl-carousel owl-theme">
    <div class="item">
      <div class="flex-container">
        <div>
          
          <div class="image-box">
    <img src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/event-khusus.jpeg" style="display: inline-block;" width="100%" title="" alt="">
    <div class="text-box">
      <h3><span class="text-white">Event Khusus</span></h3>
    </div>
  </div>
        </div>
          
  <div>
      <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/pertunjukan.jpg" style="display: inline-block;" width="100%">
          <div class="text-box">
      <h3><span class="text-white">Pertunjukan</span></h3>
    </div>
  </div>
        </div>
  <div>
      <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/virtual-event.jpg" style="display: inline-block;" width="100%">
      <div class="text-box">
      <h3><span class="text-white">Virtual Event</span></h3>
    </div>
  </div>
        </div>  
</div>

        <div class="flex-container">
        <div>
            <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/Konferensi.jpg" style="display: inline-block;" width="100%">
                <div class="text-box">
      <h3><span class="text-white">Konferensi</span></h3>
    </div>
  </div>
        </div>
  <div>
      <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/awarding.jpg" style="display: inline-block;" width="100%">
      <div class="text-box">
      <h3><span class="text-white">Apresiasi (Awarding)</span></h3>
    </div>
  </div>
        </div>
  <div>
      <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/peringatan.jpg" style="display: inline-block;" width="100%">
      <div class="text-box">
      <h3><span class="text-white">Peringatan</span></h3>
    </div>
  </div>
        </div>  
</div>
      
    </div>
    <div class="item">
      <div class="flex-container">
        <div>
            <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/kemasyarakatan.jpeg" style="display: inline-block;" width="100%">
            <div class="text-box">
      <h3><span class="text-white">Kemasyarakatan</span></h3>
    </div>
  </div>
        </div>
  <div>
      <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/festival.jpg" style="display: inline-block;" width="100%">
      <div class="text-box">
      <h3><span class="text-white">Festival</span></h3>
    </div>
  </div>
        </div>
  <div>
      <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/launching.jpg" style="display: inline-block;" width="100%">
      <div class="text-box">
      <h3><span class="text-white">Launching Event</span></h3>
    </div>
  </div>
        </div>  
</div>

        <div class="flex-container">
        <div>
            <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/pameran.jpg" style="display: inline-block;" width="100%">
            <div class="text-box">
      <h3><span class="text-white">Pameran</span></h3>
    </div>
  </div>
        </div>
  <div>
      <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/CSR-marketing-activation.jpg" style="display: inline-block;" width="100%">
      <div class="text-box">
      <h3><span class="text-white">CSR & Marketing Activation</span></h3>
    </div>
  </div>
        </div>
            <div>
                <div class="image-box">
          <img class="imgload" src="<?php echo base_url();?>style/web/images/eksisevent/layanan/square/CSR-marketing-activation.jpg" style="display: inline-block;" width="100%">
                <div class="text-box">
      <h3><span class="text-white">CSR & Marketing Activation</span></h3>
    </div>
  </div>
        </div>
</div>
      
    </div>
</div>

            </div>
        </div>
    </div>
</div>

<div>
    
    <style>
        .title-line {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 5px solid #e60013;
    }
    </style>
    
    <div class="container-fluid">
        <div class="container">
        <div class="row padding10">
            <div class="col-xs-24 padding10">
                <span class="font24 text-white"><b>Apa yang kita lakukan ? </b></span>
                <hr size="10px" class="title-line" width="50%" align="left">
                <div class="wpb_wrapper text-white font20" style="text-align:justify">
                    <p> Kami melakukan Pengorganisasian Acara: Acara Perusahaan/Instansi pemerintah, Peluncuran Produk & Layanan, Acara Amal & Sosial, dan Festival.</p>
                    <p> Kami juga melakukan produksi: Identitas Perusahaan/Merek, Foto/Video Komersial, Desain  & Iklan Cetak, Desain Multimedia, Grafis 2D, Grafis 3D.</p>

                </div>
            </div>
            
        </div>
            </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner" style="padding-top: 35px;">
                    <div class="wpb_wrapper"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="container">
        <div class="row padding10">
            <div class="col-xs-24 padding10">
            <span class="font20 text-white"><b>KONTAK KAMI</b></span>
               <br>
                </div>
            <div class="col-lg-12 col-xs-24 padding10 text-white">
                <div class="wpb_wrapper">
                    <p>Melakukan konsultasi bukan berarti di haruskan membayar. Konsultasi pertama dengan kantor kami tidak dikenakan biaya dan bisa memberikan manfaat yang besar dalam proses pengambilan keputusan anda.</p>
                    <p>Ada beberapa cara untuk menghubungi kami dan principal kami akan menjawab pertanyaan anda secepat mungkin :</p>
                    <ol>
                        <li>E-mail : eksisevent@gmail.com</li>
                        <li>WhatsApp <i class="fa fa-whatsapp"></i> pesan to: +628122609949</li>
                        <li>Hubungi langsung ke kantor kami : +62 274 558072</li>
                    </ol>
                    <p>Silahkan memilih metode yang paling nyaman untuk anda untuk mengirimkan pertanyaan kepada kami. Anda tidak akan pernah tahu apakah kami dapat menolong adan atau biaya kompetitif kami memenuhi bugdet anda bila anda tidak menghubungi kami.</p>
                    <h5><strong>Kantor Kami</strong></h5>
                    <p>Jl. Pacar No. 67A Baciro, Gondokusuman, Yogyakarta 55525
                        <br> Tel :  +62 274 558072
                        <br> E-mail :eksisevent@gmail.com</p>

                </div>
            </div>
            
            <div class="col-lg-12 col-xs-24 padding10">
                <div style="width: 100%;">
                   <div style="width: 100%"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.973130343625!2d110.3785418494535!3d-7.792669479469325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a598f10cf6163%3A0xd8fbdaad6fcf2806!2sEKSIS%20EVENT!5e0!3m2!1sid!2sid!4v1657980534387!5m2!1sid!2sid" width="100%" height="50%" frameborder="0" style="border:0" allowfullscreen></iframe></div>
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner" style="padding-top: 35px;">
                    <div class="wpb_wrapper"></div>
                </div>
            </div>
        </div>
    </div>

    
    
</div>


