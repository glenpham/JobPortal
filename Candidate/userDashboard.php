<?php

session_start();
//print_r($_SESSION);
require 'selectAll.php';
$array_result = SelectAll();

/*
if(isset($_SESSION['id'])){
    include_once 'navbar.php';
    insertValue();
}
else{
    echo 'Error with issset';
}


function insertValue(){
    //$array_result = array();

    include 'db.php';

    if($conn ->connect_error){
        die("Failed! ". $conn->connect_error);
    }
    // echo $encryption;
    // exit;
    $sql = "SELECT * FROM candidate WHERE email = '$_SESSION[email]'";    
   
    $result = $conn->query($sql);

    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['user_id'];
        $firstName = $row['firstname'];
        $lastName = $row['lastname'];
        $address = $row['address'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        echo '<tr>
        <th scope="row"> '.$id.' </th>
        <td> ' .$firstName. ' </td>
        <td> ' .$lastName. ' </td>
        <td> ' .$address. ' </td>
        <td> ' .$mobile. ' </td>
        <td> ' .$email. ' </td>
        <td> ' .$firstName. ' </td>
        <td>
        <button class="btn btn-primary"><a href="" class="text-light">Update</a></button>
        <button class="btn btn-danger"><a href="" class="text-light">Delete</a></button>
        </td>
        </tr>';
        
        
    }

    $conn->close();

}
*/
?>


<!DOCTYPE html>
<html lang="en">
    <!---- Head Start ---->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Login</title>
    <link rel="stylesheet" href="../index.css">
    </head>
    <!---- Head End ---->

    <!---- Body Start ---->
    <body>
        <?php include 'candidateNavbar.php'; ?>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    include '../database.php';

                    if($conn ->connect_error){
                        die("Failed! ". $conn->connect_error);
                    }
                    // echo $encryption;
                    // exit;
                    $sql = "SELECT * FROM candidate WHERE email = '$_SESSION[email]'";    

                    $result = $conn->query($sql);

                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['user_id'];
                        $firstName = $row['firstname'];
                        $lastName = $row['lastname'];
                        $address = $row['address'];
                        $mobile = $row['mobile'];
                        $email = $row['email'];
                        echo '<tr>

                        <td> ' .$firstName. ' </td>
                        <td> ' .$lastName. ' </td>
                        <td> ' .$address. ' </td>
                        <td> ' .$mobile. ' </td>
                        <td> ' .$email. ' </td>
                        <td>
                            <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Update</a></button>
                            <button class="btn btn-secondary"><a href="#" class="text-light">Add Experience</a></button>
                            <button class="btn btn-secondary"><a href="#" class="text-light">Add Education</a></button>
                    
                        </td>
                        </tr>';
                    }
                
                    $conn->close();
                ?>
            </tbody>
        </table>
        <div class="container">
            Applied Jobs
            <table id="customers">
                <?php include 'includeTable.php' ; ?>
            </table> 
        </div>
    </body>
    <!---- Body End ---->
</html>