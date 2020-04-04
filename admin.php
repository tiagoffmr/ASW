<html>
<head>
	<title>Admin - Home</title>
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
				<ul class="nav navbar-nav">
						<li class="active"><a href="#">Search</a></li>
						<li><a href="adminAlbums.php">Running Albums</a></li>
				</ul>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<?php
				session_start();
				if(isset($_SESSION['loggedInAdmin'])) {
					echo '<li><a class="btn btn-secondary" href="logoutAdmin.php">Log Out</a></li>';
				}
				else {
					echo '<li><a class="btn btn-secondary" data-toggle="modal" data-target="#Modal">Admin Login</a></li>';
				}
				?>
			</ul>
		</div>
	</nav>

	  <?php
		if(isset($_SESSION['loggedInAdmin'])) {
			echo '<div class="row">
					<form class="form-inline" action="" method="POST">
							<div class="form-group">
									<input class="form-control form-control" type="text" name="query" placeholder="Search">
							</div>
							<div class="form-group">
									<select class="form-control" name="filter">
											<option value="" disabled selected>Filter by:</option>
											<option value="name">Name</option>
											<option value="email">E-mail</option>
											<option value="user">Username</option>
											<option value="age">Age</option>
											<option value="gender">Gender</option>
											<option value="country">Country</option>
											<option value="district">District</option>
											<option value="county">County</option>
											<option value="Sticker">Sticker</option>
											<option value="StickerAlbum">Sticker Album</option>
									</select>
							</div>
							<div class="form-group">
									<button type="submit" name="submit" value="submit" class="btn btn-primary">Search</button>
							</div>
					</form>
			</div>
			<div style="overflow-x:auto;">
			<table class="table table-hover" id="dtAdmin">
		    <thead>
		        <tr>
		            <th>Name</th>
		            <th>Surname</th>
		            <th>E-mail</th>
		            <th>Username</th>
		            <th>Password</th>
		            <th>Birthday</th>
		            <th>Gender</th>
		            <th>Country</th>
		            <th>District</th>
		            <th>County</th>
		            <th>Image</th>
		        </tr>
		    </thead>';
			include "openconn.php";
			$query = "SELECT * FROM `Users`";
			$res = mysqli_query($conn, $query);
			$query = $_POST['query'];
			if (isset($_POST['submit'])) {
				if ($query == ''){
					$query = "SELECT * FROM `Users`";
					$res = mysqli_query($conn, $query);
				}
				else {
				$col = $_POST['filter'];
				if ($col == 'name'){
						$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE name LIKE '%$query%' OR surname LIKE '%$query%'");
						$row_cnt = mysqli_num_rows($res);
						if ($row_cnt == 'NULL'){
								echo "<br>";
								echo "<h4>No users matched your search by name. Please update you search term.</h4>";
								echo "<br>";
						}
				}
				if ($col == 'email'){
						$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE email LIKE '%$query%'");
						$row_cnt = mysqli_num_rows($res);
						if ($row_cnt == 'NULL'){
								echo "<br>";
								echo "<h4>No users matched your search by e-mail. Please update you search term.</h4>";
								echo "<br>";
						}
				}
				if ($col == 'user'){
						$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE username LIKE '%$query%'");
						$row_cnt = mysqli_num_rows($res);
						if ($row_cnt == 'NULL'){
								echo "<br>";
								echo "<h4>No users matched your search by username. Please update you search term.</h4>";
								echo "<br>";
						}
				}
				if ($col == 'age') {
						$query = (int)$query;
						$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) = $query");
						$row_cnt = mysqli_num_rows($res);
						if ($row_cnt == 'NULL'){
								echo "<br>";
								echo "<h4>No users matched your search by age. Please update you search term.</h4>";
								echo "<br>";
						}
				}
				if ($col == 'gender'){
						if ($query == "Male" or $query == "male" or $query == "m") {
							$query = "M";
						}
						elseif ($query == "Female" or $query == "female" or $query == "f") {
							$query = "F";
						}
						else if ($query == "Other" or $query == "other" or $query == "o") {
							$query = "O";
						}
						$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE gender = '$query'");
						$row_cnt = mysqli_num_rows($res);
						if ($row_cnt == 'NULL'){
								echo "<br>";
								echo "<h4>No users matched your search by gender. Please update you search term.</h4>";
								echo "<br>";
						}
				}
				if ($col == 'country' ){
						$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE country LIKE '%$query%'");
						$row_cnt = mysqli_num_rows($res);
						if ($row_cnt == 'NULL'){
								echo "<br>";
								echo "<h4>No users matched your search by country. Please update you search term.</h4>";
								echo "<br>";
						}
				}
				if ($col == 'district' ){
						$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE district LIKE '%$query%'");
						$row_cnt = mysqli_num_rows($res);
						if ($row_cnt == 'NULL'){
								echo "<br>";
								echo "<h4>No users matched your search by district. Please update you search term.</h4>";
								echo "<br>";
						}
				}
				if ($col == 'county' ){
						$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE county LIKE '%$query%'");
						$row_cnt = mysqli_num_rows($res);
						if ($row_cnt == 'NULL'){
								echo "<br>";
								echo "<h4>No users matched your search by county. Please update you search term or filter.</h4>";
								echo "<br>";
						}
				}
				if ($col == 'Sticker'){
					$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE `username` IN (SELECT username FROM `UserSticker` WHERE `id` = '$query' OR `id` IN (SELECT id FROM Sticker WHERE `name` LIKE '%$query%'))");
					$row_cnt = mysqli_num_rows($res);
					if ($row_cnt == 'NULL'){
							echo "<br>";
							echo "<h4>No users matched your search by Sticker. Please update you search term or filter.</h4>";
							echo "<br>";
					}
				}
				if ($col == 'StickerAlbum'){
					$res = mysqli_query($conn, "SELECT * FROM `Users` WHERE `username` IN (SELECT username FROM `UserStickerAlbum` WHERE `id` = '$query')");
					$row_cnt = mysqli_num_rows($res);
					if ($row_cnt == 'NULL'){
							echo "<br>";
							echo "<h4>No users matched your search by Sticker Album. Please update you search term or filter.</h4>";
							echo "<br>";
					}
				}
				if (!isset($_POST['filter'])) {
						echo "<br>";
						echo "<h4>Please choose a filter for your search.</h4>";
						echo "<br>";
				}
			}
		}
	}
	  ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($res)) { ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
						<td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6]; ?></td>
            <td><?php echo $row[7]; ?></td>
            <td><?php echo $row[8]; ?></td>
            <td><?php echo $row[9]; ?></td>
            <td><?php echo $row[10]; ?></td>
          </tr>
      <?php } ?>
    </tbody>
</table>
</div>



	<!-- Login Modal-->
	<div id="Modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
	        <h5 class="modal-title">Admin Login</h5>
	      </div>
				<div class="modal-body">

					<!-- LOGIN ------>
						<div id="LoginModal" class="tab-pane fade in active">
							<form class="form-horizontal" role='form' action="plogadmin.php" method="POST" enctype="multipart/form-data">
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


	</body>
</html>
