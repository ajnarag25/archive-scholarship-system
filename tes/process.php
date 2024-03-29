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
    $filename = $_FILES["file"]["name"];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    date_default_timezone_set('Asia/Manila');
    $set_date_time = date("Y-m-d h:i:s");
    $set_date = date("Y-m-d");
    $set_file = $filename . '_' . $set_date;
    $destination = 'uploads/files/' . $set_file;

    if($_FILES["file"]["size"] > 0){
        // Check if file is a CSV or PDF
        if($ext === 'csv' || $ext === 'pdf' || $ext === 'xlsx') {
            // Save the uploaded file to the destination folder
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $destination)) {
                $file = fopen($destination, "r");
                if($ext === 'csv'){
                    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){
                        $d1 = $emapData[0];
                        $d2 = $emapData[1];
                        $d3 = $emapData[2];

                        $query_code = "SELECT * FROM tes_grantees WHERE file='$d3'";
                        $result2 = $conn->query($query_code);

                        if ($result2->num_rows > 0) {
                            $_SESSION['status'] = 'Data is already existing!';
                            $_SESSION['status_icon'] = 'error';
                            fclose($file);
                            unlink($destination); // delete the uploaded file
                            header('location: index.php');
                            exit();
                        } else {
                            $sql1 = "INSERT into tes_grantees (date_time, file, semester, academic_yr, remarks) 
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
                } else { // PDF file
                    $query_code = "SELECT * FROM tes_grantees WHERE file='$filename'";
                    $result3 = $conn->query($query_code);

                    if ($result3->num_rows > 0) {
                        $_SESSION['status'] = 'Data is already existing!';
                        $_SESSION['status_icon'] = 'error';
                        fclose($file);
                        unlink($destination); // delete the uploaded file
                        header('location: index.php');
                        exit();
                    } else {
                        $sql2 = "INSERT into tes_grantees (date_time, file, semester, academic_yr, remarks) 
                        values('$set_date_time', '$set_file', 'N/a', 'N/a', 'N/a')";
                        $result2 = mysqli_query( $conn, $sql2 );
                        $_SESSION['status'] = 'PDF File successfully imported.';
                        $_SESSION['status_icon'] = 'success';
                        header('location: index.php');
                    }
                }
            } else {
                $_SESSION['status'] = 'Failed to save the uploaded file!';
                $_SESSION['status_icon'] = 'error';
                header('location: index.php');
            }
        } else {
            $_SESSION['status'] = 'Please upload a csv orpdf file only.';
            $_SESSION['status_icon'] = 'error';
            header('location: index.php');
            }
            } else {
            $_SESSION['status'] = 'Please select a file to upload!';
            $_SESSION['status_icon'] = 'error';
            header('location: index.php');
            }
        }

// Update Grantees Credentials
if (isset($_POST['update_tes'])) {
    $id = $_POST['id_update_tes'];
    $file = $_POST['file'];
    $semester = $_POST['semester'];
    $academic_yr = $_POST['academic_yr'];
    $name = $_POST['remarks'];

    $sql = "SELECT * FROM tes_grantees WHERE file='$file' AND semester='$semester' AND academic_yr='$academic_yr' AND remarks='$name' AND id='$id'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        $conn->query("UPDATE tes_grantees SET file='$file', semester='$semester', academic_yr='$academic_yr', remarks='$name' WHERE id='$id'") or die($conn->error);
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


// Archive Records
if (isset($_POST['archive_records'])) {
    $tes_id = $_POST['tes_id'];
    $tes_dt = $_POST['tes_dt'];
    $tes_file = $_POST['tes_file'];
    $tes_semester = $_POST['tes_semester'];
    $tes_academic = $_POST['tes_academic'];
    $tes_name = $_POST['tes_remarks'];

    if($tes_id != null){
        $conn->query("INSERT INTO archived_tes (date_upload,file,semester,academic_yr,remarks) 
        VALUES('$tes_dt', '$tes_file', '$tes_semester', '$tes_academic', '$tes_name')") or die($conn->error);
        $conn->query("DELETE FROM tes_grantees WHERE id='$tes_id';") or die($conn->error);
        $_SESSION['status'] = 'Successfully Archived the Record';
        $_SESSION['status_icon'] = 'success';
        header('location:archived_tes.php');
    }else{
        $_SESSION['status'] = 'An Error Occured!';
        $_SESSION['status_icon'] = 'error';
        header('location:index.php');
    }
    
}

// Restore Records
if (isset($_POST['unarchive_record'])) {
    $tes_id = $_POST['tes_id'];
    $tes_dt = $_POST['tes_dt'];
    $tes_file = $_POST['tes_file'];
    $tes_semester = $_POST['tes_semester'];
    $tes_academic = $_POST['tes_academic'];
    $tes_name = $_POST['tes_name'];

    if($tes_id != null){
        $conn->query("INSERT INTO tes_grantees (date_time,	file, semester, academic_yr, remarks) 
        VALUES('$tes_dt', '$tes_file', '$tes_semester', '$tes_academic', '$tes_name')") or die($conn->error);
        $conn->query("DELETE FROM archived_tes WHERE id='$tes_id';") or die($conn->error);
        $_SESSION['status'] = 'Successfully Restore the Record';
        $_SESSION['status_icon'] = 'success';
        header('location:index.php');
    }else{
        $_SESSION['status'] = 'An Error Occured!';
        $_SESSION['status_icon'] = 'error';
        header('location:archived_tes.php');
    }
    
}

// Download file
if (isset($_POST['download_tes'])) {
    $id = $_POST['id_tes_download'];

    // fetch file to download from database
    $sql = "SELECT * FROM tes_grantees WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/files/' . $file['file'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/files/' . $file['file']));
        readfile('uploads' . $file['file']);

        // $newCount = $file['downloads'] + 1;
        // $updateQuery = "UPDATE tes_ SET downloads=$newCount WHERE id=$id";
        // mysqli_query($conn, $updateQuery);
        exit;
    }else{
        $_SESSION['status'] = 'Failed to download file.';
        $_SESSION['status_icon'] = 'error';
        header('location: index.php');
    }

}

?>