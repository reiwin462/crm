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
	
	public function newitem($field, $value){
		if($value != ""){
			$this->load->model('Crmmodel');
			echo $lead = $this->Crmmodel->addselectopt(urldecode($field), urldecode($value));
		}else{
			echo  "invalid";
		}
	}
	
	
	public function getLeadCol(){
		$this->load->model('Crmmodel');
		$lead = $this->Crmmodel->getLeadCol();
		echo json_encode($lead);
	}
	
	public function auth(){
		$uname = $this->input->post('username');
		$upass = $this->input->post('password');
		$this->load->model('Crmmodel');
		$arr = array('username' => $uname,
						'password' => md5($upass));
		$isExist = $this->Crmmodel->authenticate($arr);
		if($isExist != "error"){
			$ses =  array('');
			foreach($isExist as $key=>$val){
				$ses =  array('crmuser'=> $val->username,
					'crmfullname'=> $val->fullname,
					'crmlevel'=> $val->level,
				);
			}
			$this->session->set_userdata($ses);
			//header('location: '. base_url());
			redirect(base_url());
		}else{
			//header('location: '. base_url('/crm/login'));
			redirect(base_url('/crm/login'));
		}
		
	}
	
	public function apilogin(){
		$uname = $this->input->get('username');
		$this->load->model('Crmmodel');
		$isExist = $this->Crmmodel->apiauthenticate(trim($uname));
		if($isExist != "error"){
			$ses =  array('');
			foreach($isExist as $key=>$val){
				$ses =  array('crmuser'=> $val->username,
					'crmfullname'=> $val->fullname,
					'crmlevel'=> $val->level,
				);
			}
			$this->session->set_userdata($ses);
			redirect(base_url());
		}else{
			redirect(base_url('/crm/login'));
		}
	}
	
	public function test(){
		$a1=array("a"=>"red","b"=>"green","c"=>"bluxe","d"=>"yellow");
		$a2=array("e"=>"red","f"=>"green","g"=>"blue");

		$result=array_diff($a1,$a2);
		print_r($result);
	}
	
}

