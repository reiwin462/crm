<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'third_party/sendgrid/SendGrid_loader.php');
class Crm_controller extends CI_Controller{
	
	public function index(){
		if($this->amilog() == "OUT"){
			redirect(base_url('/crm/login'));
		}else{
			$data['url'] = "dashboard";
			$this->load->view("main", $data);
		}
	}
	
	public function crmcontrol($str = ""){
		if($this->amilog() == "OUT"){
			$this->load->view("login");
		}else{
		
			if($str == "login"){
				$this->load->view("login");
			}
			elseif($str == "logout"){
				$this->session->sess_destroy();
				$this->load->view("login");
			}
			elseif($str == "addleads"){
				
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
				$structure = $this->Crmmodel->gettablestructure('crm_leads');
				//$data['otherdata'] = $structure;
				//structure, nameofform, bootrstrapcolratio, $tblname, $showtbleid, $formname
				
				$data['updateform'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'crm_leads', 'yes','leadform');
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'crm_leads', 'no','lead');
				
				$structuretask = $this->Crmmodel->gettablestructure('crm_task');
				$data['formtask'] = $this->Formbuildermodel->createdynamicform($structuretask, '3', 'crm_task', 'no','taskform');
				
				//$data['url'] = "leads/newlead";
				$data['url'] = "leads/leadpreview";
				$this->load->view("main",$data);
			}
			
			elseif($str == "showleadstables"){

				$this->load->model('Leadmodel');
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
				
				$structure = $this->Crmmodel->gettablestructure('crm_leads');
				$data['structure']  = $structure;
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'crm_leads', 'yes','leadform');
				
				$structuretask = $this->Crmmodel->gettablestructure('crm_task');
				$data['formtask'] = $this->Formbuildermodel->createdynamicform($structuretask, '3', 'crm_task', 'no','taskform');
				
				$colhtm = "";
				$colhtm .= '<th>Owner</th>';
				$colhtm .= '<th>First Name</th>';
				$colhtm .= '<th>Last Name</th>';
				$colhtm .= '<th>Title</th>';
				$colhtm .= '<th>Phone</th>';
				$colhtm .= '<th>Status</th>';
				$colhtm .= '<th>State</th>';
				$colhtm .= '<th style="width: 100px;">Action</th>';
				
				/*
				$cols  = $this->Leadmodel->getleadcol();
				$colhtm = '';
				$rowthm = '';
				$tdhtm = '';
				
				foreach( $cols[1] as $key=>$value){
					if($key == "action"){
						$colhtm .= '<th width="120px" id="'.$key.'">'.$key.'</th>';
					}else{
						$colhtm .= '<th id="'.$key.'">'.$key.'</th>';
					}
				}
				*/
				
				$data['columns']  = $colhtm;
				$data['url'] = "leads/leadstable";
				$this->load->view("main",$data);

			}
			elseif($str == "upload"){

				$this->load->model('Crmmodel');
				$data['structure'] = $this->Crmmodel->gettablestructure('crm_leads');
				$data['otherdata'] = $this->Crmmodel->getLeadCol();
				$data['url'] = "leads/leadsupload";
				$this->load->view("main",$data);
			
			}
			elseif($str == "leadstatus"){
				
				$this->load->model('Crmmodel');
				$this->load->model('Leadmodel');
				$this->load->model('Formbuildermodel');
				
				$structure = $this->Crmmodel->gettablestructure('crm_leads');
				$data['structure'] = $structure;
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'crm_leads', 'yes','leadform');
				$cols  = $this->Leadmodel->getleadcol();
				
				$colhtm = '';
				$rowthm = '';
				
				$colhtm = "";
				$colhtm .= '<th>Owner</th>';
				$colhtm .= '<th>First Name</th>';
				$colhtm .= '<th>Last Name</th>';
				$colhtm .= '<th>Title</th>';
				$colhtm .= '<th>Phone</th>';
				$colhtm .= '<th>Status</th>';
				$colhtm .= '<th>State</th>';
				$colhtm .= '<th style="width: 100px;">Action</th>';
				/*
				foreach( $cols[1] as $key=>$value){
					if($key == "action"){
						$colhtm .= '<th id="'.$key.'">'.$key.'</th>';
					}else{
						$colhtm .= '<th id="'.$key.'">'.$key.'</th>';
					}
				}
				*/
				
