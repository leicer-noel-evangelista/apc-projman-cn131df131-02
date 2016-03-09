<?php
	include("header.php");
	Helper::checkActivity();
?>
<h3>Inventory Add</h3>

<table>
<form action="php/action.php" method="post">
	<input type="hidden" name="action" value="inventory_add"/>
	<tr>
		<td><span>Code:</span></td>
		<td><input type="text" name="code" required /></td>
	</tr>

<tr>
		<td><span>Batch Code:</span></td>
		<td><input type="text" name="batch_code" required /></td>
	</tr>

	<tr>
		<td><span>Expiry:</span></td>
		<td><input type="date" name="expiry" required /></td>
	</tr>

	<tr>
		<td><span>Name:</span></td>
		<td><input type="text" name="name" required /></td>
	</tr>

<tr>
		<td ><span>For:</span></td>
		<td>
			<select name="fore" >
			<?php
				foreach(Helper::toArray(DB_ITEMS_FOR) as $fore) {
			?>
				<option value= ""></option>
				<option value="<?php echo $fore; ?>"><?php echo $fore; ?></option>
			<?php
				}
			?>
			</select>
		</td>
	</tr>
<tr>
		<td><span>Dosage:</span></td>
		<td><input type="number" name="dosage" /></td>

<td>
			<select name="dosage_unit" >
			<?php
				foreach(Helper::toArray(DB_ITEMS_DOSAGE_UNIT) as $dosage_unit) {
			?>
				<option value= ""></option>
				<option value="<?php echo $dosage_unit; ?>"><?php echo $dosage_unit; ?></option>
			<?php
				}
			?>
			</select>
		</td>
	
</tr>

	<tr>
		<td><span>Description:</span></td>
		<td><textarea name="description"></textarea></td>
	</tr>

<tr>
		<td><span>Supplies Location:</span></td>
		<td>
			<select name="location" required>
			<?php
				foreach(Helper::toArray(DB_ITEMS_LOCATION) as $location) {
			?>
	
				<option value="<?php echo $location; ?>"><?php echo $location; ?></option>
			<?php
				}
			?>
			</select>
		</td>
	</tr>

	<tr>
		<td><span>Supplier:</span></td>
		<td><input type="text" name="supplier" required /></td>
	</tr>
	<tr>
		<td><span>Quantity:</span></td>
		<td><input type="number" name="quantity" required /></td>
	</tr>
	<tr>
		<td><span>Unit:</span></td>
		<td>
			<select name="unit" required>
			<?php
				foreach(Helper::toArray(DB_ITEMS_UNIT) as $unit) {
			?>
				<option value="<?php echo $unit; ?>"><?php echo $unit; ?></option>
			<?php
				}
			?>
			</select>
		</td>
	</tr>



	<tr>
		<td><span></span></td>
		<td><input type="submit" value="Add" /></td>
	</tr>
</form>
</table>
<br/>
<a href="inventory.php">Back to Inventory List</a>

<?php include("footer.php"); ?>