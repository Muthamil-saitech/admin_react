<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/responsive.bootstrap.min.css">
<!-- datetimepicker -->
<link href="<?php echo assets(); ?>css/datetimepicker.css" rel="stylesheet" />
<script src="<?php echo assets(); ?>js/moment.min.js"></script>
<script src="<?php echo assets(); ?>js/bootstrap-datetimepicker.min.js"></script>
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success(); ?></div>
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h4 class="card-title col-sm-6 col-form-label">Blogs without filter</h4>
						<div class="col-sm-6">
							<a href="<?php echo site_url(ADMIN.'/blogs_wo_fil/add_blog'); ?>" class="btn btn-sm btn-light text-grey float-right"><i class="mdi mdi-plus-circle-outline"></i> Add Blog</a>
						</div>
					</div>
					<div class="table-responsive mt-3">
						<table class="table table-hover table-bordered DataTable">
							<thead>
								<tr>
									<th></th>
									<th>Title</th>
									<th>Publish Date</th>
									<th>Status</th>
									<th>Latest Blog</th>
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
	</div>
</div>
<script src="<?php echo assets(); ?>vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?php echo assets(); ?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="<?php echo assets(); ?>vendors/datatables.net-bs4/dataTables.responsive.min.js"></script>
<script>
$(function() {
	filter();
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
			url :"<?php echo site_url(ADMIN.'/blogs_wo_fil/load_data'); ?>",
			type: "POST",
			"data":function(data) {
			},
			error: function() {
				$("#datatable_processing").css("display","none");
			}
		},
		 searching: true, paging: true, info: true, processing: true,
		"drawCallback": function (settings) { 
			 var response = settings.json;
			$('#total_blogs').html(response.total_blogs); 
		},
	});
}
function delete_data(blog_id){
	if(confirm('Are you sure want to delete this record ?')) {
		window.location.href="<?php echo site_url(ADMIN.'/blogs_wo_fil/delete_data/') ?>"+blog_id;
	}
}
function update_status(blog_status, blog_id) {
    if(confirm('Are you sure you want to change the status?')) {
        $.ajax({
            url: '<?php echo site_url(ADMIN . '/blogs_wo_fil/update_status'); ?>',
            type: 'POST',
            data: { blog_status: blog_status, blog_id: blog_id },
            success: function(html) {
				if(html != '') {
					if(html === 'Inactive'){
						$('#blog_status_' + blog_id).removeClass('btn-success').addClass('btn-danger').val('Inactive');
					} else {
						$('#blog_status_' + blog_id).removeClass('btn-danger').addClass('btn-success').val('Active');
					}
				} else {
					alert('Something went wrong.')
				}
				$('.DataTable').DataTable().ajax.url('<?php echo site_url(ADMIN . '/blogs_wo_fil/load_data'); ?>').load(); 
            }
        });
    }
}
function update_latest_status(is_latest, blog_id) {
	if(confirm('Are you sure want to change the status in is latest?')) {
		$.ajax({
			url: '<?php echo site_url(ADMIN.'/blogs_wo_fil/update_latest_status'); ?>',
			type: "post",
			data: { is_latest: is_latest, blog_id:blog_id },
			success: function(response) {
				$('#is_latest_'+blog_id).val(response);
				if(response == 'N') { $('#latest_msg_'+blog_id).html('<span class="text-success">Added</span>')}
				if(response == 'Y') {  $('#latest_msg_'+blog_id).html('<span class="text-danger">Removed</span>')}
			}
		});
	} else {
		$('.DataTable').DataTable().ajax.url('<?php echo site_url(ADMIN.'/blogs_wo_fil/load_data'); ?>').load();
	}
}
</script>