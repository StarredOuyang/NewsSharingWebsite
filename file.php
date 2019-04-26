<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<link href="base.css" type="text/css" rel="stylesheet" />
<title>News Website</title>
<!--this is the user center page-->
<!--Users can write their story and link here. They also could see a list of their own story and comments. They can delete and edit them by pressing the corresponding buttons.-->
</head>
<body><div id="main">
 
<h1>user center</h1><br><br>


<form name="input" action="logout.php" method="get">
	<input type="submit" value="Log out" />
</form><br>

<form name="input" action="postnews.php" method="post">
<label for="newslinkinput">News Title</label>
<textarea rows='1' name="newstitle" id="newstitleinput"/></textarea><br>
<textarea cols="40" rows="5" name="newstory">
write your story here</textarea><br>
<label for="newslinkinput">News Link</label>
<input type="text" name="newslink" id="newslinkinput"/><br>
<?php
include("loginAction.php");
$csrf = $_SESSION['token'];
echo "<input type='hidden' name='csrf' value=".$csrf.">";
?>
<input type="submit" value="Post" />

</form>
<br><br>
<input type="button" value="check out other's news and make comments" name="go back" onclick="location='frontpage.php'"/>
<br>
<?php


$user = $_SESSION['login_user'];
$csrf = $_SESSION['token'];
echo $user;
echo '<br>';
echo 'All your news are below:<br>';


require 'database.php';
$stmt = $mysqli->prepare("select title, news, link, newsID from story where username=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('s', $user);
 
$stmt->execute();
 
$stmt->bind_result($title, $news, $link, $newsID);
while($stmt->fetch()){
//display every news, links and two function buttons
	printf("<fieldset>%s\n</br>",
		htmlspecialchars($title));
	printf("\t<li>%s</li>\n",
		htmlspecialchars($news));
	echo "<a href=".$link.">".$link."</a></br>";	
	echo "<br><form method=\"post\" name=\"deleteSomething\" action=\"Deletenews.php\" >
			<input type=\"hidden\" name=\"newsToDelete\" readOnly=\"true\" value=".$newsID." >
			<input type='hidden' name='csrf' value=".$csrf.">
			<input type=\"submit\" value=\"Delete\">
			</form>";
			
	echo "<form method=\"post\" name=\"editSomething\" action=\"editnews.php\" >
		    <input type=\"hidden\" name=\"newsToEdit\" readOnly=\"true\" value=".$newsID." >
		    <input type='hidden' name='csrf' value=".$csrf.">
			<input type=\"submit\" value=\"Edit\">
			</form></fieldset>";
}
echo "</ul>\n"; 
$stmt->close();



//display the user's comments
echo '<br>All your comments are below:<br>';
$stmt = $mysqli->prepare("select comment, commentsID from comments where username=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
} 
$stmt->bind_param('s', $user); 
$stmt->execute(); 
$stmt->bind_result($comment, $commentsID);
while($stmt->fetch()){
//display every comments and two function buttons
	 printf("<fieldset>");
	 printf(htmlspecialchars($comment));
		
		
	echo "<br><form method=\"post\" name=\"deletecomment\" action=\"Deletecom.php\" >
			<input type=\"hidden\" name=\"comToDelete\" readOnly=\"true\" value=".$commentsID." >
			<input type='hidden' name='csrf' value=".$csrf.">
			<input type=\"submit\" value=\"Delete\">
			</form>";
			
	echo "<form method=\"post\" name=\"editcomment\" action=\"editcom.php\" >
		    <input type=\"hidden\" name=\"comToEdit\" readOnly=\"true\" value=".$commentsID." >
		    <input type='hidden' name='csrf' value=".$csrf.">
			<input type=\"submit\" value=\"Edit\">
			</form></fieldset>";
} 
$stmt->close();
?>
</div></body>
</html>
