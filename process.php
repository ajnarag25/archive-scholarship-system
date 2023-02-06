<?php 
    include('connection.php');
    session_start();

// Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $check_user = $_POST['user'];

    $login_admin="SELECT * FROM admin WHERE email='$email'";
    $prompt_admin = mysqli_query($conn, $login_admin);
    $getData_admin = mysqli_fetch_array($prompt_admin);

    $login_users="SELECT * FROM users WHERE email='$email'";
    $prompt_users = mysqli_query($conn, $login_users);
    $getData_users = mysqli_fetch_array($prompt_users);
    
    if ($check_user == 'System Administrator'){
        if (password_verify($pass, $getData_admin['password'])){
            $_SESSION['admin_data'] = $getData_admin;
            unset($_SESSION['status']);
            header('location:admin/index.php');
        }else{
            $_SESSION['status'] = 'Email and/or Password is incorrect';
            $_SESSION['status_icon'] = 'error';
            header('location:index.php');
        }
    }elseif($check_user == 'UNIFAST Person'){
        if (password_verify($pass, $getData_users['password'])){
            if ($getData_users['user'] == 'UNIFAST Person' && $getData_users['account_stat'] == 'active'){
                $_SESSION['user_data_unifast'] = $getData_users;
                unset($_SESSION['status']);
                header('location:unifast/index.php');
            }else{
                $_SESSION['status'] = 'Invalid Credentials!';
                $_SESSION['status_icon'] = 'error';
                header('location:index.php');
            }
        }else{
            $_SESSION['status'] = 'Email and/or Password is incorrect';
            $_SESSION['status_icon'] = 'error';
            header('location:index.php');
        }
    }elseif($check_user == 'TES Focal Person'){
        if (password_verify($pass, $getData_users['password'])){
            if ($getData_users['user'] == 'TES Focal Person' && $getData_users['account_stat'] == 'active'){
                $_SESSION['user_data_tes'] = $getData_users;
                unset($_SESSION['status']);
                header('location:tes/index.php');
            }else{
                $_SESSION['status'] = 'Invalid Credentials!';
                $_SESSION['status_icon'] = 'error';
                header('location:index.php');
            }
        }else{
            $_SESSION['status'] = 'Email and/or Password is incorrect';
            $_SESSION['status_icon'] = 'error';
            header('location:index.php');
        }
    }elseif($check_user == 'TDP Focal Person'){
        if (password_verify($pass, $getData_users['password'])){
            if ($getData_users['user'] == 'TDP Focal Person' && $getData_users['account_stat'] == 'active'){
                $_SESSION['user_data_tdp'] = $getData_users;
                unset($_SESSION['status']);
                header('location:tdp/index.php');
            }else{
                $_SESSION['status'] = 'Invalid Credentials!';
                $_SESSION['status_icon'] = 'error';
                header('location:index.php');
            }
        }else{
            $_SESSION['status'] = 'Email and/or Password is incorrect';
            $_SESSION['status_icon'] = 'error';
            header('location:index.php');
        }
    }else{
        $_SESSION['status'] = 'Invalid Credentials!';
        $_SESSION['status_icon'] = 'error';
    }
   
}



// Forgot Password
if (isset($_POST['forgot_pass'])) {
    $emails = $_POST['email'];
    $_SESSION['check_email'] = $emails;
    $setOTP = rand(0000,9999);

    $sql = "SELECT * FROM users WHERE email='$emails'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if ($check == 0){
        $_SESSION['status'] = 'The email address you entered is not valid!';
        $_SESSION['status_icon'] = 'error';
        header('location:index.php');
    }else{
        $conn->query("UPDATE users SET otp='$setOTP' WHERE email='$emails'") or die($conn->error);
        // include 'SEND_EMAIL.php';
        header("Location: otp.php");
    }

}

 // Otp Submit
if (isset($_POST['otp_submit'])) {
    $otp = $_POST['otp'];
    $_SESSION['otp'] = $otp;
    $sql = "SELECT * FROM users WHERE otp='$otp'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);

    if ($check == 0){
        $_SESSION['status'] = 'The OTP entered is incorrect!';
        $_SESSION['status_icon'] = 'error';
        header('location:otp.php');
    }else{
        header("Location: changepass.php");
    }
}

// Change Password
if (isset($_POST['change_pass'])) {
    $password1 = $_POST['pass1'];
    $password2 = $_POST['pass2'];
    $get_otp = $_SESSION['otp'];
    
    if ($password1 != $password2){
        $_SESSION['status'] = 'Password does not match!';
        $_SESSION['status_icon'] = 'error';
        header('location:changepass.php');
    }elseif(strlen($password1) <= 8){
        $_SESSION['status'] = 'Password must contain at least 8 characters!';
        $_SESSION['status_icon'] = 'error';
        header('location:changepass.php');
    }
    else{
        $conn->query("UPDATE users SET password='".password_hash($password1, PASSWORD_DEFAULT)."' WHERE otp='$get_otp'") or die($conn->error);
        $_SESSION['status'] = 'Successfully updated your password';
        $_SESSION['status_icon'] = 'success';
        header('location:index.php');
    }
 

}
?>