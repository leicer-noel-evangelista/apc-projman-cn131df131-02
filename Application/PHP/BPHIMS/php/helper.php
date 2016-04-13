<?php

class Helper {
	
	public static function redirect($url) {
		header('Location: '.$url);
	}

	public static function openDB() {
		$db = mysql_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD);
		mysql_select_db(DB_DATABASE,$db);
		return $db;
	}
	
	public static function closeDB($db) {
		mysql_close($db);
	}
	
	public static function setSession($name,$value){
		$_SESSION[$name] = $value;
	}
	
	public static function createMessage($type, $body){
		$_SESSION['message'] = array(
				'type' => $type,
				'body' => $body,
			);
	}
	
	public static function getMessage() {
		$message = $_SESSION['message'];
		$_SESSION['message'] = null;
		
		if($message != null){
			$alertType = ($message['type']==SYS_SUCCESS)?"success":"danger"; 
			echo '
			<div class="alert alert-'.$alertType.' alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<span>'.$message['body'].'</span>
			</div>
			';
		}
		
		return null;
	}
	
	public static function getRowFromResultQuery($result) {
		return mysql_fetch_assoc($result);
	}
	
	public static function getListFromResultQuery($result) {
		$lists = array();
		while($d = mysql_fetch_assoc($result)){
			array_push($lists,$d);
		}
		return $lists;
	}
	
	public static function checkActivity() {
		if($_SESSION['user_id'] == 0) {
			Helper::createMessage(SYS_ERROR, "You must log in to view this page!");
			Helper::redirect("index.php");
			die();
		}
	}
	
	public static function replaceEmpty($data) {
		return ($data == "")?"N/A":$data;
	}
	
	public static function toArray($data) {
		return explode("|",$data);
	}
	
	public static function formatDate($date) {
		return date('F j, Y',strtotime($date));
	}
	
	public static function formatDateComplete($date) {
		return date('F j, Y @ h:i:s A',strtotime($date));
	}
	
	public static function formatID($id) {
		return str_pad($id, 6, '0', STR_PAD_LEFT);
	}
	
	public static function formatDBDate($date) {
		return date('Y-m-d H:i:s',strtotime($date));
	}
	
	public static function formatDatepicker($date) {
		return date('m/d/Y',strtotime($date));
	}
	
	public static function daysLeft($date) {
		$today = strtotime(date('Y-m-d'));
		$finish = strtotime($date);
		$difference = $finish-$today;
		$result = floor($difference / (60 * 60 * 24));
		if($result > 0) {
			return $result.' days left';
		} else {
			return 'EXPIRED';
		}
	}
	
	public static function addNoResultFound($formatted, $keyword) {	
		if(count($formatted) == 0) {
			$f = '
				<div class="ajax_result_no_result">
					<i class="glyphicon glyphicon-exclamation-sign"></i> <b>No result found for keyword "'.$keyword.'"</b>
				</div>
			';
			array_push($formatted, $f);
		}
		return $formatted;
	}
}

?>