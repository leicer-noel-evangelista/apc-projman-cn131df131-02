<?php
	include("header.php");
	Helper::checkActivity();
	
	// Page variables
	$item = BPHIMS::getEquipmentInventoryItem($_GET['equipment_id']);
	if($item == FALSE) {
		Helper::createMessage(SYS_ERROR,"Invalid Item ID! Cannot find item with ID = ".$_GET['equipment_id']);
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
	<input type="hidden" name="action" value="inventory_equipment_update"/>
	<input type="hidden" name="equipment_id" value="<?php echo $item['equipment_id']; ?>"/>
	<tr>
		<td ><span>Code:</span></td>
		<td><input type="text" name="code" value="<?php echo $item['code']; ?>" required /></td>
	</tr>
	<tr>
		<td ><span>Equipment:</span></td>
		<td><input type="text" name="name" value="<?php echo $item['name']; ?>" required /></td>
	</tr>

<tr>
		<td ><span>Brand:</span></td>
		<td><input type="text" name="brand" value="<?php echo $item['brand']; ?>" required /></td>
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
				<option value="<?php echo $location; ?>"  <?php echo ($location==$item['location'])?"selected":""; ?>><?php echo $location; ?></option>
			<?php
				}
			?>
			</select>
		</td>
	</tr>

	<tr>
		<td ><span>Supplier:</span></td>
		<td><input type="text" name="supplier" value="<?php echo $item['supplier']; ?>" required /></td>
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