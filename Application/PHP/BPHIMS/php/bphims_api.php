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
		This method returns all records in delivery table
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
}

?>