				$data['columns']  = $colhtm;
				$data['leadstat'] =  $this->Leadmodel->getleadstatus();
				$data['url'] = "leads/leadstable";
				$this->load->view("main",$data);
			
			}
			elseif($str == "leadsoption"){
				
				$this->load->model('Leadmodel');
				$data['dropdown'] =  $this->Leadmodel->getdropdowns();
				$data['url'] = "leads/leadoptionmanager";
				$this->load->view("main",$data);
			
			}
			elseif($str == "dashboard"){
				
				$data['url'] = "dashboard";
				$this->load->view("main",$data);
			
			}
			elseif($str == "campaign"){
				
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
				$structure = $this->Crmmodel->gettablestructure('crm_campaign');	
				$data['structure'] = $structure;
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'crm_campaign', 'no','newcampaign');
				
				$data['url'] = "campaign/addcampaign";
				$this->load->view("main",$data);
			
			}
			elseif($str == "showcampaigntables"){
				
				$this->load->model('Campaignmodel');
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
			
				$structure = $this->Crmmodel->gettablestructure('crm_campaign');
				$data['structure'] = $structure;
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'crm_campaign', 'yes','campaignupdate');
				
				$colhtm = "";
				$colhtm .= '<th>Campaign Name</th>';
				$colhtm .= '<th>Campaign Type</th>';
				$colhtm .= '<th>Campaign Status</th>';
				$colhtm .= '<th>Expected Revenue</th>';
				$colhtm .= '<th>Budget Cost</th>';
				$colhtm .= '<th>Actual Cost</th>';
				$colhtm .= '<th>Action</th>';
				
				/*
				$col = $this->Campaignmodel->getcampaigncol();
				$colhtm = '';
				$rowthm = '';
				$tdhtm = '';
				foreach( $col[0] as $key=>$value){
					if($key == "action"){
						$colhtm .= '<th width="120px" id="'.$key.'">'.$key.'</th>';
					}else{
						$colhtm .= '<th id="'.$key.'">'.$key.'</th>';
					}
				}
				*/
				
				$data['columns']  = $colhtm;
				$data['url'] = "campaign/campaigntable";
				$this->load->view("main",$data);
			
			}
			elseif($str == "addcontacts"){
				
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
				$structure = $this->Crmmodel->gettablestructure('crm_contacts');
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'crm_contacts', 'no','contactform');
				
				$data['url'] = "contacts/newcontact";
				$this->load->view("main",$data);
			
			
			}
			elseif($str == "showcontacttables"){
				
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
				$this->load->model('Contactmodel');
				
				$structure = $this->Crmmodel->gettablestructure('crm_contacts');
			
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'crm_contacts', 'no','contactform');
				$colhtm ="";
				$colhtm .= "<th>Name</th>";
				$colhtm .= "<th>Email</th>";
				$colhtm .= "<th>Source</th>";
				$colhtm .= "<th>Phone</th>";
				$colhtm .= "<th>Title</th>";
				$colhtm .= "<th>Mobile</th>";
				$colhtm .= "<th>Birthday</th>";
				$colhtm .= "<th style='width: 100px;'>Action</th>";
				
				/*
				$col = $this->Contactmodel->getcontactcol();
				$colhtm = '';
				foreach($col[0] as $key=>$value){
					if($key == "action"){
						$colhtm .= '<th width="120px" id="'.$key.'">'.$key.'</th>';
					}else{
						$colhtm .= '<th id="'.$key.'">'.$key.'</th>';
					}
				}
				*/
				$data['columns']  = $colhtm;
				$data['url'] = "contacts/contacttable";
				
				$this->load->view("main",$data);
			
			
			}
			elseif($str == "createprojleads"){
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
				
				$structure = $this->Crmmodel->gettablestructure('project_leads');
				//$data['structure']  = $structure;
				$data['formupdate'] = $this->Formbuildermodel->createdynamicform($structure, '6', 'project_leads', 'yes','projleadformupdate');
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '4', 'project_leads', 'no','projleadform');
				
				$docstruc = $this->Crmmodel->gettablestructure('tbldocuments');
				$data['formdocument'] = $this->Formbuildermodel->createdynamicform($docstruc, '6', 'project_leads', 'no','projleaddocument');
				
				$rfistruc = $this->Crmmodel->gettablestructure('project_rfi');
				$data['formrfi'] = $this->Formbuildermodel->createdynamicform($rfistruc, '6', '', 'no','projrfi');
				
				$data['url'] = "projectleads/newprojleads";
				$this->load->view("main",$data);
				
			}
			elseif($str == "previewprojleads"){
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
				$this->load->model('Projectleadmodel');
				$this->load->model('Leadmodel');
				$this->load->model('Emailmodel');
				
				$data['emailaddress'] = $this->Emailmodel->emailist();
					
				$structure = $this->Crmmodel->gettablestructure('project_leads');
				$data['structure']  = $structure;
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '3', 'project_leads', 'yes','projleadform');
				$data['leadstat'] =  $this->Leadmodel->getleadstatus();
				
				$data['estimator'] =  $this->Crmmodel->getitems('crm_sales_representative');
				
				$docstruc = $this->Crmmodel->gettablestructure('tbldocuments');
				$data['formdocument'] = $this->Formbuildermodel->createdynamicform($docstruc, '6', 'project_leads', 'no','projleaddocument');
				
				
				$rfistruc = $this->Crmmodel->gettablestructure('project_rfi');
				$data['formrfi'] = $this->Formbuildermodel->createdynamicform($rfistruc, '3', '', 'yes','projrfi');
				
				
				$calllog = $this->Crmmodel->gettablestructure('project_call_logs');
				$data['calllogform'] = $this->Formbuildermodel->createdynamicform($calllog, '4', '', 'yes','projcalllog');
				
				$colhtm = "";
				$colhtm .= "<th>Need Help</th>";
				$colhtm .= "<th>Project No</th>";
				$colhtm .= "<th>Lead Status</th>";
				$colhtm .= "<th>Bid Date</th>";
				$colhtm .= "<th>Estimator</th>";
				$colhtm .= "<th>Project Name</th>";
				$colhtm .= "<th>Work Type</th>";
				$colhtm .= "<th>Address</th>";
				$colhtm .= "<th>Bid Value</th>";
				$colhtm .= "<th>Source</th>";
				$colhtm .= "<th>Created By</th>";
				$colhtm .= "<th id='nub'>Actions</th>";
			
				/*
				$col = $this->Projectleadmodel->getprojcol();
				$colhtm = '';
				foreach( $col[0] as $key=>$value){
					if($key == "action"){
						$colhtm .= '<th width="120px" id="'.$key.'">'.$key.'</th>';
					}else{
						$key = str_replace('Proj', '', $key);
						$colhtm .= '<th id="'.$key.'">'.str_replace('_', ' ', $key).'</th>';
					}
				}
				*/
				$data['columns']  = $colhtm;
				
				$data['url'] = "projectleads/previewprojleads";
				$this->load->view("main",$data);
				
			}
			elseif($str == "leadprojpreview"){
				
				$data['url'] = "projectleads/leadpreview";
				$this->load->view("main",$data);
			}
			
			elseif($str == "futureleads"){
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
				$this->load->model('Projectleadmodel');
				$this->load->model('Leadmodel');
				
				$structure = $this->Crmmodel->gettablestructure('project_future_leads');
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '4', 'project_future_leads', 'yes','projfutureleadform');

				$colhtm = "";
				$colhtm .= "<th>Links</th>";
				$colhtm .= "<th>Lead Source </th>";
				$colhtm .= "<th>Type of Work</th>";
				$colhtm .= "<th>Created By</th>";
				$colhtm .= "<th id='nub'>Actions</th>";
				
				$data['columns'] = $colhtm;
				$data['url'] = "projectleads/futureleads";
				$this->load->view("main",$data);
			}
			
			elseif($str == "email"){
				
				$this->load->model('Emailmodel');
				$this->load->model('Crmmodel');
				$this->load->model('Formbuildermodel');
				
				$colhtm = "";
				$colhtm .= '<th>Email</th>';
				$colhtm .= '<th>Full Name</th>';
				$colhtm .= '<th>Description</th>';
				$colhtm .= '<th>Created</th>';
				$colhtm .= '<th>Action</th>';
				
				$data['columns'] = $colhtm;
				$structure = $this->Crmmodel->gettablestructure('email_accounts');
				$data['form'] = $this->Formbuildermodel->createdynamicform($structure, '6', 'email_accounts', 'no','maillistform');
				
				$data['emailaddress'] = $this->Emailmodel->emailist();
				$data['url'] = "email/emailmain";
				$this->load->view("main",$data);
			}
			
			elseif($str == "emailblast"){
				
				$data['url'] = "email/emailblaster";
				$this->load->view("main",$data);
			}

			elseif($str == "testpreview"){
				$data['url'] = "projectleads/leadpreview";
				$this->load->view("main",$data);
			}
			elseif($str == "sendemail"){
				$this->gsend();
			}
			elseif($str == "error"){
				$this->load->view("errorpage");
			}
			else{
				
				$data['url'] = "landing";
				$this->load->view("main", $data);
			
			}
		
		}
	}
	function sendemail(){
		$this->load->library('email');
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'_smtp_auth' => TRUE,
			'smtp_port' => 465,
			'smtp_user' => 'gmailuser@gmail.com',
			'smtp_pass' => 'xxxx',
			'mailtype'  => 'html',
			'smtp_timeout' => '60',
		);
		
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		$htmlContent = '<h1>Sending email via SMTP server</h1>';
		$htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';
		$htmlContent .= '<p>Second line.</p>';

		$this->email->to('mynotification007@gmail.com');
		$this->email->from('mynotification007@gmail.com','Notification');
		
		$this->email->subject('How to send email via SMTP server in CodeIgniter');
		$this->email->message($htmlContent);

		//Send email
		$this->email->send();
		echo $this->email->print_debugger();

	}
	
	function gsend(){
		try {
			$sendgrid = new SendGrid\SendGrid('sendgriduser', 'sendgridpass');
			$mail = new SendGrid\Mail();
			$mail->addTo('reiwin462@gmail')->
				   setFrom('mynotification007@gmail.com')->
				   setSubject('Subject goes here')->
				   setText('Hello World!')->
				   setHtml('<strong>Hello World!</strong>');
				   
			echo $sendgrid->send($mail);
		} catch (InvalidArgumentException $e) {
			echo 'There was an error'. $e;
		}
	}
	
	
	
	public function amilog(){
		if($this->session->userdata('crmuser') == ""){
			return "OUT";
		}else{
			return "IN";
		}
	}
}

