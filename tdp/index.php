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
    <title>TDP Focal Person - Account Records</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/dashboard.css?v=1.0.1" rel="stylesheet" />
    <link href="demo/demo.css" rel="stylesheet" />
    <link href="../assets/logo.jpg" rel="icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="red">
            <div class="logo">
                <a href="" class="simple-text logo-mini">
                    <img src="../assets/logo.jpg" alt="">
                </a>
                <a href="" class="simple-text logo-normal">
                    TDP Focal Person
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="index.php">
                            <i class='bx bx-file' ></i>
                            <p>TDP Focal Person Records</p>
                        </a>
                    </li>
                    <li>
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
                        <a class="navbar-brand" href="">TDP Focal Person Records</a>
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
                    <div class="col">
                        <div class="card" data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
                            <div class="card-header">
                                
                            </div>
                            <div class="card-body text-center">
                                <div><i class='bx bx-file bx-lg text-secondary'></i></div>
                                <button class="btn btn-danger w-100" data-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload File" data-target="#uploadTDP">Upload File <span><i class='bx bx-plus' ></i></span> </button>
                            </div>  
                        </div>
                    </div>
                </div>
                <!-- Modal Create Account-->
                <div class="modal fade" id="uploadTDP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="process.php" enctype="multipart/form-data">
                                    <div class="form-outline mb-4">
                                        <label for="">File</label>
                                        <input type="file" class="form-control" name="file" required/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" name="upload_tdp">Upload File</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex bd-highlight">
                                    <div class="p-2 w-100 bd-highlight">
                                        <h5 class="card-category">List of File Records</h5>
                                        <h4 class="card-title">TDP Grantees</h4>

                                    </div>
                                    <div class="p-2 flex-shrink-1 bd-highlight">              
                                    <button class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Make Report" id="make_report"><i class='bx bx-download' ></i> Make Report</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="accountTable">
                                    <thead class="text-danger">
                                    <th>Date Upload</th>
                                    <th>File Name</th>
                                    <th>Semester</th>
                                    <th>A.Y Year</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $query = "SELECT * FROM tdp_grantees";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['date_time'] ?></td>
                                            <td><?php echo $row['file'] ?></td>
                                            <td><?php echo $row['semester'] ?></td>      
                                            <td><?php echo $row['academic_yr'] ?></td>   
                                            <td><?php echo $row['name'] ?></td>                          
                                            <td>
                                                <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#edit"><i class='bx bx-download' ></i></button> -->
                                                <button class="btn btn-primary" data-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit File" data-target="#edit<?php echo $row['id'] ?>"><i class='bx bx-edit' ></i></button>
                                                <button class="btn btn-danger"  data-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete File" data-target="#delete<?php echo $row['id'] ?>"><i class='bx bxs-trash' ></i></button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit{{f.id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit File</b> </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="process.php" method="POST">
                                                        <br>
                                                        <div class="form-outline mb-4">
                                                            <label for="">File Name</label>
                                                            <input type="text" class="form-control" name="file" value="<?php echo $row['file'] ?>" readonly/>
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label for="">Semester</label>
                                                            <input type="text" class="form-control" name="semester" value="<?php echo $row['semester'] ?>"required/>
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label for="">A.Y Year</label>
                                                            <input type="text" class="form-control" name="academic_yr" value="<?php echo $row['academic_yr'] ?>"required/>
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label for="">Name</label>
                                                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>"required/>
                                                        </div>
                                                        
                                                        <br>
                                                </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id_update_tdp" value="<?php echo $row['id'] ?>">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="update_tdp">Update</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    

                                        <!-- Modal -->
                                        <!-- <div class="modal fade" id="enable{{f.id}}" tabindex="-1" role="dialog" aria-labelledby="delete{f.id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Enable Account Admin : {{f.first_name}} {{f.last_name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <form method="POST">
                                                {% csrf_token %}
                                                <h4>Are you sure to enable this user admin?</h4>
                                            </div>
                                                <div class="modal-footer">
                                                <input type="hidden" name="id_enable_admin" value="{{f.id}}">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Enable</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div> -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h5>Are you sure you want delete the record?</h5>
                                                        <p class="text-center"><i class='bx bxs-message-alt-error bx-flashing' style="color:red"></i> This action is irreversible!</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="process.php" method="POST">
                                                            <input type="hidden" name="id_delete_tdp" value="<?php echo $row['id'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger" name="delete_tdp">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </div>

                                        </div>

                                    <?php } ?>
                                    
                                    </tbody>
                                </table>

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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/functions.js"></script>
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
