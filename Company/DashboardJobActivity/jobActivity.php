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
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <input type="text" name="search" id="search-id-nn" value="">
    <input type="button" value="Show Result" class="submit-search-btn">

    <table id="customers">
        <?php include 'includeTable.php' ; ?>
    </table>

    <?php include '../footer.php' ; ?>
    
</body>
</html>
