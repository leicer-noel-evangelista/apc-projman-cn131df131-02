<!DOCTYPE html>
<?php include("php/init.php"); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="content-language" content="en">
		<meta charset="utf-8">
		<title><?php echo BPHIMS_WEB_TITLE; ?></title>
	</head>
	<h1><?php echo BPHIMS_WEB_TITLE; ?></h1>
	
	<?php
		if($_SESSION['user_id'] != 0) {
	?>
		<ul>
			<li>
				<a href="inventory.php">Inventory</a><br>
				<ul>
					<li><a href="inventory.php">View Inventory</a></li>
					<li><a href="inventory_add.php">Add Item</a></li>
				</ul>
			</li>
			<li><a href="transactions.php">Transactions</a></li>
			<li>
				<a href="supplier.php">Suppliers</a><br>
				<ul>
					<li><a href="supplier.php">View Suppliers</a></li>
					<li><a href="supplier_add.php">Add Suppliers</a></li>
				</ul>
			</li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	<?php
		}
	?>
	
	<hr/>
	<body>