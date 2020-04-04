<html>
<head>
    <title>Store</title>
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

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="row">

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <img src="storeimg.jpg" alt=""><h4 id="Nvezes">5X<h4></img>
              <div class="card-body">
                <h4 class="card-title">
                  Pack One
                </h4>
                <h5>$ 5</h5>
                <p class="card-text">5 stickers of Marvel's Sticker Album</p>
              </div>
              <form class="card-footer" method ="POST">
                <input type="submit" name="buy1" class="btn btn-primary btn-success" value="Buy Now"/>
              </form>

            </div>
          </div>
            <?php
            if (isset($_POST['buy1'])) {
                $value = mysqli_fetch_assoc(mysqli_query($conn, "SELECT money FROM Users WHERE username = '{$_SESSION['loggedIn']}'"));

                if ($value["money"] >= 5) {
                    mysqli_query($conn, "UPDATE Users SET money = money-5 WHERE username LIKE '{$_SESSION['loggedIn']}'");
                    echo "<p>Buy Successful</p>";
                    header("refresh:1.5;url=store.php");
                    for ($i = 0; $i < 5; $i++) {
                        echo $i;
                        $rand = rand(1, 521);
                        $result = mysqli_query($conn, "SELECT * FROM UserSticker WHERE id = '$rand'");
                        if (mysqli_num_rows($result) == 0) {
                            mysqli_query($conn, "INSERT INTO UserSticker (username, id, NumStickersID) VALUES ('{$_SESSION['loggedIn']}',$rand,1)");
                        } else {
                            mysqli_query($conn, "UPDATE UserSticker SET NumStickersID = NumStickersID+1 WHERE id = '$rand' AND username = '{$_SESSION['loggedIn']}'");
                        }
                    }
                } else {
                    echo "<p>Not enough money</p>";
                    header("refresh:1.5;url=store.php");

                }

            }
                  ?>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="storeimg.jpg" alt=""><h4 id="Nvezes">10X<h4></img>
                    <div class="card-body">
                        <h4 class="card-title">
                            Pack Two
                        </h4>
                        <h5>$ 10</h5>
                        <p class="card-text">10 stickers of Marvel's Sticker Album</p>
                    </div>
                    <form class="card-footer" method ="POST">
                        <input type="submit" name="buy2" class="btn btn-primary btn-success" value="Buy Now"/>
                    </form>

                </div>
            </div>
            <?php
            if (isset($_POST['buy2'])) {
                $value = mysqli_fetch_assoc(mysqli_query($conn, "SELECT money FROM Users WHERE username = '{$_SESSION['loggedIn']}'"));

                if ($value["money"] >= 10) {
                    mysqli_query($conn, "UPDATE Users SET money = money-10 WHERE username LIKE '{$_SESSION['loggedIn']}'");
                    echo "<p>Buy Successful</p>";
                    header("refresh:1.5;url=store.php");
                    for ($i = 0; $i < 10; $i++) {
                        echo $i;
                        $rand = rand(1, 521);
                        $result = mysqli_query($conn, "SELECT * FROM UserSticker WHERE id = '$rand'");
                        if (mysqli_num_rows($result) == 0) {
                            mysqli_query($conn, "INSERT INTO UserSticker (username, id, NumStickersID) VALUES ('{$_SESSION['loggedIn']}',$rand,1)");
                        } else {
                            mysqli_query($conn, "UPDATE UserSticker SET NumStickersID = NumStickersID+1 WHERE id = '$rand' AND username = '{$_SESSION['loggedIn']}'");
                        }
                    }
                } else {
                    echo "<p>Not enough money</p>";
                    header("refresh:1.5;url=store.php");

                }

            }
            ?>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="storeimg.jpg" alt=""><h4 id="Nvezes">20X<h4></img>
                    <div class="card-body">
                        <h4 class="card-title">
                            Pack Three
                        </h4>
                        <h5>$ 20</h5>
                        <p class="card-text">20 stickers of Marvel's Sticker Album</p>
                    </div>
                    <form class="card-footer" method ="POST">
                        <input type="submit" name="buy3" class="btn btn-primary btn-success" value="Buy Now"/>
                    </form>

                </div>
            </div>
            <?php
            if (isset($_POST['buy3'])) {
                $value = mysqli_fetch_assoc(mysqli_query($conn, "SELECT money FROM Users WHERE username = '{$_SESSION['loggedIn']}'"));

                if ($value["money"] >= 20) {
                    mysqli_query($conn, "UPDATE Users SET money = money-20 WHERE username LIKE '{$_SESSION['loggedIn']}'");
                    echo "<p>Buy Successful</p>";
                    header("refresh:1.5;url=store.php");
                    for ($i = 0; $i < 20; $i++) {
                        $rand = rand(1, 521);
                        $result = mysqli_query($conn, "SELECT * FROM UserSticker WHERE id = '$rand'");
                        if (mysqli_num_rows($result) == 0) {
                            mysqli_query($conn, "INSERT INTO UserSticker (username, id, NumStickersID) VALUES ('{$_SESSION['loggedIn']}',$rand,1)");
                        } else {
                            mysqli_query($conn, "UPDATE UserSticker SET NumStickersID = NumStickersID+1 WHERE id = '$rand' AND username = '{$_SESSION['loggedIn']}'");
                        }
                    }
                } else {
                    echo "<p>Not enough money</p>";
                    header("refresh:1.5;url=store.php");

                }

            }
            ?>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="storeimg.jpg" alt=""><h4 id="Nvezes">30X<h4></img>
                    <div class="card-body">
                        <h4 class="card-title">
                            Pack Four
                        </h4>
                        <h5>$ 30</h5>
                        <p class="card-text">30 stickers of Marvel's Sticker Album</p>
                    </div>
                    <form class="card-footer" method ="POST">
                        <input type="submit" name="buy4" class="btn btn-primary btn-success" value="Buy Now"/>
                    </form>

                </div>
            </div>
            <?php
            if (isset($_POST['buy4'])) {
                $value = mysqli_fetch_assoc(mysqli_query($conn, "SELECT money FROM Users WHERE username = '{$_SESSION['loggedIn']}'"));

                if ($value["money"] >= 30) {
                    mysqli_query($conn, "UPDATE Users SET money = money-30 WHERE username LIKE '{$_SESSION['loggedIn']}'");
                    echo "<p>Buy Successful</p>";
                    header("refresh:1.5;url=store.php");
                    for ($i = 0; $i < 30; $i++) {
                        $rand = rand(1, 521);
                        $result = mysqli_query($conn, "SELECT * FROM UserSticker WHERE id = '$rand'");
                        if (mysqli_num_rows($result) == 0) {
                            mysqli_query($conn, "INSERT INTO UserSticker (username, id, NumStickersID) VALUES ('{$_SESSION['loggedIn']}',$rand,1)");
                        } else {
                            mysqli_query($conn, "UPDATE UserSticker SET NumStickersID = NumStickersID+1 WHERE id = '$rand' AND username = '{$_SESSION['loggedIn']}'");
                        }
                    }
                } else {
                    echo "<p>Not enough money</p>";
                    header("refresh:1.5;url=store.php");

                }

            }
            ?>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="storeimg.jpg" alt=""><h4 id="Nvezes">40X<h4></img>
                    <div class="card-body">
                        <h4 class="card-title">
                            Pack Five
                        </h4>
                        <h5>$ 40</h5>
                        <p class="card-text">40 stickers of Marvel's Sticker Album</p>
                    </div>
                    <form class="card-footer" method ="POST">
                        <input type="submit" name="buy5" class="btn btn-primary btn-success" value="Buy Now"/>
                    </form>

                </div>
            </div>
            <?php
            if (isset($_POST['buy5'])) {
                $value = mysqli_fetch_assoc(mysqli_query($conn, "SELECT money FROM Users WHERE username = '{$_SESSION['loggedIn']}'"));

                if ($value["money"] >= 40) {
                    mysqli_query($conn, "UPDATE Users SET money = money-40 WHERE username LIKE '{$_SESSION['loggedIn']}'");
                    echo "<p>Buy Successful</p>";
                    header("refresh:1.5;url=store.php");
                    for ($i = 0; $i < 40; $i++) {
                        $rand = rand(1, 521);
                        $result = mysqli_query($conn, "SELECT * FROM UserSticker WHERE id = '$rand'");
                        if (mysqli_num_rows($result) == 0) {
                            mysqli_query($conn, "INSERT INTO UserSticker (username, id, NumStickersID) VALUES ('{$_SESSION['loggedIn']}',$rand,1)");
                        } else {
                            mysqli_query($conn, "UPDATE UserSticker SET NumStickersID = NumStickersID+1 WHERE id = '$rand' AND username = '{$_SESSION['loggedIn']}'");
                        }
                    }
                } else {
                    echo "<p>Not enough money</p>";
                    header("refresh:1.5;url=store.php");

                }

            }
            ?>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="storeimg.jpg" alt=""><h4 id="Nvezes">50X<h4></img>
                    <div class="card-body">
                        <h4 class="card-title">
                            Pack Six
                        </h4>
                        <h5>$ 50</h5>
                        <p class="card-text">50 stickers of Marvel's Sticker Album</p>
                    </div>
                    <form class="card-footer" method ="POST">
                        <input type="submit" name="buy6" class="btn btn-primary btn-success" value="Buy Now"/>
                    </form>

                </div>
            </div>
            <?php
            if (isset($_POST['buy6'])) {
                $value = mysqli_fetch_assoc(mysqli_query($conn, "SELECT money FROM Users WHERE username = '{$_SESSION['loggedIn']}'"));

                if ($value["money"] >= 50) {
                    mysqli_query($conn, "UPDATE Users SET money = money-50 WHERE username LIKE '{$_SESSION['loggedIn']}'");
                    echo "<p>Buy Successful</p>";
                    header("refresh:1.5;url=store.php");
                    for ($i = 0; $i < 50; $i++) {
                        $rand = rand(1, 521);
                        $result = mysqli_query($conn, "SELECT * FROM UserSticker WHERE id = '$rand'");
                        if (mysqli_num_rows($result) == 0) {
                            mysqli_query($conn, "INSERT INTO UserSticker (username, id, NumStickersID) VALUES ('{$_SESSION['loggedIn']}',$rand,1)");
                        } else {
                            mysqli_query($conn, "UPDATE UserSticker SET NumStickersID = NumStickersID+1 WHERE id = '$rand' AND username = '{$_SESSION['loggedIn']}'");
                        }
                    }
                } else {
                    echo "<p>Not enough money</p>";
                    header("refresh:1.5;url=store.php");

                }

            }
            ?>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>

</body>
</html>
