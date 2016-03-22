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
		Update item action
	*/
	if($_REQUEST['action'] === "item_update") {
		$item_id = BPHIMS::updateItem($_REQUEST);
		if($item_id) {
			Helper::redirect("../inventories_update.php?item_id=".$item_id);
		}
	}
	
}
?>