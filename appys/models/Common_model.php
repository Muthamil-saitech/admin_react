<?php //echo $this->db->last_query(); 
class Common_model extends CI_Model {
    public function __construct() {
	    parent::__construct();
	}
	public function insert_data($data,$tablename) {
		$this->db->insert($tablename, $data);
		if($this->db->affected_rows()) return $this->db->insert_id(); else return false;
    }
	public function select_data($tablename,$id=false,$columnname=false) {  
		$this->db->select('*');
		$this->db->from($tablename);
		if($id!=false) $this->db->where($columnname, $id);
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result(); else return false;
    }
	public function select_one_data($tablename,$id=false,$columnname=false) {  
		$this->db->select('*');
		$this->db->from($tablename);
		if($id!=false) $this->db->where($columnname, $id);
		$this->db->limit(1);		
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->row(); else return false;
    }
	public function check_ifexists($tablename,$colname,$email) {
		$this->db->where($colname, $email);
		return $this->db->count_all_results($tablename);
	} 
	public function get_array_data($tablename,$val,$colname,$id) {
		$this->db->select('*');
		$this->db->from($tablename);
		if($colname!='') $this->db->where($colname, $val);
		$datas = $this->db->get()->result_array();
		$all_datas = array();
		foreach($datas as $data) {
			$all_datas[$data[$id]] = $data;
		}
		return $all_datas;
	}
	public function update_data($data,$tablename,$id=false,$columnname=false) {
		$this->db->where($columnname, $id);
		$this->db->update($tablename, $data);
		if($this->db->affected_rows()) return true; else return false;
	}
	public function check_data_exists($tablename,$field,$value,$field2=false,$value2=false) { 
		if($field2!=false) $this->db->where($field2,$value2);
		$this->db->where($field,$value);
		return $this->db->count_all_results($tablename);
	}
	public function check_unique_entry($tablename, $id_field, $field, $value, $id=false,  $field2=false, $value2=false) {
		$sql = "SELECT ".$id_field." FROM ".$tablename." WHERE ".$field." = '".$value."'";
		if($field2 != false && $field2 != '' && $value2 != false && $value2 != '') {
			$sql .= " AND ".$field2." = ".$value2;
		}
		if($id != false && $id != '') {
			$sql .= " AND ".$id_field." != ".$id;
		}
		$check_column_sql = "SHOW COLUMNS FROM " . $tablename . " LIKE 'is_deleted'";
		$column_exists = $this->db->query($check_column_sql)->num_rows();
		
		if ($column_exists > 0) {
			$sql .= " AND is_deleted = 'N'";
		}
		$sql .=  " LIMIT 1";
		/* print_a($sql,1); */
		$check = $this->db->query($sql)->num_rows();
		return $check;
	}
}