<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Google\Cloud\Storage\StorageClient;

class Leadcontrol extends CI_Controller{

	public function index(){
		echo "controller for Leads";
	}
	
	public function newlead(){
		$decoded = json_decode($_POST['data'],true);
		$insertdate = date("Y-m-d H:i:s");
		$insert = '';
		foreach ($decoded as $value) {
		   $insert .= $value["name"] . "='" . addslashes($value["value"])."',";
		}
		$insert .= "create_by='".$this->session->userdata('crmuser')."', create_datetime='".date('Y-m-d H:i:s')."',";
		

		$this->load->model('Leadmodel');
		
		$insertid = $this->Leadmodel->insertnewlead($insert);
		echo $insertid;
		
		$notearray = array(
				'lead_id' => $insertid ,
				'category' => 'NEW LEAD', 
				'title' =>  'NEW LEAD',
				'TEXT' => 'New Lead has been Registered to the System',
				'created_by' => $this->session->userdata('crmuser'),
				'created_datetime' => $insertdate);
		$this->Leadmodel->insertleadcrmnote($notearray);
	
	}
	
	public function leaddropdownoption($fld){
		$html ="";
		$this->load->model('Leadmodel');
		$option = $this->Leadmodel->getoptions(urldecode($fld));
		foreach($option as $key=>$val){
			$html .='<tr>
						<td>'.$val->description.'</td>
						<td>
							<button class="btn btn-sm danger" onclick="removeitem('.$val->id.')">
								<i class="fa fa-trash-o" aria-hidden="true" style="font-size:18px" data-toggle="tooltip" title="" data-original-title="Delete Item"></i>
								Remove
							</button>
						</td>
					</tr>';
		}
		echo $html;
	}
	
	public function deleteoption($table, $fld){
		$this->load->model('Leadmodel');
		$isdelete = $this->Leadmodel->removeselectoption("crm_".urldecode($table), urldecode($fld));
		if($isdelete > 0){
			return "success";
		}else{
			return "error";
		}
	}
	
