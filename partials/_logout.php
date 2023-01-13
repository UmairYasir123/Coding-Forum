<?php
echo "logging you out...please wait....";
session_start();
session_unset();
session_destroy();
header("location:/forums/index.php");
?>