<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index(){
		$data['page_name'] = 'gallery';
		$this->view('gallery',$data);
	}
	public function add_gallery($gallery_id = false) {
		if($gallery_id != false) { 
			$data['row'] = $this->db->get_where('gallery', array('gallery_id' => $gallery_id))->row_array();
			$data['page_name'] = 'edit_gallery';			
		} else {
			$data['page_name'] = 'add_gallery';
		}
		$this->view('add_gallery',$data);
	}
	public function add(){
		$gallery_id = $this->input->post('gallery_id');
		$old_image = $this->input->post('old_image');
		if(!empty($_FILES['gallery_image']['name'])) {
			$folderPath = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/gallery/";
			if(!is_dir($folderPath)) mkdir($folderPath, 0777, TRUE);
			$config['upload_path']          = $folderPath;
			$config['allowed_types']        = 'jpg|png|jpeg|JPEG|JPG|PNG';
			$config['max_size']             = "1024";
			$config['max_width']            = "788";
			$config['max_height']           = "500";
			$config['encrypt_name'] 		= TRUE;
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('gallery_image')) {
				$this->session->set_flashdata('posted',$_POST);
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(ADMIN.'/gallery/add_gallery/'.$gallery_id,'refresh');
			} else {
				$image = $this->upload->data();
				$image_name = $image['file_name'];
				$insert['gallery_image'] = $image_name;
				if($image_name!='') @unlink('uploads/gallery/'.$old_image);
			}
		}
		if($gallery_id  != '') {
			$this->db->where('gallery_id', $gallery_id);
			$this->db->update('gallery', $insert);
			$this->session->set_flashdata('success','Updated Successfully!');
		} else {
			$insert['created_time'] = date('Y-m-d H:i:s');
			$this->db->insert('gallery', $insert);
			$this->session->set_flashdata('success','Added Successfully!');
		}
		redirect(ADMIN.'/gallery','refresh');
	}
	public function load_gallery_data(){
		$params = $columns = $totalRecords = $tab_data = array();
		$params = $_REQUEST;
		$where =  $sqlTot = $sqlRec =''; $wherePsearch = '';
		$order = $this->input->post('order[0][column]');
		$dir = $this->input->post('order[0][dir]');
		$column = $this->input->post('columns['.$order.'][name]');
		$sql = "select * from gallery where is_deleted = 'N'";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		if(isset($where) && $where!=''){
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if($params['length']!=-1){
			$sqlRec .= "ORDER BY gallery_id DESC LIMIT " . $params['start'].", ". $params['length']." ";
		}else{
			$sqlRec .= "ORDER BY gallery_id DESC";
		}
		$total_gallery_imgs = $this->db->query($sql)->num_rows();
		$queryTot = $this->db->query($sqlTot);
		$totalRecords = $queryTot->num_rows();
		$queryRecords = $this->db->query($sqlRec)->result_array();
		if($queryRecords) { foreach ($queryRecords as $k => $data) {
			$row[0] = '<img src="'.base_url('uploads/gallery/'.$data['gallery_image']).'" class="img-fluid">';
			$row[1] = '<input type="button" value="Inactive" class="btn btn-danger" id="gallery_status_'.$data['gallery_id'].'" onclick="update_status(this.value,'.$data['gallery_id'].')"/>';
            if ($data['is_active'] == 'Y') {
                $row[1] = '<input type="button" value="Active" class="btn btn-success" id="gallery_status_'.$data['gallery_id'].'" onclick="update_status(this.value,'.$data['gallery_id'].')"/>';
            }			
            $row[2] = '<a class="text-secondary edit-icon font-20" href="'.site_url(ADMIN.'/gallery/add_gallery/').$data['gallery_id'].'" title="Edit Gallery"><i class="mdi mdi-pencil-outline"></i></a>&nbsp;&nbsp;<a class="text-secondary delete-icon font-20" style="cursor:pointer" onclick="delete_data('.$data['gallery_id'].');" title="Delete Gallery"><i class="mdi mdi-delete-outline"></i></a>';
            $tab_data[] = $row;
		} }
		$json_data = array(
			"draw" 				=> intval($params['draw']),
			"recordsTotal" 		=> intval($totalRecords),
			"recordsFiltered" => intval($totalRecords),
			"total_gallery_imgs" => intval($total_gallery_imgs),
			"data"              => $tab_data,
		);
		echo json_encode($json_data);
	}
	public function update_status() {
		$gallery_id = $this->input->post('gallery_id');
		$gallery_status = $this->input->post('gallery_status', true);
		$update = array();
		if($gallery_status == 'Inactive') {
			$update['is_active'] = 'Y';
		} else {
			$update['is_active'] = 'N';
		}
		$html = '';
		if($gallery_id != '') {
			$this->db->where('gallery_id', $gallery_id);
			$result = $this->db->update('gallery', $update);
			if($result) {
				$html = $update['is_active'];
			} 
		}
		echo $html;
	}
	public function delete_data($gallery_id=false){
		if($gallery_id !==false) {
			$gallery_img = $this->db->query('select * from gallery where gallery_id = '.$gallery_id)->row_array();
			@unlink('uploads/gallery/'.$gallery_img['gallery_image']);
			$this->db->set('is_deleted','Y');
			$this->db->where('gallery_id',$gallery_id);
			$this->db->update('gallery');
			$this->session->set_flashdata('success','Deleted Successfully');
		}else{
			$this->session->set_flashdata('error','Try Again');
		}
		redirect(ADMIN.'/gallery','refresh');
	}
}