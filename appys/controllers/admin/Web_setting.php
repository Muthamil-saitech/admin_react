<?php defined('BASEPATH') OR EXIT('No direct access allowed');
class Web_setting extends Admin_controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['page_name'] = 'web_setting';
		$data['row'] = $this->db->query('select * from web_settings WHERE id = 1')->row_array();
		$this->view('web_settings',$data);
	}
	public function update(){
		// print_a($_POST,1);
		// print_a($_FILES,1);
		$id = $this->input->post('id');
		/* Contact Us */
		$this->form_validation->set_rules('contact_person','Contact Person','trim|required|callback_alpha_string_dot|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('email','Contact Email','trim|required|valid_email|max_length[128]');
		$this->form_validation->set_rules('sales_email','Sales Email','trim|valid_email|max_length[128]');
		$this->form_validation->set_rules('mobile_no','Mobile Number','trim|required|callback_valid_phone|min_length[10]');
		$this->form_validation->set_rules('hotline_no','Hotline Number','trim|required|callback_valid_phone|min_length[10]');
		$this->form_validation->set_rules('address','Address','trim|required|callback_no_script_tags|callback_valid_address|min_length[5]|max_length[250]');
		/* Form Validation Ends */
		if($this->form_validation->run()==FALSE) {
			$this->session->set_flashdata('error',validation_errors());
			$this->session->set_flashdata('posted',$_POST);
		} else {
			$insert['contact_person'] = ucfirst($this->input->post('contact_person'));
			$insert['email'] = strtolower($this->input->post('email'));
			$insert['mobile_no'] = $this->input->post('mobile_no');
			$insert['hotline_no'] = $this->input->post('hotline_no');
			$insert['address'] = $this->input->post('address');
			$insert_data = $this->security->xss_clean($insert);
			$this->db->where('id', 1);
            $this->db->update('web_settings', $insert_data);
            $check = $this->db->query('select * from web_settings WHERE id = 1')->row_array();
            if (empty($check)) {
                $insert_data['id'] = 1;
                $insert_data['created_time'] = date('Y-m-d H:i:s');
                $this->db->insert('web_settings', $insert_data);
                $this->session->set_flashdata('success', 'Created Successfully');
            } else {
                $this->session->set_flashdata('success', 'Updated Successfully');
            }
        }
		redirect(ADMIN.'/web_setting','refresh');
	}
}