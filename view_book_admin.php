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
	
	<div id = "site_content">
		<div id="prompt_view_book">
			<aside>
				<?php
					if($success == 1) echo "Update successful!";
					else if($success == 0) echo "Update not successful";
					else if($success == 2) echo "Copies successfully removed!";
					else if($success == 2) echo "Copies not successfully removed!";
				?>
			</aside>
		</div>
		<div id = "book_image">
			<table>
				<tr>
					<?php
						$query = "select * from book where booknum = '$_GET[id]'";
						$query2 = "select * from book where booknum = '$_GET[id]'";	
						$result = mysql_query($query, $con);
						$result2 = mysql_query($query2, $con);
						echo"<td>";
							while($row2 = mysql_fetch_assoc($result2)){
								echo "<img id = \"book_image\"src=get_book_image.php?id=". $row2['BookID'] .">";
								break;
							}
						echo"</td>";
					?>
				</tr>
		</table>
		</div>
		
		<div id="admin_books">
		<ul>
			<li><a href="#binfo"><span>Book Info</span></a></li>
			<li><a href="#blist"><span>Book Borrowers</span></a></li>
		</ul>
		
		<div id="binfo">
	
	<!--<div id = "book_info">-->
		<table cellspacing = "12">
			<tbody>
				<?php
					/*
						The following query retrieves all the information of the
						currently logged user from the database
					*/
					while($row = mysql_fetch_assoc($result)){
						echo"<tr>";
							echo "<td><strong>Book Number: </strong></td>";
							echo "<td>{$row['booknum']}</td>";
						echo"</tr>";
						
						echo"<tr>";
							echo "<td><strong>Author: </strong></td>";
							echo "<td>{$row['author']}</td><td></td><td></td>";
							
							echo "<td><strong>Quantity</strong></td>";
							/*
								The following query is used to retrieved all
								instances of the selected book. It is then counted by the
								variable $avail
							*/
							$compute = "select * from book where booknum='$row[booknum]'";
							$tempres = mysql_query($compute, $con);
							$quantity = 0;
							while($temp = mysql_fetch_assoc($tempres)){
								$quantity+=1;
							}
							echo "<td>{$quantity}</td>";
						echo"</tr>";
						
						echo"<tr>";
							echo "<td><strong>Title: </strong></td>";
							echo "<td>{$row['title']}</td><td></td><td></td>";
							echo "<td><strong>Available</strong></td>";
							/*
								The following query is used to retrieved currently available
								instances of the selected book. It is then counted by the
								variable $avail
							*/
							$compute =  "select * from book where booknum='$row[booknum]' and studnum IS NULL";
							$tempres = mysql_query($compute, $con);
							$avail = 0;
							while($temp = mysql_fetch_assoc($tempres)){
								$avail+=1;
							}
							echo "<td>{$avail}</td>";
						echo"</tr>";
						
						
						echo"<tr>";
							echo "<td><strong>Publish date: </strong></td>";
							echo "<td>{$row['pub_date']}</td>";
						echo"</tr>";
						
						echo"<tr>";
							echo "<td><p><a href = \"edit_book.php?id={$row['booknum']}\">Edit</a></p></td>";
						echo"</tr>";
						break;
					}	
				?>
			</tbody>
		</table>
		</div>
		<div id = "blist">
		<?php
		echo "<div id=borrowers>";
			echo "<table>";
			/*
				The following query is used to retrieved current
				borrowers of the selected book. It is determined
				using student number of the student which is a
				foreign key of the entity book
			*/
			echo "<tbody>";
			$currentStudnum = 0;
			$compute = "select * from book where booknum='$row[booknum]' and studnum IS NOT NULL order by studnum";
			$tempres = mysql_query($compute, $con);
				while($temp = mysql_fetch_assoc($tempres)){
					
					while($currentStudnum != $temp['studnum']){
						echo "<tr><td width=100>";
						
						echo "<td><a href = \"view_search_profile.php?id={$temp['studnum']}\">{$temp['studnum']}</a>";
						echo "</td><td width=200>";
						
						$name = "select * from student where studnum = '$temp[studnum]'";
						$namequery = mysql_query($name,$con);
						while($namerow = mysql_fetch_assoc($namequery)){
							echo $namerow['username']."</td><td>";
							echo $namerow['email']."</td></tr>";
						}
						$currentStudnum = $temp['studnum'];
					}
				}
			echo "</tbody>";
			echo "</table>";
		echo "</div>";
		?>
	</div>
	</div>
	<script>
		$( "#admin_books" ).tabs();
	</script>
	<br/><br/>
	<br/><br/>
<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>