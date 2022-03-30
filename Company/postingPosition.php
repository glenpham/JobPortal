<?php
session_start();
$jobTitle = $jobType = $jobLocation = $jobDescription = $salary = $benefits = $status ='';
$jobTitleErr = $jobTypeErr = $jobLocationErr = $jobDescriptionErr = $salaryErr = $benefitsErr = $statusErr ='';
$is_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["jobTitle"])) {
      $jobTitleErr = "Job Title is required";
      $is_error = true;
    } else {
        $jobTitle = test_input($_POST["jobTitle"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$jobTitle)) {
          $jobTitleErr = "Invalid name format";
          $is_error = true;
        }
    }

    if (empty($_POST["jobType"])) {
        $jobTypeErr = "Job Type is required";
        $is_error = true;
    } else {
        $jobType = test_input($_POST["jobType"]);
    }

    if (empty($_POST["jobLocation"])) {
        $jobLocationErr = "Job location is required";
        $is_error = true;
    } else {
        $jobLocation = test_input($_POST["jobLocation"]);
    }
      
    if (empty($_POST["jobDescription"])) {
        $jobDescriptionErr = "Description is required";
        $is_error = true;
    } else {
        $jobDescription = test_input($_POST["jobDescription"]);
    }

    if (empty($_POST["salary"])) {
        $salary = "";
    } else {
        $salary = test_input($_POST["salary"]);
    }
   
    if (empty($_POST["benefits"])) {
        $benefits = "";
    } else {
        $benefits = test_input($_POST["benefits"]);
    }

    $status = $_POST["status"];

    if ($is_error == false) {
        InsertValue();
    }
}

function InsertValue(){
    $companyID = $_SESSION['companyID'];
    include_once '../database.php';

    $sql = "insert into postingPosition (companyID, jobTitle, jobType, jobLocation, jobDescription, salary, benefits, status, createdDate) 
        values($companyID, '$_POST[jobTitle]', '$_POST[jobType]','$_POST[jobLocation]','$_POST[jobDescription]','$_POST[salary]','$_POST[benefits]','$_POST[status]', CURDATE())";    
    if($conn->query($sql)=== true){
        echo 'Job Posted';
    }
    else{
        echo 'Error. Please try again.';
    }
    $conn->close();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>


    <div class="navbar">
          <a class="active">JOB PORTAL</a>
          <a>Job Posting</a>
          <a href="DashboardJobPosting/dashboard.php">View Job Activity</a>
    </div>

    <div>
        <h1>Post Job</h1>
    </div>

    <div class="container">
        <div class="maindiv">
        <div class="col-6">

            <p><span class="error-msg">* required field</span></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="jobTitle">Title<span class = "error-msg" >*<span></label>
                <input type="text" class ="input-div-nn" id="jobTitle" name = "jobTitle" value = "<?php echo $jobTitle; ?>">
                <p class = "error-msg"><?php echo $jobTitleErr;?></p>

                <label for="jobType">Type (Full-Time, Part-Time, Permanent,...)<span class = "error-msg" >*</label>
                <input type="text" class ="input-div-nn" id="jobType" name="jobType" value = "<?php echo $jobType; ?>">
                <p class = "error-msg"><?php echo $jobTypeErr;?></p>

                <label for="jobLocation">Job Location<span class = "error-msg" >*</label>
                <input type="text" class ="input-div-nn" id="jobLocation" name="jobLocation" value = "<?php echo $jobLocation; ?>">
                <p class = "error-msg"><?php echo $jobLocationErr;?></p>

                <label for="jobDescription">Description<span class = "error-msg" >*</label>
                <textarea class ="input-div-nn" id="jobDescription" name="jobDescription" rows="5" cols="40"><?php echo $jobDescription;?></textarea>
                <p class = "error-msg"><?php echo $jobDescriptionErr;?></p>

                <label for="salary">Salary</label>
                <input type="text" class ="input-div-nn" id="salary" name="salary" value = "<?php echo $salary; ?>">
                <p class = "error-msg"><?php echo $salaryErr;?></p>

                <label for="benefits">Benefits Available</label>
                <textarea class ="input-div-nn" id="benefits" name="benefits" rows="5" cols="40"><?php echo $benefits;?></textarea>
                <p class = "error-msg"><?php echo $benefitsErr;?></p>

                Status :
                    <input type="radio" name="status" <?php if (isset($status) && $status=="active") echo "checked";?> value="active" checked>Active
                    <input type="radio" name="status" <?php if (isset($status) && $status=="closed") echo "checked";?> value="closed">Closed
                    <input type="radio" name="status" <?php if (isset($status) && $status=="hold") echo "checked";?> value="hold">Hold  
                    <span class="error-msg">*</span>
                    <p class = "error-msg"><?php echo $statusErr;?></p>

                <input type="submit" class="submit" value="Submit!">
            </form>
        </div>
        <div class="col-6"></div>
        </div>
    </div>

    <?php include '../footer.php' ; ?>

</body>
</html>
