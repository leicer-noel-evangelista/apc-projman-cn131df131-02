<?php
	$listOfCss = array('deliveries');
	$active = "inventories";
	include("header.php");
	
	$page = (isset($_GET['page']))?$_GET['page']:1;
	$offset = BPHIMS_TABLE_LIMIT*($page-1);
	$equipmentList = BPHIMS::getAllItemViaCategory(BPHIMS_CATEGORY_EQUIPMENT, BPHIMS_TABLE_LIMIT, $offset);
	$totalRecords = BPHIMS::getAllItemViaCategoryCount(BPHIMS_CATEGORY_EQUIPMENT);
	$totalPages = ceil($totalRecords/BPHIMS_TABLE_LIMIT);
	$previousPage = ($page!=1)?"inventories_supply.php?page=".($page-1):"";
	$nextPage = ($page!=$totalPages)?"inventories_supply.php?page=".($page+1):"";
?>

		
		<!-- Table of Records -->
		<table class="table-common table table-bordered">
			<thead>
				<th class="td1">ID</th>
				<th class="td2">Name</th>
				<th class="td3">Code</th>
				<th class="td4">Critical Level</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php
					foreach($equipmentList as $equipment) {
						$dataDeleteName = '#'.Helper::formatID($equipment['item_id']);
						echo '
							<tr">
								<td class="td1">'.Helper::formatID($equipment['item_id']).'</td>
								<td class="td2">'.$equipment['name'].'</td>
								<td class="td3">'.$equipment['code'].'</td>
								<td class="td4">'.$equipment['critical_level'].'</td>
								<td>
									<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-delete" data-delete-name="'.$dataDeleteName.'" data-delete-id="'.$equipment['item_id'].'"><i class="glyphicon glyphicon-trash"></i></button>
									<a class="btn btn-xs btn-success" href="inventories_update.php?item_id='.$equipment['item_id'].'" data-toggle="tooltip" data-placement="top" title="View / Update"><i class="glyphicon glyphicon-pencil"></i></a>
								</td>
							</tr>
						';
					}
				?>
			</tbody>
		</table>
		
		
		
	</div>
</div>
<?php
	$listOfJS = array('inventories_supply');
	include("footer.php");
?>