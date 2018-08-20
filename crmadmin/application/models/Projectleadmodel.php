<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projectleadmodel extends CI_Model{
	
	function __construct() {
		$this->load->database();
	}
	
	public function insertnewprojleads($postdata){
		$this->db->query('insert into project_leads set '. rtrim($postdata,","));
		//return ($this->db->affected_rows() != 1) ? false : true;
		return $this->db->insert_id();
		
	}
	public function getprojcol(){
		$query = $this->db->query("SELECT help, project_no, lead_status, bid_date, sales_representative, project_name, type_of_work, address, bid_value, lead_source, created_by, link, id as action from project_leads order by  bid_date asc");
		return $query->result();
	}
	
	public function getprojleads($stat){
		
		if($stat == "ALL" or $stat == ""){
			//$query = $this->db->query("SELECT project_no, lead_status, bid_date, sales_representative, project_name, type_of_work, address, bid_value, lead_source, created_by, link, id as action from project_leads order by  bid_date asc");
			/*
			*$query = $this->db->query("SELECT a.id, project_no, lead_status, bid_date, sales_representative, a.project_name, type_of_work,address, bid_value, 
					lead_source, a.created_by, link, a.id AS ACTION, b.id AS planid, c.id docuid, d.id AS rfiid
					FROM project_leads AS a LEFT OUTER JOIN `tblplan` AS b 
					ON  b.project_id  = a.id LEFT OUTER JOIN `tbldocuments` AS c ON c.project_id = a.id
					LEFT OUTER JOIN `project_rfi` AS d ON d.project_id = a.id GROUP BY a.id
					ORDER BY  bid_date ASC
					 ");
			*/
			$query = $this->db->query("SELECT a.help, a.id, a.project_no, a.lead_status, a.bid_date, a.sales_representative, a.project_name, 
										a.type_of_work,address, a.bid_value, a.lead_source, a.created_by, a.link, a.id AS ACTION,
										(SELECT COUNT(id) FROM tblplan WHERE project_id = a.id) AS planid, 
										(SELECT COUNT(id) FROM tbldocuments WHERE project_id = a.id) AS docuid, 
										(SELECT COUNT(id) FROM project_rfi WHERE project_id = a.id) AS rfiid
										FROM project_leads AS a where a.lead_status not in ('WON', 'DEAD')   ORDER BY  bid_date ASC");
			
		}else{
			//$query = $this->db->query("SELECT project_no, lead_status, bid_date, sales_representative, project_name, type_of_work, address, bid_value, lead_source, created_by, link, id as action from project_leads where lead_status = '". $stat. "' order by bid_date asc");
			/*
			$query = $this->db->query("SELECT a.id, project_no, lead_status, bid_date, sales_representative, a.project_name, type_of_work,address, bid_value, 
					lead_source, a.created_by, link, a.id AS ACTION, b.id AS planid, c.id docuid, d.id AS rfiid
					FROM project_leads AS a LEFT OUTER JOIN `tblplan` AS b 
					ON  b.project_id  = a.id LEFT OUTER JOIN `tbldocuments` AS c ON c.project_id = a.id
					LEFT OUTER JOIN `project_rfi` AS d ON d.project_id = a.id where a.lead_status = '".$stat."' GROUP BY a.id 
					ORDER BY  bid_date ASC
					 ");
			*/
			$query = $this->db->query("SELECT a.help, a.id, a.project_no, a.lead_status, a.bid_date, a.sales_representative, a.project_name, 
										a.type_of_work,address, a.bid_value, a.lead_source, a.created_by, a.link, a.id AS ACTION,
										(SELECT COUNT(id) FROM tblplan WHERE project_id = a.id) AS planid, 
										(SELECT COUNT(id) FROM tbldocuments WHERE project_id = a.id) AS docuid, 
										(SELECT COUNT(id) FROM project_rfi WHERE project_id = a.id) AS rfiid
										FROM project_leads AS a  where lead_status = '".$stat."' ORDER BY  bid_date ASC");
			
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

	public function insertdocu($docuarray){
		$this->db->insert("tbldocuments", $docuarray);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function insertplan($planarray){
		$this->db->insert("tblplan", $planarray);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function getdocudata($rw){
		$query = $this->db->get_where('tbldocuments', array('project_id' => trim($rw)));
		return $query->result_array();
	}
	
	public function getplandata($rw){
		$query = $this->db->get_where('tblplan', array('project_id' => trim($rw)));
		return $query->result_array();
	}
	
	public function delprojplan($id){
		$rw = trim($id);
		$this->db->where('id', $rw);
		$this->db->delete('tblplan');
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function deldocument($id){
		$rw = trim($id);
		$this->db->where('id', $rw);
		$this->db->delete('tbldocuments');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function insertrfi($rfiarray){
		$this->db->insert("project_rfi", $rfiarray);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function updaterfi($rfiarray, $id){
		$this->db->where('id', $id);
		$this->db->update("project_rfi", $rfiarray);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function getrfidata($lead){
		$this->db->select('*');
		$this->db->from('project_rfi');
		$this->db->where('project_id',  trim($lead));
		$this->db->order_by('id','DESC');
		$this->db->limit(1,0);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	public function is_project_exist($tbl, $id){
		$query = $this->db->get_where($tbl, array('project_id' => $id));
		if($query->num_rows() > 0){
			return "exist";
		}else{
			return "missing";
		}
	}
	
	public function updatemytable($tbl, $arr, $id){
		
		if($tbl === trim("project_leads")){
			$this->db->where('id', $id);
		}else{
			$this->db->where('project_id', $id);
		}
		$this->db->update($tbl, $arr);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function inserttotable($tbl, $arr){
		$this->db->insert($tbl, $arr);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function gethtmltable($tbl, $id){
		$query = $this->db->query("select list from ". trim($tbl) . " where project_id = '".trim($id)."' order by id desc limit 1");
		return $query->result();
	}
	
	
	

	
	
	
}