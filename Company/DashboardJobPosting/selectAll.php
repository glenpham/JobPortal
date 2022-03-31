<?php 
session_start();
$array_result = SelectAll();

function SelectAll(){
    $array_result = array();
    $companyID = $_SESSION['companyID'];

    include '../../database.php';
    
    $sql = "select * from postingposition where companyID = $companyID";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $array_result = $result->fetch_all(MYSQLI_ASSOC); 
    }
    else{
        echo $conn->connect_error;
    }
    $conn->close();
    return $array_result;
}

?>