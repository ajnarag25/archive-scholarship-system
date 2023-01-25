<?php 
    include('connection.php');
    session_start();

// Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $login="SELECT * FROM admin WHERE email='$email'";
    $prompt = mysqli_query($conn, $login);
    $getData = mysqli_fetch_array($prompt);

    if (password_verify($pass, $getData['password'])){
        $_SESSION['admin_data'] = $getData;
        header('location:admin/index.php');
      
    }else{
        $_SESSION['status'] = 'Email and/or Password is incorrect';
        $_SESSION['status_icon'] = 'error';
        header('location:index.php');
    }
}

?>