<html lang="en">

<head>
    <title>Interview App</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Login</h1>

<?php

if (isset($_SESSION["signupSuccess"])) {
    echo "<div>" . $_SESSION["signupSuccess"] . "</div>";
}

?>

</body>

</html>