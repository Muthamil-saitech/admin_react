<!--Parsley-->
<link rel="stylesheet" href="<?php echo assets(); ?>css/parsley.css">
<script src="<?php echo assets(); ?>js/parsley.js" type="text/javascript"></script>
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success();  $posted = $this->session->flashdata('posted'); ?>	</div></div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Album - <?php if(isset($row['album_title'])) echo $row['album_title']; ?></h4>
					<div class="row justify-content-center">
						<div class="col-md-4">
							<?php echo form_open_multipart(ADMIN.'/album/update_album', array('class' => 'forms-sample')); ?>
								<div class="form-group d-flex justify-content-center">
									<span class="btn btn-secondary">
										<input class="form-control" type="hidden" name="album_id" value="<?php if(isset($row['album_id'])) echo $row['album_id']; ?>" readonly />
										<input type="file" name="album_image[]" multiple="multiple" accept=".jpg,.png,.jpeg" required />
									</span>
									
								</div>
								<div class="card bg-light w-100 border-0">
									<div class="card-body text-center">
										<b class="badge badge-dark text-white mb-2">Notes:</b>
										<p class="text-danger mt-1 font-weight-bold">You can add multi image by clicking<br>ctrl + image file.</p>
										<p class="text-info mt-1 font-weight-bold">Recommended Size : 788 X 500 px</p>
										<p class="text-info mt-2">Note: Allowed types = jpeg, jpg, png<br>Max File Size = 1 MB</p>
									</div>
								</div>
								<div class="form-group d-flex justify-content-center mt-2">
									<button type="submit" class="btn btn-primary">Upload</button>&nbsp;&nbsp;
									<a href="javascript:;" onclick="cancel_page('album');" class="btn btn-light">Cancel</a>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					<?php if(isset($album)) { ?>
						<div class="form-group row">
							<?php foreach($album as $photo) { ?>
							<div class="col-sm-2 mb-5">
								<img src="<?php echo base_url('uploads/album/' . $photo['album_id'] . '/' . $photo['image']); ?>" width="100%"/> 
								<a onclick="album_image_delete(<?php echo $photo['album_img_id']; ?>);" href="javascript:;" class="d-flex justify-content-center"><i class="mdi mdi-trash-can text-danger display-4"></i></a>
							</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function album_image_delete(gal_img_id){
	if(confirm('Are you sure want to delete this record ?')) {
		window.location.href="<?php echo site_url(ADMIN.'/album/album_image_delete/') ?>"+gal_img_id;
	}
}
</script>