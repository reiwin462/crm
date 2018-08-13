
<div class="row">		
	<div id="adddiv" class="nav-tabs-horizontal white m-b-lg">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#addprojleadtab" id="leaddetailtab" aria-controls="addcampaigntab" role="tab" data-toggle="tab" aria-expanded="true">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Project Leads Details</a>
			</li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="addprojleadtab">
				<div class="innerdiv">
					<div>
						<?php echo $form; ?>
					</div>
				<br>
				<br>
				<div class="row actbutt">
					<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewprojlead();" >Save</button>
					<button type="button" class="btn btn-sm mw-md btn-danger" onclick="reset();">Cancel</button>
				</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div id="updatediv" class="nav-tabs-horizontal white m-b-lg">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" >
				<a href="#addleadtab" id="leaddetailtab" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Project Leads Details</a>
			</li>
			<li role="presentation" >
				<a href="#addleaddocument" id="leaddocu" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" onclick="reloaddocument();">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Leads Documents</a>
			</li>
			<li role="presentation" >
				<a href="#addleadplan" id="leadplantab" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" onclick="reloadplan();">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Leads Plans</a>
			</li>
			<li role="presentation" >
				<a href="#addrfi" id="leadrfitab" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" onclick="">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Project RFI</a>
			</li>
		</ul>
		<div class="tab-content" id="leadtab">
			<div role="tabpanel" class="tab-pane fade active in" id="addleadtab">
				<div>
					<?php echo $formupdate; ?>
				</div>
				<br>
				<br>
				<br>
				<div class="row actbutt">
					<button type="button" class="btn btn-sm mw-md btn-success" onclick="updateprojlead();" ><i class="fa fa-check"></i>Save</button>
					<button type="button" class="btn btn-sm mw-md btn-danger" onclick="resetcancel();">Cancel</button>
				</div>				
			</div>
			
			<div role="tabpanel" class="tab-pane" id="addleaddocument">				
				<div class="row">
					<div class="col-md-4">
						<?php echo $formdocument; ?>
						<div class="row actbutt">
							<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewdocument();" > <i class="fa fa-check"></i>Save</button>
							<button type="button" class="btn btn-sm mw-md btn-danger" onclick="resetcancel();">Cancel</button>
						</div>
					</div>					
					<div class="col-md-7">
						<div id="doclist" class="widget-body"></div>
					</div>
				</div>
			</div>
			
			<div role="tabpanel" class="tab-pane" id="addleadplan">
				 <footer class="widget-footer bg-info">Please upload Image and PDF Files Only</footer>
				 <br>
				<div class="form-inline">
					<form id="leadplan" method="post" enctype="multipart/form-data" class="form-horizontal p-t-10">
						<input type="hidden" id="leadid" name="leadid" ></input>
						<input type="file" class="form-control" name="file" id="file">
						<input type="button" value="submit" class="btn-primary btn-sm" onclick="leadplanupload();">
					</form>				
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<table id="planlist" class="table-responsive">
							
						</table>
					</div>
				</div>
			</div>
			
			<div role="tabpanel" class="tab-pane" id="addrfi">				
				<div class="row">
					<div class="container">
						<?php echo $formrfi; ?>
						<br>
						<div class="row actbutt">
							<button type="button" class="btn btn-sm mw-md btn-success" onclick="addrfi();" > <i class="fa fa-check"></i>Save</button>
							<button type="button" class="btn btn-sm mw-md btn-danger" onclick="resetcancel();">Cancel</button>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
	
</div>

<div id="imgmodal" class="modal fade" role="dialog">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
	</button>
  <img class="modal-content" id="imgprev">
  <div id="imgcaption"></div>
</div>

<script>

