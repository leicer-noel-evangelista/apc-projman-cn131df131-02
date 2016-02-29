<?php
include("header.php");

session_destroy();
Helper::redirect("index.php");

include("footer.php");
?>