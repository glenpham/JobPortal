<?php

    // View array from the form when POSTED via submit on the webpage
    //print_r($_POST);

    // Sequence for form
    // 1.Verify if form inputs are empty. If not, hold the correct values
    // 2.Verify form. If no input -> error message
    // 3.Connect to DB and insert values if step 2 is valid
    // 


    // Declare variables
    $user = $pwd =  "";

    // Check and holds value for form elements
    if(!empty($_POST)){
        if($_POST['email'] !='' ){
            $user = $_POST['email'];
        }
        if($_POST['password'] !='' ){
            $pwd = $_POST['password'];
        }
    }

    // Declare array and call function
    $error_log = array();
    $error_log = formValidation();

    // Check if form was completely filled out
    function formValidation(){
        $error_log['EMAIL'] = $error_log['PASSWORD'] = $error_log['success'] = '';

        if(isset($_POST) && !empty($_POST)  ){
            if($_POST['email'] == ''){
                $error_log['EMAIL'] = 'Please enter your email';   
            }
            if($_POST['password'] == ''){
                $error_log['PASSWORD'] = 'Please enter your password';
            }
            if($_POST['email']!='' && $_POST['password']!=''){
                $error_log['success'] = '<p class="success">LOGIN SUCCESSFUL</p>';
            }
        }
        return $error_log;
    }

    if(isset($error_log['success']) && !empty($error_log['success'])){
        $error_log =  insertValue();
        $user = $pwd = '';
     }
     
    // Function to connect to and insert values to DB
    function insertValue(){
        $error_log = array();
        $error_log['EMAIL'] = $error_log['PASSWORD']   = '';

        // Create connection to DB
        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "mydb";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check for connection error
        if($conn ->connect_error){
            die("Failed! ". $conn->connect_error);
        }

        // Store the cipher method
        $ciphering = "AES-128-CTR";
        
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for decryption
        $decryption_iv = '1234567891011121';

        // Store the decryption key
        $decryption_key = "GeeksforGeeks";

        $sql = "SELECT * FROM candidate WHERE email = '$_POST[email]'";    
           
        $result = $conn->query($sql);
        if($result->num_rows >0){
            $row = $result->fetch_assoc();
            
            $decryption=openssl_decrypt ($row['password'], $ciphering,
            $decryption_key, $options, $decryption_iv);

            if($_POST['password'] == $decryption){
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['user_id'];
                //$_SESSION['name'] = $row['name'];
                
                header("Location: userDashboard.php");
                die();
            }
            else{
                $error_log['PASSWORD'] = 'Please verify the email and password';
            }   
        }
        else{
            //echo "error".$conn->connect_error;
            $error_log['PASSWORD'] = 'Please verify the email and password'; 
        }
        $conn->close();
        return $error_log;
    }
?>

<!---- HTML Doc Start ---->
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
    <link rel="stylesheet" href="signup.css">
    </head>
    <!---- Head End ---->

    <!---- Body Start ---->
    <body>

        <?php include_once 'candidateNavbar.php';?>

        <div class="container">
            <div class="maindiv">
            <div class="col-6">
            <h1 style="text-align: center;">Login To Your Account</h1>
                <?php //echo $error_log['success'];?>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                    <label class="label" for="name">EMAIL</label>
                    <input type="email" class ="input-div-nn" id="email" name = "email" value = "<?php echo $user; ?>">
                    <p class = "error-msg"><?php echo $error_log['EMAIL'];?></p>
                    
                    <label class="label" for="password">PASSWORD</label>
                    <input type="password" class ="input-div-nn" id="password" name="password" value = "<?php echo $pwd; ?>">
                    <p class = "error-msg"><?php echo $error_log['PASSWORD'];?></p>
                    <a href="registration.php" class="href">First Use? Register Here</a>
                    <br>
                    <a href="adminLogin.php" class="href">Admin? Login Here</a>  


                    <input type="submit" class="submit" value="Login">
                </form>
            </div>
            <div class="col-6"></div>
            </div>
        </div>
    </body>
    <!---- Body End ---->
</html>