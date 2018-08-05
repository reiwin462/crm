

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

<script>
var recordid = "";
var rowindex = "";

document.addEventListener("DOMContentLoaded", function() {
	datatablereload();
});

function datatablereload(){
	
	if(window.location.href.indexOf("showcampaigntable") > -1) {
		var table = $('#responsive-datatable').DataTable();
		table.destroy();
		var table = $('#responsive-datatable').DataTable( {
		dom: "tpi",
		ajax: "<?php echo base_url(); ?>Projectleadcontrol/showallprojleads",
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
			{ "width": "15%" },
		]
		} );
    }else{
		var table = $('#responsive-datatable').DataTable();
		table.destroy();
		var table = $('#responsive-datatable').DataTable( {
		ajax: "<?php echo base_url(); ?>Projectleadcontrol/showallprojleads",
		dom: 'ftlpi',
		searching: true,
		responsive: false,
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
			datatablereload();
			$('.preloader').fadeOut();
			$('#prevDiv').show();			
		});		
	}else{
		console.log('fail method execute');
	}
	
	$("#dtbl").toggle();
	$("#prlupdate").toggle();
	
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

function projleaddelete(id){
	Swal({
		  title: 'Are you sure?',
		  text: 'Item will be permanently be removed from the database',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, delete it!',
		  cancelButtonText: 'No, keep it'
		}).then((result) => {
		  if (result.value) {
			  $('#prevDiv').hide();
			  $('.preloader').fadeIn();	
				var xlink = "<?php echo base_url(); ?>Projectleadcontrol/projleadremove/" + id;
				$.post(xlink,) 
				.success(function(data) {
						datatablereload();
						swal({
							  type: 'success',
							  title: 'Delete',
							  text: 'You have success deleted an item. Thank you!',
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


</script>