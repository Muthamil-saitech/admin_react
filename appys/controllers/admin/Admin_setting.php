<?php defined('BASEPATH') OR EXIT('No direct access allowed');
class Admin_setting extends Admin_controller{
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		$data['page_name'] = 'admin_setting';
		$data['row'] = $this->db->query('select * from admin_setting WHERE adm_set_id = 1')->row_array();
		$this->view('admin_setting',$data);
	}
	public function update() {
		// print_a($_POST,1);
		// print_a($_FILES,1);
		$old_adm_logo = $this->input->post('old_adm_logo');
		$old_adm_fav_logo = $this->input->post('old_adm_fav_logo');
		if(!empty($_FILES['admin_logo']['name'])) {
			$folderPath1 = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/admin-setting/";
			if(!is_dir($folderPath1)) mkdir($folderPath1, 0777, TRUE);
			$config1['upload_path']          = $folderPath1;
			$config1['allowed_types']        = 'jpg|png|jpeg|JPEG|JPG|PNG';
			$config1['max_size']             = "1024";
			$config1['max_width']            = "241";
			$config1['max_height']           = "235";
			$config1['encrypt_name'] 		= TRUE;
			$this->load->library('upload', $config1);
			if(!$this->upload->do_upload('admin_logo')) {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(ADMIN.'/admin_setting','refresh');
			} else {
				$logo_image = $this->upload->data();
				$logo_image_name = $logo_image['file_name'];
				$insert['admin_logo'] = $logo_image_name;
				if($logo_image_name!='') @unlink('uploads/admin-setting/'.$old_adm_logo);
			}
		}
		if(!empty($_FILES['admin_fav_icon']['name'])) {
			$folderPath2 = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/admin-setting/";
			if(!is_dir($folderPath2)) mkdir($folderPath2, 0777, TRUE);
			$config2['upload_path']          = $folderPath2;
			$config2['allowed_types']        = 'jpg|png|jpeg|JPEG|JPG|PNG';
			$config2['max_size']             = "1024";
			$config2['max_width']            = "38";
			$config2['max_height']           = "38";
			$config2['encrypt_name'] 		= TRUE;
			$this->load->library('upload', $config2);
			if(!$this->upload->do_upload('admin_fav_icon')) {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(ADMIN.'/admin_setting','refresh');
			} else {
				$fav_image = $this->upload->data();
				$fav_image_name = $fav_image['file_name'];
				$insert['admin_fav_icon'] = $fav_image_name;
				if($fav_image_name!='') @unlink('uploads/admin-setting/'.$old_adm_fav_logo);
			}
		}
		$check = $this->db->query('select * from admin_setting WHERE adm_set_id = 1')->row_array();
		if (empty($check)) {
			$insert['created_time'] = date('Y-m-d H:i:s');
			$this->db->insert('admin_setting', $insert);
			$this->session->set_flashdata('success', 'Created Successfully');
		} else {
			$insert['updated_time'] = date('Y-m-d H:i:s');
			$this->db->where('adm_set_id', 1);
			$this->db->update('admin_setting', $insert);
			$this->session->set_flashdata('success', 'Updated Successfully');
		}
		redirect(ADMIN.'/admin_setting','refresh');
	}
}