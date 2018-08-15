<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashcontroller extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Dashmodel', 'dashmodel');
     }

	public function index()	{
		
	}
	
	public function getleadcount(){
		$lead = $this->dashmodel->leadcount();
		echo json_encode($lead);
	}
	
	public function getforbidding(){
		$bid = $this->dashmodel->getforbid();
		$htm = "";
		if(count($bid) > 0){
			foreach($bid as $key=>$val){
				$css = "";
				if($val->bid_date > date('Y-m-d')){
					$css = "";
				}elseif($val->bid_date === date('Y-m-d')){
					$css = "sea";
				}else{
					$css = "isempty";
				}
				
				$htm .= "<tr class='".$css."'>";
					$htm .= "<td>".$val->bid_date."</td>";
					$htm .= "<td>".$val->project_name."</td>";
					$htm .= "<td>".$val->client_name."</td>";
					$htm .= "<td>".$val->lead_status."</td>";
					$htm .= "<td>".$val->sales_representative."</td>";
					$htm .= "<td>".$val->type_of_work."</td>";
					$htm .= "<td>".$val->lead_source."</td>";
					$htm .= "<td>".$val->created_by."</td>";
					$link = base_url('projectleadpreview?projectid=').trim($val->id);
					$htm .= "<td>"."<a href='".$link."' target='_blank' class='btn btn-sm btn-primary'>Preview</a>"."</td>";
				$htm .= "</tr>";
			}
		}else{
			$htm = "<tr><td colspan='9'>No Available Data</td></tr>";
		}
		echo $htm;
	}
	
	public function topengineer(){
		$engineer = $this->dashmodel->topengineer();
		$htm = "";
		if(count($engineer) > 0){
			foreach($engineer as $key=>$val){
				$htm .= '
				<a href="#" class="list-group-item clearfix">	
					<small class="pull-left fw-500 fz-md">'.$val->fullname.'</small>
					<div class="pull-right"><small data-plugin="counterUp">[ '.$val->cnt.' ] Leads</small></div>
				</a>';
			}
		}else{
			$htm = "No Data Available";
		}
		echo $htm;
	}
	
	public function getwork(){
		$workarray = array();
		$work = $this->dashmodel->topworktype();
		if(count($work) > 0){
			foreach($work as $key=>$val){
				$innerworkarray = array('');
				
				$innerworkarray =  array('label' => $val->type_of_work,
						'data'=> $val->workcount);
				array_push($workarray, $innerworkarray);
			}
			echo json_encode($workarray);
		}else{
			echo json_encode('no data');
		}
	}
	
}
?>