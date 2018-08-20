
<div class="row">		
		<div id="adddiv" class="nav-tabs-horizontal white m-b-lg">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#addleadtab" id="leaddetailtab" aria-controls="addleadtab" role="tab" data-toggle="tab" aria-expanded="true">
						<i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Lead Item</a>
					</li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="addleadtab">
						<div class="">
							<div class="row">
								<?php echo $form; ?>
							</div>
							<div class="row">
								<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewlead();" ><i class="fa fa-check"></i> Save</button>
								<button type="button" class="btn btn-sm mw-md btn-danger" onclick="reset();">Cancel</button>
							</div>
						</div>
					</div>
				</div>
		</div>
		
		<div id="updatediv" class="nav-tabs-horizontal white m-b-lg">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#leadinfo" id="leaddetailtab" aria-controls="leadinfo" role="tab" data-toggle="tab" aria-expanded="true" onclick=""><i class="fa fa-info-circle" aria-hidden="true"></i> Lead Information</a></li>
							<li role="presentation" class=""><a href="#leadnotes" aria-controls="leadnotes" role="tab" aria-expanded="false" data-toggle="tab" onclick="reloadhistrory();"> <i class="fa fa-sticky-note" aria-hidden="true"></i> Notes</a></li>
							<li role="presentation" class=""><a href="#leadtask" aria-controls="leadtask" role="tab" aria-expanded="false"  data-toggle="tab" onclick=""> <i class="fa fa-tasks" aria-hidden="true"></i> Task</a></li>
						</ul>
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="leadinfo">
								<div class="container">
										<div class="row">
											<?php echo $updateform; ?>
										</div>
										<div class="row">
											<button type="button" class="btn mw-md btn-success" onclick="updatelead();" > <i class="fa fa-check"></i> Submit</button>
											<button type="button" class="btn mw-md btn-danger" onclick="cancel();" >Cancel</button>
										</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="leadnotes">
								<div class="container">
									<form method="post" id="formnote" enctype="multipart/form-data" action="#">
											<div class="col-md-6">
												<div class="form-group">
													<label for="notesubject">Title.</label>
													<input type="text" class="form-control" id="notesubject" name="notesubject" aria-describedby="subjectHelp" placeholder="Enter Title" required ></input>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="notecategory">Category.</label>
													<input type="text" class="form-control" id="notecategory" name="notecategory" aria-describedby="categoryHelp" placeholder="Enter Category" required ></input>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="message">Message Details</label>
													<textarea class="form-control" id="message" name="message" rows="3"></textarea>
												 </div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="attachment">Note Attachment</label>
													<input type="file" class="form-control-file" id="file" name="file">
													<small>Please upload attachment</small>
												</div>
											</div>
											<div class="col">
												<input type="hidden" id="noteid" name="noteid"></input>
												<button type="button" class="btn mw-md btn-success float-right" onclick="addcrmnotes(event);" >Add Notes</button>
												<button type="button" class="btn mw-md btn-danger" onclick="te();">Cancel</button>
											</div>
										</form>
								<hr>
									<div class="widget">
										<header class="widget-header">
											<h4 class="widget-title">Notes</h4>
										</header>
										<hr class="widget-separator">
										<div class="widget-body">
											<div id="timeline" class="streamline">
												timeline data
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="leadtask">
								<div class="container">
								<div class="row">
									<?php echo $formtask; ?>
								</div>
								<div class="row">
									<input type="hidden" id="leadid" name="leadid"></input>
									<button type="button" class="btn mw-md btn-success float-right" onclick="addtask(event);" ><i class="fa fa-check"></i> Add Lead Task</button>
									<button type="button" class="btn mw-md btn-danger" onclick="cancel();">Cancel</button>
								</div>
								<br>
								<div class="row">
									<div class="widget">
										<hr class="widget-separator">
										<div class="widget-body">
											<div id="tasktimeline" class="streamline">
												..
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
					</div>
				
			</div>
</div>

<script>
var masterid = "";

document.addEventListener("DOMContentLoaded", function() {
var masterid = "";	
});

