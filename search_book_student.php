<?php
	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "include/header.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
?>

	<section id = "greetings">
		<article>
			<?php
				echo "Welcome, <em><a href = \"home.php\" id = \"uname\">{$_SESSION['uname']}</a></em> ! 	| 	<a href = \"signout.php\">Sign Out</a>";
			?>
		</article>
	</section><br/>
	
	<section id = "search_tab">
		<article>
			<!--
				+-------------+-------------+
				|	form for search filters	|
				+-------------+-------------+
			-->
			Search user according to: </br>
			<form action="search_book_student_result.php" method="post">
				
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
				<td><label for = "Title">Title: </label></td>
				<td><input type="text" name="title" pattern="[A-z]{0,}" /></td>
				</tr>
				<tr>
				<td><label for = "Author">Author: </label></td>
				<td><input type="text" name="author" pattern="[A-z]{0,}" /></td>
				</tr>
				<tr>
				<tr><td><input type="submit" value="Search"></td></tr>
				</table>
			</form>
		</article>
	</section>
	
	<section id = "nav">
		<?php
			require_once "include/nav.php";
		?>
	</section>

<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>