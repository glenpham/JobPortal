<?php 
session_start();
Select_Result();

function Select_Result(){
    $array_result = array();
    $companyID = $_SESSION['companyID'];

    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "mydb";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn ->connect_error){
        die("Failed! ". $conn->connect_error);
    }

    $sql = "Select * from postingposition where (id like '%$_POST[search_keyword]%' OR jobTitle like '%$_POST[search_keyword]%') and companyID = $companyID";   
    $result = $conn->query($sql);
    if($result->num_rows >0){
        $array_result = $result->fetch_all(MYSQLI_ASSOC); 
        $html = include 'includeTable.php';
        return $html;
    }
    else{
        echo $conn->connect_error;
        }
        $conn->close();
        return $array_result;
} 
?>