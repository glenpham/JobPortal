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

    $sqlCandidateAccount = "select * from candidate where email = '$_POST[email]'"; 
    $resultCandidate = $conn->query($sqlCandidateAccount);   

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
    elseif ($resultCandidate->num_rows >0){
      $row = $resultCandidate->fetch_assoc();
      $decryption=openssl_decrypt ($row['password'], $ciphering, $decryption_key, $options, $decryption_iv);

      if($_POST['password'] == $decryption){
        $_SESSION["candidateID"] = $row['user_id'];
        $_SESSION["email"] = $row['email'];
        header("Location:Candidate/userDashboard.php");
        die();
      }
      else{
        $inputErr = "Log in or password invalid";
      }
    }
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
    include 'database.php';
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
    <title>Job Portal</title>
  </head>
  <body>

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
      <a href='#'>Find jobs</a>
      <a href="Candidate/signup.php" class="right">Candidate Sign up</a>
      <a href="Company/register.php" class="right">Employee Sign up</a>
    </div>

    <div class="slideshow-container">
      <div class="mySlides">
        <img src="images/2a.jpg" style="width:30%">
      </div>
      <div class="mySlides">
        <img src="images/3a.png" style="width:30%">
      </div>
      <a class="prev" onclick="plusSlides(-1)">❮</a>
      <a class="next" onclick="plusSlides(1)">❯</a>
    </div>

    <div class="searchJob">
      <p>All available jobs</p>
    </div>

    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by job title">
    <table id="myTable">
      <?php include 'includeTable.php' ; ?>
    </table>

    <div class="footer">
      <h2>Footer</h2>
    </div>

  <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active";
    }

    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

  </script>

  </body>
</html>
