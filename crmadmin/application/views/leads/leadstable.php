<div class="widget">

    <header class="widget-header primary">
        <h4 class="widget-title">Lead Tables Details</h4>
    </header>
    <!-- .widget-header -->	
    <hr class="widget-separator">
	<div class="widget-body">
	<div class="row">
			<div id="leadalldata"  class="nav-tabs-horizontal white m-b-lg">
					<!-- tabs list -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#leadinfo" aria-controls="leadinfo" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle" aria-hidden="true"></i> Lead Information</a></li>
						<li role="presentation" class=""><a href="#leadnotes" aria-controls="leadnotes" role="tab" data-toggle="tab" aria-expanded="false" onclick="reloadhistrory();"> <i class="fa fa-sticky-note" aria-hidden="true"></i> Notes</a></li>
						<li role="presentation" class=""><a href="#leadtasktab" aria-controls="leadtasktab" role="tab" data-toggle="tab" aria-expanded="false" onclick="reloadtask();"> <i class="fa fa-tasks" aria-hidden="true"></i> Task</a></li>
					</ul><!-- .nav-tabs -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="leadinfo">
							<div id="formupdate" >
									<div class="">
										<?php echo $form; ?>
									</div>
									<div id="leadtask" class="row actbutt">
										<button type="button" class="btn mw-md btn-success" onclick="unlock();" ><i class="fa fa-pencil"></i> Update</button>
										<button type="button" class="btn mw-md btn-danger" onclick="cancel();" ><i class="fa fa-close"></i> Cancel</button>
									</div>
									<div id="leadmain" class="row actbutt">
										<button type="button" class="btn mw-md btn-success" onclick="updatelead();" ><i class="fa fa-check"></i> Save</button>
										<button type="button" class="btn mw-md btn-danger" onclick="cancel();" ><i class="fa fa-ban"></i> Cancel</button>
									</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="leadnotes">
							<div class="row">
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
										<input type="hidden" id="noteid" name="noteid"></input>
										
									</form>
									<div class="row actbutt">
										<div id="leadbtnotes" class="col-md-6">
											<button type="button" class="btn mw-md btn-success float-right" onclick="addcrmnotes(event);" >Add Notes</button>
											<button type="button" class="btn mw-md btn-danger" onclick="cancel();">Cancel</button>
										</div>
									</div>
							</div>
							<hr>
							<div class="row">
								<div class="widget">
									<hr class="widget-separator">
									<div class="widget-body">
										<div id="timeline" class="streamline">
											streamline
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div role="tabpanel" class="tab-pane fade" id="leadtasktab">
							<div class="row">
								<?php echo $formtask; ?>
							</div>
							<div id="leadbttask" class="row actbutt">
								<input type="hidden" id="lead_id" name="lead_id"></input>
								<button type="button" class="btn mw-md btn-success float-right" onclick="addtask();" >Add Lead Task</button>
								<button type="button" class="btn mw-md btn-danger" onclick="cancel();">Cancel</button>
							</div>
							<br>
							<div class="row">
								<div class="widget">
									<hr class="widget-separator">
									<div class="widget-body">
										<div id="tasktimeline" class="streamline">
											streamline
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
			</div>
		</div>
	
	<div id="dtbl">
		<!-- data table -->
				<?php if(isset($leadstat)): ?>
					<div class="row">
						<div class="col-md-3">
							<label ><b>LEAD STATUS</b></label>
							<select class="form-control" id="dispo_lead_status" name="dispo_lead_status" onchange="reloadtbl($(this));">
								<option value="" disabled selected>Select From Item Below</option>
								<?php foreach($leadstat as $field=>$val): ?>
									<option value="<?php echo $val->description; ?>"><?php echo $val->description; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				<?php endif; ?>	
				
				<div class="table-responsive">
					<table id="responsive-datatable" class="table table-striped " cellspacing="1" width="100%">
						<thead>
							<tr>
								<?php 
									echo $columns;
								?>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
						<tfoot>
						</tfoot>
					</table>
				</div>
			
		</div>
    </div>

    <!-- .widget-body -->
</div>

<?php $this->load->view('footer'); ?>

<script>
var recordid = "";
var rowindex = "";

document.addEventListener("DOMContentLoaded", function() {
	datatablereload();
});

function leadupdate(bt){
	var xlink = "<?php echo base_url(); ?>" + 'leadcontrol/getleadinfo/'  + bt;
	$("#noteid").val(bt);
	$("#lead_id").val(bt);
	$('#timeline').html('');
	$.get(xlink, function(data, status)
	 {
		$('#id').val(bt);
		var j = JSON.parse(data);
		$.each(j[0], function(key, value){
			$("#leadform :input").each(function(){
				var name = $(this).attr('name');
				if(name == key){
					$(this).val(value);
				}
			});
		});
	});
	lock();
	$("#dtbl").toggle();
	$("#leadalldata").toggle();
}


