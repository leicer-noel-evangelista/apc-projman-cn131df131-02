<?php
	$listOfCss = array();
	$active = "deliveries";
	include("header.php");
	
	$id = $_GET['delivery_supply_id'];
	$supplierList = BPHIMS::getAllSuppliers();
	$unitQuantity = BPHIMS::getAllUnits(BPHIMS_UNIT_QUANTITY);
	$unitDosage = BPHIMS::getAllUnits(BPHIMS_UNIT_DOSAGE);
	$supplyStaff = BPHIMS::getAllEmployeeInDepartment(BPHIMS_DEPARTMENT_SUPPLY);
	$infoSupply = BPHIMS::getSupplyInformation($id);
	$info = BPHIMS::getDeliveryInformation($infoSupply['delivery_id']);
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>Update Delivery Supply <small>#<?php echo Helper::formatID($info['delivery_id']).'-'.Helper::formatID($id); ?></small></h4>
			<p>Update them supply item from the delivery record</p>
		</div>
		
		<div class="pull-right">
			<br/>
			<a class="btn btn-danger" href="deliveries_supply.php?delivery_id=<?php echo $infoSupply['delivery_id']; ?>"><i class="glyphicon glyphicon-arrow-left"></i> Go Back</a>
			<br/>
			<div class="checkbox pull-right">
				<label><input type="checkbox" id="delivery-option" value="delivery_information"> Show Info</label>
			</div>
		</div>
		<div id="delivery_information" class="hidden">
			<div class="clearfix"></div>

			<hr/>
			
			<!-- Forms -->
			<form action="php/action.php" method="post">
				<div class="col-md-6">
					<div class="form-group">
						<label for="supplier_id">Supplier</label>
						<select  class="form-control" id="supplier_id" name="supplier_id" required disabled>
						<?php
							foreach($supplierList as $supplier) {
								$selected = ($info['supplier_id']==$supplier['supplier_id'])?'selected="selected"':'';
								echo '<option value="'.$supplier['supplier_id'].'" '.$selected.'>'.$supplier['name'].'</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="received_by">Received by</label>
						<select  class="form-control" id="received_by" name="received_by" required disabled>
						<?php
							foreach($supplyStaff as $staff) {
								$selected = ($info['received_by']==$staff['employee_id'])?'selected="selected"':'';
								echo '<option value="'.$staff['employee_id'].'" '.$selected.'>'.$staff['last_name'].', '.$staff['first_name'].'</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="received_date">Received date</label>
						<input type="text" class="form-control" id="received_date" name="received_date" value="<?php echo Helper::formatDatepicker($info['received_date']); ?>" required disabled />
					</div>
					<div class="form-group">
						<label for="po_number">PO Number</label>
						<input type="text" class="form-control" id="po_number" name="po_number" value="<?php echo $info['po_number']; ?>" required disabled />
					</div>
					<div class="form-group">
						<label for="pr_number">PR Number</label>
						<input type="text" class="form-control" id="pr_number" name="pr_number" value="<?php echo $info['pr_number']; ?>" required disabled />
					</div>
					<div class="form-group">
						<label for="dr_number">DR Number</label>
						<input type="text" class="form-control" id="dr_number" name="dr_number" value="<?php echo $info['dr_number']; ?>" required disabled />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="si_number">SI Number</label>
						<input type="text" class="form-control" id="si_number" name="si_number" value="<?php echo $info['si_number']; ?>" required disabled />
					</div>
					<div class="form-group">
						<label for="amount">Amount</label>
						<input type="text" class="form-control" id="amount" name="amount" value="<?php echo $info['amount']; ?>" required disabled />
					</div>
					<div class="form-group">
						<label for="is_consignment">Is Consignment</label>
						<select class="form-control" id="is_consignment" name="is_consignment" required disabled>
							<option value="0" <?php echo (($info['is_consignment']==0)?'selected="selected"':'')?>>No</option>
							<option value="1" <?php echo (($info['is_consignment']==1)?'selected="selected"':'')?>>Yes</option>
						</select>
					</div>
					<div class="form-group">
						<label for="remarks">Remarks</label>
						<textarea class="form-control default-textarea" id="remarks" name="remarks" disabled><?php echo $info['remarks']; ?></textarea>
					</div>
				</div>
			</form>
		</div>
		<div class="clearfix"></div>
		
		<?php $systemMessage = Helper::getMessage();?>
		<hr/>
		
		<div class="clearfix"></div>
		
		<form action="php/action.php" method="post">
				<input type="hidden" name="action" value="delivery_supply_update"/>
				<input type="hidden" name="delivery_supply_id" value="<?php echo $id; ?>"/>
				<div class="col-md-6">
					<div class="form-group">
						<label for="item_id">Item</label>
						<select  class="form-control" id="item_id" name="item_id" required>
						<?php
							foreach($itemList as $item) {
								echo '<option value="'.$item['item_id'].'" '.(($infoSupply['item_id']==$item['item_id'])?'selected="selected"':'').'>'.$item['name'].'</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="batch_code">Batch Code</label>
						<input type="text" class="form-control" id="batch_code" name="batch_code" value="<?php echo $infoSupply['batch_code']; ?>" required />
					</div>
					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $infoSupply['quantity']; ?>" required />
					</div>
					<div class="form-group">
						<label for="unit_id">Unit</label>
						<select  class="form-control" id="unit_id" name="unit_id" required>
						<?php
							foreach($unitQuantity as $unit) {
								echo '<option value="'.$unit['unit_id'].'" '.(($infoSupply['unit_id']==$unit['unit_id'])?'selected="selected"':'').'>'.$unit['unit'].'</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="dosage">Dosage</label>
						<input type="text" class="form-control" id="dosage" name="dosage" value="<?php echo $infoSupply['dosage']; ?>" required />
					</div>
					<div class="form-group">
						<label for="dosage_unit_id">Dosage Unit</label>
						<select  class="form-control" id="dosage_unit_id" name="dosage_unit_id" value="<?php echo $infoSupply['dosage_unit_id']; ?>" required>
						<?php
							foreach($unitDosage as $unit) {
								echo '<option value="'.$unit['unit_id'].'" '.(($infoSupply['dosage_unit_id']==$unit['unit_id'])?'selected="selected"':'').'>'.$unit['unit'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="age">Age</label>
						<input type="text" class="form-control" id="age" name="age" value="<?php echo $infoSupply['age']; ?>" required />
					</div>
					<div class="form-group">
						<label for="brand">Brand</label>
						<input type="text" class="form-control" id="brand" name="brand" value="<?php echo $infoSupply['brand']; ?>" required />
					</div>
					<div class="form-group">
						<label for="is_restricted">Restricted</label>
						<select class="form-control" id="is_restricted" name="is_restricted" required>
							<option value="0" <?php echo (($infoSupply['is_restricted']==0)?'selected="selected"':''); ?>>No</option>
							<option value="1" <?php echo (($infoSupply['is_restricted']==1)?'selected="selected"':''); ?>>Yes</option>
						</select>
					</div>
					<div class="form-group">
						<label for="expiry">Expiry</label>
						<input type="text" class="form-control" id="expiry" name="expiry" value="<?php echo Helper::formatDatepicker($infoSupply['expiry']); ?>" required />
					</div>
					<div class="form-group">
						<label for="location">Location</label>
						<input type="text" class="form-control" id="location" name="location" value="<?php echo $infoSupply['location']; ?>" required />
					</div>
					<button type="submit" class="btn btn-success pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Update Delivery Supply</button>
				</div>
			</form>
		
	</div>
</div>
<?php
	$listOfJS = array('deliveries_supply');
	include("footer.php");
?>