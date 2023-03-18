<?php 
    include('../connection.php');
    session_start();

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('location: ../index.php');
}   

// Create Account
if (isset($_POST['create'])) {
    $user_type = $_POST['user'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];

    $sql = "SELECT * FROM users WHERE name='$name' AND email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($pass1 != $pass2){
        $_SESSION['status'] = 'Password does not match!';
        $_SESSION['status_icon'] = 'error';
        header('location:users.php');
    }elseif(strlen($pass1) <= 8){
        $_SESSION['status'] = 'Password Must Contain At Least 8 Characters!';
        $_SESSION['status_icon'] = 'error';
        header('location:users.php');
    }else{
        if (!$result->num_rows > 0) {
            $conn->query("INSERT INTO users (name, email, password, image, user, otp, account_stat) 
            VALUES('$name', '$email', '".password_hash($pass1, PASSWORD_DEFAULT)."', 'uploads/logo.jpg', '$user_type', 0, 'active')") or die($conn->error);
            $_SESSION['status'] = 'Successfully Created the Account';
            $_SESSION['status_icon'] = 'success';
            header('location:users.php');
        }else{
            $_SESSION['status'] = 'Email Account Already Exists';
            $_SESSION['status_icon'] = 'warning';
            header('location:users.php');
        }
    }
  
}

// Edit Account
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $user_type = $_POST['user'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE name='$name' AND email='$email' AND user='$user_type'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        $conn->query("UPDATE users SET name='$name', email='$email', user='$user_type' WHERE id='$id'") or die($conn->error);
        $_SESSION['status'] = 'Successfully Updated the Account';
        $_SESSION['status_icon'] = 'success';
        header('location:users.php');
    }else{
        $_SESSION['status'] = 'No changes has been made';
        $_SESSION['status_icon'] = 'warning';
        header('location:users.php');
    }
    
}

// Edit Account Status
if (isset($_POST['edit_stat'])) {
    $id_stat = $_POST['id_stat'];
    $status = $_POST['stat'];

    $sql = "SELECT * FROM users WHERE account_stat='$status' AND id='$id_stat' ";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        $conn->query("UPDATE users SET account_stat='$status' WHERE id='$id_stat'") or die($conn->error);
        $_SESSION['status'] = 'Successfully Updated the Account Status';
        $_SESSION['status_icon'] = 'success';
        header('location:users.php');
    }else{
        $_SESSION['status'] = 'No changes has been made';
        $_SESSION['status_icon'] = 'warning';
        header('location:users.php');
    }
    
}

// // Archive Account
// if (isset($_POST['archive_user'])) {
//     $id_user = $_POST['id_user'];
//     $uname = $_POST['users_name'];
//     $uemail = $_POST['users_email'];
//     $upassword = $_POST['users_password'];
//     $uimage = $_POST['users_image'];
//     $uaccount = $_POST['users_account'];
//     $uotp = $_POST['users_otp'];
//     $ustat = $_POST['users_stat'];

//     if($id_user != null){
//         $conn->query("INSERT INTO archived_users (name, email, password, image, user, otp, account_stat) 
//         VALUES('$uname', '$uemail', '$upassword', '$uimage', '$uaccount', '$uotp', '$ustat')") or die($conn->error);
//         $conn->query("DELETE FROM users WHERE id='$id_user';") or die($conn->error);
//         $_SESSION['status'] = 'Successfully Archived the Account';
//         $_SESSION['status_icon'] = 'success';
//         header('location:archive_account.php');
//     }else{
//         $_SESSION['status'] = 'An Error Occured!';
//         $_SESSION['status_icon'] = 'error';
//         header('location:users.php');
//     }
    
// }

// // Unarchive Account
// if (isset($_POST['unarchive_user'])) {
//     $id_user = $_POST['id_user'];
//     $uname = $_POST['users_name'];
//     $uemail = $_POST['users_email'];
//     $upassword = $_POST['users_password'];
//     $uimage = $_POST['users_image'];
//     $uaccount = $_POST['users_account'];    
//     $uotp = $_POST['users_otp'];
//     $ustat = $_POST['users_stat'];

//     if($id_user != null){
//         $conn->query("INSERT INTO users (name, email, password, image, user, otp, account_stat) 
//         VALUES('$uname', '$uemail', '$upassword', '$uimage', '$uaccount', '$uotp', '$ustat')") or die($conn->error);
//         $conn->query("DELETE FROM archived_users WHERE id='$id_user';") or die($conn->error);
//         $_SESSION['status'] = 'Successfully Unarchived the Account';
//         $_SESSION['status_icon'] = 'success';
//         header('location:users.php');
//     }else{
//         $_SESSION['status'] = 'An Error Occured!';
//         $_SESSION['status_icon'] = 'error';
//         header('location:users.php');
//     }
    
// }


// Edit Profile
if (isset($_POST['edit_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "SELECT * FROM admin WHERE name='$name' AND email='$email' AND address='$address'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        $conn->query("UPDATE admin SET name='$name', email='$email', address='$address' WHERE id=1") or die($conn->error);
        $_SESSION['status'] = 'Successfully Updated your Account';
        $_SESSION['status_icon'] = 'success';
        header('location:account.php');
    }else{
        $_SESSION['status'] = 'No changes has been made';
        $_SESSION['status_icon'] = 'warning';
        header('location:account.php');
    }
    
}


// Change Password
if (isset($_POST['change_pass'])) {
    $newpass1 = $_POST['newpass1'];
    $newpass2 = $_POST['newpass2'];

    if ($newpass1 != $newpass2){
        $_SESSION['status'] = 'Password does not match!';
        $_SESSION['status_icon'] = 'error';
        header('location:account.php');
    }else{
        $conn->query("UPDATE admin SET password='".password_hash($newpass1, PASSWORD_DEFAULT)."' WHERE id=1") or die($conn->error);
        session_destroy();
        header('location:../index.php');
    }
    
}


// Update Profile Picture
if (isset($_POST['change_pic'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["pic"]["tmp_name"]);

    if($check !== false) {
        $uploadOk = 1;
        if ($uploadOk == 0) {
            $_SESSION['status'] = 'Failed to upload the image';
            $_SESSION['status_icon'] = 'error';
            header('location: account.php');
    } else {
        move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
    }
        $sql='UPDATE admin SET image="'.$target_file.'" WHERE id=1';
        $result = mysqli_query($conn, $sql);
        $_SESSION['status'] = 'Successfully Updated Profile Picture';
        $_SESSION['status_icon'] = 'success';
        header('location: account.php');
        
    } else {
        $uploadOk = 0;
        $_SESSION['status'] = 'Uploaded file is not an image';
        $_SESSION['status_icon'] = 'error';
        header('location: account.php');
  
    }
}


?>