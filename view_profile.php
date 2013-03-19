<?php
	session_start();
	
	require_once "include/checkSession.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	require_once "include/header.php";
	require_once "include/student_nav.php";

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

	<div id = "prompt_view_profile">
		<aside>
			<?php
				/*
						when process_add_book.php sends a value of 1, it indicates a successful transaction
					else, the value 0 indicates a failure in addition of book
				*/
				if($success == 1){
					echo "Update Successful!";
				}
				else if($success == 0){
					echo "Update Failed!";
				}
			?>
		</aside><br/>
	</div>

	<div id = "avatar">
		<table>
			<tr>
				<?php
					if(isset($_SESSION['imagefile'])){
						echo "<img src=get.php?id=". $_SESSION['uname'] .">";
					}else{
						echo "<p>No Avatar Image</p>";
					}
				?>
			</tr>
		</table>
	</div>
	
	<div id = "student_info">
		<table cellspacing = "3">
			<tfoot>
					<tr><td><a href = "edit_profile.php">Edit</a></td></tr>
				</tfoot>
			<tbody>
				<?php
					/*
						The following query retrieves all the information of the
						currently logged user from the database
					*/
					$query = "select * from student where username = '{$_SESSION['uname']}'";
					$result = mysql_query($query, $con);
					while($row = mysql_fetch_assoc($result)){
						echo"<tr>";
							echo "<td><strong>Student Number</strong></td>";
							echo "<td>{$row['studnum']}</td>";
						echo"</tr>";
						
						echo"<tr>";
							echo "<td><strong>Name</strong></td>";
							echo "<td>{$row['fname']} {$row['lname']}</td>";
						echo"</tr>";
						
						echo"<tr>";
							echo "<td><strong>Email Address</strong></td>";
							echo "<td>{$row['email']}</td>";
						echo"</tr>";
						
						echo"<tr>";
							echo "<td><strong>College</strong></td>";
							echo "<td>{$row['college']}</td>";
						echo"</tr>";
						
						echo"<tr>";
							echo "<td><strong>Degree</strong></td>";
							echo "<td>{$row['degree']}</td>";
						echo"</tr>";
					}	
				?>
			</tbody>
		</table>
	</div>
	
	
	
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
						<th>Penalties</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$bookquery = "select * from borrow where stdnum = '{$_SESSION['studnum']}'";
						$bookresult = mysql_query($bookquery, $con);
						while($bookrow = mysql_fetch_assoc($bookresult)){
							$bid = $bookrow['bknum'];
							$newQuery = "select * from book where BookID = '$bid'";
							$newBookResult = mysql_query($newQuery,$con);
							while($row = mysql_fetch_assoc($newBookResult)){
								echo "<tr>";
									echo "<td><a href=\"view_book_student.php?id=" . $row['booknum'] . "\">{$row['title']}</a></td>";
									$bknum = $row['BookID'];
			
									$dateQuery = "select * from borrow where bknum = $bknum";
									$dateResult = mysql_query($dateQuery,$con);
									while($daterow = mysql_fetch_assoc($dateResult)){
										$dueDate = $daterow['due_date'];
										$borrowDate = $daterow['borrow_date'];
										echo "<td>{$borrowDate}</td>";
										echo "<td>{$dueDate}</td>";
									}
									
									/*displays information about the penalties of the user*/
									
									$pquery = "select * from book where studnum = '{$_SESSION['studnum']}'";
									$presult = mysql_query($pquery, $con);
									while($prow = mysql_fetch_assoc($presult)){
										$pid = $prow['BookID'];
										$newpQuery = "select * from borrow where bknum = '$pid'";
										$newpResult = mysql_query($newpQuery,$con);
										
										while($row = mysql_fetch_assoc($newpResult)){
											$dateQuery = "select *from borrow where bknum = $pid";
											$dateResult = mysql_query($dateQuery, $con);
											
											while($daterow = mysql_fetch_assoc($dateResult)){
												$studnum = $daterow['stdnum'];
												$dueDate = $daterow['due_date'];
												$due_date=$daterow['due_date'];
												
												$dateNow=strtotime(date("Y-m-d"));
												$due_date=strtotime($due_date);
												
												/*
													Penalties are determined by computing the difference of the
													current date and due date.
													If the borrowed book has not yet been returned after the due date,
													the borrower is penalized two pesos per day delayed.
												*/
												$penalty=$dateNow - $due_date;
												$penalty = ($penalty/86400)*2;
												if($penalty>0){
													echo "<td>{$penalty}" ." Php</td>";
												}else{
													echo "<td>No Penalty</td>";
												}
												
											}
										}
										break;
									}
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
						<th>Cancel?</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						/*
							the following queries are used to retrieve all information
							of the reservations of the currently logged user
						*/
						$bookquery = "select * from reservation where stdnum = '{$_SESSION['studnum']}'";
						$bookresult = mysql_query($bookquery, $con);
						while($bookrow = mysql_fetch_assoc($bookresult)){
							$bid = $bookrow['bknum'];
							$newQuery = "select * from book where BookID = '$bid'";
							$newBookResult = mysql_query($newQuery,$con);
							while($row = mysql_fetch_assoc($newBookResult)){
								echo "<tr>";
									/*Title of the book is a link to view_book_student.php page*/
									echo "<td><a href=\"view_book_student.php?id=" . $row['booknum'] . "\">{$row['title']}</a></td>";
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
										an option "cancel" links to a php file that removes a selected book
										from the reservation table
									*/
									echo "<td><a href=\"process_cancel_borrow.php?id=" . $row['BookID'] . "\"> Cancel </a></td>";
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
	<br/><br/>
<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>

