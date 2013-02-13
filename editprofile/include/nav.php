<?php
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
?>
	<!--Navigation-->
	<div id="accordion">
		<h3 class = "titles">Profile<h3>
			<div class = "content">
				<p class = "links"><a href = "view_profile.php">view</a></p>
				<p class = "links"><a href = "edit_profile.php">edit</a></p>
			</div>
			
		<h3 class = "titles">Books<h3>
			<div class = "content">
				<p class = "links"><a href = "#">view</a></p>
				anong ilalagay dito?
			</div>
				
		<h3 class = "titles">Search<h3>
		<div class = "content">
			<p class = "links"><a href = "#">search</a></p>	
		</div>		
	</div>
		
	<!--JQuery for the accordion-->	
	<script>
		$( "#accordion" ).accordion();
	</script>
	
<?php 
	require_once "connection/close.php";
?>