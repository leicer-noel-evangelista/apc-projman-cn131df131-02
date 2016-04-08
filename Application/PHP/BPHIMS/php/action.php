<?php
include("init.php");

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
	
	/**
		Create delivery action
	*/
	if($_REQUEST['action'] === "delivery_create") {
		$delivery_id = BPHIMS::createDelivery($_REQUEST);
		if($delivery_id) {
			Helper::redirect("../deliveries_update.php?delivery_id=".$delivery_id);
		} else {
			Helper::redirect("../deliveries_create.php");
		}
	}
	
	/**
		Update delivery action
	*/
	if($_REQUEST['action'] === "delivery_update") {
		$delivery_id = BPHIMS::updateDelivery($_REQUEST);
		Helper::redirect("../deliveries_update.php?delivery_id=".$delivery_id);
	}
	
	/**
		Delete delivery action
	*/
	if($_REQUEST['action'] === "delivery_delete") {
		BPHIMS::deleteDelivery($_REQUEST);
		Helper::redirect("../deliveries.php");
	}
	
	/**
		Create delivery->supply action
	*/
	if($_REQUEST['action'] === "delivery_supply_add") {
		$delivery_supply_id = BPHIMS::addSupplyToDelivery($_REQUEST);
		if($delivery_supply_id) {
			Helper::redirect("../deliveries_supply_update.php?delivery_supply_id=".$delivery_supply_id);
		} else {
			Helper::redirect("../deliveries_supply_add.php?delivery_id=".$_REQUEST['delivery_id']);
		}
	}
	
	/**
		Update delivery->supply action
	*/
	if($_REQUEST['action'] === "delivery_supply_update") {
		$delivery_supply_id = BPHIMS::updateDeliverySupply($_REQUEST);
		Helper::redirect("../deliveries_supply_update.php?delivery_supply_id=".$delivery_supply_id);
	}
	
	/**
		Delete delivery->supply action
	*/
	if($_REQUEST['action'] === "delivery_supply_delete") {
		$delivery_id = BPHIMS::deleteDeliverySupply($_REQUEST);
		Helper::redirect("../deliveries_supply.php?delivery_id=".$delivery_id);
	}
	
	/**
		Create delivery->equipment action
	*/
	if($_REQUEST['action'] === "delivery_equipment_add") {
		$delivery_equipment_id = BPHIMS::addEquipmentToDelivery($_REQUEST);
		if($delivery_equipment_id) {
			Helper::redirect("../deliveries_equipment_update.php?delivery_equipment_id=".$delivery_equipment_id);
		} else {
			Helper::redirect("../deliveries_equipment_add.php?delivery_id=".$_REQUEST['delivery_id']);
		}
	}
	
	/**
		Update delivery->equipment action
	*/
	if($_REQUEST['action'] === "delivery_equipment_update") {
		$delivery_equipment_id = BPHIMS::updateDeliveryEquipment($_REQUEST);
		Helper::redirect("../deliveries_equipment_update.php?delivery_equipment_id=".$delivery_equipment_id);
	}
	
	/**
		Delete delivery->equipment action
	*/
	if($_REQUEST['action'] === "delivery_equipment_delete") {
		$delivery_id = BPHIMS::deleteDeliveryEquipment($_REQUEST);
		Helper::redirect("../deliveries_equipment.php?delivery_id=".$delivery_id);
	}
	
	/**
		Create item action
	*/
	if($_REQUEST['action'] === "item_create") {
		$item_id = BPHIMS::createItem($_REQUEST);
		if($delivery_supply_id) {
			Helper::redirect("../inventories_create.php?item_id=".$item_id);
		} else {
			Helper::redirect("../inventories_update.php?item_id=".$item_id);
		}
	}
	
	/**
		Update item action
	*/
	if($_REQUEST['action'] === "item_update") {
		$item_id = BPHIMS::updateItem($_REQUEST);
		if($item_id) {
			Helper::redirect("../inventories_update.php?item_id=".$item_id);
		}
	}
	
	/**
		Delete item action
	*/
	if($_REQUEST['action'] === "item_delete") {
		BPHIMS::deleteItem($_REQUEST);
		Helper::redirect("../".$_REQUEST['return_page'].".php");
	}
	
	/**
		Create transaction for department
	*/
	if($_REQUEST['action'] === "transactions_department_create") {
		BPHIMS::createTransactionDepartment($_REQUEST);
		Helper::redirect("../transactions.php");
	}
	
	/**
		Create transaction for doctor
	*/
	if($_REQUEST['action'] === "transactions_doctor_create") {
		BPHIMS::createTransactionDoctor($_REQUEST);
		Helper::redirect("../transactions.php");
	}
	
}
?>