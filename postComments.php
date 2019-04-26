<?php
include("loginAction.php");
//check the user session value, if empty, display the warning
if (empty($_SESSION['login_user'])){
        header("Location: postfailure.html");
}else{
$user = $_SESSION['login_user'];
$comment = $_POST['newcomments'];
$storykey = $_POST['storykey'];
$token = $_POST['csrf'];
$csrf = $_SESSION['token'];
//check the csrf token for protection
if ($token == $csrf){
	require 'database.php';
//get the username, comment and storykey and insert into database
	$stmt = $mysqli->prepare("insert into comments (username, newsID, comment) values (?, ?, ?)");
        if(!$stmt){
	          printf("Query Prep Failed: %s\n", $mysqli->error);
	          exit;
        }
 
        $stmt->bind_param('sss', $user, $storykey, $comment);
 
        $stmt->execute();
 
        $stmt->close();
        
        header("Refresh:0; url=frontpage.php");	 
        exit;
	} else {
	
	printf("##warning, you may use a fake page to enter our website##");
	exit;
	}
}

?>