	public function showallleads(){
		$this->load->model('Leadmodel');
		$leadrecord = $this->Leadmodel->getleads();
		//echo json_encode($lead);
		
		$leads = array('data' => array());
		if(count($leadrecord) > 0){
			$innerarray =  array();
			foreach($leadrecord as $row){				
				foreach($row as $key=>$val){
					if(strlen($val) == 0){
						$tdval = "blank";
					}elseif($key == "action"){
						$tdval = "<button class='btn btn-primary' onclick=\"leadupdate('".$val."')\">
									<i class='fa fa-tv' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Preview Item'></i>
								</button> 
								<button class='btn btn-danger' onclick=\"leaddelete('".$val."')\">
									<i class='fa fa-trash-o' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Delete Item'></i>
								</button>";
					}else{
						$tdval = $val;
					}
					$newinnerarray[] = $tdval;
				}
				array_push($leads['data'], $newinnerarray);			
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
			$newinnerarray[] = '<td>No Data Available</td>';
			
			array_push($leads['data'], $newinnerarray);		
		}
		echo json_encode($leads);
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
		$update .= 'modified_by' . "='" . $this->session->userdata('crmuser')."',";
		$update .= 'modified_datetime' . "='" . date('Y-m-d H:i:s')."',";
		
		$this->load->model('Leadmodel');
		$isup = $this->Leadmodel->updateLead(rtrim($update,","). "where id = '".trim($id)."'");
		if($isup > 0){
			echo "success";
		}else{
			echo "error";
		}
	}
	
	public function leaddelete($id){
		if($id != ""){
			$this->load->model('Leadmodel');
			$lead = $this->Leadmodel->deletelead($id);
			if($lead > 0){
				echo "success";
			}else{
				echo "error";
			}
		}else{
			echo  "invalid";
		}
	}
	
	public function getleadinfo($rw){
		$this->load->model('Leadmodel');
		$leads = array();
		if(strlen($rw)> 10 ){
			echo "error";
		}else{
			$leadinfo = $this->Leadmodel->getleaddata($rw);
				
			if(count($leadinfo) > 0){
				foreach($leadinfo as $row){				
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
		}
		echo json_encode($leads);
	}
	
	
	function noteinsert(){
		$insertdate = date("Y-m-d H:i:s");
		if(isset($_FILES["file"]))
		{
			$album = $_POST['noteid'];
				$iserror = "";
				$attachment_filename = "";
				$attach_type = "";
			
				if($_FILES['file']['error'] == 0) {
					if($_FILES['file']['size'] > 10000000) {
						$iserror =  "error file size";
						echo "error " . $iserror;
						exit();
					}
									
					$acceptable = array(
						'application/vnd.ms-excel',
						'application/msword',
						'application/pdf',
						'image/jpeg',
						'image/jpg',
						'image/gif',
						'image/png',
						'image/gif'
						);
									
					if(!in_array($_FILES['file']['type'], $acceptable) && !empty($_FILES["file"]["type"])) {
						$iserror =  "error invalid filename";
						echo "error " . $iserror;
						exit();
					}
					
					$uniq = $this->uniqidReal();
					$name = $_FILES['file']['name'];  
					$file_tmp =$_FILES['file']['tmp_name'];  
									
					/*if(!move_uploaded_file($file_tmp, $original)) {
						die();
					}*/
					$storage = new StorageClient(['projectId' => 'steve-db','keyFilePath' => './key.json']);
					$file = fopen($file_tmp, 'r');
					$bucket = $storage->bucket("steve-db-storage");
					$oldobject = $bucket->object($uniq.$name);
					if($oldobject->exists()) {
						$iserror =  "error The file already exist in our server";
						echo "error " . $iserror;
						exit();
					}
					$object = $bucket->upload($file, [
						'name' => $uniq.$name
					]);
					$attachment_filename = $uniq.$name;
					$attach_type = $_FILES["file"]["type"];
				}
				
				$insertarray = array(
							'lead_id' => $_POST['noteid'],
							'category' => $_POST['notecategory'], 
							'title' =>  $_POST['notesubject'],
							'TEXT' => $_POST['message'],
							'file_attachment' =>  addslashes($_FILES['file']['name']),
							'path' =>  $attachment_filename,
							'created_by' => $this->session->userdata('crmuser'),
							'created_datetime' => $insertdate,);
							
				if($iserror == "") {
					
					$this->load->model('Leadmodel');
					$noteinsert = $this->Leadmodel->insertcrmnote($insertarray);
					if($noteinsert > 0){
						echo "successfully inserted to cloud";
					}else{
						echo "error commenting";
					}
					
				} else{
					
					$insertarray = array(
							'lead_id' => addcslashes($_POST['noteid']),
							'category' => addcslashes($_POST['notecategory']), 
							'title' =>  addcslashes($_POST['notesubject']),
							'TEXT' => addcslashes($_POST['message']),
							'created_by' => $this->session->userdata('crmuser'),
							'created_datetime' => $insertdate,);
					
					$this->load->model('Leadmodel');
					$noteinsert = $this->Leadmodel->insertcrmnote($insertarray);
					if($noteinsert > 0){
						echo "successfully inserted";
					}else{
						echo "error commenting";
					}
				}
				
		}else{
					$insertarray = array(
							'lead_id' => $_POST['noteid'],
							'category' => $_POST['notecategory'], 
							'title' =>  $_POST['notesubject'],
							'TEXT' => $_POST['message'],
							'created_by' => $this->session->userdata('crmuser'),
							'created_datetime' => $insertdate,);
					
					$this->load->model('Leadmodel');
					$noteinsert = $this->Leadmodel->insertcrmnote($insertarray);
					if($noteinsert > 0){
						echo "successfully inserted";
					}else{
						echo "error commenting";
					}
		}			
	}
	
	
	function noteinsert_local(){
		$insertdate = date("Y-m-d H:i:s");
		if(isset($_FILES["file"]["name"]))
		{
			$album = $_POST['noteid'];
			try {
				
				$path = './uploads/'.$album.'/';
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
							'created_by' => $this->session->userdata('crmuser'),
							'created_datetime' => $insertdate,);
					
					$this->load->model('Leadmodel');
					$noteinsert = $this->Leadmodel->insertcrmnote($insertarray);
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
							'created_by' => $this->session->userdata('crmuser'),
							'created_datetime' => $insertdate,);
					
					$this->load->model('Leadmodel');
					$noteinsert = $this->Leadmodel->insertcrmnote($insertarray);
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
							'created_by' => $this->session->userdata('crmuser'),
							'created_datetime' => $insertdate,);
					
					$this->load->model('Leadmodel');
					$noteinsert = $this->Leadmodel->insertcrmnote($insertarray);
					if($noteinsert > 0){
						echo "successfully inserted";
					}else{
						echo "error commenting";
					}
		}			
	}
	
	public function gettimeline($lead){
		$htm = "";
		$this->load->model('Leadmodel');
		$act = $this->Leadmodel->showactivitylog($lead);
		foreach($act as $key=>$val){
			/*
			$htm .= '<div class="sl-item sl-primary">
				<div class="sl-content">
					<small class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;'.$val->created_datetime.'</small>
					<p>'.$val->created_by.'  wrote : ' .$val->text.'</p>
					
				</div>
			</div>';
			*/
			$htm .= '
			<div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading " role="tab" id="heading'.$val->id.'">
							<a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$val->id.'" aria-expanded="false" aria-controls="'.$val->id.'">
								<h4 class="panel-title ">
								<i class="fa fa-sticky-note-o" aria-hidden="true"></i> NOTES : '.$val->title.'</h4>
								<div>
								</div>
									<i class="fa acc-switch"></i>
							</a>
							
						</div>
						<div id="'.$val->id.'" class="panel-collapse" role="tabpanel" aria-labelledby="heading'.$val->id.'" aria-expanded="false" style="">
							<div class="panel-body">
								<small class="text-muted">Posted :['. $this->timeAgo($val->created_datetime)  .'] </small>
								<p>'.$val->created_by. " wrote : " .$val->text.'</p>
								<span>Attached Document : <a href="https://storage.googleapis.com/steve-db/'.$val->path.'" target="_blank">'.$val->file_attachment.'</a></span>
							</div>
						</div>
					</div>
			</div>
			';
		}
		echo $htm;
	}
	
	public function showdispoleads($dispo){
		$this->load->model('Leadmodel');
		$leadrw = $this->Leadmodel->getdispoleads(urldecode($dispo));
		//header('Content-Type: application/json');
		//echo json_encode($lead);
		$leads = array('data' => array());
		$leadsdata = array();
		if(count($leadrw) > 0){
			$innerarray =  array();
			foreach($leadrw as $row){				
				foreach($row as $key=>$val){
					if(strlen($val) == 0){
						$tdval = "blank";
					}elseif($key == "action"){
						$tdval = "<button class='btn btn-primary' onclick=\"leadupdate('".$val."')\">
								<i class='fa fa-tv' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Preview Item'></i>
								</button> 
								<button class='btn btn-danger' onclick=\"leaddelete('".$val."')\">
									<i class='fa fa-trash-o' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Delete Item'></i>
								</button>";
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
		echo json_encode($leads);
		
	}

	public function leadpreview($id){
		if(!isset($id)){
			echo "nothing to return here";
		}else{
			$this->load->model('Formbuildermodel');
			$this->load->model('Leadmodel');
			$this->load->model('Crmmodel');			
			$structure = $this->Crmmodel->gettablestructure('crm_leads');
			$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'crm_leads', 'no','lead');
			//$data['lead'] =   json_encode($this->Leadmodel->getleaddata($id));
			
			
			$this->load->view('leads/leadpreview',$data);
		}
	}
	
	public function uniqidReal($lenght = 13) {
		if (function_exists("random_bytes")) {
			$bytes = random_bytes(ceil($lenght / 2));
		} elseif (function_exists("openssl_random_pseudo_bytes")) {
			$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		} else {
			throw new Exception("no cryptographically secure random function available");
		}
		return substr(bin2hex($bytes), 0, $lenght);
	}
	
	public function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}
	
	
	
}