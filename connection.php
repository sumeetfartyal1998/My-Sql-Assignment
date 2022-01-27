<?php
define("HOST","localhost");
define("UNAME","root");
define("PASS","");
define("DBNAME","myproject");
$conn=mysqli_connect(HOST,UNAME,PASS,DBNAME) or die("Connection Error");
?>