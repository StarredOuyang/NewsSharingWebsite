<?php
// connect to our newssite database
 
$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'newsweb');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>