document.addEventListener("DOMContentLoaded", function(){
	
	$('#more_info').summernote({
		height: 100,
		 toolbar: [
		// [groupName, [list of button]]
		['style', ['bold', 'italic', 'underline', 'clear']],
		['font', ['strikethrough', 'superscript', 'subscript']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		['height', ['height']]
		],
	});
});


var optfield = "";

function addnewprojlead(){
	
	var isNull = "pass";
	var formElements = new Array();
	$("#projleadform :input").each(function(){
		var isRequired = $(this).attr('required');
		if(isRequired == "required"){
			if($(this).val() == ""){
				swal({
				  type: 'error',
				  title: 'Validation',
				  text: $(this).attr('name') + ' is a required field. Thank you!',
				  footer: '<a href> - </a>'
				});
				isNull = "fail";
				return false;
			}
		}
	});
	
	if(isNull == "pass"){
		$('#adddiv').hide();
		$('.preloader').fadeIn();
		$.post("<?php echo base_url("Projectleadcontrol/newProjLead"); ?>",
		{data: JSON.stringify($("#projleadform").serializeArray()) }) 
			.success(function(data) {
				$('#leadid').val(data);
				$('#transid').val(data);
				$('#adddiv').show();	
				$('.preloader').fadeOut();	
				if(data.indexOf('duplicate') > -1){
					  swal({
						  type: 'error',
						  title: 'Duplicate Project Leads',
						  text: 'You have entered duplicate entries on the list!',
						  footer: '<a href>'+ data +'</a>'
						});
				}else{
						$('#updatediv').show();
						$('#adddiv').hide();
						$("#projleadform :input").each(function(){
							var itmval = $(this).val();
							var item = $(this).attr('id');
							$("#projleadformupdate :input").each(function(){
								if($(this).attr('id') === item){
									if($(this).attr('id') == "mote_info"){
										$(this).val(itmval);
									}else if($(this).attr('id') == "project_no"){
										$('#projrfi #project_number').val(itmval);
									}else if($(this).attr('id') == "project_name"){
										$('#projrfi #project_name').val(itmval);
									}else{
										$(this).val(itmval);
									}	
								}
							});	
						});
						swal({
						  type: 'success',
						  title: 'New Project Leads',
						  text: 'New Contact has been Created. Thank you!',
						  footer: '<a href>'+ data +'</a>'
						});
							$('#projleadformupdate #more_info').summernote({
									height: 100,
									toolbar: [
											// [groupName, [list of button]]
									['style', ['bold', 'italic', 'underline', 'clear']],
									['font', ['strikethrough', 'superscript', 'subscript']],
									['fontsize', ['fontsize']],
									['color', ['color']],
									['para', ['ul', 'ol', 'paragraph']],
									['height', ['height']]
								],
							});
						
						$('#projleadform').trigger("reset");
					
					}
			});	
	}
		
}

function addnewdocument(){
	
	var docfname = $('#doc_filename').val();
	var docfkeys = $('#doc_keywords').val();
	var docfdocu =  $('#doc_Content').val();
	var idfld = $('#leadid').val();

	if(docfname == "" || docfkeys == "" || docfdocu == "" || idfld == ""){
		swal({
				type: 'error',
				title: 'New Project Leads Document',
				text: 'All Fields Required. Thank you!',
				footer: '<a href></a>'
			});
	}else{
		
		$.post("<?php echo base_url("Projectleadcontrol/insertdocument"); ?>",
		{data: $("#projleaddocument").serializeArray(), id: idfld }) 
		.success(function(data) {
				reloaddocument();
				swal({
					type: 'success',
					title: 'New Project Document',
					text: 'New Project Document has been Posted. Thank you!',
					footer: '<a href>'+ data +'</a>'
				});	
			});
	}
	
}

function reset(){
	$("#projleadform :input").each(function(){
		$(this).val('');
	});
	$('#updatediv').hide();
	$('#adddiv').show();
}

function resetcancel(){
	$("#projleadformupdate :input").each(function(){
		$(this).val('');
	});
	$('#updatediv').hide();
	$('#adddiv').show();	
}

function reloaddocument(){
	var idfld = $('#leadid').val();
	if(idfld == ""){
		return false;
	}
	
	$('#doclist').html('');
	var xlink = "<?php echo base_url(); ?>projectleadcontrol/getdocument/" + idfld;
	$.get(xlink, function(data, status){
        $('#doclist').html(data);
    });
}

function reloadplan(){
	var idfld = $('#leadid').val();
	if(idfld == ""){
		return false;
	}
	$('#planlist').html('');
	var xlink = "<?php echo base_url(); ?>projectleadcontrol/getplan/" + idfld;
	$.get(xlink, function(data, status){
        $('#planlist').html(data);
    });
}

function leadplanupload(){
	var idfld = $('#leadid').val();
	var fildata = document.getElementById("file").value;
	var fd = new FormData($("#leadplan")[0]);

	if(idfld == ""){
		swal({
				type:  'error',
				title: 'Upload',
				text:  'Linkin ID is missing, Kindly refresh your browser and try again!',
				footer: '<a href></a>'
			})
		return false;
	}
	
	if(fildata == ""){
		swal({
				type:  'error',
				title: 'Upload',
				text:  'Please select your file',
				footer: '<a href></a>'
			})
		return false;
	}
	
	
	Swal({
		  title: 'Lead Plan Upload?',
		  text: 'Are you sure you want to Upload this File?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, Upload it!',
		  cancelButtonText: 'No!'
		}).then((result) => {
		  if (result.value) {
				$('#prevDiv').hide();	
				$('.preloader').fadeIn();
				fd.append('file', document.getElementById("file").files[0]);
				var xlink = "<?php echo base_url("Projectleadcontrol/planupload"); ?>";
				$.ajax({
				   url: xlink,
				   method:"POST",
				   enctype: 'multipart/form-data',
				   data: fd, id: idfld,
				   contentType:false,
				   cache:false,
				   processData:false,
				   success:function(response){
						reloadplan();
						$('#prevDiv').show();	
						$('.preloader').fadeOut();
						if(response == "success"){
							swal({
							  type: 'success',
							  title: 'Upload',
							  text: 'You have successfully posted your notes',
							  footer: '<a href>'+ response +'</a>'
							});
						}else{
							swal({
							  type: 'error',
							  title: 'Upload',
							  text: response,
							  footer: '<a href></a>'
							});
						}
				   },
				   error: function (xhr, ajaxOptions, thrownError) {
						swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'You have an error in the action you are trying to do. Kindly double check and retry. Thank you!',
						  footer: '<a href></a>'
						});
					}
			  });
			  reloadplan()
				
		  } else if (result.dismiss === Swal.DismissReason.cancel) {
			
		  }
	});
}

