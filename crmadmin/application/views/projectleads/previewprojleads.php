
<div  class="widget">
    <header class="widget-header info">
        <h4 class="widget-title">Project Leads Details</h4>
    </header>
    <hr class="widget-separator">
		<div class="widget-body">
			<div id="prlupdate"  class="nav-tabs-horizontal white m-b-lg">
					<ul class="nav nav-tabs" role="tablist">
						<div class="text-right" style="z-index: -1"><i class="fa fa-close" ></i>&nbsp;<a href='#' onclick="cancelupdate();">Close &nbsp;</a></div>
						<li role="presentation" >
							<a href="#addleadtab" id="leaddetailtab" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true">
							<i class="fa fa-plus-circle" aria-hidden="true"></i> Project Leads Details</a>
						</li>
					</ul>
					
					<div class="tab-content" id="leadtab">
						<div role="tabpanel" class="tab-pane fade active in" id="addleadtab">
							<div class="row">
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
							<br>								
							<div class="row actbutt prlmain">
									<button type="button" class="btn mw-md btn-success" onclick="updateprojlead();" ><i class="fa fa-check"></i> Save Update</button>
									<button type="button" class="btn mw-md btn-warning" onclick="cancelupdate();"><i class="fa fa-ban"></i> Cancel</button>
							</div>
							
							<div id="" class="row actbutt prltask">
								<br>
									<button type="button" class="btn mw-md btn-success" onclick="prcUpdate();" ><i class="fa fa-pencil"></i> Edit</button>
									<button type="button" class="btn mw-md btn-warning" onclick="cancelupdate();"><i class="fa fa-close"></i> Cancel</button>	
							</div>	
						<hr>
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
								<div role="tabpanel" class="tab-pane  fade active in" id="addleadspec">		
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
												<div class="col-md-12 prlmain">
													<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewleadspecs();" > <i class="fa fa-check"></i>Save</button>
												</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="addengineer">		
									<div class="row">		
										<footer class="widget-footer bg-info"><h5>Please copy the table from the Weblink and Paste it to the Field Below</h5></footer>
										<div id="engineers" class="table-responsive contentholder" contenteditable="true" preloader="Engineers List">Engineers List!</div>
										<div class="col-md-12 prlmain">
											<br>
											<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewengineer();" > <i class="fa fa-check"></i>Save Engineers List</button>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="addplanholder">		
									<div class="row">		
										<footer class="widget-footer bg-info"><h5>Please copy the table from the Weblink and Paste it to the Field Below</h5></footer>
										<div id="planholder" class="table-responsive contentholder" contenteditable="true" preloader="Plan Holder List">PLan Holders List!</div>
										<div class="col-md-12 prlmain">
											<br>
											<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewplanholder();" > <i class="fa fa-check"></i>Save Plan Holders List</button>
										</div>
									</div>	
								</div>
								<div role="tabpanel" class="tab-pane" id="addbidders">
									<div class="row">
										<footer class="widget-footer bg-info"><h5>Please copy the table from the Weblink and Paste it to the Field Below</h5></footer>
										<div id="bidders" class="table-responsive contentholder" contenteditable="true" preloader="Bidders List">Bidders List!</div>
										<div class="col-md-12 prlmain">
											<br>
											<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewbidders();" > <i class="fa fa-check"></i>Save Bidders List</button>
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
												<br>
												<button type="button" class="btn btn-sm mw-md btn-success prlmain" onclick="addnewdocument();" > <i class="fa fa-check"></i>Save Document</button>
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
														<input type="button" value="submit" class="btn-primary btn-sm prlmain" onclick="leadplanupload();"></input>
													</div>
													
													<input type="hidden" id="leadid" name="leadid" ></input>
													
												</form>
											</div>

									<div class="row">
										<div class="container table-responsive">
											<table id="planlist" class="">
												
											</table>
										</div>
									</div>
								</div>
								
								<div role="tabpanel" class="tab-pane" id="addrfi">				
									<div class="row">
										<div class="col-md-12">
											<?php echo $formrfi; ?>
											<div class="col-md-12">
											
												<button type="button" class="btn btn-sm mw-md btn-success prlmain" onclick="addrfi();" > <i class="fa fa-check"></i>Save</button>										
											</div>
										</div>					
									</div>
								</div>
							</div>
						</div>
						
						</div>
						
					</div>
			</div>
		

        <div id="dtbl"  class="widget">
			<div class="widget-body">
				<div class="nav-tabs-horizontal white m-b-lg">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" >
							<a href="#leadall" id="leaddetailtab" aria-controls="showleadall" role="tab" data-toggle="tab" aria-expanded="true">
							<i class="fa fa-bank" aria-hidden="true"></i> Project Leads </a>
						</li>
						<li role="presentation" >
							<a href="#clientwon" id="leaddetailtab" aria-controls="showleadall" role="tab" data-toggle="tab" aria-expanded="true" onclick="reloadwon();">
							<i class="fa fa-bullseye" aria-hidden="true"></i> Won Client </a>
						</li>
						<li role="presentation" >
							<a href="#leaddead" id="leaddetailtab" aria-controls="showleadall" role="tab" data-toggle="tab" aria-expanded="true" onclick="reloaddead();">
							<i class="fa fa-eraser" aria-hidden="true"></i> Dead Leads </a>
						</li>
					</ul>
				</div>
				<div class="tab-content" id="showleadall">
					<div role="tabpanel" class="tab-pane fade active in" id="leadall">

						<div id="leadsel" class="row">
							<div class="col-md-12">
								<label class="col-md-1">Status</label>
								<div class="col-md-2">
									<select class="form-control" onchange="datatablereload($(this).val());">
										<option value="ALL" >All Leads</option>
											<?php foreach($leadstat as $field=>$val): ?>
												
												<?php if($val->description != "WON" or $val->description != "DEAD"): ?>
												<option value="<?php echo $val->description; ?>"><?php echo $val->description; ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
									</select>
								</div>
								<div class="col text-right">
										<small><i class="fa fa-circle-o sun" aria-hidden="true"></i> Waiting for RFI</small>
										<small><i class="fa fa-circle-o hot" aria-hidden="true"></i> Incomplete</small>
										<small><i class="fa fa-circle-o success" aria-hidden="true"></i> Success</small>
								</div>
							</div>
						</div>
							<table id="responsive-datatable" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<?php 
											echo $columns;
										?>
									</tr>
								</thead>
								<tbody id="leadsbody">
								</tbody>
							</table>
					</div>
					<div role="tabpanel" class="tab-pane" id="clientwon">
						<small>Client Won Leads List</small>
						<table id="won-datatable" class="table table-striped" cellspacing="0" width="100%">
							<thead>
								<tr>
									<?php 
										echo $columns;
									?>
								</tr>
							</thead>
							<tbody id="wonleadsbody">
							</tbody>
						</table>
					</div>
					<div role="tabpanel" class="tab-pane" id="leaddead">
						<small>Dead Leads List</small>
						<table id="dead-datatable" class="table table-striped" cellspacing="0" width="100%">
							<thead>
								<tr>
									<?php 
										echo $columns;
									?>
								</tr>
							</thead>
							<tbody id="deadleadsbody">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="statmodal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">Lead Update</h5>		
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form id="upform" method="POST">
				<input type="hidden" id="leaddelete" name="leaddelete" ></input>
				<select class="form-control" id="leadstatusupdate" id="lead_status">
					<option value="" disabled selected>Select From Item Below</option>
						<?php foreach($leadstat as $field=>$val): ?>
							<option value="<?php echo $val->description; ?>"><?php echo $val->description; ?></option>
						<?php endforeach; ?>
				</select>
			</form>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-danger float-left" onclick="projleaddelete();"><i class='fa fa-trash' aria-hidden='true' style='font-size:16px'></i>&nbsp; Delete</button>
        <button type="button" class="btn btn-primary" onclick="projleadinstaupdate();"><i class='fa fa-save' aria-hidden='true' style='font-size:16px'></i>&nbsp; Save Changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
