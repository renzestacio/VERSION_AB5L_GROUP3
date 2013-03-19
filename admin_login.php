<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	require_once "include/header.php";
?>

	<!--
		Login form for administrators
	-->

	<div id = "admin_login">
		<form id = "admin_form" action =  "admin_process_login.php" method = "post">
			<fieldset>
				<legend>Log In</legend>
				<br/>
				<label for = "username">Username:</label>
				<input type = "text" name = "uname" required = "required" pattern = "[A-z0-9_]{3,}" placeholder = "minimum of 3 characters"/><br/><br/>
				
				<label for = "password">Password:</label>
				<input type = "password" name = "pass" required = "required" pattern = "[A-z0-9]{6,}"  placeholder = "minimum of 6 characters"/><br/><br/><br/>
				
				<input class = "submit" type = "submit" value = "Log In" />
				
			</fieldset>
		</form>
	</div>

<?php
	require_once "include/footer.php";
?>