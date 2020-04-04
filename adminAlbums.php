<html>
<head>
	<title>Admin - Running Albums</title>
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
						<li><a href="admin.php">Search</a></li>
						<li class="active"><a href="#">Running Albums</a></li>
				</ul>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<?php
				session_start();
				if(isset($_SESSION['loggedInAdmin'])) {
					echo '<li><a class="btn btn-secondary" href="logoutAdmin.php">Log Out</a></li>';
				}
				else {
          header("Location:admin.php");
				}
				?>
			</ul>
		</div>
	</nav>
	<div style="overflow-x:auto;">
		<table class="table table-hover" id="dtAdmin">
	    <thead>
	        <tr>
	            <th>Username</th>
	            <th>Album</th>
	            <th>Total Stickers</th>
	            <th>Progress</th>
	        </tr>
	    </thead>
      <?php
			include "openconn.php";
			$query = "SELECT Users.username, `Sticker Album`.name, `Sticker Album`.`number of stickers`, UserStickerAlbum.`num stickers`
                FROM Users, `Sticker Album`, UserStickerAlbum
                WHERE Users.username = UserStickerAlbum.username AND `Sticker Album`.id = UserStickerAlbum.id  ORDER BY `username`, `Sticker Album`.name ASC";

      $stickers = mysqli_query($conn,"SELECT COUNT(id) FROM UserSticker WHERE username LIKE '".$_SESSION['loggedIn']."' AND id IN (SELECT id FROM `Sticker` WHERE sticker_album_id = 1)");
      $row = mysqli_fetch_array($stickers);
      $stickers = $row[0];

      $totalStickers = mysqli_query($conn, "SELECT `number of stickers` FROM `Sticker Album` WHERE id LIKE 1");
      $row = mysqli_fetch_array($totalStickers);
      $totalStickers = $row[0];

			$res = mysqli_query($conn, $query);
      ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($res)) { ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
          </tr>
      <?php } ?>
    </tbody>
</table>
</div>



	</body>
</html>
