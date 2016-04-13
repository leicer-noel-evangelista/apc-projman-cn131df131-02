<?php
	$listOfCss = array('dashboard_equipment');
	$active = "dashboard";
	include("header.php");
	
	$getEquipmentList = BPHIMS::getAllItems(BPHIMS_ITEM_EQUIPMENT);
	
	foreach($getEquipmentList as $key => $supply) {
		$getEquipmentList[$key]['remaining'] = BPHIMS::getRemainingEquipment($supply['item_id']);
	}
	
?>
<div class="common-body">
	<div class="col-md-12">
		<div class="pull-left">
			<h4>Equipment Dashboard</h4>
			<p>The page contains details and statistics of equipment inventory.</p>
		</div>
		
		<div class="clearfix"></div>
		
		<?php $systemMessage = Helper::getMessage();?>
		
		<ul class="nav nav-tabs">
			<li role="presentation" tab="tabs-supply-summary" class="active"><a href="#">Item Equipment Inventory Summary</a></li>
			<li role="presentation" tab="tabs-supply-graph"><a href="#">Item Equipment Inventory Graph</a></li>
		</ul>
		
		<div id="tabs-supply-summary" class="tabs-body">
			<!-- Table Start -->
			<div class="checkbox pull-right">
				<label><input type="checkbox" id="additional-option" value="additional-option"> Show Options</label>
			</div>
			
			<div class="clearfix"></div>

			<div class="panel panel-default additional-option">
				<div class="panel-body">
					<b>Show/Hide Column</b>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td1"> Item ID</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td2"> Name</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td3"> Remaining / Critical Level</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td4"> Equipment Code</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td5"> Brand</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td6"> Warranty</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td7"> Location</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td8"> Status</label>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-body">
					<b>Legend:</b>
					<div class="checkbox">
						<span class="label label-success">Ok</span> - Stock level is above the critical level<br/>
						<span class="label label-warning">Low Stock</span> - Stock level is lower than or equal to critical level<br/>
						<span class="label label-danger">No Stock</span></td> - There is no available stock for the itm
					</div>
				</div>
			</div>
			
			<!-- Table of Records -->
			<table id="dashboard_table" class="table-common table table-bordered">
				<thead>
					<th class="td1">ID</th>
					<th class="td2">Name</th>
					<th class="td3">R / CL</th>
					<th class="td4">Equipment Code</th>
					<th class="td5">Brand</th>
					<th class="td6">Warranty</th>
					<th class="td7">Location</th>
					<th class="td8">Status</th>
				</thead>
				<tbody>
					<?php
						foreach($getEquipmentList as $supply) {
							$getAllDeliveryEquipment = BPHIMS::getAllDeliveryEquipmentOfItem($supply['item_id']);
							$status = '<span class="label label-success">Ok</span>';
							if($supply['remaining'] <= $supply['critical_level']) {
								$status = '<span class="label label-warning">Low Stock</span>';
							}
							
							echo '
								<tr>
									<td class="td1" rowspan="'.count($getAllDeliveryEquipment).'">'.Helper::formatID($supply['item_id']).'</td>
									<td class="td2" rowspan="'.count($getAllDeliveryEquipment).'">'.$supply['name'].'</td>
									<td class="td3" rowspan="'.count($getAllDeliveryEquipment).'">'.$supply['remaining'].' / '.$supply['critical_level'].'</td>
							';
							foreach($getAllDeliveryEquipment as $key => $delivery) {
								echo '
										<td class="td4">'.$delivery['equipment_code'].'</td>
										<td class="td5">'.$delivery['brand'].'</td>
										<td class="td6">'.Helper::formatDate($delivery['warranty']).' ('.Helper::daysLeft($delivery['warranty']).')</td>
										<td class="td7">'.$delivery['location'].'</td>
										'.(($key==0)?'<td class="td8" rowspan="'.count($getAllDeliveryEquipment).'">'.$status.'</td>':'').'
									</tr>
								';
							}
							
							// In case there is no record
							if(count($getAllDeliveryEquipment) == 0) {
								echo '
										<td colspan="4" class="no_stocks">- No available stocks yet -</td>
										<td class="td8"><span class="label label-danger">No Stock</span></td>
									</tr>
								';
							}
						}
					?>
				</tbody>
			</table>
			<!-- Table End -->
		</div>
		
		<div id="tabs-supply-graph" class="tabs-body">
			<!-- Graph Start -->
			<div id="equipment_chart" class="col-md-12"></div>
			<div class="clearfix"></div>
			<!-- Graph End -->
		</div>
	</div>
</div>

<script>
	var data_label = [];
	var data_critical_level = [];
	var data_remaining = [];
<?php
	foreach($getEquipmentList as $key => $equipment) {
		echo "data_label[".$key."] = '".$equipment['name']."';";
		echo "data_critical_level[".$key."] = ".$equipment['critical_level'].";";
		echo "data_remaining[".$key."] = ".$equipment['remaining'].";";
	}
?>
</script>

<?php
	$listOfJS = array('highcharts', 'dashboard_equipment');
	include("footer.php");
?>