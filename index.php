<html>
<head>
  <title>CCG</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script language="JavaScript" type="text/javascript" src="script.js"></script>
  <link type="text/css" rel="stylesheet" href="general-style.css">
  <link type="text/css" rel="stylesheet" href="index-style.css">
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
  <link rel="icon" href="favicon.png" type="image/x-icon">
</head>
<body>
<?php
  ini_set('display_errors', 1);
  include "openconn.php";
  $query1 = "SELECT * FROM `Countries`";
  $res1 = mysqli_query($conn, $query1);
  $query2 = "SELECT * FROM `Districts`";
  $res2 = mysqli_query($conn, $query2);
  ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Card Collecting Game</a>
    </div>
    <ul class="nav navbar-nav"></ul>
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
          echo '<li><a class="btn btn-secondary" data-toggle="modal" data-target="#Modal">Login / Register</a></li>';
        }
      ?>
    </ul>
  </div>
</nav>

<!-- Login / Register Modal-->
<div id="Modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#LoginModal"> Login <span class="glyphicon glyphicon-user"></span></a></li>
        <li><a data-toggle="tab" href="#RegisterModal"> Register <span class="glyphicon glyphicon-pencil"></span></a></li>
      </ul>
      <div class="modal-body">
        <div class="tab-content">

          <!-- LOGIN ------>
          <div id="LoginModal" class="tab-pane fade in active">
            <form class="form-horizontal" role='form' action="plog.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label col-sm-2" for="logusername">Username:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="logusername" placeholder="Enter your username" name="logusername" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="logpassword">Password:</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="logpassword" placeholder="Enter your password" name="logpassword" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label><input type="checkbox" name="remember">Remember me</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" name="submit" value="Log In" class="btn btn-default">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>

          <!--Register ---->
          <div id="RegisterModal" class="tab-pane fade">
            <form class="form-horizontal" action="preg.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-10">
                  <input type="name" class="form-control" id="name" placeholder="Enter your name" name="name" maxlength="32" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="Surname">Surname:</label>
                <div class="col-sm-10">
                  <input type="surname" class="form-control" id="surname" placeholder="Enter your surname" name="surname" maxlength="32" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" maxlength="254" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="username">Username:</label>
                <div class="col-sm-10">
                  <input type="username" class="form-control" id="username" placeholder="Enter your username" name="username" maxlength="16" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="password">Password:</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" minlength="8" maxlength="16" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="birthday">Birthday:</label>
                <div class="col-sm-10">
                  <input type="date" name="birthday" class="form-control" id="birthday" placeholder="Date of Birth" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="gender">Gender:</label>
                <div class="col-sm-10">
                  <label class="radio-inline"> <input type="radio" name="gender" value="F" required>Female</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="M">Male</label>
                  <label class="radio-inline"><input type="radio" name="gender" value="O">Other</label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="country">Select Country:</label>
                <div class="col-sm-10">
                  <select class="selectForm form-control" name="country" id="country" onchange="portugal()" required>
                    <option selected="" value="none" disabled="">Select your Country</option>
                    <?php while($row1 = mysqli_fetch_array($res1)):;?>
                    <option value="<?php echo $row1[2];?>"><?php echo $row1[2];?></option>
                    <?php endwhile;?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="district">Select District:</label>
                <div class="col-sm-10">
                  <select class="selectForm form-control" name="district" id="district" required>
                    <option selected="" disabled="">Select your District</option>
                    <?php while($row2 = mysqli_fetch_array($res2)):;?>
                    <option value="<?php echo $row2[1];?>"><?php echo $row2[1];?></option>
                    <?php endwhile;?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="county">County:</label>
                <div class="col-sm-10">
                  <input type="county" class="form-control" id="county" placeholder="Enter your county" name="county" maxlength="32" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="county">Image:</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="image" accept="image/jpeg" name="image">
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" name="submit" value="Log In" class="btn btn-default">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="container"  id="homepage">

  <div class="row" id="first">
    <div class="fd">
      <h2>Marvels Heroes</h2>
      <p>Collect Cards, upload your own Cards and battle<br>against other Marvels super heroes enthusiasts</p>
      <a href="#"class="round-button"><span class="glyphicon glyphicon-play-circle" id="icon"></span></a>
      <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row" id="second"><img src="bck7.jpg">
  </div>

  <!-- FOOTER -->
  <footer>
    <p id="footer">&copy; 2019, FCUL. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>

</div><!-- /.container -->
</body>
</html>
