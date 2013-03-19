<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	require_once "include/checkSession.php";
	require_once "include/admin_header.php";
	require_once "include/admin_nav.php";
	
	/*
		The following queries are used to retrieve
		information of the currently selected book
		from the database
	*/
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	$id = mysql_escape_string($_REQUEST['id']);
	
	/*
		This query counts how many books
		the user has already borrowed
	*/
	$bookCount = 0;
	$countQuery = "select * from borrow where stdnum='$id'";
	$countResult = mysql_query($countQuery,$con);
	while($countRow = mysql_fetch_assoc($countResult)){
		$bookCount++;
	}
	
	$query = "select * from student where studnum = '$id'";
	$result = mysql_query($query, $con);
	/*
		Information of the student are retrieved from the database
		and are stored in variables
	*/
	while($row = mysql_fetch_assoc($result)){
		$uname = $row['username'];
		$fname = $row['fname'];
		$lname = $row['lname'];
		$email = $row['email'];
		$hasImage = $row['imagefile'];
		$degree = $row['degree'];
		$college = $row['college'];
		break;
	}
?>

	<div id = "avatar">
		<table>
			<tr>
				<?php
					if(isset($hasImage)){
						echo "<img src=get.php?id=". $uname .">";
					}else{
						echo "No Avatar Image";
					}
				?>
			</tr>
		</table>
	</div>
	
	<div id = "student_info_admin_side">
		<table>
			<tbody>
				<?php
					echo"<tr>";
						echo "<td><strong>Student Number</strong></td>";
						echo "<td>{$id}</td>";
					echo"</tr>";
					
					echo"<tr>";
						echo "<td><strong>Username</strong></td>";
						echo "<td>{$uname}</td>";
					echo"</tr>";
					
					echo"<tr>";
						echo "<td><strong>Name</strong></td>";
						echo "<td>{$fname} {$lname}</td>";
					echo"</tr>";
					
					echo"<tr>";
						echo "<td><strong>Email Address</strong></td>";
						echo "<td>{$email}</td>";
					echo"</tr>";
					
					echo"<tr>";
						echo "<td><strong>College</strong></td>";
						echo "<td>{$college}</td>";
					echo"</tr>";
					
					echo"<tr>";
						echo "<td><strong>Degree</strong></td>";
						echo "<td>{$degree}</td>";
					echo"</tr>";
				?>
			</tbody>
		</table>
	</div>
	
	<br/>
	
	<div id="student_books">
		<ul>
			<li><a href="#reserved"><span>Reserved Books</span></a></li>
			<li><a href="#borrowed"><span>Borrowed Books</span></a></li>
		</ul>
		
		<div id="borrowed">
			<table cellpadding = "5">
				<thead>
					<tr>
						<th>Title</th>
						<th>Borrow Date</th>
						<th>Due Date</th>
						<th>Return?</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$bookquery = "select * from borrow where stdnum = '{$id}' ";
						$bookresult = mysql_query($bookquery, $con);
						while($bookrow = mysql_fetch_assoc($bookresult)){
							$bid = $bookrow['bknum'];
							$newQuery = "select * from book where BookID = '{$bid}'";
							$newBookResult = mysql_query($newQuery,$con);
							while($row = mysql_fetch_assoc($newBookResult)){
								echo "<tr>";
									echo "<td>{$row['title']}</td>";
									$bknum = $row['BookID'];
			
									$dateQuery = "select * from borrow where bknum = {$bknum}";
									$dateResult = mysql_query($dateQuery,$con);
									while($daterow = mysql_fetch_assoc($dateResult)){
										$dueDate = $daterow['due_date'];
										$borrowDate = $daterow['borrow_date'];
										echo "<td>{$borrowDate}</td>";
										echo "<td>{$dueDate}</td>";
									}
									
									/*
										an option "return" links to a php file that removes the selected book
										from the table borrow and update the status of the book
									*/
									echo "<td><a href = \"process_return.php?BookID=".$row['BookID']."\">Return</a></td>";
									
								echo "</tr>";
							}
						}
					?>
				</tbody>
				
			</table>
		</div>
		
		<div id="reserved">
			<table cellpadding = "5">
				<thead>
					<tr>
						<th>Title</th>
						<th>Expiration Date</th>
						<th>Borrow?</th>
					</tr>
				</thead>
				<tbody>
					<?php
						/*
							the following queries are used to retrieve all information
							of the reservations of the currently logged user
						*/
						$bookquery = "select * from reservation where stdnum = '{$id}' ";
						$bookresult = mysql_query($bookquery, $con);
						while($bookrow = mysql_fetch_assoc($bookresult)){
							$bid = $bookrow['bknum'];
							$newQuery = "select * from book where BookID = {$bid}";
							$newBookResult = mysql_query($newQuery,$con);
							while($row = mysql_fetch_assoc($newBookResult)){
								echo "<tr>";
									/*Title of the book is a link to view_book_student.php page*/
									echo "<td>{$row['title']}</td>";
									echo "<td>";
										$bknum = $row['BookID'];
										/*The following query retrieves the expiration date of the book reserved*/
										$dateQuery = "select * from reservation where bknum = $bknum";
										$dateResult = mysql_query($dateQuery,$con);
										while($daterow = mysql_fetch_assoc($dateResult)){
											$dueDate = $daterow['expiration_date'];
											echo "{$dueDate}";
										}
									echo "</td>";
									/*
										an option "borrow" links to a php file that transfer a reservation
										enrty to borrow and removes the reservation. It is only available when
										the student has not yet borrowed at most 5 books
									*/
									if($bookCount < 5)
										echo "<td><a class = \"admin_side\" href=\"process_borrow.php?BookID=" . $row['BookID'] . "\"> Borrow </a></td>";
									else
										echo "<td>Reached Borrowing Limit</td>";
								echo "</tr>";
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
 
	<script>
		$( "#student_books" ).tabs();
	</script>
	<br/>
	<br/>
<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>