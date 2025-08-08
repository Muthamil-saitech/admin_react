<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Not_found extends Web_Controller {
	public function index() {
		$data['page'] = 'page_not_found';
		$this->load->view(ADMIN.'/not_found',$data);
	}
}