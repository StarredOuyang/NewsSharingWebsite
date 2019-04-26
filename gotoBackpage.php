<?php
include("loginAction.php");
//check the user login information. If the session is empty, we will display the failure information
//otherwise, go back to user center page
	if (empty($_SESSION['login_user'])){
        header("Location: postfailure.html");
    }else{
    	header("Location: file.php");
    }
?>
