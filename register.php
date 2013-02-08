<?php
	session_start();
	require_once "include/header.php";
?>

	<section id = "reg">
		<article id = "reg_form">
			<form action = "reg_process.php" method = "post">
			<label for = "studnum">Student number: </label><br/>
			<input type = "text" name = "studnum" required = "required" pattern = "[0-9]{4}-[0-9]{5}" /> <br/><br/>
			
			<label for = "uname">Username: </label><br/>
			<input type = "text" name = "uname"    required = "required" pattern = "[A-z0-9]{3,}"/> <br/><br/>
			
			<label for = "pass1">Password (minimum of 6 characters): </label><br/>
			<input type = "password" name = "pass1"  pattern = "[A-z0-9]{6,}" required = "required" onchange = "form.pass2.pattern = this.value;"/> <br/><br/>
			
			<label for = "pass2">Re-type password: </label><br/>
			<input type = "password" name = "pass2"  pattern = "[A-z]{6,}" required = "required"/> <br/><br/>
			
			<label for = "email">Email: </label><br/>
			<input type = "email"  name = "email" required = "required" /> <br/><br/>
			
			<input type = "checkbox"  name = "terms" required = "required" />
			<label for = "email">I agree with the terms that are presented by the library.</label><br/><br/>
			
			<input type = "submit" value = "Register"/>
			</form>
		</article>
	</section>
	
	<section id = "agreement">
		<article id = "terms">
			<h3 id = "terms">Terms of Agreement</h3>
			<p id = "terms">
				dito iligay yung terms of agreement natin...
				saka na lang iadjust yung position kapag nabuo na yung terms of agreement natin
			</p>
		</article>
	</section>

<?php
	require_once "include/footer.php";
?>