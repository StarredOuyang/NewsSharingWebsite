<?php
include("loginAction.php");
//set the connection to our database
$servername = "localhost";
$username = "wustl_inst";
$password = "wustl_pass";
$databasename = "newsweb";
$token = $_POST['csrf'];
$csrf = $_SESSION['token'];
//check the csrf token for protection
if ($token == $csrf){
	$connection = new mysqli($servername, $username, $password, $databasename);
//delete the records where match the commentsID
	$sql = "DELETE FROM comments WHERE commentsID= '".$_POST['comToDelete']."'";

	if ($connection->query($sql) == TRUE) {
    	echo "successfully";
	} else {
    	echo "There's a error" . $connection->error;
	}

	$connection->close();
//redirect to usercenter page and refresh
	header("Refresh:0; url=file.php");
} else {
	printf("##warning, you may use a fake page to enter our website##");
	exit;
}
?>
