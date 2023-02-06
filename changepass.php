<?php 
    include('connection.php');
    session_start();
    if(!isset($_SESSION['check_email'])){
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
                        <div class="card-body p-5 text-center">
                            <form action="process.php" method="POST">
                                <h3 class="mb-2">Change Password</h3>
                                <p class="mb-5">Create New Password</p>
                                <div class="form-outline mb-4">
                                    <input type="password" placeholder="Enter New Password" name="pass1" class="form-control" required/>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" placeholder="Retype Password" name="pass2" class="form-control" required/>
                                </div>
                                <button class="btn btn-success btn-lg btn-block w-100" type="submit" name="change_pass">Submit</button>
                                <br><br>
                                <a href="index.php" class="btn btn-success btn-lg btn-block w-100">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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