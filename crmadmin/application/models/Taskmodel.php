<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taskmodel extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}
	
	public function insertnewtask($postdata){
		$this->db->query('insert into crm_task set '. rtrim($postdata,","));
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function gettask($lead){
		$this->db->where('lead_id', trim($lead));
		$query = $this->db->get('crm_task');
		return $query->result();
	}
	
	
}