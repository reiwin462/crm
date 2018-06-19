<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crm_controller extends CI_Controller{
	
	public function index(){
	
		$data['url'] = "landing";
		$this->load->view("main", $data);
	}
	
	
	public function crmcontrol($str = ""){
		if($str == "addleads"){
			
			$this->load->model('Crmmodel');
			$data['otherdata'] = $this->Crmmodel->showleadstructure();
			$data['url'] = "leads/crmstructure";
			$this->load->view("main",$data);
		
		}elseif($str == "showleadstables"){

			$this->load->model('Crmmodel');
			$data['structure'] = $this->Crmmodel->showleadstructure();
			//$data['otherdata'] = $this->Crmmodel->getLeadCol();
			$cols  = $this->Crmmodel->shownewleadstructure();
			
			$colhtm = '';
			$rowthm = '';
			$tdhtm = '';
			
			foreach( $cols[1] as $key=>$value){
					if($key == 'action'){

						$colhtm .= '<th width="120px" id="'.$key.'">'.$key.'</th>';
					}else{

						$colhtm .= '<th id="'.$key.'">'.$key.'</th>';
					}
			}

			for ($x = 0; $x <= count($cols) -1 ; $x++) {
				foreach($cols[$x] as $key=>$value){
					if($key == 'action'){
						$rowthm .= '<td>'.
									'<button >Update</button>'.
									'<button >Delete</button>'.
									'</td>';
					}else{
						$rowthm .= '<td>'.$value.'</td>';
					}
				}
				$tdhtm .= '<tr>'.$rowthm.'</tr>';
				$rowthm = '';
			} 
			
			$data['columns']  = $colhtm;
			$data['rows']  = $tdhtm;
			
			$data['url'] = "leads/leadstable";
			$this->load->view("main",$data);
		
		
		}elseif($str == "upload"){

			$this->load->model('Crmmodel');
			$data['structure'] = $this->Crmmodel->showleadstructure();
			$data['otherdata'] = $this->Crmmodel->getLeadCol();
			$data['url'] = "leads/leadsupload";
			$this->load->view("main",$data);
		
		}elseif($str == "campaign"){
			
			$this->load->model('Crmmodel');
			$data['structure'] = $this->Crmmodel->showcampaignstructure();		
			$data['url'] = "campaign/manage";
			$this->load->view("main",$data);
		
		}elseif($str == "leadstatus"){
			
			$this->load->model('Crmmodel');
			$data['structure'] = $this->Crmmodel->showleadstructure();
			$cols  = $this->Crmmodel->shownewleadstructure();
			
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

			for ($x = 0; $x <= count($cols) -1 ; $x++) {
				foreach($cols[$x] as $key=>$value){
					if($key == 'action'){
						$rowthm .= '<td >'.
										'<button >Update</button>'.
										'<button >Delete</button>'.
									'</td>';
					}else{
						$rowthm .= '<td>'.$value.'</td>';
					}
				}
				$tdhtm .= '<tr>'.$rowthm.'</tr>';
				$rowthm = '';
			} 
			
			$data['columns']  = $colhtm;
			$data['rows']  = $tdhtm;
			
			$data['leadstat'] =  $this->Crmmodel->getleadstatus();
			
			$data['url'] = "leads/leadstable";
			$this->load->view("main",$data);
		
		}elseif($str == "leadsoption"){
			
			$this->load->model('Crmmodel');
			$data['dropdown'] =  $this->Crmmodel->getdropdowns();
			
			$data['url'] = "leads/leadoptionmanager";
			$this->load->view("main",$data);
		
		}elseif($str == "dashboard"){
			
			$data['url'] = "dashboard";
			$this->load->view("main",$data);
		
		}else{
			
			$data['url'] = "landing";
			$this->load->view("main", $data);
		
		}
	}
	
	
	
	
}

