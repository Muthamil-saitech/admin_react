<?php
class Common_Controller extends CI_Controller {
	public function __construct() {
        parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->helper(array('url', 'file', 'form','formatting','security'));
		$this->load->library(array('form_validation'));
		$this->load->model(array('Common_model'));
	}
	public function num_check($fullname) {
		if(preg_match("/^([\.\s-0-9])+$/i", $fullname)) return true; else return false;
	}
	public function numeric_dash_space($fullname) {
		if (! preg_match("/^([\.\s-0-9_-])+$/i", $fullname)) {
			$this->form_validation->set_message('numeric_dash_space', 'The %s field Should Contain Numbers and . White spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function alpha_and_hypen($fullname) {
		if (!preg_match('/^[a-zA-Z\-]+$/', $fullname)) {
			$this->form_validation->set_message('alpha_and_hypen', 'The %s field should only contain alphabets and hyphens.');
			return FALSE;
		}
		if (!preg_match('/[a-zA-z]/', $fullname)) {
			$this->form_validation->set_message('alpha_and_hypen', 'The %s field must contain at least one letter.');
			return FALSE;
		}
		return TRUE;
	}
	public function valid_phone($phone) {
        if (!empty($phone)) {  
            if (!preg_match("/^(?!0)(\+?\d+)(?:\s?\d+)?$/", $phone)) {
                $this->form_validation->set_message('valid_phone', 'The %s field should not start with zero and must contain only numbers');
                return FALSE;
            }
        }
        return TRUE;  
    }
	public function valid_password($password = '') {
		$password = trim($password);
		/* $regex_lowercase = '/[a-z]/'; */
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';
		if (empty($password)) {
			$this->form_validation->set_message('valid_password', 'The {field} field is required.');
			return FALSE;
		}
		/* if (preg_match_all($regex_lowercase, $password) < 1) {
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
			return FALSE;
		} */
		/* if (preg_match_all($regex_number, $password) < 1) {
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
			return FALSE;
		} */
		if (preg_match_all($regex_uppercase, $password) < 1) {
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
			return FALSE;
		}
		if (preg_match_all($regex_special, $password) < 1) {
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));
			return FALSE;
		}
		if (strlen($password) < 5) {
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
			return FALSE;
		}
		if (strlen($password) > 32) {
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
			return FALSE;
		}
		return TRUE;
	}
	public function alpha_numeric_check($fullname) {
		if(! preg_match('/^[a-zA-Z0-9 ]*$/', $fullname)) {			
			$this->form_validation->set_message('alpha_dash_space', 'The %s field should contain alphabetical characters, numbers & white spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function host_url_check($fullname) {
		if(! preg_match('/^ssl:\/\/smtp\.gmail\.com$/', $fullname)) {			
			$this->form_validation->set_message('host_url_check', 'The %s field should be valid format');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function valid_address($str) {
		if (!preg_match('/^[a-zA-Z0-9,.\/ -]+$/', $str)) {
			$this->form_validation->set_message('valid_address', 'The {field} field can only contain alphanumeric characters, commas, full stops, slashes, and spaces.');
			return FALSE;
		}
		if (preg_match('/^[,\.\/ -]+$/', $str)) {
			$this->form_validation->set_message('valid_address', 'The {field} field must contain at least one alphanumeric character.');
			return FALSE;
		}
		
		return TRUE;
	}
	public function alpha_dash_space($fullname) {
		if(! preg_match('/^[a-zA-Z0-9,-_.@# ]*$/', $fullname)) {			
			$this->form_validation->set_message('alpha_dash_space', 'The %s field should contain alphabetical characters, numbers & white spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function alpha_check($fullname) {
		if(preg_match('/^[a-zA-Z,-_.@# ]+$/', $fullname)) return true; else return false;
	}
	public function alpha_dash_check($fullname) {
		if(preg_match('/^[a-zA-Z,-_.@# ]*$/', $fullname)) return true; else return false;
	}
	public function alpha_string($str) {
		if (!preg_match('/^[a-zA-Z ]*$/', $str)) {
			$this->form_validation->set_message('alpha_string', 'The {field} field should contain only alphabets and spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	/* for contact person name */
	public function alpha_string_dot($str) {
		if (!preg_match('/^[a-zA-Z .]*$/', $str)) {
			$this->form_validation->set_message('alpha_string_dot', 'The {field} field should contain only alphabets, white spaces & dot ');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function alpha_string_comma_dot($str) {
		if (!preg_match('/^[a-zA-Z .,]*$/', $str)) {
			$this->form_validation->set_message('alpha_string_comma_dot', 'The {field} field should contain only alphabets, white spaces & special characters(.,) ');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function alpha_dash_space_display_title($fullname){
		// if (!preg_match('/^[\sa-zA-Z0-9,\-_.@#:!\'()’& ]*$/', $fullname)) {	
		if (!preg_match('/^(?=.*[a-zA-Z0-9])[\sa-zA-Z0-9,\-_.@#:!\'()’& ]*$/', $fullname)) {		
			$this->form_validation->set_message('alpha_dash_space_display_title', 'The %s field should contain alphabets, numbers, special characters (,-_.@:!\'()’& ) & white spaces');
			return FALSE;
		} else {
			return TRUE;
		} 
	}
	/* For Title */
	public function alpha_dash_space_title($fullname){
		if (empty($fullname)) {
			return TRUE;
		}
		// if (!preg_match('/^[\sa-zA-Z,\-_.:!\'()’& ]+$/', $fullname)) {
		if (!preg_match('/^(?=.*[a-zA-Z])[\sa-zA-Z,\-_.:!\'()’& ]*$/', $fullname)) {			
			$this->form_validation->set_message('alpha_dash_space_title', 'The %s field should contain alphabets, special characters (,-_.:!\'()’& ) & white spaces');
			return FALSE;
		} else {
			return TRUE;
		} 
		return TRUE;
	}
	public function alpha_dash_space_short_title($fullname) {
		if (!preg_match('/^[a-zA-Z,-_.@#\' ]*$/', $fullname)) {
			$this->form_validation->set_message('alpha_dash_space_short_title', 'The %s field should contain alphabets, special characters (,-_.@:!\'()’& ) & white spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	/* for alphabets, spaces and &-, */
	public function alpha_dash_space_banner_title($fullname) {
		if (!preg_match('/^[a-zA-Z ,\-_&]*$/', $fullname)) {
			$this->form_validation->set_message('alpha_dash_space_banner_title', 'The %s field should contain alphabets, special characters (,-_& ) & white spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	/* for answers */
	public function alpha_dash_space_answers($fullname) {
		if (!preg_match('/^[a-zA-Z ,\-_.&]*$/', $fullname)) {
			$this->form_validation->set_message('alpha_dash_space_answers', 'The %s field should contain alphabets, special characters (,-_.& ) & white spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	/* For faq qn */
	public function alpha_dash_space_faq($str) {
		if (!preg_match('/^[a-zA-Z ,\-_&\?]*$/', $str)) {
			$this->form_validation->set_message('alpha_dash_space_faq', 'The %s field should contain alphabets, special characters (,-_.&? ) & white spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function no_script_tags($str) {
		if (preg_match('/<script.*?>.*?<\/script>/is', $str)) {
			$this->form_validation->set_message('no_script_tags', 'The {field} field cannot contain script tags.');
			return FALSE;
		} else {
			return TRUE;		
		}
	}
	/* for html tags */
	public function alpha_dash_space_for_title($fullname) {
		$sanitized_input = strip_tags($fullname);
		if (! preg_match('/^[\sa-zA-Z0-9,-_.@#:! ]*$/', $sanitized_input)) {
			$this->form_validation->set_message('alpha_dash_space_for_title', 'The %s field should contain alphabets, numbers, special characters (,-_.@:!) & white spaces.');
			return FALSE;
		}
		if ($fullname !== $sanitized_input) {
			$this->form_validation->set_message('alpha_dash_space_for_title', 'The %s field should contain alphabets, numbers, special characters (,-_.@:!) & white spaces.');
			return FALSE;
		}
		return TRUE;
	}
	/* for service inc & not inc */
	public function alpha_dash_space_for_service($fullname) {
		$sanitized_input = strip_tags($fullname);
		if (! preg_match('/^[\sa-zA-Z, ]*$/', $sanitized_input)) {
			$this->form_validation->set_message('alpha_dash_space_for_service', 'The %s field should contain alphabets, special characters (,) & white spaces.');
			return FALSE;
		}
		if ($fullname !== $sanitized_input) {
			$this->form_validation->set_message('alpha_dash_space_for_service', 'The %s field should contain alphabets, special characters (,) & white spaces.');
			return FALSE;
		}
		return TRUE;
	}
	public function validate_url_format($string) {
		if (empty($string)) {
			return TRUE;
		}
		if (! filter_var($string, FILTER_VALIDATE_URL)) {
			$this->form_validation->set_message('validate_url_format', 'The %s field should contain valid url format(ex:- http://example.com ) ');
			return FALSE;
		}		
		if (!preg_match('/^(http:\/\/|https:\/\/)/', $string)) {
			$this->form_validation->set_message('validate_url_format', 'The %s field should contain valid url format(ex:- http://example.com )');
			return FALSE;
		}
		return TRUE;
	}
	public function validate_time($str) {
		list($hh, $mm) = explode(':', $str);
		
		if (!is_numeric($hh) || !is_numeric($mm)) {
			$this->form_validation->set_message('validate_time', 'Not numeric');
			return FALSE;
		} else if ((int) $hh > 24 || (int) $mm > 59) {
			$this->form_validation->set_message('validate_time', 'Invalid time');
			return FALSE;
		} else if (mktime((int) $hh, (int) $mm) === FALSE) {
			$this->form_validation->set_message('validate_time', 'Invalid time');
			return FALSE;
		}

		return TRUE;
	}
	/* for Meta desc */
	public function alpha_dash_space_desc($fullname) {
		if (!preg_match('/^[a-zA-Z0-9 ,\-_.&]*$/', $fullname)) {
			$this->form_validation->set_message('alpha_dash_space_answers', 'The %s field should contain alphabets, numbers, special characters (,-_.& ) & white spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function email($email, $subject, $message, $attched_file = false ,$cc=false) {
		$this->load->library('email');
		//if($_SERVER['HTTP_HOST']=='localhost')
		{
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.gmail.com';
			$config['smtp_port'] =  '465';
			$config['smtp_user'] = SMTP_USER; 
			$config['smtp_pass'] = SMTP_PASS; 
			$config['mailtype']  = 'html';
			$config['charset']   = 'utf-8';
			$config['wordwrap']  = TRUE;
			$this->email->initialize($config);
		}
		if($attched_file!=false) $this->email->attach($attched_file);
		$this->email->set_mailtype("html"); 
		$this->email->set_newline("\r\n");
		$this->email->from(SMTP_USER,WEBSITE_NAME);
		$this->email->to($email);
		if($cc!=false && $cc!='') $this->email->cc($cc);
		$this->email->subject($subject);
		$this->email->message($message);
		if($this->email->send()) { return true; } else { return $this->email->print_debugger(); }
	}
}
class Web_Controller extends Common_Controller {   
    public function view($view, $vars = array()) {
        $vars['web_settings'] = $this->db->query("SELECT * FROM web_settings WHERE id = 1")->row_array(); 
        $this->load->view('header',$vars);
        $this->load->view($view,$vars);
        $this->load->view('footer',$vars);
    } 
}
class Admin_Controller extends Common_Controller { 
    public function view($view, $vars = array()) {
		if($this->session->userdata('admin_in')) { 
			$sessionData = $this->session->userdata('admin_in');
			$vars['session_data'] = $sessionData;
			$vars['admin_setting'] = $this->db->query('select * from admin_setting where adm_set_id = 1')->row_array();
			$this->load->view(ADMIN.'/top',$vars);
			$this->load->view(ADMIN.'/topbar',$vars);
			$this->load->view(ADMIN.'/sidebar',$vars);
			$this->load->view(ADMIN.'/'.$view, $vars);
			$this->load->view(ADMIN.'/footer',$vars);
		} else {
			redirect(ADMIN,'refresh');
		}
	}
}