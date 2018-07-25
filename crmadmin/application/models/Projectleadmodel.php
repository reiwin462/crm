<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projectleadmodel extends CI_Model{
	
	function __construct() {
		$this->load->database();
	}
	
	public function insertnewprojleads($postdata){
		$this->db->query('insert into project_leads set '. rtrim($postdata,","));
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function getprojcol(){
		$query = $this->db->query("SELECT proj_no, client_name, bid_value, proj_stat, created_by, id as action from project_leads");
		return $query->result();
	}
	public function getprojleads(){
		$query = $this->db->query("SELECT proj_no, client_name, bid_value, proj_stat, created_by, id as action from project_leads");
		return $query->result_array();
	}
	
	public function getleaddata($rw){
		$this->db->where('id',  trim($rw));
		$query = $this->db->get('project_leads');
		return $query->result_array();
	}
	
	public function updateprojlead($pdata){	
		$this->db->query("update project_leads set  ". $pdata);
		return $this->db->affected_rows();
	}
	
	public function delprojlead($id){
		$rw = trim($id);
		$this->db->where('id', $rw);
		$this->db->delete('project_leads');
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	
	
}