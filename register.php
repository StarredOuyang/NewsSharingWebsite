
<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<link href="base.css" type="text/css" rel="stylesheet" />
<title>Register</title>
<!--users register through this page-->
</head>
<body><div id="main">
 
<h1>Enter your information</h1><br><br>

<form name="input" action="register.php" method="post">
	 <label for="usernameinput">User Name</label>
	 <input type="text" name="username" id="usernameinput"/>
     <label for="passinput">Password</label>
	 <input type="password" name="password" id="passinput"/>
	 <input name="submit" type="submit" value="Register"/><br>
<?php
include('registerAction.php');
?>
</form>
<br><br>
<input type="button" value="go back" name="go back" onclick="history.go(-1);">
</div></body>
</html>
