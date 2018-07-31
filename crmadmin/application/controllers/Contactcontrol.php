<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contactcontrol extends CI_Controller{

	public function index(){
		
	}
	
	public function contactinsert(){
		$decoded = json_decode($_POST['data'],true);
		$insert = '';
		foreach ($decoded as $value) {
		   $insert .= $value["name"] . "='" . addslashes($value["value"])."',";
		}
		$insert .= 'created_by' . "='" . $this->session->userdata('crmuser')."',";
		$insert .= 'created_date' . "='" . date('Y-m-d H:i:s')."',";
		
		$this->load->model('Contactmodel');
		$ininsert = $this->Contactmodel->insertnewcontact($insert);
		if($ininsert > 0){
			echo "success";
		}else{
			echo "error";
		}
	}
	
	public function showallcontact(){
		$this->load->model('Contactmodel');
		$contact = $this->Contactmodel->getcontact();
			$ctc = array('data' => array());
		if(count($contact) > 0){ 
			$innerarray =  array();
			foreach($contact as $row){				
				foreach($row as $key=>$val){
					if(strlen($val) == 0){
						$tdval = "blank";
					}elseif($key == "action"){
						$tdval = "<button class='btn btn-primary' onclick=\"contactupdate('".$val."')\">
									<i class='fa fa-tv' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Preview Item'></i>
								</button> 
								<button class='btn btn-danger' onclick=\"contactdelete('".$val."')\">
									<i class='fa fa-trash-o' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Delete Item'></i>
								</button>";
					}else{
						$tdval = $val;
					}
					$newinnerarray[] = $tdval;
				}
				array_push($ctc['data'], $newinnerarray);			
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
			$newinnerarray[] = '<td>No Data Available</td>';
			
			array_push($ctc['data'], $newinnerarray);
		}
		echo json_encode($ctc);
	
	
	}
	
	public function getcontactdetail($campaignid){
		if($campaignid != ""){
			$this->load->model('Contactmodel');
			$lead = $this->Contactmodel->getcontactdata(trim($campaignid));
			echo json_encode($lead);
		}
	}
	
	public function contactupdate(){
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
		$update .= 'modified_date' . "='" . date('Y-m-d H:i:s')."',";
		
		$this->load->model('Contactmodel');
		$isUpdate =  $this->Contactmodel->updatecontact(rtrim($update,","). "where id = '".trim($id)."'");
		if($isUpdate > 0){
			echo "success";
		}else{
			echo "error";
		}
	}
	
	public function contactremove($id){
		if($id != ""){
			$this->load->model('Contactmodel');
			$leaddel = $this->Contactmodel->deletecontact($id);
			if($leaddel > 0){
				return "success";
			}else{
				return "failed";
			}
			
			
		}else{
			echo  "invalid";
		}
	}
	
	
	
	
}