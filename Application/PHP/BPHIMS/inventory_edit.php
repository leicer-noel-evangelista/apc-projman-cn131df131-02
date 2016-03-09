<?php
	include("header.php");
	Helper::checkActivity();
	
	// Page variables
	$item = BPHIMS::getInventoryItem($_GET['item_id']);
	$supplierList = BPHIMS::getSupplierList();
	if($item == FALSE) {
		Helper::createMessage(SYS_ERROR,"Invalid Item ID! Cannot find item with ID = ".$_GET['item_id']);
	}
?>
<h3>Inventory Edit</h3>

<div>
<?php
	$systemMessage = Helper::getMessage();
	if($systemMessage != null){
		echo $systemMessage['body']; 
	}
?>
</div>


<?php
	if($item != FALSE) {
?>
<table>
<form action="php/action.php" method="post">
	<input type="hidden" name="action" value="inventory_update"/>
	<input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>"/>
	<tr>
		<td ><span>Code:</span></td>
		<td><input type="text" name="code" value="<?php echo $item['code']; ?>" required /></td>
	</tr>

<tr>
		<td ><span>Batch Code:</span></td>
		<td><input type="text" name="batch_code" value="<?php echo $item['batch_code']; ?>" required /></td>
	</tr>
	<tr>


		<tr>
		<td ><span>Expiry:</span></td>
		<td><input type="date" name="expiry" value="<?php echo $item['expiry']; ?>" required /></td>
	</tr>
	<tr>


	<tr>
		<td ><span>Name:</span></td>
		<td><input type="text" name="name" value="<?php echo $item['name']; ?>" required /></td>
	</tr>

<tr>
		<td ><span>For:</span></td>
		<td>
			<select name="fore" >
			<?php
				foreach(Helper::toArray(DB_ITEMS_FOR) as $fore) {
			?>
				<option>
				<option value="<?php echo $fore; ?>" <?php echo ($fore==$item['fore'])?"selected":""; ?>><?php echo $fore; ?></option>
			<?php
				}
			?>
			</select>
		</td>
	</tr>

<tr>
		<td ><span>Dosage:</span></td>
		<td><input type="number" name="dosage" value="<?php echo $item['dosage']; ?>" /></td>
	
<td>
			<select name="dosage_unit" >
			<?php
				foreach(Helper::toArray(DB_ITEMS_DOSAGE_UNIT) as $dosage_unit) {
			?>
				<option value="<?php echo $dosage_unit; ?>"  <?php echo ($dosage_unit==$item['dosage_unit'])?"selected":""; ?>><?php echo $dosage_unit; ?></option>
			<?php
				}
			?>
			</select>
		</td>

	</tr>

	<tr>
		<td ><span>Description:</span></td>
		<td><textarea name="description"><?php echo $item['description']; ?></textarea></td>
	</tr>

<tr>
		<td ><span>Supplies Location:</span></td>
		<td>
			<select name="location" required>
			<?php
				foreach(Helper::toArray(DB_ITEMS_LOCATION) as $location) {
			?>
				<option value="<?php echo $location; ?>" <?php echo ($location==$item['location'])?"selected":""; ?>><?php echo $location; ?></option>
			<?php
				}
			?>
			</select>
		</td>
	</tr>

	tr>
		<td><span>Supplier:</span></td>
		<td>
			<select name="supplier_id" required>
			<?php
				foreach($supplierList as $supplier) {
			?>
				<option value="<?php echo $supplier['supplier_id']; ?>"><?php echo $supplier['name']; ?></option>
			<?php
				}
			?>
			</select>
		</td>
	</tr>

	<tr>
		<td ><span>Quantity:</span></td>
		<td><input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" required /></td>
	</tr>
	<tr>
		<td ><span>Unit:</span></td>
		<td>
			<select name="unit" required>
			<?php
				foreach(Helper::toArray(DB_ITEMS_UNIT) as $unit) {
			?>
				<option value="<?php echo $unit; ?>" <?php echo ($unit==$item['unit'])?"selected":""; ?>><?php echo $unit; ?></option>
			<?php
				}
			?>
			</select>
		</td>
	</tr>



	<tr>
		<td><span></span></td>
		<td><input type="submit" value="Update" /></td>
	</tr>
</form>
</table>
<?php
	}
?>
<br/>
<a href="inventory.php">Back to Inventory List</a>

<?php include("footer.php"); ?>