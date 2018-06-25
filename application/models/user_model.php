<?php
class User_model extends CI_Model {
	    //put your code here
	public function __construct() {
		parent::__construct();
	}

	public function insert_data($data) {
		$sql = $this->db->insert('tbl_user', $data);
//        $s = $this->db->last_query();
//        echo $s;
//        die;
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_user_list($firstname){
		$sql ="select * from tbl_user";
		if(!empty($firstname)){
			$sql = $sql ." where user_firstname LIKE '%" . $firstname . "%'";
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_user($firstname, $sort_type, $sort_field, $limit, $start_from){
		$sql ="select * from tbl_user";
		$fn='';
		if(!empty($firstname)){
			$fn.= " where user_firstname LIKE '%" . $firstname . "%'";
		}

	   	if (!empty($fn)) {
            $sql = $sql . $pn;
        }

		$orderby = '';
        if (!empty($sort_type) && !empty($sort_field)) {
            $orderby.=" ORDER BY $sort_field $sort_type";
        }
        if (!empty($orderby)) {
            $sql = $sql . $orderby;
        } else {
            $sql = $sql . " ORDER BY user_id DESC";
        }
        $sql = $sql . " limit $start_from,$limit ";

		$query = $this->db->query($sql);
		return $query->result_array();
	}

}