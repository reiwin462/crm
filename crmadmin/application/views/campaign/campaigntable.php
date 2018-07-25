

<div class="widget">
    <header class="widget-header info">
        <h4 class="widget-title">Campaign Tables Details</h4>
    </header>
    <hr class="widget-separator">
		<div class="widget-body">
			<div id="campupdate">
				<div class="row">
					<?php echo $form; ?>
				</div>
				<div class="row">
					<button type="button" class="btn mw-md btn-success" onclick="updatecampaign();" >Save</button>
					<button type="button" class="btn mw-md btn-danger" onclick="cancelupdate();">Cancel</button>
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
});

function datatablereload(){
	
	if(window.location.href.indexOf("showcampaigntable") > -1) {
		var table = $('#responsive-datatable').DataTable();
		table.destroy();
		var table = $('#responsive-datatable').DataTable( {
		dom: "tpi",
		ajax: "<?php echo base_url(); ?>index.php/campaigncontrol/showallcampaign",
		searching: true,
		responsive: true,
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
		ajax: "<?php echo base_url(); ?>index.php/campaigncontrol/showallcampaign",
		dom: 'ftlpi',
		searching: true,
		responsive: true,
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
		$.post("<?php echo base_url("index.php/campaigncontrol/campaignupdate"); ?>",
		{data: JSON.stringify($("#campaignupdate").serializeArray()) }) 
			.success(function(data) {
				swal({
				  type: 'success',
				  title: 'Update',
				  text: 'You have successfully updated an item!',
				  footer: '<a href>'+ data +'</a>'
				});
			datatablereload();
		});		
	}else{
		console.log('fail method execute');
	}
	
	$("#dtbl").toggle();
	$("#campupdate").toggle();
	
}

function campaignupdate(bt){
	var xlink = "<?php echo base_url(); ?>" + 'index.php/campaigncontrol/getcampaigndetail/'  + bt;
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
	$('#campupdate').toggle();
	$('#dtbl').toggle();
}

function cancelupdate(){
	$('#dtbl').toggle();	
	$('#campupdate').toggle();
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
				var xlink = "<?php echo base_url(); ?>index.php/campaigncontrol/campaignremove/" + id;
				$.post(xlink,) 
					.success(function(data) {
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


</script>