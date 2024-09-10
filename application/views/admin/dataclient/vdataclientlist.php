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
	$(function() {
		contoj = $('#contoj').dataTable({
            "responsive" :true,
			"processing": true,
			"serverSide": true,
			"sDom": '<"top"i>rt<"bottom"flp><"clear">',
			//"bLengthChange": false,
			"sAjaxSource": "<?php echo $this->config->item('rootPath'); ?>/admin/uploaddataclient/listDataClient",
			"bAutoWidth": true,
			"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
				$('td', nRow).attr('nowrap','nowrap');
				return nRow;

			},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
				
				aoData.push( { "name": n, "value": v} );

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
            <li class="active">Upload Data Client</li>
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
                  <h3 class="box-title">Upload Data Client</h3>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                  <button class="btn btn-danger btn-flat"  onclick= "location.href='<?php echo site_url('admin/uploaddataclient/addDataCLient'); ?>'"><b>&nbsp;&nbsp;&nbsp;&nbsp;Upload Data Client &nbsp; &nbsp;&nbsp;&nbsp;</b></button>
                </div>
                
                <div class="box-body">
            
            <table class="data display datatable" id="contoj" width="100%">
                <label>Search:&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="judul" style="width:200px" onkeyup="n=$(this).attr('name');v=$(this).val(); contoj.fnDraw();" placeholder="judul">
				<thead> 
					<tr>
                        <th>CreateDate</th>
						<th>TransId</th>
						<th>Judul</th>
						<th>Download</th>
						<th nowrap width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="7" class="dataTables_empty">Loading data from server</td>
					</tr>
				</tbody>
			</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		