<?php

class Excellprocess extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->helper(array('form', 'url'));
	}

	public function index(){
		
	}
	
	function import(){	
		if(isset($_FILES["file"]["name"]))
		{
			try {
				$successInsert = array();
				$failedInsert = array();
			
				$dataarray = array();
				//$path =  $_FILES["file"]["tmp_name"];
				
			
				$name =  $_FILES["file"]["name"];
				$path = 'gs://steve-crm.appspot.com/'.$name;
				$temp_name = $_FILES['file']['tmp_name'];
				move_uploaded_file($temp_name, $path);
				
				/*
				$config['gs_bucket_name']          = 'steve-crm.appspot.com';
                $config['allowed_types']        = 'gif|jpg|png|xls|xlsx|doc|docx|csv';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
				$this->upload->do_upload('file');
				*/
				
				
				$pubpath = "https://storage.googleapis.com/steve-crm.appspot.com/".$name;
				$object = PHPExcel_IOFactory::load($pubpath);
				
				$this->load->model('Crmmodel');
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
					for($row=2; $row<=$highestRow; $row++)
					{
						
						for ($col = 0; $col <= $highestColumnIndex - 1; $col++) {
							
							$field = $worksheet->getCellByColumnAndRow($col, 1)->getValue();
							$val = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
							$dataarray[$field] = $val;
						} 
						
						$insertstat = $this->Crmmodel->uploadlead($dataarray);
						if($insertstat == "success"){
							array_push($successInsert, $dataarray);
						}else{
							array_push($failedInsert, $dataarray);
						}
						$dataarray = array();	
					}
					
				}
			
			echo "done: " . count($successInsert);
			
			}catch(Exception $e) {
			  echo 'error:' .$e->getMessage();
			}
		}else{
			print_r($_FILES);
		}	
	}
	
	
	public function exporttemplate(){
		
		$this->load->model('Crmmodel');
		$col = $this->Crmmodel->getprimaryColumn();
		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		
		$rowCount = 1; 
		$letters = array();
		$letter = 'A';
		foreach($col as $itm ){
			$objPHPExcel->getActiveSheet()->SetCellValue($letter.$rowCount,$itm);
			$letter++;
		}
		
		$filename = "leaduploadtemplate";
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");;
		header("Content-Disposition: attachment;filename=$filename.xlsx");
		header("Content-Transfer-Encoding: binary ");
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->setOffice2003Compatibility(true);
		$objWriter->save('php://output');

	}
	
}

