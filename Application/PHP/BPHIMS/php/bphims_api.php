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
		$batch_code = mysql_real_escape_string($data['batch_code']);
		$expiry = mysql_real_escape_string($data['expiry']);
		$name = mysql_real_escape_string($data['name']);
		$fore = mysql_real_escape_string($data['fore']);
		$dosage = mysql_real_escape_string($data['dosage']);
		$description = mysql_real_escape_string($data['description']);
		$location = mysql_real_escape_string($data['location']);
		$supplier = mysql_real_escape_string($data['supplier']);
		$quantity = mysql_real_escape_string($data['quantity']);
		$unit = mysql_real_escape_string($data['unit']);
		
		
		$sql = '
			INSERT
			INTO
				`items` (`code`, `batch_code`, `expiry`, `name`, `fore`, `dosage`, `dosage_unit`, `description`, `location`, `supplier`, `quantity`, `unit`)
			VALUES
				(
					"'.$code.'",
					"'.$batch_code.'",
					"'.$expiry.'",
					"'.$name.'",
					"'.$fore.'",
					"'.$dosage.'",
					"'.$dosage_unit.'",
					"'.$description.'",
					"'.$location.'",
					"'.$supplier.'",
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
		$batch_code = mysql_real_escape_string($data['batch_code']);
		$expiry = mysql_real_escape_string($data['expiry']);
		$name = mysql_real_escape_string($data['name']);
		$fore = mysql_real_escape_string($data['fore']);
		$dosage = mysql_real_escape_string($data['dosage']);
		$dosage_unit = mysql_real_escape_string($data['dosage_unit']);
		$description = mysql_real_escape_string($data['description']);
		$location = mysql_real_escape_string($data['location']);
		$supplier = mysql_real_escape_string($data['supplier']);
		$quantity = mysql_real_escape_string($data['quantity']);
		$unit = mysql_real_escape_string($data['unit']);
		
		
		$sql = "
			UPDATE
				`items`
			SET
				`code`='".$code."',
				`batch_code`='".$batch_code."',
				`expiry`='".$expiry."',
				`name`='".$name."',
				`fore`='".$fore."',
				`dosage`='".$dosage."',
				`dosage_unit`='".$dosage_unit."',
				`description`='".$description."',
				`location`='".$location."',
				`supplier`='".$supplier."',
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
	public static function addSupplier($data) {
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
	

	/**
		Get Equipment item list
	*/
public static function getEquipmentList() {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "SELECT * FROM `equipments`";
		
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
		Add equipments to the inventory
	*/
	public static function addequipment($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$code = mysql_real_escape_string($data['code']);
		$name = mysql_real_escape_string($data['name']);
		$description = mysql_real_escape_string($data['description']);
		$brand = mysql_real_escape_string($data['brand']);
		$supplier = mysql_real_escape_string($data['supplier']);
		$quantity = mysql_real_escape_string($data['quantity']);
		$unit = mysql_real_escape_string($data['unit']);
		$location = mysql_real_escape_string($data['location']);
		
		
		$sql = '
			INSERT
			INTO
				`equipments` (`code`, `name`, `description`, `brand`, `supplier`, `quantity`, `unit`, `location`)
			VALUES
				(
					"'.$code.'",
					"'.$name.'",
					"'.$description.'",
					"'.$brand.'",
					"'.$supplier.'",
					"'.$quantity.'",
					"'.$unit.'",
					"'.$location.'"
					
				)
		';
		
		// Query Database
		$insert = mysql_query($sql,$db);
		$return = array(
			"status" => ($insert)?SYS_SUCCESS:SYS_ERROR,
			"message" => ($insert)?"Supplies successfully added!":"Failed to insert supplier!",
			"equipment_id" => mysql_insert_id()
		);

		// Close DB
		Helper::closeDB($db);
		
		return $return;
	}
	
	
	/**
		Get item via ID
	*/
	public static function getEquipmentInventoryItem($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "SELECT * FROM `equipments` WHERE `equipment_id`=".$id;
		
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
		Update equipments inventory item
	*/
	public static function updateequipmentInventory($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$equipment_id = mysql_real_escape_string($data['equipment_id']);
		$code = mysql_real_escape_string($data['code']);
		$name = mysql_real_escape_string($data['name']);
		$description = mysql_real_escape_string($data['description']);
		$brand = mysql_real_escape_string($data['brand']);
		$supplier = mysql_real_escape_string($data['supplier']);
		$quantity = mysql_real_escape_string($data['quantity']);
		$unit = mysql_real_escape_string($data['unit']);
		$location = mysql_real_escape_string($data['location']);
		
		$sql = "
			UPDATE
				`equipments`
			SET
				`code`='".$code."',
				`name`='".$name."',
				`description`='".$description."',
				`brand`='".$brand."',
				`supplier`='".$supplier."',
				`quantity`='".$quantity."',
				`unit`='".$unit."',
				`location`='".$location."'
				
			WHERE
				`equipment_id`='".$equipment_id."'
			";
		
		// Query Database
		$update = mysql_query($sql,$db);
		$return = array(
			"status" => ($update)?SYS_SUCCESS:SYS_ERROR,
			"message" => ($update)?"Item successfully updated!":"Failed to update item!",
			"equipment_id" => $equipment_id
		);
		
		// Close DB
		Helper::closeDB($db);
		
		// Retunrn lists
		return $return;
	}
	


}



?>