function addnewlead(){
	
	var isNull = "pass";
	var formElements = new Array();
	$("#lead :input").each(function(){
		var isRequired = $(this).attr('required');
		if(isRequired == "required"){
			if($(this).val() == ""){
				swal({
				  type: 'error',
				  title: 'Form Validation',
				  text: $(this).attr('name') + ' is a required field. Thank you!',
				  footer: '<a href>Please Supply Required Fields</a>'
				});
				
				isNull = "fail";
				return false;
			}
		}
	});

	if(isNull == "pass"){
		$.post("<?php echo base_url("Leadcontrol/newlead"); ?>",
		{data: JSON.stringify($("#lead").serializeArray()) }) 
		.success(function(response) {
			swal({
				  type: 'success',
				  title: 'New Lead Insert',
				  text: 'New Lead Record has been Created. Thank you!',
				  footer: '<a href onclick=""> '+ response +'</a>'
				});
			$('#transid').val(response);
			$("#noteid").val(response);
			$("#lead_id").val(response);
			$('#adddiv').hide();
				$("#lead :input").each(function(){
					var itmval = $(this).val();
					var item = $(this).attr('id');
					$("#leadform :input").each(function(){
						if($(this).attr('id') === item){
							$(this).val(itmval);
						}
					});	
				});			
			$('#updatediv').toggle();
			reset();
		});
	}
	
}

function addcrmnotes(e){
	
	var fildata = document.getElementById("file").value;
	var fd = new FormData($("#formnote")[0]);

	fd.append('file', document.getElementById("file").files[0]);
		$.ajax({
		   url:"<?php echo base_url(); ?>leadcontrol/noteinsert",
		   method:"POST",
		   enctype: 'multipart/form-data',
		   data: fd,
		   contentType:false,
		   cache:false,
		   processData:false,
		   success:function(response){
				
				reloadhistrory();
				swal({
				  type: 'success',
				  title: 'Notes',
				  text: 'You have successfully posted your notes',
				  footer: '<a href>'+ response +'</a>'
				});;
		   },
		   error: function (xhr, ajaxOptions, thrownError) {
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'You have an error in the action you are trying to do. Kindly double check and retry. Thank you!',
				  footer: '<a href>'+ thrownError +'</a>'
				});
			}
	  });
 
}

function reloadhistrory(){
	
	$('#timeline').html('');
	var ldid = $("#noteid").val();
	console.log(ldid);
	if(ldid === ""){
		return false;
	}
	var xlink = "<?php echo base_url(); ?>leadcontrol/gettimeline/" + ldid;
	console.log(xlink);
	$.get(xlink, function(data, status){
        $('#timeline').html(data);
    });
	
}


function addtask(e){
	
	var isNull = "pass";
	var formElements = new Array();
	$("#taskform :input").each(function(){
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
		$.post("<?php echo base_url("taskcontrol/newtask"); ?>",
		{data: JSON.stringify($("#taskform").serializeArray()) }) 
		.success(function(response) {
			if (response.indexOf('error') > -1){
				swal({
				  type: 'error',
				  title: 'Lead Task Error',
				  text: response,
				  footer: '<a href onclick=""> </a>'
				});
				
			}else{
			reloadtask();
				swal({
				  type: 'success',
				  title: 'New Lead Task',
				  text: 'New Lead Task has been Created. Thank you!',
				  footer: '<a href onclick=""> '+ response +'</a>'
				});
				
				$("#taskform :input").each(function(){
					$(this).val('');
				});
			}
		});	
	}
}

function reloadtask(){
	$('#tasktimeline').html('');
	var ldid = $("#lead_id").val();
	var xlink = "<?php echo base_url(); ?>taskcontrol/showtask/" + ldid;
	$.get(xlink, function(data, status){
        $('#tasktimeline').html(data);
    });
}

function reset(){
	$("#lead :input").each(function(){
		$(this).val('');
	});
}

function updatelead(){
	
	$("#leadalldata").toggle();
	
	var isNull = "pass";
	var formElements = new Array();
	$("#leadform :input").each(function(){
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
		$.post("<?php echo base_url("leadcontrol/leadupdate"); ?>",
		{data: JSON.stringify($("#leadform").serializeArray()) }) 
			.success(function(data) {
				swal({
				  type: 'success',
				  title: 'Update',
				  text: 'You have successfully updated an item!',
				  footer: '<a href>'+ data +'</a>'
				});
		});		
	}else{
		console.log('fail method execute');
	}
	
}

function cancel(){
	$('#adddiv').toggle();
	$('#updatediv').toggle();
}
</script>