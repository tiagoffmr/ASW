<?php
   include('openconn.php');
   session_start();
   $user_check = $_SESSION['loggedIn'];
   $ses_sql = mysqli_query($conn,"select username from Users where username = '$user_check'");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['username'];
   if(!isset($_SESSION['loggedIn'])){
      header("location:index.php");
      die();
   }
?>
