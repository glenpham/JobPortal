<?php
    session_start();
    echo print_r($_SESSION,true);
    $candidateID = $_SESSION['candidateID'];
    $jobID= $_GET['jobID'];

    include '../database.php';

    $sqlVerify = "select * from jobpostactivity WHERE candidateID = $candidateID  AND postingID = $jobID";
    $sqlInsert = "insert into jobpostactivity (candidateID, postingID) VALUES ($candidateID, $jobID)";

    $result = $conn->query($sqlVerify);
    if($result->num_rows > 0){
        echo "<script>alert('Already Applied');document.location='jobs.php'</script>";
    }
    else{
        $conn->query($sqlInsert);
        //echo "<script>alert('Application Successful');document.location='jobs.php'</script>";
    }
    $conn->close();
?>