var recordid = "";
var rowindex = "";

document.addEventListener("DOMContentLoaded", function() {
	$('#more_info').summernote({
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
	
	$('#project_scope').summernote({
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
	
	datatablereload('');
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

function datatablereload(sts){
		//var table = $('#responsive-datatable').DataTable();

		$('#prevDiv').hide();
		$('.preloader').fadeIn();	
		$("#leadsbody").html('');
		$.post("<?php echo base_url("Projectleadcontrol/showallprojleads/"); ?>",{ stat : sts})
				.done(function(data) {
					var table = $('#responsive-datatable').DataTable();
					table.destroy();
					$("#leadsbody").html(data);
					$('#responsive-datatable').DataTable({
						dom: 'ftpi',
						bStateSave: true,
						scrollX:        true,
						scrollCollapse: true,
						autoWidth:   false,  
						paging:         true,       
						
					});
			});
		$('#prevDiv').show();
		$('.preloader').hide()

}

function reloaddead(){
	$.post("<?php echo base_url("Projectleadcontrol/showallprojleads/"); ?>",{ stat : "DEAD"})
		.done(function(data) {
		var table = $('#dead-datatable').DataTable();
		table.destroy();
		$("#deadleadsbody").html(data);
		$('#dead-datatable').DataTable({
			dom: 'ftpi',
		});
	});
}

function reloadwon(){
	$.post("<?php echo base_url("Projectleadcontrol/showallprojleads/"); ?>",{ stat : "WON"})
		.done(function(data) {
		var table = $('#won-datatable').DataTable();
		table.destroy();
		$("#wonleadsbody").html(data);
		$('#won-datatable').DataTable({
			dom: 'ftpi',
		});
	});
}

function updateprojlead(){
	
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
		$('#prevDiv').hide();
		$('.preloader').fadeIn();
		$.post("<?php echo base_url("Projectleadcontrol/projleadupdate"); ?>",
		{data: JSON.stringify($("#projleadform").serializeArray()) }) 
			.success(function(data) {
				swal({
				  type: 'success',
				  title: 'Update',
				  text: 'You have successfully updated a lead!',
				  footer: '<a href>'+ data +'</a>'
				});
			datatablereload('');			
			$('.preloader').fadeOut();
			$('#prevDiv').show();			
		});
		$("#dtbl").toggle();
		$("#prlupdate").toggle();
	}else{
		console.log('fail method execute');
	}

}



function projleadupdate(bt){

	//$('#more_info').summernote('destroy');
	//$('#project_scope').summernote('destroy');
	$('#leadid').val(bt);
	$('#leaddelete').val(bt);
	var xlink = "<?php echo base_url(); ?>" + 'Projectleadcontrol/getleaddetail/'  + bt;
	$.get(xlink, function(data, status)
	 {
		$('#id').val(bt);
		unlock();
		var j = JSON.parse(data);
		$.each(j[0], function(key, value){
			if(key == "more_info"){
				$('#more_info').summernote('code', value);
				$('#more_info').summernote('disable');
			}else if(key == "project_scope"){				
				$('#project_scope').summernote('code', value);
				$('#project_scope').summernote('disable');
			}
			$("#projleadform :input").each(function(){
				var name = $(this).attr('name');
				if(name == key){
					if(key.indexOf('date') > 0){
						var nd = new Date(value)
						$(this).val(formatDate(nd.toDateString()));
					}else{
						if(name == "bid_value"){
							//$(this).val((value).toLocaleString('en-US', {style: 'currency',currency: 'USD',}));
							$('#bid_value').val((value).toLocaleString('en-US', {style: 'currency',currency: 'USD',}));
						}else if(name == "address"){
							$(this).val(value);
							if(value != ""){
								$('#geomaps').attr('src', "https://www.google.com/maps/embed/v1/place?key=AIzaSyBgdwfZSVM-XkwgcnoJMr-bmWPlEhVxbpE&q=" + value);
							}
						}else{
							$(this).val(value);
						}
						
					}
					
					$('#engineers').load('<?php echo base_url(); ?>/projectleadpreview/showhtmltable/project_engineers/' + bt);
					$('#bidders').load('<?php echo base_url(); ?>/projectleadpreview/showhtmltable/project_bidders/' + bt);
					$('#planholder').load('<?php echo base_url(); ?>/projectleadpreview/showhtmltable/project_planholders/' + bt);
					
					/*
					$('#more_info').summernote({
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
							//$('#more_info').summernote('code', value);
							//$('#more_info').summernote('disable');
					$('#project_scope').summernote({
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
						*/
							
							//$('#project_scope').summernote('code', value);
							//$('#project_scope').summernote('disable');
				}
			});
		});
		lock();
	});
	
	$('#prlupdate').toggle();
	$('#dtbl').toggle();

}

function cancelupdate(){
	$('#dtbl').show();	
	$('#prlupdate').hide();
	proj_reset();
	lock();
}

function projleaddelete(){
	var id = $('#leaddelete').val();
	Swal({
		  title: 'Are you sure?',
		  text: 'Item will be permanently be removed from the database',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, delete it!',
		  cancelButtonText: 'No, keep it'
		}).then((result) => {
		  if (result.value) {
			  $('#statmodal').modal('hide');
			  $('#prevDiv').hide();
			  $('.preloader').fadeIn();	
				var xlink = "<?php echo base_url(); ?>Projectleadcontrol/projleadremove/" + id;
				$.post(xlink,) 
				.success(function(data) {
						
						datatablereload('');
						swal({
							  type: 'success',
							  title: 'Delete',
							  text: 'You have successfully deleted an item. Thank you!',
							  footer: '<a href>'+ data +'</a>'
							});
						cancelupdate();
						$('.preloader').fadeOut();
						$('#prevDiv').show();		
				});
				
		  } else if (result.dismiss === Swal.DismissReason.cancel) {
		  }
		});

}

function projleadinstaupdate(){
	var id = $('#leaddelete').val();
	var sts = $('#leadstatusupdate').val();
	Swal({
		  title: 'Are you sure?',
		  text: 'Lead Status will be Updated!',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, Update it!',
		  cancelButtonText: 'No, keep it'
		}).then((result) => {
			$('#statmodal').modal('hide');	
		  if (result.value) {
			  $('#statmodal').modal('hide');
			  $('#prevDiv').hide();
			  $('.preloader').fadeIn();	
				var xlink = "<?php echo base_url(); ?>Projectleadcontrol/statupdate/" + id;
				$.post(xlink,{data: {lead_status: sts, id:id}}) 
				.success(function(data) {
						datatablereload('');
						swal({
							  type: 'success',
							  title: 'Update',
							  text: 'You have successfully updated an item. Thank you!',
							  footer: '<a href>'+ data +'</a>'
							});
						$('.preloader').fadeOut();
						$('#prevDiv').show();		
				});
				
		  } else if (result.dismiss === Swal.DismissReason.cancel) {
			
		  }
		});
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}


function lock(){
	$("#projleadform :input").each(function(){
		$('.prlmain').hide();
		$(this).css({"border":"none", "background":"#f9f9f9", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',true);
		$('.prltask').show();
	});
}

function unlock(){
	$("#projleadform :input").each(function(){
		$('.prlmain').show();
		$(this).css({"border":"1px solid #e2e2e2", "background":"#fffef2", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',false);
		$('.prltask').hide();
	});		
}

function prcUpdate(){
	$('#more_info').summernote('enable');
	$('#project_scope').summernote('enable');
	unlock();
}

function proj_reset(){
	
	$('#lead_id').val('');
	$("#projleadform :input").each(function(){
		$(this).val('');
	});
	
	$("#projrfi :input").each(function(){
			$(this).val('');
	});

	$('#engineer').html('');
	$('#planholder').html('');
	$('#bidder').html('');
	$('#doclist').html('');
	
	$('#leaddetailtab').trigger('click');
	$('#leadspec').trigger('click');
}

function openlink(lnk){
	 window.open('www.yourdomain.com','_blank');
	var win = window.open(lnk, '_blank');
	win.focus();
}

function projleadmanage($id){
	$('#leaddelete').val($id);
	$('#statmodal').modal();
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

function reloadrfi(){
	var idfld = $('#leadid').val();
	if(idfld == ""){
		return false;
	}
	$('#doclist').html('');
	var xlink = "<?php echo base_url(); ?>projectleadcontrol/getrfi/" + idfld;
	$.get(xlink, function(data, status){
       if(data != ""){
			var j = JSON.parse(data);
			$.each(j[0], function(key, value){
				$("#projrfi :input").each(function(){
					var name = $(this).attr('name');
					if(name == key){
						if(key == "send_date" || key == "date_recieved"){
							var nd = new Date(value)
							$(this).val(formatDate(nd.toDateString()));
						}else{
							$(this).val(value);
						}
					}
				});
			});
	   }
    });
}

function resetcancel(){
	$("#projleadform :input").each(function(){
		$(this).val('');
	});
	$('#updatediv').hide();
	$('#adddiv').show();	
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
						}else if (response.indexOf('error') > -1){
							swal({
							  type: 'error',
							  title: 'Upload Error',
							  text:  response,
							  footer: '<a href>'+ response +'</a>'
							});
						}else{
							swal({
							  type: 'error',
							  title: 'Upload',
							  text: 'Your file may be corrupted or exceeds the server limit of 8388608 bytes',
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

function showme(img){
	$('#imgprev').attr('src', img.attr('src'));
	$('#imgcaption').attr('src', img.val());
	$('#imgmodal').modal();
}

function updaterfi(){
	
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
				var xlink = "<?php echo base_url(); ?>Projectleadcontrol/planremove";
				$.post(xlink,{planid: id}) 
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