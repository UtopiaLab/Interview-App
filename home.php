<?php
session_start();
?>

<html lang="en">

<head>
    <title>Interview App</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Home</h1>

<?php
if (isset($_SESSION["name"]) and isset($_SESSION["role"])) {
    echo "<h2> Welcome " . $_SESSION["name"] . "!</h2><br/>";
}
else {
    $_SESSION["noLogin"] = "You are not logged in!";
    header("Location: index.php");
    exit();
}
?>

<div class="form-input">
    <form method="post" action="logout.php">

        <input name="submit" type="submit" value="Logout">

    </form>

</div>

</body>
</html>