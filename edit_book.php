<?php
	session_start();
	include 'connection/connect.php';
	//just to make sure that the user is online when accessing this page
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "include/checkSession.php";
	require_once "include/header.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";	
	$query = "select * from `book` where `booknum` = '$_GET[id]'";	
	$result = mysql_query($query, $con);
	while($row = mysql_fetch_assoc($result)){
		$BookID = mysql_escape_string($row['BookID']);
		$booknum = mysql_escape_string($row['booknum']);
		$title = mysql_escape_string($row['title']);
		$author = mysql_escape_string($row['author']);
		$date = mysql_escape_string($row['pub_date']);
		$compute = "select * from book where booknum='$row[booknum]' and studnum IS NULL";
		$tempres = mysql_query($compute, $con);
		$avail = 0;
		while($temp = mysql_fetch_assoc($tempres))
			$avail+=1;

		$compute2 = "select * from book where booknum='$row[booknum]'";
		$tempres2 = mysql_query($compute2, $con);
		$quantity = 0;
		while($temp = mysql_fetch_assoc($tempres2))
			$quantity+=1;			

		break;
	}

	require_once "include/admin_nav.php";
	
	$success = -1;
	
	if(!isset($_GET['success'])){
		$success = -1;
	}
	else if($_GET['success'] == 1){
		$success = 1;
	}
	else if($_GET['success'] == 0){
		$success = 0;
	}else if($_GET['success'] > 1){
		$success = $_GET['success'];
	}
?>


	<div id="site_content">
	
		

	<div id = "edit_book_container">
			<form  id = "edit_book_form" action="<?php echo "process_edit_book.php?id={$booknum}"; ?>" method="post" enctype="multipart/form-data">
				
					<h4>Edit Book</h4>
					<div id="prompt_edit_book">
						<aside>
							<?php
								if($success == 1) echo "Update successful!";
								else if($success == 0) echo "Update not successful";
								else if($success == 2) echo "Photo not successfully uploaded.";
								else if($success == 3) echo "Photo successfully uploaded.";
								else if($success == 4) echo "Photo successfully removed.";
							?>
						</aside>
					</div><br/>
					<table cellspacing = "8">
						<tfoot>
							<tr>
								<td><input type="submit" name="imagesubmit" value="Upload Image"></td>
								<td><input type="submit" name="imagerestore" value="Remove Image"></td>
							</tr>						
							<tr>
								<td><input class = "submit" type = "submit" name = "submit" value = "Accept Changes" /></td>
								<td><input class = "submit" type = "submit" name = "cancel" value = "Cancel Changes" /></td>
							</tr>
						</tfoot>
						
						<tbody>
							<tr>
								<th><label for = "newbooknum">Book number:</label></th>
								<td><input type = "text"  name = "newbooknum" required = "required" value="<?php echo $booknum; ?>" /></td>
							</tr>
							
							<tr>
								<th><label for = "newtitle">Title:</label></th>
								<td><input type = "text" name = "newtitle" required = "required"  value="<?php echo $title; ?>"  /></td>
							</tr>
							
							<tr>
								<th><label for = "newauthor">Author:</label></th>
								<td><input type = "text" name = "newauthor" required = "required" value="<?php echo $author; ?>" /></td>
							</tr>
							
							<tr>
								<th><label for = "newdate">Date:</label></th>
								<td><input type = "date"  name = "newdate" required = "required" value="<?php echo $date; ?>" /></td>
							</tr>
							
							<tr>
								<th><label for = "newquantity">Add new copies of books:</label></th>
								<td><input type = "number" name = "newquantity" required = "required" value = "0" min = "0" max = "40"></td>
							</tr>
							
							<tr>
							<th><label for = "image"> Image of the book: </label></th>
								<td><input type="file" name="image" id = "image"></td>
							</tr>
							
							<tr>
								<td></td>
								<td><?php echo "<img src=get_book_image.php?id=". $BookID .">"; ?><br/>
								</td>
								
							</tr>
							
						</tbody>
					</table>
			</form>
		</div>
		
		<div id = "remove_book_container">
			<form  id = "remove_book_form" action="<?php echo "process_remove_book.php?id={$booknum}"; ?>" method = "post">
				<table cellspacing="5">
				
					<tr>
						<td>
							<select name = "removeoption">
								<option value="1">Remove all Available Copies</option>
								<option value="0" selected>Number of book copies to remove: </option>
							</select>
						</td>
						<td><input type = "number"  name = "removenum" value="0" min = "0" max = "<?php echo $avail; ?>" /></td>
					</tr>
					
					<tr><tr/>
					
					<tr>
						<td><input class = "submit"  type = "submit" name = "remove" value = "Remove books" /></td>
					</tr>
					
				</table>
			</form>
		</div>
	</div>


<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>



	