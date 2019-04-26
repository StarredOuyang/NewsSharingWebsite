<?php
//editcomment action
//update the records into comments table with the new comments
include("editcom.php");
$token = $_POST['csrf'];
$csrf = $_SESSION['token'];
//check the csrf token for protection
if ($token == $csrf){	
	if (empty($_POST['updatecom'])){
        print("comment should not be empty");
    }
    else{
    	$com=$_POST['updatecom'];
        $user=$_SESSION['login_user'];
		
        $servername = "localhost";
        $username = "wustl_inst";
        $password = "wustl_pass";
        $dbname = "newsweb";

        //create the connection to our database
        $conn = new mysqli($servername, $username, $password, $dbname);        
		//update the records
        $sql = "update comments set comment='".$com."' WHERE commentsID='".$_POST['comToEdit']."'";

        if ($conn->query($sql) == TRUE) {
              echo "successfully";
        } else {
              echo "Error editing record: " . $conn->error;
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