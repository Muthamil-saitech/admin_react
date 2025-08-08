<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Blogs_with_fil extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index(){
		$data['page_name'] = 'blogs_with_fil';
		$this->view('blogs_with_fil',$data);
	}
	public function add_blog($blog_id = false) {
		if($blog_id != false) { 
			$data['row'] = $this->db->get_where('blogs', array('blog_id' => $blog_id))->row_array();
			$data['page_name'] = 'edit_blog';			
		} else {
			$data['page_name'] = 'add_blog';
		}
		$this->view('add_blog_with_fil',$data);
	}
	public function add(){
		// print_a($_POST,1);
		$blog_id = $this->input->post('blog_id');
		$old_image = $this->input->post('old_image');
		$this->form_validation->set_rules('title','Title','trim|required|min_length[5]|max_length[255]|callback_alpha_dash_space_display_title');
		$this->form_validation->set_rules('short_description','Short Description','trim|required|min_length[5]|max_length[255]|callback_alpha_dash_space_title');
		$this->form_validation->set_rules('description','Description','trim|required');
		$this->form_validation->set_rules('published_date','Published Date','trim|required');
		$this->form_validation->set_rules('blog_status','Blog Status','trim|required');
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('posted',$_POST);
			$this->session->set_flashdata('error',validation_errors());
			redirect(ADMIN.'/blogs_with_fil/add_blog/'.$blog_id);
		} else {
			$insert['title'] = $this->input->post('title');
			$insert['slug'] = create_slug($insert['title']);
			$insert['short_description'] = $this->input->post('short_description');
			$insert['description'] = htmlentities($this->input->post('description'));
			$insert['published_date'] = date_ymd($this->input->post('published_date'));
			$insert['blog_status'] = $this->input->post('blog_status');
			$check_unique_entry = $this->Common_model->check_unique_entry('blogs','blog_id','title',$insert['title'],$blog_id);
			if($check_unique_entry == 0) {
				$insert_data = $this->security->xss_clean($insert);
				if(!empty($_FILES['image']['name'])) {
					$folderPath = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/blogs/";
					if(!is_dir($folderPath)) mkdir($folderPath, 0777, TRUE);
					$config['upload_path']          = $folderPath;
					$config['allowed_types']        = 'jpg|png|jpeg|JPEG|JPG|PNG';
					$config['max_size']             = "1024";
					$config['max_width']            = "850";
					$config['max_height']           = "500";
					$config['encrypt_name'] 		= TRUE;
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('image')) {
						$this->session->set_flashdata('posted',$_POST);
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect(ADMIN.'/blogs_with_fil/add_blog/'.$blog_id,'refresh');
					}
					else {
						$image = $this->upload->data();
						$image_name = $image['file_name'];
						$insert_data['image'] = $image_name;
						if($image_name!='') @unlink('uploads/blogs/'.$old_image);
					}
				}
				if($blog_id  != '') {
					$insert_data['updated_time'] = date('Y-m-d H:i:s');
					$this->db->where('blog_id', $blog_id);
					$this->db->update('blogs', $insert_data);
					$this->session->set_flashdata('success','Updated Successfully!');
				} else {
					$insert_data['created_time'] = date('Y-m-d H:i:s');
					$this->db->insert('blogs', $insert_data);
					$this->session->set_flashdata('success','Added Successfully!');
				}
				redirect(ADMIN.'/blogs_with_fil','refresh');
			} else  {
				$this->session->set_flashdata('posted',$_POST);
				$this->session->set_flashdata('error',' Blog Title Already exists!');
				redirect(ADMIN.'/blogs_with_fil/add_blog/'. $blog_id,'refresh');
			}
		}
	}
	public function load_data(){
		$params = $columns = $totalRecords = $tab_data = array();
		$params = $_REQUEST;
		$where =  $sqlTot = $sqlRec =''; $wherePsearch = '';
		$order = $this->input->post('order[0][column]');
		$dir = $this->input->post('order[0][dir]');
		$column = $this->input->post('columns['.$order.'][name]');
		$from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
		$to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
		$date_range = strtolower($this->input->post('date_range'));
		if(!empty($params['search']['value'])) {
			$where .=" AND(title LIKE '%".$params['search']['value']."%' OR short_description LIKE '%".$params['search']['value']."%' OR description LIKE '%".$params['search']['value']."%' OR blog_status LIKE '%".$params['search']['value']."%' OR published_date LIKE '%".$params['search']['value']."%' )";
		}
		if($from_date!='') { $where .= " AND published_date >= '".$from_date."'"; }
		if($to_date!='') { $where .= " AND published_date <= '".$to_date."'"; }
		$sql = "select * from blogs where is_latest!=''";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		if(isset($where) && $where!='') {
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if($params['length']!=-1) {
			$sqlRec .= " ORDER BY blog_id DESC LIMIT " . $params['start'].", ". $params['length']." ";
		} else {
			$sqlRec .= " ORDER BY blog_id DESC";
		}
		$total_blogs = $this->db->query($sql)->num_rows();
		$queryTot = $this->db->query($sqlTot);
		$totalRecords = $queryTot->num_rows();
		$queryRecords = $this->db->query($sqlRec)->result_array();
		// print_a($from_date,1);
		// echo $this->db->last_query();exit;
		if($queryRecords) { foreach ($queryRecords as $k => $data) {
			$row[0] = '<img src="'.base_url('uploads/blogs/'.$data['image']).'" class="img-fluid">';
			$row[1] = word_wrap($data['title'],40);
			$row[2] = date_dmy($data['published_date']);
			$row[3] = '<input type="button" value="Inactive" class="btn btn-danger" id="blog_status_'.$data['blog_id'].'" onclick="update_status(this.value,'.$data['blog_id'].')"/>';
            if ($data['blog_status'] == 'Active') {
                $row[3] = '<input type="button" value="Active" class="btn btn-success" id="blog_status_'.$data['blog_id'].'" onclick="update_status(this.value,'.$data['blog_id'].')"/>';
            }
			$row[4] = '<input type="checkbox" value="Y" class="form-check" id="is_latest_'.$data['blog_id'].'" onclick="update_latest_status(this.value, '.$data['blog_id'].')" />';
			if($data['is_latest'] == 'Y') {
				$row[4] = '<input type="checkbox" value="N" class="form-check" id="is_latest_'.$data['blog_id'].'" checked onclick="update_latest_status(this.value, '.$data['blog_id'].')"/>';
			}
			$row[4] .= '<div id="latest_msg_'.$data['blog_id'].'"></div>';		
            $row[5] = '<a class="text-secondary edit-icon font-20" href="'.site_url(ADMIN.'/blogs_with_fil/add_blog/').$data['blog_id'].'" title="Edit Blog"><i class="mdi mdi-pencil-outline"></i></a> &nbsp;&nbsp;<a class="text-secondary delete-icon font-20" style="cursor:pointer" onclick="delete_data('.$data['blog_id'].');" title="Delete Blog"><i class="mdi mdi-delete-outline"></i></a>';
            $tab_data[] = $row;
		} }
		$json_data = array(
			"draw" 				=> intval($params['draw']),
			"recordsTotal" 		=> intval($totalRecords),
			"recordsFiltered" => intval($totalRecords),
			"total_blogs" => intval($total_blogs),
			"data"              => $tab_data,
		);
		echo json_encode($json_data);
	}
	public function delete_data($blog_id=false){
		if($blog_id !==false) {
			$blog_img = $this->db->query('select * from blogs where blog_id = "'.$blog_id.'"')->row_array();
			@unlink('uploads/blogs/'.$blog_img['image']);
			$this->db->where('blog_id',$blog_id);
			$this->db->delete('blogs');
			$this->session->set_flashdata('success','Deleted Successfully');
		}else{
			$this->session->set_flashdata('error','Try Again');
		}
		redirect(ADMIN.'/blogs_with_fil','refresh');
	}
	public function update_status() {
		$blog_id = $this->input->post('blog_id');
		$blog_status = $this->input->post('blog_status', true);
		$update = array();

		if($blog_status == 'Inactive') {
			$update['blog_status'] = 'Active';
		} else {
			$update['blog_status'] = 'Inactive';
		}

		$html = '';
		if($blog_id != '') {
			$this->db->where('blog_id', $blog_id);
			$result = $this->db->update('blogs', $update);
			if($result) {	
				$html = $update['blog_status'];
			} 
		}
		echo $html;
	}
	public function update_latest_status() {
		$blog_id = $this->input->post('blog_id');
		$update['is_latest'] = $this->input->post('is_latest');
		$update['latest_updated_time'] = date('Y-m-d H:i:s');
		$html = '';
		if($blog_id != '') {
			$this->db->where('blog_id',$blog_id);
			$result = $this->db->update('blogs',$update);
			if($result) {
				if($update['is_latest'] == 'N'){ $html .= 'Y'; } else { $html .= 'N'; }
			} 
		}
		echo $html;
	}
}