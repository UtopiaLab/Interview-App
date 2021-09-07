<?php
session_start();
?>

<html lang="en">

<head>
    <title>Interview App</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>Welcome</h1>

<?php
    if (isset($_SESSION["logoutSuccess"])) {
        echo "<div>" . $_SESSION["logoutSuccess"] . "</div>";
        session_destroy();
    }
    if (isset($_SESSION["noLogin"])) {
        echo "<div>" . $_SESSION["noLogin"] . "</div>";
        session_destroy();
    }
?>

    <p>Please <a href="login.php">Login</a> or <a href="signup.php">Signup</a> to continue!</p>
</body>

</html>