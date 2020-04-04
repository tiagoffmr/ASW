<?php
$dbhost = "appserver-01.alunos.di.fc.ul.pt";
$dbuser = "asw028";
$dbpass = "gandabuja";
$dbname = "asw028";
//Liga à BD
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//Verifica ligação à BD
if(mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
}
?>
