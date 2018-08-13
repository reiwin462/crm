<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Google\Cloud\Storage\StorageClient;
require_once(APPPATH.'third_party/sendgrid/SendGrid_loader.php');

class Projectleadcontrol extends CI_Controller{

	public function index(){
		
	}
	
	public function newProjLead(){
		$this->load->model('Projectleadmodel');
		$htm = "";
		$decoded = json_decode($_POST['data'],true);
		$insert = '';
		$prjno = '';
		$newdata = array();
		if(count($decoded) > 0){
			foreach ($decoded as $value) {
				if($value["name"] == "more_info"){
					$insert .= $value["name"] . "='" . addslashes($value["value"])."',";
				}
				elseif($value["name"] == "project_no"){
					$prjno = $value["value"];
					$insert .= $value["name"] . "='" . addslashes($value["value"])."',";
				}
				elseif($value["name"] == "bid_value"){
					$insert .= $value["name"] . "='" .preg_replace("/\.+$/i", "", preg_replace("/[^0-9\.]/i", "", $value["value"]))."',";
				}
				else{
					$insert .= $value["name"] . "='" . addslashes($value["value"])."',";
				}
				$newdata[$value["name"]] = $value["value"];
			}
		}else{
			echo "error on post data";
			exit();
		}
		
		$exist =  $this->Projectleadmodel->checkprjno($prjno);
		if($exist > 0){
			echo "duplicate : ". $prjno;
		}else{
			$htm .= '<h3 style="font-family: Century Gothic; color: green;">New Project Lead</h3>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;"> Created By : '.$this->session->userdata('crmuser').'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">Date :'. date('Y-m-d H:i:s').'</p>';
			$htm .= '<hr>';
			$htm .= '<table border="0" style="font-size: 12px; font-family: Century Gothic">';
			$htm .= '<tr>
							<th style="border:0px solid #e2e2e2; background-color: #ffe693; width: 150px;">Field</th>
							<th style="border:1px solid #e2e2e2; background-color: #ffe693; width: 350px; ">Lead Value</th>
						</tr>';
						
				foreach($newdata as $key=>$val){
						$htm .= '<tr><td style="border-bottom: 1px solid #e2e2e2;">'. str_replace('_',' ', $key).'</td><td style="border-bottom: 1px solid #e2e2e2;">'.$val.'</td></tr>';
					}
			$htm .= '<tr><td></td><td></td></tr>';
			$htm .= '</table>';
			$htm .= '<br>';
			$htm .= '<small style="font-family: Century Gothic">Mail Notification 2018</small>';
			
			$insert .= 'created_by' . "='" . $this->session->userdata('crmuser')."',";
			$insert .= 'created_date' . "='" . date('Y-m-d H:i:s')."',";
			$check = $this->Projectleadmodel->checkprjno($insert);
			
			$isinsert = $this->Projectleadmodel->insertnewprojleads($insert);
			if($isinsert > 0){
				echo $isinsert;
			}else{
				echo "error";
			}
		}
	}
	
	public function showallprojleads($stat = ''){
		$this->load->model('Projectleadmodel');	
		$data =  $this->Projectleadmodel->getprojleads(urldecode($stat));
		$prjleads = array('data' => array());
		if(count($data) > 0){			
			$innerarray =  array();
			
			foreach($data as $row){		
					$wb = "";			
				foreach($row as $key=>$val){
					if(strlen($val) == 0){
						$tdval = "blank";
					}elseif($key == "link"){
						$wb = $val;
						$tdval = "";
					}elseif($key == "action"){
						
						$tdval .= "<button class='btn btn-primary' onclick=\"projleadupdate('".$val."')\">
									<i class='fa fa-tv' aria-hidden='true' style='font-size:16px' data-toggle='tooltip' title='Preview Lead'></i>
								</button> 
								<button class='btn btn-warning' onclick=\"projleadmanage('".$val."')\">
									<i class='fa fa-bars' aria-hidden='true' style='font-size:16px' data-toggle='tooltip' title='Manage Lead'></i>
								</button>
								 <a href='". base_url('projectleadpreview?projectid='.$val)."' class='btn btn-danger' target='_blank'>
									<i class='fa fa-eye' aria-hidden='true' style='font-size:16px' data-toggle='tooltip' title='Preview 2'></i>
								</a>";
						if($wb <> ""){
							if (strrpos($wb, "http") === false) { 
								$tdval .= " <a href='".'http://'.$wb."' class='btn btn-success' target='_blank'>
									<i class='fa fa-link' aria-hidden='true' style='font-size:16px' data-toggle='tooltip' title='Link to Lead'></i>
								</button>";
							}else{
								$tdval .= " <a href='".$wb."' class='btn btn-success' target='_blank'>
									<i class='fa fa-link' aria-hidden='true' style='font-size:16px' data-toggle='tooltip' title='Link to Lead'></i>
								</a>";
							}
						}
					
					}else{
						$tdval = $val;
					}
					if($key == "bid_value"){
						$newinnerarray[] = number_format($tdval,2);
					}else{
						if($key === "link"){
							$tdval = "";
						}else{
							$newinnerarray[] = $tdval;
						}
						
					}
					
				}
				array_push($prjleads['data'], $newinnerarray);			
				$newinnerarray = array();
				$innerarray = array();
			}
		}else{
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			$newinnerarray[] = "<td>No Data Available</td>";
			array_push($prjleads['data'], $newinnerarray);		
		}
		
		echo json_encode($prjleads);
	}
	
