<?php
	$listOfCss = array('deliveries');
	$active = "transactions";
	include("header.php");
	
	$page = (isset($_GET['page']))?$_GET['page']:1;
	$offset = BPHIMS_TABLE_LIMIT*($page-1);
	$transactionList = BPHIMS::getAllTransactions(BPHIMS_TABLE_LIMIT,$offset);
	$totalRecords = BPHIMS::getAllTransactionsCount();
	$totalPages = ceil($totalRecords/BPHIMS_TABLE_LIMIT);
	$previousPage = ($page!=1)?"deliveries.php?page=".($page-1):"";
	$nextPage = ($page!=$totalPages)?"deliveries.php?page=".($page+1):"";
?>
<div class="common-body">
	<div class="col-md-12">
	
		<div class="pull-left">
			<h4>Transactions</h4>
			<p>The page contains all the transaction records. There are currently <b><?php echo $totalRecords; ?></b> transactions recorded.</p>
		</div>
		
		<div class="checkbox pull-right">
			<label><input type="checkbox" id="additional-option" value="additional-option"> Show Options</label>
		</div>
		
		<div class="clearfix"></div>
		
		<div class="panel panel-default additional-option">
			<div class="panel-body">
				<b>Show/Hide Column</b>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td1"> Transaction ID</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td2"> Type</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td3"> Requested By</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td4"> Requested Date</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td5"> Supply</label>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" checked="checked" class="show-hide-option" value="td6"> Equipment</label>
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
				<th class="td2">Type</th>
				<th class="td3">Requested By</th>
				<th class="td4">Requested Date</th>
				<th class="td5">Supply</th>
				<th class="td6">Equipment</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
					foreach($transactionList as $transaction) {
						$dataDeleteName = '#'.Helper::formatID($transaction['transaction_id']);
						echo '
							<tr">
								<td class="td1">'.Helper::formatID($transaction['transaction_id']).'</td>
								<td class="td2">'.$transaction['type'].'</td>
								<td class="td3">'.$transaction['last_name'].', '.$transaction['first_name'].'</td>
								<td class="td4">'.Helper::formatDate($transaction['requested_date']).'</td>
								<td class="td5">'.$transaction['supply_count'].'</td>
								<td class="td6">'.$transaction['equipment_count'].'</td>
								<td>
									<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-delete" data-delete-name="'.$dataDeleteName.'" data-delete-id="'.$transaction['transaction_id'].'"><i class="glyphicon glyphicon-trash"></i></button>
									<a class="btn btn-xs btn-success" href="deliveries_update.php?transaction_id='.$transaction['transaction_id'].'" data-toggle="tooltip" data-placement="top" title="View / Update"><i class="glyphicon glyphicon-pencil"></i></a>
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
	$listOfJS = array('transactions');
	include("footer.php");
?>