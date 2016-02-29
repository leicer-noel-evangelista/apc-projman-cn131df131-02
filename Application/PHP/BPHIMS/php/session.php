<?php

	session_start();
	
	if(!isset($_SESSION['user_id'])){
		$_SESSION['user_id'] = 0;
	}
	if(!isset($_SESSION['type'])){
		$_SESSION['type'] = 0;
	}
	if(!isset($_SESSION['first_name'])){
		$_SESSION['first_name'] = "";
	}
	if(!isset($_SESSION['last_name'])){
		$_SESSION['last_name'] = "";
	}
	if(!isset($_SESSION['message'])){
		$_SESSION['message'] = null;
	}


?>