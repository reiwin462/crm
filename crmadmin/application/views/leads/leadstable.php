
<div id="newitemmodal" class="modal fade" >
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></button>
            <p class="modal-title">  New Item</p>
         </div>
         <div class="modal-body">
            <div id="newitemalert" class="alert alert-warning alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <strong>Message! </strong>
               <span id="newitmmsg">...</span>
            </div>
            <label>Please Enter Your Additional Item Below</label>
            <input type="text" id="newitem" required ></input>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="addmyitem('xx');">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

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
					</ul><!-- .nav-tabs -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="leadinfo">
							<form id="formupdate" method="POST" action="#">
									<div class="row">
										<input type="hidden" name="id"></input>
										<?php foreach($structure as $field => $val): ?>
											<?php if($val['field_type'] == "TEXT"): ?>
												<div class="col-md-3" >
													<div class="form-group">
														<label for="<?php echo $val['field_name']; ?>"><?php echo strtoupper(str_replace("_", " ", $val['field_name'])); ?></label>
														<input type="text" class="form-control" id="<?php echo $val['field_name']; ?>" placeholder="<?php echo $val['field_name']; ?>" name="<?php echo $val['field_name']; ?>" value="<?php echo $val['field_default']; ?>"  <?php if($val['field_required'] == 1){echo "required"; }?> ></input>
													</div>
												</div>
											<?php elseif($val['field_type'] == "DROPDOWN"): ?>
												<div class="col-md-3">
													<div class="form-group">
														<label for="<?php echo $val['field_name']; ?>"><?php echo strtoupper(str_replace("_", " ", $val['field_name'])); ?></label>
														<select class="form-control" id="<?php echo $val['field_name']; ?>" name="<?php echo $val['field_name']; ?>" >
															<?php foreach($val['field_subitems'] as $item): ?>
															<option value="<?php echo $item['description']; ?>"><?php echo $item['description']; ?></option>
															<?php endforeach; ?>
														</select>	
														<div class="text-right addnew">
															<a href="#" onclick="shwmodal('<?php echo $val['field_name']; ?>');" ><i class="fa fa-plus" aria-hidden="true"></i> Add Item!</a>
														</div>
													</div>
												</div>
											<?php elseif($val['field_type'] == "TEXTAREA"): ?>
													<div class="col-md-12">
														<div class="form-group">
															<label for="<?php echo $val['field_name']; ?>"><?php echo strtoupper(str_replace("_", " ", $val['field_name'])); ?></label>
															<textarea class="form-control" id="<?php echo $val['field_name']; ?>" placeholder="<?php echo $val['field_name']; ?>" name="<?php echo $val['field_name']; ?>"  <?php if($val['field_required'] == 1){echo "required"; }?>><?php echo $val['field_default']; ?> </textarea>
														</div>
													</div>
											
											<?php elseif($val['field_type'] == "DATE "): ?>
													<div class="col-md-3">
													
													</div>	
											<?php endif;  ?>
									
										<?php endforeach; ?>
									</div>
									
									
									<div class="row">
										
										<button type="button" class="btn mw-md btn-success" onclick="updatelead();" >Update</button>
										<button type="button" class="btn mw-md btn-danger" onclick="cancel();" >Cancel</button>
									</div>
									
							</form>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="leadnotes">
							<div id="newcommentalert" class="alert alert-warning alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								  <strong>Message! </strong>
									<span id="newcommentmsg">...</span>
							</div>
							
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
										
										<div class="col-md-6">
											<input type="hidden" id="noteid" name="noteid"></input>
											<button type="button" class="btn mw-md btn-success float-right" onclick="addcrmnotes(event);" >Add Notes</button>
											<button type="button" class="btn mw-md btn-danger" onclick="cancel();">Cancel</button>
										</div>
									</form>
							</div>
							<hr>
							<div class="row">
								<div class="widget">
									<header class="widget-header primary">
										<h4 class="widget-title">Notes</h4>
									</header>
									<hr class="widget-separator">
									<div class="widget-body">
										<div id="timeline" class="streamline">
											..
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	
		<div id="leadalert" class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>Well done! </strong>
			<span id="alertmsg">...</span>
		</div>
	<div id="dtbl">
		<!-- data table -->
		<?php if(isset($leadstat)): ?>
					<div class="col-md-3">
						<label ><b>LEAD STATUS</b></label>
						<select class="form-control" id="dispo_lead_status" name="dispo_lead_status" onchange="reloadtbl(this);">
							<?php foreach($leadstat as $field=>$val): ?>
								<option value="<?php echo $val->description; ?>"><?php echo $val->description; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
			<?php endif; ?>	
		
        <table id="responsive-datatable"  class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
					<?php 
						echo $columns;
					?>
                </tr>
            </thead>
			<tbody>
					<?php //echo $rows; ?>
			</tbody>
            <tfoot>
                
            </tfoot>
        </table>
		
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
	var xlink = "<?php echo base_url(); ?>" + 'process/getleadinfo/'  + bt;
	$("#noteid").val(bt);
	$('#timeline').html('');
	$.get(xlink, function(data, status)
	 {
		$('#id').val(bt);
		var j = JSON.parse(data);
		$.each(j[0], function(key, value){
			$("#formupdate :input").each(function(){
				var name = $(this).attr('name');
				if(name == key){
					$(this).val(value);
				}
			});
		});
	});

	$("#dtbl").toggle();
	$("#leadalldata").toggle();
}


