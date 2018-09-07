
<div id="emaillistddiv" class="widget">
	<header class="widget-header primary">
        <h5 class="widget-title"><span class="pull-left">Email Module!</span></h5>
    </header>
	<div class="widget-body " style="padding:3px;">
		<div id="adddiv" class="nav-tabs-horizontal white m-b-lg">
			<ul class="nav nav-tabs" role="tablist">
				
				<li role="presentation" class="active">
					<a href="#maillist" id="sendtab" aria-controls="addcampaigntab" role="tab" data-toggle="tab" aria-expanded="true">
					<i class="fa fa-plus-circle" aria-hidden="true"></i> Send Email</a>
				</li>
				<li role="presentation" class="">
					<a href="#mailcontact" id="emailist" aria-controls="addcampaigntab" role="tab" data-toggle="tab" aria-expanded="true">
					<i class="fa fa-plus-circle" aria-hidden="true"></i> Email Contact List</a>
				</li>
				<span role="presentation" class="btn btn-sm btn-primary pull-right"  onclick="showmodal();">
					<a href="#" style="color: #fff;">
					<i class="fa fa-plus-circle" aria-hidden="true"></i> New Email List </a>
				</span>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="maillist">
					<div class="widget-body " style="padding:3px;">
						<div class="panel panel-default new-message">						
							<form action="#">
								<div class="panel-body" style="padding:5px; margin-top: 2px;">	
									<div class="form-group" >
										<div class="row">
											<div class="col-md-12" style="margin-top:5px;">
												  <div class="input-group" style="width:100%;">
													<span class="input-group-addon" style="padding:0px;"><i class="glyphicon glyphicon-user" ></i> To&nbsp;&nbsp;&nbsp;:</span>
													<select class="form-control selectpicker" id="mailto" id="mailto" data-live-search="true" multiple onchange="validateemail($(this));">
														<?php 
															if(count($emailaddress) > 0){
																 foreach($emailaddress as $key=>$val){
																	 echo '<option value='.$val->email.'>'.$val->email.'</option>';
																 }
															}
														?>
													</select>
												 
												 </div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12" style="margin-top:5px;">
												<div class="input-group" style="width:100%;">
													<span class="input-group-addon" style="padding:0px;"><i class="glyphicon glyphicon-user" ></i> Cc&nbsp;&nbsp;:</span>
													<select class="form-control selectpicker"  name="mailcc" id="mailcc" data-live-search="true" multiple onchange="validateemail($(this));">
														<?php 
															 if(count($emailaddress) > 0){
																 foreach($emailaddress as $key=>$val){
																	 echo '<option value='.$val->email.'>'.$val->email.'</option>';
																 }
															}
														?>
													</select>
												 </div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12" style="margin-top:5px;">
												<div class="input-group " style="width:100%;">
													<span class="input-group-addon" style="padding:0px;"><i class="glyphicon glyphicon-user" ></i> Bcc :</span>
													<select class="form-control selectpicker"  name="mailbcc" id="mailbcc" data-live-search="true" multiple onchange="validateemail($(this));">
														<?php 
															 if(count($emailaddress) > 0){
																 foreach($emailaddress as $key=>$val){
																	 echo '<option value='.$val->email.'>'.$val->email.'</option>';
																 }
															}
														?>
													</select>
												 </div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon" style="padding:3px;  font-size:11px; "><i class="fa fa-suitcase" aria-hidden="true"></i> Subject</span>
											<input type="text" class="form-control" placeholder="Subject" name="mailsubject" id="mailsubject" style="height: 40px;">
										</div>
									</div>
									<div class="form-group" >
										<div class="row">
											<div class="col-md-12">
												<button type="button" class="btn btn-success" onclick="sendemail();"><i class="fa fa-send"></i>&nbsp;&nbsp; Send &nbsp;&nbsp;</button>
												<a href="<?php echo base_url('crm/email') ;?>" class="btn btn-danger"><i class="fa fa-close"></i>&nbsp; Cancel &nbsp;</a>
												
											</div>
											
											
										</div>
									</div>
									<textarea id="emailmsg" name="emailmsg" class="form-control full-wysiwyg"></textarea>
									<div class="form-group" >
										<div class="row">
											<div class="col-md-2 file-field">
												<form id="mailattach" action="#" method="POST" enctype="multipart/form-data" class="form-horizontal p-t-10">
													<input type="file" class="form-control" name="mailfile" id="mailfile" onchange="mailUpload(event);">
												</form>
											</div>
											<div id="attachlist" class="col-md-10">
												
											</div>
										</div>
									</div>
								
								</div><!-- .panel-body -->
								<div class="panel-footer clearfix">
									<div class="pull-left">
										
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade in" id="mailcontact">
					<table id="mailist-table" class="table table-striped" cellspacing="0" width="100%" style="font-size:12px !important;">
						<thead>
							<tr>
							<?php echo $columns;?>
							</tr>
						</thead>
						<tbody id="maillistbody">
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



