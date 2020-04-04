<?php
  ini_set('display_errors', 1);
  include 'openconn.php';
  session_start();
  $money = mysqli_fetch_assoc(mysqli_query($conn,"SELECT money FROM Users WHERE username LIKE '".$_SESSION['loggedIn']."'"));
  $val = $_POST["id2"];
  $numberAlbum = 'num stickers';
  $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `Store` WHERE stickerID = $val"));
  $id = $row["stickerID"];
  $value = $row["value"];
  $seller = $row["seller"];

  if ($money["money"] >= $value) {
      mysqli_query($conn, "UPDATE Users SET money = money-$value WHERE username LIKE '{$_SESSION['loggedIn']}'");
      mysqli_query($conn, "UPDATE Users SET money = money+$value WHERE username LIKE $seller");
      mysqli_query($conn, "DELETE FROM Store WHERE stickerID = $id AND seller LIKE '$seller'");



      $result = mysqli_query($conn, "SELECT * FROM UserSticker WHERE id = $id AND username LIKE '{$_SESSION['loggedIn']}'");

      if (mysqli_num_rows($result) == 0) {
          mysqli_query($conn, "UPDATE `UserStickerAlbum` SET $numberAlbum=$numberAlbum+1  WHERE username LIKE '{$_SESSION['loggedIn']}'"); ## not working
          mysqli_query($conn, "INSERT INTO UserSticker (username, id, NumStickersID) VALUES ('{$_SESSION['loggedIn']}',$id,1)");

      } else {
          mysqli_query($conn, "UPDATE UserSticker SET NumStickersID = NumStickersID+1 WHERE id = '$id' AND username LIKE '{$_SESSION['loggedIn']}'");

      }





  } else {
      echo "<p>Not enough money</p>";


  }

        ?>
