<?php
	/*
		a currently logged-in user should not be redirected to this page
		he/she must be redirected to home.php when accessing this page
	*/
	session_start();
	
	if(isset($_SESSION['uname'])){
		require_once "connection/connect.php";
		require_once "connection/use_db.php";
		$uname = mysql_real_escape_string($_SESSION['uname']);	/*cleans the string for query*/
		
		$query = "select username from student where username like '{$uname}' ";	
		$result = mysql_query($query, $con);
		
		if(mysql_num_rows($result) != 0){
			header("Location: home.php");
		}
	}
	//var_dump($_SESSION);
	require_once "include/header.php";
	
	require_once "connection/connect.php";
	require_once "connection/create_db.php";
	require_once "connection/use_db.php";
	require_once "connection/create_tables.php";
	
?>
	
	<h2 class="welcome" > Welcome! </h2>
	
	<div id="site_content">
		<!-- left side of the site_content div -->
		<div id="index_left_container">
			<?php
				require_once "include/search_book_guest.php";
			?>
		</div>
		
	<div class="container">
		<div id="content-slider">
			<div id="slider">
					<div id="mask">
						<ul>
							<li id="first" class="firstanimation">
								<a href="#">
							<img src="images/dyk/dyk1.jpg" alt="Shakespeare"/>
							</a>
								<div class="tooltip">
							<h1>Shakespeare "worded" it!</h1>
							</div>
						</li>

						<li id="second" class="secondanimation">
							<a href="#">
								<img src="images/dyk/dyk2.jpg" alt="Lions"/>
							</a>
							<div class="tooltip">
								<h1>Longest Novel</h1>
							</div>
						</li>
						
						<li id="third" class="thirdanimation">
							<a href="#">
								<img src="images/dyk/dyk3.jpg" alt="Snowalker"/>
							</a>
							<div class="tooltip">
								<h1>Bob Ong is 2nd place!</h1>
							</div>
						</li>
									
						<li id="fourth" class="fourthanimation">
							<a href="#">
								<img src="images/dyk/dyk4.jpg" alt="Howling"/>
							</a>
							<div class="tooltip">
								<h1>Seven times is enough!</h1>
							</div>
						</li>
										
							<li id="fifth" class="fifthanimation">
								<a href="#">
									<img src="images/dyk/dyk5.jpg" alt="Sunbathing"/>
								</a>
								<div class="tooltip">
									<h1>The Task is Expensive!</h1>
								</div>
							</li>
						</ul>
					</div>
				<div class="progress-bar"></div>
			</div>
		</div>
	</div>
		
		<!-- right side of the site_content div -->
		<div id="index_right_login">
			<!-- Log In -->
			<?php
				require_once "login.php";
			?>
		</div>
		
		<div id="index_right_signup">
			<!-- Log In -->
			<?php
				require_once "signup.php";
			?>
		</div>
		
	</div>
	
	
<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>
