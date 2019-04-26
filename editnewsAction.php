<?php
//edit news action
//update the records into story table with the new news
include("editnews.php");
$token = $_POST['csrf'];
$csrf = $_SESSION['token'];
//check the csrf token for protection
if ($token == $csrf){
	if (empty($_POST['updatestory'])){
        print("story should not be empty");
    }
    else if (empty($_POST['updatenewslink'])){
        print("link should not be empty");
    }else if (empty($_POST['updatenewstitle'])){
        print("Title should not be empty");
    }
    else{
    	$title=$_POST['updatenewstitle'];
    	$story=$_POST['updatestory'];
		$linky=$_POST['updatenewslink'];        
        $user=$_SESSION['login_user'];
        $servername = "localhost";
        $username = "wustl_inst";
        $password = "wustl_pass";
        $dbname = "newsweb";

        //create the connection to our database
        $conn = new mysqli($servername, $username, $password, $dbname);
		//update the records
        $sql = "update story set title='".$title."', news='".$story."', link='".$linky."' WHERE newsID='".$_POST['newsToEdit']."'";

        if ($conn->query($sql) == TRUE) {
              echo "successfully";
        } else {
              echo "Error: " . $conn->error;
        }
        $conn->close();
        //redirect to usercenter page and refresh the page
		header("Refresh:0; url=file.php");        
        }
} else {
	printf("##warning, you may use a fake page to enter our website##");
	exit;
}
?>