<?php 
session_start();
$array_result = SelectAll();

function SelectAll(){
    $array_result = array();
    $companyID = $_SESSION['companyID'];
    // $jobID =  basename($_SERVER["PHP_SELF"]);

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
