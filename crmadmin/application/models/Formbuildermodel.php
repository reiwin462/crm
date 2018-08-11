<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formbuildermodel extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}
	
	public function createdynamicform($structure, $colratio, $tblname, $showtblID, $formname){
		//structure, nameofform, bootrstrapcolratio, $tblname, $showtbleid, $formname
		$htm ="";
		$htm = '<form id="'.$formname.'" method="POST" action="#">';
		foreach($structure as $key=>$val){
			$enumopt = "";
			$fldlimit = "";
			$jsinputvalidation = "";
			$fldasterisk = "";
			$fldname = trim($val['field_name']);
			$maskname = str_replace('_', ' ', trim($val['field_name']));
			$fldtype = trim($val['field_type']);
			$flddefault = trim($val['field_default']);
			$flddatatype = trim($val['field_datatype']);
			$fldrequired = trim($val['field_required']);
			$flditems = $val['field_subitems'];
			
			if(strpos($flddatatype, "varchar") !== false || strpos($flddatatype, "int") !== false){
				//force number of input character
				$fldlimit = $this->getfieldvalue($flddatatype);
			}
			
			if(strpos($flddatatype,"int") !== false || strpos($flddatatype,"decimal") !== false ){
				//force number input if integer and decimal
				$jsinputvalidation = "return isNumberKey(event)";
			}
			
			if(strpos($flddatatype,"int") !== false || strpos($flddatatype,"decimal") !== false ){
				//force number input if integer and decimal
				$jsinputvalidation = "return isNumberKey(event)";
			}
			
			if(strpos($flddatatype,"enum") !== false ){
				//get enum values
				$enumopt = explode(',', $this->getfieldvalue($flddatatype));				
			}
			
			if($fldname == "lead_owner"){
				$maskname = "owner";
			}
			
			if($fldname == "info"){
				$maskname = "information";
			}
			if($fldrequired == "1"){
				$fldrequired = 'required';
				$fldasterisk = '<i class="fa fa-asterisk" aria-hidden="true"  style="font-size: 6px; color:red;"></i>';
			}else{
				$fldrequired = '';
				$fldasterisk = '';
			}
			switch ($fldtype) {
			case "TEXT":
					$htm .= '<div class="col-md-'.trim($colratio).'">
								<div class="form-group">
									<label for="'.$fldname.'"> '.ucwords($maskname).'&nbsp;'.$fldasterisk.'</label>
									<input type="text" class="form-control" id="'.$fldname.'" placeholder="'.$maskname.'" name="'.$fldname.'"  onkeypress="'.$jsinputvalidation.'" maxlength="'.$fldlimit.'"  value="'.$flddefault.'" '.$fldrequired.'  ></input>
								</div>
							 </div>';
				break;
			case "DROPDOWN":
					$opt = '';
					foreach($flditems as $itm){
						$opt .= '<option value="'.$itm['description'].'">'.$itm['description'].'</option>';
					}
					$htm .= '<div class="col-md-'.trim($colratio).'">
								<div class="form-group">
									<label for="'.$fldname.'"> '.ucwords($maskname).'&nbsp;'.$fldasterisk.'</label>
									<select class="form-control" id="'.$fldname.'" name="'.$fldname.'" >
										'.$opt.'
									</select>
								</div>
								<div class="text-right addnew">
									<i class="fa fa-plus" aria-hidden="true"></i><a href="#" onclick="newdropdown(\''.$fldname.'\');" > Add Item!</a>
								</div>
							 </div>';
				break;
			case "TEXTAREA":
					// initiate close for div row
					/*
					$htm .= '</div>
								<div class="row" style="padding:10px;">
									<div class="form-group">
										<label for="'.$fldname.'">'.ucwords($maskname).'&nbsp;'.$fldasterisk.'</label>
										<textarea class="form-control" id="'.$fldname.'" placeholder="'.$maskname.'" name="'.$fldname.'"  '.$fldrequired.'>'.$flddefault.'</textarea>
									</div>
								</div>
					<div class="row" >';
					*/
					$htm .= '<div class="col-md-12">
								<div class="form-group">
										<label for="'.$fldname.'">'.ucwords($maskname).'&nbsp;'.$fldasterisk.'</label>
										<textarea class="form-control '.$maskname.'" id="'.$fldname.'" placeholder="'.$maskname.'" name="'.$fldname.'"  '.$fldrequired.'>'.$flddefault.'</textarea>
									</div>
							 </div>';
							 
					// initiate close for div reopen
				break;
			case "DATE":
					$htm .= '<div class="col-md-'.trim($colratio).'">
								<div class="form-group">
									<label for="'.$fldname.'">'.ucwords($maskname).'&nbsp;'.$fldasterisk.'</label>
									<input type="date" class="form-control" id="'.$fldname.'" placeholder="'.$maskname.'" name="'.$fldname.'" value="'.date('Y-m-d').'"></input>
								</div>
							 </div>';
				break;
				
			case "ENUM":
					$opt = '';
					foreach($enumopt as $itm){
						$itm = str_replace("'","",$itm);
						$opt .= '<option value="'.$itm.'">'.$itm.'</option>';
					}
					$htm .= 	'<div class="col-md-'.trim($colratio).'">
								<div class="form-group">
									<label for="'.$fldname.'"> '.ucwords($maskname).'&nbsp;'.$fldasterisk.'</label>
									<select class="form-control" id="'.$fldname.'" name="'.$fldname.'" >
										'.$opt.'
									</select>
								</div>
							 </div>';
				break;
			
			case "HIDDEN":
					if($fldname == "id"){
						$htm .= '<input type="HIDDEN" id="'.$fldname.'" name="'.$maskname.'"  maxlength="'.$fldlimit.'"  value="'.$flddefault.'" '.$fldrequired.'  ></input>';
					}else{
						$htm .= '<input type="HIDDEN" id="'.$fldname.'" name="'.$fldname.'"  maxlength="'.$fldlimit.'"  value="'.$flddefault.'" '.$fldrequired.'  ></input>';
					}
				break;
			
			default:
			}
			//automatically add hidden field with id param
		
		}
		if($showtblID == "yes"){
			$htm .= '<input type="hidden" id="transid" name="id" maxlength="10" ></input>';
		}
				
		$htm .= "</form>";
		$htm .= '<script>
				function isNumberKey(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						swal({
							type: "error",
							title: "validation",
							 text : "Please enter number values only"
							});
							return false;
					}else{
						return true;
					}
					
				}
				
				function newdropdown(fld){
					var xlink = window.location.host;
					var newdata
					swal({
					  title: "Please Enter Your Item for <br>" + fld.replace("_", " "),
					  input: "text",
					  inputAttributes: {
						autocapitalize: "off",
						id: "newdropdownitem"
					  },
					  showCancelButton: true,
					  confirmButtonText: "Insert",
					  showLoaderOnConfirm: true,
					  preConfirm: (xitem) => {
						var link = "'. base_url() .'process/newitem/"+ fld + "/" +  $("#newdropdownitem").val();
						newdata = $("#newdropdownitem").val();
						return fetch(link)
						  .then(response => {
							if (response == "success") {
								$("#"+ fld).append($("<option>", {
									value: newdata,
									text: newdata,
								}));
								swal({
								  type: "success",
								  title: "success",
								  text : response
								})
							}else{
								swal({
								type: "error",
								  title: "error",
								  text : response
								})
							}
						  })
						  .catch(error => {
							swal.showValidationError(
							  "Request failed: ${error}"
							)
						  })
					  },
					  allowOutsideClick: () => !swal.isLoading()
					}).then((result) => {
					  if (result.value) {
						swal({
						  type: "success",
						  title: "success",
						  text : ""
						})
						$("#"+ fld).append($("<option>", {
									value: newdata,
									text: newdata,
								}));
					  }
					});
				}
				</script>';
		return '<div class="row">'.$htm.'</div>';
	}
	
	public function getfieldvalue($str){
		preg_match('#\((.*?)\)#', $str, $match);
		return $match[1];
	}
	
	public function columnbuilder($dtcolumnarray){
		
	} 
	
}