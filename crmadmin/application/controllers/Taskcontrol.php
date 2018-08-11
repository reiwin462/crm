<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Taskcontrol extends CI_Controller{

	public function index(){
		
	}
	
	public function newtask(){
		$decoded = json_decode($_POST['data'],true);
		$insert = '';
		
		die($decoded);
		foreach ($decoded as $value) {
		   $insert .= $value["name"] . "='" . addslashes($value["value"])."',";
		}
		$insert .= "created_by='"."session user"."', created_datetime=sysdate(),";
		
		$this->load->model('Taskmodel');
		echo $this->Taskmodel->insertnewtask($insert);
	}
	
	public function showtask($lead){
		$htm = "";
		if($lead != ""){
			$this->load->model('Taskmodel');
			$task = $this->Taskmodel->gettask(urldecode($lead));
			foreach($task as $key=>$val){
				$htm .= '<div class="sl-item sl-primary">
							<div class="sl-content">
									<small class="text-muted">[ '.$val->status.' ] - '. $val->subject. ' </small>
									<p>'.$val->created_by .' wrote '.$val->description .'</p>
									<small class="text-muted">'.$val->due_date.'</small>
							</div>
						</div>';
			}
			echo $htm;	
			
		}
		
	}
	
}