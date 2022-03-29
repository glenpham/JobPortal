<?php
session_start();
$email = $password = '';
$inputErr = '';
$is_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
      $inputErr = "Log in or password invalid";
      $is_error = true;
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $inputErr = "Log in or password invalid";
        $is_error = true;
      }
    }

    if (empty($_POST["password"])) {
        $inputErr = "Log in or password invalid";
        $is_error = true;
    } else {
        $password = test_input($_POST["password"]);
    }

    if ($is_error == false) {
        $inputErr = loginAccount();
    }
}

$array_result = SelectAvailableJob();

function loginAccount(){
    $inputErr = "";
    include_once 'database.php';
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $decryption_iv = '1234567891011121';
    $decryption_key = "GeeksforGeeks";

    $sqlcompanyaccount = "select * from companyaccount where email = '$_POST[email]'"; 
    $resultCompany = $conn->query($sqlcompanyaccount); 
    // $sqlCandidateTable = "select * from candidateTable where email = '$_POST[email]'"; 
    // $resultCandidate = $conn->query($sqlCandidateTable);   

    if ($resultCompany->num_rows >0){
      $row = $resultCompany->fetch_assoc();
      $decryption=openssl_decrypt ($row['password'], $ciphering, $decryption_key, $options, $decryption_iv);

      if($_POST['password'] == $decryption){
        $_SESSION["companyID"] = $row['id'];
        header("Location:Company/DashboardJobPosting/dashboard.php");
        die();
      }
      else{
        $inputErr = "Log in or password invalid";
      }
    } 
    // elseif ($resultCandidate->num_rows >0){
    //         $row = $resultCandidate->fetch_assoc();
    //         $decryption=openssl_decrypt ($row['password'], $ciphering, $decryption_key, $options, $decryption_iv);

    //         if($_POST['password'] == $decryption){
    //             $user = $row['email'];
    //         }
    //         else{
    //           $inputErr = "Log in or password invalid";
    //         }
    //     }
    else{
      $inputErr = "Log in or password invalid";
    }
    $conn->close();
    return $inputErr;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function SelectAvailableJob(){
    $array_result = array();
    include_once 'database.php';
    $sql = "select * from postingposition INNER JOIN companyaccount on companyaccount.id = postingposition.companyID where status='active' or status='hold'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $array_result = $result->fetch_all(MYSQLI_ASSOC); 
    }
    else{
        echo $conn->connect_error;
    }
    $conn->close();
    return $array_result;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Hello, world!</title>
  </head>
  <body>

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">JOB PORTAL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
    </div>
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="Company/register.php">Employee Sign up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Candidate/signup.php">Candidate Sign up</a>
        </li>
      </ul>
  </div>
</nav> -->

<!-- <nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value = "<?php echo $email; ?>">
        <p class = "error-msg"><?php echo $inputErr;?></p>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value = "<?php echo $password; ?>">
        <p class = "error-msg"><?php echo $inputErr;?></p>
        <button type="submit">Submit</button>
    </form>
  </div>
</nav> -->


    <div class="login">
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="messageErr"><?php echo $inputErr;?></div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value = "<?php echo $email; ?>">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value = "<?php echo $password; ?>">
        <button type="submit">Submit</button>
      </form>
    </div>

    <div class="navbar">
      <a class="active">JOB PORTAL</a>
      <a href="#">Find jobs</a>
      <a href="Candidate/signup.php" class="right">Candidate Sign up</a>
      <a href="Company/register.php" class="right">Employee Sign up</a>
    </div>



    <div class="searchJob">

    </div>

    <table id="customers">
      <?php include 'includeTable.php' ; ?>
    </table>

    <div class="footer">
      <h2>Footer</h2>
    </div>
  </body>
</html>
