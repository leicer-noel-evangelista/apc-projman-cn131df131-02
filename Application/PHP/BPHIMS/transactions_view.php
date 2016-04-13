<?php
	$listOfCss = array('transactions_view');
	$active = "transactions";
	include("header.php");
	
	$id = $_GET['transaction_id'];
	$transaction = BPHIMS::getTransaction($id);
	//echo"<pre>";print_r($transaction);die();
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>View Transaction</h4>
			<p>The page contains details of the transaction</p>
		</div>
		
		<div class="pull-right">
			<br/>
			<a class="btn btn-danger" href="transactions.php"><i class="glyphicon glyphicon-remove"></i> Cancel</a>
		</div>
		
		<div class="clearfix"></div>

		<hr/>
		
		<?php $systemMessage = Helper::getMessage();?>
		
		<table class="transaction_details col-md-12">
			<tr>
				<td class="col-md-2"><b>Transaction ID:</b></td>
				<td class="col-md-10"><?php echo Helper::formatID($transaction['transaction_id']); ?></td>
			</tr>
			<tr>
				<td class="col-md-2"><b>Request Type:</b></td>
				<td class="col-md-10"><?php echo ($transaction['type'] == BPHIMS_TRANSACTION_DEPARTMENT)?'Department Request':'Doctor Request'; ?></td>
			</tr>
			<tr>
				<td class="col-md-3"><b>Request Date:</b></td>
				<td class="col-md-10"><?php echo Helper::formatDateComplete($transaction['requested_date']); ?></td>
			</tr>
			<tr>
				<td class="col-md-3"><b>Requested By:</b></td>
				<td class="col-md-10"><?php echo $transaction['requested_by_last_name'].', '.$transaction['requested_by_first_name']; ?></td>
			</tr>
			<?php if($transaction['department_id'] != 0) {?>
			<tr>
				<td class="col-md-2"><b>Department:</b></td>
				<td class="col-md-10"><?php echo $transaction['department_name']; ?></td>
			</tr>
			<?php } ?>
			<?php if($transaction['department_head_id'] != 0) {?>
			<tr>
				<td class="col-md-2"><b>Department Head:</b></td>
				<td class="col-md-10"><?php echo $transaction['department_head_last_name'].', '.$transaction['department_head_first_name']; ?></td>
			</tr>
			<?php } ?>
			<?php if($transaction['doctor_id'] != 0) {?>
			<tr>
				<td class="col-md-2"><b>Doctor:</b></td>
				<td class="col-md-10"><?php echo $transaction['doctor_last_name'].', '.$transaction['doctor_first_name']; ?></td>
			</tr>
			<?php } ?>
			<?php if($transaction['patient_id'] != 0) {?>
			<tr>
				<td class="col-md-2"><b>Patient:</b></td>
				<td class="col-md-10"><?php echo $transaction['patient_last_name'].', '.$transaction['patient_first_name']; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="col-md-3"><b>Remarks:</b></td>
				<td class="col-md-10"><?php echo Helper::replaceEmpty($transaction['remarks']); ?></td>
			</tr>
			<tr>
				<td class="item_requests col-md-2"><b>Requested Supply:</b></td>
				<td class="col-md-10">
					<?php
						$getRequestedSupply = BPHIMS::getAllTransactionItems($transaction['transaction_id'], BPHIMS_ITEM_SUPPLY);
						
						if(count($getRequestedSupply) == 0) {
							echo 'No requested supplies.';
						} else {
					?>
						<table class="item_requests col-md-12">
							<thead>
								<th class="col-md-1">#</th>
								<th class="col-md-2">Item ID</th>
								<th class="col-md-5">Name</th>
								<th class="col-md-2">Dosage</th>
								<th class="col-md-2">Quantity</th>
							</thead>
							<tbody>
							<?php
								foreach($getRequestedSupply as $key => $supply) {
									$item = BPHIMS::getItemOnDeliverySupply($supply['delivery_item_id']);
									$item_details = $item['code'].' :: '.$item['name'];
									echo '
										<tr>
											<td class="supply_counter">'.($key+1).'</td>
											<td class="supply_item_id">'.Helper::formatID($item['item_id']).'</td>
											<td class="supply_name">'.$item_details.'</td>
											<td class="supply_dosage">'.$item['dosage'].' '.$item['dosage_unit'].'</td>
											<td class="supply_quantity">x'.$supply['quantity'].' '.$item['unit'].'</td>
										</tr>
									';
								}
							?>
							<tbody>
						</table>
					<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="item_requests col-md-2"><b>Requested Equipments:</b></td>
				<td class="col-md-10">
					<?php
						$getRequestedEquipment = BPHIMS::getAllTransactionItems($transaction['transaction_id'], BPHIMS_ITEM_EQUIPMENT);
						
						if(count($getRequestedEquipment) == 0) {
							echo 'No requested equipments.';
						} else {
					?>
						<table class="item_requests col-md-12">
							<thead>
								<th class="col-md-1">#</th>
								<th class="col-md-2">Item ID</th>
								<th class="col-md-7">Name</th>
								<th class="col-md-2">Quantity</th>
							</thead>
							<tbody>
							<?php
								foreach($getRequestedEquipment as $key => $equipment) {
									$item = BPHIMS::getItemOnDeliveryEquipment($equipment['delivery_item_id']);
									$item_details =$item['equipment_code'].' :: '.$item['name'].' ('.$item['brand'].')';
									echo '
										<tr>
											<td class="supply_counter">'.($key+1).'</td>
											<td class="supply_item_id">'.Helper::formatID($item['item_id']).'</td>
											<td class="supply_name">'.$item_details.'</td>
											<td class="supply_quantity">x'.$equipment['quantity'].'</td>
										</tr>
									';
								}
							?>
							<tbody>
						</table>
					<?php
						}
					?>
				</td>
			</tr>
		</table>
	
	</div>	
		
</div>

<?php
	$listOfJS = array('transactions');
	include("footer.php");
?>