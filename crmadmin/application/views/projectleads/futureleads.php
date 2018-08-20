
<div class="row">		
	<div id="adddiv" class="nav-tabs-horizontal white m-b-lg">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#futureleads" id="leaddetailtab" aria-controls="addcampaigntab" role="tab" data-toggle="tab" aria-expanded="true">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Future Leads Details</a>
			</li>
			<span role="presentation" class="btn btn-sm btn-primary pull-right"  onclick="showmodal();">
				<a href="#" style="color: #fff;">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> New Future Lead Entry </a>
			</span>
		</ul>
		<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="futureleads">
						<table id="futureleads-table" class="table table-striped" cellspacing="0" width="100%" style="font-size:11px !important;">
							<thead>
								<tr>
									<?php 
										echo $columns;
									?>
								</tr>
							</thead>
							<tbody id="futureleadsbody">
							</tbody>
						</table>
				</div>
			</div>
		</div>
</div>



<div id="futuremodal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="padding-top:10px;">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="width:90%;">
		  <div class="modal-header bg-info">
			<h4 class="modal-title" >Future Lead Details
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</h4>
		  </div>
		  <div class="modal-body">
			<div class="row" style="padding-bottom:0 !important;margin-bottom:0 !important;">
					<div class="col-md-12">
						<?php echo $form; ?>
					</div>
			</div>
			<br>
			<div class="row"  style="padding-bottom:2 !important;margin-bottom:0 !important; margin-top: 10px; ;">
				<div class="form-group">
					<div class="col-md-12">
						<label> List of Engineers</label>
						<br>
						<div id="engineers_list" class="table-responsive contentholder" contenteditable="true" name="engineers_list"><h5>List of Engineers</h5></div>
					</div>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-sm mw-md btn-success" onclick="savefuturelead();" >Save</button>
			<button type="button" class="btn btn-sm mw-md btn-danger" data-dismiss="modal">Cancel</button>
		  </div>
    </div>
  </div>
</div>
	

<script>

document.addEventListener("DOMContentLoaded", function(){
	datatablereload();
});

function showmodal(){
	$('#id').val('');
	$('#projfutureleadform :input').each(function(){
		$(this).val('');
	});
	$('#engineers_list').html('');
	$('#futuremodal').modal();
}


function datatablereload(){
		$('#prevDiv').hide();
		$('.preloader').fadeIn();
		
		$("#futureleadsbody").html('');
			
		var table = $('#futureleads-table').DataTable();
		table.destroy();
		$.post("<?php echo base_url("Projectleadcontrol/showallfutureleads"); ?>")
				.done(function(data) {
					$("#futureleadsbody").html(data);
					$('#futureleads-table').DataTable({
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

function savefuturelead(){
	
	var isNull = "pass";
	var formElements = new Array();	
	$("#projfutureleadform :input").each(function(){
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
		$.post("<?php echo base_url("Projectleadcontrol/newfuturelead"); ?>",
		{data: JSON.stringify($("#projfutureleadform").serializeArray()), engineers: $('#engineers_list').html(), }) 
			.success(function(data) {
				datatablereload();	
					
				swal({
					type: 'success',
					title: 'New Future Project Leads',
					text: 'New Future Project Leads has been Created. Thank you!',
					footer: '<a href>'+ data +'</a>'
				});	
				$('#adddiv').show();
				$('.preloader').fadeOut();			
			});	
		}
	
	$('#futuremodal').modal('hide');
	
}

function previewlead(id){
	$('#projfutureleadform :input').each(function(){
		$(this).val('');
	});
	$('#engineers_list').html('');
	
	var xlink = "<?php echo base_url(); ?>" + 'Projectleadcontrol/futureleaddetail/'  + id;
	$.get(xlink, function(data, status)
	 {
		$('#id').val(id);
		var j = JSON.parse(data);
		$.each(j[0], function(key, value){
			if(key == "engineers_list"){
				 $('#engineers_list').html(value);
			}
			$("#projfutureleadform :input").each(function(){
				var name = $(this).attr('name');
				if(name == key){
					$(this).val(value);
				}
			});
		});
	});
	$('#futuremodal').modal('show');
	
}
</script>