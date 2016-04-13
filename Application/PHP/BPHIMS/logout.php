<?php
	include('php/init.php');
	session_destroy();
	Helper::redirect("index.php");
?>