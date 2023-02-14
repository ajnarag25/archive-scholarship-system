<?php 
  include('../connection.php');
  session_start();
  if (!isset($_SESSION['user_data_tdp'])) {
    header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>TDP Focal Person - Account Settings</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/dashboard.css?v=1.0.1" rel="stylesheet" />
    <link href="demo/demo.css" rel="stylesheet" />
    <link href="../assets/logo.jpg" rel="icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="red">
            <div class="logo">
                <a href="" class="simple-text logo-mini">
                    <img src="../assets/logo.jpg" alt="...">
                </a>
                <a href="" class="simple-text logo-normal">
                    TDP Focal Person
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="index.php">
                            <i class='bx bx-file' ></i>
                            <p>TDP Focal Person Records</p>
                        </a>
                    </li>
                    <li class="active"> 
                        <a href="account.php">
                            <i class='bx bxs-cog'></i>
                            <p>Account Settings</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="" data-toggle="modal" data-target="#logout">
                            <i class='bx bx-log-out' ></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logout" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="logout">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-center">Are you sure you want to logout?</h6>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <a href="process.php?logout" class="btn btn-danger">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute bg-danger fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="account.php">Account Settings</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='bx bxs-user' ></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="account.php">Account Settings</a>
                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#logout">Logout</a>
                                </div>
                            </li>
                   
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-8" data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Edit Profile</h5>
                            </div>
                            <div class="card-body">
                                <form action="process.php" method="POST">
                                    <?php 
                                        $check_acc = $_SESSION['user_data_tdp']['email'];
                                        $query = "SELECT * FROM users WHERE email='$check_acc'";
                                        $result = mysqli_query($conn, $query);
                                        $check_row = mysqli_num_rows($result);
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" placeholder="Unifast Person" name="name" onkeyup="lettersOnly(this)" value="<?php echo $row['name'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $row['email'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"  data-target="#edit_profile<?php echo $row['id'] ?>">Edit Profile</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Profile-->
                    <div class="modal fade" id="edit_profile<?php echo $row['id'] ?>" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Edit Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                        <br>
                                        <h6 class="text-center">Are you sure to submit the changes in your account?</h6>
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger" name="edit_profile_tdp">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>

                    <div class="col-md-4" data-aos="zoom-out" data-aos-duration="1000" data-aos-once="true">
                        <div class="card card-user">
                            <div class="image">
                                <img src="assets/bg-school.jpg" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <a href="#">
                                    <?php 
                                        $check_acc = $_SESSION['user_data_tdp']['email'];
                                        $query = "SELECT * FROM users WHERE email='$check_acc'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <img class="avatar border-gray" src="<?php echo $row['image'] ?>" alt="...">
                                     
                                  
                                        <h5 class="title"><?php echo $row['name'] ?></h5>
                                        <form action="process.php" method="POST" enctype="multipart/form-data">
                                            <input type="file" class="form-control" name="pic" required>
                                            <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                            <button type="submit" name="change_pic_tdp" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Profile Picture">Update Profile Picture</button>
                                        </form>
                                    <?php } ?>
                                    </a>
                                </div>
                                <hr><br>
                                <p class="text-center">
                                    WEB-BASED APPLICATION FOR ARCHIVING OF RECORDS FOR SCHOLARSHIP OFFICE-CITY COLLEGE OF TAGAYTAY
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8" data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Change Password</h5>
                            </div>
                            <div class="card-body">
                                <form action="process.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">New Password</label>
                                                <input type="password" class="form-control" name="newpass1" placeholder="New Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Retype New Password</label>
                                                <input type="password" class="form-control" name="newpass2" placeholder="Retype New Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $check_acc = $_SESSION['user_data_tdp']['email'];
                                        $query = "SELECT * FROM users WHERE email='$check_acc'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Password" data-target="#changepass<?php echo $row['id'] ?>">Change Password</button>
                            </div>
                        </div>
                    </div>


                     <!-- Modal Change Password-->
                     <div class="modal fade" id="changepass<?php echo $row['id'] ?>" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                        <br>
                                        <h6 class="text-center">Are you sure to submit your new created password?</h6>
                                        <p class="text-center"><i class='bx bxs-message-alt-error bx-flashing' style="color:red"></i> You will be automatically logout!</p>
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                            
                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger" name="change_pass_tdp">Yes</button>
                                    </div>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
       
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, WEB-BASED APPLICATION FOR ARCHIVING OF RECORDS FOR SCHOLARSHIP OFFICE-CITY COLLEGE OF TAGAYTAY
                    </div>
                </div>
            </footer>
  
        </div>
    </div>
</body>

<script src="js/core/jquery.min.js"></script>
<script src="js/core/popper.min.js"></script>
<script src="js/core/bootstrap.min.js"></script>
<script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="js/plugins/chartjs.min.js"></script>
<script src="js/plugins/bootstrap-notify.js"></script>
<script src="js/dashboard.js?v=1.0.1"></script>
<script src="demo/demo.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="js/functions.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <?php 
        if (isset($_SESSION['status']) && $_SESSION['status'] !='')
        {
    ?>
    <script>
        $(document).ready(function(){
            Swal.fire({
                icon: '<?php echo $_SESSION['status_icon'] ?>',
                title: '<?php echo $_SESSION['status'] ?>',
                confirmButtonColor: 'rgb(139, 43, 43',
                confirmButtonText: 'Okay'
            });
            <?php  unset($_SESSION['status']); ?>
        })
    </script>
    
    <?php
    }else{
        unset($_SESSION['status']);
    }
    ?>

</html>
