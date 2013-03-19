<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	require_once "include/checkSession.php";

	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	require_once "include/admin_header.php";
	require_once "include/admin_nav.php";
?>
	
	<div id="site_content">
		<div id = "user_requests_container">
			<table cellpadding = "5px" width = "100%">
				<thead>
					<tr>
						<th>Book Number</th>
						<th>Title</th>
						<th>Author</th>
						<th>Quantity</th>
						<th>Available</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$search = $_POST['search'];
						if($search == ""){
							$query = "select * from book order by title";
						}
						else{
							$query = "select * from book where title like '%$search%' or author like '%$search%' order by title";
						}
						
						$current_booknum = "a";
						$result = mysql_query($query,$con);
						while($row = mysql_fetch_assoc($result)){
							while($current_booknum != $row['booknum']){
								echo "<tr><td align=\"center\">";
								echo $row['booknum'];
								echo "</td><td align=\"center\">";
								/*
									Title of the book is a link to view_book_admin.php page
								*/
								echo "<a href=\"view_book_admin.php?id=" . $row['booknum'] . "\">{$row['title']}</a>";
								echo "</td><td align=\"center\">";
								echo $row['author'];
								echo "</td><td align=\"center\">";
								
								/*
									The following query is used to retrieved all instance of the book.
									Results are counted by the variable $avail
								*/
								$compute = "select * from book where booknum='$row[booknum]'";
								$tempres = mysql_query($compute, $con);
								$quantity = 0;
								while($temp = mysql_fetch_assoc($tempres)){
									$quantity+=1;
								}
								echo $quantity;

								echo "</td>";
								echo "</td><td align=\"center\">";
								
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
								echo $avail;
								
								echo "</td>";
								echo "<td align=\"center\"><a href = \"edit_book.php?id={$row['title']}\">Edit</a></td>";				
								echo "</td></tr>";
								
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