	public function getleaddetail($leadid){
		if($leadid != ""){
			$this->load->model('Projectleadmodel');
			$lead = $this->Projectleadmodel->getleaddata(trim($leadid));
			echo json_encode($lead);
		}
	}
	
	public function projleadupdate(){

		$this->load->model('Projectleadmodel');
		$decoded = json_decode($_POST['data'],true);
		$update = '';
		$id = '';
		//$uparray = array();
		
		foreach ($decoded as $value) {
			if($value["name"] != "id"){
				if($value["name"] == "bid_value"){
					$update .= $value["name"] . "='" . preg_replace("/\.+$/i", "", preg_replace("/[^0-9\.]/i", "", $value["value"])) ."',";
				}else{
					$update .= $value["name"] . "='" . addslashes($value["value"])."',";
				}
			}
			
			else{
				$id = addslashes($value["value"]);
			}
			$uparray[$value["name"]] = $value["value"];
		}
		$lead = $this->Projectleadmodel->getleaddata($id);
		
		$update .= 'modified_by' . "='" . $this->session->userdata('crmuser')."',";
		$update .= 'modified_date' . "='" . date('Y-m-d H:i:s')."',";
		$htm = "";

		$isupdate = $this->Projectleadmodel->updateprojlead(rtrim($update,",").  "where id = '".trim($id)."'");
		if($isupdate > 0){
			echo "success";
		}else{
			echo "error";
		}
		
		$result=array_diff($uparray,$lead[0]);
		if(count($result) > 0){
			
			$htm .= '<h3 style="font-family: Century Gothic;">Field Update</h3>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;"> Updated By : '.$this->session->userdata('crmuser').'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">Date :'. date('Y-m-d H:i:s').'</p>';
			$htm .= '<hr>';
			$htm .= '<table border="0" style="font-size: 12px; font-family: Century Gothic">';
			$htm .= '<tr>
						<th style="border:0px solid #e2e2e2; background-color: #ffe693; width: 150px;">Field</th>
						<th style="border:1px solid #e2e2e2; background-color: #ffe693; width: 350px; ">Updated Value</th>
					</tr>';
					
			foreach($result as $key=>$val){
				$htm .= '<tr><td style="border-bottom: 1px solid #e2e2e2;">'. str_replace('_',' ', $key).'</td><td style="border-bottom: 1px solid #e2e2e2;">'.$val.'</td></tr>';
			}
			$htm .= '<tr><td></td><td></td></tr>';
			$htm .= '</table>';
			$htm .= '<br>';
			$htm .= '<small style="font-family: Century Gothic">Mail Notification 2018</small>';
			//echo $htm;
			
			$this->sendemail('Project Lead Notification', $lead[0]['created_by'], $htm);
		}
		

	}
	
	public function statupdate($id){
		
		$this->load->model('Projectleadmodel');
		$update = '';
		$stts = $_POST['data']['lead_status'];

		$lead = $this->Projectleadmodel->getleaddata($id);
		
		$update = "lead_status" . "='" .$stts."',";
		$update .= 'modified_by' . "='" . $this->session->userdata('crmuser')."',";
		$update .= 'modified_date' . "='" . date('Y-m-d H:i:s')."',";
		$htm = "";
		

		$isupdate = $this->Projectleadmodel->updateprojlead(rtrim($update,","). "where id = '".trim(urldecode($id))."'");
		if($isupdate > 0){
			echo "success";
		}else{
			echo "error";
		}
		
		/*
			$htm .= '<h3 style="font-family: Century Gothic;">Field Update</h3>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;"> Updated By : '.$this->session->userdata('crmuser').'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">Date :'. date('Y-m-d H:i:s').'</p>';
			$htm .= '<hr>';
			$htm .= '<table border="0" style="font-size: 12px; font-family: Century Gothic">';
			$htm .= '<tr>
						<th style="border:0px solid #e2e2e2; background-color: #ffe693; width: 150px;">Field</th>
						<th style="border:1px solid #e2e2e2; background-color: #ffe693; width: 350px; ">Updated Value</th>
					</tr>';
					
			$htm .= '<tr>
						<td>'."Lead Status".'</td>
						<td>'.$stts.'</td>
					</tr>';
			$htm .= '<tr><td></td><td></td></tr>';
			$htm .= '</table>';
			$htm .= '<br>';
			$htm .= '<small style="font-family: Century Gothic">Mail Notification 2018</small>';
			//echo $htm;
			$this->sendemail('Project Lead Notification', $lead[0]['created_by'], $htm);
		*/
		
	}
	
