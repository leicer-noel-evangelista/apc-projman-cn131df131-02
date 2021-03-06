<?php
	include("header.php");
	Helper::checkActivity();
	
	// Page variables
	$invetoryList = BPHIMS::getInventoryList();
	$equipmentList = BPHIMS::getEquipmentList();
?>
<h3>Supplies Inventory List</h3>

<table border="1">
	<thead>
		<tr>
			<th>Item Code</th>
			<th>Batch Code</th>
			<th>Expiry</th>
			<th>Item Name</th>
			<th>For</th>
			<th>Dosage</th>
			<th>Description</th>
			<th>Supplies Location</th>
			<th>Supplier Name</th>
			<th>Quantity</th>
			<th>Unit</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($invetoryList as $item) {
			//print_r($item);die();
		?>
		<tr>
			<td><?php echo $item['code']; ?></td>
			<td><?php echo $item['batch_code']; ?></td>
			<td><?php echo $item['expiry']; ?></td>
			<td><?php echo $item['name']; ?></td>
			<td><?php echo $item['fore']; ?></td>
			<td><?php echo $item['dosage']." ".$item['dosage_unit']; ?></td>
			<td><?php echo $item['description']; ?></td>
			<td><?php echo $item['location']; ?></td>
			<td><?php echo $item['supplier']; ?></td>
			<td><?php echo $item['quantity']; ?></td>
			<td><?php echo $item['unit']; ?></td>

			<td>
				<a href="inventory_edit.php?item_id=<?php echo $item['item_id']; ?>">Edit</a>
				<a href="item_view.php">View</a>
				<a href="Dispense.php">Dispense</a>
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
<table>


<h3>Equipments Inventory List</h3>

<table border="1">
	<thead>
		<tr>
			<th>Item Code</th>
			<th>Item Name</th>
			<th>Description</th>
			<th>Brand</th>
			<th>Supplier Name</th>
			<th>Quantity</th>
			<th>Unit</th>
			<th>Supplies Location</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($equipmentList as $equipment) {
			//print_r($item);die();
		?>
		<tr>
			<td><?php echo $equipment['code']; ?></td>
			<td><?php echo $equipment['name']; ?></td>
			<td><?php echo $equipment['description']; ?></td>
			<td><?php echo $equipment['brand']; ?></td>
			<td><?php echo $equipment['supplier']; ?></td>
			<td><?php echo $equipment['quantity']; ?></td>
			<td><?php echo $equipment['unit']; ?></td>
			<td><?php echo $equipment['location']; ?></td>

			<td>
				<a href="inventory_edit_equipments.php?equipment_id=<?php echo $equipment['equipment_id']; ?>">Edit</a>
				<a href="item_view.php">View</a>
				<a href="dispense.php">Dispense</a>
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
<table>

<?php include("footer.php"); ?>