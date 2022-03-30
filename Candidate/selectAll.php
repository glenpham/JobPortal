<?php 
//session_start();
$array_result = SelectAll();

function SelectAll(){
    $array_result = array();
    //$companyID = $_SESSION['companyID'];
    $candidateID = $_SESSION['candidateID'];

    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "mydb";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if($conn ->connect_error){
        die("Failed! ". $conn->connect_error);
    }

    $sql = "select jobTitle, appliedDate, companyStatus, candidateStatus, cv  from jobpostactivity INNER JOIN postingposition on jobpostactivity.postingID = postingposition.ID where jobpostactivity.candidateID = $candidateID";
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