<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="home-script.js"></script>
    <link type="text/css" rel="stylesheet" href="general-style.css">
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
              <li class="active"><a href="home.php">Home</a></li>
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
                  echo '<li><a class="btn btn-secondary" id="aprofpic"><img id="profpic" src="uploads/'.$profpic["image"].'">   '.$_SESSION['loggedIn'].'</a></li>';
                  echo '<li><a class="btn btn-secondary" href="logout.php">Log Out</a></li>';
                }
              else {
                header("Location:index.php");
              }
            ?>
          </ul>
      </div>
  </nav>
  <div class="container">
    <ul id="leftBar">
        <a href = store.php style="color:white;"><li id="Store">

              <h1>Store</h1>
      </li>
        </a>
      <a></a><li id="Auction">
        <h1>Auction</h1>
      </li>
      <li id="Trade">
        <h1>Trade</h1>
      </li>
      <li id="Settings">
        <h1>Settings</h1>
      </li>
    </ul>
    <ul id="rightBar">
      <?php
      ini_set('display_errors', 1);
      include "openconn.php";
      $nAlbum = mysqli_query($conn, "SELECT * FROM `UserStickerAlbum` WHERE username LIKE '".$_SESSION['loggedIn']."'");
      while($row = $nAlbum->fetch_assoc()){
          echo '<li id="SA'.$row['id'].'"><a href="stickerAlbum'.$row['id'].'.php"><img src="uploads/'.$row['id'].'.jpg" style="height:100%;border-radius:10px;"></a></li>';
          $info = mysqli_query($conn, "SELECT name, description FROM `Sticker Album` WHERE id LIKE '".$row['id']."'");
          $r = mysqli_fetch_array($info);
          echo '<p style="text-align:center;"><a href="stickerAlbum'.$row['id'].'.php"style=color:black;font-size:20px;">'.$r['name'].' - '.$r['description'].'</a></p>';
      }
      $numberAlbum = mysqli_query($conn, "SELECT COUNT(id) FROM `UserStickerAlbum` WHERE username LIKE '".$_SESSION['loggedIn']."'");
      $row = mysqli_fetch_array($numberAlbum);
      $total = $row[0];
      if($total!=3) {
        echo '<li id="Add"><button type="button" data-toggle="modal" data-target="#Modal">Start New Collection!</button></li>';
      }
      ?>
    </ul>

    <div id="Modal" class="modal fade" role="dialog">
      <?php
        ini_set('display_errors', 1);
        include "openconn.php";
        $add = mysqli_query($conn, "SELECT id, name FROM `Sticker Album` WHERE id NOT IN (SELECT id FROM `UserStickerAlbum` WHERE username = '".$_SESSION['loggedIn']."')");
        ?>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <label for="sel1">Add Sticker Album:</label>
              <select class="form-control" id="addSel" required>
                <option selected="" value="" disabled="">Select a new Sticker Album</option>
                <?php foreach($add as $value){ ?>
                <option id="addSA" value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
                <?php } ?>
              </select>
              <div class="modal-footer">
                <input type="submit" name="submit" value="Add" class="btn btn-default" data-dismiss="modal" onclick="myFunction()">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
</body>
</html>
