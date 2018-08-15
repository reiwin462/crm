<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashmodel extends CI_Model{
	
	function __construct() {
		$this->load->database();
	}
	
	public function leadcount(){
		$query = $this->db->query("SELECT  lead_status, COUNT(lead_status) AS cnt FROM `project_leads` GROUP BY lead_status");
		return $query->result();
	}
	
	public function getforbid(){
		$query = $this->db->query("SELECT bid_date, project_name, client_name,  lead_status, sales_representative, type_of_work, lead_source, created_by, id FROM project_leads WHERE
									bid_date BETWEEN  DATE_FORMAT(NOW() ,'%Y-%m-01') AND DATE_FORMAT(NOW() ,'%Y-%m-31') order by bid_date AND lead_status not in('WON', 'DEAD') desc");
		return $query->result();
	}
	
	public function topengineer(){
		$query = $this->db->query('SELECT a.created_by, (SELECT fullname FROM auth_accounts WHERE username = a.created_by LIMIT 1) AS fullname,
									COUNT(a.created_by) as cnt, SUM(bid_value) AS bidvalue FROM project_leads AS a
									GROUP BY a.created_by ORDER BY bidvalue DESC');
		return $query->result();
	}
	
	public function topworktype(){
		$query = $this->db->query("SELECT type_of_work, COUNT(type_of_work) AS workcount FROM project_leads  WHERE
					bid_date BETWEEN  DATE_FORMAT(NOW() ,'%Y-%m-01') AND DATE_FORMAT(NOW() ,'%Y-%m-31') GROUP BY type_of_work");
		return $query->result();
	}
	
	
}