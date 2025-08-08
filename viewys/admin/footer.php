		<!-- content-wrapper ends -->
	</div>
	<!-- main-panel ends -->
	</div>
	<!-- page-body-wrapper ends -->
</div>
<div id="snackbar"></div>
<!-- container-scroller -->
<!-- inject:js -->
<script src="<?php echo assets(); ?>js/off-canvas.js"></script>
<script src="<?php echo assets(); ?>js/hoverable-collapse.js"></script>
<script src="<?php echo assets(); ?>js/template.js"></script>
<!-- endinject -->
<script>
$(document).ready(function() {
    if ($('.summernote').length > 0) {
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    }
});

$('.prevent').on('keydown', function ( event ) {
	if (event.keyCode === 13) {
		return false;
	}
});
function snackbar(message) {
	var x = document.getElementById("snackbar");
	jQuery('#snackbar').html(message);
	x.className = "show";
	setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
}
function cancel_page(page_name) {
	/* var r = confirm('Are you sure want to cancel this page ?'); 
	if(r) */ window.location.href='<?php echo site_url(ADMIN.'/'); ?>'+page_name;
}
let tagArr = document.getElementsByTagName("input");
for (let i = 0; i < tagArr.length; i++) {
	tagArr[i].autocomplete = 'off';
}
$(document).ready(function() {
	$('#toggle_password').click(function() {
		var password = $('#password');
		if (password.attr('type') === 'password') {
			password.attr('type', 'text');
			$(this).html('<i class=" mdi mdi-eye"></i>');
		} else {
			password.attr('type', 'password');
			$(this).html('<i class="mdi mdi-eye-off"></i>');
		}
	});
});
function reload_data_table(selector, url) {
	var table = $(selector).DataTable();
	var currentPage = table.page();
	table.ajax.url(url).load(null, false);

	/* Refresh the DataTable */
	table.draw(false);

	/* Set back to the previous page */
	table.page(currentPage).draw(false);
}
$(document).ready(function() {
    // When any of the collapsible elements is clicked
    $('.nav-link[data-toggle="collapse"]').on('click', function () {
        // Close all other collapsible sections
        $('.collapse').not($(this).attr('href')).collapse('hide');
    });
});

</script>
</body>
</html>