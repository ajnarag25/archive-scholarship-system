<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>TES Focal Person - Grantees</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/dashboard.css?v=1.0.1" rel="stylesheet" />
    <link href="demo/demo.css" rel="stylesheet" />
    <link href="../assets/logo.jpg" rel="icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="red">
            <div class="logo">
                <a href="" class="simple-text logo-mini">
                    <img src="../assets/logo.jpg" alt="">
                </a>
                <a href="" class="simple-text logo-normal">
                    TES Focal Person
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="index.php">
                            <i class='bx bx-file' ></i>
                            <p>TES Focal Person Records</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="tes_grantees.php">
                            <i class='bx bxs-user-circle' ></i>
                            <p>TES Grantees</p>
                        </a>
                    </li>
                    <li>
                        <a href="account.php">
                            <i class='bx bxs-cog'></i>
                            <p>Account Settings</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="../index.php ">
                            <i class='bx bx-log-out' ></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
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
                        <a class="navbar-brand" href="tes_grantees.php">Tertiary Education Subsidy Grantees</a>
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
                                    <a class="dropdown-item" href="../index.php">Logout</a>
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
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex bd-highlight">
                                    <div class="p-2 w-100 bd-highlight">
                                        <h5 class="card-category">List of TES Grantees</h5>
                                        <h4 class="card-title">TES Grantees</h4>
                                    </div>
                        
                            </div>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="accountTable">
                                    <thead class="text-danger">
                                    <th>Award Number</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                       
                                    </thead>
                                    <tbody>

                                        <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                
                                   
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit{{f.id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Credentials for User : {{f.first_name}} {{f.last_name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST">
                                                    {% csrf_token %}
                                                    <br>
                                                    <div class="form-outline mb-4">
                                                        <input type="text" class="form-control" name="e_username" value={{f.username}} required/>
                                                        </div>
                                                    <div class="form-outline mb-4">
                                                        <input type="text" class="form-control" name="e_first_name" value={{f.first_name}} required/>
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <input type="text" class="form-control" name="e_last_name" value={{f.last_name}} required/>
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <input type="text" class="form-control" name="e_email" value={{f.email}} required/>
                                                        </div>
                                                    
                                                    <br>
                                                </div>
                                                    <div class="modal-footer">
                                                    <input type="hidden" name="id_update_admin" value="{{f.id}}">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>

                                    

                                        <!-- Modal -->
                                        <div class="modal fade" id="enable{{f.id}}" tabindex="-1" role="dialog" aria-labelledby="delete{f.id}}" aria-hidden="true">
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
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete{{f.id}}" tabindex="-1" role="dialog" aria-labelledby="delete{f.id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Removing Admin : {{f.first_name}} {{f.last_name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <form method="POST">
                                                {% csrf_token %}
                                                <p><strong><i class='bx bxs-error bx-flashing' style="color: red;"></i> Warning this Action is Irreversible!</strong></p>
                                                <h4>Are you sure to remove this user admin?</h4>
                                            </div>
                                                <div class="modal-footer">
                                                <input type="hidden" name="id_delete_admin" value="{{f.id}}">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>

                                        </div>

                                        </div>


                                    
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
</html>