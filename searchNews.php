<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<link href="base.css" type="text/css" rel="stylesheet" />
<title>News Website</title>
<!--creative part-->
<!--we allow every users to search news by keywords-->
<body><div id="main">
<h2>We will find every news that contain your keyword</h2>
<h2>Enter your keyword here:</h2><br>
<form name='search' action='searchNewsAction.php' method='post'>
<input type='text' name='keyWords' id='keyWords' ><br>
<input type='submit' value='SEARCH' />
</form>
<br><input type="button" value="go back" name="go back" onclick="history.go(-1);"><br>
</div></body>
</html>
