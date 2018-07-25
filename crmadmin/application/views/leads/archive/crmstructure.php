
<?php
//print_r($param);
/*
foreach($param as $field => $val){
	//echo $val['field_name']. "<br>";
	if (count($val['field_subitems']) > 0){
		foreach($val['field_subitems'] as $item){
			//echo "-". $item['description'].'<br>';
		}
	}
}
*/	
?>



<div class="col-md-12">
	<div class="widget">
		<header class="widget-header primary">
				<h4 class="widget-title"><i class="fa fa-calendar"></i> Lead Information Entries</h4>
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
				
				<form id="lead" method="POST" action="#">
					<div class="row">
					
						<?php foreach($param as $field => $val): ?>
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
						<button type="button" class="btn mw-md btn-success" onclick="processlead();" >Save</button>
						<button type="button" class="btn mw-md btn-danger" onclick="reset();">Cancel</button>
					</div>
					
				</form>
				<br/>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>



<script>



var optfield = "";

function shwmodal(fld){
	optfield = fld;
	$("#newitemmodal").modal();
	$("#newitemmodal .modal-title").html("<i class='fa fa-exchange' aria-hidden='true'></i> New Item for " + fld);
}

function processlead(){
	var isNull = "pass";
	var formElements = new Array();
	$("#lead :input").each(function(){
		var isRequired = $(this).attr('required');
		if(isRequired == "required"){
			if($(this).val() == ""){
				swal({
				  type: 'error',
				  title: 'Checking...',
				  text: $(this).attr('name') + ' is a required field. Thank you!',
				  footer: '<a href>'+ data +'</a>'
				});
				
				isNull = "fail";
				return false;
			}
		}
	});
	
	if(isNull == "pass"){
		$.post("<?php echo base_url("index.php/process/leadinsert"); ?>",
		{data: JSON.stringify($("#lead").serializeArray()) }) 
		.success(function(data) {
			swal({
				  type: 'success',
				  title: 'Uploaded...',
				  text: 'Lead Record has been Created. Thank you!',
				  footer: '<a href>'+ data +'</a>'
				});
			reset();
		}
	}
		
}

function addmyitem(){
	var newitem = '';
	newitem = $('#newitem').val();
	if(newitem == ""){
		swal({
			type: 'error',
			title: 'Oops...',
			text: 'Please supply the necessary field Thank you!',
			footer: '<a href> - </a>'
		});
	}else{
		var xlink = "<?php echo base_url(); ?>index.php/process/newitem/" + optfield + "/" + newitem;
		 $.post(xlink,) 
			.success(function(data) {
			if(data == "success"){
				$('#'+ optfield).append($('<option>', {
					value: newitem,
					text: newitem,
				}));
				$("#newitemmodal").modal('hide');
				swal({
				  type: 'success',
				  title: 'Uploaded...',
				  text: 'Item has been Added. Thank you!',
				  footer: '<a href>'+ data +'</a>'
				});
				$('#newitem').val('');
				newitem='';
			}
			else{
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'You have an error in the data you are about to insert Kindly double check! Thank you!',
				  footer: '<a href>'+ data +'</a>'
				});
			}
		});
		
	}

}


function reset(){
	$("#lead").reset();
}
</script>