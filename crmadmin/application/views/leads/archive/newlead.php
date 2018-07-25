
<div class="col-md-12">
	<div id="newlead" class="widget">
		<header class="widget-header primary">
				<h4 class="widget-title"><i class="fa fa-calendar"></i> Lead Information Entries</h4>
		</header>
		<hr class="widget-separator">
		<div  class="widget-body">
				
			<div  class="nav-tabs-horizontal white m-b-lg">
					<!-- tabs list -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#leadinfo" id="leaddetailtab" aria-controls="leadinfo" role="tab" data-toggle="tab" aria-expanded="true" onclick=""><i class="fa fa-info-circle" aria-hidden="true"></i> Lead Information</a></li>
						<li role="presentation" class=""><a href="#leadnotes" aria-controls="leadnotes" role="tab" data-toggle="tab" aria-expanded="false" onclick="reloadhistory();"> <i class="fa fa-sticky-note" aria-hidden="true"></i> Notes</a></li>
						<li role="presentation" class=""><a href="#leadtask" aria-controls="leadtask" role="tab" data-toggle="tab" aria-expanded="false" onclick=""> <i class="fa fa-tasks" aria-hidden="true"></i> Task</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="leadinfo">
							<div id="leadpreviewcon" >
									<div class="row">
										<?php echo $form; ?>
									</div>
									<div class="row">
										<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewlead();" >Save</button>
										<button type="button" class="btn btn-sm mw-md btn-danger" onclick="reset();">Cancel</button>
									</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="leadnotes">
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
										<div class="col-md-6">
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
			</div>
		</div>


		
</div>

<script>

var masterid = "";

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
		$.post("<?php echo base_url("index.php/Leadcontrol/newlead"); ?>",
		{data: JSON.stringify($("#lead").serializeArray()) }) 
		.success(function(response) {
			swal({
				  type: 'success',
				  title: 'New Lead Insert',
				  text: 'New Lead Record has been Created. Thank you!',
				  footer: '<a href onclick=""> Click here to Preview </a>'
				});
			reset();
		});
	}

}

function reset(){
	$("#lead :input").each(function(){
		$(this).val('');
	});
}

function reloadhistory(e){
	$("ul.nav li").removeClass('active').addClass('disabledTab');
	if(masterid ===""){
		 e.preventDefault();
		swal({
			type: 'error',
			title: 'New Lead Insert',
			text: 'You are not allwed to perform this task right now!. Thank you!',
			footer: '<a href onclick=""> '+ masterid +' </a>'
		});
		
	}
}

</script>