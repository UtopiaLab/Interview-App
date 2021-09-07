<?php
session_start();
?>

<html lang="en">

<head>
    <title>Interview App</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<?php  
if (isset($_REQUEST["submit"])) {
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    require_once "dbConnect.php";
    $queryLogin = "SELECT * FROM users WHERE email='$email";
    $result = $conn -> query($queryLogin);
    if (($result -> num_rows) == 1) {
        $dataSet = $result -> fetch_array(MYSQLI_ASSOC);
        if (password_verify($password, $dataSet["password"])) {
            $_SESSION["name"] = $dataSet["name"];
            $_SESSION["role"] = $dataSet["role"];
            header("Location: home.php");
            exit();
        }
    }
    else {
        $_SESSION["loginFail"] = "Invalid username or password!";
        header("Location: login.php");
        exit();
    }
}
?>

<body>
<h1>Login</h1>

<?php

if (isset($_SESSION["signupSuccess"])) {
    echo "<div>" . $_SESSION["signupSuccess"] . "</div>";
    session_destroy();
}
if (isset($_SESSION["loginFail"])) {
    echo "<div>" . $_SESSION["loginFail"] . "</div>";
    session_destroy();
}

?>

<p>Please fill the form below and click Login!</p>
<div class="form-input">
    <form method="post">

        <input name="email" placeholder="E-Mail Address" value="Email" type="text" title="Email will be used as your login username." required>

        <input name="password" placeholder="Password" value="password" type="password" title="Password" required>

        <input name="submit" type="submit" value="Login">

    </form>

</div>

</body>

</html>