<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectleadpreview extends CI_Controller{
	 public function __construct(){
        parent::__construct();
        $this->load->model('Projectleadmodel', 'prmodel');
		$this->amilog();
      }
	
	public function amilog(){
		if($this->session->userdata('crmuser') == ""){
			redirect(base_url('/crm/login'));
		}
	}
	
	public function index(){
		$id = $this->input->get('projectid');
		if($id == ""){
			echo "No Document Here!";
		}else{
			$this->preview($id);
		}
	}
	
	public function preview($leadid){
		$dochtm = "";
		$data['htm'] =  $leadid;
		$data['leadinfo'] = $lead = $this->prmodel->getleaddata(trim(urldecode($leadid)));
		$doc = $this->prmodel->getdocudata(trim(urldecode($leadid)));			
		if(count($doc) > 0){
			foreach($doc as $key=>$val){
				$dochtm .= '<div id="docucontent" class="row">
												<div class="col-sm-6">
														<h6>'. $this->timeAgo($val['created_date']).'</h6>
												</div>
												<div class="col-sm-6">
														<h6>'. $val['created_by'].'</h6>
												</div>
												<hr>
												<div class="col-sm-12" id="doccontent">
													<p>Filename : '.$val['doc_filename'].'</p>
													<p>Keyword : [ '.$val['doc_keywords'].' ]</p>
													<hr>
													<p class="text-align: justify;">'.$val['doc_Content'].'</p>
												</div>
							</div><div class="row">&nbsp;</div>';  
			}
		}
		$data['document'] = $dochtm; 

		//$data['bidders'] = $this->showhtmltable('project_bidders', urldecode($leadid)); 
		//$data['engineers'] = $this->showhtmltable('project_engineers', urldecode($leadid)); 
		//$data['planholder'] = $this->showhtmltable('project_planholders', urldecode($leadid)); 
	
		$planhtm = "";
		$plan = $this->prmodel->getplandata(urldecode($leadid));
		if(count($plan) > 0){
			foreach($plan as $key=>$val){
					$img = substr(trim($val['filename_type']), 0, 5);
					if($img == "image"){
						$planhtm .= "<div class='d-inline'>";
						$planhtm .= "<img src='https://storage.googleapis.com/steve-unified/".$val['filename_path']."' width='100px' height='100px' onclick='showme($(this));'>";
						$planhtm .= "<span class='caption'> ".$val['filename']." </span>";
						$planhtm .= "<br>";
						$planhtm .= "<small> ".$val['detail']." </small>";
						$planhtm .= "</div>";
					}else{
						$link = base_url()."/assets/images/pdf.png";
						$planhtm .= '<i class="fa fa-file-alt"></i>'; 
						$planhtm .= "<div class='img-with-text d-inline'>";
						$planhtm .= "<a href='https://storage.googleapis.com/steve-unified/".$val['filename_path']."'' target='_blank'><img class='fancy' src='$link' width='100px' height='100px'></a>";
						$planhtm .= "<span class='caption'> ".$val['filename']." </span>";
						$planhtm .= "<br>";
						$planhtm .= "<small> ".$val['detail']." </small>";
						$planhtm .= "</div>";
					}
			}
		}
		$data['plan'] = $planhtm; 
		$data['datarfi'] = $this->prmodel->getrfidata(trim(urldecode($leadid)));
		
		$this->load->view('other/otherpageheader', $data);
	}

public function showhtmltable($tbl, $id){
	$list = $this->prmodel->gethtmltable(trim($tbl), $id);
	if(count($list) > 0){
		echo $list[0]->list;
	}else{
		echo "<h5>No Data Submmited</h5>";
	}
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