function leaddelete(id){

	Swal({
		  title: 'Are you sure?',
		  text: 'Item will be permanently be removed from the database',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, delete it!',
		  cancelButtonText: 'No, keep it'
		}).then((result) => {
		  if (result.value) {
				var xlink = "<?php echo base_url(); ?>leadcontrol/leaddelete/" + id;
				$.post(xlink,) 
					.success(function(data) {
					if(data == "success"){
						datatablereload();
						swal({
							  type: 'success',
							  title: 'Delete',
							  text: 'You have success deleted an item. Thank you!',
							  footer: '<a href>'+ data +'</a>'
							});
					}else{
						datatablereload();
						swal({
							  type: 'error',
							  title: 'Oops...',
							  text: 'You have an error in the action you are trying to do. Kindly double check and retry. Thank you!',
							  footer: '<a href>'+ data +'</a>'
							});
					}		
				});
		  } else if (result.dismiss === Swal.DismissReason.cancel) {
			
		  }
		});
}

function cancel(){
	$("#dtbl").toggle();
	$("#leadalldata").toggle();
	unlock();
}

function updatelead(){
	
	$("#dtbl").toggle();
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
			datatablereload();
		});		
	}else{
		console.log('fail method execute');
	}
	
}

function datatablereload(){
	
	if(window.location.href.indexOf("leadstatus") > -1) {
		var table = $('#responsive-datatable').DataTable();
		table.destroy();
		var table = $('#responsive-datatable').DataTable( {
		ajax: "<?php echo base_url(); ?>leadcontrol/showallleads",
		dom: 'tpi',
		scrollX: true,
		scrollY: true,
		searching: true,
		columns: [
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
		],
		columnDefs: [
            { width: 150, targets: 7 }
        ],
		} );
    }else{
		var table = $('#responsive-datatable').DataTable();
		table.destroy();
		var table = $('#responsive-datatable').DataTable( {
		ajax: "<?php echo base_url(); ?>leadcontrol/showallleads",
		dom: 'ftlpi',
		scrollX: true,
		scrollY: true,
		searching: true,
		columns: [
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
		],
		columnDefs: [
            { width: 150, targets: 7 }
        ]
		} );
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
	var xlink = "<?php echo base_url(); ?>leadcontrol/gettimeline/" + ldid;
	
	console.log(xlink);
	$.get(xlink, function(data, status){
        $('#timeline').html(data);
    });
	
}

function reloadtbl(sel){
	
	var dispo = sel.val();
	var xlink = "<?php echo base_url(); ?>leadcontrol/showdispoleads/" + dispo;
	var table = $('#responsive-datatable').DataTable();
	table.destroy();
	var table = $('#responsive-datatable').DataTable( {
		dom: 'tpi',
		scrollX: true,
		scrollY: true,
		ajax:xlink,
		searching: true,
		columns: [
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
		],
		columnDefs: [
            { width: 100, targets: 7 }
        ],
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
			swal({
				  type: 'success',
				  title: 'New Lead Insert',
				  text: 'New Lead Record has been Created. Thank you!',
				  footer: '<a href onclick=""> '+ response +'</a>'
				});
				reloadtask();
				
			$("#taskform :input").each(function(){
				$(this).val('');;
			});
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


function lock(){
	$('#leadtask').show();
	$('#leadmain').hide();
	$('#leadbttask').hide();
	$('#leadbtnotes').hide();
	$("#leadform :input").each(function(){
		$(this).css({"border":"none", "background":"#f9f9f9", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',true);
	});
	
	$("#formnote :input").each(function(){
		$('#prlmain').hide();
		$(this).css({"border":"none", "background":"#f9f9f9", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',true);
	});
	
	$("#taskform :input").each(function(){
		$(this).css({"border":"none", "background":"#f9f9f9", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',true);
	});
}

function unlock(){
	$('#leadtask').hide();
	$('#leadmain').show();
	$('#leadbttask').show();
	$('#leadbtnotes').show();
	
	$("#leadform :input").each(function(){
		$(this).css({"border":"1px solid #e2e2e2", "background":"#fffef2", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',false);
	});
	$("#formnote :input").each(function(){
		$(this).css({"border":"1px solid #e2e2e2", "background":"#fffef2", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',false);
	});
	$("#taskform :input").each(function(){
		$(this).css({"border":"1px solid #e2e2e2", "background":"#fffef2", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',false);
	});
}

</script>