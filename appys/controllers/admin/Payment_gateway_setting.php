<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_gateway_setting extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index() {
		$data['page_name'] = 'payment_gateway_setting';
		$data['gateways'] = $this->db->query("select * from payment_gateway where id != ''")->result_array();
		$this->view('payment_gateway_setting',$data);
	}
	public function update() {
		// print_a($_POST,1);
		$this->form_validation->set_rules('agent', 'Agent', 'trim|required|callback_alpha_string|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('r_pay_marchantid', 'Merchant ID', 'trim|required|callback_alpha_dash_space|min_length[10]|max_length[100]');
		$this->form_validation->set_rules('r_pay_password', 'API Key', 'trim|required|callback_alpha_numeric_check|min_length[10]|max_length[100]');
		$this->form_validation->set_rules('is_live', 'Status', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('posted',$_POST);
			$this->session->set_flashdata('error',validation_errors());
			redirect(ADMIN.'/payment_gateway_setting','refresh');
		} else { 
			$insert['agent'] = ucwords($this->input->post('agent'));
			$insert['r_pay_marchantid'] = $this->input->post('r_pay_marchantid');
			$insert['r_pay_password'] = $this->input->post('r_pay_password');
			$insert['is_live'] = $this->input->post('is_live');
			$insert['updated_time'] = date('Y-m-d H:i:s');
			$insert_data = $this->security->xss_clean($insert);
			$this->db->where('id', 1);
			$this->db->update('payment_gateway', $insert_data);
			$this->session->set_flashdata('success','Updated Successfully!');
			redirect(ADMIN.'/payment_gateway_setting','refresh');
		}
	}
}