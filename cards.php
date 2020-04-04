<html>
<head>
    <title>Sell & Buy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="home-script.js"></script>
    <link type="text/css" rel="stylesheet" href="general-style.css">
    <link type="text/css" rel="stylesheet" href="shop-homepage.css">
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
<div class = "container">
    <div class = "row">
        <div class="col-lg-3">

            <h1 class="my-4">Shop Name</h1>
            <div class="list-group">
                <a href = "store.php" class="list-group-item">Buy Packs</a>
                <a href = "cards.php" class="list-group-item">Buy Card</a>
            </div>
          <button class="list-group-item" type="button" data-toggle="modal" data-target="#Modal">Sell Sticker!</button>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div class="row">
                <?php
                ini_set('display_errors', 1);
                include "openconn.php";
                    $store = mysqli_query($conn, "SELECT * FROM `Store`");

                    while ($row = mysqli_fetch_assoc($store)) {
                        $id = $row["stickerID"];
                        $name = mysqli_query($conn, "SELECT name FROM `Sticker` WHERE id = $id");
                        $Name = mysqli_fetch_row($name)[0];
                        $value = $row["value"];
                        $type = $row["type"];
                        $seller = $row["seller"];
                        $album = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Sticker WHERE id = $id"));

                        echo "<div class='col-lg-4 col-md-6 mb-4'>";
                        echo "    <div class='card h-100'>";
                        echo '        <img src="uploads/'.$album["sticker_album_id"].'/'.$id.'.jpg" style="heigth=100%;">';
                        echo "        <div class='card-body'>";
                        echo "            <h4 class='card-title' id ='name' value='$Name'>";
                        echo "                $Name";
                        echo "            </h4>";
                        echo "            <h5>$ $value</h5>";
                        echo "            <p class='card-text'>$seller is selling his $Name's Sticker;</p>";
                        echo "        </div>";
                        echo "        <form class='card-footer' method ='POST'>";
                        echo "            <input class='btn btn-primary btn-success' type='submit' id='buy' name='submit' value='Buy Now' onclick='getSticker($id)' >";
                        echo "        </form>";
                        echo "    </div>";
                        echo "</div>";

                      }

                    ?>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->


    <div id="Modal" class="modal fade" role="dialog">
      <?php
        ini_set('display_errors', 1);
        include "openconn.php";
        $sell = mysqli_query($conn, "SELECT * FROM `UserSticker` WHERE  username = '".$_SESSION['loggedIn']."' AND NumStickersID > 1");
      ?>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <label for="sel1">Sell Sticker:</label>
              <select class="form-control" id="addSell" required>
                <option selected="" value="" disabled="">Select a Sticker to Sell</option>
                <?php foreach($sell as $value){ ?>
                <option id="addSA" value="<?php echo $value["id"];?>"><?php echo $value["id"];?></option>
                <?php } ?>
              </select>
              <div class="modal-footer">
                <input type="submit" name="submit" value="Add" class="btn btn-default" data-dismiss="modal" onclick="sellSticker()">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>



</div>

</body>
</html>
