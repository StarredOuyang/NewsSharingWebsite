<?php
session_start();
$errormessage="";
//login action
if (isset($_POST['submit'])){
    if (empty($_POST['login'])){
        print("user name should not be empty");
    }
    else if (empty($_POST['loginpass'])){
        print("password should not be empty");
    }
    else{
        require 'database.php';
 
 		$name = trim($_POST['login']);
		$name=htmlspecialchars($name);
		$pass = trim($_POST['loginpass']);
		$pass=htmlspecialchars($pass);
		//check the password
        $stmt = $mysqli->prepare("select password from users where username=?");
        if(!$stmt){
	         printf("Query Prep Failed: %s\n", $mysqli->error);
	         exit;
        }
 
        $stmt->bind_param('s', $name);
 
        $stmt->execute();
 
        $stmt->bind_result($passdatabase);
        $stmt->fetch();
 
        
		if(password_verify($pass, $passdatabase)){
			$_SESSION['login_user']=$name;
			//generate a unique id(csrf token) every time users log in
			$_SESSION['token']= base64_encode(openssl_random_pseudo_bytes(64));
            header("Location: file.php");
            exit;
        //Successful login
        }else{
			Printf("Wrong password or username dude!");
			
        //Failure to login
        }
    }
}
?>