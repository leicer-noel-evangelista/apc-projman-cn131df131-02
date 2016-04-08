<?php
	$listOfCss = array('transactions');
	$active = "transactions";
	include("header.php");
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>Create Doctor Request</h4>
			<p>This page will create a transaction requested by the doctors.</p>
		</div>
		
		<div class="pull-right">
			<br/>
			<a class="btn btn-danger" href="transactions.php"><i class="glyphicon glyphicon-remove"></i> Cancel</a>
		</div>
		
		<div class="clearfix"></div>
		
		<hr/>
		
		<?php $systemMessage = Helper::getMessage();?>
		
		<!-- Forms -->
		<form id="form_create" action="php/action.php" method="post">
			<input type="hidden" name="action" value="transactions_doctor_create"/>
			<input type="hidden" name="type" value="<?php echo BPHIMS_TRANSACTION_DOCTOR; ?>"/>
			<div class="col-md-12">
			
				<div class="form-group">
					<label for="doctor_id_selection">Doctor</label>
					<input id="doctor_id_selection" type="text" class="form-control ajax_searcher" action="transaction_doctor_id" target="doctor_id" />
					<div class="ajax_container hidden"></div>
					<div class="ajax_selected_display hidden"></div>
					<input type="hidden" id="doctor_id" class="field_required" name="doctor_id" value="" required />
				</div>
			
				<div class="form-group">
					<label for="requested_by_selection">Requested By</label>
					<input id="requested_by_selection" type="text" class="form-control ajax_searcher" action="transaction_requested_by" target="requested_by" />
					<div class="ajax_container hidden"></div>
					<div class="ajax_selected_display hidden"></div>
					<input type="hidden" id="requested_by" class="field_required" name="requested_by" value="" required />
				</div>
			
				<div class="form-group">
					<label for="patient_id_selection">For Patient</label>
					<input id="patient_id_selection" type="text" class="form-control ajax_searcher" action="transaction_patient_id" target="patient_id" />
					<div class="ajax_container hidden"></div>
					<div class="ajax_selected_display hidden"></div>
					<input type="hidden" id="patient_id" class="field_required" name="patient_id" value="" required />
				</div>
				
				<div class="form-group">
					<label for="requested_by_selection">Remarks</label>
					<textarea name="remarks" class="form-control"></textarea>
				</div>
				
			</div>
			
			<div class="clearfix"></div>

			<!-- START Adding Supplies -->
			<hr/>
			
			<h4>Add Supplies <small>supplies that are requested</small></h4>
			
			<div class="col-md-12 ajax_item_adder">
				<div class="col-md-8">
					<input id="item_supply_id_selection" type="text" class="form-control ajax_searcher" action="transaction_item_supply_id" target="item_supply_id" />
					<div class="ajax_container hidden"></div>
					<div class="ajax_selected_display hidden"></div>
					<textarea class="hidden item_data" id="item_supply_data"></textarea>
				</div>
				<div class="col-md-2">
					<select id="item_supply_quantity" class="form-control select_item_quantity" disabled>
						<option>0</option>
					</select>
				</div>
				<div class="col-md-2">
					<button id="item_supply_add" class="form-control btn btn-default button_item_add" type="button" disabled><i class="glyphicon glyphicon-plus"></i> Add</button>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<br/>
			
			<div class="col-md-12 selected_supply_container">
				<table class="col-md-12">
					<thead>
						<th class="col-md-1">#</th>
						<th class="col-md-8">Details</th>
						<th class="col-md-1">Quantity</th>
						<th class="col-md-2"></th>
					</thead>
					<tbody class="table_body">
						<tr class="clone hidden">
							<td class="counter"></td>
							<td class="details">
								<div class="pull-left details_image">
									<img src="img/default/default_supply.png" class="img-thumbnail" style="width:80px;margin-right:10px"/>
								</div>
								<div class="pull-left">
									<b class="details_name"></b><br/>
									<span class="details_batch_code"><i class="glyphicon glyphicon-tag"></i></span><br/>
									<span class="details_expiry"><i class="glyphicon glyphicon-calendar"></i></span><br/>
									<span class="details_location"><i class="glyphicon glyphicon-inbox"></i></span>
									<div class="hidden">
										<input type="hidden" class="input_delivery_item_id" />
										<input type="hidden" class="input_quantity" />
									</div>
								</div>
								<div class="clearfix"></div>
							</td>
							<td class="quantity"></td>
							<td class="actions">
								<button type="button" class="btn btn-xs btn-danger remove_selected_item">
									<i class="glyphicon glyphicon-remove"></i> Remove
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div class="clearfix"></div>
			<!-- END Adding Supplies -->
			
			<!-- START Adding Equipment -->
			<hr/>
			
			<h4>Add Equipments <small>equipments that are requested</small></h4>
			
			<div class="col-md-12 ajax_item_adder">
				<div class="col-md-8">
					<input id="item_equipment_id_selection" type="text" class="form-control ajax_searcher" action="transaction_item_equipment_id" target="item_equipment_id" />
					<div class="ajax_container hidden"></div>
					<div class="ajax_selected_display hidden"></div>
					<textarea class="hidden item_data" id="item_equipment_data"></textarea>
				</div>
				<div class="col-md-2">
					<select id="item_equipment_quantity" class="form-control select_item_quantity" disabled>
						<option>0</option>
					</select>
				</div>
				<div class="col-md-2">
					<button id="item_equipment_add" class="form-control btn btn-default button_item_add" type="button" disabled><i class="glyphicon glyphicon-plus"></i> Add</button>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<br/>
			
			<div class="col-md-12 selected_equipment_container">
				<table class="col-md-12">
					<thead>
						<th class="col-md-1">#</th>
						<th class="col-md-8">Details</th>
						<th class="col-md-1">Quantity</th>
						<th class="col-md-2"></th>
					</thead>
					<tbody class="table_body">
						<tr class="clone hidden">
							<td class="counter"></td>
							<td class="details">
								<div class="pull-left details_image">
									<img src="img/default/default_equipment.png" class="img-thumbnail" style="width:80px;margin-right:10px"/>
								</div>
								<div class="pull-left">
									<b class="details_name"></b><br/>
									<span class="details_batch_code"><i class="glyphicon glyphicon-tag"></i></span><br/>
									<span class="details_expiry"><i class="glyphicon glyphicon-calendar"></i></span><br/>
									<span class="details_location"><i class="glyphicon glyphicon-inbox"></i></span>
									<div class="hidden">
										<input type="hidden" class="input_delivery_item_id" />
										<input type="hidden" class="input_quantity" />
									</div>
								</div>
								<div class="clearfix"></div>
							</td>
							<td class="quantity"></td>
							<td class="actions">
								<button type="button" class="btn btn-xs btn-danger remove_selected_item">
									<i class="glyphicon glyphicon-remove"></i> Remove
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- END Adding Equipment -->
			
			<div class="clearfix"></div>
			<hr/>
			
			<div class="col-md-12 final_confirmation hidden">
				<b>Once completed, this transaction cannot be edited and can only be deleted. Are you sure you want to complete the transaction?</b>
				<hr/>
				<button id="button_submit_cancel" type="button" class="btn btn-danger pull-right">
					<i class="glyphicon glyphicon-remove"></i> Cancel
				</button>
				<button id="button_submit_proceed" type="button" class="btn btn-success pull-right">
					<i class="glyphicon glyphicon-floppy-disk"></i> Proceed
				</button>
				<br/>
				<div class="clearfix"></div>
			</div>
			
			<div class="clearfix"></div>
			
			<button id="button_submit" type="button" class="btn btn-primary pull-right">
				<i class="glyphicon glyphicon-plus"></i> Create Transaction
			</button>
			
			<div class="clearfix"></div>
			<br />
			
		</form>
		
	</div>
</div>

<script>
	var isDepartmentPage = false;
</script>

<?php
	$listOfJS = array('transactions');
	include("footer.php");
?>