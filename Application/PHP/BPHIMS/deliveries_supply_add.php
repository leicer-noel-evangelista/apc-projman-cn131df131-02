<?php
	$listOfCss = array();
	$active = "deliveries";
	include("header.php");
	
	$id = $_GET['delivery_id'];
	$supplierList = BPHIMS::getAllSuppliers();
	$itemList = BPHIMS::getAllItemViaCategory(BPHIMS_CATEGORY_SUPPLY, null, null);
	$unitQuantity = BPHIMS::getAllUnits(BPHIMS_UNIT_QUANTITY);
	$unitDosage = BPHIMS::getAllUnits(BPHIMS_UNIT_DOSAGE);
	$supplyStaff = BPHIMS::getAllEmployeeInDepartment(BPHIMS_DEPARTMENT_SUPPLY);
	$info = BPHIMS::getDeliveryInformation($id);
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>Add Delivery Supply <small>#<?php echo Helper::formatID($id); ?></small></h4>
			<p>Add supply item to the delivery record</p>
		</div>
		
		<div class="pull-right">
			<br/>
			<a class="btn btn-danger" href="deliveries_supply.php?delivery_id=<?php echo $id; ?>"><i class="glyphicon glyphicon-arrow-left"></i> Go Back</a>
			<br/>
			<div class="checkbox pull-right">
				<label><input type="checkbox" id="delivery-option" value="delivery_information"> Show Info</label>
			</div>
		</div>
		
		<div id="delivery_information" class="hidden">
			<div class="clearfix"></div>

			<hr/>
			
			<?php $systemMessage = Helper::getMessage();?>
			
			<!-- Forms -->
			<form action="php/action.php" method="post">
				<input type="hidden" name="action" value="delivery_update"/>
				<input type="hidden" name="delivery_id" value="<?php echo $info['delivery_id']; ?>"/>
				<div class="col-md-6">
					<div class="form-group">
						<label for="supplier_id">Supplier</label>
						<select  class="form-control" id="supplier_id" name="supplier_id" required disabled>
						<?php
							foreach($supplierList as $supplier) {
								echo '<option value="'.$supplier['supplier_id'].'" '.(($info['supplier_id']==$supplier['supplier_id'])?'selected="selected"':'').'>'.$supplier['name'].'</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="received_by">Received by</label>
						<select  class="form-control" id="received_by" name="received_by" required disabled>
						<?php
							foreach($supplyStaff as $staff) {
								echo '<option value="'.$staff['employee_id'].'" '.(($info['received_by']==$staff['employee_id'])?'selected="selected"':'').'>'.$staff['last_name'].', '.$staff['first_name'].'</option>';
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
		
		<hr/>
		
		<div class="clearfix"></div>
		
		<form action="php/action.php" method="post">
				<input type="hidden" name="action" value="delivery_supply_add"/>
				<input type="hidden" name="delivery_id" value="<?php echo $info['delivery_id']; ?>"/>
				<div class="col-md-6">
					<div class="form-group">
						<label for="item_id">Item</label>
						<select  class="form-control" id="item_id" name="item_id" required>
						<?php
							foreach($itemList as $item) {
								echo '<option value="'.$item['item_id'].'">'.$item['name'].'</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="batch_code">Batch Code</label>
						<input type="text" class="form-control" id="batch_code" name="batch_code" required />
					</div>
					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input type="text" class="form-control" id="quantity" name="quantity" required />
					</div>
					<div class="form-group">
						<label for="unit_id">Unit</label>
						<select  class="form-control" id="unit_id" name="unit_id" required>
						<?php
							foreach($unitQuantity as $unit) {
								echo '<option value="'.$unit['unit_id'].'">'.$unit['unit'].'</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="dosage">Dosage</label>
						<input type="text" class="form-control" id="dosage" name="dosage" required />
					</div>
					<div class="form-group">
						<label for="dosage_unit_id">Dosage Unit</label>
						<select  class="form-control" id="dosage_unit_id" name="dosage_unit_id" required>
						<?php
							foreach($unitDosage as $unit) {
								echo '<option value="'.$unit['unit_id'].'">'.$unit['unit'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="age">Age</label>
						<input type="text" class="form-control" id="age" name="age" required />
					</div>
					<div class="form-group">
						<label for="brand">Brand</label>
						<input type="text" class="form-control" id="brand" name="brand" required />
					</div>
					<div class="form-group">
						<label for="is_restricted">Restricted</label>
						<select class="form-control" id="is_consignment" name="is_consignment" required>
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
					<div class="form-group">
						<label for="expiry">Expiry</label>
						<input type="text" class="form-control" id="expiry" name="expiry" required />
					</div>
					<div class="form-group">
						<label for="location">Location</label>
						<input type="text" class="form-control" id="location" name="location" required />
					</div>
					<button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Add Delivery Supply</button>
				</div>
			</form>
		
	</div>
</div>
<?php
	$listOfJS = array('deliveries_supply');
	include("footer.php");
?>