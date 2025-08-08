<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Album extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index(){
		$data['page_name'] = 'album';
		$this->view('album',$data);
	}
	public function add_album($album_id = false) {
		if($album_id != false) { 
			$data['row'] = $this->db->get_where('album', array('album_id' => $album_id))->row_array();
			$data['page_name'] = 'edit_album';			
		} else {
			$data['page_name'] = 'add_album';
		}
		$this->view('add_album',$data);
	}
	public function add(){
		// print_a($_POST,1);
		$album_id = $this->input->post('album_id');
		$old_image = $this->input->post('old_image');
		$this->form_validation->set_rules('album_title','Album Title','trim|required|min_length[5]|max_length[80]|callback_alpha_dash_space_display_title');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('posted',$_POST);
			$this->session->set_flashdata('error',validation_errors());
			redirect(ADMIN.'/album/add_album/'.$album_id);
		} else {
			$insert['album_title'] = $this->input->post('album_title');
			$insert_data = $this->security->xss_clean($insert);
			if(!empty($_FILES['album_image']['name'])) {
				$folderPath = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/album/";
				if(!is_dir($folderPath)) mkdir($folderPath, 0777, TRUE);
				$config['upload_path']          = $folderPath;
				$config['allowed_types']        = 'jpg|png|jpeg|JPEG|JPG|PNG';
				$config['max_size']             = "1024";
				$config['max_width']            = "788";
				$config['max_height']           = "500";
				$config['encrypt_name'] 		= TRUE;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('album_image')) {
					$this->session->set_flashdata('posted',$_POST);
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(ADMIN.'/album/add_album/'.$album_id,'refresh');
				}
				else {
					$image = $this->upload->data();
					$image_name = $image['file_name'];
					$insert_data['album_image'] = $image_name;
					if($image_name!='') @unlink('uploads/album/'.$old_image);
				}
			}
			if($album_id  != '') {
				$this->db->where('album_id', $album_id);
				$this->db->update('album', $insert_data);
				$this->session->set_flashdata('success','Updated Successfully!');
			} else {
				$insert_data['created_time'] = date('Y-m-d H:i:s');
				$this->db->insert('album', $insert_data);
				$this->session->set_flashdata('success','Added Successfully!');
			}
			redirect(ADMIN.'/album','refresh');
		}
	}
	public function load_album_data(){
		$params = $columns = $totalRecords = $tab_data = array();
		$params = $_REQUEST;
		$where =  $sqlTot = $sqlRec =''; $wherePsearch = '';
		$order = $this->input->post('order[0][column]');
		$dir = $this->input->post('order[0][dir]');
		$column = $this->input->post('columns['.$order.'][name]');
		if(!empty($params['search']['value'])){
			$where .=" AND(album_title LIKE '%".$params['search']['value']."%')";
		}
		$sql = "select * from album where is_deleted = 'N'";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		if(isset($where) && $where!=''){
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if($params['length']!=-1){
			$sqlRec .= "ORDER BY album_id DESC LIMIT " . $params['start'].", ". $params['length']." ";
		}else{
			$sqlRec .= "ORDER BY album_id DESC";
		}
		$total_album_imgs = $this->db->query($sql)->num_rows();
		$queryTot = $this->db->query($sqlTot);
		$totalRecords = $queryTot->num_rows();
		$queryRecords = $this->db->query($sqlRec)->result_array();
		if($queryRecords) { foreach ($queryRecords as $k => $data){
			$row[0] = '<img src="'.base_url('uploads/album/'.$data['album_image']).'" class="img-fluid">';	
			$row[1] = $data['album_title'];
            $row[2] = '<a class="text-secondary edit-icon font-20" href="'.site_url(ADMIN.'/album/add_album/').$data['album_id'].'" title="Edit Album"><i class="mdi mdi-pencil-outline"></i></a>&nbsp;&nbsp;<a class="text-secondary info-icon font-20" href="'.site_url(ADMIN.'/album/view_album/').$data['album_id'].'" title="View Album"><i class="mdi mdi-image-album"></i></a>&nbsp;&nbsp;<a class="text-secondary delete-icon font-20" style="cursor:pointer" onclick="delete_data('.$data['album_id'].');" title="Delete Album"><i class="mdi mdi-delete-outline"></i></a>';
            $tab_data[] = $row;
		} }
		$json_data = array(
			"draw" 				=> intval($params['draw']),
			"recordsTotal" 		=> intval($totalRecords),
			"recordsFiltered" => intval($totalRecords),
			"total_album_imgs" => intval($total_album_imgs),
			"data"              => $tab_data,
		);
		echo json_encode($json_data);
	}
	public function view_album($album_id){
		$data['page_name'] = 'album';
		$data['row'] = $this->db->query("select * from album where album_id = ".$album_id." and is_deleted = 'N'")->row_array();
		$data['album'] = $this->db->query("select * from album_images where album_id = ".$album_id." and is_deleted = 'N'")->result_array();
		$this->view('view_album',$data);
	}
	public function update_album(){
		// print_a($_POST,1);
		$album_id = $this->input->post('album_id'); 
		if(!empty($_FILES['album_image']['name'])){
			$files = $_FILES;
			$count = count($_FILES['album_image']['name']);
			for($i=0; $i<$count; $i++){
				$_FILES['album_image']['name']		= $files['album_image']['name'][$i];
				$_FILES['album_image']['type']		= $files['album_image']['type'][$i];
				$_FILES['album_image']['tmp_name']	= $files['album_image']['tmp_name'][$i];
				$_FILES['album_image']['error']		= $files['album_image']['error'][$i];
				$_FILES['album_image']['size']		= $files['album_image']['size'][$i];
				$ext = pathinfo($_FILES['album_image']['name'], PATHINFO_EXTENSION);
				if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'JPEG' || $ext == 'JPG' || $ext == 'PNG') {
					$uploadPath = "uploads/album/".$album_id.'/';
					$thumbPath = $uploadPath.'thumb/';
					$folderPath = dirname($_SERVER["SCRIPT_FILENAME"])."/".$uploadPath;
					if(!is_dir($folderPath)) { mkdir($folderPath, 0777, TRUE); }
					$config['upload_path'] = $folderPath; 
					$config['allowed_types'] = "gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG";
					$config['max_size'] = "1024";
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('album_image')){
						$image = $this->upload->data();
						$insert['album_id'] = $album_id;
						$image_name = $image['file_name'];
						$insert['image'] = $image_name;
						$resize_config['image_library'] = 'gd2';
						$resize_config['source_image'] = $image['full_path']; 
						$resize_config['maintain_ratio'] = FALSE;  
						$resize_config['width'] = 788;  
						$resize_config['height'] = 500; 
						$resize_config['new_image'] = $folderPath;				
						$this->load->library('image_lib', $resize_config);
						$resize = $this->image_lib->resize();
						$this->db->insert('album_images', $insert);
						$this->session->set_flashdata('success', 'Images Uploaded');
					}else{
						$this->session->set_flashdata('error', $this->upload->display_errors());
					}
				}else{
					$this->session->set_flashdata('error','Check image extension');
				}
			}
			redirect(ADMIN.'/album/view_album/'.$album_id, 'refresh');
		}
	}
	public function album_image_delete($album_img_id = false) {
		if ($album_img_id != false) { 
			$album_img = $this->db->query('select * from album_images where album_img_id = '.$album_img_id)->row_array();
			if ($album_img) {
				@unlink('uploads/album/' . $album_img['album_id'] . '/' . $album_img['image']);
				$this->db->set('is_deleted', 'Y');
				$this->db->where('album_img_id', $album_img_id);
				$this->db->update('album_images');
				$this->session->set_flashdata('success', 'Deleted Successfully!');
			} else {
				$this->session->set_flashdata('error', 'Photo not found!');
			}
		} else {
			$this->session->set_flashdata('error', 'Try Again');
		}
		redirect(ADMIN.'/album/view_album/'.$album_img['album_id'], 'refresh'); 
	}
	public function delete_data($album_id=false){
		if($album_id !==false) {
			$album_img = $this->db->query('select * from album where album_id = '.$album_id)->row_array();
			@unlink('uploads/album/'.$album_img['album_image']);
			$this->db->set('is_deleted','Y');
			$this->db->where('album_id',$album_id);
			$this->db->update('album');
			$this->session->set_flashdata('success','Deleted Successfully');
		}else{
			$this->session->set_flashdata('error','Try Again');
		}
		redirect(ADMIN.'/album','refresh');
	}
}