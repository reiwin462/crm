<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contactmodel extends CI_Model{
	
	function __construct() {
		$this->load->database();
	}
	
	public function insertnewcontact($postdata){
		$this->db->query('insert into crm_contacts set '. rtrim($postdata,","));
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function getcontact(){
		$query = $this->db->query("SELECT contact_name, email, lead_source , phone, Title, Mobile, Date_of_Birth, id AS action FROM `crm_contacts` order by id desc");
		return $query->result_array();
	}
	

	public function getcontactdata($rw){
		$this->db->where('id',  trim($rw));
		$query = $this->db->get('crm_contacts');
		return $query->result_array();
	}
	
	public function updatecontact($pdata){	
		$this->db->query("update crm_contacts set  ". $pdata);
		return $this->db->affected_rows();
	}
	
	public function deletecontact($id){
		$this->db->where('id', trim($id));
		$this->db->delete('crm_contacts');
		$upd = $this->db->affected_rows();
		return $upd;
	}
	
	

	
	
}