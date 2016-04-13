<?php
	$listOfCss = array();
	$active = "deliveries";
	include("header.php");
	
	$totalRecords = BPHIMS::getAllDeliveriesCount();
	$supplierList = BPHIMS::getAllSuppliers();
	$supplyStaff = BPHIMS::getAllEmployeeInDepartment(BPHIMS_DEPARTMENT_SUPPLY);
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>Create Delivery</h4>
			<p>The page will creates a new delivery record. There are currently <b><?php echo $totalRecords; ?></b> deliveries recorded.</p>
		</div>
		
		<div class="pull-right">
			<br/>
			<a class="btn btn-danger" href="deliveries.php"><i class="glyphicon glyphicon-remove"></i> Cancel</a>
		</div>
		
		<div class="clearfix"></div>

		<hr/>
		
		<?php $systemMessage = Helper::getMessage();?>
		
		<!-- Forms -->
		<form action="php/action.php" method="post">
			<input type="hidden" name="action" value="delivery_create"/>
			<div class="col-md-6">
				<div class="form-group">
					<label for="supplier_id">Supplier</label>
					<select  class="form-control" id="supplier_id" name="supplier_id" required>
					<?php
						foreach($supplierList as $supplier) {
							echo '<option value="'.$supplier['supplier_id'].'">'.$supplier['name'].'</option>';
						}
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="received_by">Received by</label>
					<select  class="form-control" id="received_by" name="received_by" required>
					<?php
						foreach($supplyStaff as $staff) {
							echo '<option value="'.$staff['employee_id'].'">'.$staff['last_name'].', '.$staff['first_name'].'</option>';
						}
					?>
					</select>
				</div>
				<div class="form-group">
					<label for="received_date">Received date</label>
					<input type="text" class="form-control" id="received_date" name="received_date" required />
				</div>
				<div class="form-group">
					<label for="po_number">PO Number</label>
					<input type="text" class="form-control" id="po_number" name="po_number" required />
				</div>
				<div class="form-group">
					<label for="pr_number">PR Number</label>
					<input type="text" class="form-control" id="pr_number" name="pr_number" required />
				</div>
				<div class="form-group">
					<label for="dr_number">DR Number</label>
					<input type="text" class="form-control" id="dr_number" name="dr_number" required />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="si_number">SI Number</label>
					<input type="text" class="form-control" id="si_number" name="si_number" required />
				</div>
				<div class="form-group">
					<label for="amount">Amount</label>
					<input type="text" class="form-control" id="amount" name="amount" required />
				</div>

				<!--
				<div class="form-group">
					<label for="is_consignment">Is Consignment</label>
					<select  class="form-control" id="is_consignment" name="is_consignment" required>
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
				</div>
			-->
			
				<div class="form-group">
					<label for="remarks">Remarks</label>
					<textarea class="form-control default-textarea" id="remarks" name="remarks"></textarea>
				</div>
				<button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Add Delivery</button>
			</div>
		</form>
		
	</div>
</div>
<?php
	$listOfJS = array('deliveries_create');
	include("footer.php");
?>