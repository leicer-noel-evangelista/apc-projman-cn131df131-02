<?php
	include("header.php");
	Helper::checkActivity();
	
	// Page variables
	$invetoryList = BPHIMS::getInventoryList();
?>
<h3>Inventory List</h3>

<table border="1">
	<thead>
		<tr>
			<th>Item Code</th>
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
			<td><?php echo $item['name']; ?></td>
			<td><?php echo $item['fore']; ?></td>
			<td><?php echo $item['dosage']; ?></td>
			<td><?php echo $item['description']; ?></td>
			<td><?php echo $item['location']; ?></td>
			<td><?php echo $item['supplier']; ?></td>
			<td><?php echo $item['quantity']; ?></td>
			<td><?php echo $item['unit']; ?></td>

			<td>
				<a href="inventory_edit.php?item_id=<?php echo $item['item_id']; ?>">Edit</a>
				<a href="item_view.php">View</a>
				<a href="forward.php">Forward</a>
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
<table>

<?php include("footer.php"); ?>