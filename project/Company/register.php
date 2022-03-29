<?php

$email = $password = $companyName = $description = $website = $address = $city = $province = $country ='';
$emailErr = $passwordErr = $companyNameErr = $descriptionErr = $websiteErr = $addressErr = $cityErr = $provinceErr = $countryErr ='';
$is_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
      $is_error = true;
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $is_error = true;
      }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $is_error = true;
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($_POST["companyName"])) {
      $companyNameErr = "Company Name is required";
      $is_error = true;
    } else {
      $companyName = test_input($_POST["companyName"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/",$companyName)) {
        $companyNameErr = "Invalid name format";
        $is_error = true;
      }
    }
      
    if (empty($_POST["description"])) {
        $descriptionErr = "Description is required";
        $is_error = true;
    } else {
        $description = test_input($_POST["description"]);
    }

    if (empty($_POST["website"])) {
      $website = "";
    } else {
      $website = test_input($_POST["website"]);
          if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
        $websiteErr = "Invalid URL format";
        $is_error = true;
      }
    }
   
    if (empty($_POST["address"])) {
        $address = "";
      } else {
        $address = test_input($_POST["address"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$address)) {
          $addressErr = "Invalid format";      
          $is_error = true;
        }
      }

      if (empty($_POST["city"])) {
        $city = "";
      } else {
        $city = test_input($_POST["city"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$city)) {
          $cityErr = "Invalid format";
          $is_error = true;
        }
      }

      if (empty($_POST["province"])) {
        $province = "";
      } else {
        $province = test_input($_POST["province"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$province)) {
          $provinceErr = "Invalid format";
          $is_error = true;
        }
      }

      if (empty($_POST["country"])) {
        $country = "";
      } else {
        $country = test_input($_POST["country"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$country)) {
          $countryErr = "Invalid format";
          $is_error = true;
        }
      }

    if ($is_error == false) {
        InsertValue();
    }
}

function InsertValue(){
    include_once '../database.php';

    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = "GeeksforGeeks";

    $encryption = openssl_encrypt($_POST['password'], $ciphering,
    $encryption_key, $options, $encryption_iv);

    $isEmailAvailable = "select * from companyAccount where email = '$_POST[email]'";    
    $result = $conn->query($isEmailAvailable);
    if($result->num_rows > 0){
        $emailErr = 'Email already exists'; 
    }
    else{
        $sql = "insert into companyAccount (email, password, companyName, description, website, address, city, province, country) values('$_POST[email]', '$encryption','$_POST[companyName]','$_POST[description]','$_POST[website]','$_POST[address]','$_POST[city]','$_POST[province]','$_POST[country]')";    
        if($conn->query($sql)=== true){
            echo 'Account Created';
            // $email = $password = '';
        }
        else{
            echo 'Error. Please try again.';
        }
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
    <div class="container">
        <div class="maindiv">
        <div class="col-6">

            <p><span class="error-msg">* required field</span></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="email">Email<span class = "error-msg" >*<span></label>
                <input type="email" class ="input-div-nn" id="email" name = "email" value = "<?php echo $email; ?>">
                <p class = "error-msg"><?php echo $emailErr;?></p>

                <label for="password">Password<span class = "error-msg" >*</label>
                <input type="password" class ="input-div-nn" id="password" name="password" value = "<?php echo $password; ?>">
                <p class = "error-msg"><?php echo $passwordErr;?></p>

                <label for="companyName">Company Name<span class = "error-msg" >*</label>
                <input type="text" class ="input-div-nn" id="companyName" name="companyName" value = "<?php echo $companyName; ?>">
                <p class = "error-msg"><?php echo $companyNameErr;?></p>

                <label for="description">Description<span class = "error-msg" >*</label>
                <textarea class ="input-div-nn" id="description" name="description" rows="5" cols="40"><?php echo $description;?></textarea>
                <p class = "error-msg"><?php echo $descriptionErr;?></p>

                <label for="website">Website</label>
                <input type="text" class ="input-div-nn" id="website" name="website" value = "<?php echo $website; ?>">
                <p class = "error-msg"><?php echo $websiteErr;?></p>

                <label for="address">Address</label>
                <input type="text" class ="input-div-nn" id="address" name="address" value = "<?php echo $address; ?>">
                <p class = "error-msg"><?php echo $addressErr;?></p>

                <label for="city">City</label>
                <input type="text" class ="input-div-nn" id="city" name="city" value = "<?php echo $city; ?>">
                <p class = "error-msg"><?php echo $cityErr;?></p>

                <label for="province">Province</label>
                <input type="text" class ="input-div-nn" id="province" name="province" value = "<?php echo $province; ?>">
                <p class = "error-msg"><?php echo $provinceErr;?></p>

                <label for="country">Country</label>
                <input type="text" class ="input-div-nn" id="country" name="country" value = "<?php echo $country; ?>">
                <p class = "error-msg"><?php echo $countryErr;?></p>
                <a href="/JA-project/index.php" class="href">Log in</a>

                <input type="submit" class="submit" value="Create an account">
            </form>
        </div>
        <div class="col-6"></div>
        </div>
    </div>
</body>
</html>
