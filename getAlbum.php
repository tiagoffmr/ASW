<?php
  include 'openconn.php';
  session_start();
  $album = $_POST['id1'];
  mysqli_query($conn, "INSERT INTO UserStickerAlbum (username, id) VALUES ('{$_SESSION['loggedIn']}',$album);");

?>
