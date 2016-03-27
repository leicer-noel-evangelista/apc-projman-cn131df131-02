<?php
	$listOfCss = array('deliveries');
	$active = "deliveries";
	include("header.php");
	
	$page = (isset($_GET['page']))?$_GET['page']:1;
	$offset = BPHIMS_TABLE_LIMIT*($page-1);
	$deliveryList = BPHIMS::getAllDeliveries(BPHIMS_TABLE_LIMIT,$offset);
	$totalRecords = BPHIMS::getAllDeliveriesCount();
	$totalPages = ceil($totalRecords/BPHIMS_TABLE_LIMIT);
	$previousPage = ($page!=1)?"deliveries.php?page=".($page-1):"";
	$nextPage = ($page!=$totalPages)?"deliveries.php?page=".($page+1):"";
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>Deliveries</h4>
			<p>The page contains all the delivery records. There are currently <b><?php echo $totalRecords; ?></b> deliveries recorded.</p>
		</div>
		
		<div class="checkbox pull-right">
			<label><input type="checkbox" id="additional-option" value="additional-option"> Show Options</label>
		</div>
		
		<div class="clearfix"></div>
		
		<div class="panel panel-default additional-option">
			<div class="panel-body">
				<b>Show/Hide Column</b>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td1"> Delivery ID</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td2"> Supplier</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td3"> PO #</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td4"> PR #</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td5"> DR #</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td6"> SI #</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td7"> Amount</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td8"> Receive Date</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td9"> Receive By</label>
				</div>
			</div>
		</div>
		
		<hr/>
		
		<?php $systemMessage = Helper::getMessage();?>
		
		<div class="common-pagination">
			<a class="btn btn-default" href="<?php echo $previousPage; ?>" role="button"><i class="glyphicon glyphicon-backward"></i></a>
			<select class="form-control pagination-selector">
				<?php
					for($i=1; $i<=$totalPages; $i++) {
						$currentPage = ($i==$page)?'selected="selected"':'';
						echo '<option value="'.$i.'" '.$currentPage.'>'.$i.'</option>';
					}
				?>
			</select>
			<a class="btn btn-default" href="<?php echo $nextPage; ?>" role="button"><i class="glyphicon glyphicon-forward"></i></a>
		</div>
		
		<!-- Table of Records -->
		<table class="table-common table table-bordered">
			<thead>
				<th class="td1">ID</th>
				<th class="td2">Supplier</th>
				<th class="td3">PO #</th>
				<th class="td4">PR #</th>
				<th class="td5">DR #</th>
				<th class="td6">SI #</th>
				<th class="td7">Amount</th>
				<th class="td8">Receive Date</th>
				<th class="td9">Receive By</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
					foreach($deliveryList as $delivery) {
						$dataDeleteName = '#'.Helper::formatID($delivery['delivery_id']);
						echo '
							<tr">
								<td class="td1">'.Helper::formatID($delivery['delivery_id']).'</td>
								<td class="td2">'.$delivery['supplier_name'].'</td>
								<td class="td3">'.$delivery['po_number'].'</td>
								<td class="td4">'.$delivery['pr_number'].'</td>
								<td class="td5">'.$delivery['dr_number'].'</td>
								<td class="td6">'.$delivery['si_number'].'</td>
								<td class="td7">'.number_format($delivery['amount'], 2).'</td>
								<td class="td8">'.Helper::formatDate($delivery['received_date']).'</td>
								<td class="td9">'.$delivery['first_name'].' '.$delivery['last_name'].'</td>
								<td>
									<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-delete" data-delete-name="'.$dataDeleteName.'" data-delete-id="'.$delivery['delivery_id'].'"><i class="glyphicon glyphicon-trash"></i></button>
									<a class="btn btn-xs btn-success" href="deliveries_update.php?delivery_id='.$delivery['delivery_id'].'" data-toggle="tooltip" data-placement="top" title="View / Update"><i class="glyphicon glyphicon-pencil"></i></a>
								</td>
							</tr>
						';
					}
				?>
			</tbody>
		</table>
		
		<div class="common-pagination">
			<a class="btn btn-default" href="<?php echo $previousPage; ?>" role="button"><i class="glyphicon glyphicon-backward"></i></a>
			<select class="form-control pagination-selector">
				<?php
					for($i=1; $i<=$totalPages; $i++) {
						$currentPage = ($i==$page)?'selected="selected"':'';
						echo '<option value="'.$i.'" '.$currentPage.'>'.$i.'</option>';
					}
				?>
			</select>
			<a class="btn btn-default" href="<?php echo $nextPage; ?>" role="button"><i class="glyphicon glyphicon-forward"></i></a>
		</div>
		
	</div>
</div>

<!-- Modal for deleting item -->
<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Delete Delivery Record</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete record <b id="delete-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form action="php/action.php" method="post">
					<input type="hidden" name="action" value="delivery_delete" />
					<input type="hidden" name="delivery_id" id="delete-id" />
					<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
					<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	$listOfJS = array('deliveries');
	include("footer.php");
?>