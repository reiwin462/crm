		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="widget stats-widget">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="widget-title text-success"><span class="counter" data-plugin="counterUp" id="sql">50</span></h3>
							<small class="text-color">Sales Qualified Leads</small>
						</div>
						<span class="pull-right big-icon watermark"><i class="fa fa-phone"></i></span>
					</div>
					<footer class="widget-footer bg-success">
						<small>SQL</small>
					</footer>
				</div><!-- .widget -->
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="widget stats-widget">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="widget-title text-primary"><span class="counter" data-plugin="counterUp" id="mql">30</span></h3>
							<small class="text-color">Marketing Qualified Lead</small>
						</div>
						<span class="pull-right big-icon watermark"><i class="fa fa-phone-square"></i></span>
					</div>
					<footer class="widget-footer bg-primary">
						<small>MQL</small>
					</footer>
				</div><!-- .widget -->
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="widget stats-widget">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="widget-title text-warning"><span class="counter" data-plugin="counterUp" id="sdl">10</span></h3>
							<small class="text-color">Sales Development Represent</small>
						</div>
						
					</div>
					<footer class="widget-footer bg-warning">
						<small>SDL</small>
					</footer>
				</div><!-- .widget -->
			</div>
			
			<div class="col-md-3 col-sm-6">
				<div class="widget stats-widget">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="widget-title text-danger"><span class="counter" data-plugin="counterUp" id="nql">2</span></h3>
							<small class="text-color">Not Qualified Lead</small>
						</div>
						<span class="pull-right big-icon watermark"><i class="fa fa-remove"></i></span>
					</div>
					<footer class="widget-footer bg-danger">
						<small>NQL</small>
					</footer>
				</div><!-- .widget -->
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="widget" >
				  <header class="widget-header bg-primary">
				    <h5 class="widget-title">Upcomming Biddings For this Month</h5>
				  </header><!-- .widget-header -->
				  <hr class="widget-separator">
				  <div id="dashbidding" class="widget-body table-responsive ">
				  	<table id="biddingtable" class="table table-striped">
						<thead>
							<tr>
								<th style="width: 50px;">Bid Date</th>
								<th style="width: 50px;">Project Name</th>
								<th style="width: 50px;">Client Name</th>
								<th style="width: 50px;">Status</th>
								<th style="width: 50px;">Sales Representative</th>
								<th style="width: 50px;">Type of Work</th>
								<th style="width: 50px;">Lead Source</th>
								<th style="width: 50px;">Engineer</th>
								<th>&nbsp;</th>									
							</tr>
						</thead>
				  		<tbody id="tablebidding">
							
						</tbody>
					</table>	
					</div>
					<hr class="widget-separator">
					<div class="container">
						<small><i class="fa fa-circle-o" aria-hidden="true"></i> Upcomming Days</small>
						<small><i class="fa fa-circle-o sea" aria-hidden="true"></i> Today</small>
						<small><i class="fa fa-circle-o isempty" aria-hidden="true"></i> Passed Days</small>
					</div>
				</div>
			</div>
			
		</div>

		<div class="row">
			<div class="col-md-6 col-sm-12">
				<div class="widget countries-widget">
				  <header class="widget-header bg-warning">
				    <h5 class="widget-title">Top Engineers</h5>
				  </header>
				  <hr class="widget-separator">
					<div class="widget-body">
						<div id="engineer" class="list-group m-0">
						</div>
					</div>
					<hr class="widget-separator">
					<div  class="text-center">
						<small >Based on the accumulated Bid Value Submmitted</small>
					</div>
				</div>
			</div>
			
			<div class="col-md-6 col-sm-12">
				<div class="widget countries-widget">
				  <header class="widget-header sun">
				    <h5 class="widget-title">Work Type Distribution for this Month Bidding</h5>
				  </header>
				  <hr class="widget-separator">
					<div class="widget-body">
						<div id="worktype"  style="height:300px;"> 
						
						</div>
					</div>
					<hr class="widget-separator">
				</div>
			</div>
		</div>
		
		<!-- .row --
		
		<div style="clear:both">&nbsp;</div>
		<div style="clear:both">&nbsp;</div>
		<div style="clear:both">&nbsp;</div>
		<div style="clear:both">&nbsp;</div>
		<div style="clear:both">&nbsp;</div>
		
		<div class="row">
			<div class="col-md-12">
				aaaaaaaaaaaaas
			</div>
		</div>
		--->
<script>

document.addEventListener("DOMContentLoaded", function() {
	var fr = 0;
	leadcount();
	leadbidding();
	topengineer();
	gettypeofwork()
	setInterval(function(){ actionlist(); }, 10000);
});

function actionlist(){
	leadcount();
	topengineer();
}

function leadcount(){
	var xlink = "<?php echo base_url(); ?>" + 'dashcontroller/getleadcount';
	$.get(xlink, function(data, status)
	 {
		var j = JSON.parse(data);
		var total = 0;
		$.each(j, function(key, value){
			//alert(value['lead_status'] + " " + value['cnt']);
			if(value['lead_status'] == "SQL"){
				$('#sql').html(value['cnt']);
			}else if(value['lead_status'] == "MQL"){
				$('#mql').html(value['cnt']);
			}else if(value['lead_status'] == "SDL"){
				$('#sdl').html(value['cnt']);
			}else if(value['lead_status'] == "NQL"){
				$('#nql').html(value['cnt']);
			}else{
				
			}
			total = total + parseInt(value['cnt']);
		});
	});
}

function leadbidding(){
	var xlink = "<?php echo base_url(); ?>" + 'dashcontroller/getforbidding';
	$.get(xlink, function(data, status)
	 {$('#tablebidding').html(data); });
}
function topengineer(){
	var xlink = "<?php echo base_url(); ?>" + 'dashcontroller/topengineer';
	$.get(xlink, function(data, status)
	 {$('#engineer').html(data); });
}

function gettypeofwork(){
	
	$.ajax({
        type:'get', 
        dataType: "json", 
        url:"<?php echo base_url(); ?>" + 'dashcontroller/getwork',
        success: function(data) {
			var options = {
			series: { pie: { show: true }},
			legend: { show: false },
			grid: { hoverable: true },
			tooltip: { show: true, content: '%s %p.0%', defaultTheme: true}
			}	
            $.plot($("#worktype"), data, options );
        }
    });
	

}

</script>