	public function projleadremove($id){
		$htm = "";
		if($id != ""){
			$this->load->model('Projectleadmodel');
			$lead = $this->Projectleadmodel->getleaddata($id);
			
			$htm .= '<h3 style="font-family: Century Gothic; color:red;">Lead Deletion</h3>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;"> Removed By : '.$this->session->userdata('crmuser').'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">Date :'. date('Y-m-d H:i:s').'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">'.'Project Code : '.$lead[0]['project_no'].'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">'.'Client : '.$lead[0]['client_name'].'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">'.'Bid Value : '.$lead[0]['bid_value'].'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">'.'Created By : '.$lead[0]['created_by'].'</p>';
			$htm .= '<br>';
			$htm .= '<small style="font-family: Century Gothic">Mail Notification 2018</small>';
			
			$isremove = $this->Projectleadmodel->delprojlead($id);
			
			if($isremove > 0){
				echo "success";
			}else{
				echo "error";
			}
			
			$this->sendemail('Project Lead Notification', $lead[0]['created_by'], $htm);			
		
		}else{
			echo  "invalid";
		}
	}
	
	public function insertdocument(){
				
		$docu = array('project_id' => trim($this->input->post('id')),
				'doc_filename' => trim(addslashes($_POST['data'][0]['value'])),
				'doc_keywords' =>  trim(addslashes($_POST['data'][1]['value'])),
				'doc_Content' =>  trim(addslashes($_POST['data'][2]['value'])),
				'created_by' => $this->session->userdata('crmuser'),
				'created_date' => date('Y-m-d H:i:s'),
				);
		$this->load->model('Projectleadmodel');
		$isdocuinsert = $this->Projectleadmodel->insertdocu($docu);
		if($isdocuinsert > 0){
			echo "success";
		}else{
			echo "error";
		}
	}
	
	public function getdocument($projid){
		$htm = "";
		if(!isset($projid)){
			echo "error";
		}else{
			$this->load->model('Projectleadmodel');
			$doc = $this->Projectleadmodel->getdocudata(urldecode($projid));
			if(count($doc) > 0 ){
				foreach ($doc as $key=>$val){
					
					$htm .= '<br><div class="widget stats-widget">
					<footer class="widget-footer bg-primary">
						<span>'.$this->timeAgo($val['created_date']).'</span>
						<small class="float-right">     :         '.$val['created_by'].' </small>
					</footer>
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h4 class="widget-title text-primary">'.$val['doc_filename'].'</h4>
							<small class="text-primary">[ '.$val['doc_keywords'].' ]</small>
							<p class="">'.$val['doc_Content'].'</p>
						</div>
						<span class="pull-right big-icon watermark"><i class="fa fa-briefcase" aria-hidden="true"></i></i></span>
					</div>
				</div>';
				}				
			}else{
				$htm = "<br>". '<h3 class="text-center">No Available Document to Preview</h3>';
			}
		}
		echo $htm;
	}
	
	public function getrfi($leadid){
		if($leadid != ""){
			$this->load->model('Projectleadmodel');
			$lead = $this->Projectleadmodel->getrfidata(trim($leadid));
			echo json_encode($lead);
		}
	}
	
	public function getplan($projid){
		$htm = "<div class='row'>";
		if(!isset($projid)){
			echo "error";
		}else{
			$this->load->model('Projectleadmodel');
			$doc = $this->Projectleadmodel->getplandata(urldecode($projid));
			$i = 1;
			if(count($doc) > 0 ){
				foreach ($doc as $key=>$val){
					
					$img = substr(trim($val['filename_type']), 0, 5);
					if($img == "image"){
						$fav = '<i class="fa fa-image "></i>';
						//$htm .= "<a href='https://storage.googleapis.com/steve-unified/".$val['filename_path']."'' target='_blank'><img class='fancy' src='https://storage.googleapis.com/steve-unified/".$val['filename_path']."' width='100px' height='100px'></a>";	
						$htm .= "<div class='img-with-text d-inline'>";
						$htm .= "<a href='#' class='btnclose' onclick='removeattachment(".trim($val['id']).");'><i class='fa fa-close'></i></a>";
						$htm .= "<img src='https://storage.googleapis.com/steve-unified/".$val['filename_path']."' width='100px' height='100px' onclick='showme($(this));'>";
						$htm .= "<small class='caption text-center'> ".$val['filename']." </small>";
						$htm .= "</div>";
					}else{
						$fav = '<i class="fa fa-file-alt"></i>'; 
						$htm .= "<div class='img-with-text d-inline'>";
						$htm .= "<a href='#' class='btnclose' onclick='removeattachment(".trim($val['id']).");'><i class='fa fa-close'></i></a>";
						$htm .= "<a href='https://storage.googleapis.com/steve-unified/".$val['filename_path']."'' target='_blank'><img class='fancy' src='../assets/images/pdf.png' width='100px' height='100px'></a>";
						$htm .= "<small class='caption  text-center'> ".$val['filename']." </small>";
						$htm .= "</div>";
					}
					$i++;
				}
			}else{
				$htm = "<br>". "<h3>No available File to Preview</h3>";
			}
		}
		$htm .= "</div>";
		echo $htm;
	}
	
