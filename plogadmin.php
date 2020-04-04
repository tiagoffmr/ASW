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
				<li><a href="#">My Collection</a></li>
			</ul>
		</div>
	</nav>
  <?php
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {

	    include 'openconn.php';

			$username = $_REQUEST["logusername"];
		  $password = md5($_REQUEST["logpassword"]);
	    $query = "SELECT * FROM Admin WHERE username = '$username' AND password ='$password';";
	    $result = mysqli_query($conn, $query);

	    if (mysqli_num_rows($result) > 0){
	         $_SESSION['loggedInAdmin'] = $username;
		       header("refresh:0;url=admin.php");
	    }else {
	        echo "<h3>Wrong username/password combination</h3>";
	        header("refresh:1.5;url=admin.php");
	    }
	}

  // Termina a ligação com a base de dados
  mysqli_close($conn);
  ?>
</body>
</html>
