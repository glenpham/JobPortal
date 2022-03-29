<?php

include_once '../../database.php';

$sql = "CREATE TABLE companyAccount (
id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
password VARCHAR(30) NOT NULL,
companyName VARCHAR(50) NOT NULL,
description VARCHAR(100) NOT NULL,
website VARCHAR(50),
address VARCHAR(50),
city VARCHAR(30) NOT NULL,
province VARCHAR(30),
country VARCHAR(30)
)";

if ($conn->query($sql) === TRUE) {
echo "Table created successfully";
} else {
echo "Error creating table: " . $conn->error;
}
$conn->close();
?>


