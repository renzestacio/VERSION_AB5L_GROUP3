<?php
	session_start();
	require_once "include/header.php";
?>

	<section id = "login">
		<article id = "login_form">
			<form action = "login_process.php" method = "post">
				
				<label for = "username">Username:</label><br/>
				<input type = "text" name = "uname" required = "required" pattern = "[A-z]{3,}"/><br/><br/>
				
				<label for = "password">Password:</label><br/>
				<input type = "password" name = "pass" required = "required" pattern = "[A-z0-9]{6,}"/><br/><br/>
				
				<input type = "submit" value = "Log In" /> 
			</form>
		</article>
	</section>

<?php
	require_once "include/footer.php";
?>