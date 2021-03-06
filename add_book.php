<?php
	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: admin_login.php");
	}
	require_once "include/admin_header.php";
?>

	<section id = "greetings">
		<article>
			<?php
				echo "Welcome, <em><a href = \"admin_home.php\" id = \"uname\">{$_SESSION['uname']}</a></em> ! 	| 	<a href = \"signout.php\">Sign Out</a>";
			?>
		</article>
	</section><br/>
	
	<section id = "search_tab">
		<article>
			<form name = "add_book" action = "process_add_book.php" method = "post" enctype = "multipart/form-data">
				<label for = "booknum">Book number:</label>
				<input type = "text" name = "booknum" required = "required" /><br/><br/>
				
				<label for = "author">Author:</label>
				<input type = "text" name = "author" required = "required"/><br/><br/>
				
				<label for = "title">Title:</label>
				<input type = "text" name = "title" required = "required"/><br/><br/>
				
				<label for = "pub_date">Publication date:</label>
				<input type = "date" name = "pub_date" required = "required"/><br/><br/>
				
				<label for = "quantity">Quantity:</label>
				<input type = "number" name = "quantity" max = '20' /><br/><br/>
			
				<label for = "image_file"> Image of the book: </label><br/>
				<input type = "file" name = "image" /><br/><br/>
				
				<input type = "submit" value = "Add book" />
				
			</form>
		</article>
	</section>
	
	<section id = "nav">
		<?php
			require_once "include/admin_nav.php";
		?>
	</section>
	
	
<?php
	require_once "include/admin_footer.php";
	require_once "connection/close.php";
?>
