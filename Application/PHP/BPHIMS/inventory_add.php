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
		<td><span>Name:</span></td>
		<td><input type="text" name="name" required /></td>
	</tr>
	<tr>
		<td><span>Description:</span></td>
		<td><textarea name="description"></textarea></td>
	</tr>
	<tr>
		<td><span>Quantity:</span></td>
		<td><input type="text" name="quantity" required /></td>
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