function updateprojlead(){
	
	var isNull = "pass";
	var formElements = new Array();
	$("#projleadformupdate :input").each(function(){
		var isRequired = $(this).attr('required');
		if(isRequired == "required"){
			if($(this).val() == ""){
				swal({
				  type: 'error',
				  title: 'Validation',
				  text: $(this).attr('name') + ' is a required field. Thank you!',
				  footer: '<a href> - </a>'
				});
				
				isNull = "fail";
				return false;
			}
		}
	});
	
	if(isNull == "pass"){
		$('#prevDiv').hide();	
		$('.preloader').fadeIn();
		$.post("<?php echo base_url("Projectleadcontrol/projleadupdate"); ?>",
		{data: JSON.stringify($("#projleadformupdate").serializeArray()) }) 
			.success(function(data) {
				swal({
				  type: 'success',
				  title: 'Update',
				  text: 'You have successfully updated a lead!',
				  footer: '<a href>'+ data +'</a>'
				});		
		});
		$('#prevDiv').show();	
		$('.preloader').fadeOut();
			
	}else{
		console.log('fail method execute');
	}
	
	
}


function addrfi(){
	var idfld = $('#leadid').val();
	if(idfld == ""){
		swal({
				type: 'error',
				title: 'RFI Prerequired Data Missing',
				text: 'All Fields Required. Thank you!',
				footer: '<a href></a>'
			});
	}else{	
		
		var isNull = "pass";
		var formElements = new Array();
		$("#projrfi :input").each(function(){
			var isRequired = $(this).attr('required');
			if(isRequired == "required"){
				if($(this).val() == ""){
					swal({
					  type: 'error',
					  title: 'Validation',
					  text: $(this).attr('name') + ' is a required field. Thank you!',
					  footer: '<a href> - </a>'
					});
					isNull = "fail";
					return false;
				}
			}
		});
	
		if(isNull == "pass"){
			
			$.post("<?php echo base_url("Projectleadcontrol/insertnewrfi"); ?>",
			{data: JSON.stringify($("#projrfi").serializeArray()), id: idfld }) 
			.success(function(data) {
				if(data == "success"){
					swal({
						type: 'success',
						title: 'New Project RFI',
						text: 'New Project RFI has been Posted. Thank you!',
						footer: '<a href>'+ data +'</a>'
					});	
				}else{
					swal({
						type: 'error',
						title: 'New Project RFI',
						text: 'Kindly validate the data you are posting and Retry!',
						footer: '<a href>'+ data +'</a>'
					});	
				}
				
				});
				
		}
		
	}
	
}

function removeattachment(id){
	Swal({
		  title: 'Are you sure?',
		  text: 'Item will be permanently be removed from the database',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, delete it!',
		  cancelButtonText: 'No, keep it'
		}).then((result) => {
		  if (result.value) {
				var xlink = "<?php echo base_url(); ?>Projectleadcontrol/planremove/" + id;
				$.post(xlink,) 
				.success(function(data) {
					reloadplan();
					swal({
						type: 'success',
						title: 'Delete',
						text: 'You have successfully deleted an item. Thank you!',
						footer: '<a href>'+ data +'</a>'
					});
				});
		  } else if (result.dismiss === Swal.DismissReason.cancel) {
		  }
		});
}

function showme(img){
	$('#imgprev').attr('src', img.attr('src'));
	$('#imgcaption').attr('src', img.val());
	$('#imgmodal').modal();
}

function removedocu(id){
	Swal({
		  title: 'Are you sure?',
		  text: 'Item will be permanently be removed from the database',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, delete it!',
		  cancelButtonText: 'No, keep it'
		}).then((result) => {
		  if (result.value) {
				var xlink = "<?php echo base_url(); ?>Projectleadcontrol/docuremove";
				$.post(xlink,{planid: id}) 
				.success(function(data) {
					reloaddocument();
					swal({
						type: 'success',
						title: 'Delete',
						text: 'You have successfully deleted an item. Thank you!',
						footer: '<a href>'+ data +'</a>'
					});
				});
		  } else if (result.dismiss === Swal.DismissReason.cancel) {
		  }
		});
}

</script>