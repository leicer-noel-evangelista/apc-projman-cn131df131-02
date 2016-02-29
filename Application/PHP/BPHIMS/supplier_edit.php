<?php
	include("header.php");
	Helper::checkActivity();
	
	// Page variables
	$supplier = BPHIMS::getSupplier($_GET['supplier_id']);
	if($supplier == FALSE) {
		Helper::createMessage(SYS_ERROR,"Invalid Supplier ID! Cannot find supplier with ID = ".$_GET['supplier_id']);
	}
?>
<h3>Supplier Edit</h3>

<div>
<?php
	$systemMessage = Helper::getMessage();
	if($systemMessage != null){
		echo $systemMessage['body']; 
	}
?>
</div>


<?php
	if($supplier != FALSE) {
?>
<table>
<form action="php/action.php" method="post">
	<input type="hidden" name="action" value="supplier_update"/>
	<input type="hidden" name="supplier_id" value="<?php echo $supplier['supplier_id']; ?>"/>
	<tr>
		<td ><span>Code:</span></td>
		<td><input type="text" name="code" value="<?php echo $supplier['code']; ?>" required /></td>
	</tr>
	<tr>
		<td ><span>Name:</span></td>
		<td><input type="text" name="name" value="<?php echo $supplier['name']; ?>" required /></td>
	</tr>
	<tr>
		<td ><span>Address:</span></td>
		<td><textarea name="address"><?php echo $supplier['address']; ?></textarea></td>
	</tr>
	<tr>
		<td ><span>Contact 1:</span></td>
		<td><input type="text" name="contact1" value="<?php echo $supplier['contact1']; ?>"  /></td>
	</tr>
	<tr>
		<td ><span>Contact 2:</span></td>
		<td><input type="text" name="contact2" value="<?php echo $supplier['contact2']; ?>" /></td>
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
<a href="supplier.php">Back to Supplier List</a>

<?php include("footer.php"); ?>