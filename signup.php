<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	
	<form class = "form_settings" action = "process_signup.php" method = "post">
		<fieldset>
			<legend>Sign Up</legend>
			<table cellspacing = "7">
	
				<tbody>
					
					<tr>	
						<td>	<span style = "text-align: right"><label for = "studnum">Student number: </label>	</span></td>
						<td>	<input type = "text" name = "studnum" required = "required" pattern = "[0-9]{4}-[0-9]{5}" placeholder = "xxxx-xxxxx" onfocus = "focused()"/>	</td>
					</tr>
					<tr>
						<td>	<span style = "text-align: right"><label for = "uname">Username: </label>	</span></td>
						<td>	<input type = "text" name = "uname"    required = "required" pattern = "[A-z0-9]{3,}" placeholder = "minimum of 3 characters"/>	</td>
					</tr>
					<tr>
							<td>	<span style = "text-align: right"><label for = "pass1">Password: </label></span>	</td>
							<td>	<input type = "password" name = "pass1"  pattern = "[A-z0-9]{6,}" required = "required" onchange = "form.pass2.pattern = this.value;" placeholder = "minimum of 6 characters" />	</td>
					</tr>
					<tr>
						<td>	<span style = "text-align: right"><label for = "pass2">Re-type password: </label></span>	</td>
						<td>	<input type = "password" name = "pass2"  pattern = "[A-z0-9]{6,}" required = "required"/>	</td>
					</tr>
					<tr>
						<td>	<span style = "text-align: right"><label for = "fname">First name: </label>	</span></td>
						<td>	<input type = "text" name = "fname"    required = "required" pattern = "[A-z]{3,}"/>	</td>
					</tr>
					<tr>
						<td>	<span style = "text-align: right"><label for = "lname">Last name: </label></span>	</td>
						<td>	<input type = "text" name = "lname"    required = "required" pattern = "[A-z]{3,}"/>	</td>
					</tr>
					<tr>
						<td>	<span style = "text-align: right"><label for = "email">Email address: </label></span>	</td>
						<td>	<input type = "email"  name = "email" required = "required" placeholder = "email@server.com"/>	</td>
					</tr>
					<tr>
						<td><span style = "text-align: right">	<input type = "checkbox"  name = "terms" required = "required" /></span>	</td>
						<td><span style = "text-align: left"><label for = "email">I agree with the terms that are presented by the library.</label></span>	</td>
					</tr>
					<tr>
						<td><span style = "text-align: right"><input class = "submit" type = "submit" value = "Sign Up"/></span></td>
					</tr>
					
				</tbody>
				
			</table>
		</fieldset>
	</form>
		
