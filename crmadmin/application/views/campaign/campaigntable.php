

<div class="widget">
    <header class="widget-header info">
        <h4 class="widget-title">Campaign Tables Details</h4>
    </header>
    <hr class="widget-separator">
		<div class="widget-body">
			<div id="campupdate" >
				<div class="">
					<?php echo $form; ?>
				</div>
				<div id="camptask" class="row actbutt">
					<button type="button" class="btn mw-md btn-success" onclick="unlock();" ><i class="fa fa-pencil"></i> Update</button>
					<button type="button" class="btn mw-md btn-danger" onclick="cancelupdate();"><i class="fa fa-close"></i> Cancel</button>
				</div>	
				<div id="campmain" class="row actbutt">
					<button type="button" class="btn mw-md btn-success" onclick="updatecampaign();" ><i class="fa fa-check"></i> Save Update</button>
					<button type="button" class="btn mw-md btn-danger" onclick="cancelupdate();"><i class="fa fa-ban"></i> Cancel</button>
				</div>	
			</div>
        <div id="dtbl">
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
	lock();
});

function datatablereload(){
	
	if(window.location.href.indexOf("showcampaigntable") > -1) {
		var table = $('#responsive-datatable').DataTable();
		table.destroy();
		var table = $('#responsive-datatable').DataTable( {
		dom: "tpi",
		ajax: "<?php echo base_url(); ?>campaigncontrol/showallcampaign",
		searching: true,
		responsive: false,
		columns: [
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
		ajax: "<?php echo base_url(); ?>campaigncontrol/showallcampaign",
		dom: 'ftlpi',
		searching: true,
		responsive: false,
		} );
	}

}

function updatecampaign(){
	
	var isNull = "pass";
	var formElements = new Array();
	$("#campaignupdate :input").each(function(){
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
		$.post("<?php echo base_url("campaigncontrol/campaignupdate"); ?>",
		{data: JSON.stringify($("#campaignupdate").serializeArray()) }) 
			.success(function(data) {
				$('#prevDiv').show();
				$('.preloader').fadeOut();
				swal({
				  type: 'success',
				  title: 'Update',
				  text: 'You have successfully updated an item!',
				  footer: '<a href>'+ data +'</a>'
				});
			lock();
			datatablereload();
		});		
	}else{
		console.log('fail method execute');
	}
	
	$("#dtbl").toggle();
	$("#campupdate").toggle();
	
}

function campaignupdate(bt){
	unlock();
	var xlink = "<?php echo base_url(); ?>" + 'campaigncontrol/getcampaigndetail/'  + bt;
	$.get(xlink, function(data, status)
	 {
		$('#id').val(bt);
		var j = JSON.parse(data);
		$.each(j[0], function(key, value){
			$("#campaignupdate :input").each(function(){
				var name = $(this).attr('name');
				if(name == key){
					if(key.indexOf('date') > 0){
						var nd = new Date(value)
						$(this).val(formatDate(nd.toDateString()));
					}else{
						$(this).val(value);
					}
				}
			});
		});
	});
	lock();
	$('#campupdate').toggle();
	$('#dtbl').toggle();
	
}

function cancelupdate(){
	$('#dtbl').toggle();	
	$('#campupdate').toggle();
	campaign_reset();
	lock();
}

function campaigndelete(id){
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
				var xlink = "<?php echo base_url(); ?>campaigncontrol/campaignremove/" + id;
				$.post(xlink,) 
					.success(function(data) {
					$('#prevDiv').show();
					$('.preloader').fadeOut();

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
	$("#campaignupdate :input").each(function(){
		$('#campmain').hide();
		$(this).css({"border":"none", "background":"#f9f9f9", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',true);
		$('#camptask').show();		
	});
}

function unlock(){
	$("#campaignupdate :input").each(function(){
		$('#campmain').show();
		$(this).css({"border":"1px solid #e2e2e2", "background":"#fffef2", "border-bottom": "1px solid #e2e2e2"});
		$(this).attr('readonly',false);
		$('#camptask').hide();		
	});
}

function campaign_reset(){
	$("#campaignupdate :input").each(function(){
		$(this).val('');
	});
}

</script>