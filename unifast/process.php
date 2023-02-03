<?php 
    include('../connection.php');
    session_start();

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('location: ../index.php');
    // error_reporting();
}   


// Edit Profile
if (isset($_POST['edit_profile_unifast'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "SELECT * FROM users WHERE name='$name' AND email='$email'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        $conn->query("UPDATE users SET name='$name', email='$email' WHERE id='$id'") or die($conn->error);
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
if (isset($_POST['change_pass_unifast'])) {
    $id = $_POST['id'];
    $newpass1 = $_POST['newpass1'];
    $newpass2 = $_POST['newpass2'];

    if ($newpass1 != $newpass2){
        $_SESSION['status'] = 'Password does not match!';
        $_SESSION['status_icon'] = 'error';
        header('location:account.php');
    }else{
        $conn->query("UPDATE users SET password='".password_hash($newpass1, PASSWORD_DEFAULT)."' WHERE id='$id'") or die($conn->error);
        session_destroy();
        header('location:../index.php');
    }
    
}


// Update Profile Picture
if (isset($_POST['change_pic_unifast'])) {
    $id = $_POST['id'];
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
        $sql='UPDATE users SET image="'.$target_file.'" WHERE id="'.$id.'"';
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

// Upload file
if (isset($_POST['upload_unifast'])) { 
    date_default_timezone_set('Asia/Manila');
    $set_date = date('Y-m-d');
    $get_email = $_POST['email'];
    $filename = $_FILES['unifast_file']['name'];
    $destination = 'uploads/files/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $_FILES['unifast_file']['tmp_name'];
    $size = $_FILES['unifast_file']['size'];

    $sql = "SELECT * FROM unifast_files WHERE name='$filename'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $_SESSION['status'] = 'File is already existed!';
        $_SESSION['status_icon'] = 'warning';
        header('location: index.php');
    }else{
        if (!in_array($extension, ['pdf', 'xlsx', 'csv'])) {
            $_SESSION['status'] = 'You file extension must be .pdf, .xlsx or .csv';
            $_SESSION['status_icon'] = 'error';
            header('location: index.php');
        } elseif ($_FILES['unifast_file']['size'] > 100000000) { // file shouldn't be larger than 100Megabyte
            $_SESSION['status'] = 'File is too large!';
            $_SESSION['status_icon'] = 'error';
            header('location: index.php');
        } else {
            if (move_uploaded_file($file, $destination)) {
                $sql = "INSERT INTO unifast_files (user_email, name, date_upload, size, downloads) VALUES ('$get_email', '$filename', '$set_date', $size, 0)";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['status'] = 'File uploaded successfully!';
                    $_SESSION['status_icon'] = 'success';
                    header('location: index.php');
                }
            } else {
                $_SESSION['status'] = 'Failed to upload file.';
                $_SESSION['status_icon'] = 'error';
                header('location: index.php');
            }
        }
    }

}

// Download file
if (isset($_POST['download_unifast'])) {
    $id = $_POST['id_unifast_download'];

    // fetch file to download from database
    $sql = "SELECT * FROM unifast_files WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/files/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/files/' . $file['name']));
        readfile('uploads/files/' . $file['name']);

        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE unifast_files SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }else{
        $_SESSION['status'] = 'Failed to download file.';
        $_SESSION['status_icon'] = 'error';
        header('location: index.php');
    }

}

// Delete File
if (isset($_POST['delete_unifast'])) {
    $id_del = $_POST['id_delete_unifast'];
    if ($id_del != null){
        $conn->query("DELETE FROM unifast_files WHERE id='$id_del';") or die($conn->error);
        $_SESSION['status'] = 'Successfully Deleted.';
        $_SESSION['status_icon'] = 'success';
        header('location: index.php');
    }else{
        $_SESSION['status'] = 'An Error Occured.';
        $_SESSION['status_icon'] = 'error';
        header('location: index.php');
    }
}

?>