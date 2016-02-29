<?php

class BPHIMS {
	
	/**
		Login function
	*/
	public static function login($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$username = mysql_real_escape_string($data['username']);
		$password = mysql_real_escape_string($data['password']);
		$sql = "SELECT * FROM `users` WHERE `username`='".$username."' AND `password`='".$password."'";
		
		// Query Database
		$authenticate = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getRowFromResultQuery($authenticate);
		
		// If succes, store to session
		if($result['user_id'] != 0){
			Helper::setSession('user_id',$result['user_id']);
			Helper::setSession('first_name',$result['first_name']);
			Helper::setSession('last_name',$result['last_name']);
			Helper::setSession('type',$result['type']);
			$status = SYS_SUCCESS;
		}else{
			$status = SYS_ERROR;
		}
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $status;	
	}
	
	/**
		Get item list
	*/
	public static function getInventoryList() {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "SELECT * FROM `items`";
		
		// Query Database
		$getList = mysql_query($sql,$db);
		
		// Fetch Details
		$lists = Helper::getListFromResultQuery($getList);
		
		// Close DB
		Helper::closeDB($db);
		
		// Retunrn lists
		return $lists;
	}
	
	/**
		Add item to the inventory
	*/
	public static function addsupplies($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$code = mysql_real_escape_string($data['code']);
		$name = mysql_real_escape_string($data['name']);
		$description = mysql_real_escape_string($data['description']);
		$quantity = mysql_real_escape_string($data['quantity']);
		$unit = mysql_real_escape_string($data['unit']);
		
		$sql = '
			INSERT
			INTO
				`items` (`code`, `name`, `description`, `quantity`, `unit`)
			VALUES
				(
					"'.$code.'",
					"'.$name.'",
					"'.$description.'",
					"'.$quantity.'",
					"'.$unit.'"
				)
		';
		
		// Query Database
		$insert = mysql_query($sql,$db);
		$return = array(
			"status" => ($insert)?SYS_SUCCESS:SYS_ERROR,
			"message" => ($insert)?"Supplies successfully added!":"Failed to insert supplier!",
			"item_id" => mysql_insert_id()
		);

		// Close DB
		Helper::closeDB($db);
		
		return $return;
	}
	
	
	/**
		Get item via ID
	*/
	public static function getInventoryItem($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "SELECT * FROM `items` WHERE `item_id`=".$id;
		
		// Query Database
		$query = mysql_query($sql,$db);
		
		if($query) {
			// Fetch Details
			$result = Helper::getRowFromResultQuery($query);
		} else {
			$result = $query;
		}
		
		// Close DB
		Helper::closeDB($db);
		
		// Retunrn lists
		return $result;
	}
	
	/**
		Update inventory item
	*/
	public static function updateItemInventory($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$item_id = mysql_real_escape_string($data['item_id']);
		$code = mysql_real_escape_string($data['code']);
		$name = mysql_real_escape_string($data['name']);
		$description = mysql_real_escape_string($data['description']);
		$quantity = mysql_real_escape_string($data['quantity']);
		$unit = mysql_real_escape_string($data['unit']);
		
		$sql = "
			UPDATE
				`items`
			SET
				`code`='".$code."',
				`name`='".$name."',
				`description`='".$description."',
				`quantity`='".$quantity."',
				`unit`='".$unit."'
			WHERE
				`item_id`='".$item_id."'
			";
		
		// Query Database
		$update = mysql_query($sql,$db);
		$return = array(
			"status" => ($update)?SYS_SUCCESS:SYS_ERROR,
			"message" => ($update)?"Item successfully updated!":"Failed to update item!",
			"item_id" => $item_id
		);
		
		// Close DB
		Helper::closeDB($db);
		
		// Retunrn lists
		return $return;
	}
	
	/**
		Get supplier list
	*/
	public static function getSupplierList() {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "SELECT * FROM `suppliers`";
		
		// Query Database
		$getList = mysql_query($sql,$db);
		
		// Fetch Details
		$lists = Helper::getListFromResultQuery($getList);
		
		// Close DB
		Helper::closeDB($db);
		
		// Retunrn lists
		return $lists;
	}
	
	
	/**
		Add Supplier
	*/
	public static function adddSupplier($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$code = mysql_real_escape_string($data['code']);
		$name = mysql_real_escape_string($data['name']);
		$address = mysql_real_escape_string($data['address']);
		$contact1 = mysql_real_escape_string($data['contact1']);
		$contact2 = mysql_real_escape_string($data['contact2']);
		
		$sql = '
			INSERT
			INTO
				`suppliers` (`code`, `name`, `address`, `contact1`, `contact2`)
			VALUES
				(
					"'.$code.'",
					"'.$name.'",
					"'.$address.'",
					"'.$contact1.'",
					"'.$contact2.'"
				)
		';
		
		// Query Database
		$insert = mysql_query($sql,$db);
		$return = array(
			"status" => ($insert)?SYS_SUCCESS:SYS_ERROR,
			"message" => ($insert)?"Supplier successfully added!":"Failed to insert supplier!",
			"supplier_id" => mysql_insert_id()
		);

		// Close DB
		Helper::closeDB($db);
		
		return $return;
	}
	
	/**
		Get supplier via ID
	*/
	public static function getSupplier($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "SELECT * FROM `suppliers` WHERE `supplier_id`=".$id;
		
		// Query Database
		$query = mysql_query($sql,$db);
		
		if($query) {
			// Fetch Details
			$result = Helper::getRowFromResultQuery($query);
		} else {
			$result = $query;
		}
		
		// Close DB
		Helper::closeDB($db);
		
		// Retunrn lists
		return $result;
	}
	
	
	
	/**
		Update supplier
	*/
	public static function updateSupplier($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$supplier_id = mysql_real_escape_string($data['supplier_id']);
		$code = mysql_real_escape_string($data['code']);
		$name = mysql_real_escape_string($data['name']);
		$address = mysql_real_escape_string($data['address']);
		$contact1 = mysql_real_escape_string($data['contact1']);
		$contact2 = mysql_real_escape_string($data['contact2']);
		
		$sql = "
			UPDATE
				`suppliers`
			SET
				`code`='".$code."',
				`name`='".$name."',
				`address`='".$address."',
				`contact1`='".$contact1."',
				`contact2`='".$contact2."'
			WHERE
				`supplier_id`='".$supplier_id."'
			";
		
		// Query Database
		$update = mysql_query($sql,$db);
		$return = array(
			"status" => ($update)?SYS_SUCCESS:SYS_ERROR,
			"message" => ($update)?"Supplier successfully updated!":"Failed to update supplier!",
			"supplier_id" => $supplier_id
		);
		
		// Close DB
		Helper::closeDB($db);
		
		// Retunrn lists
		return $return;
	}
	
}

?>