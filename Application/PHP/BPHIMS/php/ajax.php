<?php
include("init.php");

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
	
	/**
		Returns all requestor
	*/
	if($_REQUEST['action'] === "transaction_requested_by") {
		$data = array(
			"keyword" => $_REQUEST['keyword'],
			"limit" => 5,
		);
		
		$result = BPHIMS::getUsersViaAjax($data);
		$formatted = array();
		
		$first = true;
		foreach($result as $r){
			$f = '
				<div class="ajax_result '.(($first)?'initial_selected first_result':'').'" value="'.$r['employee_id'].'">
					<table>
						<tr>
							<td>
								<img src="img/default/default-avatar.png" class="img-thumbnail" />
							</td>
							<td>
								<b>'.$r['last_name'].', '.$r['first_name'].'</b><br/>
								<span>#'.Helper::formatID($r['employee_id']).' - '.$r['position_title'].'</span>
							</td>
						</tr>
					</table>
				</div>
			';
			$first = false;
			array_push($formatted, $f);
		}
		
		$formatted = Helper::addNoResultFound($formatted, $_REQUEST['keyword']);
		
		echo json_encode($formatted);
	}
	
	/**
		Returns all requestor
	*/
	if($_REQUEST['action'] === "transaction_patient_id") {
		$data = array(
			"keyword" => $_REQUEST['keyword'],
			"limit" => 5,
		);
		
		$result = BPHIMS::getPatientsViaAjax($data);
		$formatted = array();
		
		$first = true;
		foreach($result as $r){
			$f = '
				<div class="ajax_result '.(($first)?'initial_selected first_result':'').'" value="'.$r['patient_id'].'">
					<table>
						<tr>
							<td>
								<img src="img/default/default-avatar.png" class="img-thumbnail" />
							</td>
							<td>
								<b>'.$r['last_name'].', '.$r['first_name'].'</b><br/>
								<span>#'.Helper::formatID($r['patient_id']).'</span>
							</td>
						</tr>
					</table>
				</div>
			';
			$first = false;
			array_push($formatted, $f);
		}
		
		$formatted = Helper::addNoResultFound($formatted, $_REQUEST['keyword']);
		
		echo json_encode($formatted);
	}
	
	/**
		Returns all requestor
	*/
	if($_REQUEST['action'] === "transaction_doctor_id") {
		$data = array(
			"keyword" => $_REQUEST['keyword'],
			"position_id" => BPHIMS_POSITION_DOCTOR,
			"limit" => 5,
		);
		
		$result = BPHIMS::getUsersInPositionViaAjax($data);
		$formatted = array();
		
		$first = true;
		foreach($result as $r){
			$f = '
				<div class="ajax_result '.(($first)?'initial_selected first_result':'').'" value="'.$r['employee_id'].'">
					<table>
						<tr>
							<td>
								<img src="img/default/default-avatar.png" class="img-thumbnail" />
							</td>
							<td>
								<b>'.$r['last_name'].', '.$r['first_name'].'</b><br/>
								<span>#'.Helper::formatID($r['employee_id']).' - '.$r['position_title'].'</span>
							</td>
						</tr>
					</table>
				</div>
			';
			$first = false;
			array_push($formatted, $f);
		}
		
		$formatted = Helper::addNoResultFound($formatted, $_REQUEST['keyword']);
		
		echo json_encode($formatted);
	}
	
	/**
		Returns all department
	*/
	if($_REQUEST['action'] === "transaction_department_id") {
		$data = array(
			"keyword" => $_REQUEST['keyword'],
			"limit" => 5,
		);
		
		$result = BPHIMS::getDepartmentsViaAjax($data);
		$formatted = array();
		
		$first = true;
		foreach($result as $r){
			$f = '
				<div class="ajax_result '.(($first)?'initial_selected first_result':'').'" value="'.$r['department_id'].'">
					<table>
						<tr>
							<td>
								<img src="img/default/default-department.png" class="img-thumbnail" />
							</td>
							<td>
								<b>'.$r['name'].'</b><br/>
								<span>#'.Helper::formatID($r['department_id']).' - '.$r['description'].'</span>
							</td>
						</tr>
					</table>
				</div>
			';
			$first = false;
			array_push($formatted, $f);
		}
		
		$formatted = Helper::addNoResultFound($formatted, $_REQUEST['keyword']);
		
		echo json_encode($formatted);
	}
	
	/**
		Returns all department
	*/
	if($_REQUEST['action'] === "transaction_department_head_id") {
		$data = array(
			"keyword" => $_REQUEST['keyword'],
			"department_id" => $_REQUEST['department_id'],
			"limit" => 5,
		);
		
		$result = BPHIMS::getHeadOfDepartmentsViaAjax($data);
		$formatted = array();
		
		$first = true;
		foreach($result as $r){
			$f = '
				<div class="ajax_result '.(($first)?'initial_selected first_result':'').'" value="'.$r['employee_id'].'">
					<table>
						<tr>
							<td>
								<img src="img/default/default-avatar.png" class="img-thumbnail" />
							</td>
							<td>
								<b>'.$r['last_name'].', '.$r['first_name'].'</b><br/>
								<span>#'.Helper::formatID($r['employee_id']).' - '.$r['department_name'].' - '.$r['position_title'].'</span>
							</td>
						</tr>
					</table>
				</div>
			';
			$first = false;
			array_push($formatted, $f);
		}
		
		$formatted = Helper::addNoResultFound($formatted, $_REQUEST['keyword']);
		
		echo json_encode($formatted);
	}
	
	/**
		Returns all item supply
	*/
	if($_REQUEST['action'] === "transaction_item_supply_id") {
		$data = array(
			"keyword" => $_REQUEST['keyword'],
			"limit" => 5,
			"selected_id" => json_decode($_REQUEST['delivery_item_id'])
		);
		
		$result = BPHIMS::getItemSupplyViaAjax($data);
		$formatted = array();
		
		$first = true;
		foreach($result as $r){
			$tooltip = ($r['is_restricted'])?'data-toggle="tooltip" data-placement="left" title="This item is restricted. Must have doctors recommendation before it is given!"':'';
			$f = '
				<div restricted="'.$r['is_restricted'].'" class="ajax_result special_result '.(($first)?'initial_selected first_result':'').'" '.$tooltip.'>
					<table class="ajax_table">
						<tr>
							<td>
								<img src="img/default/default_supply.png" class="img-thumbnail" />
							</td>
							<td>
								<b>'.$r['code'].' - '.$r['name'].' ('.$r['brand'].') - '.$r['dosage'].' '.$r['dosage_unit'].'</b><br/>
								<span><i class="glyphicon glyphicon-user"></i> '.$r['age'].'</span><br/>
								<span><i class="glyphicon glyphicon-tag"></i> '.$r['batch_code'].'</span><br/>
								<span><i class="glyphicon glyphicon-calendar"></i> '.Helper::formatDate($r['expiry']).' ('.Helper::daysLeft($r['expiry']).')</span><br/>
								<span><i class="glyphicon glyphicon-shopping-cart"></i> '.($r['quantity'] - $r['dispense']).' pcs</span>
							</td>
						</tr>
					</table>
					
					<div class="ajax_label label_location">Loc: '.$r['location'].'</div>
					<div class="ajax_label label_age">For ages: '.$r['age'].'</div>
					'.(($r['is_restricted'])?'<div class="ajax_label label_restriction">RESTRICTED</div>':'').'
					<textarea class="hidden" id="ajax_result_data">'.json_encode($r).'</textarea>
				</div>
			';
			$first = false;
			array_push($formatted, $f);
		}
		
		$formatted = Helper::addNoResultFound($formatted, $_REQUEST['keyword']);
		
		echo json_encode($formatted);
	}
	
	/**
		Returns all item supply
	*/
	if($_REQUEST['action'] === "transaction_item_equipment_id") {
		$data = array(
			"keyword" => $_REQUEST['keyword'],
			"limit" => 5,
			"selected_id" => json_decode($_REQUEST['delivery_equipment_id'])
		);
		
		$result = BPHIMS::getItemEquipmentViaAjax($data);
		$formatted = array();
		
		$first = true;
		foreach($result as $r){
			$r['quantity'] = 1;
			$r['dispense'] = 0;
			$f = '
				<div class="ajax_result special_result '.(($first)?'initial_selected first_result':'').'">
					<table class="ajax_table">
						<tr>
							<td>
								<img src="img/default/default_equipment.png" class="img-thumbnail" />
							</td>
							<td>
								<b>'.$r['code'].' - '.$r['name'].' ('.$r['brand'].')</b><br/>
								<span><i class="glyphicon glyphicon-tag"></i> '.$r['equipment_code'].'</span><br/>
								<span><i class="glyphicon glyphicon-calendar"></i> '.Helper::formatDate($r['warranty']).' ('.Helper::daysLeft($r['warranty']).')</span>
							</td>
						</tr>
					</table>
					
					<div class="ajax_label label_location">Loc: '.$r['location'].'</div>
					<textarea class="hidden" id="ajax_result_data">'.json_encode($r).'</textarea>
				</div>
			';
			$first = false;
			array_push($formatted, $f);
		}
		
		$formatted = Helper::addNoResultFound($formatted, $_REQUEST['keyword']);
		
		echo json_encode($formatted);
	}
	
}
?>