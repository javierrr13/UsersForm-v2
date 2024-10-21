<?php
    $connection = mysqli_connect(
        $hostname = "localhost",
        $username = "root",
        $password = "",
        $database = "users"
    );
    if(!$connection){echo "error conect";}
?>