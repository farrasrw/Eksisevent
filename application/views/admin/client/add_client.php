<!-- Tagit -->
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/Tagit2/css/jquery.tagit.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Tagit2/tag-it.min.js"></script>





<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tinymce/js/tinymce/tinymce.min.js"></script>

<!-- Dropzone -->
<link href="<?php echo base_url() ?>assets/js/dropzone/css/basic.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/js/dropzone/css/dropzone.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/dropzone/dropzone.min.js"></script>



<script>
	
	
	var availableTags = <?php echo (!empty($taglist)?json_encode($taglist):'[]') ; ?>;
	function elFinderBrowser (callback, value, meta) {
			tinymce.activeEditor.windowManager.open({
				file: '<?php echo base_url(); ?>admin/client/imagemanager/<?php echo $dropkey; ?>/<?php echo ($hdnkey!='tambahclient'?$hdnkey:''); ?>',// use an absolute path!
				title: 'Image Manager',
				width: 700,	
				height: 400,
				resizable: 'no'
			}, {
				oninsert: function (file) {
					var url, reg, info;

					// URL normalization
					url = file.url;
					reg = /\/[^/]+?\/\.\.\//;
					while(url.match(reg)) {
						url = url.replace(reg, '/');
					}
					
					// Make file info
					info = file.name;

					
					// Provide image and alt text for the image dialog
					if (meta.filetype == 'image') {
						callback(url, {alt: info});
					}

					
				}
			});
			return false;
		}
		
	tinymce.init({
            selector: "#textarea1",
			min_height: 300,
					relative_urls: false,
			remove_script_host: false,
			plugins: [
                "importcss advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
			],

			toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
			toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
			toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

			menubar: false,
			toolbar_items_size: 'small',

			style_formats: [
					{title: 'Bold text', inline: 'b'},
					{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
					{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
					{title: 'Example 1', inline: 'span', classes: 'example1'},
					{title: 'Example 2', inline: 'span', classes: 'example2'},
					{title: 'Table styles'},
					{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
			],
			file_picker_callback : elFinderBrowser,
			file_picker_types: 'image',
			content_css: '/assets/admin/dist/css/stylecontent.css',
    	importcss_append: true,
		  importcss_file_filter: "/assets/admin/dist/css/stylecontent.css",

			templates: [
					{title: 'Test template 1', content: 'Test 1'},
					{title: 'Test template 2', content: 'Test 2'}
			]
		


        });
	
	function saveclient(){
		
		var data= { clientcontent : tinyMCE.get('textarea1').getContent(),  };
		var url;
		var objform = $('#formclient');
		postData(data,url,objform);
	}
	
	
	
	$(function (){
		
        $('#datepulish').datepicker({
		  autoclose: true,
		  dateFormat: 'yy-mm-dd'
		});
		
		$('#taging').tagit({
			tagSource:availableTags, 
          
			//caseSensitive:false,
            triggerKeys:['enter', 'comma', 'tab'],
            allowSpaces:true,
            showAutocompleteOnFocus:true
        });
		
		Dropzone.options.myDropzone = {
			serverpath: "<?php echo base_url(); ?>admin/client/dropzone",
			serverkey: $('#hdnkey').val(),
			addRemoveLinks: true
		};
		
		$('#fileimg').change(function(){
			var data = {imgId:'imgheader' }
			$('#formimg').attr('action','<?php echo base_url(); ?>admin/client/uploadImage');
			uploadImage( $('#formimg'), data, function(){}, function(v){
				$('#imageheader').val(v.filename);
				
			});
		});
		
    });
	
</script>
        <?php error_reporting(0) ?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Produk
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      	<div class="row">
            
            <div class="col-md-2" id="leftCol">
					<div id="sidebar">
					<h3>Menu Produk</h3>
					<a style="margin-bottom:5px" href="<?php echo base_url(); ?>admin/client/index.html" class="btn btn-success btn-flat"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;&nbsp; Lihat Data Client </a>
					<a onclick="saveclient()" style="margin-bottom:5px" href="#" class="btn bg-navy btn-flat"><i class="glyphicon glyphicon-save"></i>&nbsp;&nbsp; Save Client </a>
                    <a style="margin-bottom:5px" href="<?php echo base_url(); ?>admin/client/index.html" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;&nbsp; Cancel </a>
					 </div>
				 </div>
            
			<div class="col-md-7">
			<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Harap Isi Form Client Dengan Lengkap</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/client/<?php echo ($viewstate=='add'?'saveaddclient':'saveeditclient');  ?>" id="formclient">
				<input type="hidden" name="hdnkey" id="hdnkey" value="<?php echo $this->ffunction->encode($hdnkey); ?>"/>
				<input type="hidden" name="dropkey" value="<?php echo $dropkey; ?>"/>
				<input type="hidden" name="imageheader" value="" id="imageheader" />

				<div class="box-body">
                <div class="form-group">
                  <label  class="col-sm-3 control-label nobold font16">Nama Client</label>
                  <div class="col-sm-8">
                    <input class="form-control" required name="txtNama"  placeholder="nama client" type="text" value="<?php echo $client->namadepan;  ?>">
                  </div>
                </div>
                    
                <div class="form-group">
                  <label  class="col-sm-3 control-label nobold font16">Email / Username</label>
                  <div class="col-sm-8">
                    <input class="form-control" required name="txtEmail"  placeholder="Username" type="text" value="<?php echo $client->email;  ?>">
                  </div>
                </div>
                    
                <div class="form-group">
                  <label  class="col-sm-3 control-label nobold font16">Password</label>
                  <div class="col-sm-8">
                    <input class="form-control" required name="txtPassword"  placeholder="Password" type="text" value="<?php echo $client->password;  ?>">
                  </div>
                </div>
                    
                <div class="form-group">
                  <label  class="col-sm-3 control-label nobold font16">Nomor Telepon</label>
                  <div class="col-sm-8">
                    <input class="form-control" required name="txtNoTlp"  placeholder="Nomer Telepon" type="text" value="<?php echo $client->nohandphone;  ?>">
                  </div>
                </div>
                    
                <div class="form-group">
                  <label  class="col-sm-3 control-label nobold font16">Nomor Telepon</label>
                  <div class="col-sm-8">
                    <input class="form-control" required name="txtAlamat"  placeholder="Alamat" type="text" value="<?php echo $client->alamat;  ?>">
                  </div>
                </div>
                    
				<div class="form-group">
                  <div class="col-sm-11  pull-right" style="width:95%" >
					<label  class="control-label nobold font16">Client Deskripsi Singkat</label>  <br>
					<textarea id="textarea1" ><?php echo $client->deskripsi ?></textarea>  
                  </div>
                </div>
                </div>
				
			 </form>	
				
				
            
				
         
          </div>
					</div>
			<div class="col-md-3">
				<div class="box">
					<div class="box-header with-border">
					  <h3 class="box-title">Image Header</h3>
					</div>

						<div class="box-body">
							<img id="imgheader" style="border:1px solid rgb(231, 230, 230)" src="<?php echo $this->imageloader->fimageclient($client,1); ?>" width="100%" />
						<br>
							
						<form  id="formimg" action="<?php echo base_url(); ?>admin/client/uploadImage" method="post" enctype="multipart/form-data">	
							<input type="file" name="fileimg" id="fileimg" >
							<input type="hidden" name="uploadkey" value="<?php echo $dropkey; ?>"/>
						</form>
							
					</div>
				</div>
			</div>
	
		</div>	
    </section>
    <!-- /.content -->