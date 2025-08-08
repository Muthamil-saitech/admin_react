<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index() {
		$data['page_name'] = 'settings';
		if($this->session->userdata('admin_in')) {
			$session_data = $this->session->userdata('admin_in');
			$data['row'] = $this->db->get_where('users',array('user_id'=>$session_data->user_id))->row_array();
		} else {
			$session_data = $this->session->userdata('sales_in');
			$data['row'] = $this->db->query("select staff_id as user_id, staff_name as name, staff_email as email, staff_password as password from staffs where staff_id = ".$session_data->staff_id)->row_array();
		}
		$this->view('settings',$data);
	}	
	public function update() {
		if($this->session->userdata('admin_in')) {
			$session_data = $this->session->userdata('admin_in');
			$user_id = $this->input->post('user_id');
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_string|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[128]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[32]|callback_valid_password');
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('posted',$_POST);
				$this->session->set_flashdata('error',validation_errors());
				redirect(ADMIN . '/settings', 'refresh');
			} else {
				if($user_id!='') {
					$update['name'] = $this->input->post('name'); 
					$update['email'] = $this->input->post('email'); 
					if($this->input->post('password')!='') $update['password'] = encode($this->input->post('password')); 
					$update_data = $this->security->xss_clean($update);
					
					$check = $this->db->query("SELECT user_id FROM users WHERE user_id != ".$user_id." AND email = '".$update['email']."' LIMIT 1")->num_rows();
					if($check > 0) {
						$this->session->set_flashdata('posted',$_POST);
						$this->session->set_flashdata('error','Email Already Exists!');
						
					} else {
						$this->db->where('user_id', $user_id);
						$this->db->update('users', $update_data);
						$this->sess_admin_data('users',$session_data->user_id,'user_id');
						$this->session->set_flashdata('success', 'Details Updated');
					}
				} else {
					$this->session->set_flashdata('posted',$_POST);
					$this->session->set_flashdata('error','Try Again');
				}
				redirect(ADMIN . '/settings', 'refresh');
			}
		} else {
			$session_data = $this->session->userdata('sales_in');
			$user_id = $this->input->post('user_id');
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_string|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[128]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[32]|callback_valid_password');
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('posted',$_POST);
				$this->session->set_flashdata('error',validation_errors());
				redirect(ADMIN . '/settings', 'refresh');
			} else {
				if($user_id!='') {
					$update['staff_name'] = $this->input->post('name'); 
					$update['staff_email'] = $this->input->post('email'); 
					if($this->input->post('password')!='') $update['staff_password'] = encode($this->input->post('password')); 
					$update_data = $this->security->xss_clean($update);
					$check = $this->db->query("SELECT staff_id FROM staffs WHERE staff_id != ".$user_id." AND staff_email = '".$update['staff_email']."' LIMIT 1")->num_rows();
					if($check > 0) {
						$this->session->set_flashdata('posted',$_POST);
						$this->session->set_flashdata('error','Email Already Exists!');
					} else {
						$this->db->where('staff_id', $user_id);
						$this->db->update('staffs', $update_data);
						$this->sess_staff_data('staffs',$session_data->staff_id,'staff_id');
						$this->session->set_flashdata('success', 'Details Updated');
					}
				} else {
					$this->session->set_flashdata('posted',$_POST);
					$this->session->set_flashdata('error','Try Again');
				}
				redirect(ADMIN . '/settings', 'refresh');
			}
		}
	}
	public function sess_admin_data($tablename,$id=false,$columnname=false) {  
		$this->db->select('*');
		$this->db->from($tablename);
		$this->db->where($columnname, $id);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0) { 
			$sess_row = $query->row();
			$this->session->set_userdata('admin_in', $sess_row);
			return true;
		}
	}
	public function sess_staff_data($tablename,$id=false,$columnname=false) {  
		$this->db->select('*');
		$this->db->from($tablename);
		$this->db->where($columnname, $id);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0) { 
			$sess_row = $query->row();
			$this->session->set_userdata('sales_in', $sess_row);
			return true;
		}
	}
}