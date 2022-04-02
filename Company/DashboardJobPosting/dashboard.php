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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/JobPortal/index.css">
</head>
<body>

    <?php include '../../navbar.php' ; ?>

    <div class="container">
        <h1>Jobs Posted</h1>
        <input type="text" name="search" id="search-id-nn" value="" placeholder="Search by job title or by ID">
        <input type="button" value="Show Result" class="submit-search-btn">
    </div>

    <div class="contentTable">
        <table id="myTable">
            <?php include 'includeTable.php' ; ?>
        </table>
    </div>

    <?php include '../../footer.php' ; ?>

</body>
</html>
