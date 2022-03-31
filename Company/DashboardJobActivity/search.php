<?php 
session_start();
Select_Result();

function Select_Result(){
    $array_result = array();
    $companyID = $_SESSION['companyID'];

    include '../../database.php';

    $sql = "select jobpostactivity.id, postingID, jobTitle, candidateID, appliedDate, companyStatus, candidateStatus, cv  from jobpostactivity INNER JOIN postingposition on jobpostactivity.postingID = postingposition.ID where (companyID = $companyID and postingID = $_POST[search_keyword])";
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