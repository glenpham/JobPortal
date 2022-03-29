<?php

$email = $_POST['email'];
$password = $_POST['password'];

    // ENCRYPTION PHASE
    // Store the cipher method
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';

    // Store the encryption key
    $encryption_key = "GeeksforGeeks";

    $encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

    // echo $encryption;exit;
    $insertSQL = "UPDATE candidate SET password = '$encryption' WHERE email = '$_POST[email]';";    


    if($conn->query($insertSQL)=== false){
        echo "error".$conn->connect_error;
    }
    
    //header("location: signup.php");

?>