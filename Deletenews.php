<?php

include("loginAction.php");
$servername = "localhost";
$username = "wustl_inst";
$password = "wustl_pass";
$dbname = "newsweb";
$token = $_POST['csrf'];
$csrf = $_SESSION['token'];
//check the csrf token for protection
if ($token == $csrf){
	//set the connection to our database
	$connection = new mysqli($servername, $username, $password, $dbname);
	//delete the comments first where associate with their newsID
	$sqlcomment = 'DELETE FROM comments WHERE newsID= '.$_POST['newsToDelete'].'';

	if ($connection->query($sqlcomment) == TRUE) {
    	echo "successfully";
	} else {
    	echo "Error: " . $connection->error;
	}



// then delete the news by matching the newsID
	$sqlstory = 'DELETE FROM story WHERE newsID= '.$_POST['newsToDelete'].'';

	if ($connection->query($sqlstory) == TRUE) {
    	echo "Record deleted successfully";
	} else {
    	echo "Error: " . $connection->error;
	}

	$connection->close();
//redirect to usercenter page and refresh
	header("Refresh:0; url=file.php");
	} else {
		printf("##warning, you may use a fake page to enter our website##");
		exit;
}
?>
