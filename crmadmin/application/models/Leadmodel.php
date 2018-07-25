<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Leadmodel extends CI_Model{
	
	function __construct() {
		$this->load->database();
	}
	
	public function insertnewlead($postdata){
		
		$insertqry = 'insert into crm_leads set '. rtrim($postdata,",");
	
		$this->db->query($insertqry);
		$insertid = $this->db->insert_id();
		return $insertid;
	}
	
	public function insertleadcrmnote($arr){
		$this->db->insert('crm_notes', $arr);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function getoptions($fld){
		$tbl = "crm_".trim($fld);
		$query = $this->db->query("SELECT id,description FROM ". $tbl);
		return $query->result();
	}
	
	public function removeselectoption($tbl, $fld){
		$this->db->where('id', trim($fld));
		$this->db->delete($tbl); 	
		return $this->db->affected_rows();
	}
	
	public function getdropdowns(){
		$query = $this->db->query("SHOW FULL FIELDS FROM `crm_leads` WHERE COMMENT REGEXP 'DROPDOWN'");
		return $query->result();
	}
	
	public function getleadcol(){
		$query = $this->db->query("SELECT lead_owner as owner, first_name as 'first name', lastname as 'last name', title, phone,  lead_status as 'status',  state, website, '' AS action FROM  `crm_leads` ORDER BY id");
		return $query->result();
	}
	
	public function getleads(){
		$query = $this->db->query("SELECT lead_owner, first_name, lastname, title, phone,  lead_status,  state, website, id AS action FROM  `crm_leads` ORDER BY id");	
		return $query->result_array();
	}
	
	public function updateLead($pdata){	
		$this->db->query("update crm_leads set  ". $pdata);
		return $this->db->affected_rows();
	}
	
	public function deleteLead($id){
		$this->db->where('id', $id);
		$this->db->delete('crm_leads');
		return $this->db->affected_rows();
	}
	
	public function getleaddata($rw){
		$this->db->where('id',  trim($rw));
		$query = $this->db->get('crm_leads');
		return $query->result_array();
	}
	
	public function insertcrmnote($arr){
		$this->db->insert('crm_notes', $arr);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function showactivitylog($lead){
		$query = $this->db->get_where('crm_notes', array('lead_id' => $lead));
		return $query->result();
	}

	public function getdispoleads($dispo){
		$query = $this->db->query("SELECT lead_owner, first_name, lastname, title, phone,  lead_status,  state, website, id AS action FROM  `crm_leads` where  lead_status='".trim($dispo)."' ORDER BY id");
		return $query->result_array();
	}
	
	public function getleadstatus(){
		$query = $this->db->query('SELECT description FROM `crm_lead_status`');
		return $query->result();
	}
	
	
}