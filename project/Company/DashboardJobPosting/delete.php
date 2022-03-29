<?php 

DeleteRecord();

function DeleteRecord (){
   $array_result = array();
   $job_id =  $_POST['job_id'];
   require 'selectAll.php';

   $servername = "localhost";
   $username = "root";
   $password = ""; 
   $dbname = "mydb";
   $conn = new mysqli($servername, $username, $password, $dbname);
   
   if($conn ->connect_error){
       die("Failed! ". $conn->connect_error);
   }

   $sql = "delete from postingposition where id = $job_id";
   if($conn->query($sql)){
        $array_result = selectAll();
        $html = include 'includeTable.php';
        return $html;
    }
    else{
        echo "error".$conn->connect_error;
    }
    $conn->close();
}

?>