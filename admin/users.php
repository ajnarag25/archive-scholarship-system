<?php 
  include('../connection.php');
  session_start();
  if (!isset($_SESSION['admin_data'])) {
    header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>System Administrator - Accounts</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/dashboard.css?v=1.0.1" rel="stylesheet" />
    <link href="demo/demo.css" rel="stylesheet" />
    <?php 
        $check_acc = $_SESSION['admin_data']['email'];
        $query = "SELECT * FROM admin WHERE email='$check_acc'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
    ?>
        <link href="<?php echo $row['image'] ?>" rel="icon">
    <?php } ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="red">
            <div class="logo">
                <a href="" class="simple-text logo-mini">
                <?php 
                    $check_acc = $_SESSION['admin_data']['email'];
                    $query = "SELECT * FROM admin WHERE email='$check_acc'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                    <img src="<?php echo $row['image'] ?>" alt="...">
                <?php } ?>
                </a>
                <a href="" class="simple-text logo-normal">
                    System Administrator
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="index.php">
                            <i class='bx bxs-dashboard'></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="users.php">
                            <i class='bx bxs-user-detail' ></i>
                            <p>Create / Manage / View</p>
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
                        <a class="navbar-brand" href="users.php">Create / Manage / View Accounts</a>
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
                                <div><i class='bx bxs-user-plus bx-lg text-secondary'></i></div>
                                <button class="btn btn-danger w-100" data-toggle="modal" data-target="#createAccount">Create Account <span><i class='bx bx-plus' ></i></span> </button>
                                <br><br>
                                <p>Create an account for UNIFAST Person, TES Focal Person, and TDP Focal Person.</p>
                            </div>  
                        </div>
                    </div>
                </div>
                <!-- Modal Create Account-->
                <div class="modal fade" id="createAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form action="process.php" method="POST">
                                    <h6 class="text-center">Please Fill up the necessary information needed</h6>
                                    <br>
                                    <div class="form-outline mb-4">
                                    <label for="">Account Type</label>
                                    <select name="user" class="form-control" id="" required>
                                        <option value="" selected disabled>Select Account Type</option>
                                        <option value="UNIFAST Person">UNIFAST Person</option>
                                        <option value="TES Focal Person">TES Focal Person</option>
                                        <option value="TDP Focal Person">TDP Focal Person</option>
                                    </select>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name" onkeyup="lettersOnly(this)" placeholder="Enter Name" required/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" required/>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Password</label>
                                            <input type="password" class="form-control" name="password1" placeholder="Enter Password" required/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Retype Password</label>
                                            <input type="password" class="form-control" name="password2" placeholder="Retype Password" required/>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" name="create">Create Account</button>
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
                                        <h5 class="card-category">List of Users Accounts</h5>
                                        <h4 class="card-title">Users Account</h4>
                                    </div>
                                    <div class="p-2 flex-shrink-1 bd-highlight">              
                                    <p class="text-center">
                                    Legend: 
                                    </p>
                                    <i class='bx bxs-edit text-primary' ></i> - Edit Account, <br>
                                    <i class='bx bx-reset text-success' ></i> - Edit Account Status, <br>
                                    <i class='bx bxs-trash text-danger' ></i> - Delete Account
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="accountTable">
                                    <thead class="text-danger">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Account Type</th>
                                    <th>Account Status</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = "SELECT * FROM users";
                                            $result = mysqli_query($conn, $query);
                                            $check_row = mysqli_num_rows($result);
                                            while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['user'] ?></td>
                                            <td>
                                                <?php 
                                                    if ($row['account_stat'] == 'active'){
                                                        echo '<h6 class="text-success">Active</h6>';
                                                    }else{
                                                        echo '<h6 class="text-danger">Disabled</h6>';
                                                    }
                                                ?>
                                                
                                            </td>
                                    
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['id'] ?>"><i class='bx bxs-edit' ></i></button>
                                                <button class="btn btn-success" data-toggle="modal" data-target="#stat<?php echo $row['id'] ?>"><i class='bx bx-reset' ></i></button>
                                                <button class="btn btn-danger"  data-toggle="modal" data-target="#delete<?php echo $row['id'] ?>"><i class='bx bxs-trash' ></i></button>
                                            </td>
                                
                                        </tr>
                                            <!-- Modal Edit Account-->
                                            <div class="modal fade" id="edit<?php echo $row['id'] ?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title">Edit Account</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="process.php" method="POST">
                                                                <h6 class="text-center">Edit Account of : <?php echo $row['name'] ?></h6>
                                                                <br>
                                                                <div class="form-outline mb-4">
                                                                <label for="">Edit Account Type</label>
                                                                <select name="user" class="form-control" id="" required>
                                                                    <option value="" selected>--Select New Account Type--</option>
                                                                    <option value="UNIFAST Person">UNIFAST Person</option>
                                                                    <option value="TES Focal Person">TES Focal Person</option>
                                                                    <option value="TDP Focal Person">TDP Focal Person</option>
                                                                </select>
                                                                </div>
                                                                <div class="form-outline mb-4">
                                                                    <label for="">Name</label>
                                                                    <input type="text" class="form-control" name="name" onkeyup="lettersOnly(this)" placeholder="Enter Name" value="<?php echo $row['name'] ?>" required/>
                                                                </div>
                                                                <div class="form-outline mb-4">
                                                                    <label for="">Email</label>
                                                                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $row['email'] ?>" required/>
                                                                </div>
                                                                
                                                                <br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger" name="edit">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <!-- Modal Edit Account Status-->
                                            <div class="modal fade" id="stat<?php echo $row['id'] ?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title">Edit Account Status</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="process.php" method="POST">
                                                                <h6 class="text-center">Edit Account Status of : <?php echo $row['name'] ?></h6>
                                                                <br>
                                                                <div class="form-outline mb-4">
                                                                    <label for="">Account Status</label>
                                                                    <select name="stat" class="form-control" id="" required>
                                                                        <option value="" selected disabled>--Select New Account Status--</option>
                                                                        <option value="active">Enable</option>
                                                                        <option value="disabled">Disable</option>   
                                                                    </select>
                                                                </div>
                                                                <br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" value="<?php echo $row['id'] ?>" name="id_stat">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger" name="edit_stat">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal Delete Account-->
                                            <div class="modal fade" id="delete<?php echo $row['id'] ?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title">Delete Account</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="process.php" method="POST">
                                                                <br>
                                                                <h6 class="text-center">Delete Account of : <?php echo $row['name'] ?></h6>
                                                                <br>
                                                                <p class="text-center"><i class='bx bxs-message-alt-error bx-flashing' style="color:red"></i> Deleting this account is irreversible!</p>
                                                                <br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" value="<?php echo $row['id'] ?>" name="id_del">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger" name="delete">Delete Account</button>
                                                            </div>
                                                        </form>
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
    <script>
        function lettersOnly(input) {
            var regex = /[^a-z ]/gi;
            input.value = input.value.replace(regex, "");
        }
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
