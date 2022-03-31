<?php 

AcceptCandidate();

function AcceptCandidate(){
   $array_result = array();
   $job_id =  $_POST['job_id'];
   require 'selectAll.php';

   include '../../database.php';

   $sql = "update jobpostactivity set companyStatus = 'accept' where id = $job_id";
   if($conn->query($sql)){
        $array_result = SelectAll();
        $html = include 'includeTable.php';
        return $html;
    }
    else{
        echo "error".$conn->connect_error;
    }
    $conn->close();
}

?>