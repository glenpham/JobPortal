<?php
require 'selectAll.php';
$array_result = SelectAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../index.css">
</head>
<body>

    <div class="navbar">
          <a class="active">JOB PORTAL</a>
          <a href="../postingPosition.php">Job Posting</a>
          <a>View Job Activity</a>
    </div>

    <div>
        <h1>Job Activity</h1>
    </div>

    <div class="search">
        <input type="text" name="search" id="search-id-nn" value="">
        <input type="button" value="Show Result" class="submit-search-btn">
    </div>

    <div class="contentTable">
    <table id="myTable">
        <?php include 'includeTable.php' ; ?>
    </table>
    </div>

    <?php include '../footer.php' ; ?>
    
</body>
</html>
