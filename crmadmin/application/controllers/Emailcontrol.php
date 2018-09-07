<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Google\Cloud\Storage\StorageClient;
require_once(APPPATH.'third_party/sendgrid/SendGrid_loader.php');

class Emailcontrol extends CI_Controller{
	
	public function index(){
		
	}
	
	public function sendmymail(){
	
		$to = $this->input->post('e_to');
		$cc = $this->input->post('e_cc');
		$bcc = $this->input->post('e_bcc');
		$subj = $this->input->post('e_subj');
		$msg = $this->input->post('e_msg');
		$att = $this->input->post('e_attach');
		$id = $this->input->post('id');
		$projectid = $this->input->post('e_projid');
		
		if($id == ""){
			echo $this->sendemail($subj, $to, $cc, $bcc, $msg,$att,$projectid);
		}else{
			echo $this->sendemail($subj, $to, $cc, $bcc, $msg,$att,$projectid) . "|". $id;
		}
		
	}
	
	public function newUpload(){


		$iserror = "";
		$attachment_filename = "";
		$attach_type = ""; 
		
		$bucketname = $this->config->item('gcp_bucket_name');
		$bucketproject = $this->config->item('gcp_bucket_project_name'); 
		$bucketlink = $this->config->item('gcp_bucket_link'); 

	
		if($_FILES['mailfile']['error'] == 0) {
			if($_FILES['mailfile']['size'] > 20000000) {
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
							
			if(!in_array($_FILES['mailfile']['type'], $acceptable) && !empty($_FILES["mailfile"]["type"])) {
				$iserror =  "error invalid filename";
				echo "error " . $iserror;
				exit();
			}
			
			$uniq = $this->uniqidReal();
			$name = $_FILES['mailfile']['name'];  
			$file_tmp =$_FILES['mailfile']['tmp_name'];  
							
			/*if(!move_uploaded_file($file_tmp, $original)) {
				die();
			}*/
			
			$storage = new StorageClient(['projectId' => $bucketproject,'keyFilePath' => './key.json']);
			$file = fopen($file_tmp, 'r');
			$bucket = $storage->bucket($bucketname);
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
			$attach_type = $_FILES["mailfile"]["type"];
			
			
			echo '<div><i class="fa fa-close" onclick="removeme($(this));" ></i><a href="'.$bucketlink.$attachment_filename.'" target="_blank" alt="'.$bucketlink.$attachment_filename.'|'.$name.'"> &nbsp;'.$name.'</a></div>';
		}
					
		/*
		$html .= "<td><a href='https://storage.googleapis.com/steve-db/$row->attachment' target='_blank'>DOWNLOAD</a></td>";
		https://storage.googleapis.com/steve-db/9a6d4756fcce0geogrout.jpg
		*/

	}
	
	function sendemail($sbj, $to, $cc, $bcc, $msg, $attach, $prid){
		
		$isSend = "";
		try {
			$emUser = $this->config->item('send_grid_user');
			$emPass = $this->config->item('send_grid_pass');
			//$sendgrid = new SendGrid\SendGrid($emUser, $emPass);
			//$mail = new SendGrid\Mail();
	
			$this->load->library('email');
		
			$this->email->initialize(array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtp.sendgrid.net',
			  'smtp_user' => $emUser,
			  'smtp_pass' => $emPass,
			  'smtp_port' => 587,
			  'crlf' => "\r\n",
			  'newline' => "\r\n",
			  'mailtype' => 'html'
			));

			$this->email->from('mynotification007@gmail.com', 'Geo Notification');
			if($to != ""){
				$this->email->to($to);
			}
			if($cc != ""){
				$this->email->cc($cc);
			}
			if($bcc != ""){
				$this->email->cc($bcc);
			}
			$this->email->subject($sbj);
			$this->email->message($msg);
			//$this->email->attach('https://storage.googleapis.com/steve-db-storage/7ff3e598dead3M4.PNG');

			if($attach <> ""){
				foreach($attach as $itm){
					$e_attch = explode("|",$itm);
					$this->email->attach(trim($e_attch[0]), 'attachment', trim($e_attch[1]));
					//$this->email->attach(trim($e_attch[0]));
				}
			}

			$send = $this->email->send();
			echo "sent" . $send;
			$isSend = "send";

			
		} catch (InvalidArgumentException $e) {
			$isSend = "failed";
			return "error" . $response->statusCode();
		}
		

		if($isSend == "send"){
			$this->load->model('Emailmodel');
			$nto = "";
			if(is_array($to)){
					$nto = implode(' ', $to);
				}else{
					$nto = $to;
			}
			if($prid == ""){
				$prid = "0";
			}
			
			$emailarray = array('project_id' => $prid,
				'mailto' => $nto,
				'mailcc' => ($cc == '' ? "" : implode(' ', $cc)),
				'mailbcc' => ($bcc == '' ? "" : implode(' ', $bcc)),
				'mailsubject' => addslashes($sbj),
				'mailcontent' => addslashes($msg),
				'created_by' => $this->session->userdata('crmuser'),
				'created_date' => date('Y-m-d H:i:s'),
				);
			$isnsert = $this->Emailmodel->inserttotable('email_logs', $emailarray);
		}

}

