<?php defined('BASEPATH') OR exit('No direct script access allowed');
class About_us extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index(){
		$data['page_name'] = 'about_us';
		$data['row'] = $this->db->query("SELECT * FROM about_us WHERE id = 1")->row_array();
		$this->view('about_us',$data);
	}
	public function update(){
		// print_a($_POST,1);
		$id = $this->input->post('id');
		$old_image = $this->input->post('old_image');
		$this->form_validation->set_rules('short_title','Short Title','trim|callback_alpha_dash_space_title|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('title','title','trim|required|callback_alpha_dash_space_title|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('description','Description','trim|min_length[10]|max_length[300]|callback_alpha_dash_space_display_title');
		$this->form_validation->set_rules('mission','Mission','trim|min_length[10]|max_length[300]|callback_alpha_dash_space_display_title');
		$this->form_validation->set_rules('vision','Vision','trim|min_length[10]|max_length[300]|callback_alpha_dash_space_display_title');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('posted',$_POST);
			$this->session->set_flashdata('error',validation_errors());
			redirect(ADMIN.'/about_us/');
		}else{
			$insert['short_title'] = $this->input->post('short_title');
			$insert['title'] = $this->input->post('title');
			$insert['description'] = htmlentities($this->input->post('description'));
			$insert['mission'] = htmlentities($this->input->post('mission'));
			$insert['vision'] = htmlentities($this->input->post('vision'));
			$insert_data = $this->security->xss_clean($insert);
			if(!empty($_FILES['image']['name'])) {
				$folderPath = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/about_us/";
				if(!is_dir($folderPath)) mkdir($folderPath, 0777, TRUE);
				$config['upload_path']          = $folderPath;
				$config['allowed_types']        = 'jpg|png|jpeg|JPEG|JPG|PNG';
				$config['max_size']             = "1024";
				$config['max_width']            = "531";
				$config['max_height']           = "343";
				$config['encrypt_name'] 		= TRUE;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('image')) {
					$this->session->set_flashdata('posted',$_POST);
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(ADMIN.'/about_us','refresh');
				} else {
					$image = $this->upload->data();
					$image_name = $image['file_name'];
					$insert_data['image'] = $image_name;
					if($image_name!=''){
						@unlink('uploads/about_us/'.$old_image);
					} 
				}
			}
			$this->db->where('id', 1);
            $this->db->update('about_us', $insert_data);
            $check = $this->db->query('select * from about_us WHERE id = 1')->row_array();
            if (empty($check)) {
                $insert['id'] = 1;
                $insert['created_time'] = date('Y-m-d H:i:s');
                $this->db->insert('about_us',$insert);
                $this->session->set_flashdata('success', 'Created Successfully');
            } else {
                $this->session->set_flashdata('success', 'Updated Successfully');
            }
			redirect(ADMIN.'/about_us','refresh');
		}
	}
}