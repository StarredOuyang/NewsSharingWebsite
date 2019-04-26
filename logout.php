<?php
//destroy the session and log out
session_start();
session_unset();
session_destroy();

header("location:index.html");
exit();
?>