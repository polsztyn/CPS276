<?php
/* WRITE THE NECESSARY PHP CODE HERE.  YOU WILL NEED TO RETURN AN ARRAY THAT CONTAINS TWO INDEXES. FIRST INDEX IS A PLACE FOR A MESSAGE (MAYBE BLANK OR NOT DEPENDING ON THE SITUATION) AND THE OTHER IS THE FORM OR THE TABLE DISPLAYING THE DATA (SEE $RESULT VARIABLE BELOW). */
if(isset($_GET)){
	if( isset($_GET['page']) && $_GET['page'] === "form"){
		//CODE GOES HERE TO REQUIRE THE FORM.PHP PAGE AND CALL WHATEVER METHOD YOU WROTE
		// A get has been posted with parameter page = "form"
		require_once('php/form.php');
		$result = init();
	}
	else if(isset($_GET['page']) && $_GET['page'] === "display"){
		//CODE GOES HERE TO REQUIRE THE DISPLAYRECORDS.PHP PAGE AND CALL WHATEVER METHOD YOU WROTE
		// A GET has been requested with parameter page = "display"
		require_once('php/displayRecords.php');
		$result= initFormDisplay();
	}
	else {
		//HEADER REDIRECT HERE
		// A GET has been requested without parameter page = "display" or "form" being set to 
		
		/*
		require_once('php/form.php');
		$result = init();
		*/
		header("Location: http://178.128.157.194/CPS276_REPOSITORY/assignments/assignment_final/index.php?page=form");
	    //header("Location: http://178.128.157.194/CPS276_REPOSITORY/assignments/assignment_final/index.php?page=form",true,301);
	}
}
else {
	//HEADER REDIRECT HERE
	// This is where a post would land.

	header("Location: http://178.128.157.194/CPS276_REPOSITORY/assignments/assignment_final/index.php?page=form");
	// is this a post from the dataEntry form?
	/*
	if(isset($_POST['submit'])){

		// is this a post from the dispalyData form?
		require_once('php/form.php');
		$result = init();
	}
	else  {
		require_once('php/displayRecords.php');
		$result= initFormDisplay();
	}	
	*/
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Final Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
			.error {
				color: red;
				margin-left: 5px;
			}
			.space {
				margin-right: 30px;
			}
			nav ul li {
				list-style: none;
			}
			input[type=submit]{
				margin: 10px 0;
			}
			</style>
	</head>

	<body class="container">
		<nav>
			<ul>
				<li><a href="index.php?page=form">Add Contact Information</a></li>
				<li><a href="index.php?page=display">Display All Contacts Information</a></li>
			</ul>
		</nav>
		
		<?php
			echo $result[0]; 
			echo $result[1]; 
		?>
	</body>
</html> 