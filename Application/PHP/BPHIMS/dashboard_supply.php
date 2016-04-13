<?php
	$listOfCss = array('dashboard_supply');
	$active = "dashboard";
	include("header.php");
	
	$getSupplyList = BPHIMS::getAllItems(BPHIMS_CATEGORY_SUPPLY);
	
	foreach($getSupplyList as $key => $supply) {
		$getSupplyList[$key]['remaining'] = BPHIMS::getRemainingSupply($supply['item_id']);
	}
?>
<div class="common-body">
	<div class="col-md-12">
		<div class="pull-left">
			<h4>Dashboard</h4>
			<p>The page contains details and statistics of supply inventory.</p>
		</div>
		
		<div class="clearfix"></div>
		
		<?php $systemMessage = Helper::getMessage();?>
		
		<ul class="nav nav-tabs">
			<li role="presentation" tab="tabs-supply-summary" class="active"><a href="#">Item Supply Inventory Summary</a></li>
			<li role="presentation" tab="tabs-supply-graph"><a href="#">Item Supply Inventory Graph</a></li>
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
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td4"> Dispense / Quantity</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td11"> Unit</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td5"> Age</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td10"> Batch Code</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td6"> Dosage</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td7"> Expiry</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td8"> Location</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" checked="checked" class="show-hide-option" value="td9"> Status</label>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-body">
					<b>Legend:</b>
					<div class="checkbox">
						<span class="label label-success">Ok</span> - Stock level is above the critical level<br/>
						<span class="label label-warning">Low Stock</span> - Stock level is lower than or equal to critical level<br/>
						<span class="label label-danger">No Stock</span></td> - There is no available stock for the item
					</div>
				</div>
			</div>
			
			<!-- Table of Records -->
			<table id="dashboard_table" class="table-common table table-bordered">
				<thead>
					<th class="td1">ID</th>
					<th class="td2">Name</th>
					<th class="td3">R / CL</th>
					<th class="td4">D / Q</th>
					<th class="td11">Unit</th>
					<th class="td5">Age</th>
					<th class="td10">Batch Code</th>
					<th class="td6">Dosage</th>
					<th class="td7">Expiry</th>
					<th class="td8">Location</th>
					<th class="td9">Status</th>
				</thead>
				<tbody>
					<?php
						foreach($getSupplyList as $supply) {
							$getAllDeliverySupply = BPHIMS::getAllDeliverySupplyOfItem($supply['item_id']);
							$status = '<span class="label label-success">Ok</span>';
							if($supply['remaining'] <= $supply['critical_level']) {
								$status = '<span class="label label-warning">Low Stock</span>';
							}
							
							echo '
								<tr>
									<td class="td1" rowspan="'.count($getAllDeliverySupply).'">'.Helper::formatID($supply['item_id']).'</td>
									<td class="td2" rowspan="'.count($getAllDeliverySupply).'">'.$supply['name'].'</td>
									<td class="td3" rowspan="'.count($getAllDeliverySupply).'">'.$supply['remaining'].' / '.$supply['critical_level'].'</td>
							';
							foreach($getAllDeliverySupply as $key => $delivery) {
								echo '
										<td class="td4">'.$delivery['dispense'].' / '.$delivery['quantity'].'</td>
										<td class="td11">'.$delivery['unit'].'</td>
										<td class="td5">'.$delivery['age'].'</td>
										<td class="td10">'.$delivery['batch_code'].'</td>
										<td class="td6">'.$delivery['dosage'].' '.$delivery['dosage_unit'].'</td>
										<td class="td7">'.Helper::formatDate($delivery['expiry']).' ('.Helper::daysLeft($delivery['expiry']).')</td>
										<td class="td8">'.$delivery['location'].'</td>
										'.(($key==0)?'<td class="td9" rowspan="'.count($getAllDeliverySupply).'">'.$status.'</td>':'').'
									</tr>
								';
							}
							
							// In case there is no record
							if(count($getAllDeliverySupply) == 0) {
								echo '
										<td colspan="7" class="no_stocks">- No available stocks yet -</td>
										<td class="td9"><span class="label label-danger">No Stock</span></td>
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
			<div id="supply_chart" class="col-md-12"></div>
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
	foreach($getSupplyList as $key => $supply) {
		echo "data_label[".$key."] = '".$supply['name']."';";
		echo "data_critical_level[".$key."] = ".$supply['critical_level'].";";
		echo "data_remaining[".$key."] = ".$supply['remaining'].";";
	}
?>
</script>


<?php
	$listOfJS = array('highcharts', 'dashboard_supply');
	include("footer.php");
?>