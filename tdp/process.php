<?php 
    include('../connection.php');
    session_start();

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('location: ../index.php');
}   


// Edit Profile
if (isset($_POST['edit_profile_tdp'])) {
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
if (isset($_POST['change_pass_tdp'])) {
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
if (isset($_POST['change_pic_tdp'])) {
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

// Upload TDP Grantees
if(isset($_POST["upload_tdp"])){
    $filename=$_FILES["file"]["tmp_name"];
    $ext = strtolower(end(explode('.', $_FILES['file']['name'])));
    date_default_timezone_set('Asia/Manila');
    $set_date_time = date("Y-m-d h:i:s");
    $set_date = date("Y-m-d");
    $set_file = 'TDP Grantees'. '_'. $set_date;

    if($_FILES["file"]["size"] > 0){
        $file = fopen($filename, "r");
        if($ext === 'csv'){
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){
                $d1 = $emapData[0];
                $d2 = $emapData[1];
                $d3 = $emapData[2];
                
                $query_code = "SELECT * FROM tdp_grantees WHERE name='$d3'";
                $result2 = $conn->query($query_code);
    
                if ($result2->num_rows > 0) {
                    $_SESSION['status'] = 'Data is already existing!';
                    $_SESSION['status_icon'] = 'error';
                    header('location: index.php');
                } else {
                    $sql1 = "INSERT into tdp_grantees (date_time, file, semester, academic_yr, name) 
                    values('$set_date_time', '$set_file', '$d1', '$d2', '$d3')";
                    $result1 = mysqli_query( $conn, $sql1 );
                }
            }

            fclose($file);
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
if (isset($_POST['update_tdp'])) {
    $id = $_POST['id_update_tdp'];
    $file = $_POST['file'];
    $semester = $_POST['semester'];
    $academic_yr = $_POST['academic_yr'];
    $name = $_POST['name'];

    $sql = "SELECT * FROM tdp_grantees WHERE file='$file' AND semester='$semester' AND academic_yr='$academic_yr' AND name='$name' AND id='$id'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        $conn->query("UPDATE tdp_grantees SET file='$file', semester='$semester', academic_yr='$academic_yr', name='$name' WHERE id='$id'") or die($conn->error);
        $_SESSION['status'] = 'Successfully Updated';
        $_SESSION['status_icon'] = 'success';
        header('location:index.php');
    }else{
        $_SESSION['status'] = 'No changes has been made';
        $_SESSION['status_icon'] = 'warning';
        header('location:index.php');
    }
}

// Delete Grantees
if (isset($_POST['delete_tdp'])) {
    $id_delete = $_POST['id_delete_tdp'];

    if($id_delete != null){
        $conn->query("DELETE FROM tdp_grantees WHERE id='$id_delete';") or die($conn->error);
        $_SESSION['status'] = 'Successfully Deleted';
        $_SESSION['status_icon'] = 'success';
        header('location:index.php');
    }else{
        $_SESSION['status'] = 'An Error Occured!';
        $_SESSION['status_icon'] = 'error';
        header('location:index.php');
    }
    
}

// Archive Records
if (isset($_POST['archive_records'])) {
    $tdp_id = $_POST['tdp_id'];
    $tdp_dt = $_POST['tdp_dt'];
    $tdp_file = $_POST['tdp_file'];
    $tdp_semester = $_POST['tdp_semester'];
    $tdp_academic = $_POST['tdp_academic'];
    $tdp_name = $_POST['tdp_name'];

    if($tdp_id != null){
        $conn->query("INSERT INTO archived_tdp (date_upload,file,semester,academic_yr,name) 
        VALUES('$tdp_dt', '$tdp_file', '$tdp_semester', '$tdp_academic', '$tdp_name')") or die($conn->error);
        $conn->query("DELETE FROM tdp_grantees WHERE id='$tdp_id';") or die($conn->error);
        $_SESSION['status'] = 'Successfully Archived the Record';
        $_SESSION['status_icon'] = 'success';
        header('location:archived_tdp.php');
    }else{
        $_SESSION['status'] = 'An Error Occured!';
        $_SESSION['status_icon'] = 'error';
        header('location:index.php');
    }
    
}

// Unarchive Records
if (isset($_POST['unarchive_record'])) {
    $tdp_id = $_POST['tdp_id'];
    $tdp_dt = $_POST['tdp_dt'];
    $tdp_file = $_POST['tdp_file'];
    $tdp_semester = $_POST['tdp_semester'];
    $tdp_academic = $_POST['tdp_academic'];
    $tdp_name = $_POST['tdp_name'];

    if($tdp_id != null){
        $conn->query("INSERT INTO tdp_grantees (date_time,	file, semester, academic_yr, name) 
        VALUES('$tdp_dt', '$tdp_file', '$tdp_semester', '$tdp_academic', '$tdp_name')") or die($conn->error);
        $conn->query("DELETE FROM archived_tdp WHERE id='$tdp_id';") or die($conn->error);
        $_SESSION['status'] = 'Successfully Unarchived the Record';
        $_SESSION['status_icon'] = 'success';
        header('location:index.php');
    }else{
        $_SESSION['status'] = 'An Error Occured!';
        $_SESSION['status_icon'] = 'error';
        header('location:archived_tdp.php');
    }
    
}

?>