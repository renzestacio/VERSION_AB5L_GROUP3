<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	/*
		admins can only access the system when successfully logged in
	*/
	require_once "include/checkSession.php";
	require_once "include/admin_header.php";
	require_once "include/admin_nav.php";
?>

	<div id="site_content">
		
		<div id="book_trivia_container">
			<div id="home-content-slider">
			<div id="home_slider">
					<div id="home_mask">
						<ul>
							<li id="first" class="firstanimation">
								<a href="#">
							<img src="images/dyk/dyk6.jpg" alt="Library of Congress"/>
							</a>
								<div class="tooltip">
							<h1>Largest Library</h1>
							</div>
						</li>

						<li id="second" class="secondanimation">
							<a href="#">
								<img src="images/dyk/dyk2.jpg" alt="Longest Novel"/>
							</a>
							<div class="tooltip">
								<h1>Longest Novel</h1>
							</div>
						</li>
						
						<li id="third" class="thirdanimation">
							<a href="#">
								<img src="images/dyk/dyk11.jpg" alt="Charles Dickens"/>
							</a>
							<div class="tooltip">
								<h1>Think North!</h1>
							</div>
						</li>
									
						<li id="fourth" class="fourthanimation">
							<a href="#">
								<img src="images/dyk/dyk4.jpg" alt="War and Peace"/>
							</a>
							<div class="tooltip">
								<h1>'Coz seven times is enough!</h1>
							</div>
						</li>
										
							<li id="fifth" class="fifthanimation">
								<a href="#">
									<img src="images/dyk/dyk9.jpg" alt="The Bible"/>
								</a>
								<div class="tooltip">
									<h1>The Bible</h1>
								</div>
							</li>
						</ul>
					</div>
				<div class="progress-bar"></div>
			</div>
		</div>
		</div>
		<?php require_once "include/sidebar.php";?>
	</div>
	
	
<?php
	require_once "include/footer.php";
?>