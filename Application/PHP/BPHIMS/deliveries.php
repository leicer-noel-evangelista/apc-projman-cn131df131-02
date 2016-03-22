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
		
		<?php $systemMessage = Helper::getMessage();?>
		
		
		
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
		
	
	</div>
</div>


			</div>
		</div>
	</div>
</div>

<?php
	$listOfJS = array('deliveries');
	include("footer.php");
?>