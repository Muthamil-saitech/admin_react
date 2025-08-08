<?php include('mail_header.php'); ?>
<table style="margin: 25px auto 20px; padding:25px;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#fff">
	<tr><td style="text-align:left;">Hi <?php echo @$name; ?>,</td></tr>
	<tr><td style="text-align:justify;">
	<p><b><?php echo @$message; ?></b></p>
	</td></tr>
</table>
<?php include('mail_footer.php'); ?>