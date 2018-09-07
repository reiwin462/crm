
<div id="emaillistddiv" class="widget">
	<header class="widget-header primary">
        <h5 class="widget-title"><span class="pull-left">Email Blast Module!</span></h5>
    </header>
	<div class="widget-body " style="padding:3px;">
		<div class="row" style="padding:10px;">
			<div class="col-md-3">
				<div class="form-group">
					<form id="listUpload" action="#" method="POST" enctype="multipart/form-data" class="form-horizontal p-t-10">
						<p class="text-center" style="background-color: #f2f5f7;"><small><a href="<?php echo base_url() . "emailcontrol/sample_email_txtfile" ?>" target="_blank">Click Here to view sample template!</a></small></p>
						<label>List of Email Address</label>
						<input type="file" class="form-control" name="file" id="file" onchange="mailUploadlist(event);">
					</form>
				</div>
			
				<div id="receipient">
					<br>
					<br>
					<h5 href="#" class="text-center"><small><i class="fa fa-info-circle" aria-hidden="true"></i> Email Reciepient Area Only</small></h5> 
				</div>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon" style="padding:3px;  font-size:12px; "><i class="fa fa-suitcase" aria-hidden="true"></i> Subject</span>
						<input type="text" class="form-control" placeholder="Subject" name="mailsubject" id="mailsubject">
					</div>
				</div>
				
				<div class="form-group" >
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-lg btn-success" onclick="sendemail();"><i class="fa fa-send"></i>&nbsp;&nbsp; Send &nbsp;&nbsp;</button>
							<a href="<?php echo base_url('crm/emailblast') ;?>" class="btn btn-lg btn-danger"><i class="fa fa-close"></i>&nbsp; Cancel &nbsp;</a>
						</div>
					</div>
				</div>
				
				<textarea id="emailmsg" name="emailmsg" class="form-control full-wysiwyg"></textarea>
			</div>
		</div>
	</div>
</div>


<script>

document.addEventListener("DOMContentLoaded", function() {
	
	$('#emailmsg').summernote({
		height: 350,
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
	datatablereload();
	/*
	$('#email').blur(function(){
		var email = $(this).val();
		var isValid = checkEmail(email[email.length-1]);
		if(isValid === false){
			$('#email').val('');
			swal({
				type: 'warning',
				title: 'Email Address Validator',
				text: email[email.length-1] + ' is not a valid email address',
			});
		}
	});
	*/
	
});

function datatablereload(){
		$('#prevDiv').hide();
		$('.preloader').fadeIn();
		
		$("#maillistbody").html('');
		var table = $('#mailist-table').DataTable();
		table.destroy();
		$.post("<?php echo base_url("Emailcontrol/shoemailistlist"); ?>")
				.done(function(data) {
					$("#maillistbody").html(data);
					$('#mailist-table').DataTable({
						dom: 'ftpi',
						bStateSave: true,
						scrollX:        true,
						scrollCollapse: true,
						autoWidth:   false,  
						paging:         true,       
						
					});
			});
		$('#prevDiv').show();
		$('.preloader').hide()

}

function validateemail(dta){
	var email = dta.val();
	if(email == "" || email == null){
		return false;
	}
	

	
	var isValid = checkEmail(email[email.length-1]);
	if(isValid === false){
		swal({
			type: 'info',
			title: 'Email Address Validator',
			text: email[email.length-1] + ' is an invalid email address',
		});
		
		dta.find("option[value='"+ email[email.length-1] +"']").remove();
	}
}

function sendemail(){
	var subject = $('#mailsubject').val();
	var msg = $('#emailmsg').summernote('code');

	if($('#receipient a').text() == ""){
		swal({
			type: 'error',
			title: 'Invalid List of Reciepient',
			text: 'Please upload your receipient!',
			footer: '<a href></a>'
		});
		$('#file').css('border', '1px solid red');
		$('#file').css('background-color', '#fcfcde');
		return false;
	}
	
	if(subject == ""){
		swal({
				type: 'info',
				title: 'Email Messaege Validation',
				text: 'Please add Email Subject!',
				footer: '<a href></a>'
		});
		$('#mailsubject').css('border', '1px solid red');
		$('#mailsubject').css('background-color', '#fcfcde');
		return false;
	}
	if(msg == "<p><br></p>"){
		swal({
				type: 'info',
				title: 'Email Messaege Validation',
				text: 'Please add some email Email Content!',
				footer: '<a href></a>'
			});
		return false;
	}

		Swal({
		  title: 'Send Email?',
		  text: 'Are you sure you want to Send this Email?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, Send it!',
		  cancelButtonText: 'No!'
		}).then((result) => {
			var promises = [];	
			  if (result.value) {
					$('#prevDiv').hide();	
					$('.preloader').fadeIn();
					$('#receipient a').each(function(){
						var to = $(this).text();
						var mid = $(this).attr('id');
						
						var xlink = "<?php echo base_url("emailcontrol/sendmymail"); ?>";
						$.post(xlink,{e_to:to, e_cc: '', e_bcc: '', e_subj: subject, e_msg: msg, e_attach: '', id: mid})
						.success(function(response) {
							
							if(response.includes('error')){
								var itm = response.split("|");
								$('#' + itm[1]).css('color','red');
								$('#' + itm[1]).prepend('&nbsp; <i class="fa fa-close" aria-hidden="true"></i>');
							}else{
								var itm = response.split("|");
								$('#' + itm[1]).css('color','green');
								$('#' + itm[1]).prepend('&nbsp; <i class="fa fa-check" aria-hidden="true"></i>');
						
							}
						
						});
					});
					$('#prevDiv').show();	
					$('.preloader').fadeOut();
			  } else if (result.dismiss === Swal.DismissReason.cancel) {
				
			  }
		});
	swal({
		type: 'info',
		title: 'Queue',
		text:  'Messages are on Queue please monitor status on Email Reciepient Area!',
		footer: '<a href></a>'
	});
}

function checkEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function mailUpload(e){
	e.preventDefault();
	var fd = new FormData($("#mailattach")[0]);
	fd.append('file', document.getElementById("file").files[0]);
	var xlink = "<?php echo base_url("Emailcontrol/newUpload"); ?>";
		$.ajax({
			url: xlink,
			method:"POST",
			enctype: 'multipart/form-data',
			data: fd, 
			contentType:false,
			cache:false,
			processData:false,
			success:function(response){
				if(response.includes('error')){
					swal({
						type: 'error',
						title: 'Somthings Wrong with the Attachment',
						text: 'Upload Issue',
						footer: '<a href>'+ response +'</a>'
					});
				}else{
					$('#attachlist').append(response);
					swal({
						type: 'success',
						title: 'Attachment Posted',
						text: response,
					});
				}
			}
		});
}

function mailUploadlist(e){
	$('#receipient').html('');
	if(document.getElementById("file").files[0]['name'].lastIndexOf(".txt")==-1) {
		swal({
				type: 'info',
				title: 'Text Files Only',
				text: 'Please check your Uploaded File! ',
				footer: '<a href></a>'
			});
		return false;
	 }
	e.preventDefault();
	var fd = new FormData($("#listUpload")[0]);
	fd.append('file', document.getElementById("file").files[0]);
	var xlink = "<?php echo base_url("Emailcontrol/blasterlist"); ?>";
		$.ajax({
			url: xlink,
			method:"POST",
			enctype: 'multipart/form-data',
			data: fd, 
			contentType:false,
			cache:false,
			processData:false,
			success:function(response){
				$('#receipient').html(response);
			}
		});
}

</script>
