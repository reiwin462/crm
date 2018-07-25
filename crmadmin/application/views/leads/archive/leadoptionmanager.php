
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header primary">
				<h4 class="widget-title">Lead Select Options Manager</h4>
		</header>
		<hr class="widget-separator">
		<div class="widget-body">
				
				<div id="leadalert" class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong>Well done! </strong>
					<span id="alertmsg">...</span>
				</div>
				
				<br/>
				<div class="row">
					<div class="col-md-3">
						<label ><b>DropDown Option List</b></label>
						<select class="form-control" id="dropdown" name="dropdown" onchange="showmyoption(this);">
							<?php foreach($dropdown as $key=>$val): ?>
								<option value="<?php echo $val->Field; ?>"><?php echo $val->Field; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label ><b>Add New Item</b></label>
								<input type="text" id="newitem" name="newitem" class="form-control" style="margin-bottom:2px"></input>
								<button class="btn btn-primary" onclick="newitem();">Add New</button>
								<button class="btn btn-danger" onclick="$('#newitem').val('');">Clear</button>
						</div>
					</div>
				</div>
				<br>
				<div class="table-responsive-md ">
					  <table class="table">
						<thead class="primary">
							<th>Option Available</th>
							<th>Option Action</th>
						</thead>
						<tbody id="optlist">
							
						<tbody>
						<tfoot>
						
						</tfoot>
					  </table>
				</div>
			
		</div>
	
	</div>

</div>
<script>

function showmyoption(d){
	$('#optlist').html();
	var sel = d.value;
	var xlink = "<?php echo base_url(); ?>/index.php/process/showdropdownoption/" + sel;
	$.get(xlink, function(data, status){
        $('#optlist').html(data);
    });
}

function newitem(){
	var optfield = $('#dropdown').val();
	var newitem = $('#newitem').val();
	if(newitem == "" || optfield == ""){
		alert("Please select Field Name And Value");
		return false;
	}
	
	var xlink = "<?php echo base_url(); ?>index.php/process/newitem/" + optfield + "/" + newitem;
		 $.post(xlink,) 
			.success(function(data) {
				if(data == "success"){
					
				swal({
				  type: 'success',
				  title: 'Horray...',
				  text: 'New Item has been added!',
				  footer: '<a href>'+ data +'</a>'
				});
				
				$('#newitem').val('');
				$('#dropdown').change();
				newitem='';
			}
			else{
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Something is not right! Kindly double check Thank you!',
				  footer: '<a href>'+ data +'</a>'
				});
			}


		});
}

function removeitem(i){
	var optfield = $('#dropdown').val();
	var xlink = "<?php echo base_url(); ?>index.php/process/deleteoption/" + optfield + "/" + i;
		 $.post(xlink,) 
			.success(function(data) {
			if(data == "success"){
				swal({
				  type: 'success',
				  title: 'Done',
				  text: 'Item has been removed!',
				  footer: '<a href>'+ data +'</a>'
				});
				
				$('#dropdown').change();
			}
			else{
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Unable to delete the selected file!',
				  footer: '<a href>'+ data +'</a>'
				});
			}
		});
}



</script>