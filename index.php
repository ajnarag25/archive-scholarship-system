<?php 
    include('connection.php');
    session_start();
    if(isset($_SESSION['admin_data'])){
        header('location: admin/index.php');
    }elseif(isset($_SESSION['user_data_unifast'])){
        header('location: unifast/index.php');
    }elseif(isset($_SESSION['user_data_tes'])){
        header('location: tes/index.php');
    }elseif(isset($_SESSION['user_data_tdp'])){
        header('location: tdp/index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Account</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom_style.css">
    <link href="assets/logo.jpg" rel="icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
</head>
<body>
    <section class="vh-100" style="background-color: rgb(139, 43, 43);" >
        <div class="container py-5 h-100" data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="text-center main-logo">
                            <img src="assets/logo.jpg" width="100" alt="">
                        </div>
                        <div class="card-body p-5 text-center">
                            <form action="process.php" method="POST">
                                <h4> <b>ARSO CCT</b></h4>
                                <br>
                                <h3 class="mb-2">Login Account</h3>
                                <p class="mb-5">Please enter your email and password</p>
                                <div class="form-outline mb-4">
                                    <input type="email" placeholder="Enter Email" name="email" class="form-control" required/>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" placeholder="Enter Password" name="password" class="form-control" required/>
                                </div>
                                <a href="" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Forgot Password" data-bs-target="#forgot" class="forgot">Forgot Password?</a>
                                <br><br>
                                <button class="btn btn-success btn-lg btn-block w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Login" type="submit" name="login">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="forgot" tabindex="-1" aria-labelledby="forgot" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgot">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="process.php" method="POST">
                    <div class="modal-body">
                        <input type="email" placeholder="Enter Email" name="email" class="form-control" required/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="forgot_pass">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
      AOS.init({
        duration: 3000,
        once: true,
      });
    </script>
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
</body>
</html>