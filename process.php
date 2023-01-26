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
            $_SESSION['user_data'] = $getData_users;
            unset($_SESSION['status']);
            header('location:unifast/index.php');
          
        }else{
            $_SESSION['status'] = 'Email and/or Password is incorrect';
            $_SESSION['status_icon'] = 'error';
            header('location:index.php');
        }
    }elseif($check_user == 'TES Focal Person'){
        if (password_verify($pass, $getData_users['password'])){
            $_SESSION['user_data'] = $getData_users;
            unset($_SESSION['status']);
            header('location:tes/index.php');
          
        }else{
            $_SESSION['status'] = 'Email and/or Password is incorrect';
            $_SESSION['status_icon'] = 'error';
            header('location:index.php');
        }
    }elseif($check_user == 'TDP Focal Person'){
        if (password_verify($pass, $getData_users['password'])){
            $_SESSION['user_data'] = $getData_users;
            unset($_SESSION['status']);
            header('location:tdp/index.php');
          
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

?>