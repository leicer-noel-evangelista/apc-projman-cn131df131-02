<?php
	$listOfCss = array('transactions');
	$active = "transactions";
	include("header.php");
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>Create Department Request</h4>
			<p>This page will create a transaction requested by the department.</p>
		</div>
		
		<div class="pull-right">
			<br/>
			<a class="btn btn-danger" href="transactions.php"><i class="glyphicon glyphicon-remove"></i> Cancel</a>
		</div>
		
		<div class="clearfix"></div>
		
		<hr/>
		
		<?php $systemMessage = Helper::getMessage();?>
		
		<!-- Forms -->
		<form action="php/action.php" method="post">
			<input type="hidden" name="action" value="transactions_department_create"/>
			<input type="hidden" name="	type" value="<?php echo BPHIMS_TRANSACTION_DEPARTMENT; ?>"/>
			<div class="col-md-12">
			
				<div class="form-group">
					<label for="requested_by_selection">Requested By</label>
					<input id="requested_by_selection" type="text" class="form-control ajax_searcher" action="transaction_requested_by" target="requested_by" />
					<div class="ajax_container hidden"></div>
					<div class="ajax_selected_display hidden"></div>
					<input type="hidden" id="requested_by" name="requested_by" value="" required />
				</div>
				
				<div class="form-group">
					<label for="department_id_selection">Department</label>
					<input id="department_id_selection" type="text" class="form-control ajax_searcher" action="transaction_department_id" target="department_id" />
					<div class="ajax_container hidden"></div>
					<div class="ajax_selected_display hidden"></div>
					<input type="hidden" id="department_id" name="department_id" value="" required />
				</div>
				
				<div class="form-group">
					<label for="department_head_id_selection">Department Head <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top" title="Department field must be filled first!"></i></label>
					<input id="department_head_id_selection" type="text" class="form-control ajax_searcher" disabled="disabled" action="transaction_department_head_id" target="department_head_id" />
					<div class="ajax_container hidden"></div>
					<div class="ajax_selected_display hidden"></div>
					<input type="hidden" id="department_head_id" name="department_head_id" value="" required />
				</div>
				
			</div>
			
			<div class="clearfix"></div>

			<hr/>
			
			<h4>Add Supplies <small>supplies that are requested</small></h4>
			
			<div class="col-md-12 ajax_item_adder">
				<div class="col-md-8">
					<input id="item_supply_id_selection" type="text" class="form-control ajax_searcher" action="transaction_item_supply_id" target="item_supply_id" />
					<div class="ajax_container hidden"></div>
					<div class="ajax_selected_display hidden"></div>
					<input type="hidden" id="item_supply_id" name="item_supply_id" value="" />
					<textarea class="hidden" id="item_supply_data"></textarea>
				</div>
				<div class="col-md-2">
					<select id="item_supply_quantity" class="form-control" disabled>
						<option>0</option>
					</select>
				</div>
				<div class="col-md-2">
					<button id="item_supply_add" class="form-control btn btn-default" type="button" disabled><i class="glyphicon glyphicon-plus"></i> Add</button>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<br/>
			
			<div class="col-md-12 selected_supply_container">
				<table>
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
										<input type="hidden" name="delivery_item_id[]" />
										<input type="hidden" name="quantity[]" />
									</div>
								</div>
								<div class="clearfix"></div>
							</td>
							<td class="quantity"></td>
							<td class="actions"></td>
						</tr>
					</tbody>
				</table>
			</div>
			
		</form>
		
	</div>
</div>

<?php
	$listOfJS = array('transactions');
	include("footer.php");
?>