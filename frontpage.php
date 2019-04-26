<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<link href="base.css" type="text/css" rel="stylesheet" />
<title>News Website</title>
<!--main story page-->
<!--This page will display all the stories and their comments. Login user could write comments under every stories. Non login user only can watch them.-->
</head>
<body><div id="main">
 
<h1>News Board</h1><br><br>

<input type='button' value='go to backpage' name='gotoBackpage' onclick="window.location.href='gotoBackpage.php';"/><br>
<!--creative part, a button on frontpage that allow everyone click it to search news by keywords-->
<input type='button' value='Search News' name='searchNews' onclick="window.location.href='searchNews.php';"/><br>
<form name="input" action="logout.php" method="get">
	<input type="submit" value="exit" />
</form><br>

<?php
include("loginAction.php");
$host = 'mysql:host=localhost; dbname=newsweb';
$database = new PDO($host, 'wustl_inst', 'wustl_pass');
$storyInfo = $database->query('select * from story');
if (!empty($_SESSION['token'])){
$csrf = $_SESSION['token'];
}else{
$csrf="";
}
//display one story and its comments in one section
while($row=$storyInfo->fetch()){
        echo "<fieldset><legend>author:".$row['username']."</legend>";
        echo "Title: ".$row['title']."</br>";
        echo "News: ".$row['news']."</br></br>";
        echo "<a href=".$row['link'].">".$row['link']."</a></br></br></br>";
        $comment = $database->query('select * from comments where newsID='.$row['newsID'].'');
        	while($c=$comment->fetch()){      	
        		echo "<fieldset>comment:  ".$c['comment']."</br>";
        		echo "commented by:".$c['username']."</fieldset></br>";
       		}
        //post button, only works for login users
        echo "<form name='input' action='postComments.php' method='post'><input type='text' name='newcomments' value='enter your comments here' size='100' id='newcomments'/></br>
        <input type='hidden' name='storykey' size='1' readOnly='true' value=".$row['newsID']."></br>
        <input type='hidden' name='csrf' value=".$csrf.">
        <input type='submit' value='post your comments' name='comments'/></form></fieldset></br></br>";
}
?> 
</div></body>
</html>
