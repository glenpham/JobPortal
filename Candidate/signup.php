<?php
    //print_r($_POST);
    // Declare variables
    // If the submitted form isn't empty in any way and holds data,
    //  assign them to the decalred variables
    $firstName = $lastName = $address = $mobile = $email = $password = $success = "";
    
    if(!empty($_POST)){
        if($_POST['firstName'] !='' ){
            $name = $_POST['firstName'];
        }
        if($_POST['lastName'] !='' ){
            $message = $_POST['lastName'];
        }
        if($_POST['address'] !='' ){
            $address = $_POST['address'];
        }
        if($_POST['mobile'] !='' ){
            $mobile = $_POST['mobile'];
        }
        if($_POST['email'] !='' ){
            $email = $_POST['email'];
        }
        if($_POST['password'] !='' ){
            $age = $_POST['password'];
        }
    // echo "work";
    // print_r($_POST);
    }
    

    // 1. Declare variable as an array and resets array everytime form is submitted
    // 2. Call a function and return an array to the declared variable
    $error_log = array();
    $error_log = formValidation();

    // function to be called from above code
    function formValidation(){
        // Declare & set variables to empty
        $error_log['firstName'] = $error_log['lastName'] = $error_log['address']= '';
        $error_log['mobile'] = $error_log['email'] = $error_log['password'] = $error_log['success'] = '';

        if(isset($_POST) && !empty($_POST)  ){
            if($_POST['firstName'] == ''){
                $error_log['firstName'] = 'Please enter your First Name';   
            }
            if($_POST['lastName'] == ''){
                $error_log['lastName'] = 'Please enter your Last Name';   
            }
            if($_POST['address'] == ''){
                $error_log['address'] = 'Please enter your Address';
            }
            if($_POST['mobile'] == ''){
                $error_log['mobile'] = 'Please enter your Mobile number';
            }
            if($_POST['email'] == ''){
                $error_log['email'] = 'Please enter your Email';
            }
            if($_POST['password'] == ''){
                $error_log['password'] = 'Please enter your Password';
            }
            if($_POST['firstName']!='' && $_POST['lastName']!='' && $_POST['address']!='' && $_POST['mobile'] !='' && $_POST['email']!='' && $_POST['password']!=''){
                $error_log['success'] = '<p class="success">Signup Successful!</p>';
            }
        }
        return $error_log;
    }

    if(isset($error_log['success']) && !empty($error_log['success'])){
        insertValue();
        $firstName = '';
        $lastName = '';
        $address='';
        $mobile = '';
        $email = '';    
        $password = '';
    }

    function insertValue(){
        include 'db.php';
        //print_r($_POST);

        if($conn ->connect_error){
            die("Failed! ". $conn->connect_error);
        }

        $sql = "INSERT INTO candidate (firstname, lastname, address, mobile, email, password) 
                Values('$_POST[firstName]','$_POST[lastName]','$_POST[address]','$_POST[mobile]',
                '$_POST[email]','$_POST[password]')";

        //  echo $sql;
        // exit;
        // print_r($conn->query($sql));
        // $sql = "insert into contactus (firstname, mobile,email,message) values ('abc','122323','test.fa.ca','test' )";
        //print_r($sql);

        $conn->query($sql);

        include 'encrypt.php';
        $conn->close();

    }
    
    ?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Sign Up</title>
    <link rel="stylesheet" href="index.css">
    </head>
    <body>

        <?php include_once 'navbar.php'; ?>

        <div class="container">
            <div class="maindiv">
            <div class="col-6">
                <h1 style="text-align: center;">Job Seeker</h1>
                <?php echo $error_log['success'];?>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <label class="label" for="name">First Name</label>
                    <input type="text" class ="input-div-nn" id="firstName" name = "firstName" value = "<?php echo $firstName; ?>">
                    <p class = "error-msg"><?php echo $error_log['firstName'];?></p>

                    <label class="label" for="name">Last Name</label>
                    <input type="text" class ="input-div-nn" id="lastName" name = "lastName" value = "<?php echo $lastName; ?>">
                    <p class = "error-msg"><?php echo $error_log['lastName'];?></p>

                    <label class="label" for="address">Address</label>
                    <input type="text" class ="input-div-nn" id="address" name = "address"  value = "<?php echo $address; ?>">
                    <p class = "error-msg"><?php echo $error_log['address'];?></p>

                    <label class="label" for="mobile">Mobile Number</label>
                    <input type="text" class ="input-div-nn" id="mobile" name = "mobile"  value = "<?php echo $mobile; ?>">
                    <p class = "error-msg"><?php echo $error_log['mobile'];?></p>

                    <label class="label" for="email">Email</label>
                    <input type="email" class ="input-div-nn" id="email" name="email" value = "<?php echo $email; ?>"                >
                    <p class = "error-msg"><?php echo $error_log['email'];?></p>

                    <label class="label" for="mobile">Password</label>
                    <input type="password" class ="input-div-nn" id="password" name = "password"  value = "<?php echo $password; ?>">
                    <p class = "error-msg"><?php echo $error_log['password'];?></p>

                    <a href="login.php" class="href">Already have an account? Login</a>

                    <input type="submit" class="submit" value="Register">
                </form>
            </div>
            <div class="col-6"></div>
            </div>
        </div>
    </body>
    </html>