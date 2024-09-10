<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/DataTables/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>js/DataTables/js/jquery.dataTables.min.js" type="text/javascript"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/DataTables/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/DataTables/css/dataTables.responsive.css">

<script src="<?php echo base_url() ?>js/DataTables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/DataTables/js/dataTables.responsive.js"></script>

<style> .dataTables_filter { display:none} #contoj_length{margin-top:15px !important}</style>
<script type="text/javascript">
    var contoj;
    var n;
    var v;
    $(function () {
        contoj = $('#contoj').dataTable({
			bFilter: false,
            "processing": true,
			"order": [[ 0, "desc" ]],
            "serverSide": true,
            "sDom": '<"top"i>rt<"bottom"flp><"clear">',
            "sAjaxSource": "<?php echo base_url(); ?>admin/client/listclientdata",
            "bAutoWidth": true,
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                $('td', nRow).attr('nowrap', 'nowrap');
                return nRow;
            },
            "fnServerData": function (sSource, aoData, fnCallback, oSettings) {
				aoData.push({ "name": "clienttitle", "value": $('#clienttitle').val() });
                oSettings.jqXHR = $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success": fnCallback
                });
            }
        });
    });

</script>
<script type="text/javascript">
$(document).ready(function () {
    


    $('.hapus').on('click',function(event_ref){
       // alert('sfsg');
        event_ref.preventDefault();
        if (confirm('Yakin Hapus Data Tersebut " '+ $(this).attr('data') + ' " ?')){
            window.location = $(this).attr('href');
            
        }else{
          return false;
        }
    });
});
</script>
  
<style>
	#contoj td { white-space: normal; font-size:14px;}
    #contoj tr { white-space: normal; font-size:14px;}

</style>




<section class="content-header">

          <h1>
              Admin <small>Kusbiyanto</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/menu'); ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Data Admin</li>
          </ol>
        </section>
		
		<!--<div class="box-body">
                  <button class="btn btn-default btn-block btn-flat"  onclick= "location.href='<?php //echo site_url('admin/admin/addAdmin'); ?>'"><b>Add Admin</b></button>
                </div>-->

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Admin Client</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
					<button class="btn btn-danger btn-flat" onclick="location.href='<?php echo site_url('admin/client/addclient'); ?>'">&nbsp;&nbsp;&nbsp;Tambah Client&nbsp;&nbsp;&nbsp;</button>
                  </div>
                
                <div class="box-body">
                    <table id="contoj" class="data display datatable" cellspacing="0" width="100%">
						<label class="nobold"> Cari Title Client <input id="clienttitle"  onkeyup="contoj.fnDraw();" name="clienttitle" type="text" class="form-control" value=""/> </label>

						<thead>
							<tr>
								<th>Title</th>
								<th>Image</th>
                                <th>Email</th>
                                <th>Pass</th>
                                <th>No Tlp</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		