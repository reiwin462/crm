

<div id="prevDiv" class="widget">
    <header class="widget-header info">
        <h4 class="widget-title">Project Leads Details</h4>
    </header>
    <hr class="widget-separator">
		<div class="widget-body">
			<div id="campupdate">
				<div class="row">
					<?php echo $form; ?>
				</div>
				<br>
				<br>
				<br>
				<div class="row">
					<button type="button" class="btn mw-md btn-success" onclick="updateprojlead();" >Save</button>
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
		ajax: "<?php echo base_url(); ?>index.php/Projectleadcontrol/showallprojleads",
		searching: true,
		responsive: true,
		columns: [
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
		ajax: "<?php echo base_url(); ?>index.php/Projectleadcontrol/showallprojleads",
		dom: 'ftlpi',
		searching: true,
		responsive: true,
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
		$.post("<?php echo base_url("index.php/Projectleadcontrol/projleadupdate"); ?>",
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
	$("#campupdate").toggle();
	
}

function projleadupdate(bt){
	$('#more_info').summernote('destroy');
	var xlink = "<?php echo base_url(); ?>" + 'index.php/Projectleadcontrol/getleaddetail/'  + bt;
	$.get(xlink, function(data, status)
	 {
		$('#id').val(bt);
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
						}else{
							$(this).val(value);
						}
						
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
				var xlink = "<?php echo base_url(); ?>index.php/Projectleadcontrol/projleadremove/" + id;
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
						$('.preloader').fadeOut();
						$('#prevDiv').show();
					}else{
						datatablereload();
						swal({
							  type: 'error',
							  title: 'Oops...',
							  text: 'You have an error in the action you are trying to do. Kindly double check and retry. Thank you!',
							  footer: '<a href>'+ data +'</a>'
							});
						$('.preloader').fadeOut();
						$('#prevDiv').show();
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