<?php 
    include('../connection.php');
    session_start();

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('location: ../index.php');
}   


// Edit Profile
if (isset($_POST['edit_profile_tes'])) {
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
if (isset($_POST['change_pass_tes'])) {
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
if (isset($_POST['change_pic_tes'])) {
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

// Upload TES Grantees
if(isset($_POST["upload_tes"])){
    $filename=$_FILES["file"]["tmp_name"];
    $ext = strtolower(end(explode('.', $_FILES['file']['name'])));
    date_default_timezone_set('Asia/Manila');
    $set_date = date("Y-m-d");

    
    if($_FILES["file"]["size"] > 0){
        $file = fopen($filename, "r");
        if($ext === 'csv'){
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){
                $d1 = $emapData[1];
                $d2 = $emapData[2];
                $d3 = $emapData[3];
                $d4 = $emapData[4];
                $d5 = $emapData[5];
                
                
                $query_code = "SELECT * FROM tes_grantees WHERE firstname='$d4' AND middlename='$d5' AND lastname='$d3'";
                $result2 = $conn->query($query_code);
    
                if ($result2->num_rows > 0) {
                    $_SESSION['status'] = 'Data is already existing!';
                    $_SESSION['status_icon'] = 'error';
                    header('location: index.php');
                } else {
                    $sql = "INSERT into tes_grantees (scholarship, award_no, firstname, middlename, lastname, date_upload) 
                    values('$emapData[1]','$emapData[2]','$emapData[4]','$emapData[5]','$emapData[3]', '$set_date')";
                    $result = mysqli_query( $conn, $sql );
                }
            }
            fclose($file);
            //throws a message if data successfully imported to mysql database from excel file
            $_SESSION['status'] = 'CSV File successfully imported.';
            $_SESSION['status_icon'] = 'success';
            header('location: index.php');
    
            //close of connection
            mysqli_close($conn); 
        }else{
            $_SESSION['status'] = 'Please upload a csv file only!';
            $_SESSION['status_icon'] = 'error';
            header('location: index.php');
        }
       

    }
 
}	 

// Update Grantees Credentials
if (isset($_POST['update_tes'])) {
    $id = $_POST['id_update_tes'];
    $scholar = $_POST['scholarship'];
    $award = $_POST['award_no'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];

    $sql = "SELECT * FROM tes_grantees WHERE scholarship='$scholar' AND award_no='$award' AND firstname='$fname' AND middlename='$mname' AND lastname='$lname' AND id='$id'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        $conn->query("UPDATE tes_grantees SET scholarship='$scholar',award_no='$award',firstname='$fname',middlename='$mname',lastname='$lname' WHERE id='$id'") or die($conn->error);
        $_SESSION['status'] = 'Successfully Updated the Account';
        $_SESSION['status_icon'] = 'success';
        header('location:index.php');
    }else{
        $_SESSION['status'] = 'No changes has been made';
        $_SESSION['status_icon'] = 'warning';
        header('location:index.php');
    }
}

// Delete Grantees
if (isset($_POST['delete_tes'])) {
    $id_delete = $_POST['id_delete_tes'];

    if($id_delete != null){
        $conn->query("DELETE FROM tes_grantees WHERE id='$id_delete';") or die($conn->error);
        $_SESSION['status'] = 'Successfully Deleted';
        $_SESSION['status_icon'] = 'success';
        header('location:index.php');
    }else{
        $_SESSION['status'] = 'An Error Occured!';
        $_SESSION['status_icon'] = 'error';
        header('location:index.php');
    }
    
}


?>