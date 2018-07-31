<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
		foreach ($decoded as $value) {
			if($value["name"] == "more_info"){
				$insert .= $value["name"] . "='" . addslashes($value["value"])."',";
			}
			elseif($value["name"] == "proj_no"){
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
				echo "success";
			}else{
				echo "error";
			}
			$this->sendemail('Project Lead Notification', $this->session->userdata('crmuser'), $htm);
		}
		
		
	
	}
	
	
	
	public function showallprojleads(){
		$this->load->model('Projectleadmodel');	
		$data =  $this->Projectleadmodel->getprojleads();
		$prjleads = array('data' => array());
		if(count($data) > 0){			
			$innerarray =  array();
			foreach($data as $row){				
				foreach($row as $key=>$val){
					if(strlen($val) == 0){
						$tdval = "blank";
					}elseif($key == "action"){
						$tdval = "<button class='btn btn-primary' onclick=\"projleadupdate('".$val."')\">
									<i class='fa fa-tv' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Preview Item'></i>
								</button> 
								<button class='btn btn-danger' onclick=\"projleaddelete('".$val."')\">
									<i class='fa fa-trash-o' aria-hidden='true' style='font-size:18px' data-toggle='tooltip' title='Delete Item'></i>
								</button>";
					}else{
						$tdval = $val;
					}
					if($key == "bid_value"){
						$newinnerarray[] = number_format($tdval,2);
					}else{
						$newinnerarray[] = $tdval;
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

		$isupdate = $this->Projectleadmodel->updateprojlead(rtrim($update,","). "where id = '".trim($id)."'");
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
	
	public function projleadremove($id){
		$htm = "";
		if($id != ""){
			$this->load->model('Projectleadmodel');
			$lead = $this->Projectleadmodel->getleaddata($id);
			
			$htm .= '<h3 style="font-family: Century Gothic; color:red;">Lead Deletion</h3>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;"> Removed By : '.$this->session->userdata('crmuser').'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">Date :'. date('Y-m-d H:i:s').'</p>';
			$htm .= '<p style="margin-top: 0px; font-size: 11px;  font-family: Century Gothic;">'.'Project Code : '.$lead[0]['proj_no'].'</p>';
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
	
	
	function sendemail($sbj, $to, $msg){
		
		try {
			$sendgrid = new SendGrid\SendGrid('send_grid_user', 'send_grid_password');
			$mail = new SendGrid\Mail();

			$mail->addTo($to)->
				   setFrom('mynotification007@gmail.com')->
				   setSubject($sbj)->
				   setText(strip_tags($msg))->
				   setHtml($msg);
				echo $sendgrid->send($mail);
					
		} catch (InvalidArgumentException $e) {
			echo 'There was an error'. $e;
		}
		
		/* send via codeigniter library
			$this->load->library('email');
			$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'_smtp_auth' => TRUE,
				'smtp_port' => 465,
				'smtp_user' => 'mynotification007@gmail.com',
				'smtp_pass' => 'xxxxx',
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
	
	
	
}