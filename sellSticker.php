<?php
  ini_set('display_errors', 1);
  include 'openconn.php';
  session_start();
  $id = $_POST["id3"];

  mysqli_query($conn, "INSERT INTO Store (seller, stickerID, type, value) VALUES ('{$_SESSION['loggedIn']}', $id, 'sell', 5)");

?>
