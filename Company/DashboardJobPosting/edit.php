<?php

session_start();
$url_value = explode('/',$_SERVER['PHP_SELF']);

if(!array_key_exists('5',$url_value)||$url_value[5] == '' ){
    echo "PAGE NOT FOUND";
    die;
}
else{
    $array_result = CheckData($url_value);
}

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
        UpdateData($url_value);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function CheckData($url_value ){
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn ->connect_error){
        die("Failed! ". $conn->connect_error);
    }

    $sql = "select * from postingposition where id = $url_value[5]";    
    $result = $conn->query($sql);

    if($result->num_rows >0){
        $array_result = $result->fetch_assoc(); 
    }
    else{
        echo "NO RECORD FOUND!";exit;
    }
    $conn->close();
    return $array_result;
}
        
function UpdateData($url_value){
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn ->connect_error){
        die("Failed! ". $conn->connect_error);
    }

    $sql = "update postingposition set jobTitle='$_POST[jobTitle]', 
        jobType='$_POST[jobType]', jobLocation='$_POST[jobLocation]',jobdescription = '$_POST[jobDescription]',
        salary = '$_POST[salary]', benefits = '$_POST[benefits]', status = '$_POST[status]'
        where id=$url_value[5]";

    if($conn->query($sql)=== true){
        $message='Job post updated!';
        echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
    }
    else{
        echo "error".$conn->connect_error;
    }
    $conn->close();
}

?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
  <link rel="stylesheet" href="/JobPortal/index.css">
</head>
<body>

    <?php include '../../navbar.php' ; ?>

    <div class="container">
            <p><span class="error-msg">* required field</span></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="jobTitle">Title<span class = "error-msg" >*<span></label>
                <input type="text" class ="input-div-nn" id="jobTitle" name = "jobTitle" value = "<?php echo $jobTitle == '' ? $array_result['jobTitle'] : $jobTitle; ?>">
                <p class = "error-msg"><?php echo $jobTitleErr;?></p>

                <label for="jobType">Type (Full-Time, Part-Time, Permanent,...)<span class = "error-msg" >*</label>
                <input type="text" class ="input-div-nn" id="jobType" name="jobType" value = "<?php echo $jobType == '' ? $array_result['jobType'] : $jobType; ?>">
                <p class = "error-msg"><?php echo $jobTypeErr;?></p>

                <label for="jobLocation">Job Location<span class = "error-msg" >*</label>
                <input type="text" class ="input-div-nn" id="jobLocation" name="jobLocation" value = "<?php echo $jobLocation == '' ? $array_result['jobLocation'] : $jobLocation; ?>">
                <p class = "error-msg"><?php echo $jobLocationErr;?></p>

                <label for="jobDescription">Description<span class = "error-msg" >*</label>
                <textarea class ="input-div-nn" id="jobDescription" name="jobDescription" rows="5" cols="40"><?php echo $jobDescription == '' ? $array_result['jobdescription'] : $jobDescription; ?></textarea>
                <p class = "error-msg"><?php echo $jobDescriptionErr;?></p>

                <label for="salary">Salary</label>
                <input type="text" class ="input-div-nn" id="salary" name="salary" value = "<?php echo $salary == '' ? $array_result['salary'] : $salary; ?>">
                <p class = "error-msg"><?php echo $salaryErr;?></p>

                <label for="benefits">Benefits Available</label>
                <textarea class ="input-div-nn" id="benefits" name="benefits" rows="5" cols="40"><?php echo $benefits == '' ? $array_result['benefits'] : $benefits; ?></textarea>
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
    
    <?php include '../../footer.php' ; ?>

</body>
</html>

