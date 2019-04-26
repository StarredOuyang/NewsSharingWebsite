<?php
//don't allow empty of three type of inputs
	if (empty($_POST['newstory'])){
        header("Location: newsEmpty.html");
    }
    else if (empty($_POST['newslink'])){
        header("Location: linkEmpty.html");
    }else if (empty($_POST['newstitle'])){
        header("Location: titleEmpty.html");
    }
    else{
 		$title=$_POST['newstitle'];
    	$story=$_POST['newstory'];
		$link=$_POST['newslink'];
        require 'database.php';
		include("login2.php");
        $user=$_SESSION['login_user'];
        $token = $_POST['csrf'];
		$csrf = $_SESSION['token'];
		
		//check the csrf token for protection
		if ($token == $csrf){
		//get the username, news and link and insert into database
       		$stmt = $mysqli->prepare("insert into story (title, username, news, link) values (?, ?, ?, ?)");
       	    if(!$stmt){
	          	printf("Query Prep Failed: %s\n", $mysqli->error);
	          	exit;
        	}
 
        	$stmt->bind_param('ssss', $title, $user, $story, $link);
 
        	$stmt->execute();
 
        	$stmt->close();
        
        	header("Location: postSuccess.html");
	
        	exit;
        	
   		 } else {
    		printf("##warning, you may use a fake page to enter our website##");
			exit;
    	}
    }
?>