	public function planupload(){
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
			$storage = new StorageClient(['projectId' => 'steve-unified','keyFilePath' => './key.json']);
			$file = fopen($file_tmp, 'r');
			$bucket = $storage->bucket("steve-unified");
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
		
		if(!$iserror == ""){
			echo "error ". $iserror;
		}else{
			$data = array(
				"project_id"	=> $this->input->post('leadid'),
				"filename"		=> addslashes($name),
				"filename_path"	=> $attachment_filename,
				"filename_type"	=> $attach_type,
				"created_by"	=> $this->session->userdata('crmuser'),
				"created_date"	=> date('Y-m-d H:i:s'),
			);
			$this->load->model('Projectleadmodel');
			$isplaninsert = $this->Projectleadmodel->insertplan($data);
			
			if($isplaninsert > 0){
				echo "success";
			}else{
				echo "error insert";
			}
		}
		
		/*
		$html .= "<td><a href='https://storage.googleapis.com/steve-unified/$row->attachment' target='_blank'>DOWNLOAD</a></td>";
		https://storage.googleapis.com/steve-unified/9a6d4756fcce0geogrout.jpg
		*/

	}
	
	public function planremove(){
		$id = $this->input->post('planid');
		$this->load->model('Projectleadmodel');
		$rm = $this->Projectleadmodel->delprojplan($id);
		if($rm > 0){
			echo "success";
		}else{
			echo "error";
		}
		
	}
	
	public function insertnewrfi(){

		$this->load->model('Projectleadmodel');
		$htm = "";
		$decoded = json_decode($_POST['data'],true);
		$rfiarray = array();
		$id="";
		$action = "";
		if(count($decoded) > 0){
			foreach ($decoded as $value) {
				if($value["name"] == "id"){
					if($value["value"] <> ""){
						$id=$value["value"];
						$action = "update";
					}else{
						$action = "insert";
					}
				}else{
					$rfiarray[$value["name"]] = addslashes($value["value"]);
				}
			}
			$rfiarray['project_id'] = $this->input->post('id');
			$rfiarray['created_by'] = $this->session->userdata('crmuser');
			$rfiarray['created_date'] = date('Y-m-d H:i:s');
			
			if($action == "insert"){
				$insertupdate = $this->Projectleadmodel->insertrfi($rfiarray);
			}else{
				$insertupdate = $this->Projectleadmodel->updaterfi($rfiarray, $id);	
			}
			if($insertupdate > 0){
				echo "success";
			}else{
				echo "error";
			}
		}else{
			echo "error on post data";
		}
	}
	
	function sendemail($sbj, $to, $msg){
		
		try {
			$sendgrid = new SendGrid\SendGrid('sendgriduser', 'sendgridpass');
			$mail = new SendGrid\Mail();

			$mail->addTo($to)->
				   setFrom('mynotification007@gmail.com')->
				   setSubject($sbj)->
				   setText(strip_tags($msg))->
				   setHtml($msg);
				   $sendgrid->send($mail);
					
		} catch (InvalidArgumentException $e) {
			///echo 'There was an error'. $e;
		}
		
		/* send via codeigniter library
			$this->load->library('email');
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'_smtp_auth' => TRUE,
				'smtp_port' => 465,
				'smtp_user' => 'mynotification007@gmail.com',
				'smtp_pass' => 'user@123',
				'mailtype'  => 'html',
				'smtp_timeout' => '60',
			);
			
			$this->email->initialize($config);
			$this->email->set_mailtype("html");
			$this->email->set_newline("\r\n");
			
			$this->email->to($to);
			$this->email->from('mynotification007@gmail.com','Notification');
			$this->email->subject($sbj);
			$this->email->message($msg);

			//Send email
			$this->email->send();
			//echo $this->email->print_debugger();
		*/

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
	
	public function timeAgo($time_ago){
		
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