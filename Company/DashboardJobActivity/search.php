<?php 
session_start();
Select_Result();

function Select_Result(){
    $array_result = array();
    $companyID = $_SESSION['companyID'];

    include '../../database.php';

    $sql = "select jobpostactivity.id, postingID, jobTitle, candidateID, appliedDate, companyStatus, candidateStatus, cv, candidate.firstname, candidate.lastname  
        FROM jobpostactivity 
        INNER JOIN postingposition on jobpostactivity.postingID = postingposition.ID 
        INNER JOIN candidate on jobpostactivity.candidateID = candidate.user_id
        WHERE companyID = $companyID and (postingID like '%$_POST[search_keyword]%' OR jobTitle like '%$_POST[search_keyword]%')
        order by postingID";
    $result = $conn->query($sql);
    if($result->num_rows >0){
        $array_result = $result->fetch_all(MYSQLI_ASSOC); 
        $html = include 'includeTable.php';
        return $html;
    }
    else{
        echo "No record";
        }
        $conn->close();
        return $array_result;
} 
?>
