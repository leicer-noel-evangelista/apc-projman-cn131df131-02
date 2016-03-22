<?php
	$listOfCss = array();
	$active = "deliveries";
	include("header.php");
	
	$id = $_GET['delivery_id'];
	$supplierList = BPHIMS::getAllSuppliers();
	$supplyStaff = BPHIMS::getAllEmployeeInDepartment(BPHIMS_DEPARTMENT_SUPPLY);
	$info = BPHIMS::getDeliveryInformation($id);
	$totalEquipment = count(BPHIMS::getDeliveryEquipment($id));
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>Update Delivery <small>#<?php echo Helper::formatID($id); ?></small></h4>
			<p>The page will update the information of the current delivery record</p>
		</div>
		
		<div class="pull-right">
			<br/>
			<a class="btn btn-danger" href="deliveries.php"><i class="glyphicon glyphicon-remove"></i> Cancel</a>
			<br/>
			<div class="checkbox pull-right">
				<label><input type="checkbox" id="delivery-option" value="delivery_information"> Hide Info</label>
			</div>
		</div>
		
		<div id="delivery_information">
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
						<select  class="form-control" id="supplier_id" name="supplier_id" required>
						<?php
							foreach($supplierList as $supplier) {
								echo '<option value="'.$supplier['supplier_id'].'" '.(($info['supplier_id']==$supplier['supplier_id'])?'selected="selected"':'').'>'.$supplier['name'].'</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="received_by">Received by</label>
						<select  class="form-control" id="received_by" name="received_by" required>
						<?php
							foreach($supplyStaff as $staff) {
								echo '<option value="'.$staff['employee_id'].'" '.(($info['received_by']==$staff['employee_id'])?'selected="selected"':'').'>'.$staff['last_name'].', '.$staff['first_name'].'</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="received_date">Received date</label>
						<input type="text" class="form-control" id="received_date" name="received_date" value="<?php echo Helper::formatDatepicker($info['received_date']); ?>" required />
					</div>
					<div class="form-group">
						<label for="po_number">PO Number</label>
						<input type="text" class="form-control" id="po_number" name="po_number" value="<?php echo $info['po_number']; ?>" required />
					</div>
					<div class="form-group">
						<label for="pr_number">PR Number</label>
						<input type="text" class="form-control" id="pr_number" name="pr_number" value="<?php echo $info['pr_number']; ?>" required />
					</div>
					<div class="form-group">
						<label for="dr_number">DR Number</label>
						<input type="text" class="form-control" id="dr_number" name="dr_number" value="<?php echo $info['dr_number']; ?>" required />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="si_number">SI Number</label>
						<input type="text" class="form-control" id="si_number" name="si_number" value="<?php echo $info['si_number']; ?>" required />
					</div>
					<div class="form-group">
						<label for="amount">Amount</label>
						<input type="text" class="form-control" id="amount" name="amount" value="<?php echo $info['amount']; ?>" required />
					</div>
					<div class="form-group">
						<label for="is_consignment">Is Consignment</label>
						<select  class="form-control" id="is_consignment" name="is_consignment" required>
							<option value="0" <?php echo (($info['is_consignment']==0)?'selected="selected"':'')?>>No</option>
							<option value="1" <?php echo (($info['is_consignment']==1)?'selected="selected"':'')?>>Yes</option>
						</select>
					</div>
					<div class="form-group">
						<label for="remarks">Remarks</label>
						<textarea class="form-control default-textarea" id="remarks" name="remarks"><?php echo $info['remarks']; ?></textarea>
					</div>
					<button type="submit" class="btn btn-success pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Update Delivery</button>
				</div>
			</form>
		</div>
		<div class="clearfix"></div>
		
		<hr/>
		<a class="btn btn-warning" href="deliveries_supply.php?delivery_id=<?php echo $id; ?>"><i class="glyphicon glyphicon-folder-open"></i> View Delivery Supply (<?php echo $totalSupply; ?>)</a> 
		<a class="btn btn-warning" href="deliveries_equipment.php?delivery_id=<?php echo $id; ?>"><i class="glyphicon glyphicon-folder-open"></i> View Delivery Equipment (<?php echo $totalEquipment; ?>)</a>
		<br/>
		<br/>
		
	</div>
</div>
<?php
	$listOfJS = array('deliveries_update');
	include("footer.php");
?>