function leaddelete(id){
	var xlink = "<?php echo base_url(); ?>process/leaddelete/" + id;

	$.post(xlink,) 
		.success(function(data) {
		if(data == "success"){
			$('#alertmsg').html('Lead Record has Successfully been Deleted');
			$('#leadalert').fadeIn('slow', function(){
				$('#leadalert').delay(1000).fadeOut(); 
			});
		}else{
			$('#alertmsg').html(data);
			$('#leadalert').fadeIn('slow', function(){
				$('#leadalert').delay(1000).fadeOut(); 
			});
		}		
	});
	
	datatablereload();
}

function cancel(){
	$("#dtbl").toggle();
	$("#leadalldata").toggle();
	//$("#formupdate").reset();
}


function updatelead(){
	
	$("#dtbl").toggle();
	$("#leadalldata").toggle();
	
	var isNull = "pass";
	var formElements = new Array();
	$("#formupdate :input").each(function(){
		var isRequired = $(this).attr('required');
		if(isRequired == "required"){
			if($(this).val() == ""){
				alert($(this).attr('name') + " is required!");
				isNull = "fail";
				return false;
			}
		}
	});
	
	if(isNull == "pass"){
		$.post("<?php echo base_url("process/leadupdate"); ?>",
		{data: JSON.stringify($("#formupdate").serializeArray()) }) 
			.success(function(data) {
				$('#leadalert').fadeIn('slow', function(){
					$('#alertmsg').html('Lead Record has been Updated' + data);
					$('#leadalert').delay(1000).fadeOut(); 
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
		ajax: "<?php echo base_url(); ?>process/showallleads",
		dom: 'tpi',
		searching: true,
		responsive: true,
		} );
    }else{
		var table = $('#responsive-datatable').DataTable();
		table.destroy();
		var table = $('#responsive-datatable').DataTable( {
		ajax: "<?php echo base_url(); ?>process/showallleads",
		dom: 'ftlpi',
		searching: true,
		responsive: true,
		} );
	}
	

	
}

var optfield = "";

function addmyitem(){
	var newitem = '';
	newitem = $('#newitem').val();
	if(newitem == ""){
		$('#newitemalert').fadeIn('slow', function(){
			$('#newitmmsg').html('Please enter some Details');
			$('#newitemalert').delay(1000).fadeOut(); 
		});
	}else{
		var xlink = "<?php echo base_url(); ?>process/newitem/" + optfield + "/" + newitem;
		 $.post(xlink,) 
			.success(function(data) {
			if(data == "success"){
				$('#'+ optfield).append($('<option>', {
					value: newitem,
					text: newitem,
				}));
				$("#newitemmodal").modal('hide');
				$('#leadalert').fadeIn('slow', function(){
					$('alertmsg').html('New Item Has been Added');
					$('#leadalert').delay(1000).fadeOut(); 
				});
				$('#newitem').val('');
				newitem='';
			}else{
				$('#newitemalert').fadeIn('slow', function(){
					$('#newitmmsg').html("Error " + data);
					$('#newitemalert').delay(1000).fadeOut(); 
				});
			}
		});
		
	}

}

function leadalert(fld){
	optfield = fld;
	$("#newitemmodal").modal();
	$("#newitemmodal .modal-title").html("<i class='fa fa-exchange' aria-hidden='true'></i> New Item for " + optfield);
}

function shwmodal(fld){
	optfield = fld;
	$("#newitemmodal").modal();
	$("#newitemmodal .modal-title").html("<i class='fa fa-exchange' aria-hidden='true'></i> New Item for " + fld);
}


function addcrmnotes(e){
	

	var fildata = document.getElementById("file").value;
	var fd = new FormData($("#formnote")[0]);

	fd.append('file', document.getElementById("file").files[0]);
		$.ajax({
		   url:"<?php echo base_url(); ?>process/noteinsert",
		   method:"POST",
		   enctype: 'multipart/form-data',
		   data: fd,
		   contentType:false,
		   cache:false,
		   processData:false,
		   success:function(response){
				
				reloadhistrory();
				
				$('#newcommentalert').fadeIn('slow', function(){
						$('#newcommentmsg').html(response);
					$('#newcommentalert').delay(1000).fadeOut(); 
				});
		   },
		   error: function (xhr, ajaxOptions, thrownError) {
				alert(thrownError);
			}
	  });
 
}

function reloadhistrory(){
	
	$('#timeline').html('');
	var ldid = $("#noteid").val();
	console.log(ldid);
	var xlink = "<?php echo base_url(); ?>process/gettimeline/" + ldid;
	
	console.log(xlink);
	$.get(xlink, function(data, status){
        $('#timeline').html(data);;
    });
	
}

function reloadtbl(sel){
	
	var dispo = sel.value;
	var xlink = "<?php echo base_url(); ?>process/showdispoleads/" + dispo;
	console.log(xlink);
	var table = $('#responsive-datatable').DataTable();
	table.destroy();
	var table = $('#responsive-datatable').DataTable( {
	dom: 'tpi',
	ajax:xlink,
	searching: true,
	responsive: true,
	});
	
}

</script>