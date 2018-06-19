<style>
.dtr-title{color:#43888c; width: 120px; font-size:12px;}
.dtr-data {color:#43888c; width: 100%; font-size:12px;}
</style>
<div class="widget">
    <header class="widget-header">
        <h4 class="widget-title">Lead Tables Details</h4>
		
    </header>
    <!-- .widget-header -->
    <hr class="widget-separator">
    <div class="widget-body">
		
        <table id="responsive-datatable" data-plugin="DataTable" data-options="{
			ajax: '<?php echo base_url(); ?>index.php/process/showallleads',
			responsive: true,
			columnDefs: [ {
				'targets': -1,
				'data': null,
				'text': 'sssssss',
				'defaultContent': '<button class=\'btn-primary\' onclick=\'test(event)\'>Update!</button>',
			} ],	
			
		}" class="table table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                  <?php 
						foreach($otherdata as $row=>$val){
							echo '<th>'.str_replace("_", "", $val).'</th>';
						}
					 ?>
					 <th>Action</th>
                </tr>
            </thead>
			<tbody>
				
			</tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
    <!-- .widget-body -->
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
	
	editor = new $.fn.dataTable.Editor( {
        ajax: "<?php echo base_url(); ?>index.php/process/showallleads",
        table: "#responsive-datatable",
    });
	
	$('#responsive-datatable').on( 'click', 'tbody td:not(:first-child)', function (e) {
		
    });
	
});
	/* */

function test(e){
	alert(this.name);

}

</script>