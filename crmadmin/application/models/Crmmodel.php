<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crmmodel extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}
	
	public function gettablestructure($tablename){
		$leadarray = array();
		if(trim($tablename) != ""){
			$query = $this->db->query("SHOW FULL FIELDS FROM ".$tablename);
			
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
					if($row->Comment != ""){
						$fielddata = explode("|", $row->Comment);
						$subitems = array();
						if(trim($fielddata[2]) != "NONE"){
							$subitems = $this->getSubitems(trim($fielddata[2]));
						}
						$newleadarray = array(
						'field_name' => $row->Field,
						'field_type' => trim($fielddata[1]),
						'field_datatype' => $row->Type,
						'field_default' => $row->Default,
						'field_required' => trim($fielddata[0]),
						'field_subitems' => $subitems,
						);
						
						array_push($leadarray, $newleadarray);
						$subitems = array();
						$newleadarray = array();
					}
				}
			}
		}
		
		return $leadarray;
	}
	
	
	public function getSubitems($query){
		$descarr = array();
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			$descarr = $query->result_array();
		}
		return $descarr;
	}
	
	
	
	public function getLeadCol(){
		$query = $this->db->list_fields('crm_leads');
		return $query;
	}
	
	public function getprimaryColumn(){
		$data = array();
		$query = $this->db->query('SHOW FULL FIELDS FROM `crm_leads`');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				if($row->Comment != ""){
					$data[] = $row->Field;
				}
			}
		}
		return $data;
	}
	
	
	public function addselectopt($fld, $val){
		if(trim($fld) != "null"){
			$tbl = "crm_".trim($fld);
			$data = array('description' => trim(addslashes($val)));
			$this->db->insert($tbl ,$data);
			$rw = $this->db->affected_rows();
			if($rw > 0){
				return "success";
			}else{
				return "error";
			}
		}else{	
			return "invalid";
		}
	}
	
	public function uploadlead($data){
		$this->db->insert('crm_leads', $data);
		$inInserted = ($this->db->affected_rows() != 1) ? false : true;
		$insertid = $this->db->insert_id();
		$insertdate = date("Y-m-d H:i:s");	
		$insertarray = array(
				'lead_id' => $insertid ,
				'category' => 'NEW LEAD VIA BATCH UPLOAD', 
				'title' =>  'NEW LEAD  BATCH UPLOAD',
				'TEXT' => 'New Lead via batch upload has been Registered to the System',
				'created_by' => 'SYSTEM',
				'created_datetime' => $insertdate,);
		$this->db->insert('crm_notes', $insertarray);
		return $inInserted;
	}
	
	
	public function showcampaignstructure(){
		
		$leadarray = array();
		$query = $this->db->query("SHOW FULL FIELDS FROM crm_campaign");
		
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				
				if($row->Comment != ""){
					$fielddata = explode("|", $row->Comment);
					$subitems = array();
					if(trim($fielddata[2]) != "NONE"){
						$subitems = $this->getSubitems(trim($fielddata[2]));
					}
					
					$newleadarray = array(
					'field_name' => $row->Field,
					'field_type' => trim($fielddata[1]),
					'field_datatype' => $row->Type,
					'field_default' => $row->Default,
					'field_required' => trim($fielddata[0]),
					'field_subitems' => $subitems,
					);
					
					array_push($leadarray, $newleadarray);
					$subitems = array();
					$newleadarray = array();
				}
			}
		}
		return $leadarray;
	}
	
	public function authenticate($usracct){
		$query = $this->db->get_where('auth_accounts', $usracct);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return "error";
		}
	}
	
	public function apiauthenticate($usracct){
		$query = $this->db->query("SELECT * FROM `auth_accounts` WHERE MD5(username) = '".$usracct."' ORDER BY id DESC LIMIT 1");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return "error";
		}
	}
	
	
	
	
}