<?php

include_once '../../database.php';

$sql = "CREATE TABLE jobpostactivity (
id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
candidateID INT(7) NOT NULL,
postingID INT(7) NOT NULL,
appliedDate DATE NOT NULL,
companyStatus VARCHAR(30) NOT NULL,
candidateStatus VARCHAR(30) NOT NULL,
cv VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
echo "Table created successfully";
} else {
echo "Error creating table: " . $conn->error;
}
$conn->close();
?>


