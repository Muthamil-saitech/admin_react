<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends Admin_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		// print_a(encode('Admin@123'),1);
		if($this->session->userdata('admin_in')) 
			redirect(ADMIN.'/blogs','refresh');
		else	
			$this->load->view(ADMIN.'/login');
	}
	private function generateCookie($data, $expire) {
        setcookie('DefAdmin', $data, $expire, '/', $_SERVER['HTTP_HOST']);
    }
	public function authentication() {
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[128]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[32]');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('posted', $_POST);
			$this->session->set_flashdata('error', validation_errors());
			redirect(ADMIN.'/login', 'refresh');
		} else {
			$email = $this->input->post('email', TRUE);
			$password = encode($this->input->post('password', TRUE));
			// print_a($password,1);
			// print_a();
			$login_check = $this->db->get_where('users', array('email' => $email, 'password' => $password, 'user_type' => 1))->row();
			if ($login_check) {
				if (isset($login_check->is_deleted) && $login_check->is_deleted == 'Y') {
					$this->session->set_flashdata('posted', $_POST);
					$this->session->set_flashdata('error', 'Account has been Deleted by Admin');
					redirect(ADMIN, 'refresh');
				} else {
					$remember = $this->input->post('remember');
					if ($remember == 1) {
						$loginCred = json_encode(array('email' => $email, 'password' => decode($password)));
						$loginCred = base64_encode(encode($loginCred));
						$this->generateCookie($loginCred, strtotime('+6 months'));
					}
					$this->session->set_userdata('admin_in', $login_check);
					redirect(ADMIN.'/dashboard', 'refresh');
				}
			} else {
				$this->session->set_flashdata('posted', $_POST);
				$this->session->set_flashdata('error', 'Incorrect Login Credentials');
				redirect(ADMIN, 'refresh');
			}
		}
	}
	public function logout() {
		$session_data = $this->session->userdata('admin_in');
		$this->session->unset_userdata('admin_in', $session_data);
		redirect(ADMIN,'refresh'); 
	}
}