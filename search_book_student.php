<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	/*
		admins can only access the system when successfully logged in
	*/

	require_once "include/checkSession.php";
	require_once "include/header.php";
	require_once "include/student_nav.php";
?>

	<br/>
	<div id="site_content">
		<div id = "search_book_student_container">
			<form id = "search_book_student_form" action="search_book_student_result.php" method="post">
				
				<table cellspacing= "15px">
				<tr>
					<td><label for = "Title">Title: </label></td>
					<td><input type="text" name="title" pattern=".*[A-z0-9 ]*.*" /></td>
				</tr>
				<tr>
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
		
		<div id = "slider_container">
			<div id="search-content-slider">
			<div id="search_slider">
					<div id="search_mask">
						<ul>
							<li id="first" class="firstanimation">
								<a href="#">
							<img src="images/dyk/dyk8.jpg" alt="Da Vinci"/>
							</a>
								<div class="tooltip">
							<h1>Gates and Da Vinci</h1>
							</div>
						</li>

						<li id="second" class="secondanimation">
							<a href="#">
								<img src="images/dyk/dyk5.jpg" alt="The Task"/>
							</a>
							<div class="tooltip">
								<h1>The Task is Expensive!</h1>
							</div>
						</li>
						
						<li id="third" class="thirdanimation">
							<a href="#">
								<img src="images/dyk/dyk7.jpg" alt="Tom Sawyer"/>
							</a>
							<div class="tooltip">
								<h1>Typewriter and Tom</h1>
							</div>
						</li>
									
						<li id="fourth" class="fourthanimation">
							<a href="#">
								<img src="images/dyk/dyk4.jpg" alt="Howling"/>
							</a>
							<div class="tooltip">
								<h1>Seven is enough!</h1>
							</div>
						</li>
										
							<li id="fifth" class="fifthanimation">
								<a href="#">
									<img src="images/dyk/dyk10.jpg" alt="Klencke Atlas"/>
								</a>
								<div class="tooltip">
									<h1>Largest Book</h1>
								</div>
							</li>
						</ul>
					</div>
				<div class="progress-bar"></div>
			</div>
		</div>
		</div>
		
	</div>
	
	
<?php
	require_once "include/footer.php";
?>