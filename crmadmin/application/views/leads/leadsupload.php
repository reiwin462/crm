<div class="widget">
	<header class="widget-header primary">
		<h4 class="widget-title"><i class="fa fa-upload" aria-hidden="true"></i> Leads Uploader</h4>
	</header><!-- .widget-header -->
	<hr class="widget-separator">
	
	<div id="leadalert" class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>Upload Message! </strong>
			<span id="alertmsg">...</span>
	</div>
	<div class="widget-body">
			<small>
				Please upload using the right format or use the <a href="<?php echo base_url(); ?>Excellprocess/exporttemplate" target="_blank">template</a> for your reference..
			</small>
		<br>
		<br>
		<form method="post" id="import_form" enctype="multipart/form-data" action="#">
			<p><label> Select Excel File</label>
				<input type="file" name="file" id="file" required accept=".xls, .xlsx, .csv" /></p>
			<br />
			<input type="button" name="import" class="btn btn-primary"  id="upload" value="Upload File" onclick="fileupload(event)"></input>
			<a type="button" href="<?php echo base_url(); ?>Excellprocess/exporttemplate" target="_blank" name="download" class="btn btn-warning"  id="download" value="Download Template" >Download Template</a>
		</form>
		
		<br>
		<div class="leadsuploadresult">
			
		</div>
		
	</div>
	
	
</div>

<?php $this->load->view('footer'); ?>

<script>

function fileupload(e){
	
	var fildata = document.getElementById("file").value;
	if(fildata == ""){
		alert("Please Upload and Excel File");
		return false;
	}
	
	var fd = new FormData($("#import_form"));
	fd.append('file', document.getElementById("file").files[0]);
		$.ajax({
		   url:"<?php echo base_url(); ?>Excellprocess/import",
		   method:"POST",
		   data: fd,
		   contentType:false,
		   cache:false,
		   processData:false,
		   success:function(data){
				$('#leadalert').fadeIn('slow', function(){
					$('#alertmsg').html(data);
						$('#leadalert').delay(2000).fadeOut(); 
						$('#file').val('');
				});	
		   },
		   error: function (xhr, ajaxOptions, thrownError) {
				//alert(xhr.status);
				//alert(thrownError);
				$('#leadalert').fadeIn('slow', function(){
					$('#alertmsg').html('You have an error in the file you are trying to upload. kindly check the file or use the provided template Thank you!');
						$('#leadalert').delay(3000).fadeOut(); 
				});
				
			 }
	  });

}

</script>