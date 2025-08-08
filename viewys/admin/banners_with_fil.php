<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/responsive.bootstrap.min.css">
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success(); ?></div>
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h5 class="card-title col-sm-6 col-form-label">Banners With Filter</h5>
						<div class="col-sm-6">
							<a href="<?php echo site_url(ADMIN.'/banners_with_fil/add_banner'); ?>" class="btn btn-sm btn-outline-grey text-grey float-right"><i class="mdi mdi-plus-circle-outline"></i> Add Banner</a>
							<a class="btn btn-sm btn-outline-grey text-grey float-right mr-3" onclick="filter_modal()"><i class="mdi mdi-filter-outline"></i> Filter</a>
						</div>
					</div>					
					<div class="table-responsive mt-3">
						<table class="table table-bordered DataTable">
							<thead>
								<tr>
									<th></th>
									<th>Short Title</th>
									<th>Title</th>
									<th>Sequence</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="filterModal" role="dialog">
			<div class="modal-dialog">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <h4 class="modal-title">Filters</h4>
				  <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<label class="col-form-label col-lg-4">Banner Status <span class="text-danger"></span></label>
						<select class="form-control form-control-sm col-lg-6" name="banner_status" id="banner_status" required>
							<option value="">- Select - </option>
							<option value="Active">Active</option>
							<option value="Inactive">Inactive</option>
						</select>
					</div>  
				</div>
				<div class="modal-footer">
					<button type="button" name="filter" class="btn btn-sm btn-outline-grey mr-2 p-2" onclick="table_filter();" title="Filter"><i class="mdi mdi-checkbox-marked-circle-outline"></i></button>
					<button type="button" class="btn btn-sm btn-outline-grey mr-2 p-2" onclick="reset();" title="Reset"><i class="mdi mdi-refresh"></i></button>
				</div>
			  </div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo assets(); ?>vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?php echo assets(); ?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="<?php echo assets(); ?>vendors/datatables.net-bs4/dataTables.responsive.min.js"></script>
<script>
$(function() {
	filter();
});
$(document).on('click', '#closeModal', function () {
	$('#banner_status').val('');
    $('#filterModal').modal('hide');
});
function filter() {
	$('.DataTable').DataTable({
		"language": { 
			search: '_INPUT_',
			searchPlaceholder: 'Search '
		},
		"aLengthMenu": [
			[5, 10, 15, -1],
			[5, 10, 15, "All"]
		],
		"iDisplayLength": 10,
		responsive:true,
		ordering: false,
		bStateSave: true,
		bRetrieve:true,
		serverSide: true,
		autoWidth: false,	
		bAutoWidth: false,
		"ajax": {
			url :"<?php echo site_url(ADMIN.'/banners_with_fil/load_data'); ?>",
			type: "POST",
			"data":function(data) {
				data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>'; 
				data.banner_status = $('#banner_status').val() || '';
			},
			error: function() {
				$("#datatable_processing").css("display","none");
			}
		},
		 searching: true, paging: true, info: true, processing: true,
		"drawCallback": function (settings) { 
			var response = settings.json;
			$('#total_banners').html(response.total_banners);
			$('#filterModal').modal('hide');			
		},
	});
}
function table_filter() {
	$('.DataTable').DataTable().ajax.url('<?php echo site_url(ADMIN.'/banners_with_fil/load_data'); ?>').load();
	filter();
}
function delete_data(banner_id) {
	if(confirm('Are you sure want to delete this record ?')) {
		window.location.href="<?php echo site_url(ADMIN.'/banners_with_fil/delete_data/') ?>"+banner_id;
	}
}
function update_status(banner_status, banner_id) {
    if(confirm('Are you sure you want to change the status?')) {
        $.ajax({
            url: '<?php echo site_url(ADMIN.'/banners_with_fil/update_status'); ?>',
            type: 'POST',
            data: { banner_status: banner_status, banner_id: banner_id },
            success: function(html) {
				if(html != '') {
					if(html === 'Inactive'){
						$('#banner_status_' + banner_id).removeClass('btn-success').addClass('btn-danger').val('Inactive');
					} else {
						$('#banner_status_' + banner_id).removeClass('btn-danger').addClass('btn-success').val('Active');
					}
				} else {
					alert('Something went wrong.')
				}
				$('.DataTable').DataTable().ajax.url('<?php echo site_url(ADMIN.'/banners_with_fil/load_data'); ?>').load(); 
            }
        });
    }
}
function filter_modal() {
	$('#banner_status').val('');
	$("#filterModal").modal("toggle");	
}
function reset() {
	$('#banner_status').val('');
}
</script>