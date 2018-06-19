<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	

	public function universal(){
			$lmt ='';
			if(isset($_GET["limit"]) == "" or isset($_GET["search"]) ==""){
				echo "Invalid Parameter";
			}else{
			
				if(is_numeric(trim($_GET["limit"]))){
						$lmt  =trim($_GET["limit"]);
				}else{
						$lmt  = "10";
				}
				
				$param = $this->security->xss_clean(trim(addslashes($_GET["search"])));
				if($param == ""){
					echo "No Search Filter Prameter";
					exit;
				}

				$this->load->model("Subscriber");
				$em = $this->Subscriber->nnvUniversal($lmt, $param);
				//echo "<pre>";
				header('Content-Type: application/json');
				echo json_encode($em);
				//echo "</pre>";
			
			}
	}
}

?>