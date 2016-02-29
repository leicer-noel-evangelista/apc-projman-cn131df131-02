<?php
	include("header.php");
	Helper::checkActivity();
	
	// Page variables
	$supplierList = BPHIMS::getSupplierList();
?>
<h3>Supplier List</h3>

<table border="1">
	<thead>
		<tr>
			<th>Supplier Code</th>
			<th>Supplier Name</th>
			<th>Address</th>
			<th>Contact 1</th>
			<th>Contact 2</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($supplierList as $supplier) {
		?>
		<tr>
			<td><?php echo $supplier['code']; ?></td>
			<td><?php echo $supplier['name']; ?></td>
			<td><?php echo $supplier['address']; ?></td>
			<td><?php echo Helper::replaceEmpty($supplier['contact1']); ?></td>
			<td><?php echo Helper::replaceEmpty($supplier['contact2']); ?></td>
			<td>
				<a href="supplier_edit.php?supplier_id=<?php echo $supplier['supplier_id']; ?>">Edit</a>
				<a href="item_view.php">View</a>
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
<table>

<?php include("footer.php"); ?>