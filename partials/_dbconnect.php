<?php
$username = "root";
$servername = "localhost";
$password = "";
$database = "iDiscuss";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    echo ("error:".mysqli_error($conn));
}

?>