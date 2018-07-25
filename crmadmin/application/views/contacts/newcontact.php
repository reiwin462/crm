
<div class="row">		
	<div id="adddiv" class="nav-tabs-horizontal white m-b-lg">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#addcampaigntab" id="leaddetailtab" aria-controls="addcampaigntab" role="tab" data-toggle="tab" aria-expanded="true">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Contact</a>
			</li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="addcampaigntab">
				<div class="innerdiv">
					<div class="row">
						<?php echo $form; ?>
					</div>
				<div class="row">
					<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewcontact();" >Save</button>
					<button type="button" class="btn btn-sm mw-md btn-danger" onclick="reset();">Cancel</button>
				</div>
				</div>
			</div>
		</div>
	</div>	
</div>


<script>

var optfield = "";

function addnewcontact(){
	
	var isNull = "pass";
	var formElements = new Array();
	$("#contactform :input").each(function(){
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
		$.post("<?php echo base_url("contactcontrol/contactinsert"); ?>",
		{data: JSON.stringify($("#contactform").serializeArray()) }) 
			.success(function(data) {
				swal({
					  type: 'success',
					  title: 'New Contact',
					  text: 'New Contact has been Created. Thank you!',
					  footer: '<a href>'+ data +'</a>'
					});
				reset();
			});
	}
		
}

function reset(){
	$("#contactform :input").each(function(){
		$(this).val('');
	});
}
</script>