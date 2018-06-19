
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header primary">
				<h4 class="widget-title"><i class="fa fa-calendar"></i> Campaign Information Entries</h4>
		</header>
		<hr class="widget-separator">
		<div class="widget-body">
				
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
							<button type="button" class="btn btn-primary" onclick="addmyitem('xx');">Add Item</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					  </div>
					</div>
				  </div>
				</div>
				
				<div id="leadalert" class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong>Well done! </strong>
					<span id="alertmsg">...</span>
				</div>
				<form id="newcampaign" method="POST" action="#">
					<div class="row">
					
				
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
							
							<?php elseif($val['field_type'] == "DATE"): ?>
									<div class="col-md-3">
										<div class="form-group">
											<label for="<?php echo $val['field_name']; ?>"><?php echo strtoupper(str_replace("_", " ", $val['field_name'])); ?></label>
											<input type="date" class="form-control" id="<?php echo $val['field_name']; ?>" placeholder="<?php echo $val['field_name']; ?>" name="<?php echo $val['field_name']; ?>" value="<?php echo $val['field_default']; ?>"  <?php if($val['field_required'] == 1){echo "required"; }?>></input>
										</div>
									</div>
							<?php endif;  ?>
					
						<?php endforeach; ?>

					</div>
			
					<div class="row">
						<button type="button" class="btn mw-md btn-success" onclick="processcampaign();" >Save</button>
						<button type="button" class="btn mw-md btn-danger" onclick="reset();">Cancel</button>
					</div>
					
				</form>
				<br/>
		</div>
	</div>
</div>



<script>

var optfield = "";

function shwmodal(fld){
	optfield = fld;
	$("#newitemmodal").modal();
	$("#newitemmodal .modal-title").html("<i class='fa fa-exchange' aria-hidden='true'></i> New Item for " + fld);
}

function processcampaign(){
	
	var isNull = "pass";
	var formElements = new Array();
	$("#newcampaign :input").each(function(){
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
		$.post("<?php echo base_url("process/campaignInsert"); ?>",
		{data: JSON.stringify($("#newcampaign").serializeArray()) }) 
		.success(function(data) {
			$('#leadalert').fadeIn('slow', function(){
						$('#alertmsg').html('Campaign Record has been Created! ' + data);
					$('#leadalert').delay(1000).fadeOut(); 
				});
			});
		
	}
		
}

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
			}
			else{
				$('#newitemalert').fadeIn('slow', function(){
					$('#newitmmsg').html("Error " + data);
					$('#newitemalert').delay(1000).fadeOut(); 
				});
			}


		});
		
	}

}


function reset(){
	document.getElementById('newcampaign').reset()
}
</script>