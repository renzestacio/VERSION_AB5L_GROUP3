<?php
	require_once "include/header.php";
	require_once "connection/connect.php";
	require_once "connection/create_db.php";
	require_once "connection/use_db.php";
		$student_table = "create table student(
		studnum varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci primary key,
		username varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		password varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		fname varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		lname varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		email varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
		college varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
		degree varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
		imagename varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
		imagefile blob,
		canborrow TINYINT( 1 ) NOT NULL DEFAULT  '1'
	)";
	
	$admin_table = "create table admin(
		id int(64) primary key auto_increment,
		username varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		password varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null
	)";
	
	$requests_table = "create table requests(
		studnum varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci primary key ,
		username varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		password varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		fname varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		lname varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,		
		email varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci
	)";
	
	$book_table = "create table book(
		BookID int(64) primary key auto_increment,
		booknum varchar(64)  CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		author varchar(64)  CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		title varchar(64)  CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		pub_date varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		status tinyint(1) not null,
		imagename varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
		imagefile blob,
		studnum varchar(64)  CHARACTER SET utf8 COLLATE utf8_general_ci,
        adminID int(64),
		foreign key(studnum) references student(studnum),
		foreign key(adminID) references admin(id)
	)";
	
	$borrow_table = "create table borrow(
		borrow_date date primary key,
		due_date date not null
	)";
	
	$reservation_table = "create table reservation(
		reservation_date date primary key,
		expiration_date date not null
	)";
	
	
	$query3 = mysql_query($student_table,$con);
	$query4 = mysql_query($admin_table,$con);
	$query5 = mysql_query($requests_table,$con);
	$query6 = mysql_query($book_table,$con);
	$query7 = mysql_query($borrow_table,$con);
	$query8 = mysql_query($reservation_table,$con);
?>
	<!--kailangang mag mukhang book shelf itong page na ito-->
	<div id= "abc">
	<section id = "left_side">
		<img src="Athenaeum_Shelf.jpg" id="SHELF" alt="The Athenaeum"/>
	</section>
	
	<section id = "first_row">
		<article id = "search">
			<form action = "" method = "post">
				<input type = "text" name = "search" size="46" />
				<input type = "submit" value = "Search book"/>
			</form>
		</article>
	</section>
	
	<section id = "second_row">
		<article id = "register">
			<a href = "register.php"> Sign Up </a>
		</article>
		<article id = "login">
			<a href = "login.php"> Log In </a>
		</article>
	</section>
	
	<section id = "third_row">
		Anong magandang ilagay dito?<hr/>
		<p>Initial CSS pa lang to. Saka basic layout din. Gumagana na yung Sign Up, Log in at Sign out for both admin and student.
		Hindi pa nga lang ganun kaayos yung sign up dahil diba kailangang may request munang matatanggap ang admin bago pa 
		lang maapprove yung guest. <hr/> Ipopulate niyo muna nga pala yung tables. Ang meron pa lang ay yung sa user at student.
		<hr/><strong> Tignan niyo na lang yung phpMyAdmin() sa wamp. May library na database dyan sa left side. Yan yung pinagalan ko dun para sa sample database.</strong>
		Kayo nang bahala magexplore ^_^
		</p>
	</section>
	</div>
	
	
<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>
