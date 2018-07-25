
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="widget p-md clearfix">
					<div class="pull-left">
						<h3 class="widget-title">Total Leads</h3>
						<small class="text-color">Number of leads in queue</small>
					</div>
					<span class="pull-right fz-lg fw-500 counter" data-plugin="counterUp">102</span>
				</div><!-- .widget -->
			</div>

			<div class="col-md-6 col-sm-6">
				<div class="widget p-md clearfix">
					<div class="pull-left">
						<h3 class="widget-title">Sales</h3>
						<small class="text-color">Successful Sales Leads</small>
					</div>
					<span class="pull-right fz-lg fw-500 counter" data-plugin="counterUp">325</span>
				</div><!-- .widget -->
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="widget stats-widget">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="widget-title text-primary"><span class="counter" data-plugin="counterUp">50</span></h3>
							<small class="text-color">Total Calls In Queue</small>
						</div>
						<span class="pull-right big-icon watermark"><i class="fa fa-phone"></i></span>
					</div>
					<footer class="widget-footer bg-primary">
						<small>0% Drop</small>
						<span class="small-chart pull-right" data-plugin="sparkline" data-options="[4,3,5,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
					</footer>
				</div><!-- .widget -->
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="widget stats-widget">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="widget-title text-success"><span class="counter" data-plugin="counterUp">30</span></h3>
							<small class="text-color">Total Active Calls</small>
						</div>
						<span class="pull-right big-icon watermark"><i class="fa fa-phone-square"></i></span>
					</div>
					<footer class="widget-footer bg-success">
						<small>21 Successful Sale</small>
						<span class="small-chart pull-right" data-plugin="sparkline" data-options="[1,2,3,5,4], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
					</footer>
				</div><!-- .widget -->
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="widget stats-widget">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="widget-title text-danger"><span class="counter" data-plugin="counterUp">2</span></h3>
							<small class="text-color">Dropped Calls</small>
						</div>
						<span class="pull-right big-icon watermark"><i class="fa fa-remove"></i></span>
					</div>
					<footer class="widget-footer bg-danger">
						<small>1 Agent Dropped</small>
						<span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,4,3,4,3], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
					</footer>
				</div><!-- .widget -->
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="widget stats-widget">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="widget-title text-warning"><span class="counter" data-plugin="counterUp">10</span></h3>
							<small class="text-color">Disposing Calls</small>
						</div>
						<span class="pull-right big-icon watermark"><i class="fa fa-tasks"></i></span>
					</div>
					<footer class="widget-footer bg-warning">
						<small>0 Agent</small>
						<span class="small-chart pull-right" data-plugin="sparkline" data-options="[5,4,3,5,2],{ type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
					</footer>
				</div><!-- .widget -->
			</div>
		</div><!-- .row -->
		<div style="clear:both">&nbsp;</div>
		<div style="clear:both">&nbsp;</div>
		<div style="clear:both">&nbsp;</div>
		<div style="clear:both">&nbsp;</div>
		<div class="row">
			<div class="col-md-12">
				<div class="widget row no-gutter p-lg">						
					<div class="col-md-5 col-sm-5">
						<div>
							<h3 class="widget-title fz-lg text-primary m-b-lg">Sales in 2018</h3>
							<p class="m-b-lg">Current data for the year 2018</p>
							<p class="fs-italic">Successful transactions from January to June</p>
						</div>
					</div>

					<div class="col-md-7 col-sm-7">
						<div>
							<div id="lineChart" data-plugin="plot" data-options="
								[
									{
										data: [[1,3.6],[2,3.5],[3,6],[4,4],[5,4.3],[6,3.5],[7,3.6]],
										color: '#ffa000',
										lines: { show: true, lineWidth: 6 },
										curvedLines: { apply: true }
									},
									{
										data: [[1,3.6],[2,3.5],[3,6],[4,4],[5,4.3],[6,3.5],[7,3.6]],
										color: '#ffa000',
										points: {show: true}
									}
								],
								{
									series: {
										curvedLines: { active: true }
									},
									xaxis: {
										show: true,
										font: { size: 12, lineHeight: 10, style: 'normal', weight: '100',family: 'lato', variant: 'small-caps', color: '#a2a0a0' }
									},
									yaxis: {
										show: true,
										font: { size: 12, lineHeight: 10, style: 'normal', weight: '100',family: 'lato', variant: 'small-caps', color: '#a2a0a0' }
									},
									grid: { color: '#a2a0a0', hoverable: true, margin: 8, labelMargin: 8, borderWidth: 0, backgroundColor: '#fff' },
									tooltip: true,
									tooltipOpts: { content: 'X: %x.0, Y: %y.2',  defaultTheme: false, shifts: { x: 0, y: -40 } },
									legend: { show: false }
								}" style="width: 100%; height: 230px;">
							</div>
						</div>
					</div>
				</div><!-- .widget -->	
			</div>
		</div><!-- .row -->
