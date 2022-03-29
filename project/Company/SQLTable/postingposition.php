<?php

include_once '../../database.php';

$sql = "CREATE TABLE postingPosition (
id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
companyID INT(7) NOT NULL,
jobTitle VARCHAR(50) NOT NULL,
jobType VARCHAR(30) NOT NULL,
jobLocation VARCHAR(50) NOT NULL,
jobdescription VARCHAR(100) NOT NULL,
salary VARCHAR(50),
benefits VARCHAR(50),
status VARCHAR(30) NOT NULL,
createdDate DATE NOT NULL
)";

if ($conn->query($sql) === TRUE) {
echo "Table created successfully";
} else {
echo "Error creating table: " . $conn->error;
}
$conn->close();
?>


