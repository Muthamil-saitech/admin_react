<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta charset="utf-8"><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php if (isset($title)) echo $title; ?></title>
	</head>
	<body style="font-size: 16px;margin: 0;">
		<center style="width: 100%;">
			<h3>Happy Holidays</h3>	
			<table style="text-align: right;font-family: Vrinda;font-style: italic;margin-bottom: 50px;width: 100%;" bgcolor="#fff">
				<?php if(isset($day_details)) { ?>
				<tr><td style="text-align:left;margin-bottom: 5px;font-weight: bold"><?php if(isset($pack_name)) echo $pack_name; else echo $title; ?></td></tr><br>
				<?php foreach($day_details as $detail) { ?>
				<tr><td style="text-align:left;margin-bottom: 20px;"><?php echo $detail['day_title']; ?></td></tr>
				<tr><td style="text-align:left;padding-left: 25px;"><?php echo $detail['day_description']; ?></td></tr>
				<?php } } else { ?>
				<tr><td style="text-align:left;">No Days Available</td></tr>
				<?php } ?>
			</table>
		</center>
	</body>
</html>
