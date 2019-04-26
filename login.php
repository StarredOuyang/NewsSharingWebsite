
<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<link href="base.css" type="text/css" rel="stylesheet" /><!-- connect to css style sheet-->
<title>Login</title>

</head>
<body><div id="main">
 
<h1>Let us login</h1><br><br>

<form name="input" action="login.php" method="post">
	 <label for="logininput">User Name</label>
	 <input type="text" name="login" id="logininput"/>
     <label for="loginpassinput">Password</label>
	 <input type="password" name="loginpass" id="loginpassinput"/>
	 <input name="submit" type="submit" value="Login"/><br>
<?php
//login action	 
include('login2.php');
?>
</form>
 <br><br>
<input type="button" value="go back" name="go back" onclick="history.go(-1);">
</div></body>
</html>