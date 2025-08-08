<?php 
function get_add_days($date,$days) {
	$newdate = strtotime ( $days.' day' , strtotime ( $date ) ) ;
	return date('Y-m-d',$newdate);
}
function assets() { return base_url().'assets/backend_assets/'; }
function frontend_assets() { return base_url().'assets/frontend_assets/'; }
function encode ($string) {
	$secret_key = ENC_KEY;
    $secret_iv = ENC_IV;
    $output = false;
    $encrypt_method = "AES-256-CBC";
	$key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	return base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
}
function decode ($string) {
	$secret_key = ENC_KEY;
    $secret_iv = ENC_IV;
    $output = false;
    $encrypt_method = "AES-256-CBC"; 
	$key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	return openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
}
function print_a($data, $exit = false) { echo '<pre>'; print_r($data); echo '</pre>'; if ($exit) exit; }
function date_hiA($date) { if($date!='') { if($date!='00:00:00') return date ('h:i A', strtotime($date)); else return false; } else return false; }
function date_dmy($date) { if($date!='') { if($date!='0000-00-00') return date ('d-m-Y', strtotime($date)); else return false; } else return false; }
function date_ymd($date) { if($date!='') { if($date!='0000-00-00') return date ('Y-m-d', strtotime($date)); else return false; } else return false; }
function ymdhis($date) { if($date!='') { if($date!='0000-00-00 00:00:00') return date('Y-m-d H:i:s',strtotime($date)); else return false; } else return false; }
function dmyhi($date) { if($date!='') { if($date!='0000-00-00 00:00:00') return date('d-m-Y H:i',strtotime($date)); else return false; } else return false; }
function dmyhiA($date) { if($date!='') { if($date!='0000-00-00 00:00:00') return date('d-m-Y h:i A',strtotime($date)); else return false; } else return false; }
function date_dfy($date) { if($date!='') { if($date!='0000-00-00 00:00:00' && $date!='0000-00-00') return date('d F Y',strtotime($date)); else return false; } else return false; }
function day($date) { if($date!='') { if($date!='0000-00-00') return date("l",strtotime($date)); else return false; } else return false; }
function flash_success() {
	$ci =& get_instance();
	echo '<div class="alert alert-success alert-dismissible fade show custom-pointer" role="alert">'.$ci->session->flashdata('success').'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="cursor:pointer"></button></div>';
}
function flash_error() {
	$ci =& get_instance();
	echo '<div class="alert alert-danger alert-dismissible fade show custom-pointer" role="alert">'.$ci->session->flashdata('error').'  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="cursor:pointer"></button></div>';
}
function admin_flash_success() {
	$ci = get_instance(); 
	echo '<div class="alert bg-success alert-dismissible text-white">'.$ci->session->flashdata('success').'<span class="close" data-dismiss="alert" style="cursor:pointer">×</span></div>';
}
function admin_flash_error() {
	$ci = get_instance(); 
	echo '<div class="alert bg-danger alert-dismissible text-white">'.$ci->session->flashdata('error').'<span class="close" data-dismiss="alert" style="cursor:pointer">×</span></div>';
}
function word_wrap($text,$length) {
	$MessageW = wordwrap($text, $length, "\n", true);
	$MessageW = htmlentities($MessageW);
	return nl2br($MessageW); 
}
function amount($amount){
    $formatted_amount = number_format($amount, 2, '.', ',');
    $paise = explode('.', $formatted_amount)[1];
    // Show the decimal part if it's greater than 0.00
    if ($paise > 0) {
        $con_amount = "₹ " . rtrim($formatted_amount, "0");
    } else {
        $con_amount = "₹ " . explode('.', $formatted_amount)[0];
    }
    return $con_amount;
}
function create_slug($string) { 
	if($string != '') {
		$cleanString = preg_replace("/[^a-zA-Z0-9 ]/", "", $string);
		return str_replace(" ", "-", strtolower(trim($cleanString)));
	} else {
		return false;
	}					
}
function show_package_title($title,$str_length) {
    $remove_tags = strip_tags($title);
	if(strlen($remove_tags) > $str_length) {
		$formatted_title =  substr($remove_tags, 0, $str_length).'...'; 
	} else {
		$formatted_title = $remove_tags; 
	}
    return $formatted_title;
}
function set_link($string) { 
    if($string != '') {
        $check = stripos($string,'https://');
        if($check !== false) {
            $link = $string;
        } else {
            $link = 'https://'.$string.'.com';
        }
    } else {
        $link = '';
    }    
    return $link;
}
function datepicker2() { return "$('.datepicker2').datepicker({
	autoclose: true,
	minView: 2,
	orientation: 'bottom auto',
	format: 'dd-mm-yyyy',
	todayHighlight: true,
});"; }
function format_time_12hr($time) {
     return ltrim(date("H:i", strtotime($time)), '0');
}
function show_title($title,$str_length) { 
	$remove_tags = strip_tags($title); 
	if(strlen($remove_tags) > $str_length) {
		$formatted_title =  substr($remove_tags, 0, $str_length).'...';
	} else {
		$formatted_title = $remove_tags; 
	}
	return $formatted_title;
}