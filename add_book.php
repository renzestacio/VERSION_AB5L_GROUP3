<?php
	session_start();
	if(!isset($_SESSION['uname'])){
		header("Location: admin_login.php");
	}
	require_once "include/admin_header.php";
	require_once "include/admin_nav.php";

	/*
		this indicates whether a recently added book
		has been successful or not
	*/
	$success = -1;
	
	if(!isset($_GET['success'])){
		$success = -1;
	}
	else if($_GET['success'] == 1){
		$success = 1;
	}
	else if($_GET['success'] == 0){
		$success = 0;
	}
?>

	<div id = "site_content">
		<div id = "prompt_add_book">
		<aside>
			<?php
				/*
						when process_add_book.php sends a value of 1, it indicates a successful transaction
					else, the value 0 indicates a failure in addition of book
				*/
				if($success == 1){
					echo "Book succesfully added!";
				}
				else if($success == 0){
					echo "Book not succesfully added!";
				}
			?>
		</aside><br/>
	</div>
		<div id = "add_book_container">
			<form id = "add_book_form" action = "process_add_book.php" method = "post" enctype = "multipart/form-data">
				
					<h4>Add Books</h4>
					
					<table cellspacing = "9">
						<tfoot>
							<tr>
								<td></td>
								<td><input class = "submit" type = "submit" value = "Add book" /></td>
							</tr>
						</tfoot>
						
						<tbody>
							<tr>
								<th><label for = "booknum">Book number:</label></th>
								<td><input type = "text" name = "booknum" required = "required" /></td>
							</tr>
							
							<tr>
								<th><label for = "author">Author:</label></th>
								<td><input type = "text" name = "author" required = "required"/></td>
							</tr>
							
							<tr>
								<th><label for = "title">Title:</label></th>
								<td><input type = "text" name = "title" required = "required"/></td>
							</tr>
							
							<tr>
								<th><label for = "pub_date">Publication date:</label></th>
								<td><input type = "date" name = "pub_date" required = "required"/></td>
							</tr>
							
							<tr>
								<th><label for = "quantity">Quantity:</label></th>
								<td><input type = "number" name = "quantity" max = '20' min = '1'/></td>
							</tr>
							<tr>
							<th><label for = "image_file"> Image of the book: </label></th>
								<td><input type = "file" name = "image" height = '150px' width = '180px'/></td>
							</tr>
						</tbody>
					</table>
			</form>
		</div>
	</div>
	
	
	
<?php
	require_once "include/footer.php";
?>