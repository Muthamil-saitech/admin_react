<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Testimonials_wo_fil extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index() {
		$data['page_name'] = 'testimonials_wo_fil';
		$this->view('testimonials_wo_fil',$data);
	}
	public function add_testimonial($testimonial_id = false) {
		if($testimonial_id != false) { 
			$data['row'] = $this->db->get_where('testimonials', array('testimonial_id' => $testimonial_id))->row_array();
			$data['page_name'] = 'edit_testimonial';			
		} else {
			$data['page_name'] = 'add_testimonial';
		}
		$this->view('add_testimonial_wo_fil',$data);
	}
	public function add(){
		/* print_a($_POST,1); */
		$testimonial_id = $this->input->post('testimonial_id');
		$old_image = $this->input->post('old_image');
		$this->form_validation->set_rules('name','Name','trim|required|min_length[3]|max_length[50]|callback_alpha_string');
		$this->form_validation->set_rules('designation','Designation','trim|min_length[3]|max_length[50]|callback_alpha_dash_space_title');
		$this->form_validation->set_rules('description','Description','trim|required|min_length[10]|max_length[300]|callback_alpha_dash_space_for_title');
		$this->form_validation->set_rules('testimonial_status','Testimonial Status','trim|required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('posted',$_POST);
			$this->session->set_flashdata('error',validation_errors());
			redirect(ADMIN.'/testimonials_wo_fil/add_testimonial/'.$testimonial_id);
		}else{
			$insert['name'] = ucwords($this->input->post('name'));
			$insert['ratings'] = $this->input->post('ratings');
			$insert['designation'] = ucwords($this->input->post('designation'));
			$insert['description'] = htmlentities($this->input->post('description'));
			$insert['testimonial_status'] = $this->input->post('testimonial_status');
			$insert_data = $this->security->xss_clean($insert);
			$default_image = 'user.jpg';
			$folderPath = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/testimonials/";
			$thumbfolderPath = $folderPath.'thumb/';
			if(!is_dir($folderPath)) mkdir($folderPath, 0777, TRUE);
			if(!is_dir($thumbfolderPath)) mkdir($thumbfolderPath, 0777, TRUE);
			if(!empty($_FILES['image']['name'])) {
				$config['upload_path']          = $folderPath;
				$config['allowed_types']        = 'jpg|png|jpeg|JPEG|JPG|PNG';
				$config['max_size']             = "1024";
				$config['encrypt_name'] 		= TRUE;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('image')) {
					$this->session->set_flashdata('posted',$_POST);
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(ADMIN.'/testimonials_wo_fil/add_testimonial/'. $testimonial_id,'refresh');
				} else {
					$image = $this->upload->data();
					$image_name = $image['file_name'];
					$insert_data['image'] = $image_name;
					$resize_img['img_library'] = 'gd2';
					$resize_img['source_image'] = $folderPath . $image_name;
					$resize_img['maintain_ratio'] = FALSE;
					$resize_img['width'] = 100;
					$resize_img['height'] = 100;
					$resize_img['new_image'] = $thumbfolderPath . $image_name;
					$this->load->library('image_lib',$resize_img);
					$resize = $this->image_lib->resize();
					if($image_name!=''){
						@unlink('uploads/testimonials/'.$old_image);
						@unlink('uploads/testimonials/thumb/'.$old_image);
					} 
				}
			}else{
				if($old_image != ''){
					$insert_data['image'] = $old_image;
				} else {
					$default_path = FCPATH . 'assets/frontend_assets/img/'.$default_image;
					$image_name = rand().$default_image;
					$store_path = $folderPath.$image_name;
					$thumb_path = $thumbfolderPath.$image_name;
					if(file_exists($default_path) && ($thumb_path)){
						copy($default_path,$store_path);
						copy($default_path,$thumb_path);
						$insert_data['image'] = $image_name;
						if($image_name!=''){
							@unlink('uploads/testimonials/'.$old_image);
							@unlink('uploads/testimonials/thumb/'.$old_image);
						}
					}else{
						$this->session->set_flashdata('error', 'Default image not found.');
						redirect(ADMIN.'/testimonials_wo_fil/add_testimonial/'. $testimonial_id,'refresh');
					}					
				}
			}
			if($testimonial_id  != '') {
				$insert_data['updated_time'] = date('Y-m-d H:i:s');
				$this->db->where('testimonial_id', $testimonial_id);
				$this->db->update('testimonials', $insert_data);
				$this->session->set_flashdata('success','Updated Successfully!');
			} else {
				$insert_data['created_time'] = date('Y-m-d H:i:s');
				$this->db->insert('testimonials', $insert_data);
				$this->session->set_flashdata('success','Added Successfully!');
			}
			redirect(ADMIN.'/testimonials_wo_fil','refresh');
		}
	}
	public function load_data(){
		// print_a($_POST,1);
		$params = $columns = $totalRecords = $tab_data = array();
		$params = $_REQUEST;
		$where =  $sqlTot = $sqlRec =''; $wherePsearch = '';
		$testimonial_status = $this->input->post('testimonial_status');
		$rating = $this->input->post('rating');
		$order = $this->input->post('order[0][column]');
		$dir = $this->input->post('order[0][dir]');
		$column = $this->input->post('columns['.$order.'][name]');
		if(!empty($params['search']['value'])){
			$where .=" AND(name LIKE '%".$params['search']['value']."%' OR designation LIKE '%".$params['search']['value']."%' OR testimonial_status LIKE '%".$params['search']['value']."%')";
		}
		if(!empty($testimonial_status) || $testimonial_status!='') { $where .= " AND testimonial_status = '".$testimonial_status."'"; }
		if(!empty($rating) || $rating!='') { $where .= " AND ratings = ".$rating; }
		$sql = "select * from testimonials where testimonial_id!=''";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		if(isset($where) && $where!='') {
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if($params['length']!=-1) {
			$sqlRec .= " ORDER BY testimonial_id DESC LIMIT " . $params['start'].", ". $params['length']." ";
		} else {
			$sqlRec .= " ORDER BY testimonial_id DESC";
		}
		$total_testimonials = $this->db->query($sql)->num_rows();
		$queryTot = $this->db->query($sqlTot);
		$totalRecords = $queryTot->num_rows();
		$queryRecords = $this->db->query($sqlRec)->result_array();
		if($queryRecords) { foreach ($queryRecords as $k => $data){
			$row[0] = '<img src="'.base_url('uploads/testimonials/thumb/'.$data['image']).'" class="img-fluid">';
			$row[1] = $data['name'];
			$row[2] = $data['designation'];
			$row[3] = $data['ratings'];
			$row[4] = '<input type="button" value="Inactive" class="btn btn-danger" id="testimonial_status_'.$data['testimonial_id'].'" onclick="update_status(this.value,'.$data['testimonial_id'].')"/>';
            if ($data['testimonial_status'] == 'Active') {
                $row[4] = '<input type="button" value="Active" class="btn btn-success" id="testimonial_status_'.$data['testimonial_id'].'" onclick="update_status(this.value,'.$data['testimonial_id'].')"/>';
            }
			$row[5] = '<a class="text-secondary edit-icon font-20" href="'.site_url(ADMIN.'/testimonials_wo_fil/add_testimonial/').$data['testimonial_id'].'" title="Edit Testimonial"><i class="mdi mdi-pencil-outline"></i></a> &nbsp;&nbsp;<a class="text-secondary delete-icon font-20" style="cursor:pointer" onclick="delete_data('.$data['testimonial_id'].');" title="Delete Testimonial"><i class="mdi mdi-delete-outline"></i></a>';
            $tab_data[] = $row;
		} }
		$json_data = array(
			"draw" 				 => intval($params['draw']),
			"recordsTotal" 		 => intval($totalRecords),
			"recordsFiltered"    => intval($totalRecords),
			"total_testimonials" => intval($total_testimonials),
			"data"               => $tab_data,
		);
		echo json_encode($json_data);
	}
	public function delete_data($testimonial_id=false){
		if($testimonial_id !==false) {
			$testimonial_img = $this->db->query('select * from testimonials where testimonial_id = "'.$testimonial_id.'"')->row_array();
			@unlink('uploads/testimonials/'.$testimonial_img['image']);
			@unlink('uploads/testimonials/thumb/'.$testimonial_img['image']);
			$this->db->where('testimonial_id',$testimonial_id);
			$this->db->delete('testimonials');
			$this->session->set_flashdata('success','Deleted Successfully');

		}else{
			$this->session->set_flashdata('error','Try again');
		}
		redirect(ADMIN.'/testimonials_wo_fil','refresh');
	}
	public function update_status() {
		$testimonial_id = $this->input->post('testimonial_id');
		$testimonial_status = $this->input->post('testimonial_status', true);
		$update = array();
		if($testimonial_status == 'Inactive') {
			$update['testimonial_status'] = 'Active';
		} else {
			$update['testimonial_status'] = 'Inactive';
		}
		$html = '';
		if($testimonial_id != '') {
			$this->db->where('testimonial_id', $testimonial_id);
			$result = $this->db->update('testimonials', $update);
			if($result) {
				$html = $update['testimonial_status'];
			} 
		}
		echo $html;
	}
}