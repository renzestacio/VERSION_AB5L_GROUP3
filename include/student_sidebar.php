<div id="sidebar_container">
	

	<div id="sidebar">
		<form id = "sidebar_search_form" action="search_book_student_result.php" method="post">
			<fieldset>
				<legend>Search Book</legend>
				<table cellspacing= "15px">
				
					<tr>
						<td><label for = "Title">Title: </label></td>
						<td><input type="text" name="title" pattern=".*[A-z ]*.*" /></td>
					</tr>
					<tr>
						<td><label for = "Author">Author: </label></td>
						<td><input type="text" name="author" pattern=".*[A-z ]*.*" /></td>
					</tr>
					
					<tr>
						<td></td>
						<td><input class = "submit" type="submit" value="Search"></td>
					</tr>
					
				</table>
			</fieldset>
		</form>
	</div>

</div>

