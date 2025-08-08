<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index(){
		$data['page_name'] = 'services';
		$this->view('services',$data);
	}
	public function add_service($service_id = false) {
		if($service_id != false) { 
			$data['row'] = $this->db->get_where('services', array('service_id' => $service_id))->row_array();
			$data['page_name'] = 'edit_service';			
		} else {
			$data['page_name'] = 'add_service';
		}
		$this->view('add_service',$data);
	}
	public function add(){
		// print_a($_POST,1);
		$service_id = $this->input->post('service_id');
		$old_image = $this->input->post('old_image');
		$this->form_validation->set_rules('title','Title','trim|required|min_length[3]|max_length[50]|callback_alpha_string');
		$this->form_validation->set_rules('description','Description','trim|callback_no_script_tags');
		$this->form_validation->set_rules('service_status','Status','trim|required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('posted',$_POST);
			$this->session->set_flashdata('error',validation_errors());
			redirect(ADMIN.'/services/add_service/'.$service_id);
		} else {
			$insert['title'] = ucwords($this->input->post('title'));
			$insert['description'] = htmlentities($this->input->post('description'));
			$insert['service_status'] = $this->input->post('service_status');
			$insert_data = $this->security->xss_clean($insert);
			if(!empty($_FILES['image']['name'])) {
				$folderPathDetail = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/service_detail/";
				$thumbfolder = $folderPathDetail.'thumbpath/';
				if(!is_dir($folderPathDetail)) mkdir($folderPathDetail, 0777, TRUE);
				if(!is_dir($thumbfolder)) mkdir($thumbfolder, 0777, TRUE);
				$config_detail['upload_path']          = $folderPathDetail;
				$config_detail['allowed_types']        = 'jpg|png|jpeg|JPEG|JPG|PNG';
				$config_detail['max_size']             = "1024";
				$config_detail['encrypt_name']         = TRUE;
				$this->load->library('upload', $config_detail, 'service_upload');
				if(!$this->service_upload->do_upload('image')) {
					$this->session->set_flashdata('posted', $_POST);
					$this->session->set_flashdata('error', $this->service_upload->display_errors());
					redirect(ADMIN.'/services/add_service/'.$service_id);
				} else {
					$image_1 = $this->service_upload->data();
					$image_name_1 = $image_1['file_name'];
					$insert_data['image'] = $image_name_1;
					$resize_img_detail['img_library'] = 'gd2';
					$resize_img_detail['source_image'] = $folderPathDetail.$image_name_1;
					$resize_img_detail['maintain_ratio'] = FALSE;
					$resize_img_detail['width'] = 370;
					$resize_img_detail['height'] = 255;
					$resize_img_detail['new_image'] = $thumbfolder.$image_name_1;
					$this->load->library('image_lib', $resize_img_detail);
					$resize = $this->image_lib->resize();
					if($image_name_1 != '') {
						@unlink('uploads/service_detail/'.$old_image);	
						@unlink('uploads/service_detail/thumbpath/'.$old_image);
					}
				}
			}
			if($service_id  != '') {
				$insert_data['updated_time'] = date('Y-m-d H:i:s');
				$this->db->where('service_id', $service_id);
				$this->db->update('services', $insert_data);
				$this->session->set_flashdata('success','Updated Successfully!');
			} else {
				$insert_data['created_time'] = date('Y-m-d H:i:s');
				$this->db->insert('services', $insert_data);
				$this->session->set_flashdata('success','Added Successfully!');
			}
			redirect(ADMIN.'/services','refresh');
		}
	}
	public function load_data(){
		$params = $columns = $totalRecords = $tab_data = array();
		$params = $_REQUEST;
		$where =  $sqlTot = $sqlRec =''; $wherePsearch = '';
		$order = $this->input->post('order[0][column]');
		$dir = $this->input->post('order[0][dir]');
		$column = $this->input->post('columns['.$order.'][name]');
		if(!empty($params['search']['value'])){
			$where .=" AND(title LIKE '%".$params['search']['value']."%' OR service_status LIKE '%".$params['search']['value']."%')";
		}
		$sql = "select * from services where service_id!=''";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		if(isset($where) && $where!=''){
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if($params['length']!=-1){
			$sqlRec .= "ORDER BY service_id DESC LIMIT " . $params['start'].", ". $params['length']." ";
		}else{
			$sqlRec .= "ORDER BY service_id DESC";
		}
		$total_visa = $this->db->query($sql)->num_rows();
		$queryTot = $this->db->query($sqlTot);
		$totalRecords = $queryTot->num_rows();
		$queryRecords = $this->db->query($sqlRec)->result_array();
		if($queryRecords) { foreach ($queryRecords as $k => $data){
			$row[0] = '<img src="'.base_url('uploads/service_detail/'.$data['image']).'" class="img-fluid">';
			$row[1] = $data['title'];
			$row[2] = '<input type="button" value="Inactive" class="btn btn-danger" id="visa_status_'.$data['service_id'].'" onclick="update_status(this.value,'.$data['service_id'].')"/>';
            if ($data['service_status'] == 'Active') {
                $row[2] = '<input type="button" value="Active" class="btn btn-success" id="visa_status_'.$data['service_id'].'" onclick="update_status(this.value,'.$data['service_id'].')"/>';
            }
			$row[3] = '<a class="text-secondary edit-icon font-20" href="'.site_url(ADMIN.'/services/add_service/').$data['service_id'].'" title="Edit Service"><i class="mdi mdi-pencil-outline"></i></a> &nbsp;&nbsp;<a class="text-secondary delete-icon font-20" style="cursor:pointer;" onclick="delete_data('.$data['service_id'].');" title="Delete Service"><i class="mdi mdi-delete-outline"></i></a>';
            $tab_data[] = $row;
		} }
		$json_data = array(
			"draw" 				 => intval($params['draw']),
			"recordsTotal" 		 => intval($totalRecords),
			"recordsFiltered"    => intval($totalRecords),
			"total_services"     => intval($total_visa),
			"data"               => $tab_data,
		);
		echo json_encode($json_data);
	}
	public function delete_data($service_id=false){
		if($service_id !==false) {
			$service_img = $this->db->query('select * from services where service_id = "'.$service_id.'"')->row_array();
			@unlink('uploads/services/'.$service_img['front_image']);
			@unlink('uploads/service_detail/'.$service_img['image']);
			@unlink('uploads/service_detail/thumbpath/'.$service_img['image']);
			@unlink('uploads/services/icon_images/'.$service_img['icon_image']);
			$this->db->where('service_id',$service_id);
			$this->db->delete('services');
			$this->session->set_flashdata('success','Deleted Successfully');

		}else{
			$this->session->set_flashdata('error','Try Again');
		}
		redirect(ADMIN.'/services','refresh');
	}
	public function update_status() {
		$service_id = $this->input->post('service_id');
		$service_status = $this->input->post('service_status', true);
		$update = array();
		if($service_status == 'Inactive') {
			$update['service_status'] = 'Active';
		} else {
			$update['service_status'] = 'Inactive';
		}

		$html = '';
		if($service_id != '') {
			$this->db->where('service_id', $service_id);
			$result = $this->db->update('services', $update);
			if($result) {
				$html = $update['service_status'];
			} 
		}
		echo $html;
	}
}