<?php
	$listOfCss = array('dashboard');
	$active = "dashboard";
	include("header.php");
	
	$getSupplyList = BPHIMS::getAllItems(BPHIMS_CATEGORY_SUPPLY);
	
	foreach($getSupplyList as $key => $supply) {
		$getSupplyList[$key]['remaining'] = BPHIMS::getRemaining($supply['item_id']);
	}
	//echo '<pre>';print_r($getSupplyList);die();
?>
<div class="common-body">
	<div class="col-md-12">
		<h4>Dashboard</h4>
		<p>The page contains statistics of the inventory.</p>
		
		<div id="supply_chart" class="col-md-12" style="border:solid 1px #ccc;height:800px;"></div>
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
	$listOfJS = array('highcharts', 'dashboard');
	include("footer.php");
?>