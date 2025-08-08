<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/responsive.bootstrap.min.css">
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success(); ?></div>
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h5 class="card-title col-sm-6 col-form-label">Testimonials without filter</h5>
						<div class="col-sm-6">
							<a href="<?php echo site_url(ADMIN.'/testimonials_wo_fil/add_testimonial'); ?>" class="btn btn-sm btn-outline-grey text-grey float-right"><i class="mdi mdi-plus-circle-outline"></i> Add Testimonial</a>
						</div>
					</div>
					<div class="table-responsive mt-3">
						<table class="table table-hover DataTable">
							<thead>
								<tr>
									<th></th>
									<th>Name</th>
									<th>Designation</th>
									<th>Ratings</th>
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
			url :"<?php echo site_url(ADMIN.'/testimonials_wo_fil/load_data'); ?>",
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
			$('#total_testimonials').html(response.total_testimonials);			
		},
	});
}
function delete_data(testimonial_id){
	if(confirm('Are you sure want to delete this record ?')) {
		window.location.href="<?php echo site_url(ADMIN.'/testimonials_wo_fil/delete_data/') ?>"+testimonial_id;
	}
}
function update_status(testimonial_status, testimonial_id) {
    if(confirm('Are you sure you want to change the status?')) {
        $.ajax({
            url: '<?php echo site_url(ADMIN.'/testimonials_wo_fil/update_status'); ?>',
            type: 'POST',
            data: { testimonial_status: testimonial_status, testimonial_id: testimonial_id },
            success: function(html) {
				if(html != '') {
					if(html === 'Inactive'){
						$('#testimonial_status_' + testimonial_id).removeClass('btn-success').addClass('btn-danger').val('Inactive');
					} else {
						$('#testimonial_status_' + testimonial_id).removeClass('btn-danger').addClass('btn-success').val('Active');
					}
				} else {
					alert('Something went wrong.')
				}
				$('.DataTable').DataTable().ajax.url('<?php echo site_url(ADMIN.'/testimonials_wo_fil/load_data'); ?>').load(); 
            }
        });
    }
}
</script>