<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="<?php echo base_url(); ?>assets/images/logo.png">
    <title>Geo Grout CRM</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css ../assets/css/app.min.css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/core.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/crm.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/spinners.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/bower/summernote/dist/summernote.css">

</head>

<body class="menubar-left menubar-unfold  theme-primary pace-done menubar-dark">
    <nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary in">
        <h5 class="page-title hidden-menubar-top hidden-float">Lead Document Preview</h5>
    </nav>

    <div class="preloader">
        <h6 style='text-align:center'>Please wait while we load your page...</h6>
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <?php $exemptioarray = array('id', 'modified_date', 'modified_by', 'project_id');?>

        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation">
                                    <a href="#leaddetail" id="leaddetailtab" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Project Leads Details</a>
                                </li>
								<li role="presentation">
                                    <a href="#callnotes" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" onclick="">
                                       <i class="fa fa-plus-circle" aria-hidden="true"></i> Call Log Details</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="leadtab">
								<div role="tabpanel" class="tab-pane" id="callnotes">
									<div id="divcalllogs">
										 
									</div>
								</div>
							   <div role="tabpanel" class="tab-pane fade active in" id="leaddetail">
                                  <div id="previewpane" class="widget-body">
									<div class="row">
										<div class="col-md-8 col-lg-8">
										<?php if(count($leadinfo) > 0): ?>
											<?php foreach($leadinfo as $key=>$val): ?>
												<div class="row">
													<div class="form-group">
														<style>
															input[type="text"] {
																border:none !important;
																background-color:#f9f9f9 !important;
																border-bottom:2px solid #59ABE3 !important;
															}
														</style>
													<?php foreach($val as $name=>$value): ?>
                                                        <?php if(!in_array($name, $exemptioarray)): ?>
																<?php /* removed <div class="row prevrow">
																	<div class="col-md-3 previewfield">
																		<?php echo ucwords(str_replace('_', ' ', $name)); ?>
																	</div>
																	<div id="<?php echo $name; ?>" class="col-md-9 previewitm">
																		<?php echo $value; ?>
																	</div>
																</div> */?>
																	<?php if($name == "job_address" OR $name == "specification" ): ?>
																		<div class="col-md-12 col-lg-12">
																	<?php elseif($name == "project_scope" OR $name == "more_info"): ?>
																		<div class="col-md-6 col-lg-6">
																	<?php else: ?>
																		<div class="col-md-4 col-lg-4">
																	<?php endif; ?>
																			<label><?php 
																				if($name == "project_scope") {
																					echo "Project Description";
																				} elseif($name == "more_info") {
																					echo "Notes";
																				} else {
																					echo ucwords(str_replace('_', ' ', $name)); 
																				}
																			?></label>
																			<?php if($name != "project_scope" && $name != "more_info" && $name != "specification"): ?>
																			<input type="text" class="form-control" type="text" readonly id="<?php echo $name; ?>" value="<?php echo $value; ?>" />
																			<?php else: ?>
																			<textarea class="form-control" type="text" readonly id="<?php echo $name; ?>"><?php echo $value; ?></textarea>
																			<?php endif; ?>
																		</div>
                                                        <?php endif; ?>
													<?php endforeach;?>
													</div>
												</div>
											<?php endforeach; ?>
										<?php else: ?>
											<h4> No Lead Detail Available! </h4>
										<?php endif; ?>
										</div>
										<div class="col-md-4 col-lg-4">
										<div class="widget">
											<h5 class="widget-footer bg-info">Maps</h5>
											<small class="text-center ">Maps are based on Address Supplied</small>
												<iframe id="geomaps"
												  width="100%"
												  height="300"
												  frameborder="0" style="border:1px solid #e2e2e2;"
												  src="" allowfullscreen>
												</iframe>
										</div>
										</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-lg-12">
												<h4 class="widget-footer bg-info">Lead Plan</h4>
												<?php if ($plan <> ""): ?>
												<div id="planpreview" class="widget-body">
												<?php echo $plan; ?>
												</div>
												<?php else: ?>
													<h4> No Plan Data Available! </h4>
												<?php endif; ?>
											</div>
											<div class="col-md-12 col-lg-12">
												<h4 class="widget-footer bg-info">Lead Document</h4>
												<?php if ($document <> ""): ?>
												<div id="docupreview" class="widget-body">
												<?php echo $document; ?>
												</div>
												<?php else: ?>
													<h4> No Document Available! </h4>
												<?php endif?>
											</div>
										</div>								  
                                  <div class="nav-tabs-horizontal white m-b-lg">
										<ul id="crmtabs" class="nav nav-tabs" role="tablist">
											<li role="presentation" >
												<a href="#addengineer" class="tablink" id="leadengineer" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true">
												<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Engineers List</h5></a>
											</li>
											<li role="presentation" >
												<a href="#addplanholder" class="tablink" id="leadplan" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" >
												<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Plan Holders List</h5></a>
											</li>
											<li role="presentation" >
												<a href="#addbidders" class="tablink" id="leadbid" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" >
												<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Bidders List</h5></a>
											</li>
											<li role="presentation" >
												<a href="#addrfi" class="tablink" id="leadrfitab" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" onclick="">
												<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> Project RFI</h5></a>
											</li>
										</ul>
										<div class="tab-content" id="leadtab">
											<div role="tabpanel" class="tab-pane fade active in" id="addengineer">		
												<div class="row">		
													<footer class="widget-footer bg-info"><h5>Please see details below!</h5></footer>
													<div id="engineers" class="table-responsive contentholder" ></div>
												</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="addplanholder">		
												<div class="row">		
													<footer class="widget-footer bg-info"><h5>Please see details below!</h5></footer>
													<div id="planholder" class="table-responsive contentholder"   ></div>
												</div>	
											</div>
											<div role="tabpanel" class="tab-pane" id="addbidders">
												<div class="row">
													<footer class="widget-footer bg-info"><h5>Please see details below!</h5></footer>
													<div id="bidders" class="table-responsive contentholder"   ></div>
													<br>
												</div>	
											</div>
											
											<div role="tabpanel" class="tab-pane" id="addrfi">				
												 <div class="row">
													<footer class="widget-footer bg-info"><h5>Project Request For Information</h5></footer>
													<hr class="widget-separator">
													<div id="previewpane" class="widget-body">
														<?php if(count($datarfi) > 0): ?>
															<?php foreach($datarfi as $key=>$val): ?>
																<?php foreach($val as $name=>$value): ?>
																	<?php if(!in_array($name, $exemptioarray)): ?>
																		<div class="row prevrow">
																			<div class="col-md-3 previewfield">
																				<?php echo ucwords(str_replace('_', ' ', $name)); ?>
																			</div>
																			<div class="col-md-9 previewitm">
																				<?php echo $value; ?>
																			</div>
																		</div>
																		<?php endif; ?>
																			<?php endforeach;?>
																				<?php endforeach; ?>
																					<?php else: ?>
																						<h4> No Lead RFI Available! </h4>
																						<?php endif; ?>
													</div>
												</div>
											</div>
											
											
											
										</div>
									</div>
									
									
									
                                </div>
                           
						   </div>
                        </div>
						
					
					
                    </div>
					
					
					
					<!--
                    <div  class="col-md-4">
						<div class="widget">
							<h5 class="widget-footer bg-info">Maps</h5>
							<small class="text-center ">Maps are based on Address Supplied</small>
								<iframe id="geomaps"
								  width="100%"
								  height="300"
								  frameborder="0" style="border:1px solid #e2e2e2;"
								  src="" allowfullscreen>
								</iframe>
						</div>
						<!-- Adjusted Removed 08202018
						 <div style="height: auto;" class="widget">
                            <div style="height: 350px;"  class="widget-body">
                                <h5 class="widget-footer bg-info">Lead Plan</h5>
                                <div class="row">
                                    <?php //if ($plan <> ""): ?>
                                        <div id="planpreview" class="widget-body">
                                            <?php //echo $plan; ?>
                                        </div>
                                        <?php //else: ?>
                                            <div class="widget-body">
                                                <h4> No Plan Data Available! </h4>
                                            </div>
                                         <?php //endif; ?>
                                </div>
                            </div>
                            <div style="height: 350px;"  class="widget-body">
                                <h5 class="widget-footer bg-info">Lead Document</h5>
                                <?php //if ($document <> ""): ?>
                                    <div id="docupreview" class="widget-body">
                                        <?php //echo $document; ?>
                                    </div>
                                    <?php //else: ?>
                                        <div class="widget-body">
                                            <h4> No Document Available! </h4>
                                        </div>
                                        <?php //endif?>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
        </div>
		
		<div id="imgmodal" class="modal fade" role="dialog">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			</button>
		  <img class="modal-content" id="imgprev">
		  <div id="imgcaption"></div>
		</div>



