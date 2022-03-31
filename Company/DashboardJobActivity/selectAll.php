<?php 
session_start();
echo print_r($_SESSION,true);
$array_result = SelectAll();

function SelectAll(){
    $array_result = array();
    // $companyID = $_SESSION['companyID'];
    $jobID =  $_GET['jobID'];

    include '../../database.php';

    $sql = "select jobpostactivity.id, postingID, jobTitle, candidateID, appliedDate, companyStatus, candidateStatus, cv  from jobpostactivity INNER JOIN postingposition on jobpostactivity.postingID = postingposition.ID where postingposition.ID = $jobID";
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
