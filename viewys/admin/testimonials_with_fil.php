<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo assets(); ?>vendors/datatables.net-bs4/responsive.bootstrap.min.css">
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success(); ?></div>
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h5 class="card-title col-sm-6 col-form-label">Testimonials with filter</h5>
						<?php /* <div class="col-sm-1">
						</div>
						<div class="col-sm-2">
							<select class="form-control form-control-sm" id="rating-range" onchange="rating_change(this.value)">
								<option value=""> Ratings </option>
								<option value="lth">Low to high</option>
								<option value="htl">High to low</option>
								<option value="nor">Normal</option>
							</select>
						</div> */ ?>
						<div class="col-sm-6">
							<a href="<?php echo site_url(ADMIN.'/testimonials_with_fil/add_testimonial'); ?>" class="btn btn-sm btn-outline-grey text-grey float-right"><i class="mdi mdi-plus-circle-outline"></i> Add Testimonial</a>
							<a class="btn btn-sm btn-outline-grey text-grey float-right mr-3" onclick="filter_modal()"><i class="mdi mdi-filter-outline"></i> Filter</a>
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
		<div class="modal fade" id="filterModal" role="dialog">
			<div class="modal-dialog">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <h4 class="modal-title">Filters</h4>
				  <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row mb-3">
						<label class="col-form-label col-lg-4">Rating <span class="text-danger"></span></label>
						<select class="form-control form-control-sm col-lg-6" name="rating" id="rating" >
							<option value="">- Select - </option>
							<option value="5">5</option>
							<option value="4">4</option>
							<option value="3">3</option>
							<option value="2">2</option>
							<option value="1">1</option>
						</select>
					</div> 
					<div class="row">
						<label class="col-form-label col-lg-4">Testimonial Status <span class="text-danger"></span></label>
						<select class="form-control form-control-sm col-lg-6" name="testimonial_status" id="testimonial_status" >
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
			url :"<?php echo site_url(ADMIN.'/testimonials_with_fil/load_data'); ?>",
			type: "POST",
			"data":function(data) {
				data['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>'; 
				data.testimonial_status = $('#testimonial_status').val() || '';
				data.rating = $('#rating').val() || '';
			},
			error: function() {
				$("#datatable_processing").css("display","none");
			}
		},
		searching: true, paging: true, info: true, processing: true,
		"drawCallback": function (settings) { 
			var response = settings.json;
			$('#total_testimonials').html(response.total_testimonials);
			$('#filterModal').modal('hide');			
		},
	});
}
function table_filter() {
	$('.DataTable').DataTable().ajax.url('<?php echo site_url(ADMIN.'/testimonials_with_fil/load_data'); ?>').load();
	filter();
}
$(document).on('click', '#closeModal', function () {
	$('#banner_status').val('');
	$('#rating').val('');
    $('#filterModal').modal('hide');
});
function delete_data(testimonial_id){
	if(confirm('Are you sure want to delete this record ?')) {
		window.location.href="<?php echo site_url(ADMIN.'/testimonials_with_fil/delete_data/') ?>"+testimonial_id;
	}
}
function update_status(testimonial_status, testimonial_id) {
    if(confirm('Are you sure you want to change the status?')) {
        $.ajax({
            url: '<?php echo site_url(ADMIN.'/testimonials_with_fil/update_status'); ?>',
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
				$('.DataTable').DataTable().ajax.url('<?php echo site_url(ADMIN.'/testimonials_with_fil/load_data'); ?>').load(); 
            }
        });
    }
}
function filter_modal() {
	$("#filterModal").modal("toggle");	
}
function reset() {
	$('#testimonial_status').val('');
	$('#rating').val('');
}
function rating_change(ratingRange) {
	// console.log("ratings",rating);
}
</script>