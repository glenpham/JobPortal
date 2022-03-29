<?php

$currentDir = getcwd();
echo $currentDir."</br>";
$targetDir = $currentDir;
echo $targetDir;
if(!is_dir($currentDir)){
    $result = mkdir($currentDir, "0777");
}

// Check if $_FILES is an array
if(is_array($_FILES)) {
    // Check if file was upload via POST method
    if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"$targetDir/".
        $_FILES['fileToUpload']['name'])){
            //echo "File uploaded successfully";
            header("Location: userDashboard.php");
        }
    }
}

?>