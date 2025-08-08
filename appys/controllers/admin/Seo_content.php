<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Seo_content extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index() {
		$data['page_name'] = 'seo_content';
		$this->view('seo_content',$data);
	}
	public function load_data() {
		$params = $columns = $totalRecords = $tab_data = array();
		$params = $_REQUEST;
		$where = $sqlTot = $sqlRec = ""; $where_psearch = '';
		$order = $this->input->post('order[0][column]');
		$dir = $this->input->post('order[0][dir]');
		$column = $this->input->post('columns['.$order.'][name]');
		if(!empty($params['search']['value'])) { 
			$where .=" AND (page LIKE '%".$params['search']['value']."%' OR page_name LIKE '%".$params['search']['value']."%' OR page_link LIKE '%".$params['search']['value']."%' OR meta_title LIKE '%".$params['search']['value']."%' OR meta_description LIKE '%".$params['search']['value']."%')";
		}
		$sql = "SELECT * FROM seo_content WHERE id != ' '";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		if(isset($where) && $where != '') {
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if($params['length']!=-1)
			$sqlRec .=  " ORDER BY id DESC LIMIT ".$params['start']." ,".$params['length']." ";
		else
			$sqlRec .=  " ORDER BY id DESC";
		$total_seo_content = $this->db->query($sql)->num_rows();
		$queryTot = $this->db->query($sqlTot);
		$totalRecords = $queryTot->num_rows();
		$queryRecords = $this->db->query($sqlRec)->result_array();
		if($queryRecords) { foreach($queryRecords as $k => $data) {
			$row[0] = $data['page_name'];
			$row[1] = $data['page_link'];
			$row[2] = word_wrap($data['meta_title'],40);
			$row[3] = '<a class="text-secondary edit-icon font-20" href="'.site_url(ADMIN.'/seo_content/add_seo/').$data['id'].'" title="Edit SEO Content"><i class="mdi mdi-pencil-outline"></i></a>';
			$tab_data[] = $row;
		} }
		$json_data = array(
			"draw"            => intval($params['draw']),   
			"recordsTotal"    => intval($totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"total_seo_content" => intval($total_seo_content),
			"data"            => $tab_data
		);
		echo json_encode($json_data);
	}
	public function add_seo($id=false) {
		if($id != false) { 
			$data['page_name'] = 'edit_seo';
			$data['row'] = $this->db->get_where('seo_content', array('id' => $id))->row_array();			
		} else {
			$data['page_name'] = 'add_seo';
		}
		$this->view('add_seo',$data);
	}
	public function edit() {
		//print_a($_POST,1);
		$id = $this->input->post('id');
		$this->form_validation->set_rules('page_name', 'Page Name', 'trim|required|callback_alpha_string|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('page_link', 'Page Link', 'trim|required|callback_alpha_and_hypen');
		$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required|callback_alpha_dash_space_banner_title|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required|callback_alpha_dash_space_desc|min_length[10]|max_length[300]');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('posted',$_POST);
			$this->session->set_flashdata('error',validation_errors());
			redirect(ADMIN.'/seo_content/add_seo/'. $id,'refresh');
		} else { 
			$insert['page_name'] = ucwords($this->input->post('page_name'));
			$insert['page_link'] = strtolower($this->input->post('page_link'));
			$insert['page'] = strtolower(str_replace(' ','_',$insert['page_name']));
			$insert['meta_title'] = $this->input->post('meta_title');
			$insert['meta_description'] = $this->input->post('meta_description');
			$insert['updated_time'] = date('Y-m-d H:i:s');
			$check_unique_entry = $this->Common_model->check_unique_entry('seo_content', 'id', 'page_link', $insert['page_link'], $id);
			if ($check_unique_entry > 0) {
				$this->session->set_flashdata('posted',$_POST);
				$this->session->set_flashdata('error',' Page Link already exists!');
				redirect(ADMIN.'/seo_content/add_seo/'. $id,'refresh');
			} else {
				$insert_data = $this->security->xss_clean($insert);
				if($id != false) {
					$this->db->where('id', $id);
					$this->db->update('seo_content', $insert_data);
					$this->session->set_flashdata('success','Updated Successfully!');
				} else {
					$this->db->insert('seo_content', $insert_data);
					$this->session->set_flashdata('success','Added Successfully!');
				}	
				redirect(ADMIN.'/seo_content','refresh');
			}
		}
	}
}