<div id="maillistmodal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="padding-top:10px;">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="width:90%;">
		  <div class="modal-header bg-info">
			<h4 class="modal-title" >New Mail Detail
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</h4>
		  </div>
		  <div class="modal-body">
			<div class="row" style="padding-bottom:0 !important;margin-bottom:0 !important;">
					<div class="col-md-12">
						<?php echo $form; ?>
					</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-sm mw-md btn-success" onclick="savenewemail();" >Save</button>
			<button type="button" class="btn btn-sm mw-md btn-danger" data-dismiss="modal">Cancel</button>
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

function showmodal(){
	$('#id').val('');
	$('#maillistform :input').each(function(){
		$(this).val('');
	});
	$('#maillistmodal').modal();
}


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
	var to = $('#mailto').val();
	var cc = $('#mailcc').val();
	var bcc = $('#mailbcc').val();
	var subject = $('#mailsubject').val();
	var msg = $('#emailmsg').summernote('code');
	
	var attach = [];
	$('#attachlist a').each(function(){
		attach.push($(this).attr('alt'));
	});
	
	if(to == "" || to == null){
		swal({
				type: 'info',
				title: 'Email Messaege Validation',
				text: 'Please specify atleast 1 email receipient!',
				footer: '<a href></a>'
			});
		return false;
	}
	if(subject == ""){
		swal({
				type: 'info',
				title: 'Email Messaege Validation',
				text: 'Please add Email Subject!',
				footer: '<a href></a>'
			});
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
			  if (result.value) {
					$('#prevDiv').hide();	
					$('.preloader').fadeIn();	
					var xlink = "<?php echo base_url("emailcontrol/sendmymail"); ?>";
					$.post(xlink,{e_to:to, e_cc: cc, e_bcc: bcc, e_subj: subject, e_msg: msg, e_attach: attach})
					.success(function(response) {
						if(response.includes('error')){
							swal({
									type: 'info',
									title: 'Sending Message',
									text: response,
							});	
						}else{
							swal({
									type: 'success',
									title: 'Sending Message',
									text: response,
							});
						}
					});
					$('#prevDiv').show();	
					$('.preloader').fadeOut();
			  } else if (result.dismiss === Swal.DismissReason.cancel) {
				
			  }
		});
}

function checkEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function deleteemail(id){
	
	Swal({
		  title: 'Send Email?',
		  text: 'Are you sure you want to Delete this Email?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, Delete it!',
		  cancelButtonText: 'No!'
		}).then((result) => {
			  if (result.value) {
					$('#prevDiv').hide();	
					$('.preloader').fadeIn();	
					var xlink = "<?php echo base_url("emailcontrol/deleteemail"); ?>";
					$.post(xlink,{mailid:id })
					.success(function(response) {
						datatablereload()
						swal({
								type: 'success',
								title: 'New Email List',
								text: 'New Email List has been Created. Thank you!',
								footer: '<a href>'+ data +'</a>'
							});	
					});
					$('#prevDiv').show();	
					$('.preloader').fadeOut();
			  } else if (result.dismiss === Swal.DismissReason.cancel) {
				
			  }
		});
	
}

function savenewemail(){
	var isNull = "pass";
	var formElements = new Array();	
	$("#maillistform :input").each(function(){
		var isRequired = $(this).attr('required');
		if(isRequired == "required"){
			if($(this).val() == "" || $(this).val() == null ){
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
		$.post("<?php echo base_url("Emailcontrol/newemail"); ?>",
		{data: JSON.stringify($("#maillistform").serializeArray()) }) 
			.success(function(data) {
				datatablereload();	
				swal({
					type: 'success',
					title: 'New Email List',
					text: 'New Email List has been Created. Thank you!',
					footer: '<a href>'+ data +'</a>'
				});	
				$('#adddiv').show();
				$('.preloader').fadeOut();			
			});	
			$('#maillistmodal').modal('hide');
		}
	
}

function clickmail(em){

	$('#mailto').val(null).trigger('change');
	$('#mailcc').val(null).trigger('change');
	$('#mailbcc').val(null).trigger('change');
	$('#mailsubject').val(null).trigger('change');
	$('#emailmsg').summernote('code', '');
	$('#sendtab').trigger('click');
	$('#mailto').val(em).trigger('change');
	
}

function mailUpload(e){
	e.preventDefault();
	var fd = new FormData($("#mailattach")[0]);
	fd.append('mailfile', document.getElementById("mailfile").files[0]);
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
						text: 'Attachment has been posted to storage',
					});
				}
			}
		});
}

function removeme(itm){
	Swal({
		  title: 'Send Email?',
		  text: 'Are you sure you want to remove this attachment?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Yes, remove it!',
		  cancelButtonText: 'No!'
		}).then((result) => {
			  if (result.value) {
					itm.closest('div').remove()
			  } else if (result.dismiss === Swal.DismissReason.cancel) {
				
			  }
		});
}
</script>
