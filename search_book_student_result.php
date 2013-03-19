<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	require_once "include/checkSession.php";
	require_once "include/header.php";
	require_once "include/student_nav.php";
	
	$studnum = $_SESSION['studnum'];
	$bookCount = 0;
	
	/*
		The following queries count the number of books
		the student has borrowed and reserved
	*/
	$countQuery = "select * from reservation where stdnum='$studnum'";
	$countResult = mysql_query($countQuery,$con);
	while($countRow=mysql_fetch_assoc($countResult)){
		$bookCount++;
	}
	$countQuery = "select * from borrow where stdnum='$studnum'";
	$countResult = mysql_query($countQuery,$con);
	while($countRow=mysql_fetch_assoc($countResult)){
		$bookCount++;
	}
	
	$title_filter = mysql_real_escape_string($_POST['title']);
	$author_filter =mysql_real_escape_string( $_POST['author']);
		
		/*
			filters are blank, therefore, all result will be shown
		*/
		if($title_filter == "" && $author_filter == ""){
			$query = "select * from book order by title";
		}
		/*
			filters that are not blank will serve as a constraint for the search query
		*/
		else{
			if($title_filter != "" && $author_filter == ""){
				$query = "select * from book where title like '%$title_filter%' order by booknum";
			}
			else if($title_filter == "" && $author_filter != ""){
				$query = "select * from book where author like '%$author_filter%' order by booknum";
			}
			else if($title_filter != "" && $author_filter != ""){
				$query = "select * from book where title like '%$title_filter%' and author like '%$author_filter%' order by booknum";
			}
		}
?>
	
	<div id="site_content">
		
		<div id = "search_book_container">
			<form class = "form_settings" action="search_book_student_result.php" method="post">
				
				<table cellspacing= "15px">
				<tr>
					<td><label for = "Title">Title: </label></td>
					<td><input type="text" name="title" pattern=".*[A-z0-9 ]*.*" /></td>
				</tr>
				
					<td><label for = "Author">Author: </label></td>
					<td><input type="text" name="author" pattern=".*[A-z0-9 ]*.*" /></td>
				</tr>
				
				<tr>
					<td></td>
					<td><input class = "submit" type="submit" value="Search"></td>
				</tr>
				</table>
			</form>
		</div>
		
		<div id = "user_requests_container">
			<table cellpadding = "5px" width = "100%">
				<thead>
					<tr>
						<th>Book Number</th>
						<th>Title</th>
						<th>Author</th>
						<th>Available</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$current_booknum = "a";
						$result = mysql_query($query,$con);
						while($row = mysql_fetch_assoc($result)){
							while($current_booknum != $row['booknum']){
								echo "<tr>";
									echo "<td>{$row['booknum']}</td>";
									/*
										Title of the book is a link to view_book_admin.php page
									*/
									echo "<td><a href=\"view_book_student.php?id=" . $row['booknum'] . "\">{$row['title']}</a></td>";
									echo "<td>{$row['author']}</td>";
									
									/*
										The following query is used to retrieved all available books.
										Results are counted by the variable $avail
									*/
									$compute = "select * from book where booknum='$row[booknum]' and studnum IS NULL";
									$tempres = mysql_query($compute, $con);
									$avail = 0;
									while($temp = mysql_fetch_assoc($tempres)){
										$avail+=1;
									}
										echo "<td>{$avail}</td>";
									
									/*
										If the status of the borrower indicates that he/she can still borrow,
										then the option "reserve" will be available, else "repent" will
										replace the option. Repent has no actions, instead, it serves as a lock
									*/
									if($_SESSION['canborrow'] == 1)
										if($avail != 0){
											if($bookCount < 10)
												echo "<td><a href = \"process_reserve.php?booknum={$row['booknum']}\"> Reserve </a></td>";
											else
												echo "<td>Reached Reservation Limit</td>";
										}else{
											echo "<td>No Book Available</td>";
										}
									else
										echo "<td>Repent</td>";
								echo "</tr>";
								
								$current_booknum = $row['booknum'];
								break;
							}
						}
					?>
				</tbody>				
			</table>
		</div>
	</div>
	

<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>