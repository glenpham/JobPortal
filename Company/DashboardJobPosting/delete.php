<?php 

DeleteRecord();

function DeleteRecord (){
   $array_result = array();
   $job_id =  $_POST['job_id'];
   require 'selectAll.php';
   echo "delete";

   include '../../database.php';

   $sql = "delete from postingposition where id = $job_id";
   if($conn->query($sql)){
        $array_result = selectAll();
        $html = include 'includeTable.php';
    }
    else{
        echo "error".$conn->connect_error;
    }
    $conn->close();
    return $html;    
}

?>