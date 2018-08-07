
<div class="row">		
	<div id="adddiv" class="nav-tabs-horizontal white m-b-lg">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#addprojleadtab" id="leaddetailtab" aria-controls="addcampaigntab" role="tab" data-toggle="tab" aria-expanded="true">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> New Project Leads</a>
			</li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="addprojleadtab">
				<div class="innerdiv">
					<div >
						<?php echo $form; ?>
					</div>
				<div class="row actbutt">
					<button type="button" class="btn btn-sm mw-md btn-success" onclick="addnewprojlead();" >Save</button>
					<button type="button" class="btn btn-sm mw-md btn-danger" onclick="reset();">Cancel</button>
				</div>
				</div>
			</div>
		</div>
	</div>

</div>


<script>

var optfield = "";

function addnewprojlead(){
	
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
		$('#adddiv').hide();
		$('.preloader').fadeIn();
		
		$.post("<?php echo base_url("Projectleadcontrol/newProjLead"); ?>",
		{data: JSON.stringify($("#projleadform").serializeArray()) }) 
			.success(function(data) {
				$('#adddiv').show();	
				$('.preloader').fadeOut();	
				if(data.indexOf('duplicate') > -1){
					  swal({
						  type: 'error',
						  title: 'Duplicate Project Leads',
						  text: 'You have entered duplicate entries on the list!',
						  footer: '<a href>'+ data +'</a>'
						});
				}else{
						swal({
						  type: 'success',
						  title: 'New Project Leads',
						  text: 'New Contact has been Created. Thank you!',
						  footer: '<a href>'+ data +'</a>'
						});
						$('#projleadform').trigger("reset");
						$('#more_info').summernote('code', '');
					}
					
			});
				
	}
		
}

document.addEventListener("DOMContentLoaded", function(){
	$('#more_info').summernote({
		height: 100,
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

function reset(){
	$("#projleadform :input").each(function(){
		$(this).val('');
	});
}

</script>