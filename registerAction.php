<?php
session_start();
$errormessage="";
//register action
if (isset($_POST['submit'])){
    if (empty($_POST['username'])){
        print("user name should not be empty");
    }
    else if (empty($_POST['password'])){
        print("password should not be empty");
    }
    else{
        $name = trim($_POST['username']);
		$name=htmlspecialchars($name);
		$pass = trim($_POST['password']);
		$pass=htmlspecialchars($pass);
		//hash the password and store them into our user table
        $password=password_hash($pass, PASSWORD_DEFAULT);
        require 'database.php';
        $stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
        if(!$stmt){
	          printf("Query Prep Failed: %s\n", $mysqli->error);
	          exit;
        }
 
        $stmt->bind_param('ss', $name, $password);
 
        $stmt->execute();
 
        $stmt->close();
		header("Location: login.php");
        exit;
    }
}
?>