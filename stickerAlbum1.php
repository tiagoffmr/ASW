<html>
<head>
    <title>Series I</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="home-script.js"></script>
    <link type="text/css" rel="stylesheet" href="general-style.css">
    <link type="text/css" rel="stylesheet" href="stickerAlbumStyle.css">
    <link type="text/css" rel="stylesheet" href="home-style.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="icon" href="favicon.png" type="image/x-icon">
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
          <div class="navbar-header">
              <a class="navbar-brand" href="#">Card Collecting Game</a>
          </div>
          <ul class="nav navbar-nav">
              <li><a href="home.php">Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
              ini_set('display_errors', 1);
              include "openconn.php";
              session_start();
              if(isset($_SESSION['loggedIn'])) {
                $money = mysqli_fetch_assoc(mysqli_query($conn,"SELECT money FROM Users WHERE username LIKE '".$_SESSION['loggedIn']."'"));
                $profpic = mysqli_fetch_assoc(mysqli_query($conn,"SELECT image FROM Users WHERE username LIKE '".$_SESSION['loggedIn']."'"));
                echo '<li><a class="btn btn-secondary">$ '.$money["money"].'</a></li>';
                echo '<li><a class="btn btn-secondary" id="aprofpic"><img id="profpic" src="uploads/'.$profpic["image"].'">  '.$_SESSION['loggedIn'].'</a></li>';
                echo '<li><a class="btn btn-secondary" href="logout.php">Log Out</a></li>';
              }
              else {
                header("Location:index.php");
              }
            ?>
          </ul>
      </div>
  </nav>

  <h2 class="hd2">Marvel Series I - 1990</h2>
  <div class="grid-container">
      <div  id = "search" >
          <div id="status"><h3>Status:</h3>
          <?php
          include "openconn.php";
          ini_set('display_errors', 1);
          $stickers = mysqli_query($conn,"SELECT COUNT(id) FROM UserSticker WHERE username LIKE '".$_SESSION['loggedIn']."' AND id IN (SELECT id FROM `Sticker` WHERE sticker_album_id = 1)");
          $row = mysqli_fetch_array($stickers);
          $stickers = $row[0];

          $totalStickers = mysqli_query($conn, "SELECT `number of stickers` FROM `Sticker Album` WHERE id LIKE 1");
          $row = mysqli_fetch_array($totalStickers);
          $totalStickers = $row[0];

          $a = $stickers/$totalStickers*100;
          $percentage =  number_format((float)$a, 1, '.', '');
          ?>

            <div class="progress">
              <?php
                  echo '<div class="progress-bar  progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%">';
                  echo "$percentage%";
              ?>
              </div>
            </div>
          </div>
          <h3>Filters</h3>
          <p>Order by:
          <select>
              <option value="Card number">Card number</option>
              <option value="Power">Power</option>
              <option value="Value">Value</option>
          </select></p>
          <button class="button3" >Search</button>
      </div>
      <?php
      include "openconn.php";
      ini_set('display_errors', 1);
      $query = mysqli_query($conn,"SELECT * FROM UserSticker WHERE username LIKE '".$_SESSION['loggedIn']."' AND id IN (SELECT id FROM `Sticker` WHERE sticker_album_id = 1)");
      while ($row = mysqli_fetch_assoc($query)){
          $id = $row["id"];
          echo '<div class="grid-item" id="card"><img src = "uploads/1/'. $id. '.jpg" style="height:100%;width:100%;"></div>';
      }
      ?>
   </div>

</body>
</html>
