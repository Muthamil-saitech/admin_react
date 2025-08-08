<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Email_configuration extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index() {
		$data['page_name'] = 'email_configuration';
		$data['config'] = $this->db->query("select * from email_configuration")->row_array();
		$this->view('email_configuration',$data);
	}
	public function update() {
		// print_a($_POST,1);
		$this->form_validation->set_rules('protocol', 'Protocol', 'trim|required|callback_alpha_string|min_length[3]|max_length[4]');
		$this->form_validation->set_rules('mailtype', 'Mail Type', 'trim|required');
		$this->form_validation->set_rules('smtp_host', 'SMTP Host', 'trim|required|callback_host_url_check|min_length[10]|max_length[80]');
		$this->form_validation->set_rules('smtp_port', 'SMTP Port', 'trim|required|callback_valid_phone|min_length[2]|max_length[4]');
		$this->form_validation->set_rules('sender_email', 'Sender Email', 'trim|required|valid_email|min_length[10]|max_length[128]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_alpha_string|min_length[10]|max_length[50]');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('posted',$_POST);
			$this->session->set_flashdata('error',validation_errors());
			redirect(ADMIN.'/email_configuration','refresh');
		} else { 
			$insert['protocol'] = strtolower($this->input->post('protocol'));
			$insert['mailtype'] = $this->input->post('mailtype');
			$insert['smtp_host'] = strtolower($this->input->post('smtp_host'));
			$insert['smtp_port'] = $this->input->post('smtp_port');
			$insert['sender_email'] = strtolower($this->input->post('sender_email'));
			$insert['password'] = strtolower($this->input->post('password'));
			$insert['updated_time'] = date('Y-m-d H:i:s');
			$insert_data = $this->security->xss_clean($insert);
			$this->db->where('email_config_id', 1);
			$this->db->update('email_configuration', $insert_data);
			$this->session->set_flashdata('success','Updated Successfully!');
			redirect(ADMIN.'/email_configuration','refresh');
		}
	}
}