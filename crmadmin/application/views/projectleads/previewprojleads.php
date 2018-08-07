

<div  class="widget">
    <header class="widget-header info">
        <h4 class="widget-title">Project Leads Details</h4>
    </header>
    <hr class="widget-separator">
		<div class="widget-body">
			<div id="prlupdate">
				<div class="">
					<?php echo $form; ?>
				</div>
				<br>
				<br>
				<br>
				<div id="prltask" class="row actbutt">
					<button type="button" class="btn mw-md btn-success" onclick="prcUpdate();" ><i class="fa fa-pencil"></i> Update</button>
					<button type="button" class="btn mw-md btn-danger" onclick="cancelupdate();"><i class="fa fa-close"></i> Cancel</button>
				</div>	
				<div id="prlmain" class="row actbutt">
					<button type="button" class="btn mw-md btn-success" onclick="updateprojlead();" ><i class="fa fa-check"></i> Save</button>
					<button type="button" class="btn mw-md btn-danger" onclick="cancelupdate();"><i class="fa fa-ban"></i> Cancel</button>
				</div>	
			</div>

        <div id="dtbl" class="table-responsive">
			<div id="leadsel" class="row">
				<label class="col-md-1">Status</label>
				<div class="col-md-3 float-right">
						<select class="form-control" onchange="datatablereload($(this).val());">
						   <option value="ALL" >All Leads</option>
							<?php foreach($leadstat as $field=>$val): ?>
								<option value="<?php echo $val->description; ?>"><?php echo $val->description; ?></option>
							<?php endforeach; ?>
						</select>
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
				<tbody>
				
				</tbody>
				<tfoot>
				
				</tfoot>
			</table>
		</div>
	</div>
</div>

<div id="statmodal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lead Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form id="upform" method="POST">
				<input type="hidden" id="leaddelete" name="leaddelete" ></input>
				<label for="leadstatusupdate">Lead Status</label>
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

<script>
var recordid = "";
var rowindex = "";

document.addEventListener("DOMContentLoaded", function() {
	datatablereload('');
});

function datatablereload(sts){

	if(window.location.href.indexOf("showcampaigntable") > -1) {
		var table = $('#responsive-datatable').DataTable();
		table.destroy();
		var table = $('#responsive-datatable').DataTable( {
		dom: "ftpi",
		ajax: "<?php echo base_url(); ?>Projectleadcontrol/showallprojleads/" + sts,
		searching: true,
		responsive: false,
		columns: [
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			{ "width": "10%" },
		]
		} );
    }else{
		var table = $('#responsive-datatable').DataTable();
		table.destroy();
		var table = $('#responsive-datatable').DataTable( {
		ajax: "<?php echo base_url(); ?>Projectleadcontrol/showallprojleads/" + sts,
		dom: 'ftpi',
		searching: true,
		responsive: false,
		columns: [
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			{ "width": "10%" },
		]
		} );
	}

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
	$('#more_info').summernote('destroy');
	var xlink = "<?php echo base_url(); ?>" + 'Projectleadcontrol/getleaddetail/'  + bt;
	$.get(xlink, function(data, status)
	 {
		$('#id').val(bt);
		unlock();
		var j = JSON.parse(data);
		$.each(j[0], function(key, value){
			$("#projleadform :input").each(function(){
				var name = $(this).attr('name');
				if(name == key){
					if(key.indexOf('date') > 0){
						var nd = new Date(value)
						$(this).val(formatDate(nd.toDateString()));
					}else{
						if(name == "more_info"){
							$(this).val(value);
							$('#more_info').summernote({
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
							$('#more_info').summernote('disable');		
						}else if(name == "bid_value"){
							//$(this).val((value).toLocaleString('en-US', {style: 'currency',currency: 'USD',}));
							$('#bid_value').val((value).toLocaleString('en-US', {style: 'currency',currency: 'USD',}));
						}else{
							$(this).val(value);
						}
						
					}
				}
			});
		});
		lock();
	});
	
	$('#prlupdate').toggle();
	$('#dtbl').toggle();

}

function cancelupdate(){
	$('#dtbl').toggle();	
	$('#prlupdate').toggle();
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
		$('#prlmain').hide();
		$(this).css({"border":"none", "background":"#f9f9f9", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',true);
		$('#prltask').show();
	});
}

function unlock(){
	$("#projleadform :input").each(function(){
		$('#prlmain').show();
		$(this).css({"border":"1px solid #e2e2e2", "background":"#fffef2", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',false);
		$('#prltask').hide();
	});		
}

function prcUpdate(){
	$('#more_info').summernote('enable');
	unlock();
}

function proj_reset(){
	$("#projleadform :input").each(function(){
		$(this).val('');
	});		
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

</script>