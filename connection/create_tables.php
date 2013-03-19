<?php

/*
		This creates the table student in the database.
		Table student holds all details about a student user.
		This includes: student number, username, password, first name,
		last name, e-mail address, college, degree, avatar url, status
		and penalties
	*/
	$student_table = "create table student(
		studnum varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci primary key,
		username varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		password varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		fname varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		lname varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		email varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
		college varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
		degree varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
		imagename varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'defpic.jpg',
		imagefile blob,
		canborrow TINYINT( 1 ) NOT NULL DEFAULT  '1',
		penalties int(64) not null default '0'
	)";
	
	/*
		This creates the table admin in the database.
		Table admin holds all details about an admin user.
		This include: admin id, username and password
	*/
	$admin_table = "create table admin(
		id int(64) primary key auto_increment,
		username varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		password varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null
	)";
	
	/*
		This creates the table requests in the database
		Table requests tracks all accounts that registered to the system.
		Accounts existing in this table are hold for further admin action
	*/
	$requests_table = "create table requests(
		studnum varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci primary key ,
		username varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		password varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		fname varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		lname varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci not null,		
		email varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci
	)";
	
	/*
		This creates the table book in the database
		Table book holds all details about a book.
		This include: book ID (the unique identification of the book in the
		database), book number (can also be referred to as call number), author,
		title, publication date, status, imgae url, student number of the current
		borrower
	*/
	$book_table = "create table book(
		BookID int(64) primary key auto_increment,
		booknum varchar(64)  CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		author varchar(64)  CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		title varchar(64)  CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		pub_date varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		status tinyint(1) not null,
		imagename varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'book1.jpg',
		imagefile blob,
		studnum varchar(64)  CHARACTER SET utf8 COLLATE utf8_general_ci,
        adminID int(64),
		foreign key(studnum) references student(studnum),
		foreign key(adminID) references admin(id)
	)";
	
	/*
		This creates the table borrow in the database
		Table borrow holds the details of book currently being borrowed.
		This include: borrow number (primary identification of the transaction),
		borrow date, due date, student number of the borrower, book number of the borrowed book
	*/
	$borrow_table = "create table borrow(
		borrow_num int(1) primary key auto_increment,
		borrow_date date not null,
		due_date date not null,
		stdnum varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
		bknum int(64) not null,
		foreign key(stdnum) references student(studnum),
		foreign key(bknum) references book(BookID)
	)";
	
	/*
		This creates the table reservation in the database
		Table reservation holds the details of book currently being reserved.
		This include: reservation number (primary identification of the transaction),
		reservation date, expiration date, student number of the borrower,
		book number of the reserved book
	*/
	$reservation_table = "create table reservation(
		reservation_num int(1) primary key auto_increment,
		reservation_date date not null,
		expiration_date date not null,
		stdnum varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci,
		bknum int(64) not null,
		foreign key(stdnum) references student(studnum),
		foreign key(bknum) references book(BookID)
	)";
	
	/*
		queries executed in the database
	*/
	$query3 = mysql_query($student_table,$con);
	$query4 = mysql_query($admin_table,$con);
	$query5 = mysql_query($requests_table,$con);
	$query6 = mysql_query($book_table,$con);
	$query7 = mysql_query($borrow_table,$con);
	$query8 = mysql_query($reservation_table,$con);
	
?>