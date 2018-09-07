<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emailmodel extends CI_Model{
	
	function __construct() {
		$this->load->database();
	}
	
	public function emailist(){
		$query = $this->db->query('SELECT DISTINCT email FROM `email_accounts`');
		return $query->result();
	}
	
	public function inserttotable($tbl, $arr){
		$this->db->insert($tbl, $arr);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function getemailaccountlist(){
		$query = $this->db->query("SELECT  email, fullname, comment, created_by, id  from email_accounts order by id desc");
		return $query->result_array();
	}
	
	public function delelemaillist($id){
		$rw = trim($id);
		$this->db->where('id', $rw);
		$this->db->delete('email_accounts');
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function insertnewemail($insert){
		$this->db->query('insert into email_accounts set ' . $insert );
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	
	
}