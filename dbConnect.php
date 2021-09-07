<?php

$db_servername = "localhost";
$db_username = "myuser";
$db_password = "pass123";
$db = "interview_app";

$conn = new mysqli($db_servername, $db_username, $db_password);
mysqli_select_db ($conn, $db);

$status = "Connection failed: " . $conn -> connect_error;
if ($conn -> connect_error) {
    die($status) . "<br />";
}

?>
