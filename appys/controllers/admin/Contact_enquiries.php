<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Contact_enquiries extends Admin_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function index(){
		$data['page_name'] = 'contact_enquiries';
		$this->view('contact_enquiries',$data);
	}
	public function load_data() {
		$params = $columns = $totalRecords = $tab_data = array();
		$params = $_REQUEST;
		$where = $sqlTot = $sqlRec = ""; $where_psearch = '';
		$order = $this->input->post('order[0][column]');
		$dir = $this->input->post('order[0][dir]');
		$column = $this->input->post('columns['.$order.'][name]');
		if(!empty($params['search']['value'])) { 
			$where .=" AND (person_name LIKE '%".$params['search']['value']."%' OR person_email LIKE '%".$params['search']['value']."%' OR mobile_no LIKE '%".$params['search']['value']."%' OR subject LIKE '%".$params['search']['value']."%')";
		}
		$sql = "SELECT * FROM contact_enquiries WHERE enq_id != ' '";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		if(isset($where) && $where != '') {
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if($params['length']!=-1)
			$sqlRec .=  " ORDER BY enq_id DESC LIMIT ".$params['start']." ,".$params['length']." ";
		else
			$sqlRec .=  " ORDER BY enq_id DESC";
		$total_contact_enquiries = $this->db->query($sql)->num_rows();
		$queryTot = $this->db->query($sqlTot);
		$totalRecords = $queryTot->num_rows();
		$queryRecords = $this->db->query($sqlRec)->result_array();
		// print_a($queryRecords,1);
		if($queryRecords) { foreach($queryRecords as $k => $data) {
			$row[0] = $data['person_name'];
			$row[1] = $data['mobile_no'];
			$row[2] = $data['person_email'];
			$row[3] = $data['subject'];
			$row[4] = '<a class="text-secondary delete-icon font-20" style="cursor:pointer" onclick="delete_contact_enquiries('.$data['enq_id'].');" title="Delete Contact Enquiry"><i class="mdi mdi-delete-outline"></i></a>';
			$tab_data[] = $row;
		} }
		$json_data = array(
			"draw"            			=> intval($params['draw']),   
			"recordsTotal"    			=> intval($totalRecords ),  
			"recordsFiltered" 			=> intval($totalRecords),
			"total_contact_enquiries" 	=> intval($total_contact_enquiries),
			"data"            			=> $tab_data
		);
		echo json_encode($json_data);
	}
	public function delete_contact_enquiries($enq_id = false){
		if($enq_id != false) {
			$this->db->where('enq_id', $enq_id);
			$this->db->delete('contact_enquiries');
			$this->session->set_flashdata('success','Deleted Successfully!');
		} else {
			$this->session->set_flashdata('error','Try Again');
		}
		redirect(ADMIN.'/contact_enquiries','refresh');
	}
}