<?php defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'welcome';
$route['404_override'] = 'not_found/index';
$route['admin_404_override'] = ADMIN.'/not_found/index';
$route['translate_uri_dashes'] = FALSE;
$route['admin'] = ADMIN.'/login';
