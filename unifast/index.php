<?php 
  include('../connection.php');
  session_start();
  if (!isset($_SESSION['user_data_unifast'])) {
    header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>UNIFAST Person - Account Records</title>
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
                    UNIFAST Person
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="index.php">
                            <i class='bx bx-file' ></i>
                            <p>UNIFAST Records</p>
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
                        <a class="navbar-brand" href="">UNIFAST Records</a>
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
                                <button class="btn btn-danger w-100" data-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload File" data-target="#uploadUnifast">Upload File <span><i class='bx bx-plus' ></i></span> </button>
                            </div>  
                        </div>
                    </div>
                </div>
                <!-- Modal Create Account-->
                <div class="modal fade" id="uploadUnifast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form action="process.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-outline mb-4">
                                        <label for="">File</label>
                                        <input type="file" class="form-control" name="unifast_file" required/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="email" value="<?php echo $_SESSION['user_data_unifast']['email'] ?>">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" name="upload_unifast">Upload File</button>
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
                                        <h4 class="card-title">File Records</h4>
                                    </div>
                                    <div class="p-2 flex-shrink-1 bd-highlight">              
                                    <p class="text-center">
                                    Legend: 
                                    </p>
                                    <i class='bx bx-download text-primary' ></i> - Download File, <br>
                                    <i class='bx bx-folder-open text-success' ></i> - View File, <br>
                                    <i class='bx bxs-trash text-danger' ></i> - Delete File
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="accountTable">
                                    <thead class="text-danger">
                                    <th>File Name</th>
                                    <th>Date Uploaded</th>
                                    <th>No. of Downloads</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $check_user = $_SESSION['user_data_unifast']['email'];
                                        $query = "SELECT * FROM unifast_files WHERE user_email='$check_user'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['date_upload'] ?></td>  
                                        <td><?php echo $row['downloads'] ?></td>                             
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Download File" data-target="#download<?php echo $row['id'] ?>"><i class='bx bx-download' ></i></button>
                                            <button class="btn btn-success" data-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="View File" data-target="#view<?php echo $row['id'] ?>"><i class='bx bx-folder-open' ></i></button>
                                            <button class="btn btn-danger"  data-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete File" data-target="#delete<?php echo $row['id'] ?>"><i class='bx bxs-trash' ></i></button>
                                        </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="download<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Download File</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h6>Are you sure you want download this file?</h6>
                                                    <p>File to be downloaded: <?php echo $row['name'] ?></p>
                                                </div>
                                                    <div class="modal-footer">
                                                        <form action="process.php" method="POST">
                                                            <input type="hidden" name="id_unifast_download" value="<?php echo $row['id'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" name="download_unifast">Download</button>
                                                        </form>
                                                    </div>
                                         
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="view<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Viewing file: <?php echo $row['name'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <embed src="uploads/files/<?php echo $row['name'] ?>"
                                                    frameborder="0" width="100%" height="500px">
                                                </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete File</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h6>Are you sure you want delete this file?</h6>
                                                        <p>File to be deleted: <?php echo $row['name'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="process.php" method="POST">
                                                            <input type="hidden" name="id_delete_unifast" value="<?php echo $row['id'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger" name="delete_unifast">Delete</button>
                                                        </form>
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
<script>
    $('#accountTable').DataTable()
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 3000,
        once: true,
    });
</script>
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
