<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigncontrol extends CI_Controller{

	public function index(){
		
	}
	
	
	public function campaignInsert(){
		$decoded = json_decode($_POST['data'],true);
		$insert = '';
		foreach ($decoded as $value) {
		   $insert .= $value["name"] . "='" . addslashes($value["value"])."',";
		}	
			$insert .= 'created_by' . "='" . $this->session->userdata('crmuser') ."',";
			$insert .= 'created_datetime' . "='" . date('Y-m-d H:i:s')."',";

		$this->load->model('Campaignmodel');
		$isInsert = $this->Campaignmodel->insertnewcampaign($insert);
		if($isInsert > 0){
			echo "success";
		}else{
			echo "error";
		}
	}
	
	public function showallcampaign(){
		$this->load->model('Campaignmodel');
		$camprow = $this->Campaignmodel->getcampaigns();
		$campaign = array('data' => array());
		if(count($camprow) > 0){
			$innerarray =  array();
			foreach($camprow as $row){				
				foreach($row as $key=>$val){
		
					if(strlen($val) == 0){
						$tdval = "blank";
					}elseif($key == "action"){
						$tdval = "<button class='btn btn-primary' onclick=\"campaignupdate('".$val."')\">
								<i class='fa fa-tv' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Preview Item'></i>
								</button> 
								<button class='btn btn-danger' onclick=\"campaigndelete('".$val."')\">
								<i class='fa fa-trash-o' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Delete Item'></i>
								</button>";
					}else{
						$tdval = $val;
					}
					$newinnerarray[] = $tdval;
				}
				array_push($campaign['data'], $newinnerarray);			
				$newinnerarray = array();
				$innerarray = array();
			}
		}else{
			$newinnerarray[] = '<td>No Data Available</td>';
			$newinnerarray[] = '<td>No Data Available</td>';
			$newinnerarray[] = '<td>No Data Available</td>';
			$newinnerarray[] = '<td>No Data Available</td>';
			$newinnerarray[] = '<td>No Data Available</td>';
			$newinnerarray[] = '<td>No Data Available</td>';
			$newinnerarray[] = '<td>No Data Available</td>';
			
			array_push($campaign['data'], $newinnerarray);	
		}
		echo json_encode($campaign);
	}
	
	public function getcampaigndetail($campaignid){
		if($campaignid != ""){
			$this->load->model('Campaignmodel');
			$lead = $this->Campaignmodel->getcampaigndata(trim($campaignid));
			echo json_encode($lead);
		}
	}
	
	public function campaignupdate(){
		$decoded = json_decode($_POST['data'],true);
		$update = '';
		$id = '';
		foreach ($decoded as $value) {
			if($value["name"] != "id"){
				$update .= $value["name"] . "='" . addslashes($value["value"])."',";
			}else{
				$id = addslashes($value["value"]);
			}
		}
		$update .= 'modified_by' . "='" . $this->session->userdata('crmuser')."',";
		$update .= 'modified_datetime' . "='" . date('Y-m-d H:i:s')."',";	
		$this->load->model('Campaignmodel');
		$isupdate = $this->Campaignmodel->updatecampaign(rtrim($update,","). "where id = '".trim($id)."'");
		if($isupdate > 0){
			echo "success";
		}else{
			echo "error";
		}
	}
	
	public function campaignremove($id){
		if($id != ""){
			$this->load->model('Campaignmodel');
			$isdelete = $this->Campaignmodel->deletecampaign(urldecode($id));
			if($isdelete > 0){
				echo "success";
			}else{
				echo "error";
			}
		}else{
			echo  "invalid";
		}
	}

	
}