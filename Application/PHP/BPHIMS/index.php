<?php include("header.php"); ?>
<table>
<form action="php/action.php" method="post">
	<input type="hidden" name="action" value="login"/>
	<tr>
		<td ><span class="login_label">USERNAME:</span></td>
		<td><input type="text" name="username"required /></td>
	</tr>
	<tr>
		<td ><span>PASSWORD:</span></td>
		<td><input type="password" name="password" required /></td>
	</tr>
	<tr>
		<td><span></span></td>
		<td><input type="submit" value="Login" /></td>
	</tr>
</form>
</table>

<div>
<?php
	$systemMessage = Helper::getMessage();
	if($systemMessage != null){
		echo "<hr/>";
		echo $systemMessage['body']; 
	}
?>
</div>

<?php include("footer.php"); ?>