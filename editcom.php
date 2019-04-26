<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<link href="base.css" type="text/css" rel="stylesheet" />
<title>Update news</title>

</head>
<body><div id="main">
 
<h1>Let us update your comment</h1><br><br>

<?php
include("loginAction.php");
require 'database.php';
$token = $_POST['csrf'];
$csrf = $_SESSION['token'];
//check the csrf token for protection
if ($token == $csrf){
//select the comments from table
	$stmt = $mysqli->prepare("select comment from comments where commentsID=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
 
	$stmt->bind_param('s', $_POST['comToEdit']);
 	
	$stmt->execute();
 
	$stmt->bind_result($comment);

	while($stmt->fetch()){
//print the original comments to a textfirld, users could edit it.	
		echo"<form name='input' action='editcom2.php' method='post'>
		<textarea cols='40' rows='5' name='updatecom'>$comment</textarea><br>
		<input type='hidden' name='csrf' value=".$csrf.">
		<input type=\"hidden\" name=\"comToEdit\" readOnly=\"true\" value=".$_POST['comToEdit']." >
		<input type='submit' value='Update' />
		</form>";

	}
	$stmt->close();
} else {
	printf("##warning, you may use a fake page to enter our website##");
		exit;
}
?>
</div></body>
</html>
