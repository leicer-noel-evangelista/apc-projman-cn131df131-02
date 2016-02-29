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
		return $message;
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
			Helper::redirect("index.php");
			Helper::createMessage(SYS_ERROR,"You must log in to view this page!");
		}
	}
	
	public static function replaceEmpty($data) {
		return ($data == "")?"N/A":$data;
	}
	
	public static function toArray($data) {
		return explode("|",$data);
	}
	
}

?>