	public function testsend(){
		
		
		
		$this->load->library('email');
		$emUser = $this->config->item('send_grid_user');
		$emPass = $this->config->item('send_grid_pass');
		$this->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'smtp.sendgrid.net',
		  'smtp_user' => $emUser,
		  'smtp_pass' => $emPass,
		  'smtp_port' => 587,
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		));

		$this->email->from('mynotification007@gmail.com', 'Your Name');
		$this->email->to($to);
		if($cc <> ""){
			$this->email->cc($cc);
		}
		if($bcc <> ""){
			$this->email->bcc($bcc);
		}
		
		$this->email->subject($sbj);
		$this->email->message($msg);
		
		
		$this->email->attach('https://storage.googleapis.com/steve-db-storage/7ff3e598dead3M4.PNG');

		$this->email->send();

		echo $this->email->print_debugger();
	}
	
	public function gmailsend(){
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
			
			$this->email->to('reiwin462@gmail.com');
			$this->email->from('mynotification007@gmail.com','Notification');
			$this->email->subject('test subject');
			$this->email->message('test gmail sending');
			$this->email->attach('https://storage.googleapis.com/steve-db-storage/7ff3e598dead3M4.PNG');

		$this->email->send();

		echo $this->email->print_debugger();
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
	
	public function shoemailistlist(){
		$this->load->model('Emailmodel');
		$data = $this->Emailmodel->getemailaccountlist();
		$tabeldata = "";
		if(count($data) > 0){						
			foreach($data as $key=>$val){
				$email= "";
				$sty = "width: auto; height: 20px; text-overflow: ellipsis; text-align: center;  vertical-align: middle;";
				$tabeldata .= "<tr class='".$sty."'>";
				$tabeldata .= "<td style='width:auto; padding:0px;'>".$val['email']."</td>";
				$tabeldata .= "<td style='width:auto; padding:0px;'>".$val['fullname']."</td>";
				$tabeldata .= "<td style='width:auto; padding:0px;'>".$val['comment']."</td>";
				$tabeldata .= "<td style='width:auto; padding:0px;'>".$val['created_by']."</td>";

				$id = $val['id'];
				$email = trim($val['email']);
				$tdval = "";
				$tdval .= '<button class="btn btn-success" onclick=clickmail("'.$email.'");>
									<i class="fa fa-send" aria-hidden="true" style="font-size:14px" data-toggle="tooltip" title="Send Email"  ></i>
							</button>
							<button class="btn btn-danger" onclick=deleteemail('.$id.'); >
									<i class="fa fa-trash" aria-hidden="true" style="font-size:14px" data-toggle="tooltip"  title="Delete Email"></i>
							</button>"
							';
				$tabeldata .= "<td class='vertical-align: middle;'><div class='form-group inline'>".$tdval."</div></td>";
				
				$tabeldata .= "</tr>";
			}
		}else{
			$tabeldata = "<tr>
							<td>No Data Available</td>
							<td>No Data Available</td>
							<td>No Data Available</td>
							<td>No Data Available</td>
							<td>No Data Available</td>
						 </tr>";
		}
		
		echo $tabeldata;
	}
	
	public function deleteemail(){
		$id = $this->input->post('mailid');
		$this->load->model('Emailmodel');
		$isdelete = $this->Emailmodel->delelemaillist($id);
		if($isdelete > 0){
			echo "success";
		}else{
			echo "fail";
		}
	}
	
	public function newemail(){
		//print_r($_POST);
		$insert = "";
		$this->load->model('Emailmodel');
		$decoded = json_decode($_POST['data'],true);
		if(count($decoded) > 0){
			foreach ($decoded as $value) {
				$insert .= $value["name"] . "='" . addslashes($value["value"])."',";
			}
		}else{
			echo "error on post data";
			exit();
		}
		
		$insert .= 'created_by' . "='" . $this->session->userdata('crmuser')."',";
		$insert .= 'created_date' . "='" . date('Y-m-d H:i:s')."'";
		
		$insert = $this->Emailmodel->insertnewemail($insert);
		if($insert > 0){
			echo "success";
		} else{
			echo "failed";
		}
		
	}
	
	public function blasterlist(){
		//print_r($_FILES);
		$emad = file_get_contents($_FILES['file']['tmp_name']);
		$list = explode(PHP_EOL, $emad);
		$em = 0;
		foreach($list as $emad){
			 if(filter_var($emad, FILTER_VALIDATE_EMAIL)) {
				 echo '<a href="#" id="mail_'.$em.'">'.$emad.'</a><br>';
			 }
			 $em++;
		}
	}
	
	public function sample_email_txtfile(){
		header("Content-type: text/plain");
		header("Content-Disposition: attachment; filename=sampleblastemail.txt");
		print "sampleemailadd@sampledomain.com".PHP_EOL;
		print "tesst@test.com". PHP_EOL;
		print "sample@sample.com".PHP_EOL;
	}
}