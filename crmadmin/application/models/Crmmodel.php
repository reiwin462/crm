<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crmmodel extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}
	
	public function showleadstructure(){
		$leadarray = array();
		$query = $this->db->query("SHOW FULL FIELDS FROM crm_leads");
		
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
	
	public function getSubitems($query){
		$descarr = array();
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			$descarr = $query->result_array();
		}
		return $descarr;
	}
	
	public function insertnewlead($postdata){
		$this->db->query('insert into crm_leads set '. rtrim($postdata,","));
		$insertid = $this->db->insert_id();
		$insertdate = date("Y-m-d H:i:s");
		$inInserted = ($this->db->affected_rows() != 1) ? false : true;
		$insertarray = array(
				'lead_id' => $insertid ,
				'category' => 'NEW LEAD', 
				'title' =>  'NEW LEAD',
				'TEXT' => 'New Lead has been Registered to the System',
				'created_by' => 'SYSTEM',
				'created_datetime' => $insertdate,);
		$this->insertcrmnote($insertarray);
		return $inInserted;
	}
	
	public function updateLead($pdata){	
		$this->db->query("update crm_leads set  ". $pdata);
		return $this->db->affected_rows();
	}
	
	public function deleteLead($id){
		$rw = trim($id);
		if(is_numeric($rw) != false){
			$this->db->where('id', $rw);
			$this->db->delete('crm_leads');
			$upd = $this->db->affected_rows();
			if($upd > 0){
				return "success";
			}else{
				return "failed";
			}
		}else{
			return "error";
		}
		
	}
	
	public function getleaddata($rw){
		$leads = array();
		
		$this->db->where('id',  trim($rw));
		$query = $this->db->get('crm_leads');
		if($query->num_rows() > 0){

			foreach($query->result_array() as $row){				
				foreach($row as $key=>$val){				
					if (strlen($val) == 0){
							$val = "blank";
					}
					$newinnerarray[$key] = $val;
				}
				array_push($leads, $newinnerarray);			
				$newinnerarray = array();
			}
		}
		return $leads;
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
		if(trim($fld) != ""){
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
	
	
	public function insertnewcampaign($postdata){
		$this->db->query('insert into crm_campaign set '. rtrim($postdata,","));
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	
	public function shownewleadstructure(){
		$query = $this->db->query("SELECT lead_owner, first_name, lastname, title, phone,  lead_status,  state, website, '' AS action FROM  `crm_leads` ORDER BY id");
		return $query->result();
	}
	
	public function getleads(){
		
		$leads = array('data' => array());
		$leadsdata = array();
		$string = "";
		$query = $this->db->query("SELECT lead_owner, first_name, lastname, title, phone,  lead_status,  state, website, id AS action FROM  `crm_leads` ORDER BY id");
		
		if($query->num_rows() > 0){
			$innerarray =  array();
			foreach($query->result_array() as $row){				
				foreach($row as $key=>$val){
					//$string.="$key:$val,";
					//$leadsdata.push($key => $val);
		
					if(strlen($val) == 0){
						$tdval = "blank";
					}elseif($key == "action"){
						$tdval = "<button class='btn btn-primary' onclick=\"leadupdate('".$val."')\">Preview</button> 
								<button class='btn btn-danger' onclick=\"leaddelete('".$val."')\">Delete</button>";
					}else{
						$tdval = $val;
					}
					
					$newinnerarray[] = $tdval;
				}
				array_push($leads['data'], $newinnerarray);			
				$newinnerarray = array();
				$innerarray = array();
			}
		}
		return $leads;
	}
	
	public function insertcrmnote($arr){
		$this->db->insert('crm_notes', $arr);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function showactivitylog($lead){
		$query = $this->db->get_where('crm_notes', array('lead_id' => $lead));
		return $query->result();
	}
	
	public function getleadstatus(){
		$query = $this->db->query('SELECT description FROM `crm_lead_status`');
		return $query->result();
	}
	
	public function getdispoleads($dispo){
		
		$leads = array('data' => array());
		$leadsdata = array();
		$string = "";
		$query = $this->db->query("SELECT lead_owner, first_name, lastname, title, phone,  lead_status,  state, website, id AS action FROM  `crm_leads` where  lead_status='".trim($dispo)."' ORDER BY id");
		
		if($query->num_rows() > 0){
			$innerarray =  array();
			foreach($query->result_array() as $row){				
				foreach($row as $key=>$val){
					//$string.="$key:$val,";
					//$leadsdata.push($key => $val);
		
					if(strlen($val) == 0){
						$tdval = "blank";
					}elseif($key == "action"){
						$tdval = "<button class='btn btn-primary' onclick=\"leadupdate('".$val."')\">Update</button> 
								<button class='btn btn-danger' onclick=\"leaddelete('".$val."')\">Delete</button>";
					}else{
						$tdval = $val;
					}
					
					$newinnerarray[] = $tdval;
				}
				array_push($leads['data'], $newinnerarray);			
				$newinnerarray = array();
				$innerarray = array();
			}
		}
		return $leads;
	}
	
	public function getdropdowns(){
		$query = $this->db->query("SHOW FULL FIELDS FROM `crm_leads` WHERE COMMENT REGEXP 'DROPDOWN'");
		return $query->result();
	}
	
	public function getoptions($fld){
		$tbl = "crm_".trim($fld);
		$query = $this->db->query("SELECT id,description FROM ". $tbl);
		return $query->result();
	}
	
	public function removeselectoption($tbl, $fld){
		$this->db->where('id', trim($fld));
		$this->db->delete($tbl); 	
		$rw = $this->db->affected_rows();
		if($rw > 0){
				return "success";
			}else{
				return "error";
			}
	}

}