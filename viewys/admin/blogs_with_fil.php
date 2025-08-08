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
						<h4 class="card-title col-sm-4 col-form-label">Blogs with filter</h4>
						<div class="col-sm-6">
							<div class="input-group">
								<div class="input-group-prepend mr-2">
									<button class="btn btn-outline-grey text-grey" type="button" id="fromDateButton"><?php echo date('d F Y'); ?></button>
									<input type="text" id="fromDateInput" class="form-control datepicker" style="display: none;" />
									<button class="btn btn-outline-grey text-grey" type="button" id="dateButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Date</button>
									<div class="dropdown-menu" aria-labelledby="dateButton">
										<a class="dropdown-item text-grey mb-2" style="cursor:pointer;" data-value="today">Today</a>
										<a class="dropdown-item text-grey mb-2" style="cursor:pointer;" data-value="yesterday">Yesterday</a>
										<a class="dropdown-item text-grey mb-2" style="cursor:pointer;" data-value="last7days">Last 7 Days</a>
										<a class="dropdown-item text-grey mb-2" style="cursor:pointer;" data-value="last30days">Last 30 Days</a>
										<a class="dropdown-item text-grey mb-2" style="cursor:pointer;" data-value="thismonth">This Month</a>
										<a class="dropdown-item text-grey mb-2" style="cursor:pointer;" data-value="lastmonth">Last Month</a>
										<a class="dropdown-item text-grey mb-2" style="cursor:pointer;" data-value="thisyear">This Year</a>
										<a class="dropdown-item text-grey mb-2" style="cursor:pointer;" data-value="lastyear">Last Year</a>
									</div>
									<button class="btn btn-outline-grey text-grey" type="button" id="toDateButton"><?php echo date('d F Y'); ?></button>
									<input type="text" id="toDateInput" class="form-control datepicker" style="display: none;" />
								</div>
								<button type="button" class="btn btn-sm btn-outline-grey" onclick="reset();" title="Reset"><i class="mdi mdi-refresh"></i></button>
							</div>
						</div>
						<div class="col-sm-2">
							<a href="<?php echo site_url(ADMIN.'/blogs_with_fil/add_blog'); ?>" class="btn btn-sm btn-light text-grey float-right"><i class="mdi mdi-plus-circle-outline"></i> Add Blog</a>
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
let table = $('.DataTable').DataTable({
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
		url :"<?php echo site_url(ADMIN.'/blogs_with_fil/load_data'); ?>",
		type: "POST",
		"data":function(data) {
			data.from_date = $('#fromDateButton').text() || '';
			data.to_date = $('#toDateButton').text() || '';
			data.date_range = $('#dateButton').text() || '';
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
$(function() {
	$(document).on('click', function (e) {
		if (!$(e.target).closest('#fromDateInput, #toDateInput, #fromDateButton').length) {
			$('#fromDateInput').data("DateTimePicker").hide();
			$('#toDateInput').data("DateTimePicker").hide();
		}
	});
	/* from date */
	$('#fromDateInput').datetimepicker({
		format: 'DD-MM-YYYY',
		icons: {
			next: 'mdi mdi-arrow-right',
			previous: 'mdi mdi-arrow-left'
		}, 
		maxDate: new Date()
	});
	$('#fromDateButton').on('click', function (e) {
		$('#fromDateInput').datetimepicker('show');
		e.stopPropagation();
	});
	$('#fromDateInput').on('dp.change', function (e) {
		const selectedFromDate = e.date.format('DD MMMM YYYY');
		$('#fromDateButton').text(selectedFromDate);
		$('#toDateButton').text(selectedFromDate);
		const fromDate = e.date.format('DD-MM-YYYY');
		$('#toDateInput').data("DateTimePicker").minDate(fromDate);
		$('#dateButton').text('Date');
		$('#fromDateInput').data("DateTimePicker").hide();
		table.ajax.reload();
	});
	/* to date */
	$('#toDateInput').datetimepicker({
		format: 'DD-MM-YYYY',
		icons: {
			next: 'mdi mdi-arrow-right',
			previous: 'mdi mdi-arrow-left'
		}, 
		maxDate: new Date(new Date().setFullYear(new Date().getFullYear() + 1))
	});
	$('#toDateButton').on('click', function (e) {
		$('#toDateInput').datetimepicker('show');
		e.stopPropagation();
	});
	$('#toDateInput').on('dp.change', function (e) {
		const selectedToDate = e.date.format('DD MMMM YYYY');
		$('#toDateButton').text(selectedToDate);
		$('#toDateInput').data("DateTimePicker").hide();
		$('#dateButton').text('Date');
		table.ajax.reload();
	});
	/* Date Range Dropdown */
	$('.dropdown-item').on('click', function() {
		const selectedOption = $(this).text();
		$('#dateButton').text(selectedOption);
		const selectedValue = $(this).data('value');
		// console.log('selectedValue', selectedValue);
		if(selectedValue=='today') {
			$('#fromDateButton').text('<?php echo date('d F Y'); ?>');
			$('#toDateButton').text('<?php echo date('d F Y'); ?>');
		} else if(selectedValue=='yesterday') {
			$('#fromDateButton').text('<?php echo date('d F Y', strtotime('yesterday')); ?>');
			$('#toDateButton').text('<?php echo date('d F Y', strtotime('yesterday')); ?>');
		} else if(selectedValue=='last7days') {
			$('#fromDateButton').text('<?php echo date('d F Y', strtotime('-7 days')); ?>');
			$('#toDateButton').text('<?php echo date('d F Y'); ?>');
		} else if(selectedValue=='last30days') {
			$('#fromDateButton').text('<?php echo date('d F Y', strtotime('-30 days')); ?>');
			$('#toDateButton').text('<?php echo date('d F Y'); ?>');
		} else if(selectedValue=='thismonth') {
			$('#fromDateButton').text('<?php echo date('d F Y', strtotime('first day of this month')); ?>');
			$('#toDateButton').text('<?php echo date('d F Y', strtotime('last day of this month')); ?>');
		} else if(selectedValue=='lastmonth') {
			$('#fromDateButton').text('<?php echo date('d F Y', strtotime('first day of last month')); ?>');
			$('#toDateButton').text('<?php echo date('d F Y', strtotime('last day of last month')); ?>');
		} else if(selectedValue=='thisyear') {
			$('#fromDateButton').text('<?php echo date('01 F Y'); ?>');
			$('#toDateButton').text('<?php echo date('d F Y', strtotime('last day of December ' . date('Y'))); ?>');
		} else if(selectedValue=='lastyear') {
			$('#fromDateButton').text('<?php echo date('d F Y', strtotime('first day of January last year')); ?>');
			$('#toDateButton').text('<?php echo date('d F Y', strtotime('last day of December last year')); ?>');
		} else {
			$('#fromDateButton').text('<?php echo date('d F Y'); ?>');
			$('#toDateButton').text('<?php echo date('d F Y'); ?>');
		}
		table.ajax.reload();
	});
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
			url :"<?php echo site_url(ADMIN.'/blogs_with_fil/load_data'); ?>",
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
		window.location.href="<?php echo site_url(ADMIN.'/blogs_with_fil/delete_data/') ?>"+blog_id;
	}
}
function update_status(blog_status, blog_id) {
    if(confirm('Are you sure you want to change the status?')) {
        $.ajax({
            url: '<?php echo site_url(ADMIN . '/blogs_with_fil/update_status'); ?>',
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
				$('.DataTable').DataTable().ajax.url('<?php echo site_url(ADMIN . '/blogs_with_fil/load_data'); ?>').load(); 
            }
        });
    }
}
function update_latest_status(is_latest, blog_id) {
	if(confirm('Are you sure want to change the status in is latest?')) {
		$.ajax({
			url: '<?php echo site_url(ADMIN.'/blogs_with_fil/update_latest_status'); ?>',
			type: "post",
			data: { is_latest: is_latest, blog_id:blog_id },
			success: function(response) {
				$('#is_latest_'+blog_id).val(response);
				if(response == 'N') { $('#latest_msg_'+blog_id).html('<span class="text-success">Added</span>')}
				if(response == 'Y') {  $('#latest_msg_'+blog_id).html('<span class="text-danger">Removed</span>')}
			}
		});
	} else {
		$('.DataTable').DataTable().ajax.url('<?php echo site_url(ADMIN.'/blogs_with_fil/load_data'); ?>').load();
	}
}
function reset() {
	$('#fromDateButton').text('<?php echo date('d F Y'); ?>');
	$('#toDateButton').text('<?php echo date('d F Y'); ?>');
	$('#dateButton').text('Date');
	table.ajax.reload();
}
</script>