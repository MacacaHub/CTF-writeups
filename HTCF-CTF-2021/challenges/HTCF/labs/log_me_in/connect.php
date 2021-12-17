<?php
$servername = "login_db";
$username = "user_manager";
$password = "user_manager_p@ssw0rd";
$dbname = "usersdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$conn->autocommit(FALSE);
