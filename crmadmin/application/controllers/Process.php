<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index(){
		
	}
	
	public function leadinsert(){
		$decoded = json_decode($_POST['data'],true);
		$insert = '';
		foreach ($decoded as $value) {
		   $insert .= $value["name"] . "='" . addslashes($value["value"])."',";
		}	
		$this->load->model('Crmmodel');
		echo $this->Crmmodel->insertnewlead($insert);
	}
	
	public function leadupdate(){
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

		$this->load->model('Crmmodel');
		echo $this->Crmmodel->updateLead(rtrim($update,","). "where id = '".trim($id)."'");
		//echo $update . " where id='".trim($id )."'";
	}
	
	public function leaddelete($id){
		if($id != ""){
			$this->load->model('Crmmodel');
			echo $lead = $this->Crmmodel->deletelead($id);
		}else{
			echo  "invalid";
		}
	}
	
	public function newitem($field, $value){
		if($value != ""){
			$this->load->model('Crmmodel');
			echo $lead = $this->Crmmodel->addselectopt($field, urldecode($value));
		}else{
			echo  "invalid";
		}
	}
	
	public function showallleads(){
		$this->load->model('Crmmodel');
		$lead = $this->Crmmodel->getleads();
		//header('Content-Type: application/json');
		echo json_encode($lead);
	}
	
	public function getLeadCol(){
		$this->load->model('Crmmodel');
		$lead = $this->Crmmodel->getLeadCol();
		echo json_encode($lead);
	}
	
	public function getleadinfo($rw){
		$this->load->model('Crmmodel');
		if(strlen($rw)> 10 ){
			echo "error";
		}else{
			echo json_encode($this->Crmmodel->getleaddata($rw));
		}
	}
	
	
	public function campaignInsert(){
	
		$decoded = json_decode($_POST['data'],true);
		$insert = '';
		foreach ($decoded as $value) {
		   $insert .= $value["name"] . "='" . addslashes($value["value"])."',";
		}	
		$this->load->model('Crmmodel');
		echo $this->Crmmodel->insertnewcampaign($insert);
	
	}
	
	function noteinsert(){
		$insertdate = date("Y-m-d H:i:s");
		if(isset($_FILES["file"]["name"]))
		{
			$album = $_POST['noteid'];
			try {
				
				//$path = './uploads/'.$album.'/';
				$path = 'gs://steve-crm.appspot.com';
				
				$config['allowed_types'] = 'gif|jpg|png|docx|doc|xls|xlsx';
				if (!is_dir($path))
				{
					mkdir($path, 0777, true);
				}
				$dir_exist = true; 
				if (!is_dir($path))
				{
					mkdir('./uploads/' . $album, 0777, true);
					$dir_exist = false; 
				}
				$xpath = $path . basename( $_FILES['file']['name']);
				if(move_uploaded_file($_FILES['file']['tmp_name'], $xpath)) {
					$insertarray = array(
							'lead_id' => $_POST['noteid'],
							'category' => $_POST['notecategory'], 
							'title' =>  $_POST['notesubject'],
							'TEXT' => $_POST['message'],
							'file_attachment' =>  basename( $_FILES['file']['name']),
							'path' =>  $xpath,
							'created_by' => 'mojo',
							'created_datetime' => $insertdate,);
					
					$this->load->model('Crmmodel');
					$noteinsert = $this->Crmmodel->insertcrmnote($insertarray);
					if($noteinsert > 0){
						echo "successfully inserted";
					}else{
						echo "error commenting";
					}
				} else{
					
					$insertarray = array(
							'lead_id' => $_POST['noteid'],
							'category' => $_POST['notecategory'], 
							'title' =>  $_POST['notesubject'],
							'TEXT' => $_POST['message'],
							'created_by' => 'mojo',
							'created_datetime' => $insertdate,);
					
					$this->load->model('Crmmodel');
					$noteinsert = $this->Crmmodel->insertcrmnote($insertarray);
					if($noteinsert > 0){
						echo "successfully inserted";
					}else{
						echo "error commenting";
					}
				}
				
			}catch(Exception $e) {
			  echo 'error:' .$e->getMessage();
			}
		}else{
					$insertarray = array(
							'lead_id' => $_POST['noteid'],
							'category' => $_POST['notecategory'], 
							'title' =>  $_POST['notesubject'],
							'TEXT' => $_POST['message'],
							'created_by' => 'mojo',
							'created_datetime' => $insertdate,);
					
					$this->load->model('Crmmodel');
					$noteinsert = $this->Crmmodel->insertcrmnote($insertarray);
					if($noteinsert > 0){
						echo "successfully inserted";
					}else{
						echo "error commenting";
					}
		}		
		
		
	}
	
	public function gettimeline($lead){
		$htm = "";
		$this->load->model('Crmmodel');
		$act = $this->Crmmodel->showactivitylog($lead);
		foreach($act as $key=>$val){
			$htm .= '<div class="sl-item sl-primary">
				<div class="sl-content">
					<small class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;'.$val->created_datetime.'</small>
					<p>'.$val->created_by.'  wrote : ' .$val->text.'</p>
					<span>Attachment : <a href="..'.$val->path.'">'.$val->file_attachment.'</a></span>
				</div>
			</div>';
		}
		echo $htm;
	}
	
	public function showdispoleads($dispo){
		$this->load->model('Crmmodel');
		$lead = $this->Crmmodel->getdispoleads(urldecode($dispo));
		//header('Content-Type: application/json');
		echo json_encode($lead);
	}
	
	public function showdropdownoption($fld){
		$html ="";
		$this->load->model('Crmmodel');
		$option = $this->Crmmodel->getoptions(urldecode($fld));
		foreach($option as $key=>$val){
			$html .='<tr>
						<td>'.$val->description.'</td>
						<td>
							<button class="danger" onclick="removeitem('.$val->id.')"> Remove</button>
						</td>
					</tr>';
		}
		echo $html;
	}
	
	public function deleteoption($table, $fld){
		$this->load->model('Crmmodel');
		$isdelete = $this->Crmmodel->removeselectoption("crm_".urldecode($table), urldecode($fld));
		echo $isdelete;
	}
	
	
}

