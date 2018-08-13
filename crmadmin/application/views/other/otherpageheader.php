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
                    <div class="col-md-8">
                        <div class="widget">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation">
                                    <a href="#leaddetail" id="leaddetailtab" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Project Leads Details</a>
                                </li>
                                <li role="presentation">
                                    <a href="#rfidetail" id="leaddocu" aria-controls="leadtab" role="tab" data-toggle="tab" aria-expanded="true" onclick="reloaddocument();">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Request for Information</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="leadtab">
                                <div role="tabpanel" class="tab-pane fade active in" id="leaddetail">
                                    <div class="widget">
                                        <header class="widget-header bg-primary">
                                            <h5 class="widget-title pull-left">Project Lead Details</h5>
                                        </header>
                                        <hr class="widget-separator">
                                        <div id="previewpane" class="widget-body">
                                            <?php if(count($leadinfo) > 0): ?>
                                                <?php foreach($leadinfo as $key=>$val): ?>
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
                                                                            <h4> No Lead Detail Available! </h4>
                                                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="rfidetail">
                                    <div class="widget">
                                        <header class="widget-header bg-primary">
                                            <h5 class="widget-title pull-left">Project Request For Information</h5>
                                        </header>
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
                    <div class="col-md-4">
                        <div class="widget">
                            <div class="widget-body">
                                <h5 class="widget-footer bg-primary">Lead Plan</h5>
                                <div class="row">
                                    <?php if ($plan <> ""): ?>
                                        <div id="planpreview" class="widget-body">
                                            <?php echo $plan; ?>
                                        </div>
                                        <?php else: ?>
                                            <div class="widget-body">
                                                <h4> No Plan Data Available! </h4>
                                            </div>
                                            <?php endif?>
                                </div>
                            </div>
                            <div class="widget-body">
                                <h5 class="widget-footer bg-primary">Lead Document</h5>
                                <?php if ($document <> ""): ?>
                                    <div id="docupreview" class="widget-body">
                                        <?php echo $document; ?>
                                    </div>
                                    <?php else: ?>
                                        <div class="widget-body">
                                            <h4> No Document Available! </h4>
                                        </div>
                                        <?php endif?>
                            </div>
                        </div>
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

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('.preloader').hide();
            });
        </script>
		
		<script>
			function showme(img){
				$('#imgprev').attr('src', img.attr('src'));
				$('#imgcaption').attr('src', img.val());
				$('#imgmodal').modal();
			}
		</script>

</body>
<script src="<?php echo base_url(); ?>libs/bower/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>

<script src="<?php echo base_url(); ?>libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="<?php echo base_url(); ?>libs/bower/PACE/pace.min.js"></script>

</html>