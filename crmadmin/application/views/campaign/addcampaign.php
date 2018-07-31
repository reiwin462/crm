
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header primary">
				<h4 class="widget-title"><i class="fa fa-calendar"></i> Campaign Information Entries</h4>
		</header>
		<hr class="widget-separator">
		<div class="widget-body">
								
					<div class="row">
						<?php echo $form; ?>
					</div>
					<div class="row">
						<button type="button" class="btn mw-md btn-success" onclick="processcampaign();" >Save</button>
						<button type="button" class="btn mw-md btn-danger" onclick="reset();">Cancel</button>
					</div>
					
				<br/>
		</div>
	</div>
</div>


<script>

var optfield = "";

function processcampaign(){
	
	var isNull = "pass";
	var formElements = new Array();
	$("#newcampaign :input").each(function(){
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
		$.post("<?php echo base_url("campaigncontrol/campaignInsert"); ?>",
		{data: JSON.stringify($("#newcampaign").serializeArray()) }) 
		.success(function(data) {
			swal({
				  type: 'success',
				  title: 'New Campaign',
				  text: 'New Campaign Record has been Created. Thank you!',
				  footer: '<a href>'+ data +'</a>'
				});
			reset();
			});
	}
		
}

function reset(){
	$("#newcampaign :input").each(function(){
		$(this).val('');
	});
}
</script>