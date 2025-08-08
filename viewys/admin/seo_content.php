<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/responsive.bootstrap.min.css">
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success(); ?></div>
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h4 class="card-title col-sm-6 col-form-label">SEO Content</h4>
						<div class="col-sm-6">
							<a href="<?php echo site_url(ADMIN.'/seo_content/add_seo'); ?>" class="btn btn-light text-grey float-right"><i class="mdi mdi-plus-circle-outline"></i> Add SEO</a>
						</div>
					</div>
					<div class="table-responsive mt-3">
						<table class="table table-hover table-bordered DataTable">
							<thead>
								<tr>
									<th>Page Name</th>
									<th>Page Link</th>
									<th>Meta Title</th>
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
			url :"<?php echo site_url(ADMIN.'/seo_content/load_data'); ?>",
			type: "post",
			"data":function(data) {
			},
			error: function() {
				$("#datatable_processing").css("display","none");
			}
		},
		searching: true, paging: true, info: true,
		"drawCallback": function (settings) { 
			var response = settings.json;
			/* $('#total_seo_content').html(response.total_seo_content); */
		},
	});
}

</script>