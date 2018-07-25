<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Campaignmodel extends CI_Model{
	
	function __construct() {
		$this->load->database();
	}
	
	public function insertnewcampaign($postdata){
		$this->db->query('insert into crm_campaign set '. rtrim($postdata,","));
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function getcampaigns(){
		$query = $this->db->query("SELECT campaign_name, campaign_type, campaign_status, expected_revenue, budgeted_cost, actual_cost, id as action FROM `crm_campaign` order by id");
		return $query->result_array();
	}
	
	public function getcampaigndata($rw){
		$this->db->where('id',  trim($rw));
		$query = $this->db->get('crm_campaign');
		return $query->result_array();
	}
	
	public function updatecampaign($pdata){	
		$this->db->query("update crm_campaign set  ". $pdata);
		return $this->db->affected_rows();
	}
	
	public function deletecampaign($id){
		$this->db->where('id', trim($id));
		$this->db->delete('crm_campaign');
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	
	
	
}