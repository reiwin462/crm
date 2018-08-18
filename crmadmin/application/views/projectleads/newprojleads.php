
<div class="row">		
	<div id="adddiv" class="nav-tabs-horizontal white m-b-lg">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#addprojleadtab" id="leaddetailtab" aria-controls="addcampaigntab" role="tab" data-toggle="tab" aria-expanded="true">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Project Leads Details</a>
			</li>
			<span role="presentation" class="btn btn-sm btn-primary pull-right">
				<a href="<?php echo base_url(); ?>crm/createprojleads" style="color: #fff;">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> New Lead Entry </a>
			</span>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="addprojleadtab">
					<div class="container-fluid">
						<div class="col-md-8">
							<?php echo $form; ?>
						</div>
						<div class="col-md-4">
							<h5 class="text-center">Maps are based on Address Supplied</h5>
							<iframe id="geomaps"
							  width="100%"
							  height="200"
							  frameborder="0" style="border:1px solid #e2e2e2;"
							  src="" allowfullscreen>
							</iframe>
						</div>
					</div>
					<div id="newleadbutton" class="container actbutt pull-center">
						<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewprojlead();" >Save</button>
						<button type="button" class="btn btn-sm mw-md btn-danger" onclick="reset();">Cancel</button>
					</div>
				</div>

				<div class="nav-tabs-horizontal white m-b-lg">
					<ul id="crmtabs" class="nav nav-tabs" role="tablist">
						<li role="presentation" >
							<a href="#addleadspec" class="tablink" id="leadspec" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true">
							<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Leads Specification and Details</h5></a>
						</li>
						<li role="presentation" >
							<a href="#addengineer" class="tablink" id="leadengineer" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true">
							<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Engineers</h5></a>
						</li>
						<li role="presentation" >
							<a href="#addplanholder" class="tablink" id="leadplan" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" >
							<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Plan Holders</h5></a>
						</li>
						<li role="presentation" >
							<a href="#addbidders" class="tablink" id="leadbid" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" >
							<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Bidders</h5></a>
						</li>
						<li role="presentation" >
							<a href="#addleaddocument" class="tablink" id="leaddocu" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" onclick="reloaddocument();">
							 <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Leads Documents</h5></a>
						</li>
						<li role="presentation" >
							<a href="#addleadplan" class="tablink" id="leadplantab" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" onclick="reloadplan();">
							 <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Leads Plans</h5></a>
						</li>
						<li role="presentation" >
							<a href="#addrfi" class="tablink" id="leadrfitab" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" onclick="">
							<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Project RFI</h5></a>
						</li>
					</ul>
					<div class="tab-content" id="leadtab">
						<div role="tabpanel" class="tab-pane fade active in" id="addleadspec">		
							<div class="row">
								<footer class="widget-footer bg-info"><h5>Please fillup necessary fields below</h5></footer>
								<div class="form-group">
									<div class="col-md-12">
										<label>Project Description</label>
										<textarea id="project_scope" width="100%" rows="5"></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<label>Notes</label>
										<textarea id="more_info" width="100%" rows="5"></textarea>
									</div>
									<div class="col-md-12">
										<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewleadspecs();" > <i class="fa fa-check"></i>Save</button>
									</div>
								</div>
								
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="addengineer">		
							<div class="row">		
								<footer class="widget-footer bg-info"><h5>Please copy the table from the Weblink and Paste it to the Field Below</h5></footer>
								<div id="engineers" class="table-responsive contentholder" contenteditable="true" preloader="Engineers List">Engineers List!</div>
								<div class="col-md-12">
									<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewengineer();" > <i class="fa fa-check"></i>Save</button>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="addplanholder">		
							<div class="row">		
								<footer class="widget-footer bg-info"><h5>Please copy the table from the Weblink and Paste it to the Field Below</h5></footer>
								<div id="planholder" class="table-responsive contentholder" contenteditable="true" preloader="Plan Holder List">PLan Holders List!</div>
								<div class="col-md-12">
									<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewplanholder();" > <i class="fa fa-check"></i>Save</button>
								</div>
							</div>	
						</div>
						<div role="tabpanel" class="tab-pane" id="addbidders">
							<div class="row">
								<footer class="widget-footer bg-info"><h5>Please copy the table from the Weblink and Paste it to the Field Below</h5></footer>
								<div id="bidders" class="table-responsive contentholder" contenteditable="true" preloader="Bidders List">Bidders List!</div>
								<br>
								<div class="col-md-12">
									<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewbidders();" > <i class="fa fa-check"></i>Save</button>
								</div>
							</div>	
						</div>
						<div role="tabpanel" class="tab-pane" id="addleaddocument">				
							<div class="row">
								<footer class="widget-footer bg-info"<h5>Please supply all Fields</h5></footer>
								<div class="col-md-4">
									<?php echo $formdocument; ?>
									<br>
									<div class="col-md-12">
										<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewdocument();" > <i class="fa fa-check"></i>Save</button>
									</div>
								</div>				
								<div class="col-md-7">
									<div id="doclist" class="widget-body"></div>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="addleadplan">
							<div class="row">
										 <footer class="widget-footer bg-info">Please upload Image and PDF Files Only</footer>
										<form id="leadplan" method="post" enctype="multipart/form-data" class="form-horizontal p-t-10">
											<div class="form-group">
												<div class="col-md-6">
													<label for="detail">Detail.</label>
													<input type="text" class="form-control" id="detail" name="detail" aria-describedby="categoryHelp" placeholder="Enter Detail" required ></input>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-6">
													<input type="file" class="form-control" name="file" id="file">
												</div>
												<input type="button" value="submit" class="btn-primary btn-sm" onclick="leadplanupload();"></input>
											</div>
											
											<input type="hidden" id="leadid" name="leadid" ></input>
											
										</form>
									</div>

							<div class="row">
								<div class="container">
									<table id="planlist" class="table-responsive">
										
									</table>
								</div>
							</div>
						</div>
						
						<div role="tabpanel" class="tab-pane" id="addrfi">				
							<div class="row">
								<div class="col-md-12">
									<?php echo $formrfi; ?>
									<br>
										
									<div class="row actbutt">
										<button type="button" class="btn btn-sm mw-md btn-success" onclick="addrfi();" > <i class="fa fa-check"></i>Save</button>										
									</div>
								</div>					
							</div>
						
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
	$('#leadtab').hide();	
	$('.tablink').click(function(){
		var idfld = $('#leadid').val();
		if(idfld == ""){
			swal({
				  type: 'info',
				  title: 'validation',
				  text: 'Kindly fill up the above form first!',
				  footer: '<a href> - </a>'
				});
		}
	});
	
	$('#address').change(function(){
		if($(this).val() != ""){
			$('#geomaps').attr('src', "https://www.google.com/maps/embed/v1/place?key=AIzaSyBgdwfZSVM-XkwgcnoJMr-bmWPlEhVxbpE&q=" + $(this).val());
		}
	});
	
	$('#more_info, #project_scope').summernote({
		height: 80,
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
	
	$('#doc_Content').summernote({
		height: 120,
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
			if($(this).val() == "" || $(this).val() == null ){
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
					$('#newleadbutton').hide();
					swal({
						  type: 'success',
						  title: 'New Project Leads',
						  text: 'New Contact has been Created. Thank you!',
						  footer: '<a href>'+ data +'</a>'
						});
						$('#leadtab').show();	
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
	location.reload();
	$('#more_info').summernote(code, '');
	$('#project_scope').summernote(code, '');
	$('#leadid').val();
	$('#leadtab').hide();
}

function resetcancel(){
	$("#projleadformupdate :input").each(function(){
		$(this).val('');
	});
	$('#leadid').val();
	$('#leadtab').hide();
	
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
	var dt = $('#detail').val();
	if(idfld == "" || dt == "" ){
		swal({
				type:  'error',
				title: 'Upload',
				text:  'All Fields Required!',
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
				   data: fd, id: idfld, detail: dt,
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
						$('#prevDiv').show();	
						$('.preloader').fadeOut();
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
			
			$.post("<?php echo base_url("Projectleadcontrol/newrfi"); ?>",
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

function addnewleadspecs(){
		$('#prevDiv').hide();	
		$('.preloader').fadeIn();
		var idfld = $('#leadid').val();
		var projspec = $('#more_info').summernote('code');
		var projnotes = $('#project_scope').summernote('code');
		
		$.post("<?php echo base_url("Projectleadcontrol/new_module_item"); ?>",
		{action: "leadspec", specification : projspec, notes : projnotes, id: idfld }) 
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
}

function addnewengineer(){
		$('#prevDiv').hide();	
		$('.preloader').fadeIn();
		var idfld = $('#leadid').val();
		var list = $('#engineers').html();
		
		$.post("<?php echo base_url("Projectleadcontrol/new_module_item"); ?>",
		{action: "engineer", engineerlist: list, id: idfld }) 
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
}

function addnewbidders(){
		$('#prevDiv').hide();	
		$('.preloader').fadeIn();
		var idfld = $('#leadid').val();
		var list = $('#bidders').html();
		
		$.post("<?php echo base_url("Projectleadcontrol/new_module_item"); ?>",
		{action: "bidders", bidderslist: list, id: idfld }) 
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
}

function addnewplanholder(){
		$('#prevDiv').hide();	
		$('.preloader').fadeIn();
		var idfld = $('#leadid').val();
		var list = $('#planholder').html();
		
		$.post("<?php echo base_url("Projectleadcontrol/new_module_item"); ?>",
		{action: "planholders", planholderslist: list, id: idfld }) 
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
}

</script>