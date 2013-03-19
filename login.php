<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	/*
		Checks if the username of the sessioned user is set and if it is set
		then it will use the username of the user in a query to look if the user's username
		is registered or is in the database. If the result of the query does not return 0 then
		the user would be redirected to his/her homepage.
	*/
	if(isset($_SESSION['uname'])){
		require_once "connection/connect.php";
		require_once "connection/use_db.php";
		$uname = mysql_real_escape_string($_SESSION['uname']);	/*cleans the string for query*/
		
		$query = "select username from student where username like '{$uname}' ";	
		$result = mysql_query($query, $con);
		
		if(mysql_num_rows($result) != 0){
			header("Location: home.php");
		}
	}
?>

	<form class = "form_settings" action =  "process_login.php" method = "post">
		<fieldset>
			<legend>Log In</legend>
			<table>
				<thead>
					<tr>
						<th>	<label for = "username">Username:</label> </th>
						<th>	<label for = "password">Password:</label> </th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td><input type = "text" name = "uname" required = "required" pattern = "[A-z0-9_]{3,}"/></td>
						<td><input type = "password" name = "pass" required = "required" pattern = "[A-z0-9]{6,}"/></td>
						<td><input class = "submit" type = "submit" value = "Log In" /></td>
					</tr>
				</tbody>
	
			</table>
		</fieldset>
	</form>

