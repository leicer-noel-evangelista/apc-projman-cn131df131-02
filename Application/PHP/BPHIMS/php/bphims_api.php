<?php

/**
	This class will contain all functions of the system
*/
class BPHIMS {
	
	############################################################
	#                                                          #
	#	Delivery                                               #
	#                                                          #
	############################################################
	
	/**
		This method creates a delivery record and returns the ID
		of the created record. Returns 0 on error.
	*/
	public static function createDelivery($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$supplier_id = mysql_real_escape_string($data['supplier_id']);
		$received_by = mysql_real_escape_string($data['received_by']);
		$po_number = mysql_real_escape_string($data['po_number']);
		$pr_number = mysql_real_escape_string($data['pr_number']);
		$dr_number = mysql_real_escape_string($data['dr_number']);
		$si_number = mysql_real_escape_string($data['si_number']);
		$amount = mysql_real_escape_string($data['amount']);
		$is_consignment = mysql_real_escape_string($data['is_consignment']);
		$remarks = mysql_real_escape_string($data['remarks']);
		$received_date = Helper::formatDBDate(mysql_real_escape_string($data['received_date']));
		
		$sql = '
			INSERT
			INTO
				`delivery` (`supplier_id`, `received_by`, `po_number`, `pr_number`, `dr_number`, `si_number`, `amount`, `is_consignment`, `remarks`, `received_date`)
			VALUES
				(
					"'.$supplier_id.'",
					"'.$received_by.'",
					"'.$po_number.'",
					"'.$pr_number.'",
					"'.$dr_number.'",
					"'.$si_number.'",
					"'.$amount.'",
					"'.$is_consignment.'",
					"'.$remarks.'",
					"'.$received_date.'"
				)
		';
		
		// Query Database
		$insert = mysql_query($sql,$db);
		$id = 0;
		if($insert) {
			Helper::createMessage(SYS_SUCCESS,"Successfully added a delivery record!");
			$id = mysql_insert_id();
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to add delivery record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return $id;
	}
	
	/**
		This method updates a delivery record and returns the ID
		of the updated record.
	*/
	public static function updateDelivery($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$delivery_id = mysql_real_escape_string($data['delivery_id']);
		$supplier_id = mysql_real_escape_string($data['supplier_id']);
		$received_by = mysql_real_escape_string($data['received_by']);
		$po_number = mysql_real_escape_string($data['po_number']);
		$pr_number = mysql_real_escape_string($data['pr_number']);
		$dr_number = mysql_real_escape_string($data['dr_number']);
		$si_number = mysql_real_escape_string($data['si_number']);
		$amount = mysql_real_escape_string($data['amount']);
		$is_consignment = mysql_real_escape_string($data['is_consignment']);
		$remarks = mysql_real_escape_string($data['remarks']);
		$received_date = Helper::formatDBDate(mysql_real_escape_string($data['received_date']));
		
		$sql = '
			UPDATE
				`delivery`
			SET
				`supplier_id`="'.$supplier_id.'",
				`received_by`="'.$received_by.'",
				`po_number`="'.$po_number.'",
				`pr_number`="'.$pr_number.'",
				`dr_number`="'.$dr_number.'",
				`si_number`="'.$si_number.'",
				`amount`="'.$amount.'",
				`is_consignment`="'.$is_consignment.'",
				`remarks`="'.$remarks.'",
				`received_date`="'.$received_date.'"
			WHERE
				`delivery_id`='.$delivery_id.'
		';
		
		// Query Database
		$update = mysql_query($sql,$db);
		
		if($update) {
			Helper::createMessage(SYS_SUCCESS,"Successfully updated a delivery record!");
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to update delivery record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return $delivery_id;
	}
	
	/**
		This method deletes a delivery record.
		It will set the is_deleted field to 1.
	*/
	public static function deleteDelivery($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$delivery_id = mysql_real_escape_string($data['delivery_id']);
		
		$sql = '
			UPDATE
				`delivery`
			SET
				`is_deleted`=1
			WHERE
				`delivery_id`='.$delivery_id.'
		';
		
		// Query Database
		$update = mysql_query($sql,$db);
		if($update) {
			Helper::createMessage(SYS_SUCCESS,"Delivery record #".Helper::formatID($delivery_id)." is successfully deleted!");
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to delete a delivery record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return null;
	}
	
	/**
		This method returns the information of a delivery record via ID
	*/
	public static function getDeliveryInformation($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				d.*
			FROM
				`delivery` d
			WHERE
				d.delivery_id=".$id."
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getRowFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;	
	}
	
	/**
		This method returns a list of supply for a delivery record
	*/
	public static function getDeliverySupply($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				ds.*,
				i.name AS item_name,
				u.unit,
				d.unit AS dosage_unit
			FROM
				`delivery_supply` ds
			LEFT JOIN `item` i ON i.item_id=ds.item_id
			LEFT JOIN `unit` u ON u.unit_id=ds.unit_id
			LEFT JOIN `unit` d ON d.unit_id=ds.dosage_unit_id
			WHERE
				ds.delivery_id=".$id." AND
				ds.is_deleted=0
			";

		//print_r($sql);die();
		// Query Database
		$query = mysql_query($sql,$db);
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;	
	}
	
	/**
		This method returns a list of equipment for a delivery record
	*/
	public static function getDeliveryEquipment($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				de.*,
				i.name AS item_name
			FROM
				`delivery_equipment` de
			LEFT JOIN `item` i ON i.item_id=de.item_id
			WHERE
				de.delivery_id=".$id." AND
				de.is_deleted=0
			";
			
		//print_r($sql);die();
		// Query Database
		$query = mysql_query($sql,$db);
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;	
	}
	
	/**
		This method returns all records in delivery table
	*/
	public static function getAllDeliveries($limit, $offset) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				d.delivery_id, d.po_number, d.pr_number, d.dr_number, d.si_number, d.amount, d.received_date,
				s.name AS supplier_name,
				e.first_name, e.last_name
			FROM
				`delivery` d
			LEFT JOIN `supplier` s ON s.supplier_id=d.supplier_id
			LEFT JOIN `employee` e ON e.employee_id=d.received_by
			WHERE
				d.is_deleted=0
			ORDER BY
				d.received_date DESC
			LIMIT ".$limit." OFFSET ".$offset."
			";
			
		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;	
	}
	
	/**
		This method returns the total number of records in delivery table
	*/
	public static function getAllDeliveriesCount() {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				COUNT(*) as total
			FROM
				`delivery` d
			WHERE
				d.is_deleted=0
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getRowFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result['total'];	
	}
	
	/**
		This method adds a supply to the delivery record.
		It returns the ID of the added supply, and 0 if on error.
	*/
	public static function addSupplyToDelivery($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$delivery_id = mysql_real_escape_string($data['delivery_id']);
		$item_id = mysql_real_escape_string($data['item_id']);
		$batch_code = mysql_real_escape_string($data['batch_code']);
		$quantity = mysql_real_escape_string($data['quantity']);
		$unit_id = mysql_real_escape_string($data['unit_id']);
		$dosage = mysql_real_escape_string($data['dosage']);
		$dosage_unit_id = mysql_real_escape_string($data['dosage_unit_id']);
		$age = mysql_real_escape_string($data['age']);
		$brand = mysql_real_escape_string($data['brand']);
		$is_restricted = mysql_real_escape_string($data['is_restricted']);
		$expiry = Helper::formatDBDate(mysql_real_escape_string($data['expiry']));
		$location = mysql_real_escape_string($data['location']);
		
		$sql = '
			INSERT
			INTO
				`delivery_supply`
				(
					`delivery_id`,
					`item_id`,
					`batch_code`,
					`quantity`,
					`unit_id`,
					`dosage`,
					`dosage_unit_id`,
					`age`,
					`brand`,
					`is_restricted`,
					`expiry`,
					`location`
				)
			VALUES
				(
					"'.$delivery_id.'",
					"'.$item_id.'",
					"'.$batch_code.'",
					"'.$quantity.'",
					"'.$unit_id.'",
					"'.$dosage.'",
					"'.$dosage_unit_id.'",
					"'.$age.'",
					"'.$brand.'",
					"'.$is_restricted.'",
					"'.$expiry.'",
					"'.$location.'"
				)
		';
		
		// Query Database
		$insert = mysql_query($sql,$db);
		$id = 0;
		if($insert) {
			Helper::createMessage(SYS_SUCCESS,"Successfully added a delivery supply record!");
			$id = mysql_insert_id();
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to add delivery supply record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return $id;
	}
	
	/**
		This method updates a supply of a delivery record.
		It returns the ID of the updated supply record.
	*/
	public static function updateDeliverySupply($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$delivery_supply_id = mysql_real_escape_string($data['delivery_supply_id']);
		$item_id = mysql_real_escape_string($data['item_id']);
		$batch_code = mysql_real_escape_string($data['batch_code']);
		$quantity = mysql_real_escape_string($data['quantity']);
		$unit_id = mysql_real_escape_string($data['unit_id']);
		$dosage = mysql_real_escape_string($data['dosage']);
		$dosage_unit_id = mysql_real_escape_string($data['dosage_unit_id']);
		$age = mysql_real_escape_string($data['age']);
		$brand = mysql_real_escape_string($data['brand']);
		$is_restricted = mysql_real_escape_string($data['is_restricted']);
		$expiry = Helper::formatDBDate(mysql_real_escape_string($data['expiry']));
		$location = mysql_real_escape_string($data['location']);
		
		$sql = '
			UPDATE
				`delivery_supply`
			SET
				`item_id`="'.$item_id.'",
				`batch_code`="'.$batch_code.'",
				`quantity`="'.$quantity.'",
				`unit_id`="'.$unit_id.'",
				`dosage`="'.$dosage.'",
				`dosage_unit_id`="'.$dosage_unit_id.'",
				`age`="'.$age.'",
				`brand`="'.$brand.'",
				`is_restricted`="'.$is_restricted.'",
				`expiry`="'.$expiry.'",
				`location`="'.$location.'"
			WHERE
				`delivery_supply_id`='.$delivery_supply_id.'
		';
		
		// Query Database
		$update = mysql_query($sql,$db);
		if($update) {
			Helper::createMessage(SYS_SUCCESS,"Successfully updated a delivery equipment record!");
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to update delivery equipment record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return $delivery_supply_id;
	}
	
	/**
		This method deletes a supply of a delivery record.
		It returns the ID of the updated supply record.
		It will set the is_deleted field to 1.
	*/
	public static function deleteDeliverySupply($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$delivery_id = mysql_real_escape_string($data['delivery_id']);
		$delivery_supply_id = mysql_real_escape_string($data['delivery_supply_id']);
		
		$sql = '
			UPDATE
				`delivery_supply`
			SET
				`is_deleted`=1
			WHERE
				`delivery_supply_id`='.$delivery_supply_id.'
		';
		
		// Query Database
		$update = mysql_query($sql,$db);
		if($update) {
			Helper::createMessage(SYS_SUCCESS,"Supply record #".Helper::formatID($delivery_supply_id)." is successfully deleted!");
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to delete a delivery supply record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return $delivery_id;
	}
	
	/**
		This method returns the information of a supply record under delivery record
	*/
	public static function getSupplyInformation($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				ds.*
			FROM
				`delivery_supply` ds
			WHERE
				ds.delivery_supply_id=".$id."
			";

		//print_r($sql);die();
		// Query Database
		$query = mysql_query($sql,$db);
		// Fetch Details
		$result = Helper::getRowFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;	
	}
	
	/**
		This method adds a supply to the delivery record.
		It returns the ID of the added supply, and 0 if on error.
	*/
	public static function addEquipmentToDelivery($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$delivery_id = mysql_real_escape_string($data['delivery_id']);
		$item_id = mysql_real_escape_string($data['item_id']);
		$equipment_code = mysql_real_escape_string($data['equipment_code']);
		$brand = mysql_real_escape_string($data['brand']);
		$warranty = Helper::formatDBDate(mysql_real_escape_string($data['warranty']));
		$location = mysql_real_escape_string($data['location']);
		
		$sql = '
			INSERT
			INTO
				`delivery_equipment`
				(
					`delivery_id`,
					`item_id`,
					`equipment_code`,
					`brand`,
					`warranty`,
					`location`
				)
			VALUES
				(
					"'.$delivery_id.'",
					"'.$item_id.'",
					"'.$equipment_code.'",
					"'.$brand.'",
					"'.$warranty.'",
					"'.$location.'"
				)
		';
		
		// Query Database
		$insert = mysql_query($sql,$db);
		$id = 0;
		if($insert) {
			Helper::createMessage(SYS_SUCCESS,"Successfully added a delivery equipment record!");
			$id = mysql_insert_id();
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to add delivery equipment record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return $id;
	}
	
	/**
		This method updates a equipment of a delivery record.
		It returns the ID of the updated supply record.
	*/
	public static function updateDeliveryEquipment($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$delivery_equipment_id = mysql_real_escape_string($data['delivery_equipment_id']);
		$item_id = mysql_real_escape_string($data['item_id']);
		$equipment_code = mysql_real_escape_string($data['equipment_code']);
		$brand = mysql_real_escape_string($data['brand']);
		$warranty = Helper::formatDBDate(mysql_real_escape_string($data['warranty']));
		$location = mysql_real_escape_string($data['location']);
		
		$sql = '
			UPDATE
				`delivery_equipment`
			SET
				`item_id`="'.$item_id.'",
				`equipment_code`="'.$equipment_code.'",
				`brand`="'.$brand.'",
				`warranty`="'.$warranty.'",
				`location`="'.$location.'"
			WHERE
				`delivery_equipment_id`='.$delivery_equipment_id.'
		';
		
		// Query Database
		$update = mysql_query($sql,$db);
		if($update) {
			Helper::createMessage(SYS_SUCCESS,"Successfully updated a delivery equipment record!");
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to update delivery equipment record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return $delivery_equipment_id;
	}
	
	/**
		This method deletes a equipment of a delivery record.
		It returns the ID of the updated supply record.
		It will set the is_deleted field to 1.
	*/
	public static function deleteDeliveryEquipment($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$delivery_id = mysql_real_escape_string($data['delivery_id']);
		$delivery_equipment_id = mysql_real_escape_string($data['delivery_equipment_id']);
		
		$sql = '
			UPDATE
				`delivery_equipment`
			SET
				`is_deleted`=1
			WHERE
				`delivery_equipment_id`='.$delivery_equipment_id.'
		';
		
		// Query Database
		$update = mysql_query($sql,$db);
		if($update) {
			Helper::createMessage(SYS_SUCCESS,"Equipment record #".Helper::formatID($delivery_equipment_id)." is successfully deleted!");
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to delete a delivery equipment record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return $delivery_id;
	}
	
	/**
		This method returns the information of a equipment record under delivery record
	*/
	public static function getEquipmentInformation($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				de.*
			FROM
				`delivery_equipment` de
			WHERE
				de.delivery_equipment_id=".$id."
			";

		//print_r($sql);die();
		// Query Database
		$query = mysql_query($sql,$db);
		// Fetch Details
		$result = Helper::getRowFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;	
	}
	
	############################################################
	#                                                          #
	#	Supplier                                               #
	#                                                          #
	############################################################
	
	/**
		This method returns all records in delivery table
	*/
	public static function getAllSuppliers() {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				s.supplier_id, s.name
			FROM
				`supplier` s
			ORDER BY
				s.name ASC
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	############################################################
	#                                                          #
	#	Item                                                   #
	#                                                          #
	############################################################
	
	/**
		This method returns all records in item table
	*/
	public static function getAllItems() {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				i.item_id, i.name
			FROM
				`item` i
			WHERE
				i.is_deleted=0
			ORDER BY
				i.name ASC
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	/**
		This method returns all records in item table that is under category of supply
	*/
	public static function getAllItemViaCategory($id, $limit, $offset) {
		// Open DB
		$db = Helper::openDB();
		
		$additional = (($limit!=null)?"LIMIT ".$limit:"").(($offset!=null)?"OFFSET ".$offset:"");
		
		// Create Query
		$sql = "
			SELECT
				i.item_id, i.name, i.code, i.critical_level
			FROM
				`item` i
			WHERE
				i.category_id=".$id." AND
				i.is_deleted=0
			ORDER BY
				i.item_id ASC
			".$additional."
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	/**
		This method returns all records in delivery table
	*/
	public static function getAllItemViaCategoryCount($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				COUNT(*) as total
			FROM
				`item` i
			WHERE
				i.category_id=".$id." AND
				i.is_deleted=0
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getRowFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result['total'];
	}
	
	/**
		This method creates a new item supply record.
		Returns the id of the created record.
		Returns 0 on error.
	*/
	public static function createItem($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$category_id = mysql_real_escape_string($data['category_id']);
		$name = mysql_real_escape_string($data['name']);
		$code = mysql_real_escape_string($data['code']);
		$critical_level = mysql_real_escape_string($data['critical_level']);
		$description = mysql_real_escape_string($data['description']);
		
		$sql = '
			INSERT
			INTO
				`item`
				(
					`category_id`,
					`name`,
					`code`,
					`critical_level`,
					`description`
				)
			VALUES
				(
					"'.$category_id.'",
					"'.$name.'",
					"'.$code.'",
					"'.$critical_level.'",
					"'.$description.'"
				)
		';
		
		// Query Database
		$insert = mysql_query($sql,$db);
		$id = 0;
		if($insert) {
			Helper::createMessage(SYS_SUCCESS,"Successfully added a item supply record!");
			$id = mysql_insert_id();
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to add item supply record!");
		}
		// Close DB
		Helper::closeDB($db);
		
		return $id;
	}
	
	/**
		This method updates a supply of a delivery record.
		It returns the ID of the updated supply record.
	*/
	public static function updateItem($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$item_id = mysql_real_escape_string($data['item_id']);
		$category_id = mysql_real_escape_string($data['category_id']);
		$name = mysql_real_escape_string($data['name']);
		$code = mysql_real_escape_string($data['code']);
		$critical_level = mysql_real_escape_string($data['critical_level']);
		$description = mysql_real_escape_string($data['description']);
		
		$sql = '
			UPDATE
				`item`
			SET
				`category_id`="'.$category_id.'",
				`name`="'.$name.'",
				`code`="'.$code.'",
				`critical_level`="'.$critical_level.'",
				`description`="'.$description.'"
			WHERE
				`item_id`='.$item_id.'
		';
		
		// Query Database
		$update = mysql_query($sql,$db);
		if($update) {
			Helper::createMessage(SYS_SUCCESS,"Successfully updated item supply record!");
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to update item supply record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return $item_id;
	}
	
	/**
		This method deletes a delivery record.
		It will set the is_deleted field to 1.
	*/
	public static function deleteItem($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$item_id = mysql_real_escape_string($data['item_id']);
		
		$sql = '
			UPDATE
				`item` i
			SET
				i.is_deleted=1
			WHERE
				i.item_id='.$item_id.'
		';
		
		// Query Database
		$update = mysql_query($sql,$db);
		if($update) {
			Helper::createMessage(SYS_SUCCESS,"Supply record #".Helper::formatID($item_id)." is successfully deleted!");
		} else {
			Helper::createMessage(SYS_ERROR,"Failed to delete a supply record!");
		}

		// Close DB
		Helper::closeDB($db);
		
		return null;
	}
	
	/**
		This method returns the information of the current item
	*/
	public static function getItemInformation($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				i.item_id, i.category_id, i.name, i.code, i.description, i.critical_level
			FROM
				`item` i
			WHERE
				i.item_id=".$id." AND
				i.is_deleted=0
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getRowFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	############################################################
	#                                                          #
	#	Unit                                                   #
	#                                                          #
	############################################################
	
	/**
		This method returns all records in unit table
	*/
	public static function getAllUnits() {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				u.unit_id, u.unit
			FROM
				`unit` u
			ORDER BY
				u.unit ASC
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	############################################################
	#                                                          #
	#	Employee                                               #
	#                                                          #
	############################################################
	
	/**
		This method returns all records in delivery table
	*/
	public static function getAllEmployeeInDepartment($id) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				e.employee_id, e.first_name, e.last_name
			FROM
				`employee_department` ed
			LEFT JOIN `employee` e ON e.employee_id=ed.employee_id
			WHERE
				ed.department_id=".$id."
			ORDER BY
				e.last_name ASC
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	############################################################
	#                                                          #
	#	Category                                               #
	#                                                          #
	############################################################
	
	/**
		This method returns all records in category table
	*/
	public static function getAllCategory() {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				c.category_id, c.name, c.description
			FROM
				`category` c
			ORDER BY
				c.category_id
			";

		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	############################################################
	#                                                          #
	#	Transactions                                           #
	#                                                          #
	############################################################
	
	/**
		This method returns all records in transaction table
	*/
	public static function getAllTransactions($limit, $offset) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				t.transaction_id, t.type, t.requested_by, t.requested_date, t.remarks,
				e.first_name, e.last_name,
				COUNT(CASE WHEN ti.delivery_item_type=".BPHIMS_ITEM_SUPPLY." THEN 1 END) AS supply_count,
				COUNT(CASE WHEN ti.delivery_item_type=".BPHIMS_ITEM_EQUIPMENT." THEN 1 END) AS equipment_count
			FROM
				`transaction` t
			LEFT JOIN `employee` e ON e.employee_id=t.requested_by
			INNER JOIN `transaction_item` ti ON ti.transaction_id=t.transaction_id
			ORDER BY
				t.requested_date DESC
			LIMIT ".$limit." OFFSET ".$offset."
			";
			
		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	/**
		This method returns the total number of records in transaction table
	*/
	public static function getAllTransactionsCount() {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				COUNT(*) as total
			FROM
				`transaction` t
			";
			
		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getRowFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result['total'];	
	}
	
	############################################################
	#                                                          #
	#	AJAX REQUEST                                           #
	#                                                          #
	############################################################
	
	/**
		AJAX request for users
	*/
	public static function getUsersViaAjax($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				e.employee_id, e.first_name, e.last_name,
				p.title AS position_title
			FROM
				`employee` e
			LEFT JOIN `position` p ON p.position_id=e.position_id 
			WHERE
				e.employee_id LIKE '%".$data['keyword']."%' OR
				e.first_name LIKE '%".$data['keyword']."%' OR
				e.last_name LIKE '%".$data['keyword']."%' OR
				CONCAT(e.first_name,' ', e.last_name) LIKE '%".$data['keyword']."%' OR
				CONCAT(e.last_name,', ', e.first_name) LIKE '%".$data['keyword']."%'
			LIMIT ".$data['limit']."
			";
			
		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	/**
		AJAX request for departments
	*/
	public static function getDepartmentsViaAjax($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				d.department_id, d.name, d.description
			FROM
				`department` d
			WHERE
				d.name LIKE '%".$data['keyword']."%'
			LIMIT ".$data['limit']."
			";
			
		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	/**
		AJAX request for departments
	*/
	public static function getHeadOfDepartmentsViaAjax($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				e.employee_id, e.first_name, e.last_name,
				d.name AS department_name,
				p.title AS position_title
			FROM
				`employee` e, `employee_department` ed, `department` d, `position` p
			WHERE
				(
					e.employee_id LIKE '%".$data['keyword']."%' OR
					e.first_name LIKE '%".$data['keyword']."%' OR
					e.last_name LIKE '%".$data['keyword']."%' OR
					CONCAT(e.first_name,' ', e.last_name) LIKE '%".$data['keyword']."%' OR
					CONCAT(e.last_name,', ', e.first_name) LIKE '%".$data['keyword']."%'
				)
			AND
				(
					e.position_id = p.position_id AND
					e.position_id = ".BPHIMS_POSITION_DEPARTMENT_HEAD."
				)
			AND
				(
					ed.employee_id = e.employee_id AND
					ed.department_id = d.department_id AND
					d.department_id = ".$data['department_id']."
				)
			LIMIT 5
			";
			
		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
	
	
	
	/**
		AJAX request for departments
	*/
	public static function getItemSupplyViaAjax($data) {
		// Open DB
		$db = Helper::openDB();
		
		// Create Query
		$sql = "
			SELECT
				i.item_id, i.name, i.code,
				ds.delivery_supply_id, ds.batch_code, ds.dispense, ds.quantity, ds.age, ds.brand, ds.is_restricted, ds.expiry, ds.location, ds.dosage,
				u.unit,
				ud.unit AS dosage_unit
			FROM
				`delivery_supply` ds
			LEFT JOIN `item` i ON i.item_id = ds.item_id
			LEFT JOIN `unit` u ON u.unit_id = ds.unit_id
			LEFT JOIN `unit` ud ON ud.unit_id = ds.dosage_unit_id
			WHERE
				(
					i.name LIKE '%".$data['keyword']."%' OR
					i.code LIKE '%".$data['keyword']."%'
				)
				AND
				(
					ds.expiry >= DATE_ADD(CURDATE(), INTERVAL +1 DAY)
				)
			LIMIT ".$data['limit']."
			";
			
		// Query Database
		$query = mysql_query($sql,$db);
		
		// Fetch Details
		$result = Helper::getListFromResultQuery($query);
		
		// Close DB
		Helper::closeDB($db);
		
		// Return status 
		return $result;
	}
}

?>