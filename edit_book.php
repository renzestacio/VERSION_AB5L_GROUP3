<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<?php
	session_start();
	include 'connection/connect.php';
	//just to make sure that the user is online when accessing this page
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "include/header.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";	
	$query = "select * from book where title = '$_GET[id]'";	
	$result = mysql_query($query, $con);
	while($row = mysql_fetch_assoc($result)){
		$BookID = mysql_escape_string($row['BookID']);
		$booknum = mysql_escape_string($row['booknum']);
		$title = mysql_escape_string($row['title']);
		$author = mysql_escape_string($row['author']);
		$date = mysql_escape_string($row['pub_date']);
		break;
	}
?>

<section id = "left_side_edit">

<h3>You are now editting</h3>
<form action="<?php echo "process_edit_book.php?id={$booknum}"; ?>" method="post" enctype="multipart/form-data">
	
	<table>
	
	<tr class="label">File</tr>
	<tr><input type="file" name="image" ></tr>		
	<br/>
	<tr>
	<?php
			echo "<img src=get_book_image.php?id=". $BookID .">"; 
	?>		
	<td><input type="submit" name="imagesubmit" value="Upload Image"></td>
	</tr>
	</table>

	<br/>
	<table>
	<tr class="label">Book number</tr>
	<tr class="field"><input type = "text"  name = "newbooknum" required = "required" value="<?php echo $booknum; ?>" size="40"/></tr>
	<br /><br />	
	<tr class="label" >Title</tr>
	<tr class="field"><input type = "text" name = "newtitle" required = "required"  value="<?php echo $title; ?>" size="40" /></tr>
	<br/><br />
	<tr class="label">Author</tr> 
	<tr class="field"><input type = "text" name = "newauthor" required = "required" value="<?php echo $author; ?>" size="40"/></tr>
	<br /><br />
	<tr class="label">Date </tr>
	<tr class="field"><input type = "date"  name = "newdate" required = "required" value="<?php echo $date; ?>" size="40"/></tr>
	<br /><br />

	<tr class="label">Add more(leave as 0 for no new books)</tr> 
	<tr class="field"><input type = "text" name = "newquantity" required = "required" value="0" size="40"/></tr>
	<br /><br />	
	
	<tr><input type = "submit" name = "submit" value = "Accept Changes" /></tr>
	<tr><input type = "submit" name = "cancel" value = "Cancel Changes" /></tr>
	<br /><br />
	
	<tr class = "label">Remove</tr>
	<select name = "removeoption">
		<option value="1">Remove all Available</option>
		<option value="0" selected>Remove Number</option>
	</select>
	<br /><br />
	<tr class="field"><input type = "text"  name = "removenum" value="0" size="40"/></tr>
	<br /><br />				
	<tr><input type = "submit" name = "remove" value = "Remove books" /></tr>
	<br /><br />
</form>

</table>
</section>
		
<?php
	echo "<section id = \"nav\">";
	require_once "include/admin_nav.php";
	echo "</section>";
	require_once "include/user_footer.php";
	require_once "connection/close.php";
?>
</html>


	