<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Banners_with_fil extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index() {
		$data['page_name'] = 'banners_with_fil';
		$this->view('banners_with_fil',$data);
	}
	public function add_banner($banner_id = false) {
		if($banner_id != false) { 
			$data['row'] = $this->db->get_where('banners', array('banner_id' => $banner_id))->row_array();
			$data['page_name'] = 'edit_banner';			
		} else {
			$sequence= $this->db->get_where('banners', array('banner_status' => 'Active'))->num_rows();
			$data['sequence'] = $sequence + 1;
			$data['page_name'] = 'add_banner';
		}
		$this->view('add_banner',$data);
	}
	public function add(){
		// print_a($_POST,1);
		$banner_id = $this->input->post('banner_id');
		$old_image = $this->input->post('old_image');
		$this->form_validation->set_rules('short_title','Short Title','trim|min_length[3]|max_length[50]|callback_alpha_dash_space_title');
		$this->form_validation->set_rules('title','Title','trim|min_length[3]|max_length[50]|callback_alpha_dash_space_title|required');
		$this->form_validation->set_rules('description','Description','trim|callback_no_script_tags');
		$this->form_validation->set_rules('link','Link','trim|callback_validate_url_format');
		$this->form_validation->set_rules('sequence','Sequence','trim|required|numeric|min_length[1]|greater_than[0]');
		$this->form_validation->set_rules('banner_status','Status','trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('posted',$_POST);
			$this->session->set_flashdata('error',validation_errors());
			redirect(ADMIN.'/banners_with_fil/add_banner/'.$banner_id);
		} else {
			$insert['sequence'] = $this->input->post('sequence');
			$insert['short_title'] = ucwords($this->input->post('short_title'));
			$insert['title'] = $this->input->post('title');
			$insert['link'] = $this->input->post('link');
			$insert['description'] = htmlentities($this->input->post('description'));
			$insert['banner_status'] = $this->input->post('banner_status');
			$insert_data = $this->security->xss_clean($insert);
			if(!empty($_FILES['image']['name'])) {
				$folderPath = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/banners/";
				$thumbfolderPath = $folderPath.'thumb/';
				if(!is_dir($folderPath)) mkdir($folderPath, 0777, TRUE);
				if(!is_dir($thumbfolderPath)) mkdir($thumbfolderPath, 0777, TRUE);
				$config['upload_path']          = $folderPath;
				$config['allowed_types']        = 'jpg|png|jpeg|JPEG|JPG|PNG';
				$config['max_size']             = "1024";
				$config['encrypt_name'] 		= TRUE;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('image')) {
					$this->session->set_flashdata('posted',$_POST);
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(ADMIN.'/banners_with_fil/add_banner/'. $banner_id,'refresh');
				} else {
					$image = $this->upload->data();
					$image_name = $image['file_name'];
					$insert_data['image'] = $image_name;
					$resize_img['img_library'] = 'gd2';
					$resize_img['source_image'] = $folderPath . $image_name;
					$resize_img['maintain_ratio'] = FALSE;
					$resize_img['width'] = 493;
					$resize_img['height'] = 640;
					$resize_img['new_image'] = $thumbfolderPath . $image_name;
					$this->load->library('image_lib',$resize_img);
					$resize = $this->image_lib->resize();
					if($image_name!=''){
						@unlink('uploads/banners/'.$old_image);
						@unlink('uploads/banners/thumb/'.$old_image);
					}
				}
			}
			if($banner_id!='') {
				$check_sequence_exists = $this->db->query("select banner_id from banners where sequence = '".$insert['sequence']."' and banner_id != ".$banner_id)->num_rows();
			} else {
				$check_sequence_exists = $this->db->query("select banner_id from banners where sequence = '".$insert['sequence']."'")->num_rows();
			}
			if($check_sequence_exists > 0) {
				$this->session->set_flashdata('posted',$_POST);
				$this->session->set_flashdata('error','Sequence already exists');
				redirect(ADMIN.'/banners_with_fil/add_banner/'. $banner_id,'refresh');
			} else {
				if($banner_id!=''){
					$insert_data['updated_time'] = date('Y-m-d H:i:s');
					$this->db->where('banner_id',$banner_id);
					$this->db->update('banners',$insert_data);
					$this->session->set_flashdata('success','Updated Successfully');
				} else{
					$insert_data['created_time'] = date('Y-m-d H:i:s');
					$this->db->insert('banners',$insert_data);
					$this->session->set_flashdata('success','Added Successfully');
				}
				redirect(ADMIN.'/banners_with_fil','refresh');
			}
		}
	}
	public function load_data(){
		$params = $columns = $totalRecords = $tab_data = array();
		$params = $_REQUEST;
		$where =  $sqlTot = $sqlRec =''; $wherePsearch = '';
		$order = $this->input->post('order[0][column]');
		$banner_status = $this->input->post('banner_status');
		$dir = $this->input->post('order[0][dir]');
		$column = $this->input->post('columns['.$order.'][name]');
		if(!empty($params['search']['value'])) {
			$where .= " AND(short_title LIKE '%".$params['search']['value']."%' OR title LIKE '%".$params['search']['value']."%' OR banner_status LIKE '%".$params['search']['value']."%' )";
		}
		if($banner_status!='') {
			$where .= " and banner_status = '".$banner_status."'";
		}
		$sql = "select * from banners where banner_id!=''";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		if(isset($where) && $where!='') {
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if($params['length']!=-1) {
			$sqlRec .= "ORDER BY banner_id DESC LIMIT " . $params['start'].", ". $params['length']." ";
		} else {
			$sqlRec .= "ORDER BY banner_id DESC";
		}
		$total_banners = $this->db->query($sql)->num_rows();
		$queryTot = $this->db->query($sqlTot);
		$totalRecords = $queryTot->num_rows();
		$queryRecords = $this->db->query($sqlRec)->result_array();
		if($queryRecords) { foreach ($queryRecords as $k => $data){
			$row[0] = '<img src="'.base_url('uploads/banners/thumb/'.$data['image']).'" class="img-fluid">';
			$row[1] = $data['short_title'];
			$row[2] = $data['title'];
			$row[3] = $data['sequence'];
			$row[4] = '<input type="button" value="Inactive" class="btn btn-danger" id="banner_status_'.$data['banner_id'].'" onclick="update_status(this.value,'.$data['banner_id'].')"/>';
            if ($data['banner_status'] == 'Active') {
                $row[4] = '<input type="button" value="Active" class="btn btn-success" id="banner_status_'.$data['banner_id'].'" onclick="update_status(this.value,'.$data['banner_id'].')"/>';
            }
			$row[5] = '<a class="text-secondary edit-icon font-20" href="'.site_url(ADMIN.'/banners_with_fil/add_banner/').$data['banner_id'].'" title="Edit Banner"><i class="mdi mdi-pencil-outline"></i></a> &nbsp;&nbsp;<a class="text-secondary delete-icon font-20" style="cursor:pointer;" onclick="delete_data('.$data['banner_id'].');" title="Delete Banner"><i class="mdi mdi-delete-outline"></i></a>';
            $tab_data[] = $row;
		} }
		$json_data = array (
			"draw" 				=> intval($params['draw']),
			"recordsTotal" 		=> intval($totalRecords),
			"recordsFiltered"   => intval($totalRecords),
			"total_banners"     => intval($total_banners),
			"data"              => $tab_data,
		);
		echo json_encode($json_data);
	}
	public function delete_data($banner_id=false){
		if($banner_id !==false) {
			$banner_img = $this->db->query('select * from banners where banner_id = "'.$banner_id.'"')->row_array();
			@unlink('uploads/banners/'.$banner_img['image']	);
			@unlink('uploads/banners/thumb/'.$banner_img['image']);
			$this->db->where('banner_id',$banner_id);
			$this->db->delete('banners');
			$this->session->set_flashdata('success','Deleted Successfully');

		}else{
			$this->session->set_flashdata('error','Try Again');
		}
		redirect(ADMIN.'/banners_with_fil','refresh');
	}
	public function update_status() {
		$banner_id = $this->input->post('banner_id');
		$banner_status = $this->input->post('banner_status', true);
		$update = array();
		if($banner_status == 'Inactive') {
			$update['banner_status'] = 'Active';
		} else {
			$update['banner_status'] = 'Inactive';
		}

		$html = '';
		if($banner_id != '') {
			$this->db->where('banner_id', $banner_id);
			$result = $this->db->update('banners', $update);
			if($result) {
				$html = $update['banner_status'];
			} 
		}
		echo $html;
	}
}