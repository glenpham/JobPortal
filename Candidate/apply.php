<?php
    session_start();
    echo print_r($_SESSION,true);
    if(isset($_SESSION['candidateID'])){
        echo '<br>';
        echo $_SESSION['candidateID'];
    }
    else{
        echo "No ID found!!!";
    }

?>