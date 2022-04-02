<?php

session_start();
$url_value = explode('/',$_SERVER['PHP_SELF']);
echo print_r($url_value, true);

if(!array_key_exists('4',$url_value)||$url_value[4] == '' ){
    echo "PAGE NOT FOUND";
    die;
}
else{
    $array_result = CheckData($url_value);
}

$firstName = $lastName = $address = $mobile = $education = $experience = "";
$firstNameErr = $lastNameErr = $addressErr = $mobileErr = $educationErr = $experienceErr ='';
$is_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstName"])) {
        $firstName = "First Name is required";
        $is_error = true;
    } else {
        $firstName = test_input($_POST["firstName"]);
    }

    if (empty($_POST["lastName"])) {
        $lastName = "Last Name is required";
        $is_error = true;
    } else {
        $lastName = test_input($_POST["lastName"]);
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
        $is_error = true;
    } else {
        $addressErr = test_input($_POST["address"]);
    }
      
    if (empty($_POST["mobile"])) {
        $mobileErr = "Mobile Number is required";
        $is_error = true;
    } else {
        $mobileErr = test_input($_POST["mobile"]);
    }

    if (empty($_POST["education"])) {
        $educationErr = "Education is required (Min. 1)";
        $is_error = true;
    } else {
        $educationErr = test_input($_POST["education"]);
    }
   
    if (empty($_POST["experience"])) {
        $experienceErr = "Experience is required (Min. 1 Job)";
        $is_error = true;
    } else {
        $experienceErr = test_input($_POST["experience"]);
    }

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

    include '../database.php';

    $sql = "select * from candidate where user_id = $url_value[4]";    
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

    include '../database.php';

    $sql = "update candidate set 
        firstname ='$_POST[firstName]', lastname='$_POST[lastName]', address='$_POST[address]',
        mobile = '$_POST[mobile]', education = '$_POST[education]', experience = '$_POST[experience]'
        where user_id=$url_value[4]";

    if($conn->query($sql)=== true){
        echo "<script>alert('CV updated!');document.location='../userDashboard.php'</script>";
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

    <?php include '../navbar.php' ; ?>

    <div class="container">
            <p><span class="error-msg">* required field</span></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="firstName">First Name<span class = "error-msg" >*<span></label>
                <input type="text" class ="input-div-nn" id="firstName" name = "firstName" value = "<?php echo $firstName == '' ? $array_result['firstname'] : $firstName; ?>">
                <p class = "error-msg"><?php echo $firstNameErr;?></p>

                <label for="lastName">Last Name<span class = "error-msg" >*</label>
                <input type="text" class ="input-div-nn" id="lastName" name="lastName" value = "<?php echo $lastName == '' ? $array_result['lastname'] : $lastName; ?>">
                <p class = "error-msg"><?php echo $lastNameErr;?></p>

                <label for="jobLocation">Address<span class = "error-msg" >*</label>
                <input type="text" class ="input-div-nn" id="address" name="address" value = "<?php echo $address == '' ? $array_result['address'] : $adrdess; ?>">
                <p class = "error-msg"><?php echo $addressErr;?></p>

                <label for="mobile">Mobile Number<span class = "error-msg" >*</label>
                <input type="text" class ="input-div-nn" id="mobile" name="mobile" value = "<?php echo $mobile == '' ? $array_result['mobile'] : $mobile; ?>">
                <p class = "error-msg"><?php echo $mobileErr;?></p>

                <label for="education">Education</label>
                <input type="text" class ="input-div-nn" id="education" name="education" value = "<?php echo $education == '' ? $array_result['education'] : $education; ?>">
                <p class = "error-msg"><?php echo $educationErr;?></p>

                <label for="experience">Experience</label>
                <input type="text" class ="input-div-nn" id="experience" name="experience" value = "<?php echo $experience == '' ? $array_result['experience'] : $experience; ?>">
                <p class = "error-msg"><?php echo $experienceErr;?></p>

                <input type="submit" class="submit" value="Submit!">
            </form>
    </div>
    
    <?php include '../footer.php' ; ?>

</body>
</html>

