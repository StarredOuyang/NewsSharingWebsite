<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<link href="base.css" type="text/css" rel="stylesheet" />
<title>Update news</title>

</head>
<body><div id="main">
 
<h1>Let us update your news</h1><br><br>

<?php
include("loginAction.php");
require 'database.php';
$token = $_POST['csrf'];
$csrf = $_SESSION['token'];
//check the csrf token for protection
if ($token == $csrf){
//select the news from table
	$stmt = $mysqli->prepare("select title, news, link from story where newsID=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
 
	$stmt->bind_param('i', $_POST['newsToEdit']);
 
	$stmt->execute();
 
	$stmt->bind_result($title, $news, $link);

	while($stmt->fetch()){
//print the original news to a textarea and link in a textfield, users could edit them.	
		echo"<form name='input' action='editnews2.php' method='post'>
		<label for='updatenewslinkinput'>News Title</label>
		<textarea rows='1' name='updatenewstitle' id='updatenewstitleinput'>$title</textarea><br>
		<textarea cols='40' rows='5' name='updatestory'>$news</textarea><br>
		<input type='hidden' name='csrf' value=".$csrf.">
		<label for='updatenewslinkinput'>News Link</label>
		<input type='text' name='updatenewslink' id='updatenewslinkinput' value=".$link." ><br>
		<input type=\"hidden\" name=\"newsToEdit\" readOnly=\"true\" value=".$_POST['newsToEdit']." >
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
