<?php
	$listOfCss = array();
	$active = "deliveries";
	include("header.php");
	
	$id = $_GET['delivery_id'];
	$supplierList = BPHIMS::getAllSuppliers();
	$supplyStaff = BPHIMS::getAllEmployeeInDepartment(BPHIMS_DEPARTMENT_SUPPLY);
	$info = BPHIMS::getDeliveryInformation($id);
	$supplyList = BPHIMS::getDeliverySupply($id);
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>View Delivery Supply <small>#<?php echo Helper::formatID($id); ?></small></h4>
			<p>This page contains the list of supply for the current delivery record</p>
		</div>
		
		<div class="pull-right">
			<br/>
			<a class="btn btn-danger" href="deliveries_update.php?delivery_id=<?php echo $id; ?>"><i class="glyphicon glyphicon-arrow-left"></i> Go Back</a>
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
		<div class="pull-left">
			<h4>Delivery Supply</h4>
			<p>List of supply in the delivery</p>
		</div>
		<div class="pull-right">
			<a class="btn btn-primary" href="deliveries_supply_add.php?delivery_id=<?php echo $id; ?>"><i class="glyphicon glyphicon-plus"></i> Add Delivery Supply</a>
			<br/>
			<div class="checkbox pull-right">
				<label><input type="checkbox" id="delivery-supply-option" value="delivery-supply-information"> Show Options</label>
			</div>
		</div>
		
		<div class="clearfix"></div>
		
		<?php $systemMessage = Helper::getMessage();?>
		
		<div id="delivery-supply-information" class="panel panel-default hidden">
			<div class="panel-body">
				<b>Show/Hide Column</b>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td1"> Supply ID</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td2"> Item</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" class="show-hide-option" value="td3"> Batch Code</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" class="show-hide-option" value="td4"> Dispense</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td5"> Quantity</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td6"> Dosage</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td7"> Age</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" class="show-hide-option" value="td8"> Brand</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td9"> Restricted</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td10"> Expiry</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td11"> Location</label>
				</div>
			</div>
		</div>
		
		<div id="delivery_supply">
				<table class="table-common table table-bordered">
				<thead>
					<th class="td1">ID</th>
					<th class="td2">Item</th>
					<th class="td3 hidden">Batch Code</th>
					<th class="td4 hidden">Dispense</th>
					<th class="td5">Quantity</th>
					<th class="td6">Dosage</th>
					<th class="td7">Age</th>
					<th class="td8 hidden">Brand</th>
					<th class="td9">Restricted</th>
					<th class="td10">Expiry</th>
					<th class="td11">Location</th>
					<th>Actions</th>
				</thead>
				<tbody>
					<?php
						foreach($supplyList as $supply) {
							$dataDeleteName = '#'.Helper::formatID($supply['delivery_supply_id']).' - '.$supply['item_name'];
							echo '
								<tr">
									<td class="td1">'.Helper::formatID($supply['delivery_supply_id']).'</td>
									<td class="td2">'.$supply['item_name'].'</td>
									<td class="td3 hidden">'.$supply['batch_code'].'</td>
									<td class="td4 hidden">'.$supply['dispense'].'</td>
									<td class="td5">'.$supply['quantity'].' '.$supply['unit'].'</td>
									<td class="td6">'.$supply['dosage'].' '.$supply['dosage_unit'].'</td>
									<td class="td7">'.$supply['age'].'</td>
									<td class="td8 hidden">'.$supply['brand'].'</td>
									<td class="td9">'.(($supply['is_restricted'])?"Yes":"No").'</td>
									<td class="td10">'.Helper::formatDate($supply['expiry']).'</td>
									<td class="td11">'.$supply['location'].'</td>
									<td>
										<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-delete" data-delete-name="'.$dataDeleteName.'" data-delete-id="'.$supply['delivery_supply_id'].'"><i class="glyphicon glyphicon-trash"></i></button>
										<a class="btn btn-xs btn-success" href="deliveries_supply_update.php?delivery_supply_id='.$supply['delivery_supply_id'].'" data-toggle="tooltip" data-placement="top" title="View / Update"><i class="glyphicon glyphicon-pencil"></i></a>
									</td>
								</tr>
							';
						}
					?>
				</tbody>
			</table>
		</div>
		
	</div>
</div>

<!-- Modal for deleting item -->
<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Delete Delivery Supply Record</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete record <b id="delete-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form action="php/action.php" method="post">
					<input type="hidden" name="action" value="delivery_supply_delete" />
					<input type="hidden" name="delivery_id" value="<?php echo $id; ?>" />
					<input type="hidden" name="delivery_supply_id" id="delete-id" />
					<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
					<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	$listOfJS = array('deliveries_supply');
	include("footer.php");
?>