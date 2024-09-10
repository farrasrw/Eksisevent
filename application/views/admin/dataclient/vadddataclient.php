<script>
function saveOrder(){
            var data;
            var url; 
            var target;
            var objForm = $('#form_message');
            postData(data,url,objForm);
        }
</script>

<section class="content-header">
         <?php error_reporting(0) ?>
          <h1>
            Admin <small>Kusbiyanto</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/menu'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Admin</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-2" id="leftCol">
					<div id="sidebar">
					<h3>Menu Admin</h3>
					<a style="margin-bottom:5px" href="<?php echo site_url('admin/uploaddataclient');?>" class="btn btn-success"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;&nbsp; Lihat Data Client</a>
					<a onclick="saveOrder()" style="margin-bottom:5px" href="#" class="btn bg-primary"><i class="glyphicon glyphicon-save"></i>&nbsp;&nbsp; Save Upload Data Client </a>
                    <a style="margin-bottom:5px" href="<?php echo site_url('admin/uploaddataclient');?>" class="btn btn-danger"><i class="glyphicon glyphicon-briefcase"></i>&nbsp;&nbsp; Cancel </a>
					 </div>
				 </div>
            
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header">
                 <h3 class="box-title">Upload Data Client</h3>
                 
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" name="formDetail" id="form_message" method="post" action="<?php echo site_url('admin/uploaddataclient/saveOrder'); ?>" onsubmit="fSubmit();">
                  <div class="box-body">
                         <input type="hidden" id="hdnKey" name="hdnKey" value="<?php echo $this->encrypt->encode($Key); ?>">
                    
                    <div class="form-group row">
                     <div class="col-sm-6">
                      <label for="exampleInputEmail1">Nama Client</label>
                      <select name="txtClientId" class="form-control" >
                            <?php 
                                foreach($client as $listclient){
                                    echo "<option value='".$listclient->memberid."'>".$listclient->namadepan."</option>";	
                                }
                            ?>
                        </select> 
                       </div>
                       
                    </div>
                    
                    <div class="form-group row">
                    <div class="col-sm-8">
                      <label for="exampleInputEmail1">Judul</label>
                          <input required  type="text" id="namabelakang" name="txtJudul" class="form-control" value="<?php echo $judul;?>" >
                       </div>
                    </div>
                      
                    <div class="form-group row">
                    <div class="col-sm-8">
                      <label for="exampleInputEmail1">Pesan</label>
                          <textarea class="form-control" style="height: 100px;" required="" name="txtPesan"><?php echo $pesan;?></textarea>
                       </div>
                    </div>
                      
                    <?php if($transid !=""){?>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">File PDF</label>
                            <?php if($fileupload !=""){ 
                                    echo "<input type='text' class='form-control' value=".$fileupload." readonly />";
                                }else{ 
                                    echo "<input type='text' class='form-control' value='File PDF Empty, Please Select File' readonly />";}?>
                        </div>
                  </div>
                      <?php } ?>
                      
                    <div class="form-group row">
                    <div class="col-sm-8">
                      <label for="exampleInputEmail1">Upload File PDF</label>
                          <input class="upload" type="file" name="objFile" id="objFile" accept=".pdf" value="<?php echo $fileupload ?>" />
                       </div>
                    </div>
                      
                  </div><!-- /.box-body -->
                      
                  <!--<div class="box-footer">
                    <input class="btn btn-success" type="submit" name="btnSave" value="Save" />
                    <a class="btn btn-danger" href="<?php //echo site_url('admin/admin');?>">Cancel</a>
                    
                  </div>-->
                </form>
              </div><!-- /.box -->
			  </div>
			  </div>
</section>