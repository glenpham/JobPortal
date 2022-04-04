<?php 
session_start();
//echo print_r($_SESSION,true);
$array_result = SelectAll();

function SelectAll(){
    $array_result = array();
    $companyID = $_SESSION['companyID'];
    // $jobID =  basename($_SERVER["PHP_SELF"]);

    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "mydb";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if($conn ->connect_error){
        die("Failed! ". $conn->connect_error);
    }
    
    // $sql = "select jobpostactivity.id, postingID, jobTitle, candidateID, appliedDate, companyStatus, candidateStatus, cv  from jobpostactivity INNER JOIN postingposition on jobpostactivity.postingID = postingposition.ID where postingposition.ID = $jobID";
    $sql = "select jobpostactivity.id, postingID, jobTitle, candidateID, appliedDate, companyStatus, candidateStatus, candidate.firstname, candidate.lastname  from jobpostactivity 
        INNER JOIN postingposition on jobpostactivity.postingID = postingposition.ID 
        INNER JOIN candidate on jobpostactivity.candidateID = candidate.user_id
        where companyID = $companyID 
        order by postingID";
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
