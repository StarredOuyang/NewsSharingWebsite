<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<link href="base.css" type="text/css" rel="stylesheet" />
<title>News Website</title>
<!--search news action-->
</head>
<body><div id="main">
<input type="button" value="go back" name="go back" onclick="history.go(-1);"><br>
<?php
require 'database.php';
if (!empty($_POST['keyWords'])){
	$keyWord = $_POST['keyWords'];
}else{
	$keyWord = uniqid();
}
//use query "like" to get the news info by keywords and display it
	$stmt = $mysqli->prepare("select title, username, news, link from story where news like '%$keyWord%'");
        if(!$stmt){
	          printf("Query Prep Failed: %s\n", $mysqli->error);
	          exit;
        }
        $stmt->execute();
 		$stmt->bind_result($title, $username, $searchedNews, $link);
		while($stmt->fetch()){
			if (empty($username)){
			printf("no result");
			}else{
			printf("<fieldset>%s\n</br>",
			htmlspecialchars($title));
			printf("\t<li>%s</li>\n",
			htmlspecialchars($searchedNews));
			printf("</br>written by: ");
			printf(htmlspecialchars($username));
			echo "</br><a href=".$link.">".$link."</a></fieldset></br></br>";

	
			}		
		}
		
		
        $stmt->close();
        exit;
?>
</div></body>
</html>