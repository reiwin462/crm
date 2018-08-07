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
		$query = $this->db->query("SELECT project_no, lead_description, bid_date, sales_officer, client_name, type_of_work, address, bid_value, lead_source, created_by, website, id as action from project_leads");
		return $query->result();
	}
	
	public function getprojleads($stat = ""){
		
		if($stat == "ALL" or $stat == ""){
			$query = $this->db->query("SELECT project_no, lead_description, bid_date, sales_officer, client_name, type_of_work, address, bid_value, lead_source, created_by, website, id as action from project_leads order by bid_date asc");
		}else{
			$query = $this->db->query("SELECT project_no, lead_description, bid_date, sales_officer, client_name, type_of_work, address, bid_value, lead_source, created_by, website, id as action from project_leads where lead_description = '". $stat. "' order by bid_date asc");
		}
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
	
	public function checkprjno($no){
		$query = $this->db->get_where('project_leads', array('project_no'=>$no));
		return $query->num_rows();
	}  
	
	
	
}