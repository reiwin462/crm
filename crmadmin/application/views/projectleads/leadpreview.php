<div class="widget">
	<header class="widget-header primary">
        <h5 class="widget-title"><span class="pull-left">This week's Lead Biddings</span></h5>
    </header>
	<div class="widget-body">
		<?php
			//date_default_timezone_set('Asia/Manila');
			$first_day_of_the_week = 'Sunday';
			$start_of_the_week     = strtotime("Last $first_day_of_the_week");
			if ( strtolower(date('l')) === strtolower($first_day_of_the_week) )
				{$start_of_the_week = strtotime('today'); }
			$end_of_the_week = $start_of_the_week + (60 * 60 * 24 * 7) - 1;
			//$date_format =  'l jS \of F Y H:i:s A';
			$date_format =  'l jS \of F Y H:i:s';
			echo "<span class=\"pull-left\" style='font-size: 10px;'>".'<i class="fa fa-hourglass-start" aria-hidden="true"></i>'."<small>&nbsp;Start of the Week: ". date($date_format, $start_of_the_week)."</small>"."</span>";
			echo "<span class=\"pull-right\" style='font-size: 10px;'>".'<i class="fa fa-hourglass-end" aria-hidden="true"></i>'."<small>&nbsp;End of the Week: ". date($date_format, $end_of_the_week)."</small>"."</span>";	
		?>
	</div>
	<hr>
</div>

<div id="hotleadstable" class="widget">
	<header class="widget-header info">
        <h5 class="widget-title"><span class="pull-left">Today's Schedule Hot Leads!</span></h5>
    </header>
	<div class="widget-body table-responsive">
		<table id="engineerperfmon" width="100%" style="padding:10px; border:1px;">
			<thead class="sun">
				<th>Project No</th>
				<th>Status</th>
				<th>Estimator</th>
				<th>Project Name</th>
				<th>Bid Value</th>
				<th>Created by</th>
				<th>Action</th>
			</thead>
			<tbody id="hotleads">
				
			</tbody>
		</table>  
	</div>
	<header class="widget-header info" style="padding:10px;">
		
    </header>
</div>


<div class="widget">
	<header class="widget-header info">
        <h5 class="widget-title"><span class="pull-left">Top Engineer</span></h5>
		
    </header>
	<div class="widget-body table-responsive">
		<table id="engineerperfmon" width="100%" style="padding:10px; border:1px;" class="table table-stripped">
			<thead >
				<th>Engineer's List</th>
				<th>WON</th>
				<th>SQL</th>
				<th>MQL</th>
				<th>SDL</th>
				<th>NQL</th>
				<th>DEAD</th>
				<th>Incomplete Leads</th>
			</thead>
			<tbody id="weeklydata">
				
			</tbody>
		</table>  
	</div>
	<header class="widget-header info" style="padding:10px;">
		
    </header>
</div>

<div class="row">
	<div class="col-md-4 col-sm-12">
		<div class="widget countries-widget">
			<header class="widget-header bg-info">
				<h5 class="widget-title">Top Estimator for this Week</h5>
			</header>
			<hr class="widget-separator">
				<div class="widget-body">
					<div id="estimator"  style="height:300px;"> </div>
				</div>
			<div class="text-center">	
			<small class="text-muted">Data is based from total number lead assiged per Estimator</small>
			</div>
		</div>
	</div>
	
	<div class="col-md-8 col-sm-12">
		<div class="widget countries-widget">
			<header class="widget-header bg-info">
				<h5 class="widget-title">Top Work Type for this Week</h5>
			</header>
			<hr class="widget-separator">
				<div class="widget-body">
					<div id="topwork"  style="height:300px;"> </div>
				</div>
			<div class="text-center">	
			<small class="text-muted">Data is based from accumulated type or work scheduled for bidding this week</small>
			</div>
		</div>
	</div>
</div>


<script>

document.addEventListener("DOMContentLoaded", function(){
	dailyhotleads();
	engineerdata();
	gettopestimator();
	gettopweekwork();
});

function engineerdata(){
	$('#weeklydata').html('');
	var xlink = "<?php echo base_url(); ?>" + 'projectleadcontrol/getengineerweek';
	$.get(xlink, function(data, status)
	 {$('#weeklydata').html(data); });
}

function dailyhotleads(){
	$('#hotleads').html('');
	var xlink = "<?php echo base_url(); ?>" + 'projectleadcontrol/hotleads';
	$.get(xlink, function(data, status)
	 {$('#hotleads').html(data); });
}

function gettopestimator(){
	$.ajax({
        type:'get', 
        dataType: "json", 
        url:"<?php echo base_url(); ?>" + 'projectleadcontrol/getweekestimator',
        success: function(data) {
			var options = {
			series: { pie: { show: true }},
			legend: { show: false },
			grid: { hoverable: true },
			tooltip: { show: false, content: '%s %p.0%', defaultTheme: true}
			}	
            $.plot($("#estimator"), data, options );
        }
    });
}

function gettopweekwork(){
	var datax = [];
	var str = '';
	$.ajax({
        type:'get', 
        dataType: "json", 
        url:"<?php echo base_url(); ?>" + 'projectleadcontrol/getweekwork',
        success: function(data) {

			$.plot("#topwork", [ data ], {
			series: {
						bars: {
							show: true,
							barWidth: 0.6,
							align: "center"
						}
					},
					xaxis: {
						mode: "categories",
						tickLength: 0
					},
					legend: {
                        noColumns: 0,
                        labelBoxBorderColor: "#000000",
                        position: "nw"
                    },
					grid: {
                        hoverable: true,
                        borderWidth: 2,
                        backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
                    }
				});
					
       
	   }
    });
}

</script>