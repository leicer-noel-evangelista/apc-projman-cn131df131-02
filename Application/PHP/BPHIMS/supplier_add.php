<?php
	include("header.php");
	Helper::checkActivity();
?>
<h3>Supplier Add</h3>

<table>
<form action="php/action.php" method="post">
	<input type="hidden" name="action" value="supplier_add"/>
	<tr>
		<td><span>Code:</span></td>
		<td><input type="text" name="code" required /></td>
	</tr>
	<tr>
		<td><span>Name:</span></td>
		<td><input type="text" name="name" required /></td>
	</tr>
	<tr>
		<td><span>Address:</span></td>
		<td><textarea name="address"></textarea></td>
	</tr>
	<tr>
		<td><span>Contact 1:</span></td>
		<td><input type="text" name="contact1" /></td>
	</tr>
	<tr>
		<td><span>Contact 2:</span></td>
		<td><input type="text" name="contact2" /></td>
	</tr>
	<tr>
		<td><span></span></td>
		<td><input type="submit" value="Add" /></td>
	</tr>
</form>
</table>
<br/>
<a href="supplier.php">Back to supplier List</a>

<?php include("footer.php"); ?>