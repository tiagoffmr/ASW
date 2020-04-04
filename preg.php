<html>
<head>
	<title>CCG</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="stylez.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
	<link rel="icon" href="favicon.png" type="image/x-icon">
</head>
<body>
  <nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Card Collecting Game</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
			</ul>
		</div>
	</nav>
  <?php
  include "openconn.php";

  $name = htmlspecialchars($_POST["name"]);
  $surname = htmlspecialchars($_POST["surname"]);
  $email = htmlspecialchars($_POST["email"]);
  $username = strtolower(htmlspecialchars($_POST["username"]));
  $password = md5(htmlspecialchars($_POST["password"]));
  $birthday = $_POST["birthday"];
  $gender = $_POST["gender"];
  $country = htmlspecialchars($_POST["country"]);
  $district = htmlspecialchars($_POST["district"]);
  $county = htmlspecialchars($_POST["county"]);
	$filename=$_FILES["image"]["name"];
 	$extension=end(explode(".", $filename));
	$newfilename=$username .".".$extension;

	$checkemail = "SELECT * FROM Users WHERE email='$email' LIMIT 1";
	$rescheckemail = mysqli_query($conn, $checkemail);
	$existsemail = mysqli_fetch_assoc($rescheckemail);
	$checkusername = "SELECT * FROM Users WHERE username='$username' LIMIT 1";
	$rescheckusername = mysqli_query($conn, $checkusername);
	$existsusername = mysqli_fetch_assoc($rescheckusername);
	if ($existsemail) {
		echo "<h3>You already have registered this e-mail.</h3>";
		echo "<h3>You will be redirected to the homepage</h3>";
		header("refresh:5;url=index.php");
	}
	elseif($existsusername) {
		echo "<h3>This username has already been choosen. Please chose a different one.</h3>";
		echo "<h3>You will be redirected to the homepage</h3>";
		header("refresh:5;url=index.php");
	}
	else {
		$query = "INSERT INTO Users VALUES('$name','$surname','$email','$username','$password','$birthday','$gender','$country','$district','$county','$newfilename',100);";
	  $res = mysqli_query($conn, $query);
		if ($res) {
	   echo "<h3>New account created successfuly!</h3>";
		 echo "<h3>You will be redirected to the homepage</h3>";
		 header("refresh:5;url=index.php");
	  } else {
	   echo "<h3>Error: insert failed" . $query . "<br>" . mysqli_error($conn) . "</h3>";
	  }
	}

  $target_dir = "uploads/";
  $target_file = $target_dir . basename($newfilename);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "<h3>Sorry, file already exists.</h3>";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["image"]["size"] > 500000) {
      echo "<h3>Sorry, your file is too large.</h3>";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "<h3>Sorry, your file was not uploaded.</h3>";
// if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      } else {
          echo "<h3>Sorry, there was an error uploading your image.</h3>";
      }
  }

  // Termina a ligação com a base de dados
  mysqli_close($conn);
  ?>
</body>
</html>
