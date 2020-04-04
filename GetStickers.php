<html>
<head>
    <title>CCG</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="general-style.css">
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
include 'openconn.php';
session_start();
for ($i = 0; $i < 5; $i++){
    $rand = rand(1,5);
    $result = mysqli_query($conn,"SELECT * FROM UserSticker WHERE id = '$rand'");
    if(mysqli_num_rows($result) == 0) {
        mysqli_query($conn, "INSERT INTO UserSticker (username, id, NumStickersID) VALUES ('{$_SESSION['loggedIn']}',$rand,1)");
    }else{
        mysqli_query($conn, "UPDATE UserSticker SET NumStickersID = NumStickersID+1 WHERE id = '$rand' AND username = '{$_SESSION['loggedIn']}'");
    }
}
$value = mysqli_fetch_assoc(mysqli_query($conn, "SELECT money FROM Users WHERE username = '{$_SESSION['loggedIn']}'"));

if ($value["money"] >= 5) {
    mysqli_query($conn, "UPDATE Users SET money = money-5 WHERE username LIKE '{$_SESSION['loggedIn']}'");
    echo "<h3>Buy Successful</h3>";
    header("refresh:1.5;url=store.php");
}else{
    echo "<h3>Not enough money</h3>";
    header("refresh:1.5;url=store.php");
}
?>
</body>
</html>
