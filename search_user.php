<?php
	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "include/admin_header.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
?>

	<section id = "greetings">
		<article>
			<?php
				echo "Welcome, <em><a href = \"admin_home.php\" id = \"uname\">{$_SESSION['uname']}</a></em> ! 	| 	<a href = \"signout.php\">Sign Out</a>";
			?>
		</article>
	</section><br/>
	
	<section id = "mylib">
		<article>
			<!--
				+-------------+-------------+
				|	form for search filters	|
				+-------------+-------------+
			-->
			Search user according to: </br>
			<form action="search_user_result.php" method="post">
				
				<!--
				******this is for sorting... (not yet implemented)******
				<select name="user_filter">
					<option value="alluser" selected>All user</option>
					<option value="studnum">By Student Number</option>
					<option value="firstname">By First Name</option>
					<option value="lastname">By Last Name</option>
				</select>
				-->
				
				<table cellpadding="10">
				<tr>
				<td><label for = "studnum">Student Number: </label></td>
				<td><input type="text" name="studnum" pattern="[0-9]{0,4}-{0,1}[0-9]{0,5}" /></td>
				</tr>
				<tr>
				<td><label for = "fname">First Name: </label></td>
				<td><input type="text" name="fname" pattern="[A-z]{0,}" /></td>
				</tr>
				<tr>
				<td><label for = "studnum">Last Name: </label></td>
				<td><input type="text" name="lname" pattern="[A-z]{0,}" /></td>
				</tr>
				<tr><td><input type="submit" value="Search"></td></tr>
				</table>
			</form>
		</article>
	</section>
	
	<section id = "nav">
		<?php
			require_once "include/admin_nav.php";
		?>
	</section>

<?php
	require_once "include/admin_footer.php";
	require_once "connection/close.php";
?>