</body>
<script src="<?php echo base_url(); ?>libs/bower/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>

<script src="<?php echo base_url(); ?>libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/PACE/pace.min.js"></script>
	<script src="<?php echo base_url(); ?>/libs/bower/summernote/dist/summernote.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('.preloader').hide();
				
				var id = <?php echo $this->input->get('projectid'); ?>;
				$('#divcalllogs').load('<?php echo base_url(); ?>/projectleadcontrol/callhistory/' + id);
				$('#engineers').load('<?php echo base_url(); ?>/projectleadpreview/showhtmltable/project_engineers/' + id);
				$('#bidders').load('<?php echo base_url(); ?>/projectleadpreview/showhtmltable/project_bidders/' + id);
				$('#planholder').load('<?php echo base_url(); ?>/projectleadpreview/showhtmltable/project_planholders/' + id);
				$('#geomaps').attr('src', "https://www.google.com/maps/embed/v1/place?key=AIzaSyBgdwfZSVM-XkwgcnoJMr-bmWPlEhVxbpE&q=" + $('#job_address').val().trim());
				
				$('#specification, #project_scope, #more_info').summernote({
					height: 80,
					 toolbar: [],
				});
				$('#specification').summernote('disable');
				$('#project_scope').summernote('disable');
				$('#more_info').summernote('disable');
            });
        </script>
		
		<script>
			function showme(img){
				$('#imgprev').attr('src', img.attr('src'));
				$('#imgcaption').attr('src', img.val());
				$('#imgmodal').modal();
			}
			
		</script>
</html>