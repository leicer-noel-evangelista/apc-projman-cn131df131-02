<?php
include("init.php");

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
	
	if($_REQUEST['action'] === "login") {
		$status = BPHIMS::login($_REQUEST);
		if($status == SYS_SUCCESS) {
			Helper::redirect("../inventory.php");
		} else {
			Helper::createMessage(SYS_ERROR,"Invalid Username or Password!");
			Helper::redirect("../index.php");
		}
	}
	
	if($_REQUEST['action'] === "inventory_add") {
		$status = BPHIMS::addsupplies($_REQUEST);
		if($status['status'] == SYS_SUCCESS) {
			Helper::createMessage(SYS_SUCCESS,$status['message']);
			Helper::redirect("../inventory_edit.php?item_id=".$status['item_id']);
		} else {
			Helper::createMessage(SYS_ERROR,$status['message']);
			Helper::redirect("../inventory_add.php");
		}
	}
	if($_REQUEST['action'] === "inventory_update") {
		$status = BPHIMS::updateItemInventory($_REQUEST);
		Helper::createMessage($status['status'],$status['message']);
		Helper::redirect("../inventory_edit.php?item_id=".$status['item_id']);
	}
	
	if($_REQUEST['action'] === "supplier_add") {
		$status = BPHIMS::addSupplier($_REQUEST);
		if($status['status'] == SYS_SUCCESS) {
			Helper::createMessage(SYS_SUCCESS,$status['message']);
			Helper::redirect("../supplier_edit.php?supplier_id=".$status['supplier_id']);
		} else {
			Helper::createMessage(SYS_ERROR,$status['message']);
			Helper::redirect("../supplier_add.php");
		}
	}
	
	
	if($_REQUEST['action'] === "supplier_update") {
		$status = BPHIMS::updateSupplier($_REQUEST);
		Helper::createMessage($status['status'],$status['message']);
		Helper::redirect("../supplier_edit.php?supplier_id=".$status['supplier_id']);
	}
	
}
?>