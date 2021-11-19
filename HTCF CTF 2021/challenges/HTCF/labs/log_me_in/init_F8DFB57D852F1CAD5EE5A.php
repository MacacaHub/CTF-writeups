<?php
include('connect.php');

$sql = "DROP TABLE IF EXISTS Users;";
$sql .= "CREATE TABLE Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);";

$sql .= "INSERT INTO Users (username, password) VALUES ('admin', 'ifb#jwpf@IFB429-iJJ');";
$sql .= "INSERT INTO Users (username, password) VALUES ('guest', 'guest');";

if ($conn->multi_query($sql) === TRUE) {
    echo "